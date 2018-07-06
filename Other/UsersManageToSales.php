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
		<title>用户管理（销售人员）</title>
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
				<!--左侧导航    s-->
				<div class="navInfo nm-left">
					<ul>
						<li class="shouye">
							<a href="../index.php" class="bm-title">
								<img src="../img/shouye.png"> 首页
							</a>
						</li>
						<li class="yewu">
							<a href="../GroupTour/GroupTourCreate.php" class="bm-title ">
								<img src="../img/yewu.png"> 业务
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
								<img src="../img/kuaiji.png"> 会计
							</a>
							<dl class="detailMsg nm-hide">
								<dd>
									<a href="../OrderHistory/OrderHistory.php" class="lab-active">
										<label></label> 历史订单
									</a>
								</dd>
								<dd>
									<a href="../AccountingService/GroupTourService.php"><label></label> 会计服务</a>
								</dd>
							</dl>
						</li>
						<li class="guanli">
							<a href="../Manage/TourGuideManage.php" class="bm-title">
								<img src="../img/guanli.png"> 管理
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
								<img src="../img/c_qita.png"> 其他
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
				<!--左侧导航    e-->
				<!--右侧内容    s-->
				<div class="theamInfo nm-right">
					<div class="showMsg usersManage">
						<div class="floor usersManageArea">
							<div class="groupMsg">
								<!--用户管理  s-->
								<label class="theamTitle">
									<i></i>
									用户管理
								</label>
								<!--用户管理  e-->
								<ul class="usersManageNav">
									<li class="current-item">
										<a href="javascript:void(0);">
											基本信息
										</a>
									</li>
									<li>
										<a href="javascript:void(0);">
											修改密码
										</a>
									</li>
								</ul>
							<!--基本信息    s-->
							<div  class="basicInfo usersManageInfo">
								<ul class="manageDetail">
									<li>
										<label>姓</label>
										<input type="text" class="lastName">
									</li>
									<li>
										<label>名</label>
										<input type="text" class="firstName">
									</li>
									<li>
										<label>Code</label>
										<input  type="text" class="codeInfo"/>
									</li>
									<li>
										<label>性别</label>
										<select class="genderInfo">
											<option>男</option>
											<option>女</option>
										</select>
									</li>
									<li>
										<label>移动电话</label>
										<input type="text"  class="phoneNum"/>
									</li>
									<li>
										<label>分部</label>
										<select class="divisionInfo">
											<option>法拉盛</option>
											<option>北京</option>
											<option>西安</option>
											<option>成都</option>
											<option>曼哈顿</option>
										</select>
									</li>
									<li>
										<label>邮件</label>
										<input type="text" class="mailInfo" />
									</li>
									<li>
										<label>详情</label>
										<textarea rows="3"></textarea>
									</li>
									<li class="actionFilerBox">
										<a href="javascript:void(0);" class="confirmAddInfo">确认修改</a>
										<a href="javascript:void(0);" class="confirmReset">重置</a>
									</li>

								</ul>
							</div>
							<!--基本信息   e-->
							<!--修改密码   s-->
							<div class="changePassWord usersManageInfo salesPassWordBox">
								<ul class="manageDetail">
									<li>
										<label>输入新密码</label>
										<input type="password" id="userPassWord"/>
									</li>
									<li>
										<label>确认新密码</label>
										<input type="password" id="confirmUserPassWord"/>
									</li>
									<li class="actionFilerBox">
										<a href="javascript:void(0);" class="confirmAddInfo confirmAmendInfo">确认修改</a>
										<a href="javascript:void(0);" class="confirmReset">清空</a>
									</li>
								</ul>
							</div>
							<!--修改密码   e-->
							<!--确认框       s-->
							<div class="confirmUsersInfo">
								<p class="confirmTitle">
									<img src="../img/userConfirm.png" />
								</p>
								<p class="confirmNotice">修改成功</p>
								<p class="actionBox">
									<button  class="actionConfirm">复制</button>
									<button	 class="actionCancel">返回</button>
								</p>
							</div>
							<!--确认框       e-->



							</div>

						</div>

					</div>

				</div>
				<!--右侧内容    e-->
			</div>
			<!--主内容区   e-->

		</div>
		<script  src="../js/jquery.min.js" type="text/javascript"></script>
		<script src="../js/homePage/public.js" type="text/javascript"></script>
		<script src="../js/homePage/usersManage.js" type="text/javascript"></script>
		<script src="../js/jquery.zclip.js" type="text/javascript"></script>
		<script src="../js/clipboard.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(function(){
				cardToggle();
				confirmUserInfo();
				amendBasicInfo();
				resetBasicInfo();//重置
				clearUserPass();//清空
			});
		</script>

	</body>
</html>
