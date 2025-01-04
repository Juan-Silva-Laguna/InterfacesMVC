<?php include("validacion.php");?>
<!-- breadcrumbs -->
<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1">
				<li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Mis Productos</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!-- checkout -->
	<div class="checkout">
		<div class="container">
			<h2>Por compras mayores a <span> $50.000 </span> tendras gratis el domicilio</h2>
			<div class="checkout-right">
				<table class="timetable_sub">
					<thead>
						<tr>	
							<th>Productos</th>
							<th>Nombre</th>
							<th>Cantidad</th>
							<th>Precio</th>
							<th>Quitar</th>
						</tr>
					</thead>
					<tbody id="cuerpoTabla">
					</tbody>
				</table>
				<div class="text-center"><br>
				<h1>Total de $<span id="total"></span></h1>
				</div>				
			</div>
			<div class="checkout-left">					
				<div class="checkout-right-basket" id="enviarPedido">
					<a href="#"><i class="fa fa-trophy"></i> Realizar Pedido</a>
				</div>
				<div class="checkout-right-basket" id="vaciarCarrito">
					<a href="#"></span><i class="fa fa-trash-o"></i> Vaciar Carrito</a>
				</div>
				<div class="checkout-right-basket">
					<a href="productos.php"><i class="fa fa-shopping-cart"></i> Continuar Comprando</a>
				</div>
			</div>
			<div class="checkout-left" id="historialPedido">	
				
			</div>
		</div>
	</div>
<!-- //checkout -->
<script src="../Entorno/productos.js"></script>
<?php include('footer.php');?>