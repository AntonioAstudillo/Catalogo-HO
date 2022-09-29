(()=>{

  window.onload = main;

  function main(){



    if(document.getElementById('btnIngresarL') != null)
    {
      document.getElementById('btnIngresarL').addEventListener('click',signIn);
    }
  }//cierra funcion main;


  function signIn(e)
  {
    e.preventDefault();

    grecaptcha.ready(function()
    {
       grecaptcha.execute('6Lc3M2YhAAAAAL9cM3u-5tX7RCJQMN_r00QZTtWf',
       {
         action: 'submit'

       }).then(function(token) {

         let req = new XMLHttpRequest();
         let formData = new FormData(document.getElementById('formLoginHO'));

         formData.append('recaptchaHO' , token);

         req.open('POST', ruta + 'administrador/sesion');

         req.onreadystatechange = function()
         {
            if(req.readyState == 4 && req.status == 200)
            {
               if(req.responseText == 'true')
               {
                  Swal.fire({
                     position: 'center',
                     icon: 'success',
                     title: 'Acceso Correcto',
                     showConfirmButton: false,
                     timer: 1500
                 }).then(()=>{
                    window.location.href = 'admin.php';
                 });

             }
             else if(req.responseText == 'block')
             {
                window.location.href = '404.html';
             }
             else
             {
                Swal.fire({
                   position: 'center',
                   icon: 'error',
                   title: 'Acceso Denegado',
                   showConfirmButton: false,
                   timer: 1500
                });
            }
         }
      }

      req.send(formData);

       });

    });
  }//cierra funcion signIn
})();
