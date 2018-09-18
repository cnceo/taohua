<?php $this->display('inc_skin_lr.php'); ?>
<body>
	<div id="body">
		<header class="header">
	<!-- <a href="/index.php"><img class="logo" src="/images/nsc_m/index/logo.png?v=1.16.11.16"></a> -->
	<a class="m-return" onclick="checkbackspace();">返回</a>
	<span class="btn-slide-bar"></span>
	<div class="wercom">欢迎您,<b class="username"> <?=$this->user['username']?></b>
	<a href="/?controller=user&amp;action=main&amp;tag=messages" class="ui_message">
          <!--      <i></i> -->
               <i class="ui_msgnum" style="display:none">0</i>
           </a> </div>
	<!-- <h1 class="page-title">header</h1> -->
</header>
<!--侧导航 -->
		<section class="slide-bar" style="display: none;">
			<ul class="tree">
				<li class="tree_list"><h3 class="one_nav_list home"><a href="/?index.php">首页</a></h3>
					<div class="m_nav_line"></div>
				</li>
				<li class="tree_list">
	                <h3 class="one_nav_list uc_icon_r"><a href="/index.php/safe/Personal">用户中心</a></h3>
	                <div class="m_nav_line"></div>
				</li>
				<li class="tree_box tree_list">
					<h3 class="one_nav_list  game_icon tree_box">彩票游戏<i class="lnstruction-top"></i></h3>
					<ul class="tree_one" style="display:block">
						<li class="lotter_list_game">
						<div class="m_nav_line"></div>
							<dl>
								<dt>高频彩</dt>
								<dd>
									<ul class="lot_list">
										<li><a href="/zst/?typeid=1">重庆时时彩<i>H</i></a> </li>
<!--										<li><a href="/index.php/index/game/1/2/12">重庆时时彩<i>H</i></a> </li>-->
						<!--				<li><a href="/index.php/index/game/12/2/12">新疆时时彩</a> </li>
										<li><a href="/index.php/index/game/60/2/12">天津时时彩</a> </li>

										<li><a href="/index.php/index/game/80/59/193">腾讯分分彩<i>H</i></a> </li>-->
										
										
										<!-- comingsoon();  如果需要禁用用这个函数即可--> 
									</ul>
								</dd>
							</dl>
							<!--<dl>
							<dt>PK拾</dt>
								<dd>
									<ul class="lot_list">
										<li><a href="/index.php/index/game/20">北京PK拾<i class="m-yellow">N</i></a> </li>
										
									</ul>
								</dd>
							</dl>-->
							
						</li> 
					</ul>
					<div class="m_nav_line"></div>
				</li>
				
				<li class="tree_box tree_list">
					<h3 class="one_nav_list account_icon">账户管理<i class="lnstruction-top"></i></h3>
					<ul class="tree_one">
						<li class="lotter_list_game">
							<div class="m_nav_line"></div>
								<dl class="lnstruction">
									<dd>
										<ul class="lot_list">
<!--											<li class="tree_list"> <a href="/index.php/record/search">投注记录</a></li>-->
<!--											<li class="tree_list"> <a href="/index.php/report/coin">帐变记录</a></li>-->
<!--											<li class="tree_list"> <a href="/index.php/report/count">盈亏报表</a></li>-->
											<li class="tree_list"><a href="/index.php/safe/info">绑定卡号 </a></li>
											<li class="tree_list"><a href="/index.php/safe/loginpasswd">登入密码</a></li>
											<li class="tree_list"><a href="/index.php/safe/passwd">提款密码</a></li>
										</ul>
									</dd>
								</dl>
						</li>
					</ul>
					<div class="m_nav_line"></div>
				</li>
				<?php if($this->user['type']){?>
				<li class="tree_box tree_list">
					<h3 class="one_nav_list team_icon">团队管理<i class="lnstruction-top"></i></h3>
					<ul class="tree_one">
						<li class="lotter_list_game">
								<div class="m_nav_line"></div>
							<dl class="lnstruction">
								<dd>
									<ul class="lot_list">
										<li class="tree_list"><a href="/index.php/team/gameRecord">团队记录</a></li>
<!--										<li class="tree_list"><a href="/index.php/team/coin">团队帐变</a></li>-->
<!--										<li class="tree_list"><a href="/index.php/team/report">团队盈亏</a></li>-->
										<li class="tree_list"><a href="/index.php/team/memberList">用户列表</a></li>
										<li class="tree_list"><a href="/index.php/team/addMember">注册管理</a></li>
										<li class="tree_list"><a href="/index.php/team/addlink">推广设定</a></li>
										<li class="tree_list"><a href="/index.php/team/linkList">链接管理</a></li>
										<li class="tree_list"><a href="/index.php/team/coinall">团队统计</a></li>
									</ul>
								</dd>
							</dl>
						</li>
					</ul>
					<div class="m_nav_line"></div>
				</li>
				<?}?>
				<li class="tree_box tree_list">
					<h3 class="one_nav_list account_icon">充值提现<i class="lnstruction-top"></i></h3>
					<ul class="tree_one">
						<li class="lotter_list_game">
							<div class="m_nav_line"></div>
								<dl class="lnstruction">
									<dd>
										<ul class="lot_list">
											<li class="tree_list"> <a href="/index.php/cash/recharge">充值</a></li>
											<li class="tree_list"> <a href="/index.php/cash/toCash">提现</a></li>
											<li class="tree_list"> <a href="/index.php/cash/rechargeLog">充值记录</a></li>
											<li class="tree_list"><a href="/index.php/cash/toCashLog">提现记录 </a></li>
										</ul>
									</dd>
								</dl>
						</li>
					</ul>
					<div class="m_nav_line"></div>
				</li>
				<!--<li class="tree_box tree_list">
					<h3 class="one_nav_list activity_icon">优惠活动<i class="lnstruction-top"></i></h3>
					<ul class="tree_one">
						<li class="lotter_list_game">
							<div class="m_nav_line"></div>
								<dl class="lnstruction">
									<dd>
										<ul class="lot_list">
											<li class="tree_list"><a href="/index.php/score/lucky">幸运抽奖</a></li>
											<li class="tree_list"><a href="/index.php/cash/card">卡密充值</a></li>
											<li class="tree_list"><a href="/index.php/lottery/hemai">合买中心</a></li>
											<li class="tree_list"><a class="notice" href="/index.php/notice/info">系统公告</a></li>
										</ul>
									</dd>
								</dl>
						</li>
					</ul>
					<div class="m_nav_line"></div>
				</li>			-->
			</ul>
		</section>
		<div class="home_b">
			<div class="m_nav_line"></div>
				<!-- <a href="">首页</a> -->
				<a class="one_nav_list conpt_icon" href="/?v=2">电脑版</a>
				<a class="one_nav_list retreat_icon" href="javascript:m_loginout()">安全退出</a>
		</div>
		<div class="shady"></div>	