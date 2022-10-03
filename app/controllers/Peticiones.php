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



   //Peticiones generales utilizadas en el modulo de Administrador

   public function getPosiciones()
   {
      $this->modelo = $this->modelo('AdministradorModelo');
      header('Content-Type: application/json');
      $resultado = $this->modelo->getPosiciones();
      echo json_encode($resultado);
   }


   public function getDataMarcas()
   {

      if(isset($_POST['codigo']))
      {

        header('Content-Type: application/json');
        $this->modelo = $this->modelo('AdministradorModelo');
        $data = $this->modelo->getData($_POST['codigo']);

        echo json_encode($data);

      }
   }



   //Eliminamos un producto de la base de datos
   public function deleteProducto($producto)
   {

       $objeto = new ProductoModel();

       $producto['imagen'] = Sanitizar::limpiarCadena($producto['imagen']);
       $producto['codigo'] = Sanitizar::limpiarCadena($producto['codigo']);

       if($objeto->deleteProduct($producto['codigo'])>0){
          //eliminamos imagen si es que existe
          Sanitizar::deleteImg($producto['imagen']);
          return true;
       }
       else
       {
          return '0';
       }
   }



   public function getFamilias()
   {
      header('Content-Type: application/json');
      $resultado = $this->modelo->getAllFamily();
      echo json_encode($resultado);
   }



   public function getSubFamilias()
   {
      if(isset($_POST))
      {
        header('Content-Type: application/json');
        $resultado = $this->modelo->getSubFamiliaE($_POST['familia']);
        echo json_encode($resultado);

      }
      else
      {
         echo 'false';
      }
   }

}



 ?>
