<?php


class Administrador extends Controlador{

   private $modelo;

   public function __construct()
   {
      $this->modelo = $this->modelo('AdministradorModelo');
   }

   public function index(){
      $this->vista('loginVista');
   }
}



 ?>
