(function(){
    const formulario = document.querySelector('#formulario');
    document.addEventListener('DOMContentLoaded', () => {
        formulario.addEventListener('click', eliminar);
    })

    function eliminar(e){
        if(e.target.classList.contains('btn__danger')){
            e.preventDefault();

            const id = e.target.id;

            const xmlhttp = new XMLHttpRequest();
            xmlhttp.open('POST', '/biblioteca2/libros/ajax/eliminar.php', true);

            xmlhttp.onreadystatechange = function (){
                if(xmlhttp.readyState === 4){
                    if(xmlhttp.responseText === 'Error'){
                        mostrarAlerta('¡Hubo un error al eliminar el registro!','error');
                        return;
                    }
                    mostrarAlerta('¡Eliminado con Exito!');

                    setTimeout(()=>{
                        window.location.href = '/biblioteca2/libros/index.php';
                    },2000);
                }
            };
            xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xmlhttp.send(`idLibro=${id}`);
        }
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