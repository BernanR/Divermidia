<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {
    
    public function get($filtro=null)
    {   
       $sql = "SELECT * from settings
       where 1=1 ";      
       if(isset($filtro["id"])) $sql .= "and `id` = '" . anti_injection($filtro["id"]) . "'";
       if(isset($filtro["key"])) $sql .= "and `key` = '" . anti_injection($filtro["key"]) . "'";
       if(isset($filtro["qtd_by_pag"])) $sql .= " limit " . $filtro["qtd_by_pag"];
       if(isset($filtro["page_init"])) $sql .= " offset " . $filtro["page_init"];
       

       $return["data_result"] = $this->db->query($sql)->result();

       $sql = "SELECT count(*) qtd from settings  where 1=1 ";      
       if(isset($filtro["id"])) $sql .= "and `id` = '" . anti_injection($filtro["id"]) . "'";
       if(isset($filtro["key"])) $sql .= "and `key` = '" . anti_injection($filtro["key"]) . "'";
       $return["qtd"] = $this->db->query($sql)->row()->qtd;

       return (Object) $return;
    }

    public function update($data,$id){

        $this->db->where('id', $id);
        return $this->db->update("settings", $data);
    }

    public function insert($data){

        if ($this->db->insert('settings', $data)) {
            $id = $this->db->insert_id();
            return $id;
        }

        return false;
    }
    public function delete($id){
        $this->db->where('id', $id);
        return $this->db->delete('settings');
    }
}
