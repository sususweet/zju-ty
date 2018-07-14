
$(function () {
    var windowWidth = $(window).width();

    $("a[link*='http://']:not([link*='" + location.hostname + "'])").attr("target", "_blank");

    /* �˵�������л� */
    $("#navBtn").click(function () {
        var left = $("#navigation").offset().left;
        if (left == 0) {
            menuToggle("hide");
        } else {
            menuToggle("show");
        }
    });
    //С���µ���˵� �˵�����
    if (windowWidth <= 768) {
        $("#navigation").click(function () {
            menuToggle("hide");
        })
    }

    /* ��λê�� */
    $("#navigation li").click(function(){
        var dataPathname = $(this).attr("data-pathname");
        if(dataPathname){
            window.location.href = "/#"+dataPathname;
            scrollAnimate(dataPathname);
            if (windowWidth <= 768) {
                menuToggle("hide");
            }
            return false
        }
    });

    var listMenu = $("#listMenu").length;
    if(listMenu>0){
        //��ʼ���˵�����
        $("#listMenu li").eq(0).addClass("highlight");
        //��ʼ���ò˵��Ƿ񸡶�
        setMenuFiexd();
        $(window).scroll(function(event){
            setMenuFiexd();
        })
    }
    //���ض�����ť
    backTopToggle();
    $(window).scroll(function(event){
        backTopToggle();
    })
    $(".backTop").click(function(){
        $("html,body").animate({scrollTop: 0},500);
    })
})

//����������
function scrollAnimate(className){
    if(!className){return false};
    var $target = $("."+className);
    if($target.length>0){
        var targetOffset = $target.offset().top-150;
        $('html,body').animate({scrollTop: targetOffset},500);
    }
}

//�˵�Ч��
function menuToggle(type) {
    if (type == "hide") {
        $("#navigation").animate({
            left: "100%"
        }, 300);
    } else {
        $("#navigation").animate({
            left: 0
        }, 300);
    }
}

//listMenu��������
function setMenuFiexd (){
    var top = $(".hasMenu").offset().top;
    var scrollTop = $(window).scrollTop();
    if(top-scrollTop<=0){
        $("#listMenu").addClass("headerFiexd");
    }else{
        $("#listMenu").removeClass("headerFiexd");
    }
}

//��������������listMenu����
function menuHighlight(){
    var scrollTop = $(window).scrollTop();
    var height = $(window).height()/2;
    $("#listMenu li").each(function(){
        var className = $(this).attr("data-pathname");
        if(className){
            var top = $("."+className).offset().top;
            if(scrollTop>=top-height){
                setMenuHighLight($(this));
            }
        }
    })
}
//����listMenu����
function setMenuHighLight(obj){
    $("#listMenu li").removeClass("highlight");
    obj.addClass("highlight");
}
//���ذ�ť��ʾ����
function backTopToggle(){
    var scrollTop = $(window).scrollTop();
    if(scrollTop>=200){
        $(".backTop").show();
    }else{
        $(".backTop").hide();
    }
}