(function(){
    // IIFE para que las variables no salgan de este archivos
    const tbody = document.querySelector('#tbody');
    
    tbody.addEventListener('click', eliminar);

    function eliminar(e){
        if(e.target.classList.contains('delete')){
            const idCategoria = e.target.id;

            const xmlhttp = new XMLHttpRequest();

            xmlhttp.open('POST','/biblioteca2/categorias/ajax/delete.php', true);

            xmlhttp.onreadystatechange = function(){
                if(xmlhttp.readyState === 4){
                    if(xmlhttp.responseText === 'exito'){
                        // tr que eliminamos
                        const tr = e.target.parentElement.parentElement.parentElement;
                        tr.remove();
                    }
                }
            }

            xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xmlhttp.send(`idCategoria=${idCategoria}`);
        }
    }
    
})();