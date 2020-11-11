(function () {
    const btnPedidos = document.getElementById('reservarPedido')
    btnPedidos.addEventListener('click', () => {


        const xhr = new XMLHttpRequest()
        xhr.open('POST', '/biblioteca2/usuarios/ajax/reservarCarrito.php', true)
        xhr.onload = () => {
            if (xhr.status === 200) {
                if (xhr.response == 1) {
                    alert('Su reserva se realizo con exito')
                } else {
                    alert('Ocurrio un problema con su reserva')
                }
            }
        }
        xhr.send()


    })
}())