<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {
    
    public function get($filtro=null)
    {      
        $categories_list_slugs;

    	if (isset($filtro['brand_slug'])) {
    		if($filtro['brand_slug'] === 'all') $filtro['brand_slug'] = null;
        }
        
        if(isset($filtro['categories_list_slugs'])) {
            $categories_list_slugs = $this->tratar_category_array($filtro['categories_list_slugs']);
        }

        if(isset($filtro['brands_list_slugs'])) {
            $brands_list_slugs = $this->tratar_brand_array($filtro['brands_list_slugs']);
        }

        //echo '<pre>'; print_r($categories_list_slugs); echo '</pre>';die;

        $sql = "SELECT
            pd.id,
            pd.file,
            pd.resume,
            pd.name,
            pd.title,
            pd.keywords,
            pd.updated_dt,
            pd.description,
            pd.file,
            b.name brand,
            pd.brand_id,
            pd.slug,
            GROUP_CONCAT(c.name) categories,
            pd.additional_files
            from products pd
            INNER JOIN product_categories pc ON pc.product_id = pd.id
            INNER JOIN categories c ON c.id = pc.category_id
            INNER JOIN brands b ON b.id = pd.brand_id
        where pd.deleted=0 ";      
        if(isset($filtro["id"])) $sql .= "and pd.`id` = '" . anti_injection($filtro["id"]) . "'";
        if(isset($filtro["name"])) $sql .= "and pd.`name` like '%" . anti_injection($filtro["name"]) . "%'";
        if(isset($filtro["category_id"])) $sql .= "and c.`id` = '" . anti_injection($filtro["category_id"]) . "'";
        if(isset($filtro["brand_id"])) $sql .= "and b.`id` = '" . anti_injection($filtro["brand_id"]) . "'";
        if(isset($filtro["brand_slug"])) $sql .= "and b.`slug` = '" . anti_injection($filtro["brand_slug"]) . "'";
        if(isset($filtro["category_slug"])) $sql .= "and c.`slug` = '" . anti_injection($filtro["category_slug"]) . "'";
        if(isset($filtro["product_slug"])) $sql .= "and pd.`slug` = '" . anti_injection($filtro["product_slug"]) . "'";
        if(isset($categories_list_slugs)) $sql .= "and c.`slug` in(" . $categories_list_slugs . ")";
        if(isset($brands_list_slugs)) $sql .= "and b.`slug` in(" . $brands_list_slugs . ")";
       
        
        //echo '<pre>'; print_r($sql); echo '</pre>'; die;
        $sql .= "
                GROUP BY 
                pd.id,
                pd.file,
                pd.resume,
                pd.keywords,
                pd.description,
                pd.file,
                b.name,
                pd.additional_files,
                pd.name";

        if(isset($filtro["qtd_by_pag"])) $sql .= " limit " . $filtro["qtd_by_pag"];
        if(isset($filtro["page_init"])) $sql .= " offset " . $filtro["page_init"];

        $return["data_result"] = $this->db->query($sql)->result();
 
        $sql = "SELECT count(distinct pd.id) qtd from products pd
            INNER JOIN product_categories pc ON pc.product_id = pd.id
            INNER JOIN categories c ON c.id = pc.category_id  
            INNER JOIN brands b ON b.id = pd.brand_id
            where pd.deleted=0 ";
        if(isset($filtro["id"])) $sql .= "and pd.`id` = '" . anti_injection($filtro["id"]) . "'";
        if(isset($filtro["name"])) $sql .= "and pd.`name` like '%" . anti_injection($filtro["name"]) . "%'";
        if(isset($filtro["category_id"])) $sql .= "and c.`id` = '" . anti_injection($filtro["category_id"]) . "'";
        if(isset($filtro["brand_id"])) $sql .= "and b.`id` = '" . anti_injection($filtro["brand_id"]) . "'";
        if(isset($filtro["brand_slug"])) $sql .= "and b.`slug` = '" . anti_injection($filtro["brand_slug"]) . "'";
        if(isset($filtro["category_slug"])) $sql .= "and c.`slug` = '" . anti_injection($filtro["category_slug"]) . "'";
        if(isset($filtro["product_slug"])) $sql .= "and pd.`slug` = '" . anti_injection($filtro["product_slug"]) . "'";
        if(isset($categories_list_slugs)) $sql .= "and c.`slug` in(" . $categories_list_slugs . ")";
        if(isset($brands_list_slugs)) $sql .= "and b.`slug` in(" . $brands_list_slugs . ")";
        $return["qtd"] = $this->db->query($sql)->row()->qtd;
        
        return (Object) $return;
    }

    private function tratar_category_array($array)
    {
        if(count($array) > 0 )
        {        
            $categories = [];
            foreach ($array as $k => $v) {
                if(substr($k, 0, 2) === 'c_') array_push($categories, $v);
            }

            return (count($categories) > 0) ? '\'' . implode($categories, ' \',\'') . '\'' : null;
        }
    }

    private function tratar_brand_array($array)
    {
        if(count($array) > 0 )
        {        
            $marcas = [];
            foreach ($array as $k => $v) {
                if(substr($k, 0, 2) === 'm_') array_push($marcas, $v);
            }

            return (count($marcas) > 0) ? '\'' . implode($marcas, ' \',\'') . '\'' : null;
        }
    }

    public function insert($post){

        $record['name'] = $post->name;
        $record['title'] = $post->title;
        $record['file'] = $post->file;
        $record['brand_id'] = $post->brand;
        $record['slug'] = $this->getSlugValid(slug($post->name . '-' . $post->brand));
        $record['resume'] = $post->resume;
        $record['description'] = $post->description;
        $record['created_dt'] = date('Y-m-d H:i:s');
        $record['created_by'] = user_logged('id');
        $record['updated_by'] = user_logged('id');
        $record['keywords'] = $post->keywords;

        if ($this->db->insert('products', $record)) {
            $id = $this->db->insert_id();
            $this->insertProductCategories($id,  $post->categories);
            return $id;
        }

        return false;
    }

    public function update($post, $id){

        $record['name'] = $post->name;
        $record['title'] = $post->title;
        $record['file'] = $post->file;
        $record['brand_id'] = $post->brand;
        $record['slug'] = ( $post->slug != '') ? $post->slug : $this->getSlugValid(slug($post->name . '-' . $post->brand), $id);
        $record['resume'] = $post->resume;
        $record['description'] = $post->description;
        $record['keywords'] = $post->keywords;
        $record['updated_dt'] = date('Y-m-d H:i:s');
        $record['updated_by'] = user_logged('id');

        $this->db->where('id', $id);
        $this->db->update("products", $record);
        $this->insertProductCategories($id,  $post->categories);
        return $id;
    }

    public function delete($id){

        $this->db->where('id', $id);
        return $this->db->update("products", ['deleted' => 1]);
    }

    public function insertProductCategories($product_id, $categories){

        $data = [];
        foreach ($categories as $k) {
            array_push(
                $data, 
                [
                    'product_id' => $product_id ,
                    'category_id' => $k ,
                ]
            );
        }

        $this->db->delete('product_categories', array('product_id' => $product_id)); 

        if ($this->db->insert_batch('product_categories', $data)) {
            $id = $this->db->insert_id();
            return $id;
        }

        return false;
    }

    public function getSlugValid($slug, $product_id=null, $id=0)
    {
        $this->db->where(['slug' => $slug]);
        
        if ($product_id != null) {
            $this->db->where_not_in(['id' => $product_id ]);
        }

        $result = $this->db->get('products')->row();
        
        if (count($result) > 0) {
            $id++;
            $slug = $slug . '-' . $id;            
            return $this->getSlugValid($slug, $product_id, $id);
        }

        return $slug;
    }

    public function getCategories($id, $list=false)
    {       
        $sql = "SELECT pc.product_id,pc.category_id,c.name FROM 
        product_categories pc
        INNER JOIN categories c ON c.id = pc.category_id
        WHERE pc.product_id = {$id}";

        $result = $this->db->query($sql)->result();
        
        if(!$list) return $result;

        $array = [];

        foreach ($result as $k) {
            array_push($array, $k->category_id);
        }
        
        return $array;
    }

    public function getLastId()
    {
        return $this->db->query('select max(id) id from products')->row(); 
    }

    public function getCategoriesWithProduct()
    {   
        $data =  $this->db->query('
            select c.name, c.slug, count(p.id) qtd_product  from categories as c 
            inner join product_categories pc on pc.category_id = c.id
            inner join products p on p.id = pc.product_id 
            where c.deleted =0 and p.deleted =0
            group by c.name, c.slug
            having(count(p.id) > 0)
        ')->result(); 
        return  $data;
    }

    public function getBrandsWithProduct()
    {   
        return $this->db->query('
            select b.name, b.slug, count(p.id) qtd_product  
            from brands as b
            inner join products p on p.brand_id = b.id and p.deleted =0
            where b.deleted =0
            group by b.name, b.slug
            having(count(p.id) > 0)
        ')->result(); 
    }
}
