<?php


class Producto extends Controlador{

   private $modelo;

   public function __construct(){
      $this->modelo = $this->modelo('ProductoModel');

   }

   //vista general de la pagina
   public function index(){

      //obtengo las familias para mostrarlas en el menu-slider
      $familias = $this->modelo->getAllFamily();
      $tam = count($familias);
      $contador = 5;

      $data = [
         'familias' => $familias ,
         'tam' => $tam,
         'contador' => $contador,
         'objProducto' => $this->modelo
      ];

      $this->vista('productoVista' , $data);
   }

   //vista para generar el catalogo
   public function frenos($familia = ''){

      //utilizamos esta variable para llenar el sidebar lateral
      $familias = $this->modelo->getFamiliaForCatalogo('frenos');
      $contador = 0;

      if(isset($_GET['grupo']))
      {
         /*Logica del paginador*/

         define('NUM_ITEMS_BY_PAGE' , 9);

         //debemos sanitizar el get
         $identificador = Sanitizar::limpiarCadena($_GET['grupo']);
         $totalRows = $this->modelo->totalGrupo($identificador);

         //logica del paginador
         if($totalRows['total'] > 0)
         {
            $page = false;

            //examino la pagina a mostrar y el inicio del registro a mostrar
            if(isset($_GET["page"]))
            {
               $page = Sanitizar::limpiarCadena($_GET["page"]);
            }

            if(!$page)
            {
               $start = 0;
               $page = 1;
            }
            else
            {
               $start = ($page - 1) * NUM_ITEMS_BY_PAGE;
            }

            //calculo el total de paginas
            $total_pages = ceil($totalRows['total'] / NUM_ITEMS_BY_PAGE);

            //ejectuamos la consulta para obtener los productos y las familias
            $familia = $this->modelo->getFamiliaForGrupo($identificador);
            $productos = $this->modelo->getProductosForGrupo($identificador , $start , NUM_ITEMS_BY_PAGE );



            /* fin de logica del paginador */

            $data = [
               'familias' => $familias ,
               'objeto' => $this->modelo,
               'contador' => $contador,
               'bandera' => false,
               'familia' => $familia,
               'grupo' => $identificador,
               'productos' => $productos,
               'page' => $page,
               'total_pages' => $total_pages,
               'paginador' => true
            ];


         }
         else
         {
            $this->vista('404Vista');
         }
      }
      else
      {
         /*Logica del paginador*/

         define('NUM_ITEMS_BY_PAGE' , 9);

         //debemos sanitizar el get
         $totalRows = $this->modelo->totalCatalogo('frenos');

         //logica del paginador
         if($totalRows['total'] > 0)
         {
            $page = false;

            //examino la pagina a mostrar y el inicio del registro a mostrar
            if(isset($_GET["page"]))
            {
               $page = Sanitizar::limpiarCadena($_GET["page"]);
            }

            if(!$page)
            {
               $start = 0;
               $page = 1;
            }
            else
            {
               $start = ($page - 1) * NUM_ITEMS_BY_PAGE;
            }

            //calculo el total de paginas
            $total_pages = ceil($totalRows['total'] / NUM_ITEMS_BY_PAGE);

            $productos = $this->modelo->getProductosForCatalogo('frenos' , $start , NUM_ITEMS_BY_PAGE);

            $data = [
               'familias' => $familias ,
               'objeto' => $this->modelo,
               'contador' => $contador,
               'familia' => $familia,
               'bandera' => true,
               'productos' => $productos,
               'page' => $page,
               'total_pages' => $total_pages,
               'paginador' => false
            ];
         }

      }


      $this->vista('frenosVista' , $data);
   }


   public function suspension(){
      //utilizamos esta variable para llenar el sidebar lateral
      $familias = $this->modelo->getFamiliaForCatalogo('suspension');
      $contador = 0;

      if(isset($_GET['grupo']))
      {
         /*Logica del paginador*/

         define('NUM_ITEMS_BY_PAGE' , 9);

         //debemos sanitizar el get
         $identificador = Sanitizar::limpiarCadena($_GET['grupo']);
         $totalRows = $this->modelo->totalGrupo($identificador);

         //logica del paginador
         if($totalRows['total'] > 0)
         {
            $page = false;

            //examino la pagina a mostrar y el inicio del registro a mostrar
            if(isset($_GET["page"]))
            {
               $page = Sanitizar::limpiarCadena($_GET["page"]);
            }

            if(!$page)
            {
               $start = 0;
               $page = 1;
            }
            else
            {
               $start = ($page - 1) * NUM_ITEMS_BY_PAGE;
            }

            //calculo el total de paginas
            $total_pages = ceil($totalRows['total'] / NUM_ITEMS_BY_PAGE);

            //ejectuamos la consulta para obtener los productos y las familias
            $productos = $this->modelo->getProductosForGrupo($identificador , $start , NUM_ITEMS_BY_PAGE );



            /* fin de logica del paginador */

            $data = [
               'familias' => $familias ,
               'objeto' => $this->modelo,
               'contador' => $contador,
               'bandera' => false,
               'grupo' => $identificador,
               'productos' => $productos,
               'page' => $page,
               'total_pages' => $total_pages,
               'paginador' => true
            ];


         }else{
            $this->vista('404Vista');
         }



      }
      else
      {
         /*Logica del paginador*/

         define('NUM_ITEMS_BY_PAGE' , 9);

         //debemos sanitizar el get
         $totalRows = $this->modelo->totalCatalogo('suspension');

         //logica del paginador
         if($totalRows['total'] > 0)
         {
            $page = false;

            //examino la pagina a mostrar y el inicio del registro a mostrar
            if(isset($_GET["page"]))
            {
               $page = Sanitizar::limpiarCadena($_GET["page"]);
            }

            if(!$page)
            {
               $start = 0;
               $page = 1;
            }
            else
            {
               $start = ($page - 1) * NUM_ITEMS_BY_PAGE;
            }

            //calculo el total de paginas
            $total_pages = ceil($totalRows['total'] / NUM_ITEMS_BY_PAGE);


         }

         $productos = $this->modelo->getProductosForCatalogo('suspension' , $start , NUM_ITEMS_BY_PAGE);

         $data = [
            'familias' => $familias ,
            'objeto' => $this->modelo,
            'contador' => $contador,
            'bandera' => true,
            'productos' => $productos,
            'page' => $page,
            'total_pages' => $total_pages,
            'paginador' => false
         ];
      }


      $this->vista('suspensionVista' , $data);
   }

   //Este metodo lo vamos a ejecutar para mostrar la vista de producto detalle
   public function detalle($codigo){

      //Obtengo la información general del producto
      //Debo sanitizar el valor de codigo para evitar sorpresas
      $dataProducto = $this->modelo->obtenerDataProducto($codigo);

      if($dataProducto == null)
      {
         $this->vista('404Vista');
      }
      else
      {
         $detalleProducto = $this->modelo->obtenerDetalleProducto($codigo);
         $diametros = $this->modelo->obtenerDiametros($codigo);
         $similares = $this->modelo->getSimilares($dataProducto[0]['familia']);

         $data = [
            'dataProducto' => $dataProducto ,
            'detalleProducto' => $detalleProducto,
            'diametros' => $diametros ,
            'similares' => $similares
         ];

         $this->vista('detalleVista' , $data);
      }
   }

   //Metodo utilizada para ejecutar la busqueda personalizada dentro de home
   public function personalizada($marca = '' , $submarca = ''){
      $marca = Sanitizar::limpiarCadena($marca);
      $submarca = Sanitizar::limpiarCadena($submarca);

      $productos = $this->modelo->searchPersonalizada($marca, $submarca);

      $data = [
         'productos' => $productos,
         'marca' => $marca ,
         'submarca' => $submarca
      ];

      $this->vista('personalizadaVista' , $data);
   }


   public function rapida()
   {
      if(isset($_GET['claveB']))
      {
         define('NUM_ITEMS_BY_PAGE' , 15);
         //debemos sanitizar el get
         $identificador = Sanitizar::limpiarCadena($_GET['claveB']);
         $totalRows = $this->modelo->totalSearchFast($identificador);

         //logica del paginador
         if($totalRows['total'] > 0)
         {
            $page = false;

            //examino la pagina a mostrar y el inicio del registro a mostrar
            if (isset($_GET["page"]))
            {
               $page = Sanitizar::limpiarCadena($_GET["page"]);
            }

            if(!$page)
            {
               $start = 0;
               $page = 1;
            }
            else
            {
               $start = ($page - 1) * NUM_ITEMS_BY_PAGE;
            }

            //calculo el total de paginas
            $total_pages = ceil($totalRows['total'] / NUM_ITEMS_BY_PAGE);


            //fin logica del paginador

            $productos = $this->modelo->searchFast($identificador , $start , NUM_ITEMS_BY_PAGE );

            //definimos el data

            $data = [
               'identificador' => $identificador,
               'productos' => $productos,
               'page' => $page,
               'total_pages' => $total_pages
            ];


            $this->vista('rapidaVista' , $data);

         }else{
            $this->vista('404Vista');
         }

      }else{
         $this->vista('404Vista');
      }



   }

   public function catalogos()
   {
      if(isset($_GET['grupo']))
      {
         //obtenemos primero el valor al que pertenece la peticion para determinar de que catalogo es y de esa forma poder llenar el sidebar lateral
         $catalogo = $this->modelo->belongsCatalogo(Sanitizar::limpiarCadena($_GET['grupo']));
         $catalogo = isset($catalogo[0]['catalogo'])?$catalogo[0]['catalogo'] : '' ;
         $identificador = isset($_GET['grupo']) ? Sanitizar::limpiarCadena($_GET['grupo']) : '';

         //utilizamos esta variable para llenar el sidebar lateral
         $familias = $this->modelo->getFamiliaForCatalogo($catalogo);
         $contador = 0;


         /*Logica del paginador*/

         define('NUM_ITEMS_BY_PAGE' , 9);


         $totalRows = $this->modelo->totalGrupo($identificador);

         //logica del paginador
         if($totalRows['total'] > 0)
         {
            $page = false;

            //examino la pagina a mostrar y el inicio del registro a mostrar
            if(isset($_GET["page"]))
            {
               $page = Sanitizar::limpiarCadena($_GET["page"]);
            }

            if(!$page)
            {
               $start = 0;
               $page = 1;
            }
            else
            {
               $start = ($page - 1) * NUM_ITEMS_BY_PAGE;
            }

            //calculo el total de paginas
            $total_pages = ceil($totalRows['total'] / NUM_ITEMS_BY_PAGE);

            $productos = $this->modelo->getProductosForFamily($identificador, $start , NUM_ITEMS_BY_PAGE );

                     /* fin de logica del paginador */

            $data = [
               'familias' => $familias ,
               'objeto' => $this->modelo,
               'contador' => $contador,
               'bandera' => false,
               'grupo' => $identificador,
               'productos' => $productos,
               'page' => $page,
               'total_pages' => $total_pages,
               'paginador' => true
            ];


            if($catalogo == 'Suspensión'){
               $this->vista('suspensionVista' , $data);
            }else{
               $this->vista('frenosVista' , $data);
            }


         }
         else{
            $this->vista('404Vista');
         }
      }else{
         $this->vista('404Vista');
      }
   }


   public function descargas()
   {
      $this->vista('descargasVista');
   }

   public function nosotros()
   {
      $this->vista('nosotrosVista');
   }


   public function informacion()
   {
      $this->vista('informacionVista');
   }

   public function politica()
   {
      $this->vista('politicaVista');
   }


   public function videos()
   {
      $this->vista('videosVista');
   }


   public function privacidad()
   {
      $this->vista('privacidadVista');
   }


   public function contacto()
   {
      $this->vista('contactoVista');
   }


   public function enviarContacto()
   {

      if(isset($_POST))
      {
         if(Sanitizar::validarRecaptcha($_POST['token']))
         {
            if(isset($_POST['nombre'] , $_POST['apellido'] , $_POST['correoDestino'] , $_POST['mensaje'] , $_POST['telefono'])  )
            {

               if(!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['correoDestino']) && !empty($_POST['mensaje']) && !empty($_POST['telefono'] ) )
               {

                  $nombre = Sanitizar::limpiarCadena( ucwords($_POST['nombre']) . ' '. ucwords($_POST['apellido']));
                  $correo = Sanitizar::limpiarCadena($_POST['correoDestino']);
                  $mensaje = Sanitizar::limpiarCadena($_POST['mensaje']);
                  $telefono = Sanitizar::limpiarCadena($_POST['telefono']);
                  $resultado = $this->modelo->enviarEmail($correo, $nombre, $mensaje , $telefono);

                  echo $resultado;
               }
               else
               {
                  echo 'false';
               }
            }
            else
            {
               echo 'false';
            }
         }
         else{
            echo 'false';
         }
      }
      else
      {
         echo 'false';
      }

   }//cierra funcion enviarContacto

   // 1.1 metodos utilizado en la vista administrador modulo marcas
   public function getSubMarcas()
   {
      header('Content-Type: application/json');
      $resultado = $this->modelo->getAllSubmarcas();
      echo json_encode($resultado);
   }


   public function getMarcas()
   {
      header('Content-Type: application/json');
      $resultado = $this->modelo->getMarcas();
      echo json_encode($resultado);
   }

   //fin de metodos 1.1


   /*
       *************************************************************
       Metodos para administrador
       ******************************
    */
   public function login()
   {

      session_start();

      if(isset($_SESSION['sesionHO1']))
      {
         header("Location:".RUTA.'administrador/index');
         die();
      }
      else
      {
         $opciones = [
            'cost' => 8
         ];

         $token = password_hash( uniqid(true) . time() , PASSWORD_BCRYPT , $opciones  );

         $data = ['token' => $token];


         $this->vista('loginVista' , $data);
      }
   }


   public function sesion()
   {
      /*
        El funcionamiento de este metodo es el siguiente
        Primero comprobamos que los tres valores que se deberían enviar por el formulario, esten seteados.
        Si estan seteados, comprobamos que el token creado, sea igual al que se envia por el formulario
        Si ese token es igual, comprobamos que las credenciales (user , password), esten almacenadas en la BD
        Si lo estan, retornamos un true.

        Tambien hay un contador en el cual, por cada intento fallido del usuario, sumamos 1, si ese contador llega a 5 , añadimos la ip del usuario en la lista negra.


      */

      session_start();


      $this->modelo = $this->modelo('AdministradorModelo');

      //validamos primero que exista el token csrf, de esa forma evitamos que un usuario intente ingresar a este archivo desde fuera del login
      if(isset($_POST['tokenHO']))
      {
         if(!isset($_SESSION['contadorHO']))
         {
            $_SESSION['contadorHO'] = 1;
         }
         else
         {
            if($_SESSION['contadorHO'] > 5)
            {
               //guardamos la ip, y mandamos al usuario a una pagina de error
               $ip = $_SERVER['REMOTE_ADDR'];
               //$objeto->bloquearIP($ip);
               $_SESSION['contadorHO'] = 0;
               echo 'block';
               die();
            }
            else
            {
               $_SESSION['contadorHO'] = $_SESSION['contadorHO'] + 1;
            }
         }

         if(isset($_POST['userHO'] , $_POST['passwordHO'] , $_POST['recaptchaHO']))
         {
            //limpiamos los datos que nos manden
            $_POST['userHO'] = Sanitizar::limpiarCadena($_POST['userHO']);
            $_POST['recaptchaHO'] = Sanitizar::limpiarCadena($_POST['recaptchaHO']);
            $_POST['passwordHO'] = Sanitizar::limpiarCadena($_POST['passwordHO']);

            if(Sanitizar::validarRecaptcha($_POST['recaptchaHO']))
            {
               $resultado = $this->modelo->comprobarUser($_POST['userHO'] , $_POST['passwordHO']);

               if($resultado != false)
               {
                  unset($_SESSION['contadorHO']);
                  $_SESSION['sesionHO1'] = 'true';
                  $_SESSION['nameUserHO'] = $resultado[0]['nombre'];
                  $_SESSION['avatarHO'] = $resultado[0]['avatar'];
                  echo 'true';
               }
               else
               {
                  $_SESSION['contadorHO']++;
                  echo 'false';
               }
            }
            else
            {
               echo 'false';
            }
         }
         else
         {
            echo 'false';
         }
      }
      else
      {
         header("Location:". RUTA .'producto/login');
         die();
      }

   } //cierra metodo sesion


   /*
       *************************************************************
       fin de Metodos para login
       ******************************
    */




}//cierra controlador PRODUCTO



 ?>
