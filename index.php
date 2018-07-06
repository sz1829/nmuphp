<?php
/*session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
	header('location: login.php');
}*/
 ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>后台管理系统（首页）</title>
		<link href="css/style.css" type="text/css" rel="stylesheet" />
		<link href="css/homePage.css" type="text/css" rel="stylesheet" />
		<link href="layui/css/layui.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="css/date.css"  type="text/css"/>
	</head>
	<body>
		<div class="msWidth">
			<!--header s-->
			<div class="header">
				<div class="nm-left">
					<span class="ms-theam">旅行社管理系统</span>
				</div>
				<div class="nm-right user-info">
					<ul>
						<!--<li>
						<a href="javascript:void(0);" class="user-msg">
						<img src="img/msg.png" class="message">
						<i>3</i>
						</a>
						</li>-->
						<!--<li>
							<a href="javascript:void(0);">
								<span>jony.liu.@aotrip.net</span>
							</a>
						</li>-->
						<li class="login">
							<a href="javascript:void(0);">
								退出
							</a>
						</li>
					</ul>
				</div>
			</div>
			<!--header e-->
			<div class="msContent">
				<!--左侧导航 s-->
				<div class="navInfo nm-left">
					<ul>
						<li class="shouye title-active">
							<a href="javascript:void(0);" class="bm-title">
								<img src="img/c_shouye.png">
								首页
							</a>
						</li>
						<li class="yewu">
							<a href="GroupTour/GroupTourCreate.php" class="bm-title ">
								<img src="img/yewu.png">
								业务
							</a>
							<dl class="detailMsg nm-hide">
								<dd>
									<a href="GroupTour/GroupTourCreate.php" class="lab-active">
										<label></label> 独立团
									</a>
								</dd>
								<dd>
									<a href="IndividualTour/IndividualTourCreate.php" >
										<label></label> 散拼团
									</a>
								</dd>
								<dd>
									<a href="AirTicket/AirTicketCreate.php">
										<label></label> 机票
									</a>
								</dd>
							</dl>

						</li>
						<li class="kuaiji">
							<a href="OrderHistory/OrderHistory.php" class="bm-title">
								<img src="img/kuaiji.png">
								会计
							</a>
							<dl class="detailMsg nm-hide">
								<dd>
									<a href="javascript:void(0);" class="lab-active">
										<label></label> 历史订单
									</a>
								</dd>
								<dd>
									<a href="javascript:void(0);">
										<label></label> 会计服务
									</a>
								</dd>
							</dl>
						</li>
						<li class="guanli">
							<a href="Manage/TourGuideManage.php" class="bm-title">
								<img src="img/guanli.png">
								管理
							</a>
							<dl class="detailMsg nm-hide">
								<dd>
									<a href="javascript:void(0);" class="lab-active">
										<label></label> 导游
									</a>
								</dd>
								<dd>
									<a href="javascript:void(0);">
										<label></label> 销售
									</a>
								</dd>
								<dd>
									<a href="javascript:void(0);">
										<label></label> 供应商
									</a>
								</dd>
							</dl>
						</li>
						<li class="bm-title qita">
							<a href="Other/OtherManage.php">
								<img src="img/qita.png">
								其他
							</a>
						</li>
					</ul>
				</div>
				<!--左侧导航 e-->
				<!--右侧信息展示   s-->
				<div class="theamInfo nm-right">
					<div class="showMsg homePage">
						<div class="floor ">
							<div class="groupMsg">
								<!--登录用户信息 s-->
								<div class="userInfoFloor">
									<div class="userNameInfo">
										<ul>
											<li>
												姓名：<span><?php echo $_SESSION['username']; ?></span>
											</li>
											<li>
												用户组：<span><?php echo $_SESSION["group_name"]; ?></span>
											</li>
										</ul>
									</div>
									<div class="loginInfo">
										<ul>
											<!--<li>
												本次登录：<span>2018-06-12</span>
											</li>-->
											<li>
												上次登录：<span><?php echo $_SESSION['last_time_login']; ?></span>
											</li>
											<li>
												待处理事项：<span>2</span>
											</li>
											<li>
												<a href="Other/UsersManageToSales.php">
													修改密码
												</a>
											</li>
										</ul>
									</div>
									<!--天气-->
									<div class="weather nm-right" id="weather">
									</div>
								</div>
								<!--登录用户信息 e-->
								<div class="otherInfoFloor">
									<!--工作日历 s-->
									<div class="workCalendar otherUserInfo">
										<label class="mark">工作日历</label>
										<!--<div class="layui-container" style="padding: 15px;">
										<div class="layui-row">
										<div class="layui-col-md12">-->
										<div class="layui-inline" id="calendar" ></div>
										<!--</div>
										</div>
										</div>-->
									</div>
									<!--工作日历  e-->
									<!--待处理事项 s-->
									<div class="otherUserInfo pendingItem">
										<label class="mark">待处理事项</label>
										<a href="javascript:void(0);" class="addNewItem">添加</a>
										<ul>
										</ul>
									</div>
									<!--待处理事项 e-->
									<!--相关提醒     s-->
									<div class="otherUserInfo noticeInfo">
										<label class="mark">相关提醒</label>
										<!--公告   s-->
										<ul>
											<li>
												<a href="javascript:void(0);">
													<i></i><label>[公告]</label>
													<span>公告信息公告信息公告信息公告信息公告信息公告信息公告信息
													公告信息公告信息公告信息公告信息公告信息公告信息公告信息</span>
												</a>
												<img src="img/right_icon.png"/>
											</li>
											<li>
												<a href="javascript:void(0);">
													<i></i><label>[通知]</label>
													<span>公告信息公告信息公告信息公告信息公告信息公告信息公告信息</span>
												</a>
												<img src="img/right_icon.png"/>
											</li>
											<li>
												<a href="javascript:void(0);">
													<i></i><label>[通知]</label>
													<span>公告信息公告信息公告信息公告信息公告信息公告信息公告信息</span>
												</a>
												<img src="img/right_icon.png"/>
											</li>
											<li>
												<a href="javascript:void(0);">
													<i></i><label>[通知]</label>
													<span>公告信息公告信息公告信息公告信息公告信息公告信息公告信息</span>
												</a>
												<img src="img/right_icon.png"/>
											</li>
											<li>
												<a href="javascript:void(0);">
													<i></i><label>[通知]</label>
													<span>公告信息公告信息公告信息公告信息公告信息公告信息公告信息</span>
												</a>
												<img src="img/right_icon.png"/>
											</li>
										</ul>
										<!--公告   e-->
									</div>
									<!--相关提醒     e-->
									<!--当月已成交订单 s-->
									<div class="otherUserInfo userOrderInfo">
										<label class="mark">当月已成交订单</label>
										<label class="mark currency">货币：USD</label>
										<ul>
											<li>
												<label class="all">
													<i>全部</i>
												</label>
												<div class="order-txt">
													<p>
														订单：<span>123123123123123123123123123123123123</span>
													</p>
													<p>
														金额：<span>123</span>
													</p>
												</div>
											</li>
											<li>
												<label class="groupTour"><i>独立团</i></label>
												<div class="order-txt">
													<p>
														订单：<span>123</span>
													</p>
													<p>
														金额：<span>123</span>
													</p>
												</div>
											</li>
											<li>
												<label class="individualTour"><i>散拼团</i></label>
												<div class="order-txt">
													<p>
														订单：<span>123</span>
													</p>
													<p>
														金额：<span>123</span>
													</p>
												</div>
											</li>
											<li>
												<label class="airTicket"><i>机票</i></label>
												<div class="order-txt">
													<p>
														订单：<span>123</span>
													</p>
													<p>
														金额：<span>123</span>
													</p>
												</div>
											</li>
										</ul>

									</div>
									<!--当月已成交订单 e-->
									<!--客户增长  s-->
									<div class="otherUserInfo customerGrowth">
										<label class="mark">客户增长</label>
										<div class="customerGrowthInfo">

										</div>
									</div>
									<!--客户增长  e-->
								</div>

							</div>
						</div>
					</div>
				</div>
				<!--右侧信息展示   e-->
			</div>
		</div>

		<!-- JS -->
		<script src="js/jquery.min.js" type="text/javascript"></script>
		<script src="js/homePage/public.js" type="text/javascript"></script>
		<script src="js/homePage/homePage.js" type="text/javascript"></script>
		<script src="layui/layui.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(function() {
				homePage();
			});
		</script>
	</body>
</html>
