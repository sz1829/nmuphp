<?php
/*(session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
	header('location: ../login.php');
}*/
 ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>后台管理系统（独立团添加页面）</title>
		<link href="../css/groupTour.css" type="text/css" rel="stylesheet" />
		<link href="../css/style.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div class="msWidth">
			<div class="header">
				<div class="nm-left">
					<span class="ms-theam">旅行社管理系统</span>
				</div>
				<div class="nm-right user-info">
					<ul>
						<!--<li>
							<a href="javascript:void(0);" class="user-msg">
								<img src="../img/msg.png" class="message">
								<i>3</i>
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
			<div class="msContent">
				<!--左侧导航 s-->
				<div class="navInfo nm-left">
					<ul>
						<li class="shouye">
							<a href="../index.php" class="bm-title">
								<img src="../img/shouye.png">
								首页
							</a>
						</li>
						<li class="yewu title-active">
							<a href="javascript:void(0);" class="bm-title ">
								<img src="../img/c_yewu.png">
								业务
							</a>
							<dl class="detailMsg">
								<dd>
									<a href="javascript:void(0);" class="lab-active">
										<label></label> 独立团
									</a>
								</dd>
								<dd>
									<a href="../IndividualTour/IndividualTourCreate.php" >
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
									<a href="javascript:void(0);" class="lab-active">
										<label></label> 历史订单
									</a>
								</dd>
								<dd>
									<a href="javascript:void(0);"><label></label> 会计服务</a>
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
							<a href="../Other/OtherManage.php">
								<img src="../img/qita.png">
								其他
							</a>
						</li>
					</ul>
				</div>
				<!--左侧导航 e-->
				<div class="theamInfo nm-right">
					<div class="showMsg yewuMsg">
						<div class="floor teamIndie">
							<div class="navGroup">
								<ul>
									<li class="addItem card-active">
										<a href="javascript:void(0)" class="btn ms-active createOrderButton">
											<img src="../img/add.png" />
											添<i>隐藏</i>加
										</a>
									</li>
									<li class="updateItem">
										<a href="GroupTourUpdate.php" class="btn updateOrderButton">
											<img src="../img/c_refresh.png">
											更<i>隐藏</i>新
										</a>
									</li>
								</ul>
							</div>
							<div class="groupMsg addInfo">
								<form class="addlist" id="createGroupTourForm">
									<div class="cardLeft nm-left">
										<label class="markMsg"><i></i>出团信息</label>
										<ul class="add-msg">
											<li>
												<label class="nm-left">团号</label>
												<input type="text" id="groupNum">
											</li>
											<li>
												<label class="nm-left">航班号</label>
												<input type="text" id="flightNum">
											</li>
											<li>
												<label class="nm-left">巴士公司</label>
												<input type="text" id="busCompany">
											</li>
											<li>
												<label class="nm-left">销售人员</label>
												<input id="salespersonInput" type="text" placeholder="Search...">
											</li>
											<li>
												<label class="nm-left">导游</label>
												<input type="text" id="tourGuide" placeholder="Search...">
											</li>
											<li>
												<label class="nm-left">导游电话</label>
												<input type="text" id="guideTel" disabled="disabled" value="123123">
											</li>
											<li>
												<label class="nm-left">代理商</label>
												<input type="text" id="agent">
											</li>
											<li>
												<label class="nm-left">来源</label>
												<input type="text" id="groupTourSource" placeholder="Search...">
											</li>
											<li>
												<label class="nm-left ">领队人数</label>
												<input type="text" class="leadnum" id="leadNum">
											</li>
											<li>
												<label class="nm-left ">游客人数</label>
												<input type="text" class="visitorNum" id="visitorNum">
											</li>
											<li>
												<label class="nm-left">备注</label>
												<textarea id="note" rows="5"></textarea>
											</li>
										</ul>
									</div>
									<div class="cardRight nm-left info-date">
										<label class="markMsg"><i></i>日期信息</label>
										<ul class="add-msg">
											<li>
												<label class="nm-left">出发日期</label>
												<input type="date" id="startTime" value="">
											</li>
											<li>
												<label class="nm-left">结束日期</label>
												<input type="date" id="endTime" value="">
											</li>
											<li>
												<label class="nm-left">天数</label>
												<input type="text" id="dateCount" value="">
											</li>
										</ul>
									</div>
									<div class="cardRight nm-left info-price">
										<label class="markMsg"><i></i>价格信息</label>
										<ul class="add-msg">
											<li>
												<label class="nm-left">货币</label>
												<select name="" id="currency">
													<option value="USD">$ 美元</option>
													<option value="RMB">￥ 人民币</option>
												</select>
											</li>
											<li>
												<label class="nm-left">付款方式</label>
												<select name="" id="paymentType">
													<option value="creditcard">Credit Card</option>
													<option value="mco">MCO</option>
													<option value="alipay">Alipay</option>
													<option value="wechat">WeChat</option>
													<option value="cash">Cash</option>
													<option value="check">Check</option>
													<option value="other">Other</option>
												</select>
											</li>
											<li>
												<label class="nm-left">价格</label>
												<input type="text" id="price">
											</li>
											<li>
												<label class="nm-left">准备金</label>
												<input type="text" id="reserve">
											</li>
											<li>
												<label class="nm-left">报账</label>
												<input type="text" class="bill" id="write_off">
											</li>
											<li>
												<label class="nm-left">总花费</label>
												<input type="text" id="totalCost">
											</li>
											<li class="discountCard">
												<label class="nm-left">折扣</label>
												<dl class="discountOption" id="groupDiscountOption">
													<dd class="option-active discount-code">
														<a href="javascript:void(0);">
															折扣码
														</a>
													</dd>
													<dd class="coupon">
														<a href="javascript:void(0);">
															折扣金额
														</a>
													</dd>
												</dl>

												<dl class="exchange">
													<dd class="discount-text">
														<input type="text" id="groupDiscountText">
													</dd>
													<dd class="discount-apply">
														<a href="javascript:void(0);" class="discountApply" id="groupDiscountApply">
															Apply
														</a>
													</dd>
												</dl>
												<dl class="discountNotice nm-hide" id="groupDiscountNotice">
													<dd>
														<span id="groupSubtractNum"></span>
													</dd>
												</dl>
											</li>
										</ul>
									</div>
									<div class="split nm-hide">
										<hr>
									</div>
									<div class="fundMsg nm-hide" id="fundMsg">
										<ul>
											<li>
												<label>午餐</label>
												<input type="text" value="6" id="lunch">
											</li>
											<li>
												<label>晚餐</label>
												<input type="text" value="10" id="dinner">
											</li>
											<li>
												<label>天数</label>
												<input type="text" class="daynum" disabled="disabled">
											</li>
											<li>
												<label>出发日期</label>
												<input type="text" class="startime">
											</li>
											<li>
												<label>总人数</label>
												<input type="text" placeholder="6" id="peopleCount" disabled="disabled">
											</li>
											<li>
												<a class="proTab" id="proTab">
													生成报表
												</a>
											</li>
										</ul>

									</div>

									<!-- 准备金 -->
									<div class="userTab nm-hide">
										<ul class="userTab1"></ul>
										<ul class="dtip driverTip">
											<li class="driverTipItem"></li>
										</ul>
									</div>

									<ul class="submitInfo">
										<li>
											<a href="javascript:void(0);" id="groupTourSubmit">
												提交
											</a>
										</li>
										<li>
											<a href="javascript:void(0);" id="groupTourSubmitAndDownload">
												提交并下载
											</a>
										</li>
										<li>
											<a href="javascript:void(0);" id="groupTourCancel">
												重置
											</a>
										</li>
									</ul>
								</form>

								<!-- Confirm Box -->
								<?php
									$confirmBoxClass = "grouptourCreateConfirmBox";
									$confirmButtonClass = "groupTourCreateActionConfirm";
									$cancelButtonClass = "groupTourCreateActionCancel";
									include('../confirmInfo.php');
								 ?>

								 <?php
 									$confirmBoxClass = "grouptourCreateSuccessBox";
 									$confirmButtonClass = "grouptourCreateSuccessConfirm";
 									$cancelButtonClass = "grouptourCreateSuccessCancel";
 									include('../confirmInfo.php');
 								 ?>

								 <?php
 									$confirmBoxClass = "grouptourDownloadBox";
 									$confirmButtonClass = "groupTourDownloadActionConfirm";
 									$cancelButtonClass = "groupTourDownloadActionCancel";
 									include('../confirmInfo.php');
 								 ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="../js/jquery.min.js" type="text/javascript"></script>
		<script src="../js/homePage/public.js" type="text/javascript"></script>
		<script src="../js/homePage/groupTour.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(function(){
				tourDiscount($("#groupDiscountText"), $("#groupDiscountNotice"), $("#groupDiscountApply"), $("#groupSubtractNum"), $("#groupDiscountOption"));
//				successToolTip();
				$("a#proTab").on("click",function(){
					if($(".userTab").css("display")=="block"){
						var reserveInputWidth=$("input.reserveInput").outerWidth(true);
						var driverTipInputWidth=((reserveInputWidth-10)*2)+"px";
				        $("input.driverTipInput").css("cssText","width:"+driverTipInputWidth+"!important");
					}

				});
				$(window).resize(function(){
					var reserveInputWidth=$("input.reserveInput").outerWidth(true);
					var driverTipInputWidth=((reserveInputWidth-10)*2)+"px";
				    $("input.driverTipInput").css("cssText","width:"+driverTipInputWidth+"!important");
				});
			});
		</script>
	</body>
</html>
