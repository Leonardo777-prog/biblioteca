(function(){
    const formulario = document.querySelector('#formulario');
    document.addEventListener('DOMContentLoaded', () => {
        formulario.addEventListener('submit', validarFormulario);
    })

    function validarFormulario(e){
        e.preventDefault();
        const id = document.querySelector('#idCategoria').value;
        const nombre = document.querySelector('#nombre').value;

        if(nombre === '' || id === ''){
            mostrarAlerta('Todos los campos son obligatorios', 'error');
            return;
        }

        const categoria = {
            id,
            nombre
        }

        peticion(categoria);
    }


    function peticion(categoria){
        const { id, nombre } = categoria;

        const xmlhttp = new XMLHttpRequest();
        xmlhttp.open('POST', '/biblioteca2/categorias/ajax/update.php', true);
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState === 4){
                if(xmlhttp.responseText === 'Error'){
                    mostrarAlerta('¡Hubo un error al actualizar el registro!', 'error');
                    return;
                }
                mostrarAlerta('¡Registro actualizado exitosamente!');

                setTimeout(()=>{
                    window.location.href = '/biblioteca2/categorias/index.php';
                }, 3000)
            }
        };

        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xmlhttp.send(`idCategoria=${id}&nombre=${nombre}`);
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