import {ruta} from './config.js'

$("#listSearch").one( "focus", getSubfamilias );


//Este evento lo vamos a utilizar para poder hacer la peticion  y traer las subfamilias y posteriormente empezar a hacer el filtrado
function getSubfamilias(e)
{
  peticionBusquedaRapida();
  e.target.removeEventListener(e.type, peticionBusquedaRapida);
}

function peticionBusquedaRapida()
{
  let req = new XMLHttpRequest();

    req.open('POST', ruta + 'peticiones/listBox');

    req.onreadystatechange = function()
    {
       if(req.readyState == 4 && req.status == 200)
       {
          var data = JSON.parse(req.responseText);
          document.getElementById('listSearch').addEventListener('keyup' , function(){filtrado(data)});
       }
    }

    req.send();

}//cierra funcion peticionBusquedaRapida

function eliminarRepetidos(data)
{
   const filteredArray = data.filter(function(ele , pos){
      return data.indexOf(ele) == pos;
   });

   return filteredArray
}

function filtrado(data)
{
  let valor = document.getElementById('listSearch').value;
  data = eliminarRepetidos(data);

  const resultado = data.filter(subfamilia => subfamilia.indexOf(valor.toUpperCase())>=0);
  mostrarContenido(resultado);

}


function mostrarContenido(data)
{
  let lista = document.getElementById('myList');
  let codigo = "";

  if(data.length == 0)
  {
    codigo += ` <li disabled readonly class="list-group-item">Sin información</li>`;
  }
  else
  {
    for (let i = 0; i < 50; i++)
    {
       if(data[i] !== undefined){
          codigo += ` <li class="list-group-item listFast">${data[i]}</li>`;
       }
    }
  }

  lista.innerHTML = codigo;

  if(lista.classList.contains('esconder'))
  {
     lista.classList.remove("esconder");
     lista.classList.add('mostrar');
  }

  addEventoItemList(lista);

}//cierra funcion mostrar contenido

function addEventoItemList(nodo){
  const nodos = nodo.children;
  const tam = nodos.length;

  for (var i = 0; i < tam; i++) {
       nodos[i].addEventListener('click' , llenarInputListSearch );
       nodos[i].addEventListener('click' , esconderContenido );
  }

}


function llenarInputListSearch(e){
  document.getElementById('listSearch').value = e.target.textContent;
}


function esconderContenido()
{
  let lista = document.getElementById('myList');

  if(lista.classList.contains('mostrar')){
     lista.classList.remove("mostrar");
     lista.classList.add('esconder');
  }

}
