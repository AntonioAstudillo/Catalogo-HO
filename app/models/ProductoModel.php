<?php


class ProductoModel
{
   private $conexion;

   function __construct(){
      //hago una instancia de la conexion para poder hacer operaciones a la base de datos
      $this->conexion = new Mysql();
      $this->conexion = $this->conexion->getConexion();
   }
   /**
    * [getAllFamily Obtengo las familias que tenemos almacenadas en la database para poder mostrarlas en el menu slider dentro de home]
    * @return [type] [description]
    */
   public function getAllFamily()
   {
     $consulta = "SELECT DISTINCT familia FROM familias";
     $statement = $this->conexion->prepare($consulta);
     $statement->execute();

     return $statement->fetchAll(PDO::FETCH_ASSOC);
   }



   /**
    * [obtenerDestacados  Funcion para obtener 4 productos destacados y poder mostrarlos en el carousel slider dentro de home]
    * @return [fetch] [arreglo asociativo con los registros obtenidos con la query]
    */
   public function obtenerDestacados(){
      $consulta = "SELECT producto as 'codigo' FROM destacados ORDER BY rand() LIMIT 4; ";
      $statement = $this->conexion->prepare($consulta);
      $statement->execute();

      return $statement->fetchAll();
   }



   /**
    * [obtenerDataProducto obtengo la informacion  del producto para poder mostrarla en la tabla  general]
    * @param  [String] $codigo               [el codigo del producto que vamos a mostrar]
    * @return [FETCH_ASSOC]         [Retornamos un array asociativo con el cual vamos a llenar la tabla de información general]
    */
   public function obtenerDataProducto($codigo){
      $consulta = "SELECT * FROM productos WHERE codigo = ?";
      $statement = $this->conexion->prepare($consulta);
      $statement->execute(array($codigo));

      return $statement->fetchAll(PDO::FETCH_ASSOC);
   }




   /**
    * [obtenerDetalleProducto obtengo la informacion de marca, submarcas , etc.. del un determinado producto]
    * @param  [String] $codigo               [codigo del producto a buscar]
    * @return [FETCH_ASSOC]         [Array associativo con toda la informacion del producto detalle ]
    */
   public function obtenerDetalleProducto($codigo)
   {
      $consulta = "SELECT marca , submarca , modelo , fmsi , noBalata FROM productodetalle WHERE producto = ? ORDER BY marca";
      $statement = $this->conexion->prepare($consulta);
      $statement->execute(array($codigo));

      return $statement->fetchAll(PDO::FETCH_ASSOC);
   }

   /**
    * [obtenerDiametros Voy a obtener todos los diametros exteriores de un cierto producto ]
    * @param  [String] $idProducto               [id del producto]
    * @return [FETCH_ASSOC]             [Array asociativo con todos los diametros del producto buscado]
    */
   public function obtenerDiametros($idProducto)
   {
      $consulta = "SELECT diametro FROM diametros WHERE codigo = ? ";

      $statement = $this->conexion->prepare($consulta);
      $statement->execute(array($idProducto));

      return $statement->fetchAll(PDO::FETCH_ASSOC);

   }


   /**
    * [getSimilares Obtengo productos similares para mostrarlos dentro de la vista de detalleProducto ]
    * @param  [type] $familia               [description]
    * @return [type]          [description]
    */
    public function getSimilares($familia){
      $consulta = "SELECT codigo FROM productos WHERE familia = ? ORDER BY rand() limit 4";
      $statement = $this->conexion->prepare($consulta);
      $statement->execute(array($familia));

      return $statement->fetchAll(PDO::FETCH_ASSOC);
   }


   /**
    * [getMarcas obtenemos todas las marcas de nuestra base de datos ]
    * @return [ARRAY] [Retornamos un array asociativo]
    */
   public function getMarcas()
   {
      $consulta = " SELECT DISTINCT marca FROM productodetalle WHERE marca <> ' '  ORDER BY marca ASC";
      $statement = $this->conexion->prepare($consulta);
      $statement->execute();

      return $statement->fetchAll(PDO::FETCH_ASSOC);
   }


   /**
    * [getSubmarcas Obtengo todas las submarcas registradas en la tabla productodetalle]
    * @return [array]        [arreglo asociativo con todas las marcas]
    */
   public function getAllSubmarcas()
   {
      $consulta = "SELECT DISTINCT(submarca) FROM productodetalle WHERE submarca <> ?  ORDER BY submarca asc";

      $statement = $this->conexion->prepare($consulta);
      $statement->execute(array(''));

      return $statement->fetchAll(PDO::FETCH_ASSOC);

   }



   public function getSubmarcas($marca)
   {
      $consulta = "SELECT DISTINCT submarca FROM productodetalle WHERE marca = ? AND submarca <> ' ' ORDER BY submarca ASC;";
      $statement = $this->conexion->prepare($consulta);
      $statement->execute(array($marca));

      return $statement->fetchAll(PDO::FETCH_ASSOC);

   }

   /**
    * [searchPersonalizada Esta funcion la utilizo para hacer una consulta de marca y submarca dentro del modulo de busqueda personalizada ]
    * @param  [String] $marca                  [marca del producto]
    * @param  [String] $submarca               [submarca del producto ]
    * @return [Array_associative]           [Retorno un array asociativo de los codigos que cumplan la condicion dentro del wherre]
    */
   public function searchPersonalizada($marca , $submarca)
   {
      if($submarca === '0')
      {
         $consulta = "SELECT DISTINCT producto FROM productodetalle WHERE marca = ? OR submarca = ?";
      }
      else
      {
         $consulta = "SELECT DISTINCT producto FROM productodetalle WHERE marca = ? AND submarca = ?";
      }

      $statement = $this->conexion->prepare($consulta);
      $parametros = array($marca , $submarca);
      $statement->execute($parametros);

      return $statement->fetchAll(PDO::FETCH_ASSOC);

   }//cierra funcion searchMain

   /**
    * [mostrarContenido Esta metodo es utilizado para generar el listBox dentro de home ]
    * @return [fetch] [un arraoy associativo con todos los resultados de la consulta]
    */
   public function mostrarContenido()
   {

      // $query = "SELECT distinct(p.grupo) AS familia ,  FROM productos p WHERE familia <> '' ORDER BY p.grupo ASC";
      $query = "SELECT p.grupo as familia , p.codigo as codigo , pd.fmsi as fmsi , pd.noBalata as balata , p.diametroInterior , d.diametro
         FROM productos p
         left join productodetalle pd
         on pd.producto = p.codigo
         inner join diametros d
         on d.codigo = p.codigo ";

      $statement = $this->conexion->prepare($query);
      $statement->execute();

      return $statement->fetchAll(PDO::FETCH_ASSOC);
   }

   /**
    * [totalSearchFast Utilizamos este metodo para obtener el total de la busqueda rapida y de esa forma controlar el paginador ]
    * @param  [String] $identificador               [clave de busqueda]
    * @return [fetch]                [arreglo asociativo con el resultado de la query ]
    */

   public function totalSearchFast($identificador)
   {
       $consulta = "SELECT count(distinct(p.codigo)) as 'total'  FROM productos p inner join productodetalle pd
                     on p.codigo = pd.producto
                     where  pd.marca LIKE ? OR pd.submarca LIKE ? OR pd.modelo LIKE ? or pd.fmsi like ? or p.codigo like ? or p.familia like ? or p.grupo like ?
                     or p.codigo in (SELECT codigo FROM diametros where diametro like ?) ;";

      $statement = $this->conexion->prepare($consulta);
      $parametros = array("%$identificador%","%$identificador%","%$identificador%" , "%$identificador%" , "%$identificador%" , "%$identificador%" ,"%$identificador%" , "%$identificador%" );
      $statement->execute($parametros);

      return $statement->fetch();

   }


   /**
    * [searchFast Este metodo es utilizado para obtener los resultados de la busqueda rapida de acuerdo al valor ingresado por el usuario ]
    * @param  [string] $identificador               [clave utilizada para determinar la busqueda]
    * @param  [int] $inicio                      [valor para controlar el paginador]
    * @param  [int] $numeroItems                 [valor para controlar el paginado ]
    * @return [fetch]                [retornamos un arreglo asociativo con los productos de la busqueda]
    */

   public function searchFast($identificador , $inicio , $numeroItems)
   {

      $query = "SELECT distinct(p.codigo) FROM productos p
                 INNER JOIN productodetalle pd on p.codigo = pd.producto WHERE  pd.marca LIKE ? OR pd.submarca LIKE ? OR pd.modelo LIKE ? OR pd.fmsi LIKE ? OR p.codigo LIKE ? OR p.grupo LIKE ?  OR p.familia LIKE ?  OR pd.noBalata LIKE ?
                OR p.codigo in (SELECT codigo FROM diametros WHERE diametro LIKE ?) LIMIT ?,?";

      $statement = $this->conexion->prepare($query);
      $parametros = array("%$identificador%","%$identificador%","%$identificador%", "%$identificador%" , "%$identificador%" , "%$identificador%" , "%$identificador%" , "%$identificador%" , "%$identificador%", $inicio , $numeroItems);
      $statement->execute($parametros);

      return $statement->fetchAll(PDO::FETCH_ASSOC);
   }


   /**
    * [getFamiliaForCatalogo obtenemos las familias de un catalogo para de esa forma poder generar el sidebar tanto de la vista frenos, como de la de suspension]
    * @param  [string] $catalogo               [nombre del catalogo]
    * @return [fetch]           [array associativo con la cantidad de familia de un determinado catalogo]
    */
   public function getFamiliaForCatalogo($catalogo)
   {
      $consulta = "SELECT DISTINCT(familia) FROM productos WHERE catalogo = ?";
      $statement = $this->conexion->prepare($consulta);
      $statement->execute(array($catalogo));

      return $statement->fetchAll(PDO::FETCH_ASSOC);
   }



   /**
    * [comprobrarSubfamilias Utilizamos este metodo para determinar si una familia tiene subfamilia y de esa manera poder añadirle el elemento li a dicha familia]
    * @param  [string] $familia               [familia a la que le vamos a comprobar sus subfamilias]
    * @return [boolean]          [true en caso de que esa familia si tenga subfamilia, caso contrario retornamos un false]
    */
   public function comprobrarSubfamilias($familia)
   {
        $bandera;
        $consulta = "SELECT grupo FROM productos WHERE familia = ?";
        $statement = $this->conexion->prepare($consulta);
        $statement->execute(array($familia));

        if($statement->fetchColumn() > 0)
        {
          $bandera = true;
        }
        else{
          $bandera = false;
        }

        return $bandera;

   }


   /**
    * [getGrupo Obtengo las subfamilias de una determina familia, para de esa forma poder llenar el sidebar lateral dentro de la vista frenos]
    * @param  [string] $grupo               [description]
    * @return [array asociativo]        [subfamilias de una familia ]
    */
   public function getGrupoForFamilia($grupo){
      $consulta = "SELECT  DISTINCT grupo FROM productos WHERE familia = ? ORDER  BY grupo ASC ;";
      $statement = $this->conexion->prepare($consulta);
      $statement->execute( array ( $grupo));

      return $statement->fetchAll();

   }


   /**
    * [getFamiliaForGrupo Obtengo la familia de un determinado grupo para de esa manera comprobar y agregarle el valor true o false al sidebar de catalogos]
    * @param  [string] $grupo               [grupo]
    * @return [fetch]        [array asociativo]
    */
   public function getFamiliaForGrupo($grupo){
      $consulta = "SELECT familia FROM productos WHERE grupo = ?";
      $statement = $this->conexion->prepare($consulta);
      $statement->execute(array($grupo));

      return $statement->fetch();

   }

   /**
    * [getProductosForFamily Obtenemos los productos de acuerdo a una familia]
    * @param  [string] $catalogo               [catalogo del producto]
    * @return [fetch]           [array asociativo con los productos]
    */
   public function getProductosForFamily($catalogo , $inicio , $items){
      $consulta = "SELECT codigo FROM productos WHERE familia = ? LIMIT ? ,?";
      $statement = $this->conexion->prepare($consulta);
      $statement->execute(array($catalogo , $inicio , $items));

      return $statement->fetchAll(PDO::FETCH_ASSOC);
   }




   /**
    * [getProductosForFamily Obtenemos los productos de acuerdo a una familia]
    * @param  [string] $catalogo               [catalogo del producto]
    * @return [fetch]           [array asociativo con los productos]
    */
   public function getProductosForCatalogo($catalogo , $inicio , $items){
      $consulta = "SELECT codigo FROM productos WHERE catalogo = ? LIMIT ? ,?";
      $statement = $this->conexion->prepare($consulta);
      $statement->execute(array($catalogo , $inicio , $items));

      return $statement->fetchAll(PDO::FETCH_ASSOC);
   }



   /**
    * [getProductosForGrupo obtenemos todos los productos de acuerdo a un grupo]
    * @param  [string] $grupo               [grupo que vamos a buscar]
    * @return [array fetch]        [array associativo con todos los productos de acuerdo a un grupo]
    */
   public function getProductosForGrupo($grupo , $inicio , $items){
      $consulta = "SELECT codigo FROM productos WHERE grupo = ?  or familia = ? LIMIT ? ,? ";
      $statement = $this->conexion->prepare($consulta);
      $statement->execute(array($grupo  , $grupo , $inicio , $items));

      return $statement->fetchAll(PDO::FETCH_ASSOC);
   }


   /**
    * [totalGrupo obtenemos el total de productos que tiene un grupo o familia para de esa forma controlar el paginador]
    * @param  [string] $grupo               [grupo que vamos a contar]
    * @return [string]        [description]
    */
   public function totalGrupo($grupo)
   {
      $consulta = "SELECT count(*) as 'total' FROM productos WHERE grupo = ? or familia = ?";
      $statement = $this->conexion->prepare($consulta);
      $statement->execute(array($grupo , $grupo));

      return $statement->fetch();
   }


   /**
    * [totalCatalogo obtenemos la cantidad total de productos que tiene un cierto catalogo para de esa forma controlar el paginador]
    * @param  [string] $catalogo               [catalogo que vamos a contar ]
    * @return [string]           [description]
    */
   public function totalCatalogo($catalogo){
      $consulta = "SELECT count(*) as 'total' FROM productos WHERE catalogo = ?";
      $statement = $this->conexion->prepare($consulta);
      $statement->execute(array($catalogo));

      return $statement->fetch();
   }



   /**
    * [isCatalogo Con esta funcion vamos a determinar a que catalogo pertenece una familia]
    * @param  [String]  $familia               [familia]
    * @return boolean          [description]
    */
   public function belongsCatalogo($familia){
      $consulta = "SELECT DISTINCT(catalogo) as 'catalogo' FROM productos WHERE familia = ?;";
      $statement = $this->conexion->prepare($consulta);
      $statement->execute(array($familia));

      return $statement->fetchAll(PDO::FETCH_ASSOC);;
   }


   /**
    * [enviarEmail Utilizamos esta funcion para almacenar la informacion que nos envien desde el formulario de contacto]
    * @param  [type] $correo                 [description]
    * @param  [type] $nombre                 [description]
    * @param  [type] $mensaje                [description]
    * @param  [type] $telefono               [description]
    * @return [type]           [description]
    */
   public function enviarEmail($correo, $nombre, $mensaje , $telefono)
   {
      $fecha = Sanitizar::getTimeStamp();
      $query = "INSERT INTO contacto VALUES(?,?,?,?,?,?)";
      $statement = $this->conexion->prepare($query);
      $statement->execute(array(null ,  $nombre , $correo , $telefono , $mensaje ,$fecha));

      return $statement->rowCount();
   }

    //obtenemos las subfamilias para mostrarlas en el modal de editar producto
   public function getSubFamiliaE($familia){
     $query = 'SELECT DISTINCT(grupo) FROM productos WHERE familia = ? and grupo <> ? ORDER BY grupo asc';
     $statement = $this->conexion->prepare($query);
     $statement->execute(array($familia , ''));

     return $statement->fetchAll(PDO::FETCH_ASSOC);
   }


   public function deleteProduct($producto)
   {
      try
      {
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->conexion->beginTransaction();

        $consulta = "DELETE FROM productos WHERE codigo = ?";
        $statement = $this->conexion->prepare($consulta);
        $statement->execute(array($producto));

        $consulta = "DELETE FROM productodetalle WHERE producto = ?";
        $statement = $this->conexion->prepare($consulta);
        $statement->execute(array($producto));

        $consulta = "DELETE FROM destacados WHERE producto = ?";
        $statement = $this->conexion->prepare($consulta);
        $statement->execute(array($producto));

        $consulta = "DELETE FROM diametros WHERE codigo = ?";
        $statement = $this->conexion->prepare($consulta);
        $statement->execute(array($producto));


        $this->conexion->commit();

      }
      catch(Exception $e)
      {
        $this->conexion->rollBack();
        return false;
      }

      return true;
   }


}//cierra clase ProductoModel


 ?>
