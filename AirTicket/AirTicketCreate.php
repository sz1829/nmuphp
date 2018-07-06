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
		<title>后台管理系统（机票添加页面）</title>
		<link href="../css/airTicket.css" type="text/css" rel="stylesheet" />
		<link href="../css/style.css" type="text/css" rel="stylesheet" />
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
			<!--content s-->
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
									<a href="../IndividualTour/IndividualTourCreate.php" >
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
				<!--左侧导航    e-->
				<!--右侧内容    s-->
				<div class="theamInfo nm-right">
					<div class="showMsg yewuMsg">
						<div class="floor planeTickets">
							<!--右侧导航     s-->
							<div class="navGroup">
								<ul>
									<li class="addItem card-active">
										<a href="javascript:void(0)" class="btn ms-active createOrderButton">
											<img src="../img/add.png">
											添<i>隐藏</i>加
										</a>
									</li>
									<li class="updateItem">
										<a href="AirTicketUpdate.php" class="btn updateOrderButton">
											<img src="../img/c_refresh.png">
											更<i>隐藏</i>新
										</a>
									</li>
								</ul>
							</div>
							<!--右侧导航     e-->
							<!--机票添加     s-->
							<div class="groupMsg addInfo airticketMsg airticketAddTab">
								<form class="addlist" id="createAirTicketForm">
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
										<!--<div class="airticketInfo">
											<input type="text" />
											<a href="javascript:void(0);">确定</a>
										</div>-->
										<ul class="add-msg add-msg-individual-left">
											<!--<li>
												<label class="nm-left">航班号</label>
												<input type="text" id="air-ticket-create-flight-code"/>
											</li>-->
											<li>
												<label class="nm-left">销售人员</label>
												<input id="airticket_salesperson" type="text" placeholder="Search...">
											</li>
											<li>
												<label class="nm-left">机票定位</label>
												<input type="text" id="air-ticket-create-locator"/>
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
													<dd class="option-active" id="air-ticket-create-ticket-type">团票</dd>
													<dd>散票</dd>
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
													<dd>成人<input type="text" value="0" id="air-ticket-create-adult-number" class="nm-right"/></dd>
													<dd class="item">儿童<input type="text" value="0" id="air-ticket-create-children-number" class="nm-right"/></dd>
													<dd class="item">婴儿<input type="text" value="0" id="air-ticket-create-baby-number" class="nm-right"/></dd>
												</dl>
											</li>
											<li>
												<label class="nm-left">总人数</label>
												<input type="text" value="0" id="air-ticket-create-total-number" disabled="disabled"/>
											</li>
											<li>
												<label class="nm-left">来源</label>
												<input type="text" id="airticket_source" placeholder="Search..." />
											</li>
											<li>
												<label class="nm-left">备注</label>
												<textarea rows="5" id="air-ticket-create-note"></textarea>
											</li>
										</ul>
									</div>
									<div class="cardRight nm-left info-date">
										<label class="markMsg"><i></i>行程安排</label>
										<ul class="add-msg">
											<!--<li>
												<label class="nm-left">旅途1</label>
												<div class="tourMsg">
													<input type="text"  />
													<input type="date" />
													<input type="text"  />
													<input type="date" />
												</div>
											</li>
											<li>
												<label class="nm-left">旅途2</label>
												<div class="tourMsg">
													<input type="text"  />
													<input type="date" />
													<input type="text"  />
													<input type="date" />
												</div>
											</li>
											<li>
												<label class="nm-left">旅途3</label>
												<div class="tourMsg">
													<input type="text"  />
													<input type="date" />
													<input type="text"  />
													<input type="date" />
												</div>
											</li>-->
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
												<select id="air-ticket-create-currency">
													<option value="USD">$ 美元</option>
													<option value="RMB">￥ 人民币</option>
												</select>
											</li>
											<li>
												<label class="nm-left">付款方式</label>
												<select id="air-ticket-create-payment-type">
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
												<label class="nm-left">成本价</label>
												<input type="text" id="air-ticket-create-expense"/>
											</li>
											<li>
												<label class="nm-left">机票价格</label>
												<input type="text" id="air-ticket-create-price"/>
											</li>
											<li>
												<label class="nm-left">返现</label>
												<input type="text" id="air-ticket-create-received2"/>
											</li>
											<li class="discountCard">
												<label class="nm-left">折扣</label>
												<dl class="discountOption" id="airTicketDiscountOption">
													<dd class="option-active discount-code"><a href="javascript:void(0);">折扣码</a></dd>
													<dd class="coupon"><a href="javascript:void(0);">折扣金额</a></dd>
												</dl>
												<dl class="exchange">
													<dd class="discount-text">
														<input type="text" id="airTicketDiscountText" />
													</dd>
													<dd class="discount-apply">
														<a href="javascript:void(0);" class="discountApply" id="airTicketDiscountApply">
															Apply
														</a>
													</dd>
												</dl>
												<dl class="discountNotice nm-hide" id="airTicketDiscountNotice">
													<dd><span id="airTicketSubtractNum"></span></dd>
												</dl>
											</li>
										</ul>
									</div>
									<div class="split">
										<hr />
									</div>
								</form>

								<form>
									<!--04/13  添加客户信息s-->
									<div class="addClients customerInfo air-customer">
										<ul class="clients-title">
											<li><a>基本信息</a></li>
											<li><a>客户信息</a></li>
										</ul>
										<ul class="clients-info">
											<li>
												<dl>
													<dd class="pname">
														<label>姓</label>
														<input type="text" id="ticket-create-customer-lastName"/>
													</dd>
													<dd class="pname">
														<label>名</label>
														<input type="text" id="ticket-create-customer-firstName"/>
													</dd>
													<dd>
														<label>电话</label>
														<input type="text" id="ticket-create-customer-phone"/>
													</dd>
													<dd>
														<label>其他联系方式</label>
														<select id="ticket-create-customer-otherContact">
															<option value="WeChat">WeChat</option>
															<option value="QQ">QQ</option>
															<option value="Facebook">Facebook</option>
														</select>
													</dd>
													<dd>
														<label id="ticket-create-customer-otherContactLabel">WeChat账号</label>
														<input type="text" id="ticket-create-customer-otherContactNumber"/>
													</dd>
												</dl>
											</li>
											<li class="last-info">
												<dl>
													<dd class="birthday">
														<label>生日</label>
														<input type="date" id="ticket-create-customer-birthday"/>
													</dd>
													<dd  class="gender">
														<label>性别</label>
														<select id="ticket-create-customer-gender">
															<option value="UNKNOWN">Unknown</option>
															<option value="M">男</option>
															<option value="F">女</option>
														</select>
													</dd>
													<dd>
														<label>邮箱</label>
														<input type="text" id="ticket-create-customer-email"/>
													</dd>
													<dd class="zipCode">
														<label>邮政编码</label>
														<input type="text" id="ticket-create-customer-zipcode"/>
													</dd>
												</dl>
											</li>
										</ul>
									</div>
									<div class="addClients customerInfo editcustomerInfo nm-hide air-customer">
										<a href="#" class="close-customer nm-right" id="plane-close-customer">
											<img src="../img/close.png">
										</a>
										<ul class="clients-title">
											<li><a>基本信息</a></li>
											<li><a>客户信息</a></li>
										</ul>
										<ul class="clients-info">
											<li>
												<dl>
													<dd class="pname">
														<label>姓</label>
														<input type="text" id="ticket-edit-customer-lastName"/>
													</dd>
													<dd class="pname">
														<label>名</label>
														<input type="text" id="ticket-edit-customer-firstName"/>
													</dd>
													<dd>
														<label>电话</label>
														<input type="text" id="ticket-edit-customer-phone"/>
													</dd>
													<dd>
														<label>其他联系方式</label>
														<select id="ticket-edit-customer-otherContack">
															<option value="WeChat">WeChat</option>
															<option value="QQ">QQ</option>
															<option value="Facebook">Facebook</option>
														</select>
													</dd>
													<dd>
														<label id="ticket-edit-customer-otherContactLabel">WeChat账号</label>
														<input type="text" id="ticket-edit-customer-otherContackNumber"/>
													</dd>
												</dl>
											</li>
											<li class="last-info">
												<dl>
													<dd class="birthday">
														<label>生日</label>
														<input type="date" id="ticket-edit-customer-birthday"/>
													</dd>
													<dd  class="gender">
														<label>性别</label>
														<select name="" id="ticket-edit-customer-gender">
															<option value="M">男</option>
															<option value="F">女</option>
														</select>
													</dd>
													<dd>
														<label>邮箱</label>
														<input type="text" id="ticket-edit-customer-email"/>
													</dd>
													<dd class="zipCode">
														<label style="letter-spacing: 9px;">邮政编码</label>
														<input type="text" id="ticket-edit-customer-zipCode"/>
													</dd>
													<dd class="otherMsg">
														<label>其他注意事项</label>
														<input type="text" id="ticket-edit-customer-otherMsg"/>
													</dd>
												</dl>
											</li>
										</ul>
										<p>
											<a href="javascript:void(0);" id="plane-CustomerInfo">确认修改</a>
										</p>
									</div>

									<!--04/13  添加客户信息e-->
									<ul class="submitInfo">
										<li><a href="javascript:void(0);" id="airTicketSubmit">提交</a></li>
										<li><a href="javascript:void(0);" id="indivTourCancel">重置</a></li>
									</ul>
								</form>
								<?php
									$confirmBoxClass = "airticketCreateConfirmBox";
									$confirmButtonClass = "airticketCreateActionConfirm";
									$cancelButtonClass = "airticketCreateActionCancel";
									include('../confirmInfo.php');

									$confirmBoxClass = "airticketCreateSuccessBox";
									$confirmButtonClass = "airticketCreateSuccessConfirm";
									$cancelButtonClass = "airticketCreateSuccessCancel";
									include('../confirmInfo.php');
								?>
							</div>
							<!--机票添加     e-->
						</div>
					</div>
				</div>
				<!--右侧内容    e-->
			</div>
			<!--content e-->
		</div>
		<script src="../js/jquery.min.js" type="text/javascript"></script>
		<script src="../js/homePage/public.js" type="text/javascript"></script>
		<script src="../js/homePage/AirTicket.js" type="text/javascript"></script>
		<script type="text/javascript">
		$(function() {
			dateRange();
			//机票折扣
			tourDiscount($("#airTicketDiscountText"), $("#airTicketDiscountNotice"), $("#airTicketDiscountApply"), $("#airTicketSubtractNum"), $("#airTicketDiscountOption"));
			//机票-总人数
			headCount();
			airTicketOption();//单程往返
			//客户信息验证
			checkClientInfo($("#ticket-create-customer-lastName"));
			checkClientInfo($("#ticket-create-customer-firstName"));
			checkClientInfo($("#ticket-create-customer-phone"));
			checkClientInfo($("#ticket-create-customer-birthday"));
			checkClientInfo($("#ticket-create-customer-email"));
			$(".airticketInfo").find("a").on("mousedown",function(){
				$(this).addClass("selected");
			});
			$(".airticketInfo").find("a").on("mouseup",function(){
				$(this).removeClass("selected");
			});
			$(".airticketInfo .btnArea").find("a:last").on("click",function(){
				$(this).parent().parent().find("textarea").val("");
			});
		});
		</script>
	</body>
</html>
