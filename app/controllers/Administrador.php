<?php

session_start();

class Administrador extends Controlador{

   private $modelo;
   private $bandera;

   public function __construct()
   {

      if(isset($_SESSION['sesionHO1']))
      {
         $this->modelo = $this->modelo('AdministradorModelo');
         $this->bandera = true;
      }
      else
      {
         $this->bandera = false;
         $opciones = [
            'cost' => 8
         ];

         $token = password_hash( uniqid(true) . time() , PASSWORD_BCRYPT , $opciones  );

         $data = ['token' => $token];

         $this->vista('loginVista' , $data);

         header("Location:".RUTA . 'producto/login');
      }

   }


   public function index()
   {
      if($this->bandera)
      {
         $familias = $this->modelo->getFamilias();
         $subfamilias = $this->modelo->getSubFamilias();
         $catalogos = $this->modelo->getCatalogos();
         $posiciones = $this->modelo->getPosiciones();
         $lados = $this->modelo->getLados();
         $marcas = $this->modelo->getMarcas();
         $submarcas = $this->modelo->getSubMarcas();

         $data = [
            'familias' => $familias,
            'subfamilias' => $subfamilias,
            'catalogos' => $catalogos,
            'posiciones' =>$posiciones,
            'lados' =>$lados,
            'marcas' => $marcas,
            'submarcas' =>$submarcas
         ];


         $this->vista('adminVista' , $data);
      }


   }


   /*
      ***************************************************************************************************
         METODOS CRUD
      ***************************************************************************************************
   */

   //obtenemos todos los productos y retornamos un json para dibujarlo en el datatable del adminVista
   public function all(){
      header('Content-Type: application/json');
      $productos = $this->modelo->getProductos();
      echo json_encode($productos);
   }

   //Metodo utilizado para registrar un producto
   public function crearProducto()
   {
      $data = $_POST;
       //limpiamos datos y los mandamos al modelo
       $data['codigoR'] =  (isset($data['codigoR']) ) ?  Sanitizar::limpiarCadena($data['codigoR']) : '';
       $data['familiaR'] =  (isset($data['familiaR']) ) ?  Sanitizar::limpiarCadena($data['familiaR']) : '';
       $data['subfamiliaR'] =  (isset($data['subfamiliaR']) ) ?  Sanitizar::limpiarCadena($data['subfamiliaR']) : '';
       $data['posicionR'] =  (isset($data['posicionR']) ) ?  Sanitizar::limpiarCadena($data['posicionR']) : '';
       $data['empaqueR'] =  (isset($data['empaqueR']) ) ?  Sanitizar::limpiarCadena($data['empaqueR']) : '';
       $data['uxvR'] =  (isset($data['uxvR']) ) ?  Sanitizar::limpiarCadena($data['uxvR']) : '';
       $data['diamIntR'] =  (isset($data['diamIntR']) ) ?  Sanitizar::limpiarCadena($data['diamIntR']) : '';
       $data['equivalenteR'] =  (isset($data['equivalenteR'])) ?  Sanitizar::limpiarCadena($data['equivalenteR']) : '';
       $data['oemR'] =  (isset($data['oemR']) ) ?  Sanitizar::limpiarCadena($data['oemR']) : '';
       $data['cubrePolvoR'] =  (isset($data['cubrePolvoR']) ) ?  Sanitizar::limpiarCadena($data['cubrePolvoR']) : '';
       $data['catalogosR'] =  (isset($data['catalogosR']) ) ?  Sanitizar::limpiarCadena($data['catalogosR']) : '';
       $data['descripcionR'] =  (isset($data['descripcionR']) ) ?  Sanitizar::limpiarCadena($data['descripcionR']) : '';
       $data['marcaR'] = (isset($data['marcaR'])) ? $data['marcaR'] : 'null';
       $data['submarcasR'] = (isset($data['submarcasR'])) ? $data['submarcasR'] : '';
       $data['modeloR'] = (isset($data['modeloR'])) ? $data['modeloR'] : '';
       $data['fmsiR'] = (isset($data['fmsiR'])) ? $data['fmsiR'] : '';
       $data['balataR'] = (isset($data['balataR'])) ? $data['balataR'] : '';
       $data['alturaR'] = (isset($data['alturaR'])) ? $data['alturaR'] : '';

       if($data['marcaR'] == 'null')
       {
         echo 'falla';
         die();
      }
      else
      {
         //comprobamos que el codigo ingresado, no exista
         if($this->modelo->thereAreCode($data['codigoR']) > 0)
         {
           return 'repetido';
         }
         else
         {

           if( isset($data['familiaR']) && $data['familiaR'] == '')
           {
             return 'not';
           }
           else
           {
             //comprobamos si hay imagen, para guardarla
             if(!empty($_FILES['imagenProductR']['name']))
             {

                $file_name = $_POST['codigoR'] . '.jpg';
                $upload_location = 'img/productos/' . $file_name;
                $image_size = $_FILES['imagenProductR']['size'];

                if($image_size < 2 * 1024 * 1024)
                {

                   if(move_uploaded_file($_FILES['imagenProductR']['tmp_name'] , $upload_location))
                   {

                       if($this->crearMarcaDeAgua($file_name))
                       {
                         $data['imagen'] = $file_name;
                         if($this->modelo->createProduct($data))
                         {
                            echo 'true';
                         }else{
                            echo 'false';
                         }
                       }
                       else{
                         echo 'false';
                       }
                   }
                }
             }
             else
             {
              $data['imagen'] = 'N/D';
              return $this->modelo->createProduct($data);
             }
           }

         }
      }
   }



   //Eliminados un registro dentro de la tabla productodetalle
   public function deleteProductoDetalle($id)
   {
      $consulta = "DELETE FROM productodetalle WHERE id = ?";
      $statement = $this->conexion->prepare($consulta);
      $statement->execute(array($id['id']));

      return $statement->rowCount();
   }



   //Eliminamos un producto de todas las tablas, para que no quede basura dentro de nuestra base de datos.
   public function deleteProduct()
   {
      if(isset($_POST['codigo']))
      {
         $this->modelo = $this->modelo('ProductoModel');
         $producto['imagen'] = Sanitizar::limpiarCadena($_POST['imagen']);
         $producto['codigo'] = Sanitizar::limpiarCadena($_POST['codigo']);

         if($this->modelo->deleteProduct($_POST['codigo']))
         {
            //eliminamos imagen si es que existe
            $this->deleteImg($producto['imagen']);
            echo  true;
         }
         else
         {
            echo false;
         }
      }else{
         echo false;
      }
   }



   public function actualizarProducto()
   {
      $data = $_POST;
      $respuesta = true;

       //debemos limpiar todos los datos
       $data['codigo'] = Sanitizar::limpiarCadena($data['codigo']);
       $data['lado'] = Sanitizar::limpiarCadena($data['lado']);
       $data['empaque'] = Sanitizar::limpiarCadena($data['empaque']);
       $data['familia'] = Sanitizar::limpiarCadena($data['familia']);
       $data['grupo'] = Sanitizar::limpiarCadena($data['grupo']);
       $data['diametroInterior'] = Sanitizar::limpiarCadena($data['diametroInterior']);
       $data['posicion'] = Sanitizar::limpiarCadena($data['posicion']);
       $data['pistonEditar'] = Sanitizar::limpiarCadena($data['pistonEditar']);
       $data['cubrePolvoEdit'] = Sanitizar::limpiarCadena($data['cubrePolvoEdit']);
       $data['oem'] = Sanitizar::limpiarCadena($data['oem']);
       $data['equivalente'] = Sanitizar::limpiarCadena($data['equivalente']);
       $data['uxv'] = Sanitizar::limpiarCadena($data['uxv']);
       $data['catalogo'] = Sanitizar::limpiarCadena($data['catalogo']);
       $data['descripcion'] = Sanitizar::limpiarCadena($data['descripcion']);
       $data['idRegistro'] = Sanitizar::limpiarCadena($data['idRegistro']);
       $data['empaque'] = Sanitizar::limpiarCadena($data['empaque']);
       $data['alturaEditar'] = Sanitizar::limpiarCadena($data['alturaEditar']);


    /*
       Comprobamos si la bandera esta activada, para cambiarle el nombre al archivo de imagen
       Aqui lo que hacemos, es comprobar si el usuario modifico el campo codigo, para de esa forma, nosotros modificarle el nombre a la imagen y no exista conflicto
       En la pagina web, ya que las imagenes estan ligadas con el CODIGO del producto.
   */
      if(isset($_POST['bandera']))
      {

         //Antes de cambiar la imagen, debemos comprobar que no exista ese codigo ya
         if($this->modelo->thereAreCode($data['codigo']))
         {
            $respuesta = 'bad';
         }
         else
         {

            //Modificamos el nombre de la imagen
            Sanitizar::changeNameImg($data['oldCodigo'] , $data['codigo']);

            if($this->modelo->updateChangeCodeProduct($data))
            {
               $respuesta = true;
            }
            else{
               $respuesta = false;
            }

         }
      }
      else
      {

         //Si no se modifico el nombre del producto, hacemos la actualizacion sin modificar el nombre de la imagen.
         if($this->modelo->updateProducto($data) > 0)
         {
            $respuesta = true;
         }
         else
         {
            $respuesta = false;
         }
      }

      echo $respuesta;

   }//cierra funcion actualizar producto


   /*
      **************************************************************************
      FIN DE METODOS CRUD
      *************************************************************************
   */

   private function crearMarcaDeAgua($nombreProducto)
   {
    // Cargar la estampa y la foto para aplicarle la marca de agua
    $estampa = imagecreatefrompng('img/marcadeagua.png');
    $im = imagecreatefromjpeg('img/productos/' . $nombreProducto);

    // Establecer los márgenes para la estampa y obtener el alto/ancho de la imagen de la estampa
    $margen_dcho = 0;
    $margen_inf = 0;
    $sx = imagesx($estampa);
    $sy = imagesy($estampa);

    // Copiar la imagen de la estampa sobre nuestra foto usando los índices de márgen y el
    // ancho de la foto para calcular la posición de la estampa.
    imagecopy($im, $estampa, imagesx($im) - $sx - $margen_dcho, imagesy($im) - $sy - $margen_inf, 0, 0, imagesx($estampa), imagesy($estampa));

    // Imprimir y liberar memoria
    header('Content-type: image/png');
    $save = 'img/productos/'.$nombreProducto;


    if(imagepng($im , $save))
    {
       $bandera = true;
    }else{
       $bandera = false;
    }

    imagedestroy($im);


    return $bandera;

   }


   //Eliminamos imagen para no almacenar basura
   public function deleteImg($nameImg)
   {

      if(file_exists(RUTA . "img/productos/$nameImg")){
         unlink(RUTA . "img/productos/$nameImg");
      }

      return true;

   }


   //utilizamos este metodo para llenar la subfamilias dentro del modal de editar producto
   public function getSubFamiliaE()
   {
      if(isset($_POST))
      {
         header('Content-Type: application/json');
         $objeto = new ProductoController();
         $resultado = $this->modelo->getSubFamiliaE($_POST['familia']);
         echo json_encode($resultado);
      }
      else
      {
         echo 'false';
      }
   }


  //Utilizamos este metodo para modificar la imagen de un producto dentro del modulo de administrador
   public function cambiarFoto()
   {
      if(isset($_POST['producto']))
      {

         if(!empty($_FILES['newFoto']['name'] ))
         {
            //$file_name = $_FILES['newFoto']['name'];
            $file_name = $_POST['codigo'] . '.jpg';
            $upload_location = 'img/productos/' . $file_name;
            $image_size = $_FILES['newFoto']['size'];

            if($image_size < 2 * 1024 * 1024)
            {
               if(move_uploaded_file($_FILES['newFoto']['tmp_name'] , $upload_location))
               {

                  if($this->crearMarcaDeAgua($file_name))
                  {
                     //aqui debemos actualizar la imagen dentro de la tabla productos
                     $this->modelo->actualizarImagen($_POST['codigo'] , $file_name);
                     //$this->deleteImg($_POST['producto']);

                     unset($_FILES['newFoto']['name']);
                     unset($_FILES['newFoto']['tmp_name']);
                     echo true;
                  }
                  else
                  {
                     echo 'false';
                  }
               }
            }
         }
         else
         {
            unset($_FILES['newFoto']['name']);
            unset($_FILES['newFoto']['tmp_name']);
            echo 'false';
         }
      }
      else
      {
         echo 'false';
      }

   }//cierra funcion cambiarFoto





   //metodo utilizado para cerrar sesion
   public function logout(){
      session_destroy();
      $opciones = [
         'cost' => 8
      ];

      $token = password_hash( uniqid(true) . time() , PASSWORD_BCRYPT , $opciones  );

      $data = ['token' => $token];


      $this->vista('loginVista' , $data);
      die();
   }


   //Metodo utilizado para obtener todas las marcas  y submarcas y para mostrar la view marcasVista
   public function marcas(){

      if(isset($_GET['bandera']))
      {
         header('Content-Type: application/json');
         $resultado = $this->modelo->getProductoDetalle();
         echo json_encode($resultado);
      }
      else
      {
         $this->modelo = $this->modelo('ProductoModel');
         $marcas = $this->modelo->getMarcas();
         $submarcas = $this->modelo->getAllSubmarcas();

         $data = [
            'marcas' => $marcas,
            'submarcas' =>$submarcas
         ];

         $this->vista('marcasVista' , $data);
      }
   }


   //actualizamos los cambios que se realizen en la view marcasVista
   public function updateMarca()
   {
      if(isset($_POST))
      {
          $resultado = $this->modelo->updateProductoDetalle($_POST);
          echo $resultado;
      }else{
         echo 'false';
       }

   }

   //eliminamos un registro de la tabla productodetalle en la view marcasVista
   public function deleteMarca()
   {
      if(isset($_POST))
      {
        $resultado = $this->modelo->deleteProductoDetalle($_POST);
        echo $resultado;
      }else{
        echo 'false';
      }
   }


   public function registrarMarca()
   {

      if(isset($_POST))
      {
         $data = $_POST;

         if($this->modelo->thereAreCode($data['codigoP']) <= 0)
         {
            echo 'false';
         }else{
            echo  $this->modelo->registerMarca($data);
         }
      }
      else{
         echo 'false';
      }

   }

   /*
       *********************************************
       * Bloque de metodos para vista diametros    *
       *                                           *
       * *******************************************
    */
   public function exterior()
   {
      $this->vista('exterioresVista');
   }



   public function getDiametrosExt()
   {
      header('Content-Type: application/json');
      $resultado = $this->modelo->getDiametros();
      echo json_encode($resultado);
   }



   public function registrarDiametro()
   {
      if($_POST)
      {
         echo $this->modelo->registrarDiametro($_POST);
      }
      else
      {
         echo 'false';
      }
   }


   public function updateDiametro()
   {
      if($_POST)
      {
         echo $this->modelo->updateDiametro($_POST);
      }
      else
      {
         echo 'false';
      }
   }


   public function deleteDiametro()
   {
      if($_POST)
      {
         echo $this->modelo->deleteDiametro($_POST);
      }
      else{
         echo 'false';
      }
   }


   /*
       *********************************************
       * FIN  Bloque de metodos para vista diametros    *
       *                                           *
       * *******************************************
    */

   //utilizamos este metodo para generar la vista dentro del modulo de administrador
   public function contacto()
   {
      $this->vista('contactoAdminVista');
   }


   public function getMensajes()
   {
      header('Content-Type: application/json');
      echo json_encode($this->modelo->getContacto());
   }



   //obtenemos todos los usuarios dentro del datatable de sudo
   public function getUsers()
   {
      header('Content-Type: application/json');
      $data = $this->modelo->getUsers();
      echo json_encode($data);

   }

   //generamos vista sudo de users para super administrador
   public function users()
   {
      if($_SESSION['avatarHO'] == 'A')
      {
         $this->vista('sudoVista');
      }else{
         $familias = $this->modelo->getFamilias();
         $subfamilias = $this->modelo->getSubFamilias();
         $catalogos = $this->modelo->getCatalogos();
         $posiciones = $this->modelo->getPosiciones();
         $lados = $this->modelo->getLados();
         $marcas = $this->modelo->getMarcas();
         $submarcas = $this->modelo->getSubMarcas();

         $data = [
            'familias' => $familias,
            'subfamilias' => $subfamilias,
            'catalogos' => $catalogos,
            'posiciones' =>$posiciones,
            'lados' =>$lados,
            'marcas' => $marcas,
            'submarcas' =>$submarcas
         ];


         $this->vista('adminVista' , $data);
      }
   }


   public function updateUser()
   {
      if($_SESSION['avatarHO'] == 'A')
      {
         $data = $_POST;

         if(isset($data['restablecer']))
         {
            //encriptamos la contraseña
            $opciones = [
               'cost' => 8
            ];

            $data['passwordE'] = password_hash( $data['passwordE'] , PASSWORD_BCRYPT , $opciones  );
            $data['nombreE'] = ucwords($data['nombreE']);
         }

         echo $this->modelo->updateUser($data);

      }else{
         $familias = $this->modelo->getFamilias();
         $subfamilias = $this->modelo->getSubFamilias();
         $catalogos = $this->modelo->getCatalogos();
         $posiciones = $this->modelo->getPosiciones();
         $lados = $this->modelo->getLados();
         $marcas = $this->modelo->getMarcas();
         $submarcas = $this->modelo->getSubMarcas();

         $data = [
            'familias' => $familias,
            'subfamilias' => $subfamilias,
            'catalogos' => $catalogos,
            'posiciones' =>$posiciones,
            'lados' =>$lados,
            'marcas' => $marcas,
            'submarcas' =>$submarcas
         ];


         $this->vista('adminVista' , $data);
      }
   }


   public function registrarUser()
   {

      if($_SESSION['avatarHO'] == 'A')
      {
         if($_POST)
         {
            $data = $_POST;
            //debemos limpias datos y encriptar la contraseña
            $opciones = [
               'cost' => 8
            ];

            $data['passwordA'] = password_hash( $data['passwordA'] , PASSWORD_BCRYPT , $opciones  );
            $data['nombreA'] = ucwords($data['nombreA']);
            $resultado = $this->modelo->insertUser($data);
            echo $resultado;
         }

      }else{
         $familias = $this->modelo->getFamilias();
         $subfamilias = $this->modelo->getSubFamilias();
         $catalogos = $this->modelo->getCatalogos();
         $posiciones = $this->modelo->getPosiciones();
         $lados = $this->modelo->getLados();
         $marcas = $this->modelo->getMarcas();
         $submarcas = $this->modelo->getSubMarcas();

         $data = [
            'familias' => $familias,
            'subfamilias' => $subfamilias,
            'catalogos' => $catalogos,
            'posiciones' =>$posiciones,
            'lados' =>$lados,
            'marcas' => $marcas,
            'submarcas' =>$submarcas
         ];


         $this->vista('adminVista' , $data);
      }
   }


   public function deleteUser()
   {



      if($_SESSION['avatarHO'] == 'A')
      {
         if($_POST)
         {
            $resultado = $this->modelo->deleteUser($_POST);
            echo $resultado;
         }
      }else{
         $familias = $this->modelo->getFamilias();
         $subfamilias = $this->modelo->getSubFamilias();
         $catalogos = $this->modelo->getCatalogos();
         $posiciones = $this->modelo->getPosiciones();
         $lados = $this->modelo->getLados();
         $marcas = $this->modelo->getMarcas();
         $submarcas = $this->modelo->getSubMarcas();

         $data = [
            'familias' => $familias,
            'subfamilias' => $subfamilias,
            'catalogos' => $catalogos,
            'posiciones' =>$posiciones,
            'lados' =>$lados,
            'marcas' => $marcas,
            'submarcas' =>$submarcas
         ];


         $this->vista('adminVista' , $data);
      }
   }


}//cierra clase Administrador



 ?>
