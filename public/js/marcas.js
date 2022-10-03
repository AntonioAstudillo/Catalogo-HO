import {ruta} from './config.js'

  var marcas , submarcas;


  //Creamos dos arreglos, uno marca y el otro submarcas. De esta forma evitamos tener que hacer muchas peticiones al servidor.
  getMarcas();
  getSubMarcas();

  //activamos evento de change en formulario de EDITAR
  activarEvento();

  // Call the dataTables jQuery plugin
  $(document).ready(function()
  {
    const listar = function()
    {
       const table = $('#dataTableMarcas').DataTable({
          ajax:{
             "method":'GET',
             'url': ruta+'administrador/marcas?bandera=true',
             "dataSrc": ""
         },
         columns:[
            {'data':'producto'},
            {'data':'marca'},
            {'data':'submarca'},
            {'data':'modelo'},
            {'data':'fmsi'},
            {'data':'noBalata'},
            {'defaultContent':"<div class = 'container'><button class ='btn btn-warning btn-sm ml-1 editar'><i class='fa fa-pencil' aria-hidden='true'></i></button><button class ='btn btn-danger btn-sm ml-1 eliminar'><i class='fa fa-trash' aria-hidden='true'></i></button></div>"}
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

       mostrarData('#dataTableMarcas' , table);

    }//cierra funcion listar

    //Activamos botones click dentro del datatable
    const mostrarData = function(tbody , table)
    {


      $(tbody).on('click' , 'button.editar' , function()
      {
          const data = table.row($(this).parents("tr")).data();
          vistaEditar(data);
      });

      $(tbody).on('click' , 'button.eliminar' , function()
      {
          const data = table.row($(this).parents("tr")).data();
          modalEliminar(data);
      });

    }

    listar();

}); //cierra document ready

 //Activamos evento change a formulario editar
 function activarEvento()
 {

   document.getElementById('formEditarModal').addEventListener('change' , function(){  document.getElementById('btnEditarModal').disabled = false;    }   );
   document.getElementById('btnRegistrarMarca').addEventListener('click', registrarMarca);

 }

 function btnEventoSave()
 {
   document.getElementById('btnEditarModal').addEventListener('click' , saveChanges);
 }

//Mostramos modal de editar
function vistaEditar(data)
{
  $("#modalEditar").modal("show");
  document.getElementById('btnEditarModal').disabled = true;
  document.getElementById('codigoE').value = data.producto;
  document.getElementById('fmsiE').value = data.fmsi;
  document.getElementById('balataE').value = data.noBalata;
  document.getElementById('idRegistro').value = data.id;
  document.getElementById('modeloE').value = data.modelo;

  btnEventoSave();
  llenarMarcas(data);
  llenarSubmarcas(data);
}


/*Bloque de peticiones al servidor*/
function llenarMarcas(data)
{
  let html = '';

  html += `<option checked value='${data.marca}'>${data.marca}</option>`;

  marcas.forEach((marca) => {
       if(marca.marca != data.marca){
         html += `<option value="${marca.marca}">${marca.marca}</option>`;
       }
  });

  document.getElementById('marcaE').innerHTML = html;
}


function llenarSubmarcas(data)
{

    let html = '';

    html += `<option checked value='${data.submarca}'>${data.submarca}</option>`;

    submarcas.forEach((submarca) => {
         if(submarca.submarca != data.submarca){
           html += `<option value="${submarca.submarca}">${submarca.submarca}</option>`;
         }
    });

    document.getElementById('subMarcaE').innerHTML = html;

}


function getMarcas()
{
  let req = new XMLHttpRequest();

  req.open('GET', ruta +'producto/getMarcas');

  req.onreadystatechange = function()
  {

     if(req.readyState == 4 && req.status == 200)
     {
           marcas = JSON.parse(req.responseText);
     }
  }

  req.send();
}

function registrarMarca(e)
{

  if(document.getElementById('codigoP').value == '')
  {
    swal("Error!", "Debe ingresar un código!", "error");
  }
  else
  {
    let req = new XMLHttpRequest();
    let formData = new FormData(document.getElementById('registroMarca'));

    req.open('POST', ruta + 'administrador/registrarMarca');

    req.onreadystatechange = function()
    {

       if(req.readyState == 4 && req.status == 200)
       {

         if(req.responseText > 0)
         {
           $('#dataTableMarcas').DataTable().ajax.reload();
           swal("Buen trabajo!", "Marca añadida correctamente!", "success").then(()=>{
             document.getElementById('registroMarca').reset();
             $("#modalRegistroMarca").modal('hide');
           });
         }else if(req.responseText == 'false'){
           swal("No Existe!", "No hay productos con ese código!", "error");
         }else{
           swal("Error!", "No pudimos concretar la petición!", "error");
         }

       }
    }

    req.send(formData);
  }
}

function getSubMarcas()
{
  let req = new XMLHttpRequest();

  req.open('GET', ruta +'producto/getSubMarcas');

  req.onreadystatechange = function()
  {

     if(req.readyState == 4 && req.status == 200)
     {
           submarcas = JSON.parse(req.responseText);
     }
  }

  req.send();
}

function saveChanges()
{
  let req = new XMLHttpRequest();
  let formData = new FormData(document.getElementById('formEditarModal'));

  req.open('POST', ruta + 'administrador/updateMarca');

  req.onreadystatechange = function()
  {

     if(req.readyState == 4 && req.status == 200)
     {
       if(req.responseText > 0)
       {
         swal("Buen trabajo!", "Cambios realizados correctamente!", "success").then(()=>{
           $('#dataTableMarcas').DataTable().ajax.reload();
           document.getElementById('formEditarModal').reset();
         });

       }
       else if(req.responseText == '0'){
         alert('Tuvimos problemas al actualizar el producto');
       }
     }
  }

  req.send(formData);
}

function eliminarProducto(data){
      $("#modalEliminacion").modal("hide");
      let req = new XMLHttpRequest();
      let formData = new FormData();

      formData.append('id' , data.id);

      req.open('POST', ruta +'administrador/deleteMarca');

      req.onreadystatechange = function()
      {
         if(req.readyState == 4 && req.status == 200)
         {
            if(req.responseText > 0)
            {
              $('#dataTableMarcas').DataTable().ajax.reload();
              swal("Buen trabajo!", "La marca se eliminó con éxito!", "success");
            }
         }
      }

      req.send(formData);
}


//Mostramos el modal y activamos el evento click, dentro del boton de deleteProduct
function modalEliminar(data){
  $("#modalEliminacion").modal("show");
  document.getElementById('btnDeleteProduct').addEventListener('click' ,  function(){ eliminarProducto(data); } );
}
