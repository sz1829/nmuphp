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
		<title>其他管理-其他</title>
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
						<li class="login">
							<a href="javascript:void(0);">
								退出
							</a>
						</li>
					</ul>
				</div>
			</div>
			<!--header e-->
			<!--主内容区  s-->
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
									<a href="javascript:void(0);" class="lab-active">
										<label></label> 其他管理
									</a>
								</dd>
								<dd>
									<a href="javascript:void(0);" id="toUsersManagePage">
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
				<!--右侧导航   s-->
				<div class="theamInfo nm-right">
					<div class="showMsg otherManage">
						<div class="floor otherManageArea">
							<div class="groupMsg">
								<!--其他管理   s-->
								<label class="theamTitle"> <i></i> 其他管理 </label>
								<!--其他管理   e-->
								<div class="otherManageNav">
									<ul>
										<li>
											<a href="OtherManage.php">
												折扣码
											</a>
										</li>
										<li class="current-item">
											<a href="javascript:void(0);">
												其他
											</a>
										</li>
									</ul>
								</div>
								<!--左侧  s-->
								<div class="leftManageInfo">
									<!--顾客来源  s-->
									<div class="manageCard manageContent">
										<ul>
											<li class="manageTitle">
												顾&nbsp;客&nbsp;来&nbsp;源
											</li>
											<li class="manageAction">
												<dl class="manageCardNav">
													<dd class="optionItem plusItem">
														<a href="javascript:void(0);">
															<img src="../img/plus.png">
														</a>
													</dd>
													<dd class="optionItem minusItem">
														<a href="javascript:void(0);" id="delete-customer-source">
															<img src="../img/minus.png">
														</a>
													</dd>
													<dd class="confirmManageInfo">
														<input type="text" id="customer-source-name">
														<a href="javascript:void(0);" class="confirmBtn" id="customer-source-confirm">确认</a>
													</dd>
												</dl>
											</li>
											<li class="manegeDetailInfo">
												<label>顾客来源</label>
												<dl id="customer-source-list">
													<!--test s-->
													<dd class="selected">来源</dd>
													<dd>来源</dd>
													<dd>来源</dd>
													<dd>来源</dd>
													<dd>来源</dd>
													<dd>来源</dd>
													<dd>来源</dd>
													<dd>来源</dd>
													<dd>来源</dd>
													<dd>来源</dd>
													<dd>来源</dd>
													<dd>来源</dd>
													<dd>来源</dd>
													<dd>来源</dd>
													<dd>来源</dd>
													<dd>来源</dd>
													<dd>来源</dd>
													<dd>来源</dd>
													<dd>来源</dd>
													<dd>来源</dd>
													<!--test e-->
												</dl>
											</li>
										</ul>
									</div>
									<!--顾客来源  e-->
								</div>
								<!--左侧  e-->
								<!--右侧  s-->
								<div class="rightManageInfo">
									<!--分部   s-->
									<div class="manageCard divisionCard">
										<ul>
											<li class="manageTitle">
												分&nbsp;&nbsp;部
											</li>
											<li class="manegeDetailInfo">
												<div class="rightInfo divisionRightInfo">
													<ul class="divisionMsg">
														<li class="tabTitle">
															<dl>
																<dd class="divisionName">分部</dd>
																<dd class="divisionDetail">详情</dd>
															</dl>
														</li>
													</ul>
												</div>
												<div class="rightInfoCard divisionRightInfoCard">
													<ul class="addInfo">
														<li class="title">添加</li>
														<li>
															<label>分部</label>
															<input type="text" class="divisionName" id="department-name">
														</li>
														<li>
															<label>详情</label>
															<textarea rows="3" class="divisionDetail" id="department-detail"></textarea>
														</li>
														<li class="actionFilerBox">
															<a href="javascript:void(0);" class="filterInfo" id="add-department-confirm">确认</a>
															<a href="javascript:void(0);" class="resetInfo" id="add-department-reset">重置</a>
														</li>
													</ul>
												</div>
											</li>
										</ul>
									</div>
									<!--分部  e-->
									<!--展示用汇率   s-->
									<div class="manageCard  exchangeRateCard" style="width: 60%;">
										<ul>
											<li class="manageTitle">
												展&nbsp;示&nbsp;用&nbsp;汇&nbsp;率
											</li>
											<li class="manegeDetailInfo">
												<label>当前展示用汇率</label>
												<dl>
													<dd>1&nbsp;&nbsp;美元&nbsp;&nbsp;=&nbsp;&nbsp;<input type="text" id="exchange-rate">&nbsp;&nbsp;人民币</dd>
												</dl>
											</li>
											<li>
												<!--Restore Defaults-->
												<a href="javascript:void(0);" class="confirmAmend" id="update-exchange-rate-confirm">确认修改</a>
												<a href="javascript:void(0);" class="restoreDefault selected" id="reset-exchange-rate">恢复默认</a>
											</li>
										</ul>
									</div>
									<!--展示用汇率   e-->
								</div>
								<!--右侧  e-->
							</div>
						</div>
					</div>
				</div>
				<!--右侧导航   e-->
			</div>
			<!--主内容区  e-->
		</div>
		<script src="../js/jquery.min.js" type="text/javascript"></script>
		<script src="../js/homePage/public.js" type="text/javascript"></script>
		<script src="../js/homePage/otherInfo.js" type="text/javascript"></script>
		<script src="../js/Other/OtherManagement.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(function () {
				otherManage();
			});
		</script>
	</body>
</html>
