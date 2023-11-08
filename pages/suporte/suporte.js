function validaForm() {
  $("#toastStatus").addClass("d-block");

  $("#closeToastStatus").click(() => {
    $("#toastStatus").removeClass("d-block");
  });

  var name = $("#name").val();
  if (name == "") {
    $("#status").html("Nome não pode estar vazio");
    return false;
  }
  var email = $("#email").val();
  if (email == "") {
    $("#status").html("Email não pode estar vazio");
    return false;
  } else {
    var re =
      /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!re.test(email)) {
      $("#status").html("Email está no formato inválido");
      return false;
    }
  }
  var subject = $("#subject").val();
  if (subject == "") {
    $("#status").html("Assunto não pode estar vazio");
    return false;
  }
  var message = $("#message").val();
  if (message == "") {
    $("#status").html("Mensagem não pode estar vazio");
    return false;
  }

  $("#status").html("Enviando...");

  const formData = {
    name: $("#name").val(),
    email: $("#email").val(),
    subject: $("#subject").val(),
    message: $("#message").val(),
  };

  $.ajax({
    url: "service.php",
    type: "POST",
    data: formData,
    success: function (data, textStatus, jqXHR) {
      $("#status").text(data.message);
      if (data.code)
        //If mail was sent successfully, reset the form.
        $("#contact-form")
          .closest("form")
          .find("input[type=text], textarea")
          .val("");
      $("#status").text("Email Enviado");
        
    },
    error: function (jqXHR, textStatus, errorThrown) {
      $("#status").text(jqXHR);
    },
  });
}
