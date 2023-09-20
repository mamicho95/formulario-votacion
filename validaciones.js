function formateaRut(rut) {
  let actual = rut.replace(/^0+/, "");
  if (actual != "" && actual.length > 0) {
    let sinPuntos = actual.replace(/\./g, "");
    let actualLimpio = sinPuntos.replace(/-/g, "");
    let inicio = actualLimpio.substring(0, actualLimpio.length - 1);
    let rutPuntos = "";
    let i = 0;
    let j = 1;
    for (i = inicio.length - 1; i >= 0; i--) {
      let letra = inicio.charAt(i);
      rutPuntos = letra + rutPuntos;
      if (j % 3 == 0 && j <= inicio.length - 1) {
        rutPuntos = "." + rutPuntos;
      }
      j++;
    }
    let dv = actualLimpio.substring(actualLimpio.length - 1);
    rutPuntos = rutPuntos + "-" + dv;
  }
  return rutPuntos;
}
function VerificaRut(rut) {
  rut = rut.replace(/\./g, "", "");
  if (rut.toString().trim() != "" && rut.toString().indexOf("-") > 0) {
    let caracteres = new Array();
    let serie = new Array(2, 3, 4, 5, 6, 7);
    let dig = rut.toString().substr(rut.toString().length - 1, 1);
    rut = rut.toString().substr(0, rut.toString().length - 2);
    for (let i = 0; i < rut.length; i++) {
      caracteres[i] = parseInt(rut.charAt(rut.length - (i + 1)));
    }
    let sumatoria = 0;
    let k = 0;
    let resto = 0;
    for (let j = 0; j < caracteres.length; j++) {
      if (k == 6) {
        k = 0;
      }
      sumatoria += parseInt(caracteres[j]) * parseInt(serie[k]);
      k++;
    }
    resto = sumatoria % 11;
    dv = 11 - resto;
    if (dv == 10) {
      dv = "K";
    } else if (dv == 11) {
      dv = 0;
    }
    if (
      dv.toString().trim().toUpperCase() == dig.toString().trim().toUpperCase()
    )
      return true;
    else return false;
  } else {
    return false;
  }
}
function validarEmail(email) {
    let regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    if (regex.test(email)) {
      return true; 
    } else {
      return false; 
    }
  }
$(document).ready(function () {
  $("#rut").on("keyup", function () {
    $("#rut").val(formateaRut(this.value));
  });
  $("#formulario").on("submit", function (event) {
    event.preventDefault(); // Evita el envío del formulario por defecto

    let nombre = $("#name").val();
    let alias = $("#alias").val();
    let rut = $("#rut").val();
    let email = $("#email").val();
    let region = $("#region").val();
    let candidato = $("#candidato").val();
    let checkboxesSeleccionados = $('input[type="checkbox"]:checked');
    let valid = true;
    if (nombre === "") {
      $("#valname").css("visibility", "visible");
      valid = false;
    } else {
      $("#valname").css("visibility", "hidden");
    }
    let regex = /^(?=.*[a-zA-Z])(?=.*\d).{5,}$/;
    if (!regex.test(alias)) {
      $("#valalias").css("visibility", "visible");
      valid = false;
    } else {
      $("#valalias").css("visibility", "hidden");
    }

    if (!VerificaRut(rut)) {
      $("#valrut").css("visibility", "visible");
      valid = false;
    } else {
      $("#valrut").css("visibility", "hidden");
    }

    if (!validarEmail(email)) {
        $("#valemail").css("visibility", "visible");
        valid = false;
      } else {
        $("#valemail").css("visibility", "hidden");
      }

    if (region === "0") {
      $("#valregion").css("visibility", "visible");
      valid = false;
    } else {
      $("#valregion").css("visibility", "hidden");
    }

    if (candidato === "0") {
        $("#valcandidato").css("visibility", "visible");
        valid = false;
      } else {
        $("#valcandidato").css("visibility", "hidden");
      }
    if (checkboxesSeleccionados.length < 2) {
      $("#valcheckbox").css("visibility", "visible");
      return;
    } else {
      $("#valcheckbox").css("visibility", "hidden");
    }

    if (!valid) {
      return;
    }
    let datos = $(this).serialize();
    //console.log(datos);
    $.ajax({
      url: "nuevoUsuario.php",
      method: "POST",
      data: datos,
      success: function (response) {
        console.log(response);
        if (response == 0) {
          alert("Ya se ha votado con el rut este usuario");
        }
        if (response == 1) {
          alert("Su voto se ha ingresado correctamente");
          $("#comuna").html(
            '<option value="0" selected>-Seleccione comuna-</option>'
          );
          $("#region option[value='0']").prop("selected", true);
          $("#candidato option[value='0']").prop("selected", true);
          $("#formulario")[0].reset();
        }
      },
      error: function (error) {
        alert("Error", error);
      },
    });
  });
});
