(function(){
    'use strict'
const buscador = document.getElementById("buscadorDeLibros");
function buscarLibro(search = '') {
  const contenedorLibros = document.querySelector('.libros__contenedor');
  const xmlhttp = new XMLHttpRequest();
  xmlhttp.open('POST', '/biblioteca2/libros/ajax/buscadorLibro.php', true);
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 4) {
      
      console.log(xmlhttp)

      contenedorLibros.innerHTML = this.response;
    }
  };
  xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xmlhttp.send(`libros=${search}`);
}

buscador.addEventListener('keyup', () => {
  let search = buscador.value;
  buscarLibro(search)
})

})();