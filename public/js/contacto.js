import {ruta} from './config.js'

  // Call the dataTables jQuery plugin
  $(document).ready(function()
  {
    const listar = function()
    {
       const table = $('#tableContacto').DataTable({
          ajax:{
             "method":'GET',
             'url': ruta + 'administrador/getMensajes',
             "dataSrc": ""
         },
         columns:[
            {'data':'id'},
            {'data':'correo'},
            {'data':'nombre'},
            {'data':'telefono'},
            {'data':'fecha'},
            {'defaultContent':"<div class = 'container'><button class ='btn btn-primary btn-sm vista'><i class='fa fa-envelope' aria-hidden='true'></i></div>"}
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

       mostrarData('#tableContacto' , table);

    }//cierra funcion listar

    //Activamos botones click dentro del datatable
    const mostrarData = function(tbody , table)
    {
      $(tbody).on('click' , 'button.vista' , function()
      {
          const data = table.row($(this).parents("tr")).data();
          mensajeModal(data);
      });
    }

    listar();

}); //cierra document ready


//Mostramos modal de editar
function mensajeModal(data)
{
  $("#modalVista").modal('show');

  document.getElementById('mensajeModal').value = data.mensaje;

}
