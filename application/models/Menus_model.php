<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menus_model extends CI_Model {
    protected $table = 'menus';
    
    public function get($filtro=null)
    {   
       $sql = "SELECT c.*, mp.name as menu_pai, p.slug slug_page from {$this->table} as c
       left join menus mp on mp.id = c.menu_id
       left join pages p on p.id = c.page_id
       where c.deleted = 0 ";      
       if(isset($filtro["id"])) $sql .= "and c.id = '" . anti_injection($filtro["id"]) . "'";
       if(isset($filtro["page_id"])) $sql .= "and c.page_id = '" . anti_injection($filtro["page_id"]) . "'";
       if(isset($filtro["name"])) $sql .= "and c.name = '" . anti_injection($filtro["name"]) . "'";
       if(isset($filtro["menu_id_is_null"])) $sql .= "and c.menu_id  is null";

       $sql .= " order by coalesce(c.ordem, 10000) asc";
       
       $return["data_result"] = $this->db->query($sql)->result();

       $sql = "SELECT count(*) qtd from {$this->table} c where deleted = 0 ";      
       if(isset($filtro["id"])) $sql .= "and id = '" . anti_injection($filtro["id"]) . "'";
       if(isset($filtro["page_id"])) $sql .= "and c.page_id = '" . anti_injection($filtro["page_id"]) . "'";
       if(isset($filtro["name"])) $sql .= "and name = '" . anti_injection($filtro["name"]) . "'";
       if(isset($filtro["menu_id_is_null"])) $sql .= "and c.menu_id  is  null";
       $return["qtd"] = $this->db->query($sql)->row()->qtd;
       return (Object) $return;
    }

    public function update($data,$id){

        $record = array(
            'name' => $data->name,
            'ordem' => ($data->ordem) ? $data->ordem : null,
            'slug' => slug($data->name),
            'url' => (isset($data->url)) ? $data->url : null,            
            'created_dt' => date('Y-m-d H:i:s'),
            'updated_dt' => date('Y-m-d H:i:s'),
            'created_by' => user_logged('id'),
            'updated_by' => user_logged('id'),            
        );

        $record['menu_id'] = ($data->menu_id) ? $data->menu_id : null;
        $record['page_id'] = ($data->page_id) ? $data->page_id: null;

        $this->db->where('id',$id);
        return $this->db->update("{$this->table}", $record);
    }

    public function insert($data){
        // Organizar array contendo os dados do usuário

        $record = array(
            'name' => $data->name,
            'ordem' => $data->ordem,
            'slug' => slug($data->name),
            'url' => (isset($data->url)) ? $data->url : null,            
            'created_dt' => date('Y-m-d H:i:s'),
            'updated_dt' => date('Y-m-d H:i:s'),
            'created_by' => user_logged('id'),
            'updated_by' => user_logged('id'),            
        );

        if ($data->menu_id != '')  $record['menu_id'] = $data->menu_id;
        if ($data->page_id != '')  $record['page_id'] = $data->page_id;
        
        if($this->db->insert("{$this->table}", $record)){
            return $this->db->insert_id();
        }
        
        return false;
    }

    public function delete($id){

        $this->db->where('id',$id);
        return $this->db->update("{$this->table}", ['deleted' => 1]);
    }

    public function amoutPagesByMenus($id){       
        $sql = "SELECT count(*) amout  FROM 
        pages p INNER JOIN menus m ON m.page_id=p.id
        WHERE m.id = {$id} and p.deleted=0 and m.deleted=0";
        
        return $this->db->query($sql)->row();         
    }

    function getActivedMenus(){
        $sql = "SELECT 
            m.name, 
            m.url, 
            m.id, 
            m.menu_id, 
            p.slug 
            FROM menus m
            left join pages p on p.id = m.page_id
            WHERE m.deleted = 0            
            ORDER BY coalesce(ordem, 1000) asc
        ";

        $menus = [];
        $dropdowns = [];
        $data = $this->db->query($sql)->result();        
        foreach ($data as $row) $row->menu_id ? array_push($dropdowns, $row) : $menus[$row->id] = $row;
        //mesclando menus à seus dropdowns!!
        foreach($menus as $menu){
            $menu->dropdown = [];
            foreach($dropdowns as $row){
                if($row->menu_id === $menu->id) array_push($menu->dropdown, $row) ;
            }
        }
        return (Object) $menus;

    }
}
