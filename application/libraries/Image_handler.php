<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Image_handler{	
	    
	    protected $CI;

	    public function __construct()
		{
			$this->CI =& get_instance();
			$this->CI->load->helper('functions');
		}

	    public function convert2md5($src){//gera hash da imagem
			$imgBin = @file_get_contents($src);
			$md5 = md5($imgBin);
			return $md5;
	    }
		
		public function upload_file($nome_input_file, $path='./assets/img/uploads/', $name=null,$types="jpg|jpeg|png"){			
			try{
				if(!is_dir($path)) mkdir($path, 0777, true);
				
				$date = date_create();//pegando data
				$date_unix = ($name) ? $name : date_timestamp_get($date);//gerando Unix
				
				$file_ext = pathinfo($_FILES[$nome_input_file]["name"], PATHINFO_EXTENSION);				

				$config['upload_path']      = $path;
				$config['allowed_types']    = $types;
				$config['max_size']         = 10*1024*1024; //10mb	
				$config['file_name']		= $date_unix .'.'. $file_ext;	
				$config['overwrite']		= false;

				$this->CI->load->library('upload', $config);

				if ( ! $this->CI->upload->do_upload($nome_input_file)){
					return array('status'=> false,'error' => $this->CI->upload->display_errors("",""));				
				}else{
					return array('status'=> true,'upload_data' => $this->CI->upload->data());			
				}
			}catch(Exception $e){
				throw new Exception($e->getMessage());
			}
		}

		//gera uma thumb de uma image
		public function thumb($full_path, $imagem=NULL, $width=100, $height=75, $geratag=TRUE)
		{	

			if (!file_exists($full_path . $imagem)) {
				return false;
			}

			$path_thumb = explode('/', $full_path);

			array_pop($path_thumb);

			$caminho = implode('/', $path_thumb) . '/thumbs/';		

				

			if(!is_dir($caminho)) mkdir($caminho);

			$this->CI->load->helper('file');
			 			
			$thumb = $height.'x'.$width.'_'.$imagem;

			$thumbinfo = get_file_info($caminho.$thumb);

			$retorno = 'error';

			if($thumbinfo!=FALSE)
			{
				$retorno = base_url($caminho.$thumb);

			}else{

				$this->CI->load->library('image_lib');
				$config['image_library'] = 'gd2';
				$config['source_image'] = $full_path .'/'. $imagem;			
				$config['new_image'] = $caminho . $thumb;
				$config['maintain_ratio'] = TRUE;
				$config['width'] = $width;
				$config['height'] = $height;
				$this->CI->image_lib->initialize($config);
				if ($this->CI->image_lib->resize()) 
				{
					$this->CI->image_lib->clear();
					$retorno = base_url($caminho.$thumb);
				}else{
					$retorno =FALSE;
				}		
			}

			if($geratag && $retorno != FALSE) $retorno = '<img src="'.$retorno.'" alt="">';

			return $retorno;
		}

		public function resize_foto_medium($src){//proporções 800x600
			$config['image_library']	= 'gd2';
			$config['source_image']		= $src;
			$config['maintain_ratio']	= TRUE;//mantém largura e altura preservando a proporção original.
			$config['width']			= 800;
			$config['height']			= 800;//caso foto venha como retrato.
			
			$CI =& get_instance();
			$CI->load->library('image_lib');
			$CI->image_lib->initialize($config);
			$exec_recize = $CI->image_lib->resize();
			
			$CI->image_lib->clear();//limpa image_lib
			
			return $exec_recize;
		}
		
		
	}

/* End of file BR_Sistema */
/* Location: ./application/library/Image_handler.php */