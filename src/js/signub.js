document.getElementById("saveData").addEventListener("submit", function (e) {
    e.preventDefault(); // Evita que se envíe el formulario

    // Crea un objeto vacío para almacenar los datos
    var datos = {};

    // Itera a través de los pares clave-valor en formData y los almacena en el objeto datos
    var formData = new FormData(document.getElementById("saveData"));
    formData.forEach(function(value, key) {
        datos[key] = value;
    });

    // Imprime el objeto datos en la consola
    console.log(datos);

    // Realiza la solicitud fetch al servidor
    fetch("src/data_base.php", {
        method: "POST",
        body: JSON.stringify(datos) // No necesitas convertirlo a JSON aquí-0- 0-
    })
    .then((response) => response.json())
    .then((response) => {
        if (response.estatus == 0) {
            window.location = "index.php";
        } else {
            alert("Usuario no válido");
        }
    })
    .catch((error) => {
        console.error("Error:", error);
        alert("Ocurrió un error en la solicitud al servidor.");
    });
});
