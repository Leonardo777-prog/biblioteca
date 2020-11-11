(function () {
    const boton = document.querySelector('#boton');
    document.addEventListener('DOMContentLoaded', () => {
        boton.addEventListener('click', agregarLibro);
    })

    const agregarLibro = (e) => {
        const cantidad = document.getElementById('numberDePedidos');
        const item = document.getElementById('itemPedidos');
        // console.log(cantidad, item)
        const idLibro = e.target.getAttribute('data-id');
        if (idLibro == null) {
            alert('Nesesita registrarse')
        } else {
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.open('POST', '/biblioteca2/usuarios/ajax/agregarCarrito.php');
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState === 4) {
                    if (this.response !== '') {
                        let data = JSON.parse(this.response)
                        if (data.error != '') {
                            alert(data.error)
                        } else {
                            if (data.cantidad === 1) {
                                item.style.display = "block";
                                cantidad.innerHTML = data.cantidad
                            } else {
                                cantidad.innerHTML = data.cantidad
                            }
                        }
                    }
                }
            };
            xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xmlhttp.send(`idLibro=${idLibro}`);
        }
        console.log(idLibro)

    }
})();