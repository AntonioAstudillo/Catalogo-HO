import {ruta} from './config.js'

//Llenamos las marcas del select de busqueda personalizada
export function llenarMarcas()
{
   let req = new XMLHttpRequest();

   req.open('POST', ruta + 'peticiones/getMarcas');

   req.onreadystatechange = function()
   {
       if(req.readyState == 4 && req.status == 200)
       {
          const data = JSON.parse(req.responseText);

          if(document.getElementById('aplicacionPrs') !== null)
          {
             const id = document.getElementById('aplicacionPrs');
             putSelect(data , '-- Elige una Marca -- ' , id);
          }
       }
   }
   req.send();
}



export function peticionLlenarSubMarcas()
{
   let req = new XMLHttpRequest();
   let formData = new FormData();

   formData.append('marca' , document.getElementById('aplicacionPrs').value);
   req.open('POST', ruta + 'peticiones/getSubMarcas');

   req.onreadystatechange = function()
   {
       if(req.readyState == 4 && req.status == 200)
       {
            const data = JSON.parse(req.responseText);

            if(document.getElementById('subaplicacionPrs') !== null)
            {
               const id = document.getElementById('subaplicacionPrs');
               putSelect(data , '-- Elige una subMarca -- ' , id);
            }


       }
   }

   req.send(formData);
}


//Insertamos las marcas dentro del select de busqueda personalizada
function putSelect(data , mensaje , id)
{
   let codigo = `<option value='0' selected disabled> ${mensaje} </option>`;


   if(data.length == 0 )
   {
      codigo += `<option value='0'>No hay datos</option>`;
   }
   else
   {
      data.forEach((data, i) =>
      {
         if(typeof data.marca !== "undefined")
         {
            codigo += `<option value='${data.marca}'>${data.marca}</option>`;
         }
         else{
            codigo += `<option value='${data.submarca}'>${data.submarca}</option>`;
         }

      });
   }

    id.innerHTML = codigo;
}
