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
		<title>分部</title>
		<link href="../css/otherInfo.css" type="text/css" rel="stylesheet" />
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
						<li>
							<a href="javascript:void(0);" class="user-msg">
								<img src="../img/msg.png" class="message">
								<i>3</i>
							</a>
						</li>
						<li>
							<a href="javascript:void(0);">
								<img src="../img/user.png" class="user">
								<span>jony.liu.@aotrip.net</span>
							</a>
						</li>
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
									<a href="javascript:void(0);" class="lab-active">
										<label></label> 其他管理
									</a>
								</dd>
								<dd>
									<a href="javascript:void(0);" id="toUsersManagePage">
										<label></label> 用户管理
									</a>
								</dd>
							</dl>
						</li>
					</ul>
				</div>
				<!--左侧导航   e-->
				<!--右侧内容   s-->
				<div class="theamInfo nm-right">
					<div class="showMsg otherManage">
						<div class="floor otherManageArea">
							<div class="groupMsg">
								<!--其他管理   s-->
								<label class="theamTitle">
									<i></i>
									其他管理
								</label>
								<!--其他管理   e-->
								<div class="otherManageNav">
										<ul>
											<li >
												<a href="OtherManage.php">折扣码</a>
											</li>
											<li>
												<a href="Customers.php">顾客来源</a>
											</li>
											<!--<li>
												<a href="Currency.php">货币</a>
											</li>-->
											<li>
												<a href="Payment.php">支付方式</a>
											</li>
											<li class="current-item">
												<a href="javascript:void(0);">分部</a>
											</li>
											<li>
												<a href="javascript:void(0);">展示用汇率</a>
											</li>
										</ul>
									</div>
								<!--左边   s-->
								<div class="leftInfoCard">
									<!--<div class="otherManageNav">
										<ul>
											<li >
												<a href="OtherManage.php">折扣码</a>
											</li>
											<li>
												<a href="Customers.php">顾客来源</a>
											</li>
											<li>
												<a href="Currency.php">货币</a>
											</li>
											<li>
												<a href="Payment.php">支付方式</a>
											</li>
											<li class="current-item">
												<a href="javascript:void(0);">分部</a>
											</li>
										</ul>
									</div>-->
					             	<!--<ul class="salesNav">
										<li class="optionItem plusItem">
											<a href="javascript:void(0);">
												<img src="../img/plus.png">
											</a>
											</li>
										<li class="optionItem minusItem">
											<a href="javascript:void(0);">
												<img src="../img/minus.png">
											</a>
										</li>
										<li class="salesFilter">
											<input type="text">
											<a href="javascript:void(0);" class="addBtn">确认添加</a>
   										</li>
									</ul>-->
									<div class="rightInfo divisionRightInfo">
											<ul class="divisionMsg">
												<li class="tabTitle">
													<dl>
														<dd class="divisionName">分部</dd>
														<dd class="divisionDetail">详情</dd>
													</dl>
												</li>
												<li>
													<dl>
														<dd class="divisionName">分部1</dd>
														<dd class="divisionDetail">详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情</dd>
													</dl>
												</li>
												<li>
													<dl>
														<dd class="divisionName">分部2</dd>
														<dd class="divisionDetail">详情</dd>
													</dl>
												</li>
												<li>
													<dl>
														<dd class="divisionName"></dd>
														<dd class="divisionDetail"></dd>
													</dl>
												</li>
												<li>
													<dl>
														<dd class="divisionName"></dd>
														<dd class="divisionDetail"></dd>
													</dl>
												</li>
												<li>
													<dl>
														<dd class="divisionName"></dd>
														<dd class="divisionDetail"></dd>
													</dl>
												</li>
												<li>
													<dl>
														<dd class="divisionName"></dd>
														<dd class="divisionDetail"></dd>
													</dl>
												</li>
												<li>
													<dl>
														<dd class="divisionName">分部</dd>
														<dd class="divisionDetail">详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情详情</dd>
													</dl>
												</li>
												<li>
													<dl>
														<dd class="divisionName"></dd>
														<dd class="divisionDetail"></dd>
													</dl>
												</li>
											</ul>
									</div>
							</div>
							<!--左边 e-->
							<!--右边 s-->
							<div class="rightInfoCard divisionRightInfoCard">
								<ul class="addInfo">
									<li class="title">添加</li>
									<li>
										<label>分部</label>
										<input type="text" class="divisionName">
									</li>
									<li>
										<label>详情</label>
										<textarea rows="3" class="divisionDetail"></textarea>
									</li>
									<li class="actionFilerBox">
										<a href="javascript:void(0);" class="filterInfo">确认</a>
										<a href="javascript:void(0);" class="resetInfo">重置</a>
									</li>
								</ul>
							</div>
							<!--右边 e-->
						</div>
					</div>

				</div>
				<!--右侧内容   e-->

			</div>
			<!--主内容区   e-->

		</div>
		<script  src="../js/jquery.min.js" type="text/javascript"></script>
		<script src="../js/homePage/public.js" type="text/javascript"></script>
		<script src="../js/homePage/otherInfo.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(function(){
				checkedState();
				filterCodeInfo();
				salesAction();
				minusAction();
				toUsersManagePage();
				salesNameState();
				addStatus();
				detailText();
				addDivisionInfo();
				resetDivisionInfo();
			});
		</script>


	</body>
</html>
