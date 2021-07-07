$(window).resize(function () {
    const [,brand] = window.location.pathname.split('produtos/')

    if(brand != 'all') changeBanner(true)
    else changeBanner()
})
$(document).ready(function () {
    const [,brand] = window.location.pathname.split('produtos/')

    if(brand != 'all') changeBanner(true)
    else changeBanner()
})

function changeBanner(isBrand=false) {
    const banner = document.querySelector('#banner')
    let newUrl = ''
    if(!isBrand){
        if (window.innerWidth < 700) {
            const filename = document.querySelector('#mobile_banner').value
            newUrl = `${base_url}assets/img/banners/mobile/${filename}`
        }
        if (window.innerWidth >= 700) {
            const filename = document.querySelector('#banner_desktop').value
            newUrl = `${base_url}assets/img/banners/${filename}`
        }
    }else{
        if(window.innerWidth < 700 && document.querySelector('#banner_brand_mobile').value !== undefined){
            const filename = document.querySelector('#banner_brand_mobile').value
            newUrl = `${base_url}assets/img/banners/brands/mobile/${filename}`

        }else{
            const filename = document.querySelector('#banner_brand_desktop').value
            newUrl = `${base_url}assets/img/banners/brands/${filename}`
        
        }
    }
    // console.log(newUrl)
    banner.setAttribute('src', newUrl)
}