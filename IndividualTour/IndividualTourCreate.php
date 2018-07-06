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
		<title>后台管理系统（散拼团添加页面）</title>
		<link href="../css/individualTour.css" type="text/css" rel="stylesheet" />
		<link href="../css/style.css" type="text/css" rel="stylesheet" />
	</head>
	<body
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
				<!--左侧导航      s-->
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
				<!--左侧导航      e-->
				<!--右侧内容      s-->
				<div class="theamInfo nm-right">
					<div class="showMsg yewu">
						<div class="floor">
							<!--右侧导航      s-->
							<div class="navGroup">
								<ul>
									<li class="addItem card-active">
										<a href="javascript:void(0)" class="btn ms-active createOrderButton">
											<img src="../img/add.png">
											添<i>隐藏</i>加
										</a>
									</li>
									<li class="updateItem">
										<a href="IndividualTourUpdate.php" class="btn updateOrderButton">
											<img src="../img/c_refresh.png">
											更<i>隐藏</i>新
										</a>
									</li>
								</ul>
							</div>
							<!--右侧导航      e-->
							<!--散拼团添加    s-->
							<div class="groupMsg addInfo ">
								<form class="addlist" id="createIndivTourForm">
									<div class="cardLeft nm-left cardLeft-individual">
										<label class="markMsg"><i></i>基本信息</label>
										<ul class="add-msg add-msg-individual-left">
											<li>
												<label class="nm-left">团号</label>
												<input type="text" id="indiv_tour_id" />
											</li>
											<li>
												<label class="nm-left">团名</label>
												<input type="text" id="indiv_tour_name" />
											</li>
											<li>
												<label class="nm-left">销售人员</label>
												<input id="indiv_salesperson" type="text" placeholder="Search...">
											</li>
											<li>
												<label class="nm-left">零售商</label>
												<input id="indiv_wholesaler" type="text" placeholder="Search...">
											</li>
											<li>
												<label class="nm-left">参团人数</label>
												<input type="text" id="indiv_touristCount" />
											</li>
											<li>
												<label class="nm-left">来源</label>
												<input type="text" id="indiv_source" placeholder="Search..." />
											</li>
											<li>
												<label class="nm-left">备注</label>
												<textarea id="indiv_note" rows="5"></textarea>
											</li>
										</ul>
									</div>
									<div class="cardRight nm-left info-date">
										<label class="markMsg"><i></i>行程安排</label>
										<ul class="add-msg">
											<li>
												<label class="nm-left">出发日期</label>
												<input type="date" value="" id="indiv_startTime" />
											</li>
											<li>
												<label class="nm-left">结束日期</label>
												<input type="date" value="" id="indiv_endTime" />
											</li>
											<li>
												<label class="nm-left">天数</label>
												<input type="text" value="" id="indiv_num_days" />
											</li>
										</ul>
									</div>
									<div class="cardRight nm-left info-price info-price-individual">
										<label class="markMsg"><i></i>财务信息</label>
										<ul class="add-msg">
											<li class="exchangeRate">
												<label class="nm-left">当前汇率</label>
												<span>1&nbsp;&nbsp;美元&nbsp;&nbsp;=&nbsp;&nbsp; <input type="text" id="indiv_exchange_rate"/>&nbsp;&nbsp;人民币</span>
											</li>
											<li>
												<label class="nm-left">总花费</label>
												<input type="text" id="indiv_total_cost" />
											</li>
										</ul>
									</div>
									<div class="split">
										<hr />
									</div>
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
														<dd>实际支付</dd>
														<dd>注意事项</dd>
													</dl>
												</li>
											</ul>
										</div>
									</div>
									<div class="split" id="customerInfoAreaDivider" hidden>
										<hr />
									</div>
								</form>
								<form>
									<!--04/13  添加客户信息s-->
									<div class="addClients customerInfo">
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
														<input type="text" id="indivLastName"/>
													</dd>
													<dd class="pname">
														<label>名</label>
														<input type="text" id="indivFirstName"/>
													</dd>
													<dd>
														<label>电话</label>
														<input type="text" id="indivClientTel"/>
													</dd>
													<dd>
														<label>其他联系方式</label>
														<select name="" id="indivOtherContact">
															<option value="WeChat">WeChat</option>
															<option value="QQ">QQ</option>
															<option value="Facebook">Facebook</option>
														</select>
													</dd>
													<dd>
														<label id="indivOtherContactLabel">WeChat账号</label>
														<input type="text" id="indivOtherContactNumber"/>
													</dd>
												</dl>
											</li>
											<li>
												<dl>
													<dd class="birthday">
														<label>生日</label>
														<input type="date" id="indivBirthday"/>
													</dd>
													<dd  class="gender">
														<label>性别</label>
														<select name="" id="indivGender">
															<option value="UNKNOWN">Unknown</option>
															<option value="M">男</option>
															<option value="F">女</option>
														</select>
													</dd>
													<dd>
														<label>邮箱</label>
														<input type="text" id="indivClientEmail"/>
													</dd>
													<dd class="zipCode">
														<label>邮政编码</label>
														<input type="text" id="indivZipCode"/>
													</dd>
													<dd class="otherMsg">
														<label>其他注意事项</label>
														<input type="text" id="indivOtherMsg"/>
													</dd>
												</dl>
											</li>
											<li class="last-info">
												<dl>
													<dd class="joinDate">
														<label>参团日期</label>
														<input type="date" id="indivJoinDate"/>
													</dd>
													<dd class="joinLocation">
														<label>参团地点</label>
														<input type="text" id="indivJoinLocation"/>
													</dd>
													<dd class="leaveDate">
														<label>离团日期</label>
														<input type="date" id="indivLeaveDate"/>
													</dd>
													<dd class="leaveLocation">
														<label>离团地点</label>
														<input type="text" id="indivLeaveLocation"/>
													</dd>

													<dd>
														<label>货币</label>
														<select id="indiv_currency">
															<option value="USD">$ 美元</option>
															<option value="RMB">￥人民币</option>
														</select>
													</dd>
													<dd>
														<label>支付方式</label>
														<select id="indiv_payment_type">
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
														<input type="text" id="indiv_price" />
													</dd>
													<dd>
														<label>折扣</label>
														<ul class="add-msg">
															<li class="discountCard">
																<dl class="discountOption" id="indivDiscountOption">
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
																		<input type="text"  id="indivDiscountText"/>
																	</dd>
																	<dd class="discount-apply">
																		<a href="javascript:void(0);" class="discountApply" id="indivDiscountApply">
																			Apply
																		</a>
																	</dd>
																</dl>
																<dl class="discountNotice nm-hide" id="indivDiscountNotice">
																	<dd>
																		<span id="indivSubtractNum"></span>
																	</dd>
																</dl>
															</li>
														</ul>

													</dd>
												</dl>
											</li>
										</ul>
										<p><a href="javascript:void(0);" id="addCustomerInfo">添加客户</a></p>
									</div>

									<!-- 弹出窗口编辑客户信息 -->
									<div class="addClients customerInfo editcustomerInfo nm-hide">
										<a href="#" class="close-customer nm-right" id="close-customer">
											<img src="../img/close.png">
										</a>
										<ul class="clients-title">
											<li><a href="javascript:void(0);">基本信息</a></li>
											<li><a href="javascript:void(0);">客户信息</a></li>
											<li><a href="javascript:void(0);">旅游信息</a></li>
										</ul>
										<ul class="clients-info">
											<li>
												<dl>
													<dd class="pname">
														<label>姓</label>
														<input type="text" id="edit-lastName"/>
													</dd>
													<dd class="pname">
														<label>名</label>
														<input type="text" id="edit-firstName"/>
													</dd>
													<dd>
														<label>电话</label>
														<input type="text" id="edit-clientTel"/>
													</dd>
													<dd>
														<label>其他联系方式</label>
														<select id="edit-otherContact">
															<option value="WeChat">WeChat</option>
															<option value="QQ">QQ</option>
															<option value="Facebook">Facebook</option>
														</select>
													</dd>
													<dd>
														<label id="edit-otherContactLabel">WeChat账号</label>
														<input type="text" id="edit-otherContactNumber"/>
													</dd>
												</dl>
											</li>
											<li>
												<dl>
													<dd class="birthday">
														<label>生日</label>
														<input type="date" id="edit-birthday"/>
													</dd>
													<dd  class="gender">
														<label>性别</label>
														<select name="" id="edit-gender">
															<option value="UNKNOWN">Unknown</option>
															<option value="M">男</option>
															<option value="F">女</option>
														</select>
													</dd>
													<dd>
														<label>邮箱</label>
														<input type="text" id="edit-clientEmail"/>
													</dd>
													<dd class="zipCode">
														<label>邮政编码</label>
														<input type="text" id="edit-zipCode"/>
													</dd>
													<dd class="otherMsg">
														<label>其他注意事项</label>
														<input type="text" id="edit-otherMsg"/>
													</dd>
												</dl>
											</li>
											<li class="last-info">
												<dl>
													<dd class="joinDate">
														<label>参团日期</label>
														<input type="date" id="edit-joinDate"/>
													</dd>
													<dd class="joinLocation">
														<label>参团地点</label>
														<input type="text" id="edit-joinLocation"/>
													</dd>
													<dd class="leaveDate">
														<label>离团日期</label>
														<input type="date" id="edit-leaveDate"/>
													</dd>
													<dd class="leaveLocation">
														<label>离团地点</label>
														<input type="text" id="edit-leaveLocation"/>
													</dd>
													<!--06/01修改-->
													<dd>
														<label>货币</label>
														<select id="edit_indiv_currency">
															<option value="USD">$ 美元</option>
															<option value="RMB">￥人民币</option>
														</select>
													</dd>
													<dd>
														<label>支付方式</label>
														<select id="edit_indiv_payment_type">
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
														<input type="text" id="edit_indiv_price" />
													</dd>
													<dd>
														<label>折扣</label>
														<ul class="add-msg">
															<li class="discountCard">
																<dl class="discountOption" id="edit_indivDiscountOption">
																	<dd class="option-active discount-code">
																		<a href="javascript:void(0);">折扣码</a>
																	</dd>
																	<dd class="coupon">
																		<a href="javascript:void(0);">折扣金额</a>
																	</dd>
																</dl>
																<dl class="exchange">
																	<dd class="discount-text">
																		<input type="text" id="edit_indivTourDiscountText"/>
																	</dd>
																	<dd class="discount-apply">
																		<a href="javascript:void(0);" class="discountApply" id="edit_indivDiscountApply">
																			Apply
																		</a>
																	</dd>
																</dl>
																<dl class="discountNotice nm-hide" id="edit_indivTourDiscountNotice">
																	<dd>
																		<span id="edit_indivTourSubtractNum"></span>
																	</dd>
																</dl>
															</li>
														</ul>

													</dd>
												</dl>
											</li>
										</ul>
										<p>
											<a href="javascript:void(0);" id="edit-CustomerInfo">
												确认修改
											</a>
										</p>
									</div>
									<ul class="submitInfo">
										<li>
											<a href="javascript:void(0);" id="indivTourSubmit">提交</a>
										</li>
										<li>
											<a href="javascript:void(0);" id="indivTourCancel">重置</a>
										</li>
									</ul>
								</form>

								<?php
									$confirmBoxClass = "individualtourCreateConfirmBox";
									$confirmButtonClass = "individualTourCreateActionConfirm";
									$cancelButtonClass = "individualTourCreateActionCancel";
									include('../confirmInfo.php');

									$confirmBoxClass = "individualtourCreateSuccessBox";
									$confirmButtonClass = "individualtourCreateSuccessConfirm";
									$cancelButtonClass = "individualtourCreateSuccessCancel";
									include('../confirmInfo.php');
								?>
							</div>
							<!--散拼团添加     e-->
						</div>
					</div>
				</div>
				<!--右侧内容      e-->
			</div>
			<!--content e-->
		</div>
		<script src="../js/jquery.min.js" type="text/javascript"></script>
		<script src="../js/homePage/public.js" type="text/javascript"></script>
		<script type="text/javascript">
			var individualTourCustomerList = [];
		</script>
		<script src="../js/homePage/individualTour.js" type="text/javascript"></script>
		<script type="text/javascript">
		$(function() {
			tourDiscount($("#indivDiscountText"), $("#indivDiscountNotice"), $("#indivDiscountApply"), $("#indivSubtractNum"), $("#indivDiscountOption"));
			tourDiscount($("#edit_indivTourDiscountText"), $("#edit_indivTourDiscountNotice"), $("#edit_indivDiscountApply"), $("#edit_indivTourSubtractNum"), $("#edit_indivDiscountOption"));
			addClients();
			sendFormMsg();
			client_check();//客户信息验证
		});
		</script>
	</body>
</html>
