document.getElementById("form1").onsubmit = function(event) {
    event.preventDefault();

    // Realizar la solicitud asíncrona usando JavaScript (puedes usar fetch o XMLHttpRequest)
    fetch("send-email.php", {
        method: "POST",
        body: new FormData(document.getElementById("form1"))
    })
    .then(response => response.json())
    .then(data => {
        console.log("Respuesta del servidor:", data);

        if (data.status === "success") {
            alert("El mensaje se ha enviado con éxito");
            window.location.href = "index.html";
        } else {
            alert("Error al enviar el mensaje. Por favor, inténtalo de nuevo más tarde. Detalles: " + data.message);
        }
    })
    .catch(error => {
        console.error("Error en la solicitud:", error);
        alert("Error inesperado. Por favor, inténtalo de nuevo más tarde.");
    });
};
