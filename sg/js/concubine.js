	//选中图片
	var selectlist = [];
	var select_num = 0;
	var num = 0;
	var star = 1;
	var page = 1;
	var message = true;
	var selected = [];

	//查看是否有hash值
	if (location.hash) {
		selected = location.hash.substr(1).split(',');
	}
	if (selected.length === 5) {
		page = 4;
		g('pagethreeframe').style.display = "block";
		g('reflect1').src = imglist[selected[0]].img;
		g('reflect2').src = imglist[selected[1]].img;
		g('reflect3').src = imglist[selected[2]].img;
		g('reflect4').src = imglist[selected[3]].img;
		g('reflect5').src = imglist[selected[4]].img;
		$("#pagethreeframe").css({marginTop:"0px", opacity:'1'});
	} else {
		//显示第一个页面
		g('pageoneframe').style.display = 'block';

		//初始化显示图片
		g("img1").style.backgroundImage = 'url(' + imglist[num].img + ')';
		num++;
		g("img2").style.backgroundImage = 'url(' + imglist[num].img + ')';

		//图片预加载
		var img1 = new Image();
		var img2 = new Image();
		img1.src = imglist[num+1].img;
		img2.src = imglist[num+2].img;

	    //开始PK 页面二
		g('page1_button').onclick = function (){
			g('pageoneframe').style.display = "none";
			g('pagetwoframe').style.display = "block";
			g('max_frame').style.backgroundColor = '#F9BBBA';
			document.body.style.backgroundColor = '#F9BBBA';
			$("#hint1").animate({marginTop:"120px", opacity:'1'}, 800);
		}
	}


	function g(id) {
        return document.getElementById(id);
    }
	//隐藏弹出提示框
	function message_hidden(){
		star = 1;
		message = false;
		$("#hint1").animate({marginTop:"300px", opacity:'0'}, 800); 
		if(page == 3){
			setTimeout(hinthidden,100);
		}else{
			setTimeout(hinthidden,1000);
		}
	}
	//显示PK结果页面 设置显示图片
	function hinthidden(){
		g('hint1').style.display = "none";
		if(page == 3){
			//hash记录选项
			var ids = [];
			for (var i = 0; i < selectlist.length; i++) {
				ids.push(selectlist[i].id);
			}
			location.hash = ids.join(',');
			page = 4;
			g('pagetwoframe').style.display = "none";
			g('pagethreeframe').style.display = "block";
			g('reflect1').src = selectlist[0].img;
			g('reflect2').src = selectlist[1].img;
			g('reflect3').src = selectlist[2].img;
			g('reflect4').src = selectlist[3].img;
			g('reflect5').src = selectlist[4].img;
			$("#pagethreeframe").animate({marginTop:"0px", opacity:'1'}, 800);
		}
	}
	var name = "";
	var senum1 = 0;
	var senum2 = 1;
	//PK页面 选择
	function ensure(id){
		if(star != 1){
			return;	
		}
		if(message){
			message_hidden();
		}
		star = 0;
		name = id;
		if(id == 'img1' || id == 'img3'){
			g('xin1').style.top = "114px";
			selectlist.push(imglist[senum1]);
		}else{
			g('xin1').style.top = "348px";
			selectlist.push(imglist[senum2]);
		}

		//点击回调
		result(selectlist[select_num++]);

		g('xin1').style.display = 'block';
		setTimeout(function () {
			$('#xin1').addClass('xin-zoomout');
		},0);

		setTimeout(editimg, 800);
	}

	var snumber = 1;
	//设置弹出框内容   设置即将显示的图片
	function editimg(){
		$('#xin1').hide().removeClass('xin-zoomout');

		if(num == imglist.length-1 && snumber == 1){
			star = 0;
			message = true;
			g('hint1').style.display = "block";
			g('hintsub').innerHTML = "殿下，看了这么多妹子是不是有点疲了，做个眼保健操稍事休息，再进行第二轮选妃吧";
			g('suresub').innerHTML = "你够了，赶紧开始！！";
				setTimeout(function () {
					$("#hint1").animate({marginTop:"120px", opacity:'1'}, 800);	
				}, 500);
			imglist = selectlist;
			selectlist = [];
			snumber = 2;
			num = -1;
			select_num = 0;
			
		}
		if(num == imglist.length-1 && snumber == 2){
			star = 0;
			message = true;
			g('hint1').style.display = "block";
			g('hintsub').innerHTML = "殿下果然眼光独到，赶紧查看选妃结果，分享给你的好友吧";
			g('suresub').innerHTML = "查看我的选妃结果";
			page = 3;
			setTimeout(function () {
				$("#hint1").animate({marginTop:"120px", opacity:'1'}, 800);	
			}, 500);
		}else{
			if(name == 'img1' || name == 'img2'){
				g('img1').style.zIndex = 5;
				g('img2').style.zIndex = 5;
				num++;
				senum1 = num;
				g("img3").style.backgroundImage = 'url(' + imglist[num].img + ')';
				num++;
				senum2 = num;
				g("img4").style.backgroundImage = 'url(' + imglist[num].img + ')';
				g('img3').style.display = 'block';
				g('img4').style.display = 'block';
				setTimeout(imgchg,0);
			}else{
				g('img3').style.zIndex = 5;
				g('img4').style.zIndex = 5;
				num++;
				senum1 = num;
				g("img1").style.backgroundImage = 'url(' + imglist[num].img + ')';
				num++;
				senum2 = num;
				g("img2").style.backgroundImage = 'url(' + imglist[num].img + ')';
				g('img1').style.display = 'block';
				g('img2').style.display = 'block';
				setTimeout(imgchg1,0);
			}

			//图片预加载
			if (num+2 < imglist.length) {
				img1.src = imglist[num+1].img;
				img2.src = imglist[num+2].img;
			}
			setTimeout(chg,800); 
		}
	}
	function imgchg(){
		g("img1").style.zIndex = 4;
		g("img2").style.zIndex = 4;
		g("img3").style.zIndex = 6;
		g("img4").style.zIndex = 6;
		setTimeout(
			function (){
				$("#img3").removeClass("front_top");
				$("#img4").removeClass("front_bottom");
				$("#img3").addClass("rear_top");
				$("#img4").addClass("rear_bottom");
			},
		20); 
	}
	function imgchg1(){
		g("img3").style.zIndex = 0;
		g("img4").style.zIndex = 0;
		g("img1").style.zIndex = 6;
		g("img2").style.zIndex = 6;
		setTimeout(
			function (){
				$("#img1").removeClass("front_top");
				$("#img2").removeClass("front_bottom");
				$("#img1").addClass("rear_top");
				$("#img2").addClass("rear_bottom");
			},
			20); 
	}
	//隐藏当前轮图片
	function chg(){
		if(name == 'img3' || name == 'img4'){
			g('img3').style.display = 'none';
			g('img4').style.display = 'none';
			$("#img3").removeClass("rear_top");
			$("#img4").removeClass("rear_bottom");
			$("#img3").addClass("front_top");
			$("#img4").addClass("front_bottom");
		}else{
			g('img1').style.display = 'none';
			g('img2').style.display = 'none';
			$("#img1").removeClass("rear_top");
			$("#img2").removeClass("rear_bottom");
			$("#img1").addClass("front_top");
			$("#img2").addClass("front_bottom");
		}
		star = 1;
		
	}
	function biging(){
		var imgW = g('xin').width || g('xin').style.width || g('xin').offsetWidth;
	    if(imgW <= 50){
	    	imgW=imgW+10;
	    }
	    g('xin').style.width=imgW+'px';
	    setTimeout(biging,50)
	}
	//显示页面4
	function showpage4(){
		g('pagethreeframe').style.display = "none";
		g('pagefourframe').style.display = "block";
		$("#pagefourframe").animate({marginTop:"0px", opacity:'1'}, 800);
	}
	//显示页面5
	function showpage5(ranking_list){
		var rankingStr = "";
		for(var i=0;i<ranking_list.length;i++){
            var j = i+1;
			rankingStr += '<div class="page5"><div class="rankingimg" style="background-image:url('
                    	+ ranking_list[i].img
			           	+ ')"></div><span class="order">'
						+ j 
						+ '</span><span class="name">'
						+ ranking_list[i].name
						+ '</span><span class="vote">'
						+ ranking_list[i].vote
						+ '</span><div class="rankingxin"></div></div>';
		}
		
		$("#pagefiveframe").find('.frame').append(rankingStr);
		g('pagefourframe').style.display = "none";
		g('pagefiveframe').style.display = "block";
		$("#pagefiveframe").animate({marginTop:"0px", opacity:'1'}, 800);
	}
    //排名
    function rank(){
        $.ajax({
            url:'result.php',
            type:'post',
            dataType:'json',
            async:false,
            success:function(result){
                showpage5(result);
            }
        });
    }

	//返回页面4
	function backpage4(){
		g('pagefourframe').style.display = "block";
		g('pagefiveframe').style.display = "none";
	}

function setCookie(name,value) {
    var exp = new Date(); 
    exp.setTime(exp.getTime() + 10*365*24*60*60*1000); 
    document.cookie = name + "="+ encodeURIComponent(value) + ";expires=" + exp.toGMTString(); 
} 
	
