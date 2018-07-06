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
		<title>机票更新界面</title>
		<link href="../css/airTicket.css" type="text/css" rel="stylesheet" />
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
									<a href="../IndividualTour/IndividualTourCreate.php">
										<label></label> 散拼团
									</a>
								</dd>
								<dd>
									<a href="javascript:void(0);" class="lab-active">
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
				<!--左侧导航   e-->
				<!--右侧内容   s-->
				<div class="theamInfo nm-right">
					<div class="showMsg yewuMsg">
						<div class="floor">
							<!--右侧导航   s-->
							<div class="navGroup">
								<ul>
									<li class="addItem">
										<a href="AirTicketCreate.php" class="btn  createOrderButton">
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
							<!--机票更新   s-->
							<div class="groupMsg updateInfo">
								<label class="theamTitle">
									<i></i>
									筛选条件
								</label>
								<form>
									<ul class="filterBox">
										<li class="datePicker">
											<label>订单创建时间</label>
											<select id="airticket-update-date-filter">
												<option value="customized">Customized</option>
												<option value="1">本日</option>
												<option value="30" selected>最近30天</option>
												<option value="90">最近3个月</option>
												<option value="180">最近半年</option>
											</select>
											<dl class="selectRange nm-hide">
												<dd>
													<i>From</i>
													<input type="date" id="airticket-update-from-date" />
												</dd>
												<dd>
													<i>To</i>
													<input type="date" id="airticket-update-to-date" />
												</dd>
											</dl>
										</li>
										<li class="optionItem">
											<label>订单号</label>
											<input type="text" id="airticket-update-transaction-id-filter" />
										</li>
										<li class="optionItem">
											<label>定位</label>
											<input type="text" id="airticket-update-locator-filter" />
											<dl class="confirmMsg">
												<dd><a href="javascript:void(0);" id="airticket-update-filter">确认</a></dd>
												<dd><a href="javascript:void(0);" id="airticket-update-reset">重置</a></dd>
											</dl>
										</li>
									</ul>
									<!--tab  s-->
									<div class="updateTab airTicketUpdateTab individualUpdateTab">
										<ul class="tabList tabListTitle">
											<li class="listNum"><a href="javascript:void(0);">#</a></li>
											<li class="listCreatTime"><a href="javascript:void(0);">创建时间</a></li>
											<li class="listLocation"><a href="javascript:void(0);">定位</a></li>
											<li class="listInvoice"><a href="javascript:void(0);">INVOICE</a></li>
											<li class="listPayment"><a href="javascript:void(0);">支付方式</a></li>
											<li class="listCurrency"><a href="javascript:void(0);">货币</a></li>
											<li class="listProfit"><a href="javascript:void(0);">利润</a></li>
											<li class="listPrice"><a href="javascript:void(0);">价格</a></li>
											<li class="listReturnCash"><a href="javascript:void(0);">返现</a></li>
											<li class="listCost"><a href="javascript:void(0);">成本</a></li>
											<li class="listDiscount"><a href="javascript:void(0);">折扣</a></li>
										</ul>
										<ul class="tabList tabListDetail">
											<li>
												<dl class="callout_button_plane">
													<dd class="listNum"><a href="javascript:void(0);"></a></dd>
													<dd class="listCreatTime"><a href="javascript:void(0);"></a></dd>
													<dd class="listLocation"><a href="javascript:void(0);"></a></dd>
													<dd class="listInvoice"><a href="javascript:void(0);"></a></dd>
													<dd class="listPayment"><a href="javascript:void(0);"></a></dd>
													<dd class="listCurrency"><a href="javascript:void(0);"></a></dd>
													<dd class="listProfit"><a href="javascript:void(0);"></a></dd>
													<dd class="listPrice"><a href="javascript:void(0);"></a></dd>
													<dd class="listReturnCash"><a href="javascript:void(0);"></a></dd>
													<dd class="listCost"><a href="javascript:void(0);"></a></dd>
													<dd class="listDiscount"><a href="javascript:void(0);"></a></dd>
												</dl>
											</li>
										</ul>
									</div>
									<!--tab  e-->
									<div class="nav-box eg">
										<ul class="pagination m-style" id="airticket-pagination"></ul>
									</div>
								</form>
								<!--弹出的表单   s-->

								<div class="dialog_content">
									<div class="groupMsg addInfo updateDialog dialog move_part dialog-plane" id="airticket-dialog">
										<ul class="formAction">
											<li class="amendOrder2 amend-tabInfo">
												<a href="javascript:void(0);" id="updateConfirm">
													确认修改
												</a>
											</li>
											<li class="deleteOrder2 delete-tabInfo">
												<a href="javascript:void(0);" id="deleteConfirm">
													删除订单
												</a>
											</li>
										</ul>
										<form class="addlist updateForm" id="createIndivTourForm">
											<!--06-14修改 s-->
											<div class="cardLeft itineraryInfo">
												<label class="markMsg"><i></i>Itinerary</label>
												<div class="airticketInfo">
													<!--<input type="text" />-->
													<textarea></textarea>
													<div class="btnArea">
														<a href="javascript:void(0);">确定</a>
														<a href="javascript:void(0);">清空</a>
													</div>
												</div>
											</div>
											<!--06-14修改 e-->
											<div class="cardLeft nm-left cardLeft-individual">
												<label class="markMsg"><i></i>基本信息</label>
												<!--06/12修改 s-->
												<!--<div class="airticketInfo">
													<input type="text" />
													<a href="javascript:void(0);">确定</a>
												</div>-->
												<!--06/12修改 e-->

												<ul class="add-msg add-msg-individual-left">
													<!--<li>
														<label class="nm-left">航班号</label>
														<input type="text" id="update-flight-number">
													</li>-->
													<li>
														<label class="nm-left">销售人员</label>
														<input id="update-salesperson" type="text" placeholder="Search...">
													</li>
													<li>
														<label class="nm-left">机票定位</label>
														<input type="text" id="update-locator">
													</li>
													<li>
														<label class="nm-left">INVOICE</label>
														<input type="text" />
													</li>
													<li class="ticket-theam ">
														<label class="nm-left">往返</label>
														<dl class="ticket-option flightCodeNav">
															<dd class="option-active  roundTripItem" id="air-ticket-create-round-trip">往返</dd>
															<dd class="singleTripItem">单程</dd>
														</dl>
													</li>
													<li class="ticket-theam">
														<label class="nm-left">团散</label>
														<dl class="ticket-option">
															<dd class="update-group" id="update-ticket-type">团票</dd>
															<dd class="update-individual">散票</dd>
														</dl>
													</li>
													<!--<li>
														<label class="nm-left">航班号</label>
														<input type="text" id="air-ticket-create-flight-code" class="singleTripInfo"/>
														<div class="roundTripInfo">
															<input type="text" />
															<input type="text" />
														</div>
													</li>-->
													<li class="ticket-theam">
														<label class="nm-left">人数</label>
														<dl class="people-count">
															<dd>成人<input type="text" value="0" id="update-adult-number" class="nm-right"/></dd>
															<dd>儿童<input type="text" value="0" id="update-children-number" class="nm-right"/></dd>
															<dd>婴儿<input type="text" value="0" id="update-infant-number" class="nm-right"/></dd>
														</dl>
													</li>
													<li>
														<label class="nm-left">总人数</label>
														<input type="text" id="update-total-number" disabled>
													</li>
													<li>
														<label class="nm-left">来源</label>
														<input type="text" id="update-source" placeholder="Search..." />
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
														<label class="nm-left">旅途1</label>
														<div class="tour">
														 	<input type="text" placeholder="出发时间"  class="startTime"/>
															<input type="text" placeholder="机场"  class="airport"/>
															<span class="tourText">至</span>
															<input type="text"  placeholder="机场" class="airport"/>
														</div>
													</li>
													<li>
														<label class="nm-left">旅途2</label>
														<div class="tour">
														 	<input type="text" placeholder="出发时间"  class="startTime"/>
															<input type="text" placeholder="机场"  class="airport"/>
															<span class="tourText">至</span>
															<input type="text"  placeholder="机场" class="airport"/>
														</div>
													</li>
													<li>
														<label class="nm-left">旅途3</label>
														<div class="tour">
														 	<input type="text" placeholder="出发时间"  class="startTime"/>
															<input type="text" placeholder="机场"  class="airport"/>
															<span class="tourText">至</span>
															<input type="text"  placeholder="机场" class="airport"/>
														</div>
													</li>
												</ul>
											</div>
											<div class="cardRight nm-left info-price info-price-individual">
												<label class="markMsg"><i></i>价格信息</label>
												<ul class="add-msg">
													<li>
														<label class="nm-left">货币</label>
														<select id="update-currency">
															<option value="USD">$ 美元</option>
															<option value="RMB">￥ 人民币</option>
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
													</li>
													<li>
														<label class="nm-left">成本价</label>
														<input type="text" id="update-cost">
													</li>
													<li>
														<label class="nm-left">机票价格</label>
														<input type="text" id="update-receive1">
													</li>
													<li>
														<label class="nm-left">返现</label>
														<input type="text" id="update-receive2">
													</li>
													<li class="discountCard">
														<label class="nm-left">折扣</label>
														<dl class="discountOption" id="airTicketDiscountOption_update">
															<dd class="option-active discount-code"><a href="javascript:void(0);">折扣码</a></dd>
															<dd class="coupon"><a href="javascript:void(0);">折扣金额</a></dd>
														</dl>
														<dl class="exchange">
															<dd class="discount-text">
																<input type="text" id="airTicketDiscountText_update">
															</dd>
															<dd class="discount-apply">
																<a href="javascript:void(0);" class="discountApply" id="airTicketDiscountApply_update">
																	Apply
																</a>
															</dd>
														</dl>
														<dl class="discountNotice nm-hide" id="airTicketDiscountNotice_update">
															<dd><span id="airTicketSubtractNum_update"></span></dd>
														</dl>
													</li>
												</ul>
											</div>
											<!--更新界面的客户信息    s-->
											<div class="split" >
												<hr />
											</div>
											<!--客户信息   s-->
											<div class="addClients customerInfo air-customer clientsInfoBox">
												<ul class="clients-title">
													<li><a>基本信息</a></li>
													<li><a>客户信息</a></li>
												</ul>
												<ul class="clients-info">
													<li>
														<dl>
															<dd class="pname">
																<label>姓</label>
																<input type="text" id="update-customer-lname">
															</dd>
															<dd class="pname">
																<label>名</label>
																<input type="text" id="update-customer-fname">
															</dd>
															<dd>
																<label>电话</label>
																<input type="text" id="update-customer-phone">
															</dd>
															<dd>
																<label>其他联系方式</label>
																<select id="update-customer-otherContact">
																	<option value="WeChat">WeChat</option>
																	<option value="QQ">QQ</option>
																	<option value="Facebook">Facebook</option>
																</select>
															</dd>
															<dd>
																<label id="update-customer-otherContactLabel">WeChat账号</label>
																<input type="text" id="update-customer-otherContactNumber">
															</dd>
														</dl>
													</li>
													<li class="last-info">
														<dl>
															<dd class="birthday">
																<label>生日</label>
																<input type="date" id="update-customer-birthday">
															</dd>
															<dd class="gender">
																<label>性别</label>
																<select id="update-customer-gender">
																	<option value="UNKNOWN">Unknown</option>
																	<option value="M">男</option>
																	<option value="F">女</option>
																</select>
															</dd>
															<dd>
																<label>邮箱</label>
																<input type="text" id="update-customer-email">
															</dd>
															<dd class="zipCode">
																<label>邮政编码</label>
																<input type="text" id="update-customer-zipcode">
															</dd>
														</dl>
													</li>
												</ul>
											</div>
										</form>
										<div class="button close_button close_button-plane" id="close">
											<a href="#">
												<img src="../img/close.png" />
											</a>
										</div>
									</div>
								</div>
								<!--弹出的表单   e-->
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
							<!--机票更新   e-->
						</div>
					</div>
				</div>
				<!--右侧内容   e-->
			</div>
			<!--主内容区   e-->
		</div>
		<script src="../js/jquery.min.js" type="text/javascript"></script>
		<script src="../js/homePage/public.js" type="text/javascript"></script>
		<script src="../js/Business/AirTicket/airTicketUpdate.js" type="text/javascript"></script>
		<script src="../js/jquery.pagination.js" type="text/javascript"></script>
		<script src="../js/homePage/businessUpdate.js" type="text/javascript"></script>
		<script src="../js/homePage/AirTicket.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(function(){
				dateRange();
				dragAirBox();
				//机票-总人数
				headCount();
				airTicketOption();//单程往返
				tourDiscount($("#airTicketDiscountText_update"), $("#airTicketDiscountNotice_update"), $("#airTicketDiscountApply_update"), $("#airTicketSubtractNum_update"), $("#airTicketDiscountOption_update"));
				autoCenterBox($(".customerInfo.addClients"));
				//06-12修改
				$(".airticketInfo").find("a").on("mousedown",function(){
					$(this).addClass("selected");
				});
				$(".airticketInfo").find("a").on("mouseup",function(){
					$(this).removeClass("selected");
				});
				$(".airticketInfo").find("a:last").on("click",function(){
					$(this).parent().parent().find("textarea").val("");
				});
			});
		</script>
	</body>
</html>
