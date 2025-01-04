<?php
namespace interfazProductos;

interface Productos
{
    public function mostrarProductos();

    public function buscarProducto();

    public function agregar();

    public function mostrarCarrito();

    public function editarCantidad();

    public function borrarProducto();

    public function enviarPedido();

    public function vaciarCarrito();
    
    public function mostrarHistorial();
}

?>