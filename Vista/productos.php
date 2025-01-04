<?php include("validacion.php");?>
    <!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Productos</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!--- products --->

	<div class="products">
		<div class="container">
			<div class="text-right">
				<input type="search" id="buscarProducto" placeholder="Buscar Producto..." required="" style="height: 40px;">
				<button type="submit" id="btnBuscarProducto" class="btn btn-default search" aria-label="Left Align">
					<i class="fa fa-search" aria-hidden="true"> </i>
				</button>
			</div>
			<h2 id="titCateg" data-index-number=""></h2>
			<div class="col-md-12 products-right">				
				<div class="products-right-grid">
					<div class="products-right-grids">
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="agile_top_brands_grids" id="padreProductos">
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
<!--- products --->
<script src="../Entorno/productos.js"></script>
<?php include("footer.php");?>