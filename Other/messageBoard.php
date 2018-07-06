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
		<title>其他管理-留言板</title>
		<link href="../css/otherInfo.css" type="text/css" rel="stylesheet" />
		<link href="../css/style.css" type="text/css" rel="stylesheet" />
		<link href="../css/messageBoard.css" type="text/css" rel="stylesheet" />
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
			<!--主内容区s-->
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
									<a href="javascript:void(0);" id="toUsersManagePage">
										<label></label> 用户管理
									</a>
								</dd>
								<dd>
									<a href="javascript:void(0);" class="lab-active">
										<label></label> 留言板
									</a>
								</dd>
							</dl>
						</li>
					</ul>
				</div>
				<!--左侧导航   e-->
				<div class="theamInfo nm-right">
					<div class="showMsg otherManage">
						<div class="floor otherManageArea">
							<div class="groupMsg">
								<!--留言板   s-->
								<label class="theamTitle"> <i></i> 留言板 </label>
								<!--留言板   e-->
								<!--Nav s-->
								<div class="filterMessage">
									<ul>
										<li>
											<select>
												<option>类型</option>
												<option>独立团</option>
												<option>散拼团</option>
												<option>机票</option>
												<option>其他</option>
											</select>
										</li>
										<li>
											<input id="salesperson" type="text" placeholder="Search...">
										</li>
										<li>
											<a href="javasript:void(0);">
												确认
											</a>
										</li>
									</ul>

								</div>
								<!--Nav e-->
								<!--message s-->
								<div class="messageBoard">
									<div class="leftMessageTab">
										<ul class="problemMsg">
											<li><input type="checkbox" checked="checked"><label>只查看未解决问题</label></li>
											<li><i></i><label>已解决</label></li>
										</ul>

										<ul class="messageCard">
											<li class="messageTitle">
												<dl>
													<dd class="askItem">提问</dd>
													<dd class="askTime">时间</dd>
													<dd class="problemType">类型</dd>
													<dd class="problemContent">问题内容</dd>
													<dd class="moreInfo">更多信息</dd>
													<dd class="answerInfo">留言解答</dd>
												</dl>
											</li>
											<li class="messageDetail">
												<dl >
													<dd class="askItem">alex</dd>
													<dd class="askTime">2018-06-06 15:35</dd>
													<dd class="problemType">机票</dd>
													<dd class="problemContent">麻烦看看来回有没有K舱&nbsp;至少要四个位置</dd>
													<dd class="moreInfo">更多信息更多信息更多信息更多信息更多信息更多信息
													更多信息</dd>
													<dd class="answerInfo">留言解答</dd>
												</dl>
											</li>
											<li class="messageDetail">
												<dl>
													<dd class="askItem">alex</dd>
													<dd class="askTime">2018-06-06 15:35</dd>
													<dd class="problemType">机票</dd>
													<dd class="problemContent">麻烦看看来回有没有K舱&nbsp;至少要四个位置</dd>
													<dd class="moreInfo">更多多信息更多信息更多信息更多信息更多信息更多信息
													更多信息</dd>
													<dd class="answerInfo">留言解答</dd>
												</dl>
											</li>
											<li class="messageDetail">
												<dl>
													<dd class="askItem">alex</dd>
													<dd class="askTime">2018-06-06 15:35</dd>
													<dd class="problemType">机票</dd>
													<dd class="problemContent">麻烦看看</dd>
													<dd class="moreInfo">多信息更多信息更多信息更多信息更多信息更多信息
													更多信息</dd>
													<dd class="answerInfo"></dd>
												</dl>
											</li>
										</ul>



									</div>
									<div class="rightMeaaageTab">
										<ul class="answerAndAdd">
											<li class="answerItem">解答</li>
											<li class="addItem selected">添加</li>
										</ul>
										<!--添加-->
										<div class="detailMsg addCard">
											<ul>
												<li class="questionInfoTxt">
													<label>添加问题</label>
													<textarea></textarea>
												</li>
												<li class="moreInfoTxt">
													<label>更多信息</label>
													<textarea></textarea>
												</li>
												<li class="actionFilerBox">
													<a href="javascript:void(0);" class="filterInfo">确&nbsp;&nbsp;&nbsp;&nbsp;认</a>
													<a href="javascript:void(0);" class="resetInfo">清&nbsp;&nbsp;&nbsp;&nbsp;空</a>
												</li>
											</ul>

										</div>
										<!--解答-->
										<div class="detailMsg answerCard">
											<ul>
												<li>
													<p class="answerTxt"></p>
													<p class="answerMoreInfo"></p>
												</li>
												<li>
													<label>回复</label>
													<textarea></textarea>
												</li>
												<li class="actionFilerBox">
													<a href="javascript:void(0);" class="replyInfo">回&nbsp;&nbsp;&nbsp;&nbsp;复</a>
													<a href="javascript:void(0);" class="resetInfo">清&nbsp;&nbsp;&nbsp;&nbsp;空</a>
												</li>
											</ul>

										</div>
										<!--已解决问题    展示-->
										<div class="detailMsg resolvedCard">
											<ul>
												<li>
													<p class="answerTxt"></p>
													<p class="answerMoreInfo"></p>
													<p class="answerMoreInfo"></p>
												</li>
												<li class="actionFilerBox">
													<a href="javascript:void(0);" class="replyInfo">确&nbsp;&nbsp;&nbsp;&nbsp;认</a>
													<a href="javascript:void(0);" class="resetInfo">清&nbsp;&nbsp;&nbsp;&nbsp;空</a>
												</li>
											</ul>

										</div>
									</div>

								</div>
								<!--message e-->

							</div>

						</div>
					</div>
				</div>

			<!--主内容区e-->


		</div>
		<script src="../js/jquery.min.js" type="text/javascript"></script>
		<script src="../js/homePage/public.js" type="text/javascript"></script>
		<script src="../js/homePage/messageBoard.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(function(){
				messageBoard();
				/*
			     *   销售人员的搜索列表
			     */
			    $("#salesperson").on('focus', function() {
			        var current_id = $(this).attr('id');
			        var target = "salesperson";

			        var url = location.protocol.concat("//").concat(location.host).concat('/namei/ms-work/database/autoComplete.php');
			        $.ajax({
			            url: url,
			            headers: {
			                'Content-Type': 'application/x-www-form-urlencoded'
			            },
			            type: 'post',
			            data: {
			                target: target
			            },
			            success: function(response) {
			                autocomplete(document.getElementById(current_id), JSON.parse(response));
			            },
			            error: function(jqXHR, textStatus, errorThrown) {
			                console.log(textStatus, errorThrown);
			            }
			        });
			        // 模拟数据
			        // autocomplete(document.getElementById(current_id), ['alex', 'terry']);
			    });
			});
		</script>
	</body>
</html>
