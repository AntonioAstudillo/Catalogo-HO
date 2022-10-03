   import {llenarMarcas , peticionLlenarSubMarcas} from './peticiones.js'
   import {ruta} from './config.js'

	window.onload = main;

	function main()
	{
		//LE damos funcionalidad al boton top.
      goToTopButton();

		//Le agregamos el evento de modal a todos nuestros botones detalles
		eventosDetalles();

		//Esta logica es correspondiente al sidebar
		sidebar();

		//Llenar select de marcas en busquedaPersonalizada
		llenarMarcas();

		//Eventos de busqueda rapida
		eventosBusquedaRapida();

		//bloquear copiar contenido pagina web
		// blockCopy();

		//datatable
		datatable();

		// //Evento para busqueda avanzada
      eventosBusquedaAvanzada();


		//boton spinner
		botonSpinner();

		//Evento de busqueda rapida Search box
		searchBox();

		//Evento de busqueda rapida en nuevo search box
		if(document.getElementById('idProduct') != null){
			document.getElementById('idProduct').addEventListener('change' , BRapida);
		}

		//Este evento lo utilizo en la vista de contacto.php
		if(document.getElementById('btnContacto') !=null){
			document.getElementById('btnContacto').addEventListener('click' , contacto);
		}

	}//cierra funcion main


	//Formulario de contacto
	function contacto(e)
  {
		e.preventDefault();

		grecaptcha.ready(function()
		{
			 grecaptcha.execute('6LcazT8iAAAAANdWuJVBmYyGv-xHaM_p3TZNED7q',
			 {
				 action: 'submit'

			 }).then(function(token) {

					let req = new XMLHttpRequest();
					let formData = new FormData();


				 if(document.getElementById('btnContacto') !== null)
				 {
						document.getElementById('btnContacto').classList.add('invisible' ,'d-none');
				 }

				 if(document.getElementById('loading') !== null)
				 {
						document.getElementById('loading').classList.remove('invisible' ,'d-none');
				 }

				 if(document.getElementById('correoContact').value === '' || document.getElementById('nombreContact').value === '' || document.getElementById('apellidoContact').value === '' || document.getElementById('telefonoContact').value === '' ||  document.getElementById('mensajeContact').value == '')
				 {
				    Swal.fire(
						   'Datos incompletos!',
							 '',
							 'error'
				     );


                 if(document.getElementById('btnContacto') !== null){
                        document.getElementById('btnContacto').classList.remove('invisible' ,'d-none');
                   }

                   if(document.getElementById('loading') !== null){
                        document.getElementById('loading').classList.add('invisible' ,'d-none');
                   }

				 }
				 else
				 {
				     formData.append('correoDestino' , document.getElementById('correoContact').value);
					  formData.append('nombre' , document.getElementById('nombreContact').value);
					  formData.append('apellido' , document.getElementById('apellidoContact').value);
					  formData.append('telefono' , document.getElementById('telefonoContact').value);
					  formData.append('mensaje' , document.getElementById('mensajeContact').value);
					  formData.append('token' , token);

					  req.open('POST', ruta + 'producto/enviarContacto');

					  req.onreadystatechange = function()
					  {
						   if(req.readyState == 4 && req.status == 200)
							 {
								 if(req.responseText > 0)
								 {
									 fetch(
										 Swal.fire(
												'Mensaje enviado!',
												'',
												'success'
									 )).then(response=>{

										 if(document.getElementById('btnContacto') !== null){
												document.getElementById('btnContacto').classList.remove('invisible' ,'d-none');
										 }

										 if(document.getElementById('loading') !== null){
												document.getElementById('loading').classList.add('invisible' ,'d-none');
										 }

										 document.getElementById('formContacto').reset();

									 });


								 }
								 else
								 {
									 Swal.fire(
											'Ups!. Tuvimos problemas al procesar tu solicitud',
											'',
											'error'
									 );

									 if(document.getElementById('btnContacto') !== null){
											document.getElementById('btnContacto').classList.remove('invisible' ,'d-none');
									 }

									 if(document.getElementById('loading') !== null){
											document.getElementById('loading').classList.add('invisible' ,'d-none');
									 }
								 }

							}
					 }

					 req.send(formData);

				 }


			 });

		});

}

//Esta funcion se ejecuta cada vez que hacen una busqueda rapida desde el search box del navbar
	function BRapida(e)
	{
      document.getElementById('formNavRapida').submit();
	}

	function searchBox(){
		$("#bRapida").click(function() {
				$(".icon").toggleClass("active");
				$("input[type='text']").toggleClass("active");
		});
	}

	function botonSpinner()
	{
		if(document.getElementById('btnSearchFast') != null)
		{
			  if(document.getElementById('btnSearchFast').classList.contains('invisible'))
				{
					document.getElementById('btnSearchFast').classList.remove('invisible');
					document.getElementById('listSearch').disabled = false;
					$('#spinner').remove();
				}
		}
	}

	function datatable()
	{
		$('#tablaProductos').DataTable( {
			buttons: [
					'colvis'
			],
			responsive: {
						details: {
								type: 'column',
								target: -1
						}
				},
				columnDefs: [ {
						className: 'dtr-control',
						orderable: false,
						targets:   -1
				} ],
				 "lengthChange": false,
				 "paging": false,
				 "searching": true,
				 "bInfo" : false,
				"language":
				{
            "emptyTable":     "No hay datos disponibles",
            "loadingRecords": "Cargando...",
            "processing":     "Procesando...",
            "zeroRecords":    "No se encontraron datos",
						search: "_INPUT_",
            searchPlaceholder: "Buscar..."
        }
			});
	}

	function eventosBusquedaAvanzada(){
		if( document.getElementById('aplicacionPrs') != null)
		{
			document.getElementById('aplicacionPrs').addEventListener('change' , llenarSubMarcas);
		}

		if( document.getElementById('aplicacionPrs') != null)
		{
			document.getElementById('aplicacionPrs').addEventListener('change' , activarBTN);
		}

		if( document.getElementById('buscarPrs') != null){
			document.getElementById('buscarPrs').addEventListener('click' , sendData);
		}


		if(document.getElementById('search-addon') != null){
			document.getElementById('search-addon').addEventListener('click' , sendSearchFast);
		}
	}

	function sendSearchFast2()
 	{
 		if(validarBusquedaRapida()){
			document.getElementById('formRapida2').submit();
		}else{
			Swal.fire({
            position: 'top-center',
            icon: 'error',
            title: 'Datos Incorrectos!',
            showConfirmButton: false,
            timer: 2500
         });
		}
	}

	function validarBusquedaRapida()
	{
	   let valor = document.getElementById('listSearch').value;
      let expresion = /^[A-Za-z0-9\sóáéíóúÁÉÍÓÚ./-]+$/g;

		if(expresion.test(valor)){
			return true;
		}else{
			return false;
		}
	}

	function esconderContenido()
	{
		let lista = document.getElementById('myList');

		if(lista.classList.contains('mostrar')){
			 lista.classList.remove("mostrar");
			 lista.classList.add('esconder');
		}

	}

	function blockCopy()
	{
		 //Disable full page
		 $("body").on("contextmenu",function(e){
				return false;
			});

			$('body').bind('cut copy paste', function (e) {
					e.preventDefault();
			});

	}


	function eventosBusquedaRapida()
	{

		if(document.getElementById('btnSearchFast') != null){
			document.getElementById('btnSearchFast').addEventListener('click' , sendSearchFast2);
		}

		if(document.getElementById('listSearch') != null)
		{
		   document.getElementById('listSearch').addEventListener('click' , esconderContenido);
		}

	}

	function llenarInputListSearch(e){
		document.getElementById('listSearch').value = e.target.textContent;
	}



	function sendSearchFast(){
		document.getElementById('formRapida').submit();

	}

	function sendData(){
		let marca = document.getElementById('aplicacionPrs').value;
		let submarca = document.getElementById('subaplicacionPrs').value;

		window.location.href = `${ruta}producto/personalizada/${marca}/${submarca}`;
	}

	function activarBTN(){

		if(document.getElementById('buscarPrs').hasAttribute('disabled'))
		{
			document.getElementById('buscarPrs').removeAttribute('disabled');
		}
	}

	function llenarSubMarcas()
	{
		if(document.getElementById('subaplicacionPrs').hasAttribute('disabled'))
		{
			document.getElementById('subaplicacionPrs').removeAttribute('disabled');
		}

		peticionLlenarSubMarcas();

	}




	function modalAvanzada(e)
	{

		e.preventDefault();
		let modal = document.getElementById('modalAvanzada');

	}

	//FIN DE BLOQUE DE FUNCIONES PARA HACER PETICIONES AL SERVIDOR



	/*FIN DE BLOQUE PARA LLENAR SELECTS*/
	function sidebar(){
		const fullHeight = function() {

			$('.js-fullheight').css('height', $(window).height());
			$(window).resize(function(){
				$('.js-fullheight').css('height', $(window).height());
			});

		};
		fullHeight();

		$('#sidebarCollapse').on('click', function () {
	      $('#sidebar').toggleClass('active');
	  });
	}

	//Con esta función le voy añadir a los botones detalles el evento de mostrar modal
	function eventosDetalles()
	{
      let detalle = document.querySelectorAll('.botonDet');
		let tam = detalle.length;

		//data-toggle="modal" data-target="#datosProducto"
      for (let i = 0; i < tam; i++) {
      	detalle[i].addEventListener('click',peticion);
      }

	}

	function peticion(e)
	{
     // window.location.href = ruta + 'producto/detalle/'+e.target.value;
     window.location.href = ruta + 'producto/detalle/'+e.target.value;
	}

   function llenarModalProducto(data)
	 {
			//Llenamos datos que vengan vacios
	    data = llenarDatos(data);
			document.getElementById('codigoProducto').textContent = data['codigo'];
			document.getElementById('grupoProducto').textContent = data['grupo'];
			document.getElementById('familiaProducto').textContent = data['familia'];
			document.getElementById('aplicacionProducto').textContent = data['marca1'];
			document.getElementById('subAplicaciónProducto').textContent = data['submarca1'];
			document.getElementById('modeloProducto').textContent = data['modelo1'];
			document.getElementById('posicionProducto').textContent = data['posicion'];
			document.getElementById('empaqueProducto').textContent = data['empaque'];
			document.getElementById('uxvProducto').textContent = data['uxv'];
			document.getElementById('diametroExt').textContent = data['diametro_exterior2'];
			document.getElementById('diametroInt').textContent = data['diametro_interior'];
			document.getElementById('largoProducto').textContent = data['largo'];
			document.getElementById('imgModalProduct').src = `../assets/img/grandes/cache/${data['codigo']}.jpg`;
	}

	function llenarDatos(data)
	{
		if(data['diametro_exterior2'] == ''){
			data['diametro_exterior2'] = "Sin información";
		}

		if(data['diametro_interior'] == ''){
			data['diametro_interior'] = "Sin información";
		}

		if(data['uxv'] == ''){
			data['uxv'] = 'Sin información';
		}

		if(data['largo'] == ''){
			data['largo'] = 'Sin información';
		}

		return data;
	}

	function goToTopButton()
	{
		$(window).scroll(function()
 		 {
 	     if($(this).scrollTop() > 20)
 			 {
 		      $('#toTopBtn').fadeIn();
 	     }
 			 else
 			 {
 		      $('#toTopBtn').fadeOut();
 	     }
     });

     $('#toTopBtn').click(function()
 		{
 	      $("html, body").animate({
 		        scrollTop: 0
 	       }, 1000);

 				return false;
     });
	}
