$(function(){
    /* ��ҳ�������� */
    $("#competitionRight").cgCarousel({
        prev: ".prev",
        next: ".next",
    });
    /* ��ҳ��̬�л��� */
    $("body").cgChange({
        title: ".tabBtn li",
        content: ".tabContent",
        selectedClass: "selectItem"
    });
    /* 
        ҳ���ʼ�� ê�㶯��
        ê�㶯��
        ê�㶯������
     */
    var anchors = window.location.href.split("/#")[1];
    scrollAnimate(anchors);
})