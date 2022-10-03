<?php

class AdministradorModelo
{
   private $conexion;

   function __construct(){
      //hago una instancia de la conexion para poder hacer operaciones a la base de datos
      $this->conexion = new Mysql();
      $this->conexion = $this->conexion->getConexion();
   }


   public function comprobarUser($user , $password)
   {
      $query = "SELECT * FROM usuarios WHERE user = ?";
      $statement = $this->conexion->prepare($query);
      $statement->execute(array($user));
      $data = $statement->fetchAll(PDO::FETCH_ASSOC);

      if($statement->rowCount()>0)
      {
         if(password_verify($password , $data[0]['password']))
         {
            return $data;
         }
         else
         {
            return false;
         }
      }

      return $data;
   }


   /**
    * [getProductos Este metodo lo utilizamos para dibujar en el datatable de  vista admin, todos los productos de la database]
    * @return [type] [description]
    */
   public function getProductos()
   {
      $consulta = "SELECT * FROM productos";
      $statement = $this->conexion->prepare($consulta);
      $statement->execute();

      return $statement->fetchAll(PDO::FETCH_ASSOC);
   }


   //Con esta funcion, registramos un codigo, en sus distintas tablas, para que la pagina web pueda funcionar correctamente.

   /**
    * [createProduct description]
    * @param  [Array] $data               [Array asociativo con todos los datos del producto a registrar. Las querys van dentro de una transaccion para que exista consistencia con los datos que se almacenan]
    * @return [Boolean]       [Retorna true en caso de exito, false en caso de algun error]
    */
   public function createProduct($data)
   {
      try
      {
         $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $this->conexion->beginTransaction();

         //insertamos primero en la tabla productodetalle
         $this->insertMarcas($data);

         //Si el producto es destacado, lo almacenamos en la tabla que lleva el mismo nombre, para que se pueda mostrar en el carousel de home
         if(isset($data['destacadoR']))
         {
            $this->insertDestacados($data);
         }

         $consulta = "INSERT INTO productos VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
         $statement = $this->conexion->prepare($consulta);
         $statement->execute(array(null,$data['codigoR'],$data['familiaR'],$data['subfamiliaR'],$data['descripcionR'],$data['posicionR'],$data['cubrePolvoR'],$data['pistonR'],$data['ladoR'],$data['empaqueR'],$data['uxvR'],$data['diamIntR'],$data['equivalenteR'],$data['oemR'],$data['alturaR'],$data['imagen'],$data['catalogosR']));

         $this->conexion->commit();

      }catch (Exception $e) {
         $this->conexion->rollBack();
         return false;
      }

      return true;
   }//cierra function crear


   /**
    * [insertDestacados Insertamos un codigo en la tabla destacados en dado caso que el producto lo sea]
    * @param  [String] $data               [Recibimos un string el cual corresponde al codigo del producto]
    * @return [null]       [no retornamos nada, ya que esta funcion se ejecuta dentro de una transaccion en el metodo createProduct]
    */
   private function insertDestacados($data)
   {
      $consulta = "INSERT INTO destacados VALUES(?,?)";
      $statement = $this->conexion->prepare($consulta);
      $statement->execute(array(null , $data['codigoR']));
   }



   //Con esta función vamos a insertar todas las marcas dentro de la tabla productodetalle

   /**
    * [insertMarcas Insertamos las marcas dentro de la tabla productoDetalle]
    * @param  [array] $data               [Recibimos como parametro, un array asociativo, con todas las marcas. Estos valores los obtenemos del modal de crear producto]
    * @return [Boolean]       [Retornamos un valor booleano en caso de exito]
    */
   private function insertMarcas($data)
   {
      $tam = count($data['marcaR']);
      $consulta = "INSERT INTO productodetalle VALUES(?,?,?,?,?,?,?)";
      $statement = $this->conexion->prepare($consulta);

      for ($i=0; $i < $tam  ; $i++) {
         $statement->execute(array(null, $data['codigoR'] , $data['marcaR'][$i] ,   $data['submarcasR'][$i]  ,  $data['modeloR'][$i]  , $data['fmsiR'][$i]  ,  $data['balataR'][$i]));
      }

      return true;
   }

   /*
       *****************************************************
       *****************************************************

       Bloque de metodos utilizados para llenar los campos dentro de los modales
    */

   //Esta funcion se utiliza para obtener la data de un terminado codigo(producto)
   //El valor que recibe es un string
   public function getData($codigo)
   {
      $consulta = "SELECT * FROM productodetalle WHERE producto = ?;";
      $statement = $this->conexion->prepare($consulta);
      $statement->execute(array($codigo));

      return $statement->fetchAll(PDO::FETCH_ASSOC);
   }


   /**
    * [updateChangeCodeProduct Actualizamos un producto de la base de datos. Esta funcion la utilizamos dentro del modal de editar siempre y cuando se haya modificado el codigo del producto]
    * @param  [Array] $data               [Array asociativo con todos los valores del producto a actualizar]
    * @return [boolean]       [true en caso de exito, cero en caso de error]
    */
   public function updateChangeCodeProduct($data)
   {
      try
       {
         $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $this->conexion->beginTransaction();

         $consulta = "UPDATE productos set familia = ? ,  grupo = ? , descripcion = ? , posicion = ? , tipoCubrePolvo = ? , tipoPiston = ? , lado = ? , empaque = ? , uxv = ? , diametroInterior = ? , codigoEquivalente = ? , oem = ? , catalogo = ?  , codigo = ?  , altura = ? , imagen = ? where idproducto = ?";
         $statement = $this->conexion->prepare($consulta);
         $statement->execute(array($data['familia'] , $data['grupo'], $data['descripcion'] , $data['posicion'], $data['cubrePolvoEdit'], $data['pistonEditar'], $data['lado'], $data['empaque'], $data['uxv'] , $data['diametroInterior'], $data['equivalente'],  $data['oem'],$data['catalogo'], $data['codigo'],$data['alturaEditar'], $data['codigo'].'.jpg', $data['idRegistro']));

         $consulta = 'UPDATE productodetalle SET producto = ? where producto = ?';
         $statement = $this->conexion->prepare($consulta);
         $statement->execute(array($data['codigo'] , $data['oldCodigo']));

         $consulta = 'UPDATE destacados SET producto = ? WHERE producto = ?';
         $statement = $this->conexion->prepare($consulta);
         $statement->execute(array($data['codigo'] , $data['oldCodigo']));

         $consulta = 'UPDATE diametros SET codigo = ? WHERE codigo = ?';
         $statement = $this->conexion->prepare($consulta);
         $statement->execute(array($data['codigo'] , $data['oldCodigo']));

        $this->conexion->commit();

       }
       catch(Exception $e){
         $this->conexion->rollBack();
         return '0';
       }

      return true;

   }//cerramos funcion update change


   /**
    * [updateProducto Actualizamos un producto de la base de datos siempre y cuando no se haya modificado el codigo de un producto]
    * @param  [Array] $data               [arreglo asociativo con los valores del producto a actualizar]
    * @return [Int]       [Retorna la cantidad de filas afectadas]
    */
   public function updateProducto($data)
   {
       $consulta = "UPDATE productos set familia = ? ,  grupo = ? , descripcion = ? , posicion = ? , tipoCubrePolvo = ? , tipoPiston = ? , lado = ? , empaque = ? , uxv = ? , diametroInterior = ? , codigoEquivalente = ? , oem = ? , catalogo = ?  , codigo = ? , altura = ? where idproducto = ?";
       $statement = $this->conexion->prepare($consulta);
       $statement->execute(array($data['familia'] , $data['grupo'], $data['descripcion'] , $data['posicion'], $data['cubrePolvoEdit'], $data['pistonEditar'], $data['lado'], $data['empaque'], $data['uxv'] , $data['diametroInterior'], $data['equivalente'],  $data['oem'], $data['catalogo'],  $data['codigo'] , $data['alturaEditar'] , $data['idRegistro']));

      return $statement->rowCount();
   }


   /*
     ****************************************************************************************
     METODOS UTILIZADOS PARA LLENAR LOS DISTINTOS SELECTS DENTRO DEL MODAL DE CREAR PRODUCTO
     *****************************************************************************************
   */

   public function getFamilias()
   {
     $consulta = "SELECT distinct(familia) FROM familias order by familia asc";
     $statement = $this->conexion->prepare($consulta);
     $statement->execute();

     return $statement->fetchAll(PDO::FETCH_ASSOC);
   }


   //metodo utilizado para llenarel modal crear productos
   public function getSubFamilias()
   {
     $consulta = "SELECT subfamilia FROM subfamilias order by subfamilia asc";
     $statement = $this->conexion->prepare($consulta);
     $statement->execute();

     return $statement->fetchAll(PDO::FETCH_ASSOC);
   }



   public function getCatalogos()
   {
     $consulta = "SELECT DISTINCT(catalogo) FROM productos";
     $statement = $this->conexion->prepare($consulta);
     $statement->execute();

     return $statement->fetchAll(PDO::FETCH_ASSOC);
   }


   public function getPosiciones()
   {
     $consulta = "SELECT DISTINCT(posicion) FROM productos WHERE posicion <> '' ORDER BY posicion ASC";
     $statement = $this->conexion->prepare($consulta);
     $statement->execute();

     return $statement->fetchAll(PDO::FETCH_ASSOC);
   }


   public function getLados()
   {
     $consulta = "SELECT DISTINCT(lado) FROM productos WHERE lado <> '' ORDER BY lado ASC";
     $statement = $this->conexion->prepare($consulta);
     $statement->execute();

     return $statement->fetchAll(PDO::FETCH_ASSOC);
   }


   public function getMarcas()
   {
      $consulta = "SELECT DISTINCT(marca) FROM productodetalle  WHERE marca <> ? ORDER BY marca asc";

      $statement = $this->conexion->prepare($consulta);
      $statement->execute(array(''));

      return $statement->fetchAll(PDO::FETCH_ASSOC);

   }

   public function getSubMarcas()
   {
      $consulta = "SELECT DISTINCT(submarca) FROM productodetalle WHERE submarca <> ?  ORDER BY submarca asc";

      $statement = $this->conexion->prepare($consulta);
      $statement->execute(array(''));

      return $statement->fetchAll(PDO::FETCH_ASSOC);
   }




   /*
      FIN DE BLOQUE DE METODOS UTILIZADOS PARA LLENAR SELECTS DENTRO DEL MODAL DE CREAR PRODUCTO
      *************************************************************************
   */


   /*Funcion para comprobar si un codigo ya existe Recibe como argumento un string
  Retorna un numero entero, si ese numero entero es mayor a 0, significa que ya existe una marca registrada
*/
public function thereAreCode($codigo)
{
  $consulta = "SELECT * FROM productos WHERE codigo = ?";
  $statement = $this->conexion->prepare($consulta);
  $statement->execute(array($codigo));
  return $statement->rowCount();
}



//Metodo utilizado, para modificar el nombre de la imagen
public function actualizarImagen($codigo , $name)
{
  $consulta = "UPDATE productos SET imagen = ? WHERE codigo = ?";
  $statement = $this->conexion->prepare($consulta);
  $statement->execute(array($name , $codigo));

  return $statement->rowCount();

}


//obtenemos los datos de la tabla productodetalle para mostrarlos en la vistaMarcas
public function getProductoDetalle()
{
  $consulta = "SELECT * FROM productodetalle";
  $statement = $this->conexion->prepare($consulta);
  $statement->execute();

  return $statement->fetchAll(PDO::FETCH_ASSOC);

}


//actualizmaos los cambios que se hagan en la view marcasVista
public function updateProductoDetalle($data){
  $consulta = "UPDATE productodetalle SET marca = ? , submarca = ? , modelo = ? , fmsi = ? , noBalata = ? WHERE id = ?";
  $statement = $this->conexion->prepare($consulta);
  $statement->execute(array($data['marcaE'] , $data['subMarcaE'] , $data['modeloE'] , $data['fmsiE'] , $data['balataE'], $data['idRegistro']));

  return $statement->rowCount();

}



//Eliminados un registro dentro de la tabla productodetalle
public function deleteProductoDetalle($id)
{
  $consulta = "DELETE FROM productodetalle WHERE id = ?";
  $statement = $this->conexion->prepare($consulta);
  $statement->execute(array($id['id']));

  return $statement->rowCount();
}


//Le registramos una marca nuevo a un producto existente
public function registerMarca($data)
{
   $query = "INSERT INTO productodetalle VALUES(?,?,?,?,?,?,?)";
   $statement = $this->conexion->prepare($query);
   $statement->execute(array(null , $data['codigoP'],$data['marcaR'],$data['submarcasR'],$data['modeloR'],$data['fmsiR'],$data['balataR']));

   return $statement->rowCount();
}


//utilizamos este metodo para llenar el datatable del modulo diametros dentro del administradorVista
public function getDiametros(){
   $query = "SELECT * FROM diametros ORDER BY codigo";
   $statement = $this->conexion->prepare($query);
   $statement->execute();

   return $statement->fetchAll(PDO::FETCH_ASSOC);

}


public function registrarDiametro($data){

   if($this->thereAreCode($data['codigo'])<=0){
      echo 'noExiste';
   }else{
      $query = "INSERT INTO diametros VALUES(?,?,?)";
      $statement = $this->conexion->prepare($query);
      $statement->execute(array(null , $data['codigo'] , $data['diametro']));

      return $statement->rowCount();
   }

}


//Actualizamos un registro de la tabla diametros
public function updateDiametro($data){
   $query = "UPDATE diametros SET diametro = ? WHERE id = ?";
   $statement = $this->conexion->prepare($query);
   $statement->execute(array($data['diametroE'] , $data['idRegistro'] )  );

   return $statement->rowCount();

}

//le eliminamos un diametro a un producto dentro de la vista administrador modulo diametros exteriores
public function deleteDiametro($data){
   $query = "DELETE FROM diametros WHERE id = ?";
   $statement = $this->conexion->prepare($query);
   $statement->execute(array($data['id']));

   return $statement->rowCount();

}

//metodo utilizado para obtener los registros que se vayan generando en la tabla contacto
public function getContacto(){
  $query = "SELECT * FROM contacto";
  $statement = $this->conexion->prepare($query);
  $statement->execute();
  return $statement->fetchAll(PDO::FETCH_ASSOC);
}


/*
    *******************************************
    INICIO DE BLOQUE DE METODOS DE MODULO SUDO
    *********************************************
 */
//utilizamos este metodo para obtener todos los usuarios y mostrarlos en el datatable de sudo
public function getUsers(){
  $query = "SELECT * FROM usuarios";
  $statement = $this->conexion->prepare($query);
  $statement->execute();
  return $statement->fetchAll(PDO::FETCH_ASSOC);

}


// con este metodo actualizamos los datos de un usuario dentro de la vista sudo
public function updateUser($data)
{
   if(isset($data['restablecer']))
   {
      $query = "UPDATE usuarios SET user = ? , password = ? , nombre = ? , avatar = ? WHERE id = ? ";
      $statement = $this->conexion->prepare($query);
      $statement->execute(array($data['userE'] , $data['passwordE'] , $data['nombreE'] , $data['tipoA']  , $data['idRegistro']));
   }
   else
   {
      $query = "UPDATE usuarios SET user = ? , nombre = ? , avatar = ? WHERE id = ? ";
      $statement = $this->conexion->prepare($query);
      $statement->execute(array($data['userE'] , $data['nombreE'] , $data['tipoA']  , $data['idRegistro']));
   }

   return $statement->rowCount();

}//cierra funcion updateUser


//insertamos un usuario. Este metodo se usa en la vista sudo
public function insertUser($data){

  $query = "INSERT INTO usuarios VALUES(?,?,?,?,?)";
  $statement = $this->conexion->prepare($query);
  $statement->execute(array(null , $data['userA'] , $data['passwordA'] , $data['nombreA'] , $data['tipoA']));

  return $statement->rowCount();

}


public function deleteUser($data){
  $query = "DELETE FROM usuarios WHERE id = ?";
  $statement = $this->conexion->prepare($query);
  $statement->execute(array($data['id']));
  return $statement->rowCount();
}

/*
    *******************************************
    FIN DE BLOQUE DE METODOS DE MODULO SUDO
    *********************************************
 */

















}




 ?>
