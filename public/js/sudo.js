
import {ruta} from './config.js'
    // Call the dataTables jQuery plugin
    $(document).ready(function()
    {

      const listar = function()
      {
         const table = $('#dataSudo').DataTable({
            ajax:{
               "method":'GET',
               'url': ruta + 'administrador/getUsers',
               "dataSrc": ""
           },
           columns:[
              {'data':'id'},
              {'data':'user'},
              {'data':'password'},
              {'data':'nombre'},
              {'data':'avatar'},
              {'defaultContent':"<div class = 'container'><button class ='btn btn-warning btn-sm ml-1 editar'><i class='fa fa-pencil' aria-hidden='true'></i></button><button class ='btn btn-danger btn-sm ml-1 eliminar'><i class='fa fa-trash' aria-hidden='true'></i></button></div>"}
           ],
           lengthChange: false,
           language:{
             "emptyTable":'No hay usuarios',
             'info':'Mostrando del _START_ al _END_ de un total de _TOTAL_ usuarios',
             'infoEmpty':'Mostrando 0 usuarios',
             'infoFiltered':'',
             "paginate":{
               'next':'Siguiente',
               'previous':'Anterior'
             },
             'search':'Buscar',
             'zeroRecords':'Sin resultados'
           }
         });

          mostrarData('#dataSudo' , table);

       }


       //Activamos botones click dentro del datatable
       const mostrarData = function(tbody , table)
       {
         $(tbody).on('click' , 'button.editar' , function()
         {
             const data = table.row($(this).parents("tr")).data();
             modalEditar(data);

         });


         $(tbody).on('click' , 'button.eliminar' , function()
         {

             const data = table.row($(this).parents("tr")).data();
             modalEliminar(data);
         });

      }


       listar();
       activarRegistroUsuario();

    }); //cierra document ready

    function activarRegistroUsuario()
    {
      if(document.getElementById('btnCrearUserA') != null)
      {
        document.getElementById('btnCrearUserA').addEventListener('click' , registrarUsuario);
      }
    }

    function modalEditar(data)
    {
      $("#modalEditarU").modal("show");
      let html = '';
      cambiosModalEditar();
      localStorage.clear();
      localStorage.removeItem('changePass');

      document.getElementById('btnUpdateU').addEventListener('click' , function(){actualizarUser(data);});

      document.getElementById('nombreE').value = data.nombre;
      document.getElementById('userE').value = data.user;
      document.getElementById('nombreE').value = data.nombre;
      document.getElementById('idRegistro').value = data.id;


      if(data.avatar == 'A'){
        html += `<option selected value="A">A</option>`;
        html += `<option  value="M">M</option>`;
        html += `<option  value="H">H</option>`;
      }
      else if(data.avatar == 'M'){
        html += `<option selected value="M">M</option>`;
        html += `<option  value="A">A</option>`;
        html += `<option  value="H">H</option>`;
      }else{
        html += `<option selected value="H">H</option>`;
        html += `<option  value="A">A</option>`;
        html += `<option  value="m">m</option>`;
      }

      document.getElementById('tipoA').innerHTML = html;


      document.getElementById('btnRestablecer').addEventListener('click' , function(){
           document.getElementById('passwordE').disabled = false;
           document.getElementById('passwordE').value = '';
           document.getElementById('passwordE').setAttribute('placeholder' , 'Nueva contraseña');

           localStorage.setItem('changePass' , 'true');

      });
    }

    function actualizarUser(data)
    {

      let bandera = localStorage.getItem('changePass');
      let req = new XMLHttpRequest();
      let formData = new FormData(document.getElementById('formUpdateUser'));


      if(bandera != null){
         formData.append('restablecer' , 'true');
      }

      if(document.getElementById('passwordE') == ''){
           swal("Contraseña vacía");
      }
      else
      {
         req.open('POST', ruta + 'administrador/updateUser');
         req.onreadystatechange = function()
          {
            if(req.readyState == 4 && req.status == 200)
             {

               console.log(req.responseText);

               if(req.responseText)
               {
                 swal("Buen trabajo!", "Cambios hechos correctamente!", "success").then(()=>{
                   document.getElementById('formUpdateUser').reset();
                   $('#dataSudo').DataTable().ajax.reload();
                   $('#modalEditarU').modal('hide');
                 });
               }
             }
           }

           req.send(formData);
         }
      }

    function cambiosModalEditar(){
      document.getElementById('passwordE').disabled = true;
      document.getElementById('passwordE').value = '********************';
    }


    function registrarUsuario()
    {
      let req = new XMLHttpRequest();
      let formData = new FormData(document.getElementById('formRegistroUser'));


      req.open('POST', ruta + 'administrador/registrarUser');

      req.onreadystatechange = function()
      {
        if(req.readyState == 4 && req.status == 200)
        {

          if(req.responseText)
          {
            swal("Buen trabajo!", "Usuario registrado!", "success").then(()=>{
              document.getElementById('formRegistroUser').reset();
              $('#dataSudo').DataTable().ajax.reload();
              $('#modalRegistroProducto').modal('hide');
            });
          }
        }
      }

      req.send(formData);


    }

    //Mostramos el modal y activamos el evento click, dentro del boton de deleteProduct
    function modalEliminar(data)
    {
      $("#modalEliminacion").modal("show");
      document.getElementById('btnDeleteProduct').addEventListener('click' ,  function(){ eliminarProducto(data); } );
    }

    function eliminarProducto(data)
    {

      let req = new XMLHttpRequest();
      let formData = new FormData();

      formData.append('id' , data.id);

      req.open('POST', ruta + 'administrador/deleteUser');

      req.onreadystatechange = function()
      {
        if(req.readyState == 4 && req.status == 200)
        {

          if(req.responseText > 0)
          {
            swal("Buen trabajo!", "Usuario Eliminado!", "success").then(()=>{
              $('#dataSudo').DataTable().ajax.reload();
            });
          }
        }
      }

      req.send(formData);
    }
