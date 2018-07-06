<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
	header('location: ../login.php');
}
 ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>销售人员业绩</title>
		<link href="../css/performanceManage.css" rel="stylesheet" type="text/css" />
		<link href="../css/style.css" type="text/css" rel="stylesheet" />
		<link href="../css/jquery.searchableSelect.css"  type="text/css" rel="stylesheet"/>
		<link href="../css/salesPerformance.css" type="text/css" rel="stylesheet" />
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
			<!--content s-->
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
						<li class="guanli title-active">
							<a href="javascript:void(0);" class="bm-title">
								<img src="../img/c_guanli.png"> 管理
							</a>
							<dl class="detailMsg">
								<dd>
									<a href="TourGuideManage.php">
										<label></label> 人员管理
									</a>
								</dd>
								<dd>
									<a href="javascript:void(0);" class="lab-active">
										<label></label> 业绩管理
									</a>
								</dd>
							</dl>
						</li>
						<li class="bm-title qita">
							<a href="../Other/OtherManage.php">
								<img src="../img/qita.png"> 其他
							</a>
						</li>
					</ul>

				</div>
				<!--左侧导航    e-->
				<!--右侧内容    s-->
				<div class="theamInfo nm-right">
					<div class="showMsg performanceMsg">
						<div class="floor">
							<div class="groupMsg">
								<label class="theamTitle">
									<i></i>
									销售人员业绩
								</label>
								<!--左侧内容   s-->
								<div class="performanceTheam">
									<!--右箭头   s-->
									<a class="arrow" href="javascript:void(0);">
										&raquo;
									</a>
									<!--右箭头   e-->
									<ul class="salesNav">
										<li class="optionItem plusItem">
											<a href="javascript:void(0);">
												<img src="../img/plus.png" />
											</a>
											</li>
										<li class="optionItem minusItem">
											<a href="javascript:void(0);">
												<img src="../img/minus.png" />
											</a>
										</li>
										<li class="salesFilter">
											<input id="performance-filter-salesperson" type="text" placeholder="销售人员">
											<a href="javascript:void(0);" class="confirmBtn">确认</a>
   										</li>
   										<li class="backBox"><a href="PerformanceManage.php" class="ms-back">返回概况</a></li>
									</ul>
									<div class="salesCard">
										<div class="leftInfo">
											<ul>
												<li>
													<select id="time_filter">
														<option value="daily">每日</option>
														<option value="monthly" selected>每月</option>
														<option value="seasonly">每3个月</option>
														<option value="hyearly">每半年</option>
													</select>
												</li>
												<li>
													<dl>
														<dd><label>From</label></dd>
														<dd><input type="date" id="startTime"></dd>
													</dl>
												</li>
												<li>
													<dl>
														<dd><label>To</label></dd>
														<dd><input type="date" id="endTime"></dd>
													</dl>
												</li>
											</ul>
										</div>
										<div class="rightInfo">
											<ul>
												<li class="chartTitle">销售人员</li>
											</ul>
										</div>
										<ul class="rankingList rankingList1">
											<li class="listTitle">
												<dl>
													<dd>日期</dd>
													<dd>独立团</dd>
													<dd>散拼团</dd>
													<dd>机票</dd>
													<dd>总和</dd>
												</dl>
											</li>
											<!--test s-->
											<!--<li>
												<dl><dd>2018-05-03-2018-08-03</dd><dd></dd><dd></dd><dd></dd><dd></dd></dl>
												<dl><dd></dd></dl>
												<dl><dd></dd></dl>
											</li>-->

											<!--test e-->
										</ul>
										<!--选择多条销售名时的表  s-->
										<ul class="rankingList rankingList2">
											<li class="listTitle">
												<dl>
													<dd>日期</dd>
													<dd>销售</dd>
													<dd>独立团</dd>
													<dd>散拼团</dd>
													<dd>机票</dd>
													<dd>总和</dd>
												</dl>
											</li>
											<!--test s-->
											<!--<li class="detailInfo">
                        						<dl>
						                            <dd class="time cellBox">
						                                <dl class="salesDetail">
						                                    <dd>2018-06-06-2018-08-04</dd>
						                                </dl>
						                            </dd>
						                            <dd class="sales cellBox">
						                                <dl class="salesDetail">
						                                	<dd>223</dd>
						                                	<dd>324</dd>
						                                	<dd>523</dd>
						                                	<dd>624</dd>
						                                </dl>
						                            </dd>
						                            <dd class="groupTour cellBox">
						                                <dl class="salesDetail">
						                                	<dd>123</dd>
						                                	<dd>3212</dd>
						                                </dl>
						                            </dd>
						                            <dd class="individualTour cellBox">
						                                <dl class="salesDetail"></dl>
						                            </dd>
                           							<dd class="airTicket cellBox">
                               							 <dl class="salesDetail"></dl>
                           							</dd>
                           							<dd class="sum cellBox">
                               							<dl class="salesDetail">
                               								<dd>
                               									42341
                               								</dd>
                               								<dd>
                               									42341
                               								</dd>
                               								<dd>
                               									42341
                               								</dd>
                               								<dd>
                               									42341
                               								</dd>
                               							</dl>
                            						</dd>
                       							</dl>
                    						</li>
                    						<li class="detailInfo">
                        						<dl>
						                            <dd class="time cellBox">
						                                <dl class="salesDetail">
						                                   <dd>2018-06-06</dd>
						                                </dl>
						                            </dd>
						                            <dd class="sales cellBox">
						                                <dl class="salesDetail">
						                                	<dd>121</dd>
						                                	<dd>121</dd>
						                                </dl>
						                            </dd>
						                            <dd class="groupTour cellBox">
						                                <dl class="salesDetail">
						                                	<dd>131</dd>
						                                	<dd>131</dd>
						                                </dl>
						                            </dd>
						                            <dd class="individualTour cellBox">
						                                <dl class="salesDetail"></dl>
						                            </dd>
                           							<dd class="airTicket cellBox">
                               							 <dl class="salesDetail"></dl>
                           							</dd>
                           							<dd class="sum cellBox">
                               							<dl class="salesDetail">
                               								<dd>123</dd>
                               								<dd>121</dd>
                               							</dl>
                            						</dd>
                       							</dl>
                    						</li>-->


											<!--test e-->
										</ul>
										<!--选择多条销售名时的表   e-->
									</div>
								</div>
								<!--左侧内容   e-->
								<!--右侧内容   s-->
								<div class="performanceTheam chartInfo">
									<div class="tabCard">
										<p>销售业绩</p>
										<!--图表部分   s-->
										<div id="container" class="chart" style="border: solid 1px #ccc;"></div>
										<!--图表部分   e-->
									</div>
									<div class="tabCard">
										<p>业绩占比</p>
										<!--图表部分   s-->
										<div id="container2" class="chart"></div>
										<!--图表部分   e-->
									</div>
								</div>
								<!--右侧内容  e-->
							</div>
						</div>
					</div>
				</div>
				<!--右侧内容    e-->
			</div>
			<!--content e-->
		</div>
		<script src="../js/jquery.min.js" type="text/javascript"></script>
		<!-- Chart.js -->
		<!-- http://www.chartjs.org/docs/2.7.2/ -->
		<script src="../js/Chart.min.js" type="text/javascript"></script>
		<script src="../js/homePage/public.js" type="text/javascript"></script>
		<script src="../js/Management/salesPerformance.js" type="text/javascript"></script>

		<script src="../js/homePage/salesPerformance.js" type="text/javascript"></script>
		<script src="../js/jquery.searchableSelect.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(function(){
				// arrowAction();
				// selectDate();
				// ckdate($("#startTime"),$("#endTime"));
//				autoCenter($(".arrow"));
				autoWrap();
				$("ul.salesNav li").find("a.ms-back").on("mousedown",function(){
					$(this).addClass("selected");
				});
				$("ul.salesNav li").find("a.ms-back").on("mouseup",function(){
					$(this).removeClass("selected");
				});
			});
		</script>
	</body>
</html>
