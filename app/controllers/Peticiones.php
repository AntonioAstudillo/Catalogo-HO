<?php


class Peticiones extends Controlador{

   private $modelo;

   public function __construct(){
      $this->modelo = $this->modelo('ProductoModel');
   }


   /**
    * [getMarcas Obtenemos un JSON con todas las marcas de nuesta BD para poder generar el select dentro de busqueda personalizada. Este metodo lo utilizamos dentro de una peticion asincrona  ]
    * @return [JSON] [MARCAS]
    */
   public function getMarcas(){
      header('Content-Type: application/json');
      $data = $this->modelo->getMarcas();
      echo json_encode($data);
   }




   /**
    * [getMarcas Obtenemos un JSON con todas las submarcas de nuesta BD para poder generar el select dentro de busqueda personalizada. Este metodo lo utilizamos dentro de una peticion asincrona  ]
    * @return [JSON] [MARCAS]
    */
   public function getSubMarcas()
   {
      if(isset($_POST['marca']))
      {
         header('Content-Type: application/json');
         $data = $this->modelo->getSubMarcas($_POST['marca']);
         echo json_encode($data);
      }
   }

   /*Metodo utilizado para generar el listBox dentro del modulo de busqueda rapida */
   public function listBox()
   {
      header('Content-Type: application/json');
      $data = $this->modelo->mostrarContenido();

      $array = array();

      foreach ($data as $key)
      {

         if($key['familia'] != '')
         {
            $array[] = $key['familia'];
         }

         if($key['codigo'] != '')
         {
            $array[] = $key['codigo'];
         }

         if($key['fmsi'] != '')
         {
            $array[] = $key['fmsi'];
         }

         if($key['balata'] != ''){
            $array[] = $key['balata'];
         }

         if($key['diametroInterior'] != ''){
            $array[] = $key['diametroInterior'];
         }

         if($key['diametro'] != ''){
            $array[] = $key['diametro'];
         }

      }

      echo json_encode($array);
   }
}



 ?>
