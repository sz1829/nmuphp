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
		<link href="../css/font-awesome.css" type="text/css" rel="stylesheet" />
		<link href="../css/style.css" type="text/css" rel="stylesheet" />
		<link href="../css/accounting.css" type="text/css" rel="stylesheet" />
		<link href="../css/historicalOrder.css" type="text/css" rel="stylesheet" />
		<link href="../css/pagination.css" rel="stylesheet" type="text/css" />
		<title>会计-历史订单（机票）</title>
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
			<!--content  s-->
			<div class="msContent">
				<!--左侧导航部分     s-->
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
									<a href="../AirTicket/AirTicketCreate.php">
										<label></label> 机票
									</a>
								</dd>
							</dl>
						</li>
						<li class="kuaiji title-active">
							<a href="javascript:void(0);" class="bm-title">
								<img src="../img/c_kuaiji.png">
								会计
							</a>
							<dl class="detailMsg">
								<dd>
									<a href="javascript:void(0);" class="lab-active">
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

				<!--左侧导航部分     e-->
				<!--右侧内容             s-->
				<div class="theamInfo nm-right">
					<div class="showMsg kuaijiMsg">
						<div class="floor accountingInfo">
							<div class="navGroup accountingNav">
								<ul>
									<li class="recordAll">
										<a href="javascript:void(0);">
											全部
										</a>
									</li>
									<li class="groupTour">
										<a href="javascript:void(0);">
											独立团
										</a>
									</li>
									<li class="individualTour">
										<a href="javascript:void(0);">
											散拼团
										</a>
									</li>
									<li class="airTicket accountingNav-active">
										<a href="javascript:void(0);">
											机票
										</a>
									</li>
								</ul>

							</div>
							<!--历史记录  s-->
							<div class="groupMsg historicRecord">
								<!--筛选信息     s-->
								<div class="filterBox">
									<!--基本信息    s-->
									<div class="filterBasicInfo filterInfo">
										<label class="markMsg"><i></i>基本信息</label>
										<ul>
											<li>
												<label>订单号</label>
												<input type="text" />
											</li>
											<li class="statusOption">
												<label>状态</label>
												<div class="checkbox checkbox-success firstCheck">
													<input id="backlog" class="styled" type="checkbox" checked="checked">
													<label for="backlog">
						                           		未完成订单
						             				</label>
					             				</div>
					             				<div class="checkbox checkbox-success">
													<input id="clearOrder" class="styled" type="checkbox">
													<label for="clearOrder">
						                           		Clear订单
						             				</label>
					             				</div>
					             				<div class="checkbox checkbox-success">
													<input id="lockOrder" class="styled" type="checkbox">
													<label for="lockOrder">
						                           		Lock订单
						             				</label>
					             				</div>
											</li>
											<li>
												<label>定位</label>
												<input type="text" />
											</li>
											<li class="dateOption">
												<label>创建时间</label>
												<!--<input type="text" />-->
												<select name="">
													<option>全部</option>
													<option>Customized</option>
													<option>今天</option>
													<option>最近一周</option>
													<option>最近一个月</option>
													<option>最近一年</option>
												</select>
												<div class="dateRange nm-hide  groupTourDateRange">
													<label style="visibility: hidden;">创建时间</label>
													<input type="date" class="firstItem"/>
													<span>~</span>
													<input type="date" />
												</div>
											</li>
										</ul>
									</div>
									<!--基本信息    e-->
									<!--高级信息    s-->
									<div class="filterAdvancedInfo filterInfo">
										<label class="markMsg"><i></i>高级信息</label>
										<ul>
											<!--<li>
												<label>货币</label>
												<select>
													<option value="USD">$ 美元</option>
													<option value="RMB">¥ 人民币</option>
												</select>
											</li>-->
											<li>
												<label>付款方式</label>
												<select name="">
													<option value="creditcard">Credit Card</option>
													<option value="mco">MCO</option>
													<option value="alipay">Alipay</option>
													<option value="wechat">WeChat</option>
													<option value="cash">Cash</option>
													<option value="check">Check</option>
													<option value="other">Other</option>
												</select>
											</li>
											<li class="infoDistrict">
												<label>利润</label>
												<div class="currencyInfo">
													<a href="javascript:void(0);">$</a>
													<input type="text">
													<span>~</span>
													<input type="text">
												</div>
											</li>
											<li>
												<label>销售</label>
												<select name="">
													<option value="">Alex</option>
												</select>
											</li>
											<li class="infoDistrict">
												<label>成本</label>
												<div class="currencyInfo">
													<a href="javascript:void(0);">$</a>
													<input type="text">
													<span>~</span>
													<input type="text">
												</div>
											</li>
											<li>
												<label>来源</label>
												<select name="">
													<option value="">途牛</option>
												</select>
											</li>
											<li class="infoDistrict">
												<label>收入</label>
												<div class="currencyInfo">
													<a href="javascript:void(0);">$</a>
													<input type="text">
													<span>~</span>
													<input type="text">
												</div>
											</li>
										</ul>
									</div>
								</div>
								<!--机票信息  s-->
								<div class="filterGroupTourInfo filterInfo">
									<label class="markMsg"><i></i>机票信息</label>
									<ul>
										<li class="passengerNum">
											<label>乘客人数</label>
											<div>
												<!--<a href="javascript:void(0);">成人</a>
												<a href="javascript:void(0);">小孩</a>
												<a href="javascript:void(0);">婴儿</a>-->
												<input type="text"  placeholder="成人"/>
												<input type="text"  placeholder="小孩"/>
												<input type="text" 	placeholder="婴儿"  class="lastItem"/>
											</div>
										</li>
										<li class="spectator">
											<label>购票人姓名</label>
											<input type="text" />
										</li>
										<li>
											<label>航班号</label>
											<input type="text" />
										</li>
										<li class="statusOption">
											<label>往返</label>
											<div class="checkbox checkbox-success firstCheck">
													<input id="arriveAndDepart" class="styled" type="checkbox">
													<label for="arriveAndDepart">
						                           		往返
						             				</label>
					             			</div>
					             			<div class="checkbox checkbox-success firstCheck">
													<input id="singleTrip" class="styled" type="checkbox">
													<label for="singleTrip">
						                           		单程
						             				</label>
					             			</div>

										</li>
										<li class="infoDistrict">
											<label>行程地点</label>
											<input type="text"/>
											<span>~</span>
											<input type="text" />
										</li>
										<li class="statusOption">
											<label>团散</label>
											<div class="checkbox checkbox-success firstCheck">
													<input id="groupTicket" class="styled" type="checkbox">
													<label for="groupTicket">
						                           		团票
						             				</label>
					             			</div>
					             			<div class="checkbox checkbox-success firstCheck">
													<input id="indivTicket" class="styled" type="checkbox">
													<label for="indivTicket">
						                           		散票
						             				</label>
					             			</div>

										</li>
										<li class="infoDistrict">
											<label>行程日期</label>
											<input type="date" style="margin-left: 6%;"/>
											<span>~</span>
											<input type="date" />
										</li>
										<!--<li class="refundInfo statusOption">
											<label>退款</label>
					             			<div class="firstItem"><input type="radio" name="returnFund"/><i>已退款</i></div>
					             			<div class="firstItem"><input type="radio" name="returnFund"/><i>未退款</i></div>
										</li>-->
										<li class="choice statusOption">
											<label>退款</label>
    											<!--<label class="radio">
    												<span>在校生</span>
    												<input type="radio" name="radio" value="1" checked>
    												<i></i>
    											</label>
    											<label class="radio">
    												<span>非在校生</span>
    												<input type="radio" value="2" name="radio">
    												<i></i>
    											</label>-->
    										<div class="checkbox checkbox-success firstCheck">
													<input id="refund" class="styled" type="checkbox">
													<label for="refund">
						                           		退款
						             				</label>
					             			</div>

										</li>
									</ul>


								</div>
								<!--机票信息  e-->
								<!--筛选信息     e-->
								<div class="actionRecord">
									<ul>
										<li>
											<a href="javascript:void(0);">
												确认
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												重置
											</a>
										</li>
									</ul>
								</div>
								<!--通用信息   s-->
								<div class="generalInfo filterInfo tabCard">
									<label class="markMsg"><i></i>通用信息</label>
									<ul>
										<li class="selected">
											<div class="checkbox checkbox-success">
													<input id="createDateItem" class="styled" type="checkbox" checked="checked">
													<label for="createDateItem">
						                           		创建时间
						                           		<i></i>
						             				</label>
					             			</div>
										</li>
										<li class="selected">
											<div class="checkbox checkbox-success">
													<input id="salesItem" class="styled" type="checkbox" checked="checked">
													<label for="salesItem">
						                           		销售
						                           		<i></i>
						             				</label>
					             			</div>
										</li>
										<li class="selected">
											<div class="checkbox checkbox-success">
													<input id="profit" class="styled" type="checkbox" checked="checked">
													<label for="profit">
						                           		利润
						                           		<i></i>
						             				</label>
					             			</div>
										</li>
										<li class="selected">
											<div class="checkbox checkbox-success">
													<input id="incomeItem" class="styled" type="checkbox" checked="checked">
													<label for="incomeItem">
						                           		收入
						                           		<i></i>
						             				</label>
					             			</div>
										</li>
										<li class="selected">
											<div class="checkbox checkbox-success">
													<input id="expenditureItem" class="styled" type="checkbox" checked="checked">
													<label for="expenditureItem">
						                           		支出
						                           		<i></i>
						             				</label>
					             			</div>
										</li>
										<li class="default">
											<div class="checkbox checkbox-success">
													<input id="discountCodeItem" class="styled" type="checkbox">
													<label for="discountCodeItem">
						                           		折扣码
						                           		<i></i>
						             				</label>
					             			</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
													<input id="discountAmountItem" class="styled" type="checkbox">
													<label for="discountAmountItem">
						                           		折扣金额
						                           		<i></i>
						             				</label>
					             			</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
													<input id="sourceItem" class="styled" type="checkbox">
													<label for="sourceItem">
						                           		来源
						                           		<i></i>
						             				</label>
					             			</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
													<input id="clearItem" class="styled" type="checkbox">
													<label for="clearItem">
						                           		CLEAR
						                           		<i></i>
						             				</label>
					             			</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
													<input id="lockItem" class="styled" type="checkbox">
													<label for="lockItem">
						                           		LOCK
						                           		<i></i>
						             				</label>
					             			</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
													<input id="notesItem" class="styled" type="checkbox">
													<label for="notesItem">
						                           		备注
						                           		<i></i>
						             				</label>
					             			</div>
										</li>
									</ul>

								</div>
								<!--通用信息   e-->
								<!--机票信息  s-->
								<div class="groupTourInfo filterInfo tabCard">
									<label class="markMsg"><i></i>机票信息</label>
									<ul>
										<li>
											<div class="checkbox checkbox-success">
													<input id="location" class="styled" type="checkbox">
													<label for="location">
						                           		定位
						                           		<i></i>
						             				</label>
					             			</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
													<input id="name" class="styled" type="checkbox">
													<label for="name">
						                           		姓名
						                           		<i></i>
						             				</label>
					             			</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
													<input id="returnCash" class="styled" type="checkbox">
													<label for="returnCash">
						                           		返现
						                           		<i></i>
						             				</label>
					             			</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
													<input id="flightNumber" class="styled" type="checkbox">
													<label for="flightNumber">
						                           		航班号
						                           		<i></i>
						             				</label>
					             			</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
													<input id="goAndBack" class="styled" type="checkbox">
													<label for="goAndBack">
						                           		往返
						                           		<i></i>
						             				</label>
					             			</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
													<input id="groupIndiv" class="styled" type="checkbox">
													<label for="groupIndiv">
						                           		团散
						                           		<i></i>
						             				</label>
					             			</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
													<input id="patronage" class="styled" type="checkbox">
													<label for="patronage">
						                           		乘客人数
						                           		<i></i>
						             				</label>
					             			</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
													<input id="leaveInfo" class="styled" type="checkbox">
													<label for="leaveInfo">
						                           		出发
						                           		<i></i>
						             				</label>
					             			</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
													<input id="arriveInfo" class="styled" type="checkbox">
													<label for="arriveInfo">
						                           		抵达
						                           		<i></i>
						             				</label>
					             			</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
													<input id="returnMoney" class="styled" type="checkbox">
													<label for="returnMoney">
						                           		退款
						                           		<i></i>
						             				</label>
					             			</div>
										</li>
									</ul>


								</div>
								<!--散拼团信息  e-->
								<div class="resultInfo">
									<ul>
										<li class="title">
											<i>结&nbsp;&nbsp;&nbsp;&nbsp;果</i>
											<span>货币：USD</span>
										</li>
										<li class="resultNav">
											<dl>
												<dd>#</dd>
												<dd>创建时间</dd>
												<dd>销售</dd>
												<dd>利润</dd>
												<dd>收入</dd>
												<dd>支出</dd>
											</dl>
										</li>
										<li class="resultDetail">
											<dl>
												<dd></dd>
												<dd></dd>
												<dd></dd>
												<dd></dd>
												<dd></dd>
												<dd></dd>
											</dl>
										</li>
										<li class="resultDetail">
											<dl>
												<dd></dd>
												<dd></dd>
												<dd></dd>
												<dd></dd>
												<dd></dd>
												<dd></dd>
											</dl>
										</li>
										<li class="resultDetail">
											<dl>
												<dd></dd>
												<dd></dd>
												<dd></dd>
												<dd></dd>
												<dd></dd>
												<dd></dd>
											</dl>
										</li>
										<li class="resultDetail">
											<dl>
												<dd></dd>
												<dd></dd>
												<dd></dd>
												<dd></dd>
												<dd></dd>
												<dd></dd>
											</dl>
										</li>
										<li class="resultDetail">
											<dl>
												<dd></dd>
												<dd></dd>
												<dd></dd>
												<dd></dd>
												<dd></dd>
												<dd></dd>
											</dl>
										</li>


									</ul>
									<div class="nav-box eg">
										<ul class="pagination m-style" id="historyOrders"></ul>
									</div>

								</div>


						</div>
						</div>

					</div>

				</div>
				<!--右侧内容             e-->
			</div>
			<!--content  e-->

		</div>
		<script src="../js/jquery.min.js" type="text/javascript"></script>
		<script src="../js/homePage/public.js" type="text/javascript"></script>
		<script type="text/javascript">var individualTourCustomerList = [];</script>
		<script src="../js/homePage/accounting.js" type="text/javascript"></script>
		<script src="../js/homePage/historicalOrder.js" type="text/javascript"></script>
		<script src="../js/jquery.pagination.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(function() {
				accountDateRange($("li.dateOption"),$(".dateRange"));
				generalInfo();//通用信息选择
				resetInfo();//重置
				accountingNav();
				orderPagination();
				$(".filterInfo ul li.infoDistrict .currencyInfo").find("a").on('click',function(){
					var innerTxt=$.trim($(this).text());
					if(innerTxt=="$"){
						$(this).text("￥");

					}
					else if(innerTxt=="￥"){
						$(this).text("$");
					}
				});
			});
		</script>
		<?php
		include ('../database/autoComplete.php');
		?>
	</body>
</html>
