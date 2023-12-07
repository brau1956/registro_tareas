
document.getElementById("saveData").addEventListener("submit", function (e) {
    e.preventDefault(); // Evita que se envíe el formulario
   
     // Obtiene todos los datos del formulario
     var formData = new FormData(document.getElementById("saveData"));
   
     // Crea un objeto vacío para almacenar los datos
     var datos = {};
  
     // Itera a través de los pares clave-valor en formData y los almacena en el objeto datos
     formData.forEach(function(value, key) {
         datos[key] = value;
     });
   
     // Convierte los datos a formato JSON
     var datosJSON = JSON.stringify(datos);
   
     // Imprime el objeto JSON en la consola
     console.log(datosJSON);
   
     // Para ver los datos en su forma original (pares clave-valor)
     formData.forEach(function(value, key) {
         console.log(key + ": " + value);
     });
     fetch("src/data_base.php",{
      method:"POST",
      body: JSON.stringify(datos)   
    })
                      
      .then(response => {
        if (!response.ok) {
          throw new Error('Error en la solicitud.');
        }
        return response.json(); // Parsear la respuesta como JSON
      })
      .catch(error => {
        console.log('Error:', error);
      })
      .then(data => {
        console.log(data); // Hacer algo con los datos recibido
        window.location="login.html";
      });
      
         });
  
   

// URL de la API o recurso que deseas consultar

