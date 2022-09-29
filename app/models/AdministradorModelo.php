<?php

class AdministradorModelo{
   function __construct(){
      //hago una instancia de la conexion para poder hacer operaciones a la base de datos
      $this->conexion = new Mysql();
   }   
}




 ?>
