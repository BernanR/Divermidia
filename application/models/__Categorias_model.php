<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias_model extends CI_Model {
    
    public function getCategorias($filtro=null)
    {   

      foreach ($filtro as $k => $v) if(strlen($v)===0) unset($filtro[$k]);

       $sql = "SELECT * from arquivos_categorias where excluido=0 ";      
       if(isset($filtro["nome"])) $sql .= "and titulo like '%" . anti_injection($filtro["nome"]) . "%' ";
       if(isset($filtro["data"])) $sql .= "and cast(dt_cadastro AS DATE) = '" . anti_injection($filtro["data"]) . "' ";
      
       if(isset($filtro["qtd_por_pag"])) $sql .= " limit " . $filtro["qtd_por_pag"];
       if(isset($filtro["page_init"])) $sql .= " offset " . $filtro["page_init"];

       $return["data_result"] = $this->db->query($sql)->result();

       //dd($sql);
       
       $sql = "SELECT count(*) qtd from arquivos_categorias where excluido=0 ";    
       if(isset($filtro["nome"])) $sql .= "and titulo like '%" . anti_injection($filtro["nome"]) . "%' ";
       if(isset($filtro["data"])) $sql .= "and dt_cadastro = '" . anti_injection($filtro["data"]) . "' ";
      
       $return["qtd"] = $this->db->query($sql)->row()->qtd;

       return (Object) $return;
    }

    public function inserirCategorias($file,$id){

      $data = [
            'id_categoria' => $id,
            'arquivo' => $file['file_name'],
            'ext' => str_replace(".", "", $file['file_ext']),
            'dt_cadastro' => date('Y-m-d H:i:s')
      ];

      $this->db->insert('arquivos_downloads', $data);

      return $this->db->insert_id();
    }

    public function getPeriodos($filtro=null)
    {   
      return $this->db->get("periodos")->result();
    }

    public function getTurmasPeriodos(){
      $sql = "SELECT t.id,concat(t.turma , ' - '  , p.descricao)  AS turma from turmas t inner join periodos p on p.id = t.id_periodo";
      return $this->db->query($sql)->result();
    }

    public function getCategoriasById($id=null){
        return $this->db->get_where('arquivos_categorias',["id"=>$id])->row();
    }

     public function getArquivoById($id=null){
        return $this->db->get_where('arquivos_downloads',["id"=>$id])->row();
    }

    public function getArquivosCategorias($id,$ext=null){

      
      $this->db->group_start();
      if($ext) {
        $array = explode(',', $ext);
        foreach ($array as $v) $this->db->or_like("ext", $v);
      }
      $this->db->group_end();
      
      $this->db->where('id_categoria', $id);

      return $this->db->get('arquivos_downloads')->result();
    }

    public function alterarDados($post){
       
        $post = (Object) $post;

        $data = [
            'turma' => $post->turma,
            'titulo' => $post->titulo,
            'resumo' => $post->resumo,
            'dt_alteracao' => date('Y-m-d H:i:s')
        ];

        $this->db->where('id',$post->id);
        return $this->db->update("arquivos_categorias", $data);
    }

    public function inserirDados($post){

        $post = (Object) $post;

        $data = [
            'turma' => $post->turma,
            'titulo' => $post->titulo,
            'resumo' => $post->resumo,
            'dt_cadastro' => date('Y-m-d H:i:s')
        ];

        if($this->db->insert('arquivos_categorias', $data)){
            $id = $this->db->insert_id();
            return $id;
        }
        return false;
    }

    public function inserirTituloFile($post){

      $post = (Object) $post;

      $data = [
        'titulo' => $post->titulo
      ];

      $this->db->where("id",$post->id);

      if($this->db->update('arquivos_downloads', $data)){            
        return true;
      }
      return false;
    }

    public function buscaPorLogin($login){
        
        $this->db->where("login", $login);
        return $usuario = $this->db->get("usuarios")->row();
    }



}
