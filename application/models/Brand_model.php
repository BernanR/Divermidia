<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand_model extends CI_Model {
    
    public function get($filtro=null)
    {   

       $sql = "SELECT b.id, b.name,b.slug, b.description, b.banner, b.banner_mobile ,b.updated_dt, GROUP_CONCAT(c.name, ' ') categories  from brands b
       inner join brand_categories bc on bc.brand_id = b.id
       inner join categories c on c.id = bc.category_id
       where b.deleted = 0 ";      
       if(isset($filtro["id"])) $sql .= "and b.id = '" . anti_injection($filtro["id"]) . "'";
       if(isset($filtro["name"])) $sql .= "and b.name = '" . anti_injection($filtro["name"]) . "'";
       if(isset($filtro["slug"])) $sql .= "and b.slug = '" . anti_injection($filtro["slug"]) . "'";
       $sql .= "GROUP BY b.name,b.slug, b.description, b.updated_dt"; 

       $return["data_result"] = $this->db->query($sql)->result();

       $sql = "SELECT count(*) qtd from brands b
        where b.deleted = 0 ";      
       if(isset($filtro["id"])) $sql .= "and id = '" . anti_injection($filtro["id"]) . "'";
       if(isset($filtro["slug"])) $sql .= "and b.slug = '" . anti_injection($filtro["slug"]) . "'";
       if(isset($filtro["name"])) $sql .= "and b.name = '" . anti_injection($filtro["name"]) . "'";
       $return["qtd"] = $this->db->query($sql)->row()->qtd;

       return (Object) $return;
    }

    public function insert($data){
        // Organizar array contendo os dados do usuário
        $record = array(
            'name' => $data->name,
            'slug' => slug($data->name),
            'description' => $data->description,
            'created_dt' => date('Y-m-d H:i:s'),
            'updated_dt' => date('Y-m-d H:i:s'),
            'created_by' => user_logged('id'),
            'updated_by' => user_logged('id')
        );
        if(isset($data->banner)) $record['banner'] = $data->banner;
        if(isset($data->banner_mobile)) $record['banner_mobile'] = $data->banner_mobile;

        if ($this->db->insert('brands', $record)) {
            $id = $this->db->insert_id();
            $this->insertBrandCategories($id, $data->categories);
            return $id;
        }

        return false;
    }

    public function update($id, $data)
    {
        // Organizar array contendo os dados do usuário
        $record = array(
            'name' => $data->name,
            'slug' => slug($data->name),
            'description' => $data->description,
            'updated_dt' => date('Y-m-d H:i:s'),
            'updated_by' => user_logged('id')
        );

        if(isset($data->banner)) $record['banner'] = $data->banner;
        if(isset($data->banner_mobile)) $record['banner_mobile'] = $data->banner_mobile;

        $this->db->where('id', $id);
        $this->db->update("brands", $record);
        $this->insertBrandCategories($id, $data->categories);

        return true;
    }


    public function insertBrandCategories($brand_id, $categories){

        $data = [];
        foreach ($categories as $k) {
            array_push(
                $data, 
                [
                    'brand_id' => $brand_id ,
                    'category_id' => $k ,
                ]
            );
        }

        $this->db->delete('brand_categories', array('brand_id' => $brand_id)); 

        if ($this->db->insert_batch('brand_categories', $data)) {
            $id = $this->db->insert_id();
            return $id;
        }

        return false;
    }

    public function getCategories($id, $list=false)
    {       
        $sql = "SELECT pc.brand_id,pc.category_id,c.name FROM 
        brand_categories pc
        INNER JOIN categories c ON c.id = pc.category_id
        WHERE pc.brand_id = {$id}";

        $result = $this->db->query($sql)->result();
        
        if(!$list) return $result;

        $array = [];

        foreach ($result as $k) {
            array_push($array, $k->category_id);
        }
        
        return $array;
    }

    public function delete($id){

        $this->db->where('id',$id);
        return $this->db->update("brands", ['deleted' => 1]);
    }

    public function amoutProductByBrand($id)
    {       
        $sql = "SELECT count(*) amout  FROM 
        products
        WHERE deleted=0 and brand_id = {$id}";
        
        return $this->db->query($sql)->row();         
    }

    public function getBrandCategories()
    {
        $sql = "SELECT b.id,b.slug,b.name  from brands b where b.deleted = 0";        
        $brands = $this->db->query($sql)->result(); 

        foreach ($brands as $v) {

            $category = $this->db->query("
                SELECT c.id, c.name, c.slug FROM brand_categories bc
                INNER JOIN categories c ON c.id = bc.category_id
                WHERE 
                c.deleted = 0
                and bc.brand_id = {$v->id}
            ")->result(); 
            
            $v->categories = $category;            
        }
        return $brands;
    }

    public function getBrandBanners($filters){
        $q = "SELECT banner as desktop, 
        case
            when banner_mobile != '' then banner_mobile
        end as mobile from brands where 1=1 ";

        foreach($filters as $k => $v){
            if($v and $k) $q .= "AND $k = '$v' ";
        }
        
        try{
            $r = $this->db->query($q)->result();
        }catch(Exception $e){
            return false;
        }

        return (Object) $r[0];
    }
}
