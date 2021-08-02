let urlArr = location.pathname.split ("/");

// console.log (urlArr.length);

// console.log (urlArr.forEach (e => ))

// urlArr.forEach (e => {
//     console.log ("this is the element " + e);
// });


// Click event of menu icon
// $('.navbar-menu').on ('click', navbarControl);
// $('.navbar-close').on ('click', navbarControl);

// Window resize event when navbar is open
$(window).resize(function () 
{
    if ((($('.nav').width () >= 766)) && ($('.navbar-wrapper').hasClass('element-view')))
    {
        $('.navbar-wrapper').toggleClass ('element-view');
    }
});

// Access Categories Dropdown menu
function accessCategories ()
{
    $('.sub-categories').toggleClass ('element-view');
}

// Mouse over event of categories dropdown
$('.dropdown').on ('click', accessCategories);
// $('.sub-categories').on ('mouseover', accessCategories);

// // Mouse out event of categories dropdown
// $('.dropdown').on ('mouseout', function () {setTimeout(accessCategories, 2000);});
// $('.sub-categories').on ('mouseout', accessCategories);

function menuToggle ()
{
    if ($(".nav-wrapper").css ("display") == "none")
    {
        $(".nav-wrapper").show (750)
    }
    else
    {
        $(".nav-wrapper").hide (650)
    }
}

function sehchaToggle ()
{
    if ($(".nav-search").css ("display") == "none")
    {
        $(".nav-search").show (750)
    }
    else
    {
        $(".nav-search").hide (650)
    }
}

$("a[title ~= menu-button]").on ("mouseleave", menuToggle)
$("div.navbar-search").mouseleave (sehchaToggle)
// $("div.navbar-search").mouseleave (sehchaToggle)

function carousel ()
{
    var i = 0; // Image slide start
    $(".ad-carousel").eq (i).show ();
    var time = 4100;

    var length = $(".ad-carousel").length;

    setInterval(() => {
        if (i < length - 1) {
            i++;
            $(".ad-carousel").eq (i - 1).hide ();
            $(".ad-carousel").eq (i).show ();
        }
        else {
            i = 0;
            $(".ad-carousel").eq (length - 1).hide ();
            $(".ad-carousel").eq (i).show ();
        }
    }, time);
}

$(window).on ('load', carousel);