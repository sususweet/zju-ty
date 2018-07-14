$(
    function(){
        var bol = true;
        $("#navBtn img").click(function(){
            if(bol==true){
                $(".navt .navt-mask").css("display","block");
                $(".navt .navt-mask").show();
                $(".navt .navt-mask").animate({
                    left:"0"
                },300);
                $("html,body").css("overflow-y","hidden");
                bol=false;
            }else{
                $(".navt .navt-mask").animate({
                    left:"435px",
                },300,function(){
                    if($(".navt .navt-mask").position().left==435){
                        $(".navt .navt-mask").css("display","none");
                    }
                });
                $("html,body").css("overflow-y","scroll");
                bol=true;
            }
        });
        $(window).resize(function(){
            if($(window).width()>700){
                $(".navt .navt-mask").css("display","block");
            }else{
                $(".navt .navt-mask").css("display","none");
            }
        });
        $(".selected-navone").click(function(){
            if($(window).width()<=700){
                $(this).children().eq(0).removeAttr("href");
            }else if($(window).width()==768||$(window).width()==1024){
                $("ul").remove(".second-nav");
            }
            $(this).find($('.second-nav')).css("display","block");
            $(".selected-navone").not($(this)).find($('.second-nav')).css("display","none");
        });
    }
);

