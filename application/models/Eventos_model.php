<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eventos_model extends CI_Model {
    
    public function getEventos($filtro=null)
    {   

      foreach ($filtro as $k => $v) if(strlen($v)===0) unset($filtro[$k]);

       $sql = "SELECT e.*, t.turma from eventos e
       left join turmas t on t.id = e.turma
       where excluido=0 ";      
       if(isset($filtro["nome"])) $sql .= "and nome like '%" . anti_injection($filtro["nome"]) . "%' ";
       if(isset($filtro["data"])) $sql .= "and data = '" . anti_injection($filtro["data"]) . "' ";
      
       if(isset($filtro["qtd_por_pag"])) $sql .= " limit " . $filtro["qtd_por_pag"];
       if(isset($filtro["page_init"])) $sql .= " offset " . $filtro["page_init"];

       $return["data_result"] = $this->db->query($sql)->result();

       //dd($sql);
       
       $sql = "SELECT count(*) qtd from eventos
       where excluido=0 ";      
       if(isset($filtro["nome"])) $sql .= "and nome like '%" . anti_injection($filtro["nome"]) . "%' ";
       if(isset($filtro["data"])) $sql .= "and data = '" . anti_injection($filtro["data"]) . "' ";
       $return["qtd"] = $this->db->query($sql)->row()->qtd;

       return (Object) $return;

    }

    public function getPeriodos($filtro=null)
    {   
        return $this->db->get("periodos")->result();

    }

    public function getTurmasPeriodos(){
      $sql = "SELECT t.id,concat(t.turma , ' - '  , p.descricao)  AS turma from turmas t inner join periodos p on p.id = t.id_periodo";
      return $this->db->query($sql)->result();
    }

    public function getEventosById($id=null){
        return $this->db->get_where('eventos',["id"=>$id])->row();
    }

    public function alterarDados($post,$id){
       
        $post = (Object) $post;

        $data = [
            'nome' => $post->nome,
            'resumo' => $post->resumo,
            'descricao' => $post->descricao,
            'hr_inicial' => $post->hr_inicial,
            'hr_termino' => $post->hr_termino,
            'imagem' => ($post->imagem) ? $post->imagem : '',
            'data' => $post->data_evento,
            'turma' => $post->turma,
            'dt_alteracao' => date('Y-m-d H:i:s')
        ];

        $this->db->where('id',$id);

        return $this->db->update("eventos", $data);
    }

    public function inserirDados($post){

        $post = (Object) $post;

        $data = [
            'nome' => $post->nome,
            'resumo' => $post->resumo,
            'descricao' => $post->descricao,
            'hr_inicial' => $post->hr_inicial,
            'hr_termino' => $post->hr_termino,
            'imagem' => ($post->imagem) ? $post->imagem : '',
            'data' => $post->data_evento,
            'turma' => $post->turma,
            'dt_cadastro' => date('Y-m-d H:i:s')
        ];

        if($this->db->insert('eventos', $data)){
            $id = $this->db->insert_id();
            return $id;
        }
        return false;
    }

    public function buscaPorLogin($login){
        
        $this->db->where("login", $login);
        return $usuario = $this->db->get("usuarios")->row();
    }



}
