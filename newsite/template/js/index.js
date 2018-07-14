$(function(){
    /* 首页大赛滚动 */
    $("#competitionRight").cgCarousel({
        prev: ".prev",
        next: ".next",
    });
    /* 首页动态切换卡 */
    $("body").cgChange({
        title: ".tabBtn li",
        content: ".tabContent",
        selectedClass: "selectItem"
    });
    /* 
        页面初始化 锚点动画
        锚点动画
        锚点动画函数
     */
    var anchors = window.location.href.split("/#")[1];
    scrollAnimate(anchors);
})