function evalua(oNombre, oApePat, rbSexo, oFecha){
var sErr="";
var bRet = false;

	if (oNombre.disabled==false && oNombre.value=="")
		sErr= sErr + "\n Falta nombre";

	if (oApePat.disabled==false && oApePat.value=="")
		sErr= sErr + "\n Falta apellido paterno";

	if (rbSexo[0].checked==false && rbSexo[1].checked==false)
		sErr= sErr + "\n Falta indicar sexo";

	if (oFecha.disabled==false && oFecha.value=="")
		sErr= sErr + "\n Falta fecha de nacimiento";
	
	if (sErr == "")
		bRet = true;
	else
		alert(sErr);
	
	return bRet;
}

function evaluaContacto(oNombre, oDireccion, oTelefono, oEmail,oVisualizador){
var sErr="";
var bRet = false;

	if (oNombre.disabled==false && oNombre.value=="")
		sErr= sErr + "\n Falta nombre";
                if (oDireccion.disabled==false && oDireccion.value=="")
		sErr= sErr + "\n Falta direccion";
                if (oTelefono.disabled==false && oTelefono.value=="")
		sErr= sErr + "\n Falta telefono";
                if (oEmail.disabled==false && oEmail.value=="")
		sErr= sErr + "\n Falta email";
            f (oVisualizador.disabled==false && oVisualizador.value=="")
		sErr= sErr + "\n Falta email";



	
	
	if (sErr == "")
		bRet = true;
	else
		alert(sErr);
	
	return bRet;
}

function evaluaPassword (oPassword ){
    var sErr="";
var bRet = false;
if (oPassword.disabled==false && oPassword.value=="")
		sErr= sErr + "\n Falta nombre";
            if (sErr == "")
		bRet = true;
	else
		alert(sErr);
	
	return bRet;
}

function confirmarEnvioFormulario(mensaje, boton1, boton2, imagen, formName) {
    const botones = document.createElement('div');
    botones.style.position = 'fixed';
    botones.style.top = 0;
    botones.style.left = 0;
    botones.style.width = '100%';
    botones.style.height = '100%';
    botones.style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
    botones.style.display = 'flex';
    botones.style.justifyContent = 'center';
    botones.style.alignItems = 'center';
    botones.style.zIndex = 1000;

    const message = document.createElement('h2');
    message.textContent = mensaje;
    message.style.color = 'black';
    message.style.fontSize = '24px';
    message.style.marginBottom = '20px';

    const contenedor = document.createElement('div');
    contenedor.style.background = '#fff';
    contenedor.style.padding = '30px';
    contenedor.style.borderRadius = '12px';
    contenedor.style.textAlign = 'center';
    contenedor.style.boxShadow = '0 0 15px rgba(0,0,0,0.3)';
    contenedor.style.minWidth = '300px';

    const image = document.createElement('img');
    image.src = imagen;
    image.style.width = '100px';
    image.style.marginBottom = '10px';

    const bot1 = document.createElement('button');
    bot1.textContent = boton1;
    bot1.style.backgroundColor = '#ccc';
    bot1.style.color = '#333';
    bot1.style.marginTop = '20px';
    bot1.style.padding = '12px 25px';
    bot1.style.fontSize = '16px';
    bot1.style.cursor = 'pointer';
    bot1.style.borderRadius = '8px';
    bot1.style.border = 'none';

    const bot2 = document.createElement('button');
    bot2.textContent = boton2;
    bot2.style.backgroundColor = '#d9534f';
    bot2.style.color = '#fff';
    bot2.style.marginTop = '20px';
    bot2.style.padding = '12px 25px';
    bot2.style.fontSize = '16px';
    bot2.style.cursor = 'pointer';
    bot2.style.borderRadius = '8px';
    bot2.style.border = 'none';

    contenedor.appendChild(message);
    contenedor.appendChild(document.createElement('hr'));
    contenedor.appendChild(image);
    contenedor.appendChild(document.createElement('hr'));
    contenedor.appendChild(bot1);
    contenedor.appendChild(bot2);

    botones.appendChild(contenedor);
    document.body.appendChild(botones);

    bot1.addEventListener('click', function () {
        document.body.removeChild(botones);
    });

    bot2.addEventListener('click', function () {
        document.forms[formName].submit(); // Envía el formulario
        document.body.removeChild(botones);
    });

    return false;
}

function evaluaDos(campos, mensajeConfirmacion, btnCancelar, btnConfirmar, redireccionCancelar, redireccionConfirmar, imagen) {
    var sErr = "";
    
    // Validar cada campo enviado en el array `campos`
    campos.forEach(campo => {
        if (!campo.disabled && campo.value.trim() === "") {
            sErr += `\n Falta ${campo.name}`;
        }
    });

    if (sErr !== "") {
        // Si hay errores, muestra un popup de advertencia en lugar de un alert
        algunaAccionInput(
            "Hay errores en el formulario:" + sErr,
            "Cerrar",
            "Corregir",
            "javascript:void(0)", // No hacer nada, solo cerrar el popup
            "javascript:void(0)",
            "img/reprobado.gif"
        );
        return false; // Detener envío del formulario
    } else {
        // Todos los campos están completos, preguntar si quiere continuar
        algunaAccionInput(
            mensajeConfirmacion,
            btnCancelar,
            btnConfirmar,
            redireccionCancelar,
           redireccionConfirmar,
            imagen
        );
        return false; // Esperar confirmación antes de enviar el formulario
    }
}

function algunaAccionInput(mensaje,boton1,boton2,redireccionuno,redirecciondos,imagen){
  
  const botones = document.createElement('div');
  botones.style.position = 'fixed';
  botones.style.top = 0;
  botones.style.left = 0;
  botones.style.width = '100%';
  botones.style.height = '100%';
  botones.style.backgroundColor = 'rgba(0, 0, 0, 0.7)'; 
  botones.style.display = 'flex';
  botones.style.justifyContent = 'center';
  botones.style.alignItems = 'center';
  botones.style.zIndex = 1000;

  
  const message = document.createElement('h2');
  
  message.textContent = mensaje;
  message.style.color = 'black';
  message.style.fontSize = '24px'; 
  message.style.marginBottom = '20px';

  
  const contenedor = document.createElement('div');
  contenedor.style.background = '#fff';
  contenedor.style.padding = '30px';
  contenedor.style.borderRadius = '12px';
  contenedor.style.textAlign = 'center';
  contenedor.style.boxShadow = '0 0 15px rgba(0,0,0,0.3)';
  contenedor.style.minWidth = '300px';

  const image = document.createElement('img');
    image.src = imagen;
    image.style.width = '100px';
    image.style.marginBottom = '10px';
    
  const bot1 = document.createElement('button');
  bot1.textContent = boton1;
  bot1.style.backgroundColor = '#ccc';
  bot1.style.color = '#333';
  bot1.style.marginTop = '20px';
  bot1.style.padding = '12px 25px';
  bot1.style.fontSize = '16px';
  bot1.style.cursor = 'pointer';
  bot1.style.borderRadius = '8px';
  bot1.style.border = 'none';
  bot1.style.transition = 'background-color 0.3s';

 
  const bot2 = document.createElement('button');
  bot2.textContent = boton2;
  bot2.style.backgroundColor = '#d9534f';
  bot2.style.color = '#fff';
  bot2.style.marginTop = '20px';
  bot2.style.padding = '12px 25px';
  bot2.style.fontSize = '16px';
  bot2.style.cursor = 'pointer';
  bot2.style.borderRadius = '8px';
  bot2.style.border = 'none';
  bot2.style.transition = 'background-color 0.3s';

 
  contenedor.appendChild(message);
  contenedor.appendChild(document.createElement('hr'));
   contenedor.appendChild(image);
    contenedor.appendChild(document.createElement('hr'));
  contenedor.appendChild(bot1);
  contenedor.appendChild(bot2);
  


  botones.appendChild(contenedor);

 
  document.body.appendChild(botones);

  
  bot1.addEventListener('click', function () {
       window.location.href = redireccionuno;
    document.body.removeChild(botones); 
    
  });

  
  bot2.addEventListener('click', function () {
    window.location.href = redirecciondos;
     document.body.removeChild(botones); 
  });
}

function ventanaEmergente(mensaje,boton1,boton2,redireccion,imagen,popupaux){
  
   const botones = document.createElement('div');
  botones.style.position = 'fixed';
  botones.style.top = 0;
  botones.style.left = 0;
  botones.style.width = '100%';
  botones.style.height = '100%';
  botones.style.backgroundColor = 'rgba(0, 0, 0, 0.7)'; 
  botones.style.display = 'flex';
  botones.style.justifyContent = 'center';
  botones.style.alignItems = 'center';
  botones.style.zIndex = 1000;

  
  const message = document.createElement('h2');
  
  message.textContent = mensaje;
  message.style.color = 'black';
  message.style.fontSize = '24px'; 
  message.style.marginBottom = '20px';

  
  const contenedor = document.createElement('div');
  contenedor.style.background = '#fff';
  contenedor.style.padding = '30px';
  contenedor.style.borderRadius = '12px';
  contenedor.style.textAlign = 'center';
  contenedor.style.boxShadow = '0 0 15px rgba(0,0,0,0.3)';
  contenedor.style.minWidth = '300px';

  const image = document.createElement('img');
    image.src = imagen;
    image.style.width = '100px';
    image.style.marginBottom = '10px';
    
  const bot1 = document.createElement('button');
  bot1.textContent = boton1;
  bot1.style.backgroundColor = '#ccc';
  bot1.style.color = '#333';
  bot1.style.marginTop = '20px';
  bot1.style.padding = '12px 25px';
  bot1.style.fontSize = '16px';
  bot1.style.cursor = 'pointer';
  bot1.style.borderRadius = '8px';
  bot1.style.border = 'none';
  bot1.style.transition = 'background-color 0.3s';

 
  const bot2 = document.createElement('button');
  bot2.textContent = boton2;
  bot2.style.backgroundColor = '#d9534f';
  bot2.style.color = '#fff';
  bot2.style.marginTop = '20px';
  bot2.style.padding = '12px 25px';
  bot2.style.fontSize = '16px';
  bot2.style.cursor = 'pointer';
  bot2.style.borderRadius = '8px';
  bot2.style.border = 'none';
  bot2.style.transition = 'background-color 0.3s';

 
  contenedor.appendChild(message);
  contenedor.appendChild(document.createElement('hr'));
   contenedor.appendChild(image);
    contenedor.appendChild(document.createElement('hr'));
  contenedor.appendChild(bot1);
  contenedor.appendChild(bot2); 


  botones.appendChild(contenedor);
 
  document.body.appendChild(botones);
  
  bot1.addEventListener('click', function () {
       //window.location.href = redireccionuno;
       document.body.removeChild(botones);
      popupaux(true);
    
  });

  
  bot2.addEventListener('click', function () {
     
     document.body.removeChild(botones);
      window.location.href = redireccion;
      popupaux(false);
      
  });

}


function mostrarVentanaEmergente(event, mensaje, boton1, boton2, redireccion, imagen) {
    event.preventDefault(); 
   
   
    ventanaEmergente(mensaje, boton1, boton2, redireccion, imagen, function(resultado) {
        if (resultado) {
            event.target.form.submit(); 
        }else{
            //mostrarPopup("Se cancelo la operacion",'img/aprobado.gif','abcContactos2.php');
        }
    });

    return false; 
}

function mostrarPopup(mensaje, imagen, redireccion) {
    const overlay = document.createElement('div');
    overlay.style.position = 'fixed';
    overlay.style.top = 0;
    overlay.style.left = 0;
    overlay.style.width = '100%';
    overlay.style.height = '100%';
    overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
    overlay.style.display = 'flex';
    overlay.style.justifyContent = 'center';
    overlay.style.alignItems = 'center';
    overlay.style.zIndex = 1000;

    const popup = document.createElement('div');
    popup.style.background = '#fff';
    popup.style.padding = '20px';
    popup.style.borderRadius = '10px';
    popup.style.textAlign = 'center';
    popup.style.boxShadow = '0 0 10px rgba(0,0,0,0.3)';

    const image = document.createElement('img');
    image.src = imagen;
    image.style.width = '100px';
    image.style.marginBottom = '10px';

    const message = document.createElement('p');
    message.textContent = mensaje;

    const button = document.createElement('button');
    button.textContent = 'Aceptar';
    button.style.marginTop = '10px';
    button.style.padding = '10px 20px';
    button.style.cursor = 'pointer';

    button.addEventListener('click', function () {
        window.location.href = redireccion;
    });

    popup.appendChild(image);
    popup.appendChild(message);
    popup.appendChild(button);
    overlay.appendChild(popup);
    document.body.appendChild(overlay);
}





