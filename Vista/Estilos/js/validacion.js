/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//VALIDAR REGISTRO
function validarRegistro() {
    
    var nombre = document.querySelector("#nombre").value;
    console.log('nombre',nombre);
    var apellidos = document.querySelector("#apellidos").value;
    console.log('apellidos',apellidos);
    var email = document.querySelector("#email").value;
    console.log('email',email);
    var telefono = document.querySelector("#tel").value;
    console.log('telefono',telefono);
    var pass = document.querySelector("#password").value;
    console.log('password',pass);
    var passb = document.querySelector("#confirma").value;
    console.log('password',passb);
    
    
    return false;
    
}

