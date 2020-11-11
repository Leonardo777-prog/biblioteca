(function(){

    const categoria = document.querySelector('.cat__drop');
    
    categoria.addEventListener('click', mostrarCategoria);

    function mostrarCategoria(e){
        if(e.target.classList.contains('categoria__search')){
            e.preventDefault();
            const contenedorLibros = document.querySelector('.libros__contenedor');
            const idCategoria = e.target.id;
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.open('POST','/biblioteca2/categorias/ajax/buscarCategoria.php', true);
            xmlhttp.onreadystatechange = function(){
                if(xmlhttp.readyState === 4){
                    contenedorLibros.innerHTML = this.response;
                }
            }
            xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xmlhttp.send(`idCategoria=${idCategoria}`);
        }
    }
    

})();