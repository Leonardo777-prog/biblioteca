(function(){
    const formulario = document.querySelector('#formulario');

    document.addEventListener('DOMContentLoaded', () => {
        formulario.addEventListener('submit', validarFormulario);
    });

    function validarFormulario(e){
        e.preventDefault();
        
        const idUsuario = document.querySelector('#idUsuario').value;
        const nombre = document.querySelector('#nombre').value;
        const apellido = document.querySelector('#apellido').value;
        const email = document.querySelector('#email').value;
        const dni = document.querySelector('#dni').value;
        const telefono = document.querySelector('#telefono').value;
        const domicilio = document.querySelector('#domicilio').value;

        if(idUsuario === '' || nombre === '' || apellido === '' || email === '' || dni === '' || telefono === '' || domicilio === ''){
            console.log('Todos los campos son obligatorios');
            return;
        }
        
        const usuario = {
            idUsuario,
            nombre,
            apellido,
            email,
            dni,
            telefono,
            domicilio
        }

        peticionAJAX(usuario);
    }

    function peticionAJAX(usuario){
        const {idUsuario, nombre, apellido, email, dni, telefono, domicilio} = usuario;
        // Aqui
        const xmlhttp = new XMLHttpRequest();

        xmlhttp.open('POST', '/biblioteca2/usuarios/ajax/update.php', true);

        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState === 4){
                if(xmlhttp.responseText === 'Error'){
                    mostrarAlerta('¡Hubo un error al actualizar los datos!', 'error');
                    return;
                }
                mostrarAlerta('¡Actualizado Con Exito!');
            }
        };

        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xmlhttp.send(`idUsuario=${idUsuario}&Nombre=${nombre}&Apellido=${apellido}&Dni=${dni}&Email=${email}&Telefono=${telefono}&Domicilio=${domicilio}`);
    }

    function mostrarAlerta(mensaje, tipo){
        const divMensaje = document.createElement('div');
        divMensaje.textContent = mensaje;

        if(tipo === 'error'){
            divMensaje.classList.add('alert', 'alert__danger');
        }else{
            divMensaje.classList.add('alert', 'alert__ok');
        }

        formulario.appendChild(divMensaje);

        setTimeout(()=>{
            divMensaje.remove();
        }, 3000);
    }

})();