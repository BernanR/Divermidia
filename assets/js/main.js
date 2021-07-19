
$(document).ready(() => {
  $(".main-form").on("submit", function () {
    let form = $(this).serialize();

    $(this).find("button[type=submit]").attr("disabled", true)
    $.ajax({
      type: "POST",
      url: "send-form",
      data: form,
      success: function (response) {
        var data = JSON.parse(response);
        $(".main-form").find("button[type=submit]").attr("disabled", false)
        if (!data.status) {
          $(".error-msg").removeClass("d-none");
          let message = $(".error-msg").find(".message");
          message.html(data.error);

        } else {
          $(".error-msg").addClass("d-none");
          $(".main-form")[0].reset();
          Swal.fire({
            position: 'top-center',
            icon: 'success',
            title: "Mensagem enviada com sucesso!",
            text: data.message,
            showConfirmButton: false,
            timer: 3500
          })

        }
      }
    });

    return false;
  })

  // $(".pulse-animate").on("mouseover", function () {
  //   $(this).addClass("animate__animated animate__bounceIn");
  // })

  // $(".pulse-animate").on("mouseout", function () {
  //   $(this).removeClass("animate__animated animate__bounceIn");
  // })

  $("a.item-carousel").on("click", function () {
    $(this).addClass("active");
    showInfoModal();

    $("#modal-lightbox-galery").on('hidden.bs.modal', function (e) {
      $("a.item-carousel").removeClass("active");
    })

  })

  function showInfoModal() {
    var item = $("a.item-carousel.active");
    var src = item.data("img");
    var video = item.data("video");
    var saiba_mais = item.data("saibamais");
    console.log(saiba_mais)
    var saiba_mais_brn = $($("#modal-lightbox-galery").find('.saiba-mais'));
    saiba_mais_brn.hide();

    if (video != '') {
      var file = '<iframe id="main_iframe" src="https://www.youtube.com/embed/' + video + '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
    } else {
      var file = "<img src=\"" + src + "\">";
    }

    if (saiba_mais != '') {
      saiba_mais_brn.attr("href", saiba_mais)
      saiba_mais_brn.show();
    }

    $("#modal-lightbox-galery").find(".modal-body").html(file);
    $("#modal-lightbox-galery").modal("show");
  }

  //$("#modal-lightbox-galery").modal("show");
  $('.pl-carousel').owlCarousel({
    center: true,
    items: 1,
    loop: true,
    margin: 0
  });
});

$('#owl-produtos').owlCarousel({
  margin: 10,
  responsiveClass: true,
  loop: false,
  nav: false,
  responsive: {
    0: {
      items: 1
    },
    900: {
      items: 2
    }
  }
})

function privatePolitic() {
  var html = '\
    <div class="politica" id="politica">\
      <div class="container">\
        <h7><strong>Este website utiliza cookies.</strong></h7>\
        <p>Nossa plataforma utiliza cookies para garantir que você tenha a melhor experiência de navegação. Se quiser saber mais, basta acessar nossa <a href="' + $("#base_url").val() + 'politica-privacidade">Política de Privacidade.</a></p>\
        <div class="input-politica">\
          <input class=\"btn btn-primary btn-enviar pulse-animate\" type="button" id=\"accept_politicy\" name="acao" value="ENTENDI">\
        </div>\
      </div>\
    </div>\
  ';

  if ($("#politica").length === 0) {
    $("body").append(html);
    $("#politica").hide().slideDown(300);
  }

  setTimeout(function () {
    $("#accept_politicy").on("click", function () {
      console.log("accept")
      var accept = JSON.stringify({ "privacy-policy-accept": true });
      setCookie('greenprocess', accept, 100);
      $("#politica").slideUp(300);
    });
  }, 100);
}

function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  var expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

var policyAccept = getCookie('greenprocess');
if (policyAccept === "") privatePolitic();