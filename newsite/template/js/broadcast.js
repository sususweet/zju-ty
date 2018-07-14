$(function(){
	//������
	$(".cg-navt").cgMenu({
		effect:{
			openSpeed: 500,    
			closeSpeed: 500,    
			openType: 'fade',   
			closeType: 'fade',
		}
	});
	//β���ֲ�
	$("#scrollt").cgCarousel({
		prev: ".prev",
        next: ".next"
	});
	//��ͨ��ʵ������������ҳ�е�������ʾ
	$(".date5").cgCalendar({
		showTimePanel:false,
		showToolsPanel:false,
		months:["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"],
		click:function(e){
            var href = $(e.target).attr("href");
            if(href){
                window.location.href = href;
            }
		}
	});

	//֪ͨ����
	$(".noticet-list li").click(function(){
		$(this).addClass("noticet-yellow").find("span").addClass("noticet-blue");
		$(".noticet-list li").not($(this)).removeClass("noticet-yellow").find("span").removeClass("noticet-blue");
	});
	$("body").cgChange({
		title:".noticet-list ul li",
		content:".noticet-show .noticet-all",
	   });
	//���ñ�
	$("body").cgChange({
		title:".goodcupts ul li",
		content:".goodcupts-contents .goodcupts-content",
		selectedClass:"goodcupts-selected"
	   });
	//���ְ�
	if($("#scoret-scroll li").length>=6){
		$("#scoret-scroll").cgCarousel({
			vertical:'true',
			type:"ceaseless",
			delay:0,
			speed:30
		});
	};
	//ͷ���ֲ�
	$(".pic-box").cgPictureEffect({
		picture:".big-pic",
		thumbPicture:".small-pic",
		effect:{
			type:"fade",
			speed:1000
		},
		thumbEffect:{
			style:"icon",
			selectedClass:"small-hover"
		}
	});

	
	var newsEffect = {
		n:0,
		circulation:null,
		init:function(){
			this.bind();
			this.autoPlay();
			this.animate(0);
		},
		bind:function(){
			var _this = this;
			$(".new_left").hover(function(){
				_this.pausePlay();
			},function(){
				_this.autoPlay();
			})

			$(".title_btn li").hover(function(){
				_this.n = $(this).index();
				_this.animate(_this.n);
			},function(){
				return null;
			})
		},
		autoPlay:function(){
			var _this = this;
			this.circulation = setInterval(function(){
				_this.n ++;
				if(_this.n>=3){
					_this.n = 0;
				};
				_this.animate(_this.n);
			},3000)
		},
		pausePlay:function(){
			clearInterval(this.circulation);
		},
		animate:function(n){
			$(".new_box").hide().eq(n).fadeIn();
			$(".title_btn li").removeClass("select_btn").eq(n).addClass("select_btn");
		},
		clickdown:function(){
			var _this = this;
			// _this.mouseover();
			$('.cg-cataloga li a').each(function(){
				if($($(this))[0].href==String(window.location)){
					$(this).parents("li").addClass('moveover');
					$(this).css("color","white");
					$(this).parent().find("span").addClass("movecircle");
					$(this).attr("bol","true");
				}
			});
			
		},
		//���ض���
		backtop:function(){
			$('.backtop-button ').hide();
			$(window).scroll(function(){
				
				if ($(window).scrollTop()>=600) {
                    $('.backtop-button ').fadeIn();
				}
				else {
					$('.backtop-button ').fadeOut();
				}
			});
			$('.backtop-button ').click(function() {
				$('body,html').animate({
					scrollTop: 0
				}, 900);
			});
		}
	}
	newsEffect.init();
	newsEffect.clickdown();
	newsEffect.backtop();
	
	
});
