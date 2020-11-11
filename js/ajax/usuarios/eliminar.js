(function(){
    // obtengo tbody
    const tbody = document.querySelector('#tbody');

    
    document.addEventListener('DOMContentLoaded', () => {
        // al cargar la pagina le agrego el evento al click
        tbody.addEventListener('click', eliminar);
    });

    function eliminar(e){
        // Prevenimos la accion por defecto
        e.preventDefault();
        if(e.target.classList.contains('delete')){
            const idUsuario = e.target.id;
            
            const xmlhttp = new XMLHttpRequest();

            xmlhttp.open('POST', '/biblioteca2/usuarios/ajax/eliminar.php', true);

            xmlhttp.onreadystatechange = function(){
                if(xmlhttp.readyState === 4){
                    if(xmlhttp.responseText === 'Exito'){
                        const tr = e.target.parentElement.parentElement.parentElement;
                        tr.remove();
                    }
                }
            };

            xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xmlhttp.send(`idUsuario=${idUsuario}`);

        }
    }

})();