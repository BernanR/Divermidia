<?php

// FOrmata data com dia da semana
function formata_data_extenso($strDate, $tipo = 1)
{
    // Array com os dia da semana em português;
    $arrDaysOfWeek = array('Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado');
    // Array com os meses do ano em português;
    $arrMonthsOfYear = array(1 => 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
    // Descobre o dia da semana
    $intDayOfWeek = date('w', strtotime($strDate));
    // Descobre o dia do mês
    $intDayOfMonth = date('d', strtotime($strDate));
    // Descobre o mês
    $intMonthOfYear = date('n', strtotime($strDate));
    // Descobre o ano
    $intYear = date('Y', strtotime($strDate));
    // Descobre o ano
    $intHora = date('H', strtotime($strDate));
    $intMIn = date('i', strtotime($strDate));
    // Formato a ser retornado
    if ($tipo == 1)
    {
        return $arrDaysOfWeek[$intDayOfWeek] . ', ' . $intDayOfMonth . ' de ' . $arrMonthsOfYear[$intMonthOfYear] . ' de ' . $intYear . ' às ' . $intHora . ':' . $intMIn;
    }
    else
    {
        return $arrDaysOfWeek[$intDayOfWeek] . ', ' . $intDayOfMonth . ' de ' . $arrMonthsOfYear[$intMonthOfYear] . ' de ' . $intYear;
    }
}

function first_name($str){
    $part = explode(" ", $str);
    return $part[0];
}

/**
 * 
 * Retorna data no formata especificado
 * 
 * @param String $data
 * @param Int $formato
 * @return String
 */
function formata_data($data, $formato)
{
    if ($formato == 1)
    {
        // Retorno 9999-99-99
        $retorno = str_replace("/", "-", $data);
        $retorno = str_replace(" ", "-", $retorno);
        $retorno = explode("-", $retorno);
        return $retorno[2] . "-" . $retorno[1] . "-" . $retorno[0];
    }
    if ($formato == 2)
    {
        // Retorno 9999-99-99
        $retorno = str_replace("/", "-", $data);
        $retorno = str_replace(" ", "-", $retorno);
        $retorno = explode("-", $retorno);
        return $retorno[2] . "/" . $retorno[1] . "/" . $retorno[0];
    }
    if($formato == 3){
        $dt_hrs = explode(" ", $data);
        $dt_parts = explode("-",$dt_hrs[0]);
        return  $dt_parts[2] . "/" . $dt_parts[1] . "/" . $dt_parts[0] . " às " . $dt_hrs[1];
    }
}

function dd($var,$exit=FALSE){
    echo "<pre style:border:1px solid #ccc;>";
    print_r($var);
    echo "</pre>";

    if($exit == TRUE){
        exit();
    }
}


function get_erros_validation($first_only=true){
    if ($first_only) {
        $string_erros = validation_errors('|');
        $list_erros = explode('|', $string_erros);
        $erros = [];

        foreach ($list_erros as $value) {
            if ($value != '') {
                array_push($erros, trim($value));
            }
        }

        $button = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";

        if (count($erros) > 0) {
            return '<p class="alert alert-danger">' .$button . $erros[0].'</p>';
        }
        
        return '';

    } else {
        return  validation_errors('
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Erro! </strong>',
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
    }
    
}


//verifica se o usuário esta logado no sistema
//NO FUTURO CORRIGIR ESSA FUNÇÃO, CREATE SESSION PODE DAR PROBLEMAS
function is_logged($redir=TRUE)
{
    $CI =& get_instance();  
    $user = $CI->session->userdata('usuario_logado');

    if (!isset($user) /*|| $user_status != TRUE*/) 
    {
        $CI->session->sess_destroy();
        //$CI->session->sess_create();


        if ($redir) 
        {
            $CI->session->set_userdata(array('redir_para'=>current_url()));
            //set_msg('danger','Acesso restrito, faça login antes de prosseguir','error');
            redirect('login');
        }

        return FALSE;
    }
    else
    {
        return TRUE;
    }
}

function user_logged($param=null){
    $CI =& get_instance();
    $session = $CI->session->userdata('usuario_logado');

    if($param==null){
        return $session;
    }else{
        if(!isset($session[$param])){echo 'Não existe esse parametro'; dd($session);/*exit();*/}
        return $session[$param];
    }
}

function load_module($modulo=NULL, $data=NULL, $template="web_template"){
    $CI =& get_instance();

    $diretorio = explode('.', $modulo);
    $diretorio = implode('/', $diretorio);

    $data["module"] = $diretorio;    
    $data['page'] = $diretorio;

    if (! key_exists('ckeditor', $data)) {

        $data["ckeditor"] = false;
    }

    if( $modulo!=NULL )
    {
        $CI->load->view($template, $data);
    
    }else{

        return FALSE;
    }
}

function media_load(){
    $CI =& get_instance();
    $CI->load->view('admin/media/media_modal_ajax');
}

//define uma mensagem para ser exibida na próxima tela carregada
function set_msg($id='msgerro',$msg,$tipo,$flas=true){

    $CI =& get_instance();
    $button = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";

    switch ($tipo) {
        case 'error':
            if(!$flas) return '<p class="alert alert-danger">' .$button . $msg.'</p>';
            $CI->session->set_flashdata($id,'<p class="alert alert-danger">' .$button . $msg.'</p>');            
        break;
        case 'sucess':
            if(!$flas) return '<div class="alert alert-success">'. $button . " <strong>Sucesso! </strong>" . $msg.'</div>';
            $CI->session->set_flashdata($id,'<div class="alert alert-success">'. $button . " <strong>Sucesso! </strong>" . $msg.'</div>');
        break;
        case 'info':
            if(!$flas) return '<div class="alert alert-info">'. $button . " <strong>Atenção! </strong>" . $msg.'</div>';
            $CI->session->set_flashdata($id,'<p class="alert alert-info">'.$msg.'</p>');
        break;
        case 'warning':
            if(!$flas) return '<div class="alert alert-warning">'. $button . " <strong>Atenção! </strong>" . $msg.'</div>';
            $CI->session->set_flashdata($id,'<p class="alert alert-warning">'.$msg.'</p>');
        break;
        
        default:
             if(!$flas) return '<div class="alert alert-primary">'. $button . " <strong>Atenção! </strong>" . $msg.'</div>';
        break;
    }
}

function get_msg($id, $printar=TRUE)
{   
    $CI =& get_instance();      
    if ($CI->session->flashdata($id))
    {

        if ($printar) {
            return $CI->session->flashdata($id);            
        }
        else
        {
            return $CI->session->flashdata($id);
        }
    }
    //return FALSE;
}

    
// remove palavras que contenham sintaxe sql
function anti_injection($sqlinj)
{
    $sqlinj = preg_replace("/(from|select|insert|delete|where|drop table|show tables|#|hi|'|´|\*|--|\\\\)/i", '', $sqlinj);
    $sqlinj = trim($sqlinj); //limpa espaços vazio
    $sqlinj = strip_tags($sqlinj); //tira tags html e php
    return $sqlinj;
}


function init_editorhtml()
{
    echo "
            <script src=\"" . base_url() . "assets/lib/ckeditor/ckeditor.js\"></script>
            <script src=\"" .base_url(). "assets/lib/ckeditor/config.js\"></script>

            <script>
                setInterval(function(){ 
                    if ($(\".cke_inner\").hasClass(\"cke_maximized\")) {
                        $(\"button[type=submit]\").addClass(\"cke_maximized_btn\")
                    } else {
                        $(\"button[type=submit]\").removeClass(\"cke_maximized_btn\")
                    } 
                },50)
            </script>

        ";
    
        // <script src=\"assets/lib/ckeditor/styles.js\"></script>
}


function delete_midia($arquivo, $pasta="") {
    if(file_exists($pasta . "/" . $arquivo)){
        array_map('unlink', glob( $pasta . "/" . $arquivo));
        array_map('unlink', glob( $pasta . "/*/*" . $arquivo));
    }
}

function gerar_thumb($arquivo,$width=null,$height=null,$path,$gerar_tag=true){  
    //$arquivo = 'no-image.png';
    $CI =& get_instance();
    $CI->load->library('Image_handler');
    if(!$gerar_tag) return $CI->image_handler->thumb($path, $arquivo,$width,$height,$gerar_tag);
    return $CI->image_handler->thumb($path . '/',$arquivo,$width,$height, TRUE);
}

function resumo($string=NULL,$palavras=50,$decodifica_html=TRUE,$remove_tags=TRUE)
{
    if ($string!=NULL) 
    {
        if ($decodifica_html) $string = to_html($string);
        if ($remove_tags) $string = strip_tags($string);
        $retorno = word_limiter($string,$palavras);
    }else{
        $retorno = FALSE;
    }
    return $retorno;
}

function to_html($string=NULL)
{
    return html_entity_decode($string);

}


function slug($string=NULL,$delimiter='-',$tabela=null,$index=0)
{
	if($string == null || $string == '') return '';

 	$string = remove_acento($string);
 	$slug =  url_title($string,$delimiter,TRUE) . (($index > 0)? $delimiter.$index :  null);

 	if($tabela){

	 	$CI =& get_instance();	

	 	$row = $CI->db->get_where($tabela,['slug'=>$slug])->row();

	 	if($row){
	 		$index++;
	 		return slug($string,$delimiter,$tabela,$index);
	 	}else{
	 		return $slug;
	 	}

	 }else{

	 	return $slug;

	 }
}

function remove_acento($string=NULL){
	return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/"),explode(" ","a A e E i I o O u U n N c c"),$string);
}


function img_url($path=null) {
    return base_url('assets/img/' . $path);
}

function get_config_site() {
    $CI =& get_instance();

    $CI->load->model("Settings_model","Setting");

    $data_config = $CI->Setting->get()->data_result;
   
    $config = [];
    foreach ($data_config as $v) {
        $config[$v->key] = $v->value;
    }

    return (object) $config;    
}

function get_banners_site($key=null) {
    $CI =& get_instance();

    $CI->load->model("Media_model","Media");

    $data_banners = $CI->Media->get()->data_result;

    $banners = [];
    foreach ($data_banners as $v) {
        $banners[$v->key] = [$v->file, $v->title];
        if(isset($v->mobile_file)) array_push($banners[$v->key], 'hasMobile', $v->mobile_file );        
    }

    if ($key !== null) return ( isset($banners[$key])) ? $banners[$key] : null;  
    
    return $banners;
}

function get_ext_file ($file) {
    if ($file['size'] > 0) {        
        $ext = end(explode('.', $file['name']));
        return $ext ? $ext : false;
    }

    return false;
}


function get_menus() {
    $CI =& get_instance();

    $CI->load->model('Menus_model','Menus');

    return $CI->Menus->getActivedMenus();
}

function replaceUrlImg($content){//content que vem de pages
     $domains = [
      'http://localhost/righi-righi/',
      'http://srv242.teste.website/~righirighicom'
    ];//CASO SURJAM MAIS DOMÍNIOS, COLOCAR NESSA ARRAY
    
    $url_base = base_url();
    foreach($domains as $domain){
        if( strpos($content, $domain) ){
            $content = str_replace($domain, $url_base, $content);
        }
    }

    return $content;

}

function hasProductCart($product_id){
    $CI =& get_instance();
    $CI->load->library('cart');
    $cartContents = $CI->cart->contents(md5($product_id));

    if ($cartContents) {        
        foreach($cartContents as $cartItem){
            if($product_id === $cartItem['id']  ) return true;           
        }
    }

    return false;
}


function createCaptcha(){
    $CI =& get_instance();
    $CI->load->helper('captcha');

    $vals = array(
        'word'          => getRandomWord(6),
        'img_path'      => './captcha/',
       // 'font_path'     => './path/to/fonts/texb.ttf',
        'img_url'       => base_url() . 'captcha/',
        'img_width'     => '150',
        'img_height'    => 40,
        'expiration'    => 7200,
        'word_length'   => 35,
        'font_size'     => 18,
        'img_id'        => 'Imageid',
        'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

        // White background and border, black text and red grid
        'colors' => array(
            'background' => array(255, 255, 255),
            'border' => array(255, 255, 255),
            'text' => array(0, 0, 0),
            'grid' => array(255, 40, 40)
        )
    );

    $cap = create_captcha($vals);//se der b.o -> ver permissões da pasta /captcha!

    
    $data = array(
        'captcha_time'  => $cap['time'],
        'ip_address'    => $CI->input->ip_address(),
        'word'          => $cap['word']
    );
    $query = $CI->db->insert_string('captcha', $data);
    $CI->db->query($query);
    

    return $cap;
}

function validcaptha($cap){
    $CI =& get_instance();
    $CI->load->helper('captcha');
    // First, delete old captchas
    $expiration = time() - 7200; // Two hour limit
    $CI->db->where('captcha_time < ', $expiration)->delete('captcha');

    // Then see if a captcha exists:
    $sql = 'SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?';
    $binds = array($cap, $CI->input->ip_address(), $expiration);
    $query = $CI->db->query($sql, $binds);
    $row = $query->row();
        
    return $row->count == 0 ? false : true; 
}

function getRandomWord($len = 10) {
    $word = array_merge(range('a', 'z'), range('A', 'Z'));
    shuffle($word);
    return substr(implode($word), 0, $len);
}

function brand_banner($file_name, $isMobile=false ){
    return !$isMobile ? base_url("assets/img/banners/brands/$file_name") :  base_url("assets/img/banners/brands/mobile/$file_name");
}

function isImage($mediaPath){
    return @is_array(getimagesize($mediaPath)) ? true : false;
}

function getCustomersLogo(){
    $CI =& get_instance();
    $CI->load->model("Gallery_model","Gallery");

    $data = $CI->Gallery->get(['id' => 1]);
    if ($data->qtd > 0) $images = json_decode($data->data_result[0]->json);   

    return orderGalleryJson($images);
}

function removeBar($str){   
    return str_replace('/', '',$str);
}

function getGallery($id, $gerarHtml=true) {
    $CI =& get_instance();
    $CI->load->model("Gallery_model","Gallery");

    $data = $CI->Gallery->get(['id' => $id]);
    if ($data->qtd == 0) return false;

    $files = json_decode($data->data_result[0]->json);

    $config = [
        'lightbox' => $data->data_result[0]->lightbox
    ];
    
    //ordenando array
    $files = orderGalleryJson($files);
    if ($data->data_result[0]->carousel == 1 && $gerarHtml) return getCarouselGallery($files, $config);
    return $files;
}


function getCarouselGallery($files, $config) {
    $html = "<div id=\"owl-carousel-pages\" class=\"owl-carousel carousel owl-theme\">";

    foreach ($files as $file) {
        //$html .= "<li class=\"item\">";
        if ( $config['lightbox']) {
            $html .= "<a href=\"" . base_url('assets/img/gallery/'. $file->file.'') . "\"
                data-lightbox=\"" . $file->file . "\"
                data-title=\"" . (($file->title) ? $file->title : $file->file)  . "\"
                class=\"link-preview\">";
        }

        $html .= "<img src=\"". gerar_thumb($file->file, 400, 400, 'assets/img/gallery/', false) . "\" alt=\"" . $file->title . "\" title=\"" . $file->title . "\" />";
        if ( $config['lightbox']) $html .= "</a>";
        //$html .= "</li>";
    } 
    $html .= "</div>";
    return $html;

}

function cmp($a, $b) {
	return $a['ordem'] > $b['ordem'];
}


function orderGalleryJson($images){

    $array = [];
    foreach($images as $image) {
        if (!isset($image->ordem)) $image->ordem = 1;
        if ($image->ordem == '') $image->ordem = 1000;
        $array[] = (array) $image;
    }

    usort($array, 'cmp');
    $ordem = [];
    foreach($array as $image) {
        if ($image['ordem'] == 1000) $image['ordem'] = '';
        $ordem[] = (object) $image;
    }
 
    return $ordem;
}


//base_url('assets/img/gallery/' . $file->file)
function replaceQuotes($str){
    return addcslashes($str, '"');
}
