$(function(){
    $( "#registro").click(function(){
        let nombre = $("#nombre").val();
        let correo = $("#correo").val();
        let contraseña = $("#contraseña").val();
        agregarUsuario(nombre,correo,contraseña);
    })
});

async function agregarUsuario(nombre, correo, contraseña) {
    await fetch("php/server.php?funcion=registro",{
        method: 'POST',
        body: JSON.stringify({nombre: nombre, correo: correo, contraseña: contraseña})
    });
}