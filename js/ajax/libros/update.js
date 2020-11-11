(function(){
    
    const formulario = document.querySelector('#formulario');


    document.addEventListener('DOMContentLoaded', () => {
        formulario.addEventListener('submit', validarFormulario);
    });

    function validarFormulario(e){
        e.preventDefault();
        
        const id = document.querySelector('#idLibro').value;
        const titulo = document.querySelector('#titulo').value;
        const autor = document.querySelector('#autor').value;
        const categoria = document.querySelector('#categoria').value;
        const formato = document.querySelector('#formato').value;
        const estado = document.querySelector('#estado').value;
        const sinopsis = document.querySelector('#sinopsis').value;

        if(id === '' || titulo === '' || autor === '' || categoria === '' || formato === '' || estado === '' || sinopsis === ''){
            console.log('Todos los campos son obligatorios');
            return;
        }

        const libro = {
            id,
            titulo,
            autor,
            categoria,
            formato,
            estado,
            sinopsis
        };

        peticion(libro);
    }

    function peticion(libro){
        const { id, titulo, autor, categoria, formato, estado, sinopsis } = libro;


        const xmlhttp = new XMLHttpRequest();
        xmlhttp.open('POST', '/biblioteca2/libros/ajax/update.php', true);

        xmlhttp.onreadystatechange =  function(){
            if(xmlhttp.readyState === 4){
                if(xmlhttp.responseText === 'exito'){
                    mostrarAlerta('¡Modificado Exitosamente!');

                    setTimeout(()=>{
                        window.location.href =  '/biblioteca2/libros/index.php';
                    }, 3000);
                }
            }
        };

        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xmlhttp.send(`idLibro=${id}&titulo=${titulo}&autor=${autor}&categoria=${categoria}&formato=${formato}&estado=${estado}&sinopsis=${sinopsis}`);

    }

    function mostrarAlerta(mensaje){
        const divMensaje = document.createElement('div');
        divMensaje.classList.add('alert', 'alert__ok');
        divMensaje.textContent = mensaje;

        formulario.appendChild(divMensaje);

        setTimeout(()=>{
            divMensaje.remove();
        }, 3000);
    }

})();