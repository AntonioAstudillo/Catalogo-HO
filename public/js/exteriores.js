import {ruta} from './config.js'
  // Call the dataTables jQuery plugin
  $(document).ready(function()
  {
    const listar = function()
    {
       const table = $('#tableDiametros').DataTable({
          ajax:{
             "method":'POST',
             'url': ruta +'administrador/getDiametrosExt',
             "dataSrc": ""
         },
         columns:[
            {'data':'codigo'},
            {'data':'diametro'},
            {'defaultContent':"<div class = 'container'><button class ='btn btn-warning btn-sm ml-1 editar'><i class='fa fa-pencil' aria-hidden='true'></i></button><button class ='btn btn-danger btn-sm ml-1 eliminar'><i class='fa fa-trash' aria-hidden='true'></i></button></div>"}
         ],
         order:[[0,'asc']],
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

       mostrarData('#tableDiametros' , table);

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

    activarBtnDiametroReg();

}); //cierra document ready

//Mostramos modal de editar
function vistaEditar(data)
{
  $("#modalEditar").modal("show");
  document.getElementById('codigoD').value = data.codigo;
  document.getElementById('idRegistro').value = data.id;
  document.getElementById('diametroE').value = data.diametro;
  document.getElementById('btnEditarModal').addEventListener('click' , saveChanges);


}


function saveChanges()
{
  let req = new XMLHttpRequest();
  let formData = new FormData(document.getElementById('formDiametrosE'));

  req.open('POST', ruta + 'administrador/updateDiametro');

  req.onreadystatechange = function()
  {

     if(req.readyState == 4 && req.status == 200)
     {
        console.log(req.responseText);

       if(req.responseText > 0)
       {

         swal("Buen trabajo!", "Cambios realizados correctamente!", "success").then(()=>{
           $('#tableDiametros').DataTable().ajax.reload();
           document.getElementById('formDiametrosE').reset();
         });

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

      req.open('POST', ruta + 'administrador/deleteDiametro');

      req.onreadystatechange = function()
      {
         if(req.readyState == 4 && req.status == 200)
         {
            if(req.responseText > 0)
            {

              swal("Buen trabajo!", "El diámetro se eliminó con éxito!", "success").then(()=>{
                 $('#tableDiametros').DataTable().ajax.reload();
              });
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


function activarBtnDiametroReg(){
   if(document.getElementById('btnRegistrarDiametro') != null){
      document.getElementById('btnRegistrarDiametro').addEventListener('click' , registrarDiametro);
   }
}

function registrarDiametro(){
   //antes de hacer la peticion, debemos comprobar que tanto el codigo como el diametro, no esten vacios
   if(document.getElementById('codigoP').value == '' || document.getElementById('diametroR') == ''){
     swal("Datos incorrectos!", "", "error")
   }else{
      let req = new XMLHttpRequest();
      let formData = new FormData();

      formData.append('codigo' , document.getElementById('codigoP').value );
      formData.append('diametro' , document.getElementById('diametroR').value );

      req.open('POST', ruta +'administrador/registrarDiametro');

      req.onreadystatechange = function()
      {
         if(req.readyState == 4 && req.status == 200)
         {
            if(req.responseText > 0)
            {

             swal("Buen trabajo!", "El diámetro se agregó con éxito!", "success").then(()=>{
                 $('#tableDiametros').DataTable().ajax.reload();
                 $('#modalRegistroMarca').modal('hide');
                 document.getElementById('registroMarca').reset();
             });
          }else if(req.responseText == 'noExiste'){
             swal("ERROR!", "No existe un producto con ese código!", "error");
          }
         }
      }

      req.send(formData);
   }
}
