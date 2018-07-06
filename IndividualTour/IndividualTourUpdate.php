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
		<title>散拼团更新界面</title>
		<link href="../css/individualTour.css" type="text/css" rel="stylesheet" />
		<link href="../css/style.css" type="text/css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="../css/pagination.css"/>
		<link rel="stylesheet" type="text/css" href="../css/businessUpdate.css" />
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
			<!--header e-->
			<!--主内容区    s-->
			<div class="msContent">
				<!--左侧导航    s-->
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
									<a href="../GroupTour/GroupTourCreate.php">
										<label></label> 独立团
									</a>
								</dd>
								<dd>
									<a href="javascript:void(0);" class="lab-active">
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
				<!--左侧导航    e-->
				<!--右侧内容    s-->
				<div class="theamInfo nm-right">
					<div class="showMsg yewuMsg">
						<div class="floor">
							<!--右侧导航   s-->
							<div class="navGroup">
								<ul>
									<li class="addItem">
										<a href="IndividualTourCreate.php" class="btn  createOrderButton">
											<img src="../img/c_add.png">
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
							<!--右侧导航   e-->
							<!--散拼团更新   s-->
							<div class="groupMsg updateInfo">
								<label class="theamTitle">
									<i></i>
									筛选条件
								</label>
								<form>
									<ul class="filterBox">
										<li class="datePicker">
											<label>订单创建时间</label>
											<select id="individual-update-date-filter">
												<option value="customized">Customized</option>
												<option value="1">本日</option>
												<option value="30" selected>最近30天</option>
												<option value="90">最近3个月</option>
												<option value="180">最近半年</option>
											</select>
											<dl class="selectRange nm-hide">
												<dd>
													<i>From</i>
													<input type="date" id="individual-update-from-date" />
												</dd>
												<dd>
													<i>To</i>
													<input type="date" id="individual-update-to-date" />
												</dd>
											</dl>
										</li>
										<li class="optionItem">
											<label>订单号</label>
											<input type="text" id="individual-update-transaction-id-filter" />
										</li>
										<li class="optionItem">
											<label>团号</label>
											<input type="text" id="individual-update-product-code-filter" />
											<dl class="confirmMsg">
												<dd><a href="javascript:void(0);" id="individual-tour-update-filter">确认</a></dd>
												<dd><a href="javascript:void(0);" id="individual-tour-update-reset">重置</a></dd>
											</dl>
										</li>
									</ul>
									<!--tab  s-->
									<div class="updateTab individualUpdateTab">
										<ul class="tabList tabListTitle">
											<li class="listNum"><a href="javascript:void(0);">#</a></li>
											<li class="listCreatTime"><a href="javascript:void(0);">创建时间</a></li>
											<li class="listGroupNum"><a href="javascript:void(0);">团号</a></li>
											<li class="listSales"><a href="javascript:void(0);">销售商</a></li>
											<li class="listJourney"><a href="javascript:void(0);">行程</a></li>
											<li class="listPayment"><a href="javascript:void(0);">支付方式</a></li>
											<li class="listCurrency"><a href="javascript:void(0);">货币</a></li>
											<li class="listProfit"><a href="javascript:void(0);">利润</a></li>
											<li class="listPrice"><a href="javascript:void(0);">价格</a></li>
											<li class="listCost"><a href="javascript:void(0);">成本</a></li>
											<li class="listDiscount "><a href="javascript:void(0);">折扣</a></li>
										</ul>
										<ul class="tabList tabListDetail">
											<li>
												<dl class="callout_button2">
													<dd class="listNum"><a href="javascript:void(0);">124</a></dd>
													<dd class="listCreatTime"><a href="javascript:void(0);">2018-05-11</a></dd>
													<dd class="listGroupNum"><a href="javascript:void(0);">FGOEGLTI</a></dd>
													<dd class="listSales"><a href="javascript:void(0);"></a></dd>
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
									<!--tab  e-->
									<div class="nav-box eg">
										<ul class="pagination m-style" id="p4"></ul>
									</div>
								</form>
								<!--弹出的表单    s-->
								<div class="dialog_content">
									<div class="groupMsg addInfo updateDialog dialog move_part" id="dialog2">
										<ul class="formAction">
											<li class="amendOrder amend-tabInfo">
												<a href="javascript:void(0);" id="updateConfirm">
													确认修改
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
												<label class="markMsg"><i></i>基本信息</label>
												<ul class="add-msg">
													<li>
														<label class="nm-left">团号</label>
														<input type="text" id="update-product-code">
													</li>
													<li>
														<label class="nm-left">团名</label>
														<input type="text" id="update-tour-name">
													</li>
													<li>
														<label class="nm-left">销售人员</label>
														<input id="update-salesperson" type="text" placeholder="Search...">
													</li>
													<li>
														<label class="nm-left">零售商</label>
														<input id="update-wholesaler" type="text" placeholder="Search...">
													</li>
													<li>
														<label class="nm-left">参团人数</label>
														<input type="text" id="update-indiv-number">
													</li>
													<li>
														<label class="nm-left">来源</label>
														<input id="update-source" type="text" placeholder="Search...">
													</li>
													<li>
														<label class="nm-left">备注</label>
														<textarea rows="5" id="update-note"></textarea>
													</li>
												</ul>
											</div>
											<div class="cardRight nm-left info-date">
												<label class="markMsg"><i></i>行程安排</label>
												<ul class="add-msg">
													<li>
														<label class="nm-left">出发日期</label>
														<input type="date" id="update-start-date">
													</li>
													<li>
														<label class="nm-left">结束日期</label>
														<input type="date" id="update-end-date">
													</li>
													<li>
														<label class="nm-left">天数</label>
														<input type="text" id="update-day-count">
													</li>
												</ul>
											</div>
											<div class="cardRight nm-left info-price">
												<label class="markMsg"><i></i>财务信息</label>
												<ul class="add-msg">
													<!--<li>
														<label class="nm-left">货币</label>
														<select id="update-currency">
															<option value="USD">$ 美元</option>
															<option value="RMB">￥人民币</option>
														</select>
													</li>
													<li>
														<label class="nm-left">付款方式</label>
														<select id="update-payment-type">
															<option value="creditCard">Credit Card</option>
															<option value="mco">MCO</option>
															<option value="alipay">Alipay</option>
															<option value="wechat">WeChat</option>
															<option value="cash">Cash</option>
															<option value="check">Check</option>
															<option value="other">Other</option>
														</select>
													</li>-->
													<li class="exchangeRate">
														<label class="nm-left">当前汇率</label>
														<span>1&nbsp;美元&nbsp;=&nbsp;<input type="text"  placeholder="6.40"/>&nbsp;人民币</span>
													</li>
													<li>
														<label class="nm-left">总花费</label>
														<input type="text" id="update-total-cost">
													</li>
													<!--<li>
														<label class="nm-left">收到金额</label>
														<input type="text" id="update-receive">
													</li>
													<li class="discountCard">
														<label class="nm-left">折扣</label>
														<dl class="discountOption" id="indivDiscountOption_update">
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
																<input type="text" id="indivDiscountText_update">
															</dd>
															<dd class="discount-apply">
																<a href="javascript:void(0);" class="discountApply" id="indivDiscountApply_update">
																	Apply
																</a>
															</dd>
														</dl>
														<dl class="discountNotice nm-hide" id="indivDiscountNotice_update">
															<dd>
																<span id="indivSubtractNum_update"></span>
															</dd>
														</dl>
													</li>-->
												</ul>
											</div>
											<!--更新界面的客户信息    s-->
											<div class="split" id="customerInfoAreaDivider" hidden>
												<hr />
											</div>
											<a href="javascript:void(0);" class="addClients_update nm-left">添加客户</a>
											<div class="addClients" id="customerInfoArea" hidden>
												<div class="updateInfo">
													<ul class="reportInfo customerInfo" id="customerInfo">
														<li class="reportTitle customerInfoTitle">
															<dl>
																<dd>客户</dd>
																<dd>邮箱</dd>
																<dd>电话</dd>
																<dd>其他联系方式</dd>
																<dd>邮编</dd>
																<dd>参团</dd>
																<dd>离团</dd>
																<dd>注意事项</dd>
															</dl>
														</li>
													</ul>
												</div>
											</div>
											<div class="addClients customerInfo">
												<div class="button close_button " id="closeAddBox">
													<a href="#"><img src="../img/close.png"></a>
												</div>
												<ul class="clients-title">
													<li><a>基本信息</a></li>
													<li><a>客户信息</a></li>
													<li><a>旅游信息</a></li>
												</ul>
												<ul class="clients-info indiviClientInfo">
													<li>
														<dl>
															<dd class="pname">
																<label>姓</label>
																<input type="text" id="add-customer-lname">
															</dd>
															<dd class="pname">
																<label>名</label>
																<input type="text" id="add-customer-fname">
															</dd>
															<dd>
																<label>电话</label>
																<input type="text" id="add-customer-phone">
															</dd>
															<dd>
																<label>其他联系方式</label>
																<select id="add-customer-other-contact">
																	<option value="WeChat">WeChat</option>
																	<option value="QQ">QQ</option>
																	<option value="Facebook">Facebook</option>
																</select>
															</dd>
															<dd>
																<label id="add-customer-other-contact-label">WeChat账号</label>
																<input type="text" id="add-customer-other-contact-number">
															</dd>
														</dl>
													</li>
													<li>
														<dl>
															<dd class="birthday">
																<label>生日</label>
																<input type="date" id="add-customer-birthday">
															</dd>
															<dd class="gender">
																<label>性别</label>
																<select id="add-customer-gender">
																	<option value="UNKNOWN">Unknown</option>
																	<option value="M">男</option>
																	<option value="F">女</option>
																</select>
															</dd>
															<dd>
																<label>邮箱</label>
																<input type="text" id="add-customer-email">
															</dd>
															<dd class="zipCode">
																<label>邮政编码</label>
																<input type="text" id="add-customer-zipcode">
															</dd>
															<dd class="otherMsg">
																<label>其他注意事项</label>
																<input type="text" id="add-customer-note">
															</dd>
														</dl>
													</li>
													<li class="last-info">
														<dl>
															<dd class="joinDate">
																<label>参团日期</label>
																<input type="date" id="add-customer-join-date">
															</dd>
															<dd class="joinLocation">
																<label>参团地点</label>
																<input type="text" id="add-customer-join-location">
															</dd>
															<dd class="leaveDate">
																<label>离团日期</label>
																<input type="date" id="add-customer-leave-date">
															</dd>
															<dd class="leaveLocation">
																<label>离团地点</label>
																<input type="text" id="add-customer-leave-location">
															</dd>

															<!--06/11修改-->

															<dd>
																<label>货币</label>
																<select>
																	<option>美元</option>
																	<option>人民币</option>
																</select>
															</dd>
															<dd>
																<label>支付方式</label>
																<select>
																	<option value="creditcard">Credit Card</option>
																	<option value="mco">MCO</option>
																	<option value="alipay">Alipay</option>
																	<option value="wechat">WeChat</option>
																	<option value="cash">Cash</option>
																	<option value="check">Check</option>
																	<option value="other">Other</option>
																	<option value="multiple">Multiple</option>
																</select>
															</dd>
															<dd>
																<label>价格</label>
																<input type="text" />
															</dd>
															<dd>
																<label>折扣</label>
																<!--<div style="display: inline-block;width: 36% !important;visibility: hidden; margin-left: 4% !important;"></div>-->
																<ul class="add-msg">
																	<li class="discountCard">
																		<dl class="discountOption" id="indivTourDiscountOption">
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
																				<input type="text"  id="indivTourDiscountText"/>
																			</dd>
																			<dd class="discount-apply">
																				<a href="javascript:void(0);" class="discountApply" id="indivTourDiscountApply">
																					Apply
																				</a>
																			</dd>
																		</dl>
																		<dl class="discountNotice nm-hide" id="indivTourDiscountNotice">
																			<dd>
																				<span id="indivTourSubtractNum"></span>
																			</dd>
																		</dl>
																	</li>
																</ul>
															</dd>



														</dl>
													</li>
												</ul>
												<p class="confirmAdd"><a href="javascript:void(0);" id="add-customer-confirm">确认添加</a></p>
												<p class="confirmAmend nm-hide"><a href="javascript:void(0);" id="update-customer-confirm">确认修改</a></p>
											</div>
											<!--更新界面的客户信息   e-->
										</form>
										<div class="button close_button close_button2" id="close">
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

									$confirmBoxClass = 'updateDeleteConfirmBox';
									$confirmButtonClass = 'updateDeleteActionConfirm';
									$cancelButtonClass = 'updateDeleteActionCancel';
									include('../confirmInfo.php');
								 	?>
							</div>
							<!--散拼团更新   e-->
						</div>
					</div>
				</div>
				<!--右侧内容    e-->
			</div>
			<!--主内容区    e-->
		</div>
		<script src="../js/jquery.min.js" type="text/javascript"></script>
		<script src="../js/homePage/public.js" type="text/javascript"></script>
		<script type="text/javascript">
			var customer_index = 0;
			var individual_tour_id = 0;
			var individualTourCustomerList = [];
			var updateCustomerList = [];
			var addCustomerList = [];
			var deleteCustomerList = [];
		</script>
		<script src="../js/Business/IndividualTour/individualTourUpdate.js" type="text/javascript"></script>
		<script src="../js/jquery.pagination.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(function(){
				dateRange();
				dragForm2();
				tourDiscount($("#indivDiscountText_update"), $("#indivDiscountNotice_update"), $("#indivDiscountApply_update"), $("#indivSubtractNum_update"), $("#indivDiscountOption_update"));
				addClients();
				dateTimeCalculate($("#update-start-date"),$("#update-end-date"),$("#update-day-count"));
				tourDiscount($("#indivTourDiscountText"), $("#indivTourDiscountNotice"), $("#indivTourDiscountApply"), $("#indivTourSubtractNum"), $("#indivTourDiscountOption"));
				autoCenterBox($("#dialog2"));
				$(document).scroll(function(){
					var winScrollTop = $(window).scrollTop();
					if(winScrollTop > 90) {
						$("#dialog2").css({
							"top":"50px",
							"margin-top":"0px"
						});
						$(".addClients.customerInfo").css("top","10%");
					} else {
						autoCenterBox($("#dialog2"));
						autoCenterBox($(".addClients.customerInfo"));
					}
				});
			});
		</script>
	</body>
</html>
