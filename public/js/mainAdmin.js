import {ruta} from './config.js'



  // Call the dataTables jQuery plugin
  $(document).ready(function()
  {

    //  $.ajax({
    //     "method":'GET',
    //     'url': ruta + 'administrador/all',
    //     "dataSrc": "",
    //     'success': function(data){
    //        console.log(data);
    //     }
    // });
    const listar = function()
    {
       const table = $('#dataTable').DataTable({
          ajax:{
             "method":'GET',
             'url': ruta + 'administrador/all',
             "dataSrc": ""
         },
         columns:[
            {'data':'codigo'},
            {'data':'familia'},
            {'data':'grupo'},
            {'data':'lado'},
            {'data':'empaque'},
            {'data':'uxv'},
            {'defaultContent':"<div class = 'container'> <button class ='btn btn-primary btn-sm mostrar ml-1' data-toggle='modal'><i class='fa fa-eye' aria-hidden='true'></i></button><button class ='btn btn-warning btn-sm ml-1 editar'><i class='fa fa-pencil' aria-hidden='true'></i></button><button class ='btn btn-info btn-sm ml-1 foto'><i class='fa fa-camera' aria-hidden='true'></i></button><button class ='btn btn-danger btn-sm ml-1 eliminar'><i class='fa fa-trash' aria-hidden='true'></i></button></div>"}
         ],
         dom:'Bfrtip',
         buttons:[
           // { extend : 'copyHtml5' , className:'btn btn-dark'},
           { extend : 'excelHtml5' , className:'btn btn-success'},
           { extend : 'csvHtml5' , className:'btn btn-info'},
           { extend : 'pdfHtml5' , className:'btn btn-danger'}
         ],
         language:{
           "emptyTable":'No hay productos',
           'info':'Mostrando del _START_ al _END_ de un total de _TOTAL_ productos',
           'infoEmpty':'Mostrando 0 productos',
           'infoFiltered':'',
           "paginate":{
             'next':'Siguiente',
             'previous':'Anterior'
           },
           'search':'Buscar',
           'zeroRecords':'Sin resultados'
         }
       });

       mostrarData('#dataTable' , table);


       // //activamos evento a modal de registro producto, el campo familiaR para controlar la subfamilias que elija el usuario
       // if(document.getElementById('familiaR') != null)
       // {
       //   document.getElementById('familiaR').addEventListener('change' , function(){alert('holamundo');})
       // }

    }//cierra funcion listar

    //Activamos botones click dentro del datatable
    const mostrarData = function(tbody , table)
    {
      $(tbody).on('click' , 'button.mostrar' , function()
      {
          const data = table.row($(this).parents("tr")).data();
          vistaGeneral(data);
      });

      $(tbody).on('click' , 'button.editar' , function()
      {
          const data = table.row($(this).parents("tr")).data();
          vistaEditar(data);

      });


      $(tbody).on('click' , 'button.foto' , function()
      {

          const data = table.row($(this).parents("tr")).data();
          modalFoto(data);
      });

      $(tbody).on('click' , 'button.eliminar' , function()
      {

          const data = table.row($(this).parents("tr")).data();
          modalEliminar(data);
      });

    }

    //Ejecutamos funciones
    listar();
    activarBTNRegistroProduct();
    activarEventoNext();
  }); //cierra document ready


   //Con esta funcion, vamos a activar el evento del boton de siguiente, dentro del modal de registro Producto

   function activarEventoNext()
   {
      if(document.getElementById('btnNext') != null)
      {
         document.getElementById('btnNext').addEventListener('click' , esconderDivProduct);
      }

      if(document.getElementById('addMarcasDom') != null)
      {
         document.getElementById('addMarcasDom').addEventListener('click' , addDomMarcas);
      }

      if(document.getElementById('delMarcasDom') != null)
      {
         document.getElementById('delMarcasDom').addEventListener('click' , deleteDomMarcas);
      }

      if(document.getElementById('btnPrevious') != null)
      {
         document.getElementById('btnPrevious').addEventListener('click' , esconderDivMarcas);
      }


   }


   //Eliminamos segmento de agregar marcas
   function deleteDomMarcas()
   {
     let padre = document.getElementById('padreMarcas');
     let hijos = padre.childNodes;

     if(hijos.length > 3)
     {
       let hijo = hijos[hijos.length-1];
       padre.removeChild(hijo);
     }


   }

   //Esta funcion la utilizamos para clonar el elemento de agregar marcas dentro del modal de registro de productos.
   function addDomMarcas()
   {

      let padre = document.getElementById('padreMarcas');
      let nodo = document.createElement('div');
      nodo = document.getElementById('hijoMarca');
      const copia = nodo.cloneNode(true);



      let valores = copia.childNodes[1].nextElementSibling;
      //Limpiamos los inputs de balata , modelo y fmsi, para que no almacenen el valor de los inputs anteriores
      valores.childNodes[1].childNodes[3].value = '';
      valores.childNodes[3].childNodes[3].value = '';
      valores.childNodes[5].childNodes[3].value = '';

      //Agregamos la copia al nodo padre
      padre.appendChild(copia);

   }

   function esconderDivProduct()
   {
      //En esta funcoon, vamos a esconder el div de informacion del producto general, y vamos a mostrar el div de marcas
      document.getElementById('divMarcas').classList.remove('desactive');
      document.getElementById('btnNext').classList.add('desactive');
      document.getElementById('divProductGeneral').classList.add('desactive');
      document.getElementById('btnCreateProduct').classList.remove('desactive');
      document.getElementById('btnPrevious').classList.remove('desactive');
   }

   function esconderDivMarcas()
   {
      //escondemos boton create y anterior
      document.getElementById('btnCreateProduct').classList.add('desactive');
      document.getElementById('btnPrevious').classList.add('desactive');

      //Escondemos div marcas
      document.getElementById('divMarcas').classList.add('desactive');

      //mostramos div generalProductData y siguiente
      document.getElementById('btnNext').classList.remove('desactive');
      document.getElementById('divProductGeneral').classList.remove('desactive');

   }


  /*FUNCIONES GENERALES*/
  function activarBTNRegistroProduct()
  {
    if(document.getElementById('btnCreateProduct') != null)
    {
      document.getElementById('btnCreateProduct').addEventListener('click' , createProduct);
    }

  }
 /**fIN DE FUNCIONES GENERALES*/
   /*Bloque de peticiones al servidor*/
   function createProduct()
   {

     if(document.getElementById('codigoR').value === '')
     {
       swal("Error!", "Debe ingresar un código!", "error")
     }
     else
     {
       let req = new XMLHttpRequest();
       let formData = new FormData(document.getElementById('formRegistroProducts'));

       req.open('POST', ruta + 'administrador/crearProducto');
       req.onreadystatechange = function()
       {
          if(req.readyState == 4 && req.status == 200)
          {
             if(req.responseText === 'true')
             {

               swal("Buen trabajo!", "El producto fue añadido correctamente!", "success").then(()=>{
                  window.location.reload();
               });
             }
             else if(req.responseText == 'not')
             {
               swal("Error!", "Debe elegir una familia!", "error")
            }
            else if(req.responseText == 'repetido'){
               swal("Código repetido!", "No sé pueden añadir códigos repetidos!", "error")
            }
            else if(req.responseText == 'falla')
            {
               swal("Error!", "Debe ingresar una marca!", "error")
            }
             else
             {
               swal("Ups!", "No sé pudo añadir el producto!", "error")
             }
          }
       }

       req.send(formData);
     }
   }

   function getFamilias(valor)
   {
     let req = new XMLHttpRequest();
     let html = '';

     req.open('POST', ruta + 'peticiones/getPosiciones');
     req.onreadystatechange = function()
     {
        if(req.readyState == 4 && req.status == 200)
        {
            let posiciones = JSON.parse(req.responseText);

            html += `<option checked value='${valor}'>${valor}</option>`;
            //Hacemos logica de llenar select familias
            posiciones.forEach((posicion) => {
                 if(posicion.posicion != valor){
                   html += `<option value="${posicion.posicion}">${posicion.posicion}</option>`;
                 }
            });

            document.getElementById('posicionEditar').innerHTML = html;
        }
     }

     req.send();
   }


  //Esta funcion se utiliza, para hacer una peticion al controlador, y poder obtener las marcas
  function vistaGeneral(data)
  {
     let req = new XMLHttpRequest();
     let formData = new FormData();

     formData.append('codigo' , data.codigo);

     req.open('POST', ruta + 'peticiones/getDataMarcas');

     req.onreadystatechange = function()
     {
        if(req.readyState == 4 && req.status == 200)
        {
           let marcas = JSON.parse(req.responseText);
           llenarModalVista(data , marcas);
        }
     }

     req.send(formData);
  }

  function deleteProducto(producto){
    let req = new XMLHttpRequest();
    let formData = new FormData();

    formData.append('codigo' , producto.codigo);
    formData.append('imagen' , producto.imagen);


    req.open('POST', ruta +'administrador/deleteProduct');

    req.onreadystatechange = function()
    {
       if(req.readyState == 4 && req.status == 200)
       {
          console.log(req.responseText);

          if(req.responseText)
          {
            swal("Buen trabajo!", "El producto se eliminó con éxito!", "success").then(()=>{
              $('#dataTable').DataTable().ajax.reload();
            });

          }
          else if(req.responseText == 'falla'){
            alert('Tuvimos problemas al eliminar el producto');
          }
       }
    }

    req.send(formData);
  }


  function editarProducto()
  {
     let req = new XMLHttpRequest();
     let formData = new FormData(document.getElementById('formEditarModal'));

     if(localStorage.getItem('bandera') == 'true')
     {
       formData.append('bandera' , 'true');
       formData.append('oldCodigo' , localStorage.getItem('oldCodigo'));
     }

     req.open('POST', ruta + 'administrador/actualizarProducto');

     req.onreadystatechange = function()
     {
        if(req.readyState == 4 && req.status == 200)
         {

          if(req.responseText === 'bad'){
            swal({
               title: "Código repetido!",
               text: "No pueden existir códigos repetidos!",
               icon: "error",
               button: "Ok!",
            });
          }
          else if(req.responseText)
          {
            swal("Buen trabajo!", "El producto se actualizó correctamente!", "success").then(()=>{
              $('#dataTable').DataTable().ajax.reload();
              document.getElementById('formEditarModal').reset();
            });
          }
          else
          {
            alert('Tuvimos problemas al actualizar el producto');
          }

          //Eliminamos estas variables para que no ocasionen conflicto.
          localStorage.removeItem('bandera');
          localStorage.removeItem('oldCodigo');
        }
     }

     req.send(formData);
  }

  function cambiarFoto(data)
  {
    let archivo = "C:\\fakepath\\"+data.imagen;

    if(document.getElementById('newFoto').value == '')
    {
      swal("Debe ingresar una imagen!.");
    }
    else
    {
      let req = new XMLHttpRequest();
      let formData = new FormData(document.getElementById('formFotoModal'));


      formData.append('producto' , data.imagen);
      formData.append('codigo' , data.codigo);

      req.open('POST', ruta + 'administrador/cambiarFoto' , false);

      req.onreadystatechange = function()
      {

         if(req.readyState == 4 && req.status == 200)
         {
            console.log(req.responseText);

           if(req.responseText !== 'false')
           {
             swal("Imagen cambiada con éxito!", "Se actualizará la pagina automaticamente!.", "success").then(() =>
             {
                  req = null;
                  formData = null;
                  window.location.reload();
             });
           }
         }
      }

      req.send(formData);
    }

  }

  function llenarSelectFamilias(valor)
  {
    let req = new XMLHttpRequest();

    req.open('POST', ruta + 'peticiones/getFamilias');

    req.onreadystatechange = function()
    {

       if(req.readyState == 4 && req.status == 200)
       {
            const data = JSON.parse(req.responseText);
            let html = '';

            html += `<option checked value='${valor}'>${valor}</option>`;
            //Hacemos logica de llenar select familias
            data.forEach((familia) => {
                 if(familia.familia != valor){
                   html += `<option value="${familia.familia}">${familia.familia}</option>`;
                 }
            });

            document.getElementById('familiaEditar').innerHTML = html;
       }
    }

    req.send();
  }


  function llenarSelectSubFamilias(data)
  {
      let req = new XMLHttpRequest();
      var formData = new FormData();

      formData.append("familia", data.familia );
      req.open('POST', ruta + 'peticiones/getSubFamilias');

      req.onreadystatechange = function()
      {
         if(req.readyState == 4 && req.status == 200)
         {
            let datos = JSON.parse(req.responseText);
            let html = '';
            if(datos.length != 0)
            {
              html += `<option checked value='${data.grupo}'>${data.grupo}</option>`;
              //Hacemos logica de llenar select familias
              datos.forEach((subfamilia) => {

                   if(data.grupo != subfamilia.grupo){
                     html += `<option value="${subfamilia.grupo}">${subfamilia.grupo}</option>`;
                   }
              });
            }else{
              html += `<option checked selected disabled value=''>Esta familia no tiene subfamilias</option>`;
            }
            document.getElementById('subFamiliaEditar').innerHTML = html;
         }
      }
      req.send(formData);
  }

  /*Fin de bloque de peticiones al servidor*/
  function eliminarProducto(data){
        $("#modalEliminacion").modal("hide");
        //Mandamos a llamar a la funcion que hara la peticion al servidor, para poder elimar
        deleteProducto(data);
  }

  //Este fragmento de codigo se utiliza para mostrar un preview de la imagen cargada
  function previewImg()
  {
    document.getElementById('newFoto').onchange = evt => {
        const [file] = document.getElementById('newFoto').files
           if (file) {
                     document.getElementById('imgProductModal').src = URL.createObjectURL(file);
                 }
          }
  }

  function modalFoto(data)
  {
    //activamos evento de mostrar una vista previa de la imagen
    previewImg();

    $("#modalFoto").modal("show");
    document.getElementById('ModalLongTitle').textContent = `Código: ${data.codigo}`;
    document.getElementById('formFotoModal').addEventListener('submit' , function(e){ e.preventDefault(); cambiarFoto(data)});
    document.getElementById('imgProductModal').src = `../img/productos/${data.imagen}`;
  }


  //Mostramos el modal y activamos el evento click, dentro del boton de deleteProduct
  function modalEliminar(data){
    $("#modalEliminacion").modal("show");
    document.getElementById('btnDeleteProduct').addEventListener('click' ,  function(){ eliminarProducto(data); } );
  }

  function vistaEditar(data)
  {
    $("#modalEditar").modal("show");
    document.getElementById('formEditarModal').addEventListener('change' , activarBotonEditarModal);
    document.getElementById('btnEditarModal').disabled = true;
    document.getElementById('familiaEditar').addEventListener('change', function(){llenarSubfamiliaE(data)} );
    document.getElementById('codigoEditar').addEventListener('change' , function(){activarBandera(data.codigo)});
    llenarModalEditar(data);
  }

  function llenarSubfamiliaE(data)
  {

    let req = new XMLHttpRequest();
    var formData = new FormData();
    let familia = document.getElementById('familiaEditar').value;


    formData.append("familia", familia);

    req.open('POST', ruta + 'administrador/getSubFamiliaE');


    req.onreadystatechange = function()
    {

       if(req.readyState == 4 && req.status == 200)
       {
          let datos = JSON.parse(req.responseText);
          let html = '';

          if(datos.length != 0)
          {
            html += `<option checked value=''>Elige una opción</option>`;
            //Hacemos logica de llenar select familias
            datos.forEach((subfamilia) => {
                html += `<option value="${subfamilia.grupo}">${subfamilia.grupo}</option>`;
            });
          }else{
            html += `<option checked disabled selected value=''>Esta familia no tiene subfamilias</option>`;
          }



          document.getElementById('subFamiliaEditar').innerHTML = html;
       }
    }

    req.send(formData);
  }

  //Con esta función voy a activar el boton de editar del modal
  function activarBotonEditarModal(){
    document.getElementById('btnEditarModal').disabled = false;
    document.getElementById('btnEditarModal').addEventListener('click' , editarProducto);
  }

  function activarBandera(codigo)
  {

    localStorage.setItem('bandera' , 'true');
    localStorage.setItem('oldCodigo' , codigo); //oldCodigo se utiliza para poder cambiar la imagen y no exista conflicto al modificar el codigo de un producto
  }

  //Editar con esta funcion voy a llenar el modal de editarInformacion
  function llenarModalEditar(general)
  {
    let html = '';

    if(general.idProducto != ''){
      document.getElementById('idRegistro').value = general.idproducto;
    }


    if(general.codigo != ''){
      document.getElementById('codigoEditar').value = general.codigo;
    }else{
      document.getElementById('codigoEditar').value = 'N/D';
    }

    if(general.lado != '')
    {
      html = '';

      if(general.lado == 'L')
      {
        html += `<option selected value = "${general.lado}">${general.lado}</option>`;
        html += `<option value = "L-R">L-R</option>`;
        html += `<option value = "R">R </option>`;
      }
      else if(general.lado == 'R'){
        html += `<option selected value = "${general.lado}">${general.lado}</option>`;
        html += `<option value = "L-R">L-R</option>`;
        html += `<option value = "L">L </option>`;
      }else{
        html += `<option selected value = "${general.lado}">${general.lado}</option>`;
        html += `<option value = "L">L</option>`;
        html += `<option value = "R">R</option>`;
      }

    }else{
      html += `<option selected value = "">N/D</option>`;
      html += `<option value = "L">L</option>`;
      html += `<option value = "R">R</option>`;
      html += `<option value = "L-R">L-R</option>`;
    }

    document.getElementById('ladoEditar').innerHTML = html;

    if(general.empaque != ''){
      document.getElementById('empaqueEditar').value = general.empaque;
    }else{
      document.getElementById('empaqueEditar').value = 'N/D';
    }

    if(general.diametroInterior != ''){
      document.getElementById('diamIntEditar').value = general.diametroInterior;
    }else{
       document.getElementById('diamIntEditar').value = 'N/D';
    }

    html = '';
    if(general.tipoPiston != '')
    {

      if(general.tipoPiston == 'B')
      {
        html += `<option selected value = "${general.tipoPiston}">${general.tipoPiston}</option>`;
        html += `<option  value = "A">A</option>`;
        html += `<option  value = "C">C</option>`;
      }
      else if(general.tipoPiston == 'A')
      {
        html += `<option selected value = "${general.tipoPiston}">${general.tipoPiston}</option>`;
        html += `<option  value = "A">A</option>`;
        html += `<option  value = "C">C</option>`;
      }
      else if(general.tipoPiston == 'C'){
        html += `<option selected value = "${general.tipoPiston}">${general.tipoPiston}</option>`;
        html += `<option  value = "A">A</option>`;
        html += `<option  value = "B">B</option>`;
      }
      else{
        html += `<option selected value = "${general.tipoPiston}">${general.tipoPiston}</option>`;
        html += `<option  value = "A">A</option>`;
        html += `<option  value = "B">B</option>`;
        html += `<option  value = "C">C</option>`;
      }

    }else{
      html += `<option selected value = "${general.tipoPiston}">${general.tipoPiston}</option>`;
      html += `<option  value = "A">A</option>`;
      html += `<option  value = "B">B</option>`;
      html += `<option  value = "C">C</option>`;
    }
    document.getElementById('pistonEditar').innerHTML = html;

    html = '';
    if(general.tipoCubrePolvo != '')
    {

      if(general.tipoCubrePolvo == 'BLANDO')
      {
        html += `<option selected value = "${general.tipoCubrePolvo}">${general.tipoCubrePolvo}</option>`;
        html += `<option  value = "DURO">DURO</option>`;
        html += `<option  value = "NO APLICA">NO APLICA</option>`;
      }
      else if(general.tipoCubrePolvo == 'DURO')
      {
        html += `<option selected value = "${general.tipoCubrePolvo}">${general.tipoCubrePolvo}</option>`;
        html += `<option  value = "BLANDO">BLANDO</option>`;
        html += `<option  value = "NO APLICA">NO APLICA</option>`;
      }
      else{
        html += `<option selected value = ""></option>`;
        html += `<option selected value = "NO APLICA">NO APLICA </option>`;
        html += `<option  value = "BLANDO">BLANDO</option>`;
        html += `<option  value = "DURO">DURO</option>`;
      }

    }else{
      html += `<option selected value = "NO APLICA">NO APLICA </option>`;
      html += `<option  value = "BLANDO">BLANDO</option>`;
      html += `<option  value = "DURO">DURO</option>`;
    }
    document.getElementById('cubrePolvoEdit').innerHTML = html;


    if(general.oem != ''){
      document.getElementById('oemEditar').value = general.oem;
    }else{
      document.getElementById('oemEditar').value = 'N/D';
    }

    if(general.codigoEquivalente != ''){
      document.getElementById('equivalenteEditar').value = general.codigoEquivalente;
    }else{
      document.getElementById('equivalenteEditar').value = 'N/D';
    }

    if(general.catalogo != '')
    {
      html = '';
      if(general.catalogo == 'Suspension'){
        html += `<option checked value="${general.catalogo}">${general.catalogo}</option>`;
        html += `<option value='Frenos'>Frenos</option>`;
      }else{
        html += `<option value="Frenos">Frenos</option>`;
        html += `<option value='Suspension'>Suspension</option>`;
      }

      document.getElementById('catalogoEditar').innerHTML = html;
    }

    if(general.descripcion != ''){
      document.getElementById('descripcionEditar').value = general.descripcion;
    }else{
      document.getElementById('descripcionEditar').value = 'Sin descripción';
    }

    if(general.uxv != ''){
      document.getElementById('uxvEditar').value = general.uxv;
    }else{
      document.getElementById('uxvEditar').value = 'N/D';
    }

    if(general.altura != ''){
      document.getElementById('alturaEditar').value = general.altura;
    }else{
      document.getElementById('alturaEditar').value = 'N/D';
    }

    //aqui debemos llenar las familias
     llenarSelectFamilias(general.familia);
     llenarSelectSubFamilias(general);
     getFamilias(general.posicion);
     //aqui debo añadir
  }//cierra funcion modalEditar


  //general: Es la información general del producto
  //marcas: Es la información de las marcas del producto
  function llenarModalVista(general,marcas)
  {
     $("#modalVista").modal("show");

     if(general.codigo != ''){
       document.getElementById('codigoVista').value = general.codigo;
     }else{
       document.getElementById('codigoVista').value = 'N/D';
     }

     if(general.familia != ''){
       document.getElementById('familiaVista').value = general.familia;
     }else{
       document.getElementById('familiaVista').value = 'N/D';
     }

     if(general.grupo != ''){
       document.getElementById('subFamiliaVista').value = general.grupo;
     }else{
       document.getElementById('subFamiliaVista').value = 'N/D';
     }

     if(general.lado != ''){
       document.getElementById('ladoVista').value = general.lado;
     }else{
       document.getElementById('ladoVista').value = 'N/D';
     }

     if(general.empaque != ''){
       document.getElementById('empaqueVista').value = general.empaque;
     }else{
       document.getElementById('empaqueVista').value = 'N/D';
     }

      if(general.posicion != ''){
        document.getElementById('posicionVista').value = general.posicion;
      }else{
        document.getElementById('posicionVista').value = 'N/D';
      }

     if(general.diametroInterior != ''){
       document.getElementById('diamIntVista').value = general.diametroInterior;
     }else{
        document.getElementById('diamIntVista').value = 'N/D';
     }

     if(general.tipoPiston != ''){
       document.getElementById('pistonVista').value = general.tipoPiston;
     }else{
       document.getElementById('pistonVista').value = 'N/D';
     }

     if(general.tipoCubrePolvo != ''){
       document.getElementById('cubrePolvoVista').value = general.tipoCubrePolvo;
     }else{
       document.getElementById('cubrePolvoVista').value = 'N/D';
     }

     if(general.oem != ''){
       document.getElementById('oemVista').value = general.oem;
     }else{
       document.getElementById('oemVista').value = 'N/D';
     }

     if(general.codigoEquivalente != ''){
       document.getElementById('equivalenteVista').value = general.codigoEquivalente;
     }else{
       document.getElementById('equivalenteVista').value = 'N/D';
     }

     if(general.catalogo != ''){
       document.getElementById('catalogoVista').value = general.catalogo;
     }else{
       document.getElementById('catalogoVista').value = 'N/D';
     }

     if(general.descripcion != ''){
       document.getElementById('descripcionVista').value = general.descripcion;
     }else{
       document.getElementById('descripcionVista').value = 'Sin descripción';
     }

     if(general.uxv != ''){
       document.getElementById('uxvVista').value = general.uxv;
     }else{
       document.getElementById('uxvVista').value = 'N/D';
     }

      if(general.altura != ''){
        document.getElementById('alturaVista').value = general.altura;
      }else{
        document.getElementById('alturaVista').value = 'N/D';
      }

     llenarCuerpoTabla(marcas);

  }

  //Con esta funcion genero la tabla de marcas dentro del modal de vista general
  function llenarCuerpoTabla(marcas)
  { let html = "<tr>";

     for (let i in marcas)
     {
        html +=
        `
        <th scope="row">${parseInt(i)+1}</th>
        <td>${marcas[i].marca}</td>
        <td>${marcas[i].submarca}</td>
        <td>${marcas[i].modelo}</td>
        <td>${marcas[i].fmsi}</td>
        <td>${marcas[i].noBalata}</td>
        <tr>`;
     }

     document.getElementById('cuerpoTabla').innerHTML = html;
  }

  //codigo de modal de img
