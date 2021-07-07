var base_url = $("#base_url").val();

$("#form").submit(function () {
  var dataRemote = $(this).attr("data-remote");
  if (dataRemote == "true") {
    var form = $(this);
    var action = $(this).attr("action");
    var method = $(this).attr("method");
    var focusResponse = $(this).attr("focus-response");
    var origem = $(this).attr("origem");

    $(focusResponse).show();

    $(this).find("button").attr("disabled", true);

    var formData = new FormData(form[0]);

    $(focusResponse)
      .html(
        '<img style="width:80px;" class="ajax-icon" src="' +
          base_url +
          'assets/img/ajax-loader.gif" />'
      )
      .show();

    $.ajax({
      type: method,
      url: action,
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        form.find("button").attr("disabled", false);
        $(focusResponse).html(response).show();

        var msg = $(focusResponse).find("p.alert");
        if ($(msg).hasClass("alert-success")) {
          form.each(function () {
            this.reset();
          });
        }

        $("#custom-file-text").html("NENHUM ARQUIVO SELECIONADO");

        setTimeout(() => {
          $(focusResponse).hide();
          if (origem == "cart") {
            if ($(msg).hasClass("alert-success")) {
              window.location.href = base_url + "lista-compra";
            }
          }
        }, 8000);
      },
      beforeSend: () => {
        $(focusResponse)
          .html(
            '<img class="ajax-icon" src="' +
              base_url +
              'assets/img/ajax-loader.gif" />'
          )
          .show();
      },
      error: (e) => {
        $(focusResponse).hide();
        form.find("button").attr("disabled", false);
        console.log(e);

        alert(
          "Não foi possível Enviar o Formulário. \nTente novamente mais tarde."
        );
        return false;
      },
    });

    return false;
  }
});

$("#searchForm").submit(() => {
  const item = document.getElementsByName("search")[0];
  return item.value == "" ? false : true;
});
$(document).ready(() => {
  mask_formulario();
  hideLinksMobile();
});

window.onresize = function () {
  hideLinksMobile();
};

function hideLinksMobile() {
  // const { innerWidth: w } = window
  // const aDropLinks = document.querySelectorAll('.rm-dropdown-mobile')
  // if (w < 990) {
  //     // 0 -> serviços || 1 -> produtos || 2 -> projetos
  //     aDropLinks[0].setAttribute('href', base_url + 's/s-all')
  //     aDropLinks[1].setAttribute('href', base_url + 'produtos/all')
  //     aDropLinks[2].setAttribute('href', base_url + 'p/p-all')
  //     aDropLinks.forEach(a => {
  //         a.removeAttribute('id')
  //         a.classList.remove('dropdown')
  //         a.removeAttribute('data-toggle')
  //     })
  // } else {
  //     aDropLinks.forEach(a => {
  //         a.setAttribute('href', '')
  //         a.setAttribute('data-toggle', 'dropdown')
  //         a.classList.add('dropdown')
  //         a.setAttribute('id', 'navbarDropdownMenuLink')
  //     })
  // }
}

function mask_formulario() {
  $(".date").mask("00/00/0000");
  $(".time").mask("00:00:00");
  $(".date_time").mask("00/00/0000 00:00:00");
  $(".cep").mask("00000-000");
  $(".phone").mask("0000-0000");
  $(".phone_with_ddd").mask("(00) #0000-0000");
  $(".phone_us").mask("(000) 000-0000");
  $(".mixed").mask("AAA 000-S0S");
  $(".cpf").mask("000.000.000-00", { reverse: true });
  $(".cnpj").mask("00.000.000/0000-00", { reverse: true });
  $(".money").mask("000.000.000.000.000,00", { reverse: true });
  $(".money2").mask("#.##0,00", { reverse: true });
  $(".ip_address").mask("0ZZ.0ZZ.0ZZ.0ZZ", {
    translation: {
      Z: {
        pattern: /[0-9]/,
        optional: true,
      },
    },
  });
  $(".ip_address").mask("099.099.099.099");
  $(".percent").mask("##0,00%", { reverse: true });
  $(".clear-if-not-match").mask("00/00/0000", { clearIfNotMatch: true });
  $(".placeholder").mask("00/00/0000", { placeholder: "__/__/____" });
  $(".fallback").mask("00r00r0000", {
    translation: {
      r: {
        pattern: /[\/]/,
        fallback: "/",
      },
      placeholder: "__/__/____",
    },
  });
  $(".selectonfocus").mask("00/00/0000", { selectOnFocus: true });
}

function addMoreProducts() {
  $("#more-products").click(function () {
    $(".loading-prod").fadeIn();
    $(this).hide();
    var form = $("#product_filter");

    $.ajax({
      type: form.attr("method"),
      url: form.attr("action"),
      data: form.serialize(),
      success: function (data) {
        let result = JSON.parse(data);
        $(".row-products").append(result.html);
        $(".loading-prod").hide();

        let box_more_pd = $(".div-more-p").clone();
        $(".div-more-p").remove();
        $("#page_init").val(result.page_init);

        if (
          result.page_init + result.produtcs_qtd <
          parseInt(result.products_total_qtd)
        ) {
          $(".product-containt").append(box_more_pd);
          $("#more-products").fadeIn();
          addMoreProducts();
        }
      },
    });
  });
}

addMoreProducts();

function addQtdPoductCart() {
  $(".qtd-input").change(function (e) {
    var id = $(this).data("id");
    var qty = $(this).val();
    $.ajax({
      type: "GET",
      url: base_url + "/cart/add_qtd_product/" + id + "?qty=" + qty,
      success: function (data) {
        console.log(data);
      },
    });
  });
}

addQtdPoductCart();

$(".form-product input").click(function () {
  $(this).parents("form").submit();
});
// //efeito whats
// const whatsDiv = document.getElementById('whats');
// $(document).ready(() => {

//     $('#whats').on({
//         mouseenter: function () {
//             if (window.innerWidth > 991) {
//                 $('#whats').stop().animate({
//                     right: 0
//                 })
//             }
//         },
//         mouseleave: function () {
//             if (window.innerWidth > 991) {
//                 $('#whats').stop().animate({
//                     right: -143
//                 })
//             }
//         }
//     })

// })
//PULSE WHATS

const w = document.getElementById("whats");
const pulseDiv = document.getElementById("addPulse");
alert("oie");
function captha() {
  $("#captha")
    .html(
      '<div style="text-align:center;"><img style="width:60px;" class="ajax-icon" src="' +
        base_url +
        'assets/img/ajax-loader.gif" /></div>'
    )
    .show();
  $.ajax({
    type: "GET",
    url: base_url + "captha-get",
    success: function (data) {
      data = JSON.parse(data);

      var html = "";

      html += '<div class="row">';
      html += '<div class="col-sm-12 col-md-2 icon-form-col">';
      html += '<div class="mt-3">';
      html += '<span onclick="captha()" style="cursor:pointer;">';
      html +=
        '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-repeat" fill="currentColor" xmlns="http://www.w3.org/2000/svg">                ';
      html +=
        '<path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"></path>                ';
      html +=
        '<path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"></path>';
      html += "</svg>";
      html += "</span>";
      html += "</div>";
      html += "</div>";
      html += '<div class="col-sm-5 col-md-4">';
      html += '<div class="mt-3">';
      html += data.image;
      html += "</div>";
      html += "</div>";
      html += '<div class="col-sm-7 col-md-6">';
      html += '<div class="pr-5 mt-3">';
      html +=
        '<input style="font-size: 12px;" id="captha_input"  name="captha_input" id="captha_input" maxlength="15"  type="tel" placeholder="Digite o Texto" class="form-control captha_input">';
      html += "</div>";
      html += "</div>";
      html += "</div>";

      $("#captha").html(html).hide().fadeIn();
    },
  });

  return false;
}

captha();

function setSource(targetID, context) {
  const target = document.getElementById(targetID);

  if (context.files && context.files[0]) {
    const reader = new FileReader();

    reader.onload = function (e) {
      console.log(e.target);
      target.setAttribute("src", e.target.result);
    };

    reader.readAsDataURL(context.files[0]);
  }
}

function setBannerType(context) {
  const mobileDiv = document.getElementById("mobile_banners");
  const desktopDiv = document.getElementById("desktop_banners");

  if (context.value === "mobile") {
    desktopDiv.setAttribute("hidden", "");
    mobileDiv.removeAttribute("hidden");
  } else {
    mobileDiv.setAttribute("hidden", "");
    desktopDiv.removeAttribute("hidden");
  }
}

function link_copy(e) {
  $(e).find(".url_file").select();
  document.execCommand("copy");
}

function load_media_files() {
  $("#media_btn").click(function () {
    $("#mediafiles_upload").modal();
    $.ajax({
      type: "GET",
      url: base_url + "api/get-media/upld_",
      dataType: "html",
      success: function (data) {
        $("#modal_load_media").html(data);
      },
    });
    return false;
  });
}

function dlete_file_media(e) {
  const el = $(e);
  const _url = el.data("href");

  if (
    confirm(
      "Deseja realmente excluir esse arquivo? Ao excluir não será mais exibido no site."
    )
  ) {
    $.ajax({
      type: "GET",
      url: _url,
      dataType: "json",
      success: function (data) {
        el.parents("li.jFiler-item").remove();
      },
    });
  }

  return false;
}

load_media_files();

//on admin
function addMedia(content, ulID, counterValue) {
  const ul = document.getElementById(ulID);
  const li = document.createElement("li");
  li.setAttribute(
    "class",
    `list-group-item d-flex justify-content-between align-items-center`
  );
  li.setAttribute("id", `li_${counterValue}`);
  li.innerHTML = content;
  ul.append(li);
}

function removeSource(elementID) {
  //remove LI da lista de mídias da galeria
  const element = document.getElementById(elementID);
  console.log(element);
  element.remove();
}
