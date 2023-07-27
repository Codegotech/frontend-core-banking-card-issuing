// Sticky
$(window).scroll(function() {
    if ($(this).scrollTop() > 1){  
        $('header').addClass("sticky");
    }
    else{
        $('header').removeClass("sticky");
    }
});

// Navbar toggle button close

$("button.navbar-toggler, .navbar-nav li:not(.dropdown) a").click(function(){
  $("header").toggleClass("show");
});

// Navbar collapse Close

$(".navbar-nav li:not(.dropdown) a").click(function(){
    $(".navbar-collapse").toggleClass('show');
    $("button.navbar-toggler").toggleClass('collapsed');
});