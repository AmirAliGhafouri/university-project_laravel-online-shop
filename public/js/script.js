var swiper = new Swiper('.swiper-container', {
    slidesPerView: 5,
    spaceBetween: 50,
    // init: false,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    breakpoints: {
        1024: {
            slidesPerView: 4,
            spaceBetween: 40,
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 30,
        },
        640: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        320: {
            slidesPerView: 1,
            spaceBetween: 10,
        }
    }
});

/* Remove product from cartList */
function cart_remove(id){
    let remove = confirm('آیا مطمئن هستید؟');
    if(remove)
        location.href="/cart-remove/"+id;
}

function remove_product(id){
    let remove = confirm('آیا مطمئن هستید؟');
    if(remove)
        location.href="/admin/remove-product/"+id;
}