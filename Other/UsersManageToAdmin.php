<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
	header('location: ../login.php');
}
 ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>用户管理（管理人员）</title>
		<link href="../css/usersManage.css" type="text/css" rel="stylesheet" />
		<link href="../css/style.css" type="text/css" rel="stylesheet" />
		<link href="../css/font-awesome.css" type="text/css" rel="stylesheet" />
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
						<li class="login">
							<a href="javascript:void(0);">
								退出
							</a>
						</li>
					</ul>

				</div>

			</div>
			<!--header e-->
			<!--主内容区   s-->
			<div class="msContent">
				<!--左侧导航   s-->
				<div class="navInfo nm-left">
					<ul>
						<li class="shouye">
							<a href="../index.php" class="bm-title">
								<img src="../img/shouye.png">
								首页
							</a>
						</li>
						<li class="yewu">
							<a href="../GroupTour/GroupTourCreate.php" class="bm-title ">
								<img src="../img/yewu.png">
								业务
							</a>
							<dl class="detailMsg nm-hide">
								<dd>
									<a href="../GroupTour/GroupTourCreate.php" class="lab-active">
										<label></label> 独立团
									</a>
								</dd>
								<dd>
									<a href="../IndividualTour/IndividualTourCreate.php">
										<label></label> 散拼团
									</a>
								</dd>
								<dd>
									<a href="../AirTicket/AirTicketCreate.php">
										<label></label> 机票
									</a>
								</dd>
							</dl>
						</li>
						<li class="kuaiji">
							<a href="../OrderHistory/OrderHistory.php" class="bm-title">
								<img src="../img/kuaiji.png">
								会计
							</a>
							<dl class="detailMsg nm-hide">
								<dd>
									<a href="../OrderHistory/OrderHistory.php" class="lab-active">
										<label></label> 历史订单
									</a>
								</dd>
								<dd>
									<a href="../AccountingService/GroupTourService.php">
										<label></label> 会计服务
									</a>
								</dd>
							</dl>
						</li>
						<li class="guanli">
							<a href="../Manage/TourGuideManage.php" class="bm-title">
								<img src="../img/guanli.png">
								管理
							</a>
							<dl class="detailMsg nm-hide">
								<dd>
									<a href="../Manage/TourGuideManage.php" class="lab-active">
										<label></label> 人员管理
									</a>
								</dd>
								<dd>
									<a href="../Manage/PerformanceManage.php">
										<label></label> 业绩管理
									</a>
								</dd>
							</dl>
						</li>
						<li class="qita title-active">
							<a href="../Other/OtherManage.php" class="bm-title">
								<img src="../img/c_qita.png">
								其他
							</a>
							<dl class="detailMsg">
								<dd>
									<a href="OtherManage.php">
										<label></label> 其他管理
									</a>
								</dd>
								<dd>
									<a href="javascript:void(0);" id="toUsersManagePage" class="lab-active">
										<label></label> 用户管理
									</a>
								</dd>
								<dd>
									<a href="messageBoard.php">
										<label></label> 留言板
									</a>
								</dd>
							</dl>
						</li>
					</ul>
				</div>
				<!--左侧导航   e-->
				<!--右侧内容   s-->
				<div class="theamInfo nm-right">
					<div class="showMsg usersManage">
						<div class="floor usersManageArea">
							<div class="groupMsg">
								<label class="theamTitle"> <i></i> 用户管理 </label>
								<div class="usersManageContent">
									<div class="userGroup">
										<ul>
											<li class="groupTitle">
												用户组
											</li>
											<li class="salesNav selected">
												销售人员
											</li>
											<li class="accountingNav">
												会计
											</li>
											<li class="managerNav">
												管理员
											</li>
										</ul>
									</div>
									<div class="usersInfo">
										<ul>
											<li class="userInfoTitle">
												<dl>
													<dd>
														用户名
													</dd>
													<dd>
														最近登录时间
													</dd>
												</dl>
											</li>
											<li>
												<dl>
													<dd class="userName">Alex</dd>
													<dd class="loginTime">2018/5/16</dd>
												</dl>
											</li>
											<li>
												<dl>
													<dd class="userName">Nancy</dd>
													<dd class="loginTime">2018/5/15</dd>
												</dl>
											</li>
											<li>
												<dl>
													<dd class="userName">Ken</dd>
													<dd class="loginTime">2018/5/14</dd>
												</dl>
											</li>
											<li>
												<dl>
													<dd class="userName"></dd>
													<dd class="loginTime"></dd>
												</dl>
											</li>
											<li>
												<dl>
													<dd class="userName"></dd>
													<dd class="loginTime"></dd>
												</dl>
											</li>
											<li>
												<dl>
													<dd class="userName"></dd>
													<dd class="loginTime"></dd>
												</dl>
											</li>
											<li>
												<dl>
													<dd class="userName"></dd>
													<dd class="loginTime"></dd>
												</dl>
											</li>
											<li>
												<dl>
													<dd class="userName"></dd>
													<dd class="loginTime"></dd>
												</dl>
											</li>
											<li>
												<dl>
													<dd class="userName"></dd>
													<dd class="loginTime"></dd>
												</dl>
											</li>
											<li>
												<dl>
													<dd class="userName"></dd>
													<dd class="loginTime"></dd>
												</dl>
											</li>
										</ul>
									</div>
									<div class="rightTab">
										<ul class="usersManageNav">
											<li class="current-item"><a href="javascript:void(0);">修改</a></li>
											<li><a href="javascript:void(0);">添加</a></li>
										</ul>
										<!--修改用户名，密码   s-->
										<div  class="basicInfo usersManageInfo">
											<ul  class="manageDetail">
												<li>
													<label>用户名</label>
													<input type="text" class="userName" id="update-username">
												</li>
												<li>
													<label>密码</label>
													<input type="password" id="update-password">
												</li>
												<li class="actionFilerBox">
													<a href="javascript:void(0);" id="update-password-confirm">修改</a>
													<a href="javascript:void(0);" id="update-password-reset">重置</a>
												</li>
											</ul>
										</div>
										<!--修改用户名密码  e-->
										<!--添加用户名密码  s-->
										<div class="changePassWord usersManageInfo">
											<ul class="manageDetail">
												<li>
													<label>用户名</label>
													<input type="text" class="userName" id="create-username">
												</li>
												<li>
													<label>密码</label>
													<input type="password" id="create-password">
												</li>
												<li class="actionFilerBox">
													<a href="javascript:void(0);" id="create-user-confirm">添加</a>
													<a href="javascript:void(0);" id="create-user-reset">清空</a>
												</li>
											</ul>
										</div>
									<!--添加用户名密码  e-->
									</div>
									<!--确认框       s-->
									<div class="confirmUsersInfo">
										<p class="confirmTitle">
											<img src="../img/userConfirm.png" />
										</p>
										<p class="confirmNotice">修改成功</p>
										<p class="actionBox">
											<button class="actionConfirm adminConfirm copyInfo">复制</button>
											<button	class="actionCancel">返回</button>
										</p>
									</div>
									<!--确认框       e-->
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--右侧内容   e-->
			</div>
			<!--主内容区   e-->
		</div>
		<script src="../js/jquery.min.js" type="text/javascript"></script>
		<script src="../js/homePage/public.js" type="text/javascript"></script>
		<script src="../js/Other/UserAdmin.js" type="text/javascript"></script>
		<!-- <script src="../js/homePage/usersManage.js" type="text/javascript"></script> -->
		<script src="../js/jquery.zclip.js" type="text/javascript"></script>
		<script src="../js/clipboard.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(function(){
				// fillTab();
				// resetTabInfo();
				// clearUserInfo();
			});
		</script>
	</body>
</html>
