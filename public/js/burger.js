let burger = document.getElementById('burger');
let header = document.getElementById('header');

burger.addEventListener('click', () => {

    if(header.classList.contains('active')){
        header.classList.remove('active');
    }
    else {
        header.classList.add('active');
    }

})