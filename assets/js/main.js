
 $(document).ready(()=>{

  $("a.item-carousel").on("click", function() {
    var item = $(this);
    var src = item.data("img");

    var image = "<img src=\"" + src + "\">";

    $("#modal-lightbox-galery").find(".modal-body").html(image);
    $("#modal-lightbox-galery").modal("show");

  })

  //$("#modal-lightbox-galery").modal("show");

  $(".main-banner").owlCarousel({
      navigation: true,
      items: 1,
      loop: true,
      autoplay: true,
      autoplayTimeout: 7000,
      nav: true,
      navText: ["<i class=\"icon ion-ios-arrow-back\"></i>", "<i class=\"icon ion-ios-arrow-forward\"></i>"],
      singleItem: true
  });

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

$(".main-banner").owlCarousel({
  navigation: true,
  items: 1,
  loop: true,
  autoplay: true,
  autoplayTimeout: 7000,
  nav: true,
  navText: ["<i class=\"icon ion-ios-arrow-back\"></i>", "<i class=\"icon ion-ios-arrow-forward\"></i>"],
  singleItem: true
});

function privatePolitic() {
  var html = '\
    <div class="politica" id="politica">\
      <div class="content">\
        <h7><strong>Este website utiliza cookies.</strong></h7>\
        <p>Nossa plataforma utiliza cookies para garantir que você tenha a melhor experiência de navegação. Se quiser saber mais, basta acessar nossa <a href="https://www.greenprocess.com.br/politica-privacidade">Política de Privacidade.</a></p>\
        <div class="input-politica">\
          <input type="button" id=\"accept_politicy\" name="acao" value="ENTENDI">\
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