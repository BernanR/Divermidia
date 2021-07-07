<?php

/**
 *  PerfilController é o controlador para o gerenciamento dos dados dos usuarios.
 * Aqui o usuário pode trocar sua senha e outras informações relevantes
 * 
 */
// Verifica se o BASEPATH está definido, caso contrário não carrega o controlador
if (!defined('BASEPATH'))    exit('No direct script access allowed');

class AD_Setting_controller extends CI_Controller {

    public $template = 'adm_template';
    public $module = 'admin/settings/';

    // Aqui é feito a reescrita da classe construtora e a verificação
    // da autenticidade do usuário
    public function __construct()
    {
        parent::__construct();

        is_logged();

        $this->load->model("Settings_model","Setting");
    }

    /**
     * Método invocado depois do método construtor 
     */

    /**
     * Método invocado depois do método construtor 
     */
    public function index()
    {
        $this->manage();
    }

    public function manage()
    {
        $data = [];

        if($this->input->get()) $filter = $this->input->get();

        // Quantidade de registro a serem mostrados por páginma
        $filter['qtd_by_pag'] = 50;

        /**
         * Bibliotecas e ajudantes carregados
         * @filesource system/libraries/pagination.php
         * @filesource application/model/usuariosModel.php
         */
        $this->load->library('pagination');
        
        /**
         * Dados passados por Get, para gerar a paginação
         * Se o segmento 4 existir, o mesmo será passado àos parãmetros
         */
        if ($this->uri->segment(4) == "")
        {
            $filter['page_init'] = 0;
        }
        else
        {
            $filter['page_init'] = $this->uri->segment(4);
        }

        // Metodo para selecionar e retornar os dados 
        // mediante os parametros passados
        $settings = $this->Setting->get($filter);

        //dd($dados);

        // Parâmetros para a biblioteca de paginação
        $config['base_url'] = base_url() . "/" . $this->uri->segment(1) . "/" . $this->uri->segment(2) . "/" . $this->uri->segment(3) . "/";
        $config['total_rows'] = $settings->qtd;
        $config['uri_segment'] = 4;
        $config['per_page'] = $filter['qtd_by_pag'];
        $config['first_tag_open'] = '<li class="page-item page-link">';
        $config['first_link'] = 'Início';
        $config['first_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='page-item active'><a class=\"page-link\"  href='javascript:void(0)'>";
        $config['cur_tag_close'] = '</a></li>';
        $config['last_tag_open'] = '<li class="page-item page-link">';
        $config['last_link'] = 'Fim';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item page-link">';
        $config['next_link'] = '>';
        $config['next_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li class="page-item page-link">';
        $config['num_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="page-item page-link">';
        $config['prev_link'] = '<';
        $config['prev_tag_close'] = '</li>';
        $config['full_tag_open'] = '<nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>  ';
        $this->pagination->initialize($config);
        $data['paginacao'] = $this->pagination->create_links();

        $data['settings'] = $settings->data_result;

        load_module(
            $this->module . "list",
            $data,
            $this->template
        );
    }

    /*
      Metodo para chamar a pagina de cadastro
     */

    public function create()
    {

        $data = [];

        load_module(
            $this->module . "create",
            $data,
            $this->template
        );

    }

    public function insert()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name','Nome','required');
        $this->form_validation->set_rules('value','Valor','required');


        if ($this->form_validation->run()) {

            if ($this->Setting->get([
                "key"=>$this->input->post('name')
            ])->qtd > 0) {

                  echo '<br><div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <strong>Erro!</strong> Já existe uma configuração criada com esse nome!
                      </div>';

                exit();
            }

            // Organizar array contendo os dados do usuário
            $dados = array(
                'key' => $this->input->post('name'),
                'value' => $this->input->post('value'),
                'note' => $this->input->post('note'),
                'created_dt' => date('Y-m-d H:i:s'),
                'updated_dt' => date('Y-m-d H:i:s'),
                'created_by' => user_logged('id'),
                'updated_by' => user_logged('id')
            );

            $id = $this->Setting->insert($dados);

            if($id){
                // Gerar Logs
                // $this->load->library('my_log');
                // $logs = new MY_Log();
                // $logs->setLogPath(APPPATH . "logs/" . user_logged('nome') . "/");
                // $logs->write_log('info', "O usuario cadastrou uma nova turma com o id: " . $id);


                set_msg('msgOk', "Configuração criada com sucesso!", $tipo='sucess');

                print "<script>window.location = '" . base_url() . "admin/settings/manage'</script>";

            }
        }else{
        
           
            echo get_erros_validation();

            exit();
        }
    }

    public function edit($id)
    {
        // Gerar Logs
        // $this->load->library('my_log');
        // $logs = new MY_Log();
        // $logs->setLogPath(APPPATH . "logs/" . user_logged('nome') . "/");
        // $logs->write_log('info', "O usuario acessou a area de atualizacao de turmas");

        $setting = $this->Setting->get([ "id" => $id ]);

        if (1 == $setting->qtd) {           
            
            $data = [];
            $data['setting'] = $setting->data_result;

            load_module(
                $this->module . "edit",
                $data,
                $this->template
            );


        } else {
            echo "errro";
            set_msg('msgOk', "id inválido!", $tipo='error');
            redirect('admin/settings/manage');
        }

    }

    public function delete($id){
        if (!user_logged('nivel') == 1){
            exit;
        }
        $this->Setting->delete($id);
        set_msg('msgOk', 'Configuração deletada com sucesso!', 'sucess');
        redirect('admin/settings/manage');
    }

    public function update()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('value','Valor','required');
        $this->form_validation->set_rules('id','ID','required');

        if ($this->form_validation->run()) {

            $data = array(
                'value' => $this->input->post('value'),
                'note' => $this->input->post('note'),
                'updated_dt' => date('Y-m-d H:i:s'),
                'updated_by' => user_logged('id')
            );

            $id = $this->input->post('id');
            $upate = $this->Setting->update($data, $id);

            if($upate){
                set_msg('msgOk', "Configuração atualizada com sucesso!", $tipo='sucess');
                print "<script>window.location = '" . base_url() . "admin/settings/manage'</script>";
            }
        }else{
        
           
            echo get_erros_validation();

            exit();
        }
    }

}