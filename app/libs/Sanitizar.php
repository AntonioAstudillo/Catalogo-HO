<?php


class Sanitizar{

   public static function limpiarCadena($cadena)
   {
      $cadena = trim($cadena);
      $cadena = filter_var($cadena , FILTER_SANITIZE_STRING);
      $cadena = strip_tags($cadena);

      return $cadena;
   }


   public static  function validarRecaptcha($token)
   {
      $objeto = curl_init();
      curl_setopt($objeto , CURLOPT_URL , "https://www.google.com/recaptcha/api/siteverify");
      curl_setopt($objeto , CURLOPT_POST , 1);
      curl_setopt($objeto , CURLOPT_POSTFIELDS, http_build_query(array('secret' => CLAVE , 'response' =>$token)));
      curl_setopt($objeto , CURLOPT_RETURNTRANSFER , true);
      $response = curl_exec($objeto);
      curl_close($objeto);

      //convertimos a json
      $datos = json_decode($response , true);

      //validamos el score
      if($datos['success'] == 1 && $datos['score']> 0.5){
         return true;
      }else{
         return false;
      }
   }//cierra funcion validarRecaptcha


   /*Esta función me va servir para poder llenar el campo fecha dentro de la tabla usuarios */
   public static function getTimeStamp(){
      date_default_timezone_set('America/Mexico_City');
      return date('Y-m-d h:i:s');
   }
}




 ?>
