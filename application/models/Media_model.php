<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media_model extends CI_Model {
    
    public function get($filtro=null){
       $sql = "SELECT * from media where 1=1 ";
       if(isset($filtro["id"])) $sql .= "and `id` = '" . anti_injection($filtro["id"]) . "'";
       if(isset($filtro["title"])) $sql .= "and `title` = '" . anti_injection($filtro["title"]) . "'";
       if(isset($filtro["key"])) $sql .= "and `key` = '" . anti_injection($filtro["key"]) . "'";

       if(isset($filtro["qtd_by_pag"])) $sql .= " limit " . $filtro["qtd_by_pag"];
       if(isset($filtro["page_init"])) $sql .= " offset " . $filtro["page_init"];

       
       $return["data_result"] = $this->db->query($sql)->result();

       $sql = "SELECT count(*) qtd from media  where 1=1 ";      
       if(isset($filtro["id"])) $sql .= "and `id` = '" . anti_injection($filtro["id"]) . "'";
       if(isset($filtro["key"])) $sql .= "and `key` = '" . anti_injection($filtro["key"]) . "'";
       if(isset($filtro["title"])) $sql .= "and `title` = '" . anti_injection($filtro["title"]) . "'";
       $return["qtd"] = $this->db->query($sql)->row()->qtd;

       return (Object) $return;
    }

    public function update($data,$id){
        $this->db->where('id', $id);
        return $this->db->update("media", $data);
    }

    public function insert($data){
        if ($this->db->insert('media', $data)) {
            $id = $this->db->insert_id();
            return $id;
        }
        return false;
    }

    public function getFilesUploads($filtro){
        $sql = "SELECT * from uploads
       where 1=1 ";      
       if(isset($filtro["id"])) $sql .= "and `id` = '" . anti_injection($filtro["id"]) . "'";
       

       return $this->db->query($sql)->result();
    }

    public function uploadFile($filename, $path='./assets/uploads', $name=null, $datasave=null) {
        
        $this->load->library('Image_handler');
        $name = $name ? slug($name) . '-' . date_timestamp_get(date_create()) : date_timestamp_get(date_create());
               
        $retorno_upload = $this->image_handler->upload_file(
            $filename,
            $path,
            $name
        );        
        
        if (!$retorno_upload) return $retorno_upload;
        
        if ($datasave and !isset($retorno_upload['error'])) {
            $datasave = (object) $datasave;
            $data['file'] = $retorno_upload['upload_data']['file_name'];
            $data['path'] = $path;

            if (isset($datasave->key)) $data['key'] = $datasave->key;
            if (isset($datasave->title)) $data['title'] = $datasave->title;
            if (isset($datasave->file)) $data['file'] = $datasave->file;
            if (isset($datasave->note)) $data['note'] = $datasave->note;
            if (isset($datasave->created_dt)) $data['created_dt'] = $datasave->created_dt;
            if (isset($datasave->updated_dt)) $data['updated_dt'] = $datasave->updated_dt;
            if (isset($datasave->created_by)) $data['created_by'] = $datasave->created_by;
            if (isset($datasave->updated_by)) $data['updated_by'] = $datasave->updated_by;
            
            $data['created_dt'] = date('Y-m-d H:i:s');
            $data['created_by'] = user_logged('id');
            $data['updated_by'] = user_logged('id');

            if ($this->db->insert('media', $data)) {
                $id = $this->db->insert_id();
                $retorno_upload['id'] = $id;               
            }
        }

        return $retorno_upload;
    } 
}
