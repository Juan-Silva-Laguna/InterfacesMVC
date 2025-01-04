$(document).ready(function(){ 
    //----------------------Eventos-----------------
    $(document).on('click', '#btn_registrar', function (event) {
        event.preventDefault();
        let datos = {
            nombre: $('#nombre').val(), 
            numero: $('#numero').val(),
            direccion: $('#direccion').val(), 
            correo: $('#correo').val(),
            password: $('#password').val(),
            operacion: 'registrar'
        };
        $.post('../Controlador/usuarios.controlador.php', datos, function (respuesta) {
            //let datos = JSON.parse(respuesta);
            alert(respuesta);    
            limpiar();
        })        
        
    });

    $(document).on('click', '#btn_ingresar', function (event) {
        event.preventDefault();
        const datos = {
            operacion: 'ingresar',
            correo: $('#correo').val(),
            password: $('#password').val()
        };
        $.post('../Controlador/usuarios.controlador.php', datos, function (respuesta) {
            alert(respuesta);  
            $(location).attr('href','productos.php');
            limpiar();
        })
        
    });

    $(document).on('click', '#salir', function (event) {
        event.preventDefault();
        $.post('../Controlador/usuarios.controlador.php', {operacion: 'salir'}, function (respuesta) {
            alert(respuesta);  
            $(location).attr('href','productos.php');
        })
    });

    //---------------------------Funciones------------------------------
  

    function limpiar() {
        $('#nombre').val(""); 
        $('#numero').val("");
        $('#direccion').val(""); 
        $('#correo').val("");
        $('#password').val(""); 
    }

});
