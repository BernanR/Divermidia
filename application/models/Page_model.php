<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_model extends CI_Model {

    protected $table = 'pages';

    public function getWithMenuSlug(){
        $sql = "SELECT  
                p.id, p.slug, p.title, p.resume, m.slug as menu_slug
            from page_menus as pm
                RIGHT JOIN {$this->table} as p ON pm.page_id = p.id
                RIGHT JOIN menus as m ON pm.menu_id = m.id
            where p.deleted = 0 ";
        
        $qtd = "SELECT count(*) as qtd from
            page_menus as pm
                RIGHT JOIN {$this->table} as p ON pm.page_id = p.id
            where p.deleted = 0";

        return (Object) [
            'data_result' => $this->db->query($sql)->result(),
            'qtd' => $this->db->query($qtd)->row()->qtd
        ];

    }
    
    public function get($filtro=null){   

        $sql = "SELECT * from {$this->table} as p where p.deleted = 0 ";      
        if(isset($filtro["id"])) $sql .= "and p.`id` = '" . anti_injection($filtro["id"]) . "' ";
        if(isset($filtro["title"])) $sql .= "and p.`title` = '" . anti_injection($filtro["title"]) . "' ";
        if(isset($filtro["slug"])) $sql .= "and p.`slug` = '" . anti_injection($filtro["slug"]) . "' ";
        
        $sql .= " order BY COALESCE(`order`, 100) ";

        if(isset($filtro["id"])) {
            $return["data_result"] = $this->db->query($sql)->row();
        } else{
            $return["data_result"] = $this->db->query($sql)->result();
        }        
            
        $sql = "SELECT count(*) qtd from {$this->table}  where  deleted = 0 ";
        if(isset($filtro["id"])) $sql .= "and `id` = '" . anti_injection($filtro["id"]) . "'";
        if(isset($filtro["slug"])) $sql .= "and `slug` = '" . anti_injection($filtro["slug"]) . "'";
        if(isset($filtro["title"])) $sql .= "and `title` = '" . anti_injection($filtro["title"]) . "'";        
        
        $return["qtd"] = $this->db->query($sql)->row()->qtd;

        return (Object) $return;
    }

    public function insert($post){
        //echo '<pre>'; print_r($post); echo '</pre>'; die;
        $record['title'] = $post->title;
        // $record['type'] = $post->type;
        if(isset($post->order)) $record['order'] = $post->order;
        $record['resume'] = $post->resume;
        $record['content'] = $post->content;
        $record['banners'] = $post->banners;
        $record['gallery_id'] = $post->gallery_id; 
        $record['keywords'] = $post->keywords;
        $record['display_brands'] = (isset($post->display_brands)) ? 1 : 0 ;         
        $record['slug'] = $this->getSlugValid(slug($post->title));
        $record['created_dt'] = date('Y-m-d H:i:s');
        $record['created_by'] = user_logged('id');
        $record['updated_by'] = user_logged('id');

        if ($this->db->insert("{$this->table}", $record)) {
            $id = $this->db->insert_id();

            if ($post->menu_id != '') {
                $this->db->where('id', $post->menu_id);
                $this->db->update('menus', ['page_id' => $id]);
            }

            return $id;
        }

        return false;
    }

    public function update($id, $post) {
        $record['title'] = $post->title;
        // $record['type'] = $post->type;
        $record['resume'] = $post->resume;
        $record['content'] = $post->content;
        $record['banners'] = $post->banners;
        $record['gallery_id'] = $post->gallery_id;        
        $record['display_brands'] = ($post->display_brands) ? 1 : 0 ;   
        $record['keywords'] = $post->keywords;
        $record['slug'] = ( $post->slug != '') ? $post->slug : $this->getSlugValid(slug($post->title), $id);
        $record['created_dt'] = date('Y-m-d H:i:s');
        $record['created_by'] = user_logged('id');
        $record['updated_by'] = user_logged('id');
        
        $this->db->where('id', $id);
        if ($this->db->update('pages', $record)) {    
            
            if ($post->menu_id != '') {
                $this->db->where('id', $post->menu_id);
                $this->db->update('menus', ['page_id' => $id]);
            }

            return $id;
        }

        return false;
    }

    //para o método admin/pages/list - buscar o nome e slug das categorias de cada página
    public function getWithPageCategories($filtro=null){



        // $sql = "SELECT c.name as cat_name, c.slug as cat_slug ,p.* 
        //     FROM {$this->table} as p 
        //     INNER JOIN menus as c ON p.page_category_id = c.id 
        //     WHERE p.deleted = 0 ";
        //     if(isset($filtro["id"])) $sql .= "AND p.id = '" . anti_injection($filtro["id"]) . "' ";
        //     if(isset($filtro["title"])) $sql .= "AND p.title = '" . anti_injection($filtro["title"]) . "' ";
        //     if(isset($filtro["slug"])) $sql .= "AND p.slug = '" . anti_injection($filtro["slug"]) . "' ";
        //     if(isset($filtro['cat_id'])) $sql .= "AND p.page_category_id = '". anti_injection($filtro['cat_id']) ."' ";
        //     if(isset($filtro['cat_slug'])) $sql .= "AND c.slug='". anti_injection($filtro['cat_slug']) ."' ";
            
        // $return["data_result"] = $this->db->query($sql)->result();

        // $sql = "SELECT count(*) as qtd FROM {$this->table} as p INNER JOIN page_categories as c ON p.page_category_id = c.id 
        // WHERE p.deleted = 0 ";
        // if(isset($filtro["id"])) $sql .= "AND p.`id` = '" . anti_injection($filtro["id"]) . "'";
        // if(isset($filtro["slug"])) $sql .= "AND p.`slug` = '" . anti_injection($filtro["slug"]) . "'";
        // if(isset($filtro["title"])) $sql .= "AND p.`title` = '" . anti_injection($filtro["title"]) . "'";
        // if(isset($filtro['cat_id'])) $sql .= "AND p.`page_category_id` = '". anti_injection($filtro['cat_id']) ."' ";
        // if(isset($filtro['cat_slug'])) $sql .= "AND c.slug='". anti_injection($filtro['cat_slug']) ."' ";
        
        // $return["qtd"] = $this->db->query($sql)->row()->qtd;
        // return (Object) $return;
    }

    public function getPagesMenu($type_id) {
        $menus = [];
        $pages = $this->get(['type' => $type_id])->data_result;
        foreach ($pages as $v) {
            array_push($menus, (object) [
                'title' => $v->title,
                'slug' => $v->slug,
            ]);
        }
        return  $menus;
    }

    public function removerGaleria($gallery_id){
        $this->db->where('gallery_id', $gallery_id);
        return $this->db->update("{$this->table}", ['gallery_id' => null]);
    }

    public function delete($id){
        $this->db->where('id', $id);
        return $this->db->update("{$this->table}", ['deleted' => 1]);
    }

    public function getSlugValid($slug, $post_id=null, $id=1){
        $this->db->where(['slug' => $slug]);
        
        if ($post_id != null) {
            $this->db->where_not_in(['id' => $post_id ]);
        }

        $result = $this->db->get("{$this->table}")->row();
        if (count((array) $result) > 0) {
            $slug = $slug . '-' . $id++;
            $this->getSlugValid($slug, $post_id, $id);
        }
        return $slug;
    }

    public function getWebPage($cat_slug, $page_slug){
        $sql = "SELECT p.*, c.name as cat_name, c.id as cat_id, c.slug as cat_slug FROM {$this->table} as p INNER JOIN page_categories as c 
        ON p.page_category_id = c.id
        WHERE p.deleted = 0 AND p.slug='$page_slug' AND c.slug='$cat_slug'";


        $res['data_result'] = $this->db->query($sql)->result();

        return (Object) $res;
    }
    
    public function getPagesWithCatOnMenu(){

        $sql = "SELECT p.slug, p.id, p.title, p.resume, p.page_category_id FROM {$this->table} as p INNER JOIN page_categories as c
        ON c.id=p.page_category_id and c.is_actived_menu=1
        WHERE p.deleted=0 and c.deleted=0";

        $res = $this->db->query($sql)->result();

        return (Object) $res;

    }


    public function getLastId(){
        return $this->db->query("select max(id) id {$this->table}")->row(); 
    }

    
    public function insertFile($file){
        $record['file'] = $file;
        $record['created_dt'] = date('Y-m-d H:i:s');
        $record['created_by'] = user_logged('id');

        if ($this->db->insert('uploads', $record)) {
            $id = $this->db->insert_id();
            return $id;
        }

        return false;
    }
}
