(function(){
    const tbody = document.querySelector('#tbody');
    document.addEventListener('DOMContentLoaded', ()=>{
        tbody.addEventListener('click', eliminar);
    });

    const eliminar = (e) =>{
        if(e.target.classList.contains('btn__danger')){
            const idLibro = e.target.getAttribute('data-id');

            const xmlhttp = new XMLHttpRequest();
            xmlhttp.open('POST', '/biblioteca2/usuarios/ajax/cancelarCarrito.php', true);
            xmlhttp.onreadystatechange = function(){
                if(this.readyState === 4){
                    if(this.responseText === 'exito'){
                        const tr = e.target.parentElement.parentElement;
                        tr.remove();
                    }
                }
            };
            xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xmlhttp.send(`idLibro=${idLibro}`);
        }
    }
})();