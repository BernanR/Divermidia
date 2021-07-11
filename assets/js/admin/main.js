var base_url = $("#base_url").val();


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
  $("#media_btn").on('click', function () {
    console.log("loading")
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
  element.remove();
}

function changeEmbedSource(videoID, targetIframeID) {
  if (!videoID) return false;
  const targetIframe = document.getElementById(targetIframeID);
  const targetIframeSrc = targetIframe.src;
  const [, replace] = targetIframeSrc.split("/embed/");

  const newSrc = targetIframeSrc.replace(replace, videoID);
  targetIframe.setAttribute("src", newSrc);
}

load_media_files()