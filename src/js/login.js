document.getElementById("registros").addEventListener("submit", function (p) {
    p.preventDefault(); 
   if(Error){
     var formData = new FormData(document.getElementById("registros"));
   
     // Crea un objeto vacío para almacenar los datos
     var datos = {};
   
     // Itera a través de los pares clave-valor en formData y los almacena en el objeto datos
     formData.forEach(function(value, key) {
         datos[key] = value;
     });
   
      fetch("login.php",{
       method:"POST",
       body: JSON.stringify(datos),
       headers:{
           "Content-Type": "application/json"
       }
  
      }) 
      .then((response) => response.json())
      .then((response) => {
        if(response.estatus==1)
          window.location="todoList.php";
        else 
           alert("Usuario invalido");
      });
  }else{
   alert("datos incorrectoss");   
  }
     });