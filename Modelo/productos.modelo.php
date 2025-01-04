<?php
namespace modeloProducto;
use PDO;

include_once("../entidad/productos.entidad.php");
include_once("../entorno/conexion.php");
include_once("../interfaces/productos.interfaz.php");
class Producto implements \interfazProductos\Productos{
    private $idProducto;
    private $nombreProducto;
    private $cantidadProducto;
    private $conexion;
    private $consulta;
    private $resultado;
    private $retorno;
    public function __construct(\entidadProducto\Producto $ProductoE)
    {
        $this->conexion = new \Conexion();
        $this->idProducto=$ProductoE->getIdProducto();  
        $this->nombreProducto=$ProductoE->getNombreProducto();   
        $this->cantidadProducto=$ProductoE->getCantidadProducto(); 
    }


    public function mostrarProductos()
    {
       $this->consulta="SELECT * FROM productos";   
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }


    public function buscarProducto()
    {
       $this->consulta="SELECT * FROM productos WHERE nombreProducto LIKE '%$this->nombreProducto%'";   
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregar()
    {
        session_start();
        if (isset($_SESSION['id'])) {
            $id_cliente = $_SESSION['id'];
            $this->consulta="SELECT * FROM pedido WHERE idCliente=$id_cliente AND estado=0";   
            $this->resultado=$this->conexion->con->prepare($this->consulta); 
            $this->resultado->execute();
            if($this->resultado->rowCount()>=1){
                foreach ($this->resultado->fetchAll(PDO::FETCH_ASSOC) as $key => $value) {                    
                    $idPedido = $value['idPedido'];
                    $this->consulta="INSERT INTO carrito VALUES(null, $this->cantidadProducto, $this->idProducto, $idPedido)";
                    $this->resultado=$this->conexion->con->prepare($this->consulta);
                    $this->resultado->execute();
                    if($this->resultado->rowCount()>=1){
                        $this->retorno = "Producto agregado satisfactoriamente!! ";
                    }
                    else{
                        $this->retorno = "No se logro agregar el producto ".$this->cantidadProducto;
                    }                    
                }
            }
            else{              
                $this->consulta="INSERT INTO pedido VALUES(NULL, 0, $id_cliente, 0)";
                $this->resultado=$this->conexion->con->prepare($this->consulta);
                $this->resultado->execute();
                if($this->resultado->rowCount()>=1){
                    $this->consulta="SELECT * FROM pedido WHERE idCliente=$id_cliente AND estado=0";   
                    $this->resultado=$this->conexion->con->prepare($this->consulta); 
                    $this->resultado->execute();
                    if($this->resultado->rowCount()>=1){
                        foreach ($this->resultado->fetchAll(PDO::FETCH_ASSOC) as $key => $value) {                    
                            $idPedido = $value['idPedido'];
                            $this->consulta="INSERT INTO carrito VALUES(NULL, $this->cantidadProducto, $this->idProducto, $idPedido)";
                            $this->resultado=$this->conexion->con->prepare($this->consulta);
                            $this->resultado->execute();
                            if($this->resultado->rowCount()>=1){
                                $this->retorno = "Producto agregado satisfactoriamente!! ";
                            }
                            else{
                                $this->retorno = "No se logro agregar el producto ";
                            }                    
                        }
                    }
                }
                else{
                    $this->retorno = "No se logro agregar el producto ";
                }
            } 
        }else{
            $this->retorno = "Por favor inicie sesion para realizar sus compras";
        }
       return $this->retorno;
    }

    public function mostrarCarrito()
    {
       session_start();
       $id_cliente = $_SESSION['id'];
       $this->consulta="SELECT * FROM pedido INNER JOIN carrito ON pedido.idPedido = carrito.idPedido INNER JOIN productos ON carrito.idProducto = productos.idProducto AND pedido.idCliente=$id_cliente AND estado=0";   
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editarCantidad()
    {
        $this->consulta="UPDATE carrito SET cantidad='$this->cantidadProducto' WHERE idCarrito=$this->idProducto";
        $this->resultado=$this->conexion->con->prepare($this->consulta);
        $this->resultado->execute();
    }

    public function borrarProducto()
    {
       $this->consulta="DELETE FROM carrito WHERE idCarrito='$this->idProducto'";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
    }

    public function enviarPedido()
    {
        session_start();
        $id_cliente = $_SESSION['id'];
        $this->consulta="UPDATE pedido SET estado=1, total=$this->cantidadProducto WHERE idCliente=$id_cliente AND estado=0";
        $this->resultado=$this->conexion->con->prepare($this->consulta);
        $this->resultado->execute();
        if($this->resultado->rowCount()>=1){
            $this->retorno = "Muy pronto tendras el pedido en la puerta de tu casa";
        }
        else{
            $this->retorno = "Error, por favor intente de nuevo";
        }
        return $this->retorno;
    }

    public function vaciarCarrito()
    {
        session_start();
        $id_cliente = $_SESSION['id'];
        $this->consulta="DELETE FROM pedido WHERE idCliente=$id_cliente AND estado=0";
        $this->resultado=$this->conexion->con->prepare($this->consulta);
        $this->resultado->execute();
        if($this->resultado->rowCount()>=1){
            $this->retorno = "Se vacio el carrito con exito";
        }
        else{
            $this->retorno = "No se logro vaciar el carrito. Intente de nuevo.";
        }
        return $this->retorno;
    }
    
    public function mostrarHistorial()
    {
       session_start();
       $id_cliente = $_SESSION['id'];
       $this->consulta="SELECT pedido.total, productos.nombreProducto, productos.precioProducto*carrito.cantidad as precio, carrito.cantidad FROM pedido INNER JOIN carrito ON pedido.idPedido = carrito.idPedido INNER JOIN productos ON carrito.idProducto = productos.idProducto AND pedido.idCliente=$id_cliente AND estado=1";   
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>