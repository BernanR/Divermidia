<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {
    
    public function GetUsuarios($filtro=null)
    {   
      
       $sql = "SELECT * from usuarios where 1=1 ";      
       if(isset($filtro["nome"])) $sql .= "and nome like '%" . $filtro["nome"] . "%' ";
       if(isset($filtro["qtd_por_pag"])) $sql .= " limit " . $filtro["qtd_por_pag"];
       if(isset($filtro["page_init"])) $sql .= " offset " . $filtro["page_init"];

       $return["data_result"] = $this->db->query($sql)->result();

       $sql = "SELECT count(*) qtd from usuarios  where 1=1 ";      
       if(isset($filtro["nome"])) $sql .= "and nome like '%" . $filtro["nome"] . "%' ";
       $return["qtd"] = $this->db->query($sql)->row()->qtd;

       return (Object) $return;

    }

    public function getUsuariosById($id=null){
        return $this->db->get_where('usuarios',["id"=>$id])->row();
    }

    public function editarDados($post){

      $array = array(
        'nome' => $post['nome'],
        'email' => $post['email']
      );
      
      if ($post['senha'])  $array['senha'] = md5($post['senha']);
     
      $this->db->where('id',$post['id']);
      return $this->db->update("usuarios", $array);
    }

    public function inserirDados($user,$cadastro=false){

      $user = (Object) $user;

        $data = array(
            'nome' => $user->nome,
            'usuario' => $user->login,
            'email' => $user->email ,
            'senha' => md5($user->senha),
            'nivel' => $user->nivel,
            'dt_cadastro' => date("Y-m-s H:i:s"),
            'dt_cadastro' => date("Y-m-s H:i:s"),
            'dt_alteracao' => date("Y-m-s H:i:s"),
            'status' => 1
        );


        if($this->db->insert('usuarios', $data)){
          $id = $this->db->insert_id();
        }else{
          return (Object) ["status"=>false];
        }

        if($cadastro) $this->inserirCadastroUsuario($user,$id);

        return (Object) ["status"=>true,"id"=>$id];
    }

    private function inserirCadastroUsuario($dados,$id){

      $data = array(
          'id_usuario' => $id,
          'celular' => $dados->celular,
          'telefone' => $dados ->telefone,
          'cep' => $dados->cep,
          'rua' => $dados->rua,
          'bairro' => $dados->bairro,
          'cidade' => $dados->cidade,
          'uf' => $dados->uf,
          'dt_cadastro' => date("Y-m-s H:i:s"),
          'dt_alteracao' => date("Y-m-s H:i:s")
      );

      $this->db->insert('usuarios_cadastro', $data);

    }

    public function buscaPorLogin($login){
        
        $this->db->where("login", $login);
        return $usuario = $this->db->get("usuarios")->row();
    }



}
