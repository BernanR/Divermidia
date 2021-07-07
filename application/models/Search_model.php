<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_model extends CI_Model {
    
    public function get($filtro=null){   

        // $query = "SELECT `p`.`name`, `p`.`title`, `p`.`description`, `p`.`resume`, `p`.`file`, `p`.`id`, 
        // concat('produto/', `p`.`slug`) as 'slug'  
        // from products as p";      

        if(isset($filtro["search"])){
            // $query .= " where `p`.`name` like '%" . anti_injection($filtro["search"]) . "%'";
            // $query .= " or `p`.`title` like '%" . anti_injection($filtro["search"]) . "%'";
            // $query .= " or `p`.`description` like '%" . anti_injection($filtro["search"]) . "%'";
            // $query .= " or `p`.`resume` like '%" . anti_injection($filtro["search"]) . "%'";


            //UNION ALL

            // $query .= "
            //     union all select `p`.`title`, `p`.`resume`, `p`.`content`,
            //     case 
            //         when `p`.`type`=1 then concat('s/', `p`.`slug`) 
            //         when `p`.`type`=2 then concat('s/', `p`.`slug`) 
            //     end
            //     from `pages` as p
            // ";

            // $query .= " where `p`.`title` like '%" . anti_injection($filtro["search"]) . "%'";
            // $query .= " or `p`.`resume` like '%" . anti_injection($filtro["search"]) . "%'";
            // $query .= " or `p`.`content` like '%" . anti_injection($filtro["search"]) . "%'";
            // $query .= " or `p`.`slug` like '%" . anti_injection($filtro["search"]) . "%'";


            //SELECT NA PRÓPRIA table pages

            $query_pages = "SELECT `p`.`title`, `p`.`resume`, `p`.`content`, `p`.`slug`
                
            from `pages` as p ";

            
            $query_pages .= " where `p`.`title` like '%" . anti_injection($filtro["search"]) . "%'";
            $query_pages .= " or `p`.`resume` like '%" . anti_injection($filtro["search"]) . "%'";
            //$query_pages .= " or `p`.`content` like '%" . anti_injection($filtro["search"]) . "%'";
            $query_pages .= " or `p`.`slug` like '%" . anti_injection($filtro["search"]) . "%'";

        }

        //$result["data_result"] = $this->db->query($query)->result();
        $result['pages_result'] = $this->db->query($query_pages)->result();

        return (Object) $result;
    }
}
