<?php
/*
* CONFIGURAÇÕE DE CONEXÃO COM BANCO DE DADOS
* Atualize as configurações abaixo caso necessário, porém
* as mesmas já foram geradas por meio do Install de iniciação
*/




if($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == 'divermidia.local'){	
	
	define('HOSTNAME', 'localhost');
	define('USERNAME', 'root');
	define('PASSWORD', '');
	define('DATABASE', 'divermidia_db');
	//define('PORTA', '3306');

}else{
	define('HOSTNAME', 'localhost');
	define('USERNAME', 'divermid_user');
	define('PASSWORD', '-[h3[ZGfXY,!');
	define('DATABASE', 'divermi1_db');
	//define('PORTA', '3306');
}