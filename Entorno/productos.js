$(document).ready(function(){    

    mostrar();

    if ($(location).attr('pathname') == "/interfaces/Vista/productos.php") {
        mostrar();  
    }else if ($(location).attr('pathname') == "/interfaces/Vista/carrito.php") {
        mostrarCarrito();
        historial();
    }
    //-------------------Eventos-------------------

    
    $(document).on('click', '#btnBuscarProducto', function (e) {               
        const datos = {
            nombre: $("#buscarProducto").val(),
            operacion: 'buscar'
        }
        buscar(datos);
        e.preventDefault();
    });

    $(document).on('click', '#borrar', function (e) {
        e.preventDefault();
        if (confirm("Seguro de quitar el producto?")) {
            const datos = {
                id: $(this).attr('data-index-number'),
                operacion: 'borrarProducto'
            }
            $.post('../controlador/productos.controlador.php',datos, function () {
                mostrarCarrito();
            });
        }
    });

    $(document).on('click', '#mas', function (e) {
        e.preventDefault();
        let arreglo = $(this).val().split('%%');
        const datos = {
            id: arreglo[0],
            cantidad: Number(arreglo[1])+1,
            operacion: 'editaCantidad'
        }
        $.post('../controlador/productos.controlador.php',datos, function () {
            mostrarCarrito();
        });

    });

    $(document).on('click', '#menos', function (e) {               
        e.preventDefault();
        let arreglo = $(this).val().split('%%');
        const datos = {
            id: arreglo[0],
            cantidad: Number(arreglo[1])-1,
            operacion: 'editaCantidad'
        }
        $.post('../controlador/productos.controlador.php',datos, function () {  
            mostrarCarrito();
        });

    });

    $(document).on('click', '#enviarPedido', function (e) {
        e.preventDefault();
       console.log($('#total').html());
       
        $.post('../controlador/productos.controlador.php', {tot: $('#total').html(),operacion: 'enviarPedido'}, function (respuesta) {
           alert(respuesta);
           mostrarCarrito();
           historial();
       })
     });

     $(document).on('click', '#vaciarCarrito', function (event) {
        event.preventDefault();
         if (confirm("Seguro de vaciar todo el carrito?")) {
           $.post('../controlador/productos.controlador.php', {operacion: 'vaciarCarrito'}, function (respuesta) {
               alert(respuesta);
               mostrarCarrito();
           });
         } 
    });

    $(document).on('click', '#agregarProducto', function (e) { 
        let cant = prompt(`Cuantos desea agregar?`);
        if (!cant==null || !cant=="") {
            if (!isNaN(cant)) {
                const datos={
                    id: $(this).attr('data-index-number'),
                    cantidad: cant,
                    operacion: 'agregar'
                };
               
               $.post('../controlador/productos.controlador.php', datos, function (respuesta) {
                   
                    alert(respuesta);
                })
            }else{alert("ERROR: La cantidad debe ser numerica");}         
        }
        e.preventDefault();
    });

    //----------------------Funciones.------------------------

function buscar(datos) {
    $.post('../controlador/productos.controlador.php',datos, function (respuesta) {      
        let datos = JSON.parse(respuesta);
            let template = '';
            datos.forEach(dato => {
                template += `
                <div class="col-md-4 top_brand_left">
						<div class="hover14 column">
							<div class="agile_top_brand_left_grid">
								<div class="agile_top_brand_left_grid1">
                                    <figure>
                                        <div class="snipcart-item block">
                                            <div class="snipcart-thumb text-center">
                                                <a href="#"><img width="150" height="150" src="${dato.imagenProducto}"></a>		
                                                <p>${dato.nombreProducto}</p>
                                                <h4>${dato.precioProducto} </h4><br> 
                                                <div class="snipcart-details top_brand_home_details">
                                                    <fieldset>
                                                        <input type="submit" value="Agregar" id="agregarProducto" class="button" data-index-number="${dato.idProducto}">
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </figure>
								</div>
							</div>
						</div><br>
					</div>
                `;
            })
            $('#padreProductos').html(template);
        })
    }
    function mostrar(){
        $.post('../controlador/productos.controlador.php', {operacion: 'mostrar'}, function (respuesta) {
            let datos = JSON.parse(respuesta);
            let template = '';
            datos.forEach(dato => {
                template += `
                <div class="col-md-4 top_brand_left">
						<div class="hover14 column">
							<div class="agile_top_brand_left_grid">
								<div class="agile_top_brand_left_grid1">
                                    <figure>
                                        <div class="snipcart-item block">
                                            <div class="snipcart-thumb text-center">
                                                <a href="#"><img width="150" height="150" src="${dato.imagenProducto}"></a>		
                                                <p>${dato.nombreProducto}</p>
                                                <h4>${dato.precioProducto} </h4><br> 
                                                <div class="snipcart-details top_brand_home_details">
                                                    <fieldset>
                                                        <input type="submit" value="Agregar" id="agregarProducto" class="button" data-index-number="${dato.idProducto}">
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </figure>
								</div>
							</div>
						</div><br>
					</div>
                `;
            })
            $('#padreProductos').html(template);	
        })        
    }

    function mostrarCarrito(){
        $.post('../controlador/productos.controlador.php', {operacion: 'mostrarCarrito'}, function (respuesta) {
            let datos = JSON.parse(respuesta);
            let template = '', tot=0;
            datos.forEach(dato => {
                template += `
                <tr class="rem1">
						<td class="invert-image"><a href="#"><img src="${dato.imagenProducto}" alt=" " class="img-responsive" /></a></td>
						<td class="invert">
							 <div class="quantity"> 
                                <div class="quantity-select">
                                    <b><div class="entry value"><span>${dato.nombreProducto}</span></div></b>
								</div>
							</div>
						</td>
						<td class="invert"><button id="menos" value="${dato.idCarrito+"%%"+dato.cantidad}">- </button> ${dato.cantidad} <button id="mas" value="${dato.idCarrito+"%%"+dato.cantidad}"> +</button></td>						
						<td class="invert">$${dato.precioProducto}</td>
						<td class="invert">
                            <div class="rem">
								<div class="close1" id="borrar" data-index-number="${dato.idCarrito}"> </div>
							</div>
						</td>
					</tr>
                `;
                tot+=Number(dato.precioProducto)*Number(dato.cantidad);
            });               
            $('#total').html(tot);	
            $('#cuerpoTabla').html(template);	
        });       
    }

    function historial() {
        $.post('../controlador/productos.controlador.php', {operacion: 'mostrarHistorial'}, function (respuesta) {
            console.log(respuesta);
            let datos = JSON.parse(respuesta);
            let template=`
                <div class="checkout-left-basket">  
                    <ul>
                    <li style="color: red"><b>N - Producto <i>-</i> <span>Precio</span></b></li>
            `,tot=0;
            datos.forEach(dato => {
                template += `
                    <li>${dato.cantidad} ${dato.nombreProducto} <i>-</i> <span>${dato.precio}</span></li>
                `;  
                tot=dato.total;
            });
            template += `
                    <li>Domicilio  <i>-</i> <span> ${tot>50000 ? 'Gratis' : '$4000'}</span><li>                    
                    <b>Total de ${tot>50000 ? tot: Number(tot)+4000}<b>
                    </ul>
                </div>				
                <div class="clearfix"> </div>
            `;
            $('#historialPedido').html(template);
        });
    }
    
});