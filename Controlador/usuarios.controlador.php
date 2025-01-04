<?php
include_once("../entidad/usuarios.entidad.php");
include_once("../modelo/usuarios.modelo.php");

$UsuarioE = new \entidadUsuario\Usuario();
switch ($_POST['operacion']) {
    case 'registrar':
        $UsuarioE->setNombre($_POST['nombre']);
        $UsuarioE->setNumero($_POST['numero']);
        $UsuarioE->setCorreo($_POST['correo']);
        $UsuarioE->setDireccion($_POST['direccion']);
        $UsuarioE->setPassword($_POST['password']);
        $UsuarioM = new \modeloUsuario\Usuario($UsuarioE);
        $mensaje = $UsuarioM->registrar();
        break;
    case 'ingresar':
        $UsuarioE->setCorreo($_POST['correo']);
        $UsuarioE->setPassword($_POST['password']);
        $UsuarioM = new \modeloUsuario\Usuario($UsuarioE);
        $mensaje = $UsuarioM->ingresar();
        break;
    case 'salir':
        $UsuarioM = new \modeloUsuario\Usuario($UsuarioE);
        $mensaje = $UsuarioM->salir();
        break;  
}

unset($UsuarioE);
unset($UsuarioM);

echo json_encode($mensaje);
?>