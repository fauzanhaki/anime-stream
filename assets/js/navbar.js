$(window).scroll(function () { 
    var scroll = $(window).scrollTop();
    if(scroll >= 30){
        $("#navigation").addClass("bg-dark");
        $(".nav-link").removeClass("text-white");
    }
    else{
        $("#navigation").removeClass("bg-dark");
        $(".nav-link").addClass("text-white");
    }
});

const buttonRight = document.getElementById('slideRight');
const buttonLeft = document.getElementById('slideLeft');

buttonRight.onclick = function () {
  document.getElementById('container').scrollLeft += 20;
};
buttonLeft.onclick = function () {
  document.getElementById('container').scrollLeft -= 20;
};