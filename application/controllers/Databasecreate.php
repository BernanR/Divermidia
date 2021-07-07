<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Databasecreate extends CI_Controller {

    public function index(){
      die;
      echo '<script>console.log("entrou")</script>';
      $file = file('./sql/strutechdb.sql');

      foreach ($file as $key => $value) {
        if (in_array(trim(substr($value,0,1)), ['-','/'] )) {
          unset($file[$key]);
        }
      }

      $script = implode($file);

      //$script = str_replace('IF NOT EXISTS', '', $script);

      //dd($script);
      //die;
      
      $sql = explode(';', $script);

      foreach ($sql as $k => $v) {
        if(trim($v) != '') {
          $dbhost = 'localhost';
          $dbuser = 'root';
          $dbpass = '';
          
          if($k > 1){
          $conn = mysqli_connect($dbhost, $dbuser, $dbpass, 'strutechdb');
          }else{
            $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
          }
          
          
          if(! $conn ){
            echo 'Connected failure<br>';
          }
          //ech o 'Connected successfully<br>';
          //$sql = "DROP DATABASE strutechdb";
          
          
          if (mysqli_query($conn, $v)) {
            echo $k . "  - Record executed successfully<br>";
          } else {
            echo $k . "  - Error deleting record: " . mysqli_error($conn) . '<br>';
          }
          mysqli_close($conn);
        }
      }
    }




}