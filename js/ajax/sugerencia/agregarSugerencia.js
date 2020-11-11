(function () {
    const btnSugerencia = document.querySelector('#guararSugerencias');
    document.addEventListener('DOMContentLoaded', () => {
        btnSugerencia.addEventListener('click', agregarSugerencia);
    })

    const agregarSugerencia = (e) => {
        const sugerencia = document.getElementById('sugerencia');
        const valorSuggerencia = sugerencia.value
        const idUsuario = document.getElementById('idUsuario').value;
        const ultimoComentario = document.getElementById('comentario3')
        // console.log(idUsuario)
        // // // console.log(cantidad, item)
        const idLibro = e.target.getAttribute('data-id');
        if (sugerencia === '') {
            alert('No puede comentar en blanco')
        } else {
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.open('POST', '/biblioteca2/section/ajax/ageregarSugerencia.php');
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState === 4) {
                    ultimoComentario.innerHTML = this.response;
                    sugerencia.value = ''
                }
            };
            xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xmlhttp.send(`idLibro=${idUsuario}&sugerencia=${valorSuggerencia}`);
        }
        console.log(idLibro)

    }
})()