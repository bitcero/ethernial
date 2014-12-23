$(document).ready( function(){

    $(window).resize(
        $.throttle(500, function(){

            var inner_height = $("#header .inner").height();
            var toph = inner_height / 2;

            toph = Math.ceil(toph);
            $("#header .inner").css("margin-top", '-'+toph+'px');

        })
    );

    $(".scrolly").click( function(){

        var ele = $(this).attr("href");
        if ( ele == undefined || ele == '' )
            return false;

        $('html,body').animate({
            scrollTop: $(ele).offset().top,
        }, 1000);

        return false;

    });

    if ( $(".ether-carousel").length > 0 ){

        $(".inner").scrolly();

        $(".ether-carousel").kinetic();

        $(".carousel-container .backward").hover(function(){
            $(".ether-carousel").kinetic('start', { velocity: -5 });
        });

        $(".carousel-container .forward").hover(function(){
            $(".ether-carousel").kinetic('start', { velocity: 5 });
        });

        $(".carousel-container .backward, .carousel-container .forward").mouseout(
            $.throttle(250, function(){
                $(".ether-carousel").kinetic('stop');
            })
        );

    }

    $(window).resize();

    if ( $(".header-content").length <= 0 ){
        var bg = new Image();
        bg.onload = function(){
            $("#header").addClass('visible');
        }
        bg.src = bgheader;
    }

    if ( $("#ethernial-system-messages").length > 0 )
        setTimeout(function(){
            $("#ethernial-system-messages").fadeOut(350, function(){
                $(this).remove();
            });
        }, 5000);

});