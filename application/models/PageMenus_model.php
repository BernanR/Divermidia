<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageMenus_model extends CI_Model {
    protected $table = 'page_menus';
    
    public function getAll(){

        $sql = "SELECT m.slug as menu_slug, p.title from page_menus as pm
            INNER JOIN menus as m ON pm.menu_id = m.id
            INNER JOIN pages as p ON pm.page_id = p.id

            where p.deleted = 0 and m.deleted = 0
        ";      

        // dd($this->db->query($sql)->result(), true);
        return (Object) ['data_result' => $this->db->query($sql)->result()];

        
        // $return["qtd"] = $this->db->query($sql)->row()->qtd;

        // return (Object) $return;
    }
}
