<?php
include_once("../Entidad/productos.entidad.php");
include_once("../Modelo/productos.modelo.php");

$ProductoE = new \entidadProducto\Producto();
switch ($_POST['operacion']) { 
    case 'mostrar':
        $ProductoM = new \modeloProducto\Producto($ProductoE);
        $mensaje = $ProductoM->mostrarProductos();
        break;
    case 'buscar':
        $ProductoE->setNombreProducto($_POST['nombre']);
        $ProductoM = new \modeloProducto\Producto($ProductoE);
        $mensaje = $ProductoM->buscarProducto();
        break;
    case 'agregar':
        $ProductoE->setCantidadProducto($_POST['cantidad']);
        $ProductoE->setIdProducto($_POST['id']);
        $ProductoM = new \modeloProducto\Producto($ProductoE);
        $mensaje = $ProductoM->agregar();
        break;
    case 'mostrarCarrito':
        $ProductoM = new \modeloProducto\Producto($ProductoE);
        $mensaje = $ProductoM->mostrarCarrito();
        break;
    case 'editaCantidad':
        $ProductoE->setIdProducto($_POST['id']);
        $ProductoE->setCantidadProducto($_POST['cantidad']);
        $ProductoM = new \modeloProducto\Producto($ProductoE);
        $mensaje = $ProductoM->editarCantidad();
        break;
    case 'borrarProducto':
        $ProductoE->setIdProducto($_POST['id']);
        $ProductoM = new \modeloProducto\Producto($ProductoE);
        $ProductoM->borrarProducto();
        break;
    case 'vaciarCarrito':
        $ProductoM = new \modeloProducto\Producto($ProductoE);
        $mensaje = $ProductoM->vaciarCarrito();
        break;
    case 'enviarPedido':
        $ProductoE->setCantidadProducto($_POST['tot']);
        $ProductoM = new \modeloProducto\Producto($ProductoE);
        $mensaje = $ProductoM->enviarPedido();
        break;
    case 'mostrarHistorial':
        $ProductoM = new \modeloProducto\Producto($ProductoE);
        $mensaje = $ProductoM->mostrarHistorial();
        break;
}

unset($ProductoE);
unset($ProductoM);

echo json_encode($mensaje);
?>