var input = document.getElementById("datos");
var addBtn = document.getElementById("btn1");
var div = document.getElementById("dv");


function presionar() {
    var presentar = input.value.trim(); // Obtener el valor del input y eliminar espacios en blanco al inicio y al final
    
    // Verificar si el valor del input está vacío después de quitar los espacios en blanco
    if (presentar === "") {
        // Si está vacío, no hacer nada
        return;
    }

    // Crear el objeto de datos a enviar
    var data = {
        datos: presentar
    };

    // Realizar la llamada fetch para enviar los datos al servidor
    fetch("server.php", {
        method: "POST",
        body: JSON.stringify(data),
    })
    .then(response => response.json())
    .then(data => {
        renderTodos(data);
        console.log(data);
        set_get_localStorage('data');
    })
    .catch(error => {
        console.error("Error:", error);
    });

    // Limpiar el valor del input después de agregar la tarea
    input.value = '';

    // Almacenar la tarea en el localStorage
    const tarea = {
        texto: presentar
    };

    let tareas = [];

    if (localStorage.getItem("tarea") !== null) {
        tareas = JSON.parse(localStorage.getItem("tarea"));
    }

    tareas.push(tarea);
    localStorage.setItem("tarea", JSON.stringify(tareas));
    
    const datitos = localStorage.getItem("tarea");

    // Enviar los datos almacenados en localStorage al servidor
    const xhr = new XMLHttpRequest();
    xhr.open('POST', "http://localhost/registro_tareas/to_to_list.json", true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(datitos);
}


// Función para actualizar las tareas en el localStorage
function actualizarTareas() {
let tareas = [];
const elementos = div.querySelectorAll('li');
elementos.forEach(function (elemento) {
tareas.push({
texto: elemento.textContent
});
});
localStorage.setItem("tarea", JSON.stringify(tareas));
localStorage.getItem
}

document.addEventListener("DOMContentLoaded", (event) => {  

    


fetch('http://localhost/registro_tareas/server.php',{
method: "post"           
})
.then(response => {
if (response.status === 200) {
return response.json();
} else {
throw new Error('La solicitud no fue exitosa. Código de estado: ' + response.status);
}
})
.then(data => {
// Puedes trabajar con los datos según tus necesidades
renderTodos(data);
})
.catch(error => {
console.log('Error al obtener datos:', error);
});

});
 



const renderTodos = (data) =>{
    console.log(data.tareas);
    const listaTareas = document.getElementById('lista-tareas');
    listaTareas.innerHTML =''; 
    console.log('listaTareas: ',listaTareas);//-----------------------------------------------borrador---///
    data.tareas.forEach(tarea => {
    console.log('tarea: ',tarea);
        const li = document.createElement('li');
        li.id= 'list';
        let valor =tarea.tarea;
         li.textContent = valor;
       const btn_eliminar= document.createElement('button');
       btn_eliminar.id='btn';
       btn_eliminar.textContent = "x";
       btn_eliminar.className = "btn-delete";
btn_eliminar.addEventListener('click',(e)=>{
    const item = e.target.parentElement;
    li.parentElement.removeChild(item);
    eliminarTareaEnBD(tarea); 
    actualizarTareas();
    // eliminarRegistro(id);
    });
    li.appendChild(btn_eliminar);
    document.getElementById('lista-tareas').appendChild(li);
    

})
    
        // listaTareas.appendChild(li);

    //----------borrador-------///
    localStorage.setItem("tarea", JSON.stringify(data))
    }
    
    
    function eliminarTareaEnBD(tarea) {
        fetch('src/eliminar.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(tarea )
        })
        .then(response => {
            if (response.ok) {
                console.log('Tarea eliminada de la base de datos');
            } else {
                console.error('Error al eliminar la tarea de la base de datos');
            }
        })
        .catch(error => {
            console.error('Error al enviar la solicitud:', error);
        });
    }
    
    
function mostrarTareasAlmacenadas() {
    
    let tareas = JSON.parse(localStorage.getItem("tarea")) || [];
        // Mostrar las tareas en la interfaz de usuario
        if (tareas.length > 0) {
            tareas.forEach(function(tarea) {
                // Aquí puedes agregar el código para mostrar cada tarea en la interfaz de usuario
                console.log(tarea.texto);
            });
        } else {
            console.log("No hay tareas almacenadas en localStorage.");
        }
    

renderTodos()  
        
}
 




 
                                    //------------<>----------//



function obtener_tareas(tareas){
  
const url='http://localhost/registro_tareas/peticion.php';
        

fetch("peticion.php",{
    method: 'GET'
})

.then(response => response.json())
.then(data => {
    console.log(data);
 set_get_localStorage(data);
})
.catch(error => {
    console.log('Error:', error);
});
    }