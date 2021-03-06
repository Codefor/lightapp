//汉堡王
var imgSrc		= "./images/",
	loadingImg	= [
		imgSrc + "1.png",
		imgSrc + "2.jpg",
		imgSrc + "3.png",
		imgSrc + "4.png",
		imgSrc + "5.png",
		imgSrc + "6.png",
		imgSrc + "7.png",
		imgSrc + "8.png",
	/*	imgSrc + "9.png",
		imgSrc + "10.png",
		imgSrc + "11.png",
		imgSrc + "12.png",
		imgSrc + "13.png",
		imgSrc + "14.png",
		imgSrc + "15.png"*/
	],
	questions	= {
		one : {
			title 	: "世界杯诞生了一个风靡全球的启瓶器，你知道神马牌子吗？",
			topic 	: [
				"A巴洛特利牌",
				"B苏亚雷斯牌",
				"C王大锤牌"
				
			],
			answer	: "B",
			fraction: 10
		},
		two : {
			title 	: "满地找牙有了新的解释，你认为哪个最合理？",
			topic 	: [
				"A周董宣布结婚了，一群女粉悲伤后的结果",
				"B知道高考分数还不够买10个茶叶蛋的，自虐至极",
				"C西班牙和葡萄牙二牙均世界杯一轮游",
			
			],
			answer	: "C",
			fraction: 10
		},
		three : {
			title 	: "假如贝利说了下面的话，你认为哪个可以实现？",
			topic 	: [
				"A我坚信有一天中国男足能拿世界杯冠军",
				"B哪天我限号，也要去PP租一辆拉风一下",
				"C我要为一款美白BB霜代言，自己用了效果不错",
				
			],
			answer	: "B",
			fraction: 10
		},
		four : {
			title 	: "PP哥的slogan是［最划算的网上租车］，假如让你给范佩西想一个slogan你认为会是？",
			topic 	: [
				"A最能飞的前锋大鸟",
				"B前锋中的最强大脑",
				"C最知名的荷兰豆",
			
			],
			answer	: "B",
			fraction: 10
		},
		five : {
			title 	: "世界杯熬夜看球，第二天要迟到了，你第一反应是？",
			topic 	: [
				"A疯狂一次，不去了，爱咋咋地",
				"B打开PP租车，五分钟搞定一辆，so easy",
				"C跟领导请假，老婆大姨妈来了，我招待一下",
				
			],
			answer	: "B",
			fraction: 10
		},
		six : {
			title 	: "假如有［舌尖上的德国］，你认为最佳形象大使是？",
			topic 	: [
				"A穆勒－人家第一场就帽子戏法",
				"B小猪－没别的理由，女友身材劲爆啊",
				"C勒夫－你懂得",
				
			],
			answer	: "C",
			fraction: 10
		},
		seven : {
			title 	: "PP租车提倡共享经济，你认为可以请哪个球星来代言？",
			topic 	: [
				"A皮尔洛－虽然离开了，却还是无私奉献的大师",
				"B梅西－总能在关键时刻挺身而出",
				"C中国男足－让大家享受足球的快乐，自己默默的高兴",
				
			],
			answer	: "C",
			fraction: 10
		},
		eight : {
			title 	: "世界杯期间，最招朋友圈羡慕嫉妒恨的方式是？",
			topic 	: [
				"APS一张人在巴西的照片，并且写上一句：里约，太尼玛热了！",
				"B免费租车一天，带上女神随便逛",
				"C赌球中奖50000+，瞬时变高富帅",
				
			],
			answer	: "B",
			fraction: 10
		}

		/*
		nine : {
			title 	: "这几天如何跟领导说请假理由",
			topic 	: [
				"A领导你好，我老婆正处于排卵期",
				"B领导你好，我要去巴西为我朋友贝利加油",
				"C领导你好，最近心情不好压力大需要休息一个月",
				"D领导你好，我最近头晕肚痛手拉伤脚抽筋"
			],
			answer	: "A",
			fraction: 10
		},
		ten : {
			title 	: "和别人聊足球时千万不能说的话是",
			topic 	: [
				"A等到我们中国队比赛的时候，我就请假看",
				"B世界杯不过是边沿球迷的节日罢了",
				"C我童年看到最好的世界杯，是巴乔忧郁地将球踢飞了",
				"D梅西和C罗就是球队的毒瘤，他们让整个体系失衡了"
			],
			answer	: "A",
			fraction: 10
		}
		
		eleven : {
			title 	: "我喜欢的国家队是南斯拉夫、那不勒斯、乌拉圭",
			topic 	: [],
			answer	: "N",
			fraction: 6
		},
		twelve : {
			title 	: "跟别人说你支持上届冠军西班牙不会把你喜欢听《凤凰传奇》的秘密暴露出来",
			topic 	: [],
			answer	: "N",
			fraction: 6
		},
		thirteen : {
			title 	: "爱俄罗斯、乌拉圭、日本这些球队会显得你有在足球方面很有深度",
			topic 	: [],
			answer	: "Y",
			fraction: 6
		},
		fourteen : {
			title 	: "喜欢法荷意要懂得“古尔库夫有齐达内的影子”“范佩西这个转身让我想起了克鲁伊夫",
			topic 	: [],
			answer	: "Y",
			fraction: 6
		},
		fifteen : {
			title 	: "支持中国队需要熟读《人性弱点》、《方与圆》、《心灵鸡汤》、《厚黑学》等名著。",
			topic 	: [],
			answer	: "N",
			fraction: 6
		}
		*/
	},
	fraction = 0,
	t = 0;
(function (window, undefined){	
	var phoneWidth	=  parseInt(window.screen.width),
		phoneScale	= phoneWidth/640,
		ua 			= navigator.userAgent,		
		i 			= 0,
		len 		= loadingImg.length,
		ShenMa	= function (){this.init.apply(this, arguments)};
	if(/Android (\d+\.\d+)/.test(ua)){
		var version = parseFloat(RegExp.$1);
		if(version>2.3){
			document.write('<meta name="viewport" content="width=640, minimum-scale = '+phoneScale+', maximum-scale = '+phoneScale+', target-densitydpi=device-dpi">');
		}
		else{
			document.write('<meta name="viewport" content="width=640, target-densitydpi=device-dpi">');
		}
	}
	else{
		document.write('<meta name="viewport" content="width=640, user-scalable=no, target-densitydpi=device-dpi">');
	}
	ShenMa.prototype = {
		init : function (){
			this.loading();
		},		
		//页面加载
		loading : function (){
			var self = this;
			for(;i<len;i++){
				(function (i){
					var oImg = new Image();
					oImg.onload = function(){
						if(i == len-1){
							$('.load').animate({opacity:0}, 500, 'ease', function (){
								$(this).hide();
								setTimeout(function(){
									self.run();
								},30);
							});
						};
					};
					oImg.src = loadingImg[i];
				})(i);
			}
		},
		run : function (){
			this.header();			
		},
		header : function (num){
			var self = this;
			if(num){
				if(t > 7){$('header .title').addClass('judge')}
				$('header .topic .topiccon span').html(questions[num].title);
				$('header .t').html(++t);
				setTimeout(function (){
					$('header .title').animate({top:0}, 500, 'ease');
				},200);
			}
			$('header .topic').animate({"bottom":'-24px'}, 500, 'ease', function (){				
				$('header .topic .topiccon span').animate({opacity:1}, 500, 'ease', function (){
					if(num){return;}
					self.index();
				});
			});
		},
		index : function (){
			var self = this;
			$('.con .index-b').animate({bottom:'62px'}, 500, 'ease', function (){
				$('.con .go').animate({opacity:1}, 500, 'ease', function (){
					$(this).one('click', function (){
						$('.con').addClass('footer');
						self.one();
					});
				});
			});
		},
		reset : function (num){
			$('section *').attr('style', '');
			this.header(num);
		},
		list : function (num){
			var self = this;
			if(t > 8){
				$('.con .y').animate({width:'143px', height:'144px', top:'250px', left:'110px'}, 500, 'ease');
				$('.con .n').animate({width:'143px', height:'144px', top:'250px', right:'110px'}, 500, 'ease', function (){
					var select = $('.con .select').size();
					for(var i=0;i<select;i++){
						$('.con .select')[i].onclick = function (){
							if($(this).hasClass(questions[num].answer)){
								fraction += questions[num].fraction;
							}
							switch(num){
								case 'eleven':
									self.twelve();
									break;
								case 'twelve':
									self.thirteen();
									break;
								case 'thirteen':
									self.fourteen();
									break;
								case 'fourteen':
									self.fifteen();
									break;
								case 'fifteen':
									self.end();
									break;
							}
						};
					}
				});
				return;
			}
			$('.con .list ul').html(''
				+'<li><span>'+ questions[num].topic[0].charAt(0) +'</span><em><dfn><cite>'+ questions[num].topic[0].substring(1) +'</cite></dfn></em></li>'
				+'<li><span>'+ questions[num].topic[1].charAt(0) +'</span><em><dfn><cite>'+ questions[num].topic[1].substring(1) +'</cite></dfn></em></li>'
				+'<li><span>'+ questions[num].topic[2].charAt(0) +'</span><em><dfn><cite>'+ questions[num].topic[2].substring(1) +'</cite></dfn></em></li>'
				/*+'<li><span>'+ questions[num].topic[3].charAt(0) +'</span><em><dfn><cite>'+ questions[num].topic[3].substring(1) +'</cite></dfn></em></li>'*/
			).parent().animate({left:0}, 500, 'ease', function (){
				$(this).find('li').one('click', function (){
					var answer = $(this).find('span').html();
					if(questions[num].answer == answer){
						fraction += questions[num].fraction;
					}
					if(num == 'seven') {
						if(answer == 'B' || answer == 'C') {
								fraction += questions[num].fraction;
							}
					}
					switch(num){
						case 'one':
							self.two();
							break;
						case 'two':
							self.three();
							break;
						case 'three':
							self.four();
							break;
						case 'four':
							self.five();
							break;
						case 'five':
							self.six();
							break;
						case 'six':
							self.seven();
							break;
						case 'seven':
							self.eight();
							break;
						case 'eight':
							self.end();
							break;
					/*	case 'nine':
							self.ten();
							break;
						case 'ten':
							self.end();
							break;*/
					}					
				});
			})
		},
		one : function (){
			this.reset('one');
			this.list('one');
		},
		two : function (){
			this.reset('two');
			this.list('two');
		},
		three : function (){
			this.reset('three');
			this.list('three');
		},
		four : function (){
			this.reset('four');
			this.list('four');
		},
		five : function (){
			this.reset('five');
			this.list('five');
		},
		six : function (){
			this.reset('six');
			this.list('six');
		},
		seven : function (){
			this.reset('seven');
			this.list('seven');
		},
		eight : function (){
			this.reset('eight');
			this.list('eight');
		},
		nine : function (){
			this.reset('nine');
			this.list('nine');
		},
		ten : function (){
			this.reset('ten');
			this.list('ten');
		},
		eleven : function (){
			this.reset('eleven');
			this.list('eleven');
		},
		twelve : function (){
			this.reset('twelve');
			this.list('twelve');
		},
		thirteen : function (){
			this.reset('thirteen');
			this.list('thirteen');
		},
		fourteen : function (){
			this.reset('fourteen');
			this.list('fourteen');
		},
		fifteen : function (){
			this.reset('fifteen');
			this.list('fifteen');
		},
		end : function (){
			var self = this;
			$('.select').hide()
			$('header').hide();
			$('.con').css({top:0});
			$('.con .shenma, .con .title').css({display:'block'});
			$('.list').hide();
			$('.con').removeClass('footer');
			setTimeout(function (){
				$('.con .title').animate({top:'20%',opacity:1}, 500, 'ease', function (){
					$('.con .shenma').one('click', self.score);
				});
			},30);
		},
		score : function (){
			var timer = null;
			$('.score').css({display:'block'});
			$('.con').css({top:'343px'}).removeClass('footer').find('.title, .shenma').hide();
			timer = setInterval(function (){
				var num = $('.score dfn').html();
				if(parseInt(num) <= 0){
					clearInterval(timer);
					$('.score .scores').addClass('bg');
					$('.score em').hide();
					$('.score dfn').html(fraction+'分');
					$('.logo').css({display:'block'}).animate({opacity:1, top:'10px'}, 1000, 'ease', function (){
						$('.rcode').css({display:'block'}).animate({opacity:1, top:'65px'}, 1000, 'ease');
					});
					$(".code").click(function() {
						$('.score').html('<img src="images/share2.png" />');
						$('.con').hide();
					});
					return;
				}
				$('.score dfn').html(--num);
			},1000);
			
		}
	};
	//监听页面加载
	window.addEventListener('DOMContentLoaded', ready = function() {
		this.removeEventListener('DOMContentLoaded', ready, false);
		document.body.scrollTop = 0;
		new ShenMa();
	})
})(window, undefined)
