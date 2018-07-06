<?php
/*session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
	header('location: ../login.php');
}*/
 ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>独立团更新</title>
		<link href="../css/groupTour.css" type="text/css" rel="stylesheet" />
		<link href="../css/style.css" type="text/css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="../css/pagination.css"/>
		<link rel="stylesheet" type="text/css" href="../css/businessUpdate.css" />
	</head>
	<body>
		<div class="msWidth">
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
			<div class="msContent">
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
				<div class="theamInfo nm-right">
					<div class="showMsg yewu">
						<div class="floor teamIndie">
							<div class="navGroup">
								<ul>
									<li class="addItem">
										<a href="GroupTourCreate.php" class="btn  createOrderButton">
											<img src="../img/c_add.png" />
											添<i>隐藏</i>加
										</a>
									</li>
									<li class="updateItem card-active">
										<a href="javascript:void(0);" class="btn updateOrderButton ms-active">
											<img src="../img/refresh.png">
											更<i>隐藏</i>新
										</a>
									</li>
								</ul>
							</div>
							<!--独立团更新      s-->
							<div class="groupMsg updateInfo">
								<label class="theamTitle">
									<i></i>
								       筛选条件
								</label>
								<form>
									<ul class="filterBox">
										<li class="datePicker">
											<label>订单创建时间</label>
											<select id="group-update-date-filter">
												<option value="customized">Customized</option>
												<option value="1">本日</option>
												<option value="30" selected>最近30天</option>
												<option value="90">最近3个月</option>
												<option value="180">最近半年</option>
											</select>
											<dl class="selectRange nm-hide">
												<dd>
													<i>From</i>
													<input type="date" id="group-update-from-date" />
												</dd>
												<dd>
													<i>To</i>
													<input type="date" id="group-update-to-date" />
												</dd>
											</dl>
										</li>
										<li class="optionItem">
											<label>订单号</label>
											<input type="text" id="group-update-transaction-id-filter" />
										</li>
										<li class="optionItem">
											<label>团号</label>
											<input type="text" id="group-update-group-code-filter" />
											<dl class="confirmMsg">
												<dd><a href="javascript:void(0);" id="group-tour-update-filter">确认</a></dd>
												<dd><a href="javascript:void(0);" id="group-tour-update-reset">重置</a></dd>
											</dl>
										</li>
									</ul>
									<!--tab   s-->
									<div class="updateTab groupTourUpdateTab">
										<ul class="tabList tabListTitle">
											<li class="listNum"><a href="javascript:void(0);">#</a></li>
											<li class="listCreatTime"><a href="javascript:void(0);">创建时间</a></li>
											<li class="listGroupNum"><a href="javascript:void(0);">团号</a></li>
											<li class="listJourney"><a href="javascript:void(0);">行程</a></li>
											<li class="listPayment"><a href="javascript:void(0);">支付方式</a></li>
											<li class="listCurrency"><a href="javascript:void(0);">货币</a></li>
											<li class="listProfit"><a href="javascript:void(0);">利润</a></li>
											<li class="listPrice"><a href="javascript:void(0);">价格</a></li>
											<li class="listCost"><a href="javascript:void(0);">成本(准备金/报账)</a></li>
											<li class="listDiscount "><a href="javascript:void(0);">折扣</a></li>
										</ul>
										<ul class="tabList tabListDetail">
											<li>
												<dl class="callout_button">
												<dd class="listNum"><a href="javascript:void(0);">124</a></dd>
												<dd class="listCreatTime"><a href="javascript:void(0);">2018-05-11</a></dd>
												<dd class="listGroupNum"><a href="javascript:void(0);">FGOEGLTI</a></dd>
												<dd class="listJourney"><a href="javascript:void(0);"></a></dd>
												<dd class="listPayment"><a href="javascript:void(0);"></a></dd>
												<dd class="listCurrency"><a href="javascript:void(0);"></a></dd>
												<dd class="listProfit"><a href="javascript:void(0);"></a></dd>
												<dd class="listPrice"><a href="javascript:void(0);"></a></dd>
												<dd class="listCost"><a href="javascript:void(0);"></a></dd>
												<dd class="listDiscount"><a href="javascript:void(0);"></a></dd>
												</dl>
											</li>
										</ul>
									</div>
									<!--tab   e-->
									<!--end-->
									<div class="nav-box eg">
										<ul class="pagination m-style" id="p3"></ul>
									</div>
								</form>
								<!--弹出的表单    s-->
								<div class="dialog_content">
									<div class="groupMsg addInfo updateDialog dialog move_part" id="dialog">
										<ul class="formAction">
												<li class="amendOrder amend-tabInfo">
													<a href="javascript:void(0);" id="updateConfirm">
														确认修改
													</a>
												</li>
												<li class="amendOrder confirm-tabInfo">
													<a href="javascript:void(0);" id="updateAndDownloadConfirm">
														确认并下载
													</a>
												</li>
												<li class="deleteOrder delete-tabInfo">
													<a href="javascript:void(0);" id="deleteConfirm">
														删除订单
													</a>
												</li>
											</ul>
										<form class="addlist updateForm" id="updateForm">
											<div class="cardLeft nm-left">
												<label class="markMsg"><i></i>出团信息</label>
												<ul class="add-msg">
													<li>
														<label class="nm-left">团号</label>
														<input type="text" id="updateGroupNum">
													</li>
													<li>
														<label class="nm-left">航班号</label>
														<input type="text" id="updateFlightNumber">
													</li>
													<li>
														<label class="nm-left">巴士公司</label>
														<input type="text" id="updateBusCompany">
													</li>
													<li>
														<label class="nm-left">销售人员</label>
														<input id="updateSalesperson" type="text" placeholder="Search...">
													</li>
													<li>
														<label class="nm-left">导游</label>
														<input id="updateTouristGuide" type="text" placeholder="Search...">
													</li>
													<li>
														<label class="nm-left">导游电话</label>
														<input type="text" id="updateGuideTel" disabled="disabled" value="123123">
													</li>
													<li>
														<label class="nm-left">代理商</label>
														<input type="text" id="updateAgency">
													</li>
													<li>
														<label class="nm-left">来源</label>
														<input id="updateSource" type="text" placeholder="Search...">
													</li>
													<li>
														<label class="nm-left ">领队人数</label>
														<input type="text" class="updateLeaderNum" id="upadteLeaderNum">
													</li>
													<li>
														<label class="nm-left ">游客人数</label>
														<input type="text" class="updateVisitorNum" id="updateVisitorNum">
													</li>
													<li>
														<label class="nm-left">备注</label>
														<textarea rows="5" id="updateNote"></textarea>
													</li>

												</ul>
											</div>
											<div class="cardRight nm-left info-date">
												<label class="markMsg"><i></i>日期信息</label>
												<ul class="add-msg">
													<li>
														<label class="nm-left">出发日期</label>
														<input type="date" id="updateStartTime">
													</li>
													<li>
														<label class="nm-left">结束日期</label>
														<input type="date" id="updateEndTime">
													</li>
													<li>
														<label class="nm-left">天数</label>
														<input type="text" id="updateDayCount">
													</li>
												</ul>
											</div>
											<div class="cardRight nm-left info-price">
												<label class="markMsg"><i></i>价格信息</label>
												<ul class="add-msg">
													<li>
														<label class="nm-left">货币</label>
														<select id="updateCurrency">
															<option value="USD">$ 美元</option>
															<option value="RMB">￥ 人民币</option>
														</select>
													</li>
													<li>
														<label class="nm-left">支付方式</label>
														<select id="updatePaymentType">
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
														<input type="text" id="updatePrice">
													</li>
													<li>
														<label class="nm-left">准备金</label>
														<input type="text" id="updateReserve">
													</li>
													<li>
														<label class="nm-left">报账</label>
														<input type="text" class="bill" id="updateWriteOff">
													</li>
													<li>
														<label class="nm-left">总花费</label>
														<input type="text" id="updateTotalCost">
													</li>
													<!--折扣添加    s-->
													<li class="discountCard">
														<label class="nm-left">折扣</label>
														<dl class="discountOption" id="groupDiscountOption_update">
															<dd class="discount-code">
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
																<input type="text" id="groupDiscountText_update">
															</dd>
															<dd class="discount-apply">
																<a href="javascript:void(0);" class="discountApply" id="groupDiscountApply_update">
																	Apply
																</a>
															</dd>
														</dl>
														<dl class="discountNotice nm-hide" id="groupDiscountNotice_update">
															<dd>
																<span id="groupSubtractNum_update"></span>
															</dd>
														</dl>
													</li>
													<!--折扣添加    e-->
												</ul>
											</div>
											<div class="fundMsg updateFundMsg nm-hide">
												<ul>
													<li>
														<label>午餐</label>
														<input type="text" value="6" id="updateLunch" />
													</li>
													<li>
														<label>晚餐</label>
														<input type="text" value="10" id="updateDinner" />
													</li>
													<li>
														<label>天数</label>
														<input type="text" class="msgDayNum" disabled="disabled" />
													</li>
													<li>
														<label>出发日期</label>
														<input type="text" class="msgStartTime" />
													</li>
													<li>
														<label>总人数</label>
														<input type="text" placeholder="6" id="msgPeopleCount" disabled="disabled" />
													</li>
													<li style="height: 34px;">
														<a class="proTab" id="updateProTab">
															生成报表
														</a>
													</li>
												</ul>
											</div>
											<!-- 准备金 -->
											<div class="updateUserCard nm-hide userTab">
												<ul class="updateUserTab" id="updateUserTab"></ul>
												<ul class="dtip driverTip">
													<li class="updateDriverTipItem"></li>
												</ul>
											</div>
										</form>

										<div class="button close_button" id="close">
											<a href="#">
												<img src="../img/close.png" />
											</a>
										</div>
									</div>
								</div>
								<!--弹出的表单    e-->
								<?php
									include('../noResultBox.php');
									$confirmBoxClass = 'updateEditConfirmBox';
									$confirmButtonClass = 'updateEditActionConfirm';
									$cancelButtonClass = 'updateEditActionCancel';
									include('../confirmInfo.php');
									$confirmBoxClass = 'updateAndDownloadConfirmBox';
									$confirmButtonClass = 'updateAndDownloadActionConfirm';
									$cancelButtonClass = 'updateAndDownloadActionCancel';
									include('../confirmInfo.php');
									$confirmBoxClass = 'updateDeleteConfirmBox';
									$confirmButtonClass = 'updateDeleteActionConfirm';
									$cancelButtonClass = 'updateDeleteActionCancel';
									include('../confirmInfo.php');
								 ?>
							</div>
							<!--更新      e-->
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="../js/jquery.min.js" type="text/javascript"></script>
		<script src="../js/jquery.pagination.js" type="text/javascript"></script>
		<script src="../js/homePage/public.js" type="text/javascript"></script>
		<script src="../js/homePage/groupTourUpdate.js" type="text/javascript"></script>
		<script src="../js/homePage/businessUpdate.js" type="text/javascript"></script>
		<script type="text/javascript">
			dateRange();
			dragForm();
			dateTimeCalculate($("#updateStartTime"),$("#updateEndTime"),$("#updateDayCount"));
			//独立团更新点击准备金生成报表
			updateCashReport($("#updateReserve"),$(".updateLeaderNum"),$(".updateVisitorNum"),$(".updateFundMsg"),$(".msgDayNum"),$(".msgStartTime"),$("#msgPeopleCount"), $("#updateStartTime"),$("#updateEndTime"),$("#updateDayCount"));
			actionForm($(".clearInfo"),$(".deleteOrder"),$(".amendOrder"),$("#dialog"));
			tourDiscount($("#groupDiscountText_update"), $("#groupDiscountNotice_update"), $("#groupDiscountApply_update"), $("#groupSubtractNum_update"), $("#groupDiscountOption_update"));
		</script>
	</body>
</html>
