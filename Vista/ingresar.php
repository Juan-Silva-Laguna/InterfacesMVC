<?php include("validacion.php");?>
    <!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Ingresar</li>
			</ol>
		</div>
	</div>
    <!-- //breadcrumbs -->
    <!-- login -->
        <div class="login">
            <div class="container">
                <h2>Ingresar</h2>            
                <div class="login-form-grids animated wow slideInUp"  style="width: 45%" data-wow-delay=".5s">
                    <form>
                        <input type="email" id="correo" placeholder="Ingrese su correo" required=" " >
                        <input type="password" id="password" placeholder="Ingrese su contraseña" required=" " >
                        <input type="submit" id="btn_ingresar" value="Ingresar">
                    </form>
                </div>
                <h4>Eres nuevo?</h4>
                <p><a href="registrar.php">Registrate Ahora Mismo Dando Clic Aqui</a> </p>
            </div>
        </div>
    <!-- //login -->

<?php include('footer.php');?>