<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Autenticar_usuario_model extends CI_Model
{
    private $usuario;
    private $senha;
    private $dadosAutenticados;
    
    /**
     * Seta o usuario
     * @param String
     * @return NULL
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * Seta a senha
     * @param String
     * @return NULL
     */
    public function setSenha($senha)
    {
        $this->senha = md5($senha);
    }

    /**
     * Retorno da autenticacao do usuario
     * @return boolean
     */
    public function getDadosAutenticados()
    {
        $this->autenticaUsuario();
        return $this->dadosAutenticados;
    }

    /**
     * @return Boolean
     */
    private function autenticaUsuario()
    {
        // Verica se o usuário e senha foram digitados
        if ($this->usuario && $this->senha)
        {
            
            $sql = "select *
                    from usuarios 
                    where status = 1 
                    and senha = '" . $this->senha . "'
                    and (
                        usuario = '" .anti_injection($this->usuario) ."' 
                        or email = '" .anti_injection($this->usuario) ."' 
                    )";

            $user_logged = $this->db->query($sql)->row();
            
            if ($user_logged)
            {
                $array = array(
                    'id' => $user_logged->id,
                    'dt_acesso' => date("Y-m-d H:i:s")
                );
                
                $this->db->update('usuarios',[ 
                    'dt_acesso' => date("Y-m-d H:i:s")],
                    ["id" => $user_logged->id 
                ]);

                $this->dadosAutenticados = $user_logged;
            }
        }
    }
}

