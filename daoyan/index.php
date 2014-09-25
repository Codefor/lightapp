<?php
$redis = new Redis();
$redis->pconnect('127.0.0.1');
$hkey = 'daoyan_vote';
$vote_stats = $redis->hGetAll($hkey);

$key = 'daoyan_comment';
$raw_comments = $redis->lRange($key,0,-1);
$comments = array();
foreach($raw_comments as $comment){
    $item = json_decode($comment,TRUE);
    $item['t'] = time_delta($item['t']);

    $raw_comments_reply = $redis->lRange("daoyan_comment_{$item['id']}",0,-1);
    $subitems = array();
    foreach($raw_comments_reply as $reply){
        $reply = json_decode($reply,TRUE);
        $reply['t'] = time_delta($reply['t']);
        $subitems[] = $reply;
    }
    $item['subitems'] = $subitems;
    $comments[] = $item;
}
function time_delta($passed){
    $delta = time() - (int)$passed;
    if($delta > 86400){
        return floor($delta / 86400)."天前";
    }else if($delta > 3600){
        return floor($delta / 3600)."小时前";
    }else if($delta > 60){
        return floor($delta / 60)."分钟前";
    }else{
        return $delta."秒前";
    }   
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport">
<meta content="yes" name="apple-mobile-web-app-capable">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta content="telephone=no" name="format-detection">
<meta content="email=no" name="format-detection">
<meta content="yuebin" name="author">
<title>全民导演</title>
<style type="text/css">
	/* 浏览器重置样式 [[*/
	body,p,ul,ol,li,dl,dt,dd,h1,h2,h3,h4,h5,h6,form,fieldset,legend,input,select,textarea,button,th,td,menu{margin:0;padding:0;}
	article,aside,dialog,figure,footer,header,hgroup,nav,section{display:block;}
	h1,h2,h3,h4,h5,h6,input,textarea,select,button,label{font-size:100%;font-weight:100;}
	input,textarea,select,button,label{vertical-align:middle;}
	img,fieldset,input[type="submit"]{border:none;}
	input{outline:none;background:transparent;vertical-align:top;}
	input::-ms-clear{display:none;}
	table{border-collapse:collapse;border-spacing:0;}        
	button{cursor:pointer;border:none;}
	textarea{word-wrap:break-word;resize:none;-webkit-box-shadow:none;}
	input,textarea,select{-webkit-appearance:none;outline:none;}
	input:-moz-placeholder{color:#C4C4C4;}
	::-webkit-input-placeholder{color:#C4C4C4;}
	select::-ms-expand{display:none;}
	::-ms-check{display:none;}
	body{font-family:"Microsoft YaHei";-webkit-user-select:none;-khtml-user-select:none;-ms-user-select:none;user-select:none;-webkit-text-size-adjust:none;-webkit-tap-highlight-color:rgba(0,0,0,0.4);overflow:hidden;font-size:1rem;background:#1C1F26;}
	a{text-decoration:none;color:#333;-webkit-touch-callout:none;}
	a:hover{background-color:;}
	a,button,input{-webkit-touch-callout:none;}
	/* 浏览器重置样式 ]]*/
	
	body{background-color:#000;color: #a6a6a6;}
	header{position:relative;width: 100%;height: 0;padding-bottom: 44%;background-color: #4e617a;}
	header .home{position:absolute;top:36.3%;left:16.7%;width: 22%;height:0;padding-bottom: 22.9%;border:none;background: url(img/home-icon.jpg) no-repeat;background-size: 200% 100%;border-radius: 50%;}
	header .video{position:absolute;top:36.0%;right:16.3%;width: 22.6%;height:0;padding-bottom: 23.3%;border:none;background: url(img/video-icon.jpg) no-repeat 100% 0;background-size: 200% 100%;border-radius: 50%;}
	header .cur-icon{position: absolute;top:90.1%;left:16.8%;width: 24.9%;height: 0;padding-bottom: 4.5%;background: url(img/tab-cur.png) no-repeat;background-size: 100% 100%;}
	.video-tab .home{background-position: 100% 0;}
	.video-tab .video{background-position: 0 0;}
	.video-tab .cur-icon{left: 61%;}
	.video-content{display: none;}
	.full-story{padding:7.9% 5%;}
	.full-story .story-img{width: 100%;padding-bottom: 55.6%;background: url(img/home-img.jpg);background-size: 100% 100%;}
	.full-story h2{margin-top:10.6%;font-size: 20px;color: #8497b0;text-align: center;}
	.full-story h3{margin-top:4%;font-size: 24px;color: #fff;text-align: center;}
	.full-story p{margin-top:2%;font-size: 16px;color: #a6a6a6;line-height: 1.5;}
	.full-story p a{float: right;color: #d9d9d9;text-decoration: underline;font-family: Arial;}
	.full-story p:after{visibility: hidden;display: block;font-size: 0;content: " ";clear: both;height: 0;}
	.h-line{text-align: center;font-size: 20px;color: #8497b0;}
	.h-line span{float:left;width: 22.6%;height: 0;margin-top:10px;border-bottom: 2px solid #767171;}
	.h-line .r-line{float: right;}
	.story-list{padding: 0 4.8%;padding-bottom:10px;list-style: none;}
	.story-list li{position:relative;margin-top: 10%;padding: 5px;padding-bottom:20px;border: 2px solid #bfbfbf;border-radius: 1px;}
	.story-list li .support{height:30px;color: #fff;font-size: 16px;position: absolute;bottom:-17px;right: 10px;}
	.support span {float:right;width:120px;height:28px;line-height:28px;text-align:center;border:1px solid #bfbfbf;background-color: #000;}
	.support input {float:right;width:40px;height:28px;border:1px solid #bfbfbf;border-radius:4px;background-color: #44546a;color: #fff;box-sizing: content-box;}
	.story-list h6{color: #d0cece;}
	.story-list p{color: #a6a6a6;font-size: 15px;}
	.story-list p a{color: #d9d9d9;text-decoration: underline;font-family: Arial;}
	.reply{margin-top:10px;padding: 5%;}
	textarea{box-sizing:border-box;-webkit-box-sizing:border-box;width: 100%;resize: none;border: 2px solid #fff;box-shadow: inset 1px 1px 8px #8d8d8d, inset -1px -1px 8px #8d8d8d;padding: 10px;font-size: 16px;border-radius: 0;}
	.reply p{overflow: hidden;}
	.reply p .reply-button{float: right;width: 104px;height: 25px;margin-top:15px;background: url(img/comment-bg.png) no-repeat;background-size: 100% 100%;border: none;border-radius: 0;}
	.reply p .input-name{float: right;width: 60px;height: 23px;margin-top:15px;padding-left:2px;background-color: #fff;border: 1px solid #fff;box-shadow: inset 1px 1px 3px #d2d2d2, inset -1px -1px 3px #d2d2d2;border-radius: 0;}
	.input-name::-webkit-input-placeholder {color:#000;}
	.reply-list{margin-top:25px;border-top: 1px solid #595959;list-style: none;-webkit-placeholder-color: #000;}
	.reply-list li{padding: 0 2px;border-bottom: 1px solid #595959;overflow: hidden;}
	.reply-list h6{margin-top:20px;color: #fff;font-size: 18px;font-family: Arial;}
	.reply-list p{margin-top:3px;color: #d9d9d9;font-size: 15px;font-family: \5b8b\4f53;line-height: 1.2;}
	.reply-list .list-footer{margin-top: 15px;margin-bottom:20px;color: #8497b0;font-size: 15px;font-family: \5b8b\4f53;}
	.reply-list .list-footer a{float: right;color: #5b9bd5;}

	.video-story{padding:7.9% 5%;}
	.video-story .video-img{width: 100%;padding-bottom: 56.3%;background: url(img/video-img.jpg);background-size: 100% 100%;}
	.video-story p{margin-top:15px;font-size: 14px;color: #bfbfbf;}
	.video-content .h-line{font-size: 35px;}
	.video-content .h-line span{width: 20%;margin-top: 20px;}
	.video-change{padding: 5%;}
	.video-change h5{color: #bfbfbf;text-align: center;font-size: 16px;line-height: 1.5;}
	.video-change h6{color: #f8cbad;text-align: center;font-size: 15px;line-height: 1.5;}
	.video-change .director{position:relative;margin-top:30px;padding-bottom: 56.5%;background: url(img/video-change.jpg) no-repeat;
		background-size: 100% 100%;}
	.video-change .director input{position:absolute;font-size: 30px;color: #d0cece;width: 234px;height: 46px;
		border:2px solid #f2f2f2;border-radius: 6px;box-shadow: 0 -10px 10px #7b7f85;background-color: #000;
		top: 61.8%;left: 50%;margin-left: -117px;font-family: Microsoft YaHei;}
	.video-change p{margin:10px 0 20px;font-size: 14px;color: #bfbfbf;}
	.video-change p u{color: #404040;}
	.video-list{list-style: none;padding: 8% 5%;}
	.video-list h6{font-size: 20px;color: #d9d9d9;}
	.video-list .video-list-img{position: relative;height: 0;margin-top:10px;padding-bottom: 56.7%;}
	.video-list .video-list-img img{position: absolute;width: 100%;height: 100%;}
	.video-list p{overflow: hidden;font-size: 14px;margin: 10px 0;color: #fff;}
	.video-list .favour{float:right;margin-right:10px;color: #fff;font-size: 16px;}
	.video-list .favour span{display: inline-block;width: 29.3px;height: 26.6px;margin-left:3px;background: url(img/favour-icon.png) no-repeat;background-size: 100% 100%;vertical-align: -3px;}
	.video-list li{border-bottom: 1px solid #595959;}

	.director-modal,.reply-modal{display:none;position: absolute;top: 100px;left:50%;width: 300px;margin-left: -152px;background-color: #000;border: 2px solid #8497b0;}
	.director-modal h4,.reply-modal h4{width:300px;height: 36px;border: 2px solid #afabab;margin: -2px 0 0 -2px;text-align: center;line-height: 36px;background-color: #333f50;color: #fff;font-size: 16px;}
	.director-modal .change-actor{position:relative;margin: 35px 15px 0;height:124px;border: 1px dashed #767171;}
	.director-modal .change-actor img{position:absolute;top:20px;left:40px;width: 92px; height: 83px;}
	.director-modal .change-actor input{position:absolute;top:45px;right:16px;width: 92px; height: 20px;font-size: 14px;color: #fff;border: 1px solid #d9d9d9;text-align: center;background-color: #8497b0;border-radius: 4px;}
	.director-modal .change-actor p{position:absolute;top:75px;right:16px;font-size: 12px;color: #8497b0;}
	.director-modal .edit-words{margin: 15px 15px 0;padding-bottom:10px;border: 1px dashed #767171;}
	.edit-words h6{position:relative;top:-10px;font-size: 16px;color: #fff;text-align: center;}
	.edit-words p{margin: 0 0 5px 10px;font-size: 14px;line-height: 1.5;}
	.edit-words p label{display: inline-block;width: 60px;}
	.edit-words p input{width: 180px;height: 20px;background-color: #f2f2f2;border: 1px solid #fff;box-shadow: inset 1px 1px 3px #d2d2d2, inset -1px -1px 3px #d2d2d2;border-radius: 0;}
	.edit-words p .w60{width: 60px;}
	.submit{margin:20px 0;text-align: center;}
	.submit input{border: 1px solid #d9d9d9; border-radius: 4px;background-color: #70ad47;font-size: 20px;padding: 5px 40px;color: #fff;font-family: Microsoft YaHei;}
    .reply-reply-list{display: none;}
	#reply-reply-list-hidden{display: block;}
	.reply-reply-list li{
		margin-left: 15px;
		padding-bottom: 10px;
		border-bottom: none;
		border-top: 1px solid #595959;
	}
	.reply-reply-list li .reply-time{float:right;margin-top:3px;color: #8497b0;font-size: 15px;font-family: \5b8b\4f53;}
	.reply-reply-list li h6{margin-top: 10px;}
	.reply-list-toggle{margin-left: 20px;}
</style>
</head>
<body>
	<header id="header">
		<input type="button" class="home" />
		<input type="button" class="video" style="display:none"/>
		<span class="cur-icon"></span>
	</header>
	<section class="home-content">
		<section class="full-story">
			<div class="story-img"></div>
			<h2>现实版“宋云川”完整故事：</h2>
			<h3>从化工到咨询</h3>
			<p>现在是2013年12月底，漫长而扰人的求职季终于结束了。回首看看这次又号称“史上最艰难求职季”和尤为惨淡的咨询行业，不免感慨万分。在这段时间里，我见过了太多的面试官…</p>
			<p><a href="http://mp.weixin.qq.com/s?__biz=MzA5NTM1NTUyNw==&mid=200771715&idx=1&sn=ebae93dd1e7361df3e5b23b7c29ab211#rd">read more&gt;&gt;</a></p>
		</section>
		<section class="h-line">
			<span class="l-line"></span>
			<span class="r-line"></span>
			精彩语录投票
		</section>
		<ul class="story-list">
			<li>
				<div class="support">
					<input type="button" class="support-button" data-count="<?php echo isset($vote_stats['ending_1'])?(int)$vote_stats['ending_1']:0?>" data-id="1" value="+1" />
					<span><?php echo isset($vote_stats['ending_1'])?(int)$vote_stats['ending_1']:0?>人like</span>
				</div>
				<h6>精彩语录一</h6>
				<p>很多人的性格，或者说“骨子里的那种品格”，其实早在成年以前已经定型了。你的人生轨迹并不一定完全是受环境的摆弄，更可能是你自己的性格决定的。性格决定命运，甚至关乎成败。</p>
			</li>
			<li>
				<div class="support">
					<input type="button" class="support-button" data-count="<?php echo isset($vote_stats['ending_2'])?(int)$vote_stats['ending_2']:0?>" data-id="2" value="+1" />
					<span><?php echo isset($vote_stats['ending_2'])?(int)$vote_stats['ending_2']:0?>人like</span>
				</div>
				<h6>精彩语录二</h6>
				<p>人总要认清自己的能力、兴趣、天赋到底在哪，有的事情是你天生就想做的，有的事情却不是你想做就能做好的。</p>
			</li>
			<li>
				<div class="support">
					<input type="button" class="support-button" data-count="<?php echo isset($vote_stats['ending_3'])?(int)$vote_stats['ending_3']:0?>" data-id="3" value="+1" />
					<span><?php echo isset($vote_stats['ending_3'])?(int)$vote_stats['ending_3']:0?>人like</span>
				</div>
				<h6>精彩语录三</h6>
				<p>我不相信简单的follow前人脚步的人会有成就，也不相信能轻易被别人convince的人会有多大出息。无论我讲什么，或者谁讲什么，永远独立思考才是最重要的。</p>
			</li>
		</ul>
		<section class="reply">
			<textarea name="reply" id="reply-content" rows="4" placeholder="有什么感想，你也来说说吧"></textarea>
			<p>
				<input class="reply-button" type="button" />
				<input type="text" name="name" class="input-name" id="reply-name" style="display:none;" placeholder="匿名" />
			</p>
			<ul class="reply-list" id="reply-list-hidden" style="position:absolute;top:-9999px;left:-9999px;">
				<li>
					<ul class="reply-reply-list" id="reply-reply-list-hidden"></ul>
				</li>
			</ul>
			<ul class="reply-list" id="reply-list">
                <?php foreach($comments as $comment){?>
				<li>
					<h6>@<?php echo $comment['name']?>:</h6>
					<p><?php echo $comment['content']?></p>
					<div class="list-footer">
					    <?php echo $comment['t']?>	
                        <a class="reply-list-toggle">展开</a>
                        <a class="comment-reply" data-id="<?php echo $comment['id']?>" data-name="<? echo $comment['name']?>">回复</a>
					</div>
                    <ul class="reply-reply-list">
                        <?php foreach($comment['subitems'] as $reply){?>
						<li>
							<h6><span class="replier">@<?php echo $reply['name']?>:</span><span class="reply-time"><?php echo $reply['t']?></span></h6>
							<p><?php echo $reply['content']?></p>
						</li>
                        <?php } ?>
					</ul>
				</li>
                <?php } ?>
            </ul>
		</section>
        <section class="reply-modal" id="reply-modal">
			<h4>回复<span>Asa</span>:</h4>
			<textarea name="reply" id="reply-comment" rows="4" placeholder="有什么想说的吧"></textarea>
			<div class="submit">
				<input type="button" id="reply-submit" data-id="" value="提交回复" />
			</div>
		</section>
	</section>
	<section class="video-content">
		<section class="video-story">
			<div class="video-img"></div>
			<p>其实人生不是一场马拉松，并没有一个既定的终点，而是因为不同而精彩，你之所以一直被比较，一直被推着走，不是因为你跑得太慢，而是因为你跑在一条有太多人的路上</p>
		</section>
		<section class="h-line">
			<span class="l-line"></span>
			<span class="r-line"></span>
			全民当导演
		</section>
		<section class="video-change">
			<h5>大牌演员随你挑，当一回导演，试试？</h5>
			<h6>点击下方按钮“我要当导演”，选择你的演员并编辑台词，定制你的微电影</h6>
			<div class="director">
				<input type="button" id="director" value="我要当导演" />
			</div>
			<p>其实<u>人生</u>不是一场马拉松，并没有一个既定的终点，而是因为不同而精彩，你之所以<u>一直被比较，一直被推着走</u>，不是因为<u>你跑得太慢</u>，而是因为<u>你跑在一条有太多人的路上</u></p>
		</section>
		<section class="h-line">
			<span class="l-line"></span>
			<span class="r-line"></span>
			热门 作品
		</section>
		<ul class="video-list">
			<li>
				<h6>@Asa导演的作品：</h6>
				<div class="video-list-img">
					<img src="img/video-hot.jpg" />
				</div>
				<p>其实婚姻不是一场马拉松，并没有一个既定的终点，而是因为不同而精彩，你之所以坚持下去，不是因为你责任感有多强，而是因为你跑在一条不太精彩的路上</p>
				<p><a class="favour">2,906<span></span></a></p>
			</li>
		</ul>
		<section class="h-line">
			<span class="l-line"></span>
			<span class="r-line"></span>
			最新 作品
		</section>

		<section class="director-modal" id="director-modal">
			<h4>导演工作室</h4>
			<div class="change-actor">
				<img src="img/actor.jpg" alt="" />
				<input type="button" value="更换演员" />
				<p>大牌演员随你挑!</p>
			</div>
			<div class="edit-words">
				<h6>编辑台词</h6>
				<p><label>其实</label><input type="text" class="w60" name="" id="edit-words-1" placeholder="人生" /></p>
				<p>不是一场马拉松，并没有一个既定的终点，而是因为不同而精彩，</p>
				<p><label>你之所以</label><input type="text" name="" id="edit-words-2" placeholder="一直被比较，一直被推着走，" /></p>
				<p><label>不是因为</label><input type="text" name="" id="edit-words-3" placeholder="你跑得太慢" /></p>
				<p><label>而是因为</label><input type="text" name="" id="edit-words-4" placeholder="你跑在一条有太多人的路上" /></p>
			</div>
			<div class="submit">
				<input type="button" id="director-submit" value="提交作品" />
			</div>
		</section>
	</section>
	<script src="js/zepto.1.1.4.min.js"></script>
	<script>
		var $header = $('#header');
		var $director = $('#director');
		var $directorModal = $('#director-modal');

		$header.on('tap', 'input', function(e) {
			if ($(this).hasClass('video')) {
				$header.addClass('video-tab');
				$('.video-content').show().prev().hide();
			} else {
				$header.removeClass('video-tab');
				$('.home-content').show().next().hide();
			}
			return false;
		});

		$director.on('tap', function(e) {
			$directorModal.css({top:$(window).scrollTop()+20}).show();
		});

		// 导演工作室台词编辑提交
		$('#director-submit').on('tap', function(e) {
			if ($(this).prop('disabled')) {
				return false;
			}
			$(this).prop('disabled', true);

			var text1 = $.trim($('#edit-words-1').val());
			var text2 = $.trim($('#edit-words-2').val());
			var text3 = $.trim($('#edit-words-3').val());
			var text4 = $.trim($('#edit-words-4').val());
			if (!text1 || !text2 || !text3 || !text4) {
				alert('请完整填写台词再提交')
				$(e.target).prop('disabled', false);
				return false;
			}
			$.ajax({
				url: 'dialog.php',
				type: 'post',
				data: {text1:text1,text2:text2,text3:text3,text4:text4},
				success: function(result) {
					// 可添加result判断
					$('.edit-words input').val('');
					$(e.target).prop('disabled', false);
					$directorModal.hide();
				},
				error: function(msg) {
					alert(msg.responseText);
					$(e.target).prop('disabled', false);
				}
			})			
		});

		// 最佳结局支持
		$(document).on('tap', '.support-button', function(e) {
			if ($(this).prop('disabled') || getCookie('support-' + $(this).attr('data-id'))) {
				return false;
			}
			$(this).prop('disabled', true);
			$.ajax({
				url: 'vote.php',
				type: 'post',
				data: {id: $(this).attr('data-id')},
				success: function(result) {
					// 可添加result判断
					var _count = parseInt($(e.target).attr('data-count'))+1;
					$(e.target).attr('data-count', _count).prop('disabled', true).next('span').text(_count+'人like');
                    setCookie({
						name: 'support-'+$(e.target).attr('data-id'),
						value: 'true'
					});
					$(e.target).prop('disabled', false);
				},
				error: function(msg) {
					alert(msg.responseText);
					$(e.target).prop('disabled', false);
				}
			})
		});

		// 发表评论
		$(document).on('tap', '.reply-button', function(e) {
			if ($(this).prop('disabled')) {
				return false;
			}
			$(this).prop('disabled', true);

			var _content = $.trim($('#reply-content').val());
			var _name = $.trim($('#reply-name').val()) || '匿名';
			if (_content) {
				$.ajax({
					url: 'comment.php',
					type: 'post',
					data: {name:_name, content:_content},
					success: function(result) {
						$('#reply-content').val('');
						// 可添加result判断
						var _html = '<li>'
									+	'<h6>@'+_name+'</h6>'
									+	'<p>'+_content+'</p>'
									+	'<div class="list-footer">0秒前<a class="reply-list-toggle">展开</a><a class="comment-reply" data-id="'+ result.id +'" data-name="' + _name + '">回复</a></div>'
                                    +   '<ul class="reply-reply-list">'
					                +   '</ul>'
									+'</li>';
						var _$li = $('#reply-list-hidden').prepend(_html).find('li').eq(0);
						var _height = _$li.height();
						$('#reply-list').prepend(_$li.height(0));
						_$li.animate({height: _height});

						if (_name != '匿名' && !getCookie('commentName')) {
							setCookie({
								name: 'commentName',
								value: _name
							});
							$('#reply-name').hide();
						}
						$(e.target).prop('disabled', false);
					},
					error: function(msg) {
                        alert(msg.responseText);
						$(e.target).prop('disabled', false);
					}
				})
			} else {
				alert('评论内容不能为空');
				$(e.target).prop('disabled', false);
			}
		});

		var $replyModal = $('#reply-modal');
		var $targetComment = null;
		// 回复
		$(document).on('tap', '.comment-reply', function(e) {
			var replyTo = $(e.target).attr('data-name');
			$replyModal.find('h4 span').text(replyTo);
			$replyModal.find('textarea').val('').next()
				.find('#reply-submit').attr('data-id', $(e.target).attr('data-id'));

			$replyModal.css({top:$(window).scrollTop()+50}).show();
			$targetComment = $(e.target).closest('li');
		});

		// 回复提交
		$replyModal.on('tap', '#reply-submit', function(e) {
			if ($(this).prop('disabled')) {
				return false;
			}
			$(this).prop('disabled', true);

			var _content = $.trim($('#reply-comment').val());
			var _name = getCookie('commentName') || '匿名';
			if (_content) {
				$.ajax({
					url: 'comment-reply.php',
					type: 'post',
					data: {id: $(this).attr('data-id'), name:_name, content:_content},
					success: function(result) {
						// 可添加result判断
						var _html = '<li>'
									+	'<h6>@'+_name+'<span class="reply-time">0秒前</span></h6>'
									+	'<p>'+_content+'</p>'
									+'</li>';
						var _$li = $('#reply-reply-list-hidden').prepend(_html).find('li').eq(0);
						var _height = _$li.height();
						$targetComment.find('.reply-reply-list').show().prepend(_$li.height(0));
						_$li.animate({height: _height});
                        
                        $targetComment.find('.reply-list-toggle').text('收起');
						$replyModal.hide();
						$(e.target).prop('disabled', false);
					},
					error: function(msg) {
						alert(msg.responseText);
						$(e.target).prop('disabled', false);
					}
				})
			} else {
				alert('回复内容不能为空');
				$(e.target).prop('disabled', false);
			}
		})

		$(document).on('tap', function (e) {
			if($(e.target).closest('#reply-modal, #director-modal,#director,.comment-reply').length == 0) {
				$('#reply-modal, #director-modal').hide().find('textarea').val('');
			}
		})

		/**
		 * 设置cookie
		 * @param {[string]} name         
		 * @param {[string]} value        
		 * @param {[string]} domain       
		 * @param {[string]} path         默认为 ./
		 * @param {[number]} expiresHours 默认为 10年
		 */
		function setCookie(cookieObj) {
		    var exp = new Date();
		    var expiresHours = 10*365*24
		    if (typeof cookieObj.expiresHours === 'number') {
		    	expiresHours = cookieObj.expiresHours;
		    }
		    exp.setTime(exp.getTime() + expiresHours*60*60*1000); 
		    var cookieStr = cookieObj.name + '='+ encodeURIComponent(cookieObj.value) 
		    				// + ';path=' + cookieObj.path || './'
		    				+ ';expires=' + exp.toGMTString(); 
			if (cookieObj.domain && typeof cookieObj.domain === 'string') {
				cookieStr += ';domain=' + cookieObj.domain;
			}
			console.log(cookieStr);
			document.cookie = cookieStr;
		} 

		/**
		 * 获取cookie
		 * @param  {[string]} name 
		 * @return {[string]}      
		 */
		function getCookie(name) {
		    var cookieMatch = document.cookie.match(new RegExp(name+'=([^;]+)'));
			if (cookieMatch) {
				return decodeURIComponent(cookieMatch[1]);
			} else {
				return null;
			}
		}

		$(function(){
			var commentName = getCookie('commentName');
			if (!commentName) {
				$('#reply-name').show();
			} else {
				$('#reply-name').val(commentName);
			}
		});
        /**
            * 回复列表开关
        */
        $(document).on('tap', '.reply-list-toggle', function(e) {
            if($(this).text() == '展开') {
                $(this).text('收起').closest('li').find('.reply-reply-list').show();
            } else {
                $(this).text('展开').closest('li').find('.reply-reply-list').hide();
            }
        });
	</script>
<script>
var dataForWeixin={
    appId:  "",
    img:    "http://demo.timepearls.com/daoyan/img/daoyan-logo.jpg",
    url:    "http://demo.timepearls.com/daoyan/",
    title:  "从化工到咨询，寻找内心真实的自己",
    desc:   "人总要认清自己的能力、兴趣、天赋到底在哪，有的事情是你天生就想做的，有的事情却不是你想做就能做好的……",
    fakeid: ""
};
(function(){
    var onBridgeReady=function(){
        // 发送给好友; 
        WeixinJSBridge.on('menu:share:appmessage', function(argv){
            WeixinJSBridge.invoke('sendAppMessage',{
                "appid":        dataForWeixin.appId,
                "img_url":      dataForWeixin.img,
                "img_width":    "120",
                "img_height":   "120",
                "link":             dataForWeixin.url,
                "desc":             dataForWeixin.desc,
                "title":            dataForWeixin.title
            }, function(res){});
        });
        // 分享到朋友圈;
        WeixinJSBridge.on('menu:share:timeline', function(argv){
            WeixinJSBridge.invoke('shareTimeline',{
            "img_url":dataForWeixin.img,
            "img_width":"120",
            "img_height":"120",
            "link":dataForWeixin.url,
            "desc":dataForWeixin.desc,
            "title":dataForWeixin.title
            }, function(res){});
        });
        // 分享到微博;
        WeixinJSBridge.on('menu:share:weibo', function(argv){
            WeixinJSBridge.invoke('shareWeibo',{
            "content":dataForWeixin.title+' '+dataForWeixin.url,
            "url":dataForWeixin.url
            }, function(res){});
        });
    };
    if(document.addEventListener){
        document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
    }else if(document.attachEvent){
        document.attachEvent('WeixinJSBridgeReady'   , onBridgeReady);
        document.attachEvent('onWeixinJSBridgeReady' , onBridgeReady);
    }
})();
</script>
</body>
</html>
