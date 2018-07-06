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
		<title>会计-历史订单（散拼团）</title>
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
									<li class="individualTour accountingNav-active">
										<a href="javascript:void(0);">
											散拼团
										</a>
									</li>
									<li class="airTicket">
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
												<input type="text" id="transaction-id">
											</li>
											<li class="statusOption">
												<label>状态</label>
												<div class="checkbox checkbox-success firstCheck">
													<input id="unClear" class="styled" type="checkbox" checked="checked">
													<label for="unClear">未完成订单</label>
					             				</div>
					             				<div class="checkbox checkbox-success">
													<input id="clearOrder" class="styled" type="checkbox">
													<label for="clearOrder">Clear订单</label>
					             				</div>
					             				<div class="checkbox checkbox-success">
													<input id="lockOrder" class="styled" type="checkbox">
													<label for="lockOrder">Lock订单</label>
					             				</div>
											</li>
											<li>
												<label>团号</label>
												<input type="text" id="group-code">
											</li>
											<li class="dateOption">
												<label>创建时间</label>
												<select id="time-filter">
													<option value="all">全部</option>
													<option value="customized">Customized</option>
													<option value="today">今天</option>
													<option value="week">最近一周</option>
													<option value="month">最近一个月</option>
													<option value="year">最近一年</option>
												</select>
												<div class="dateRange nm-hide  groupTourDateRange">
													<label style="visibility: hidden;">创建时间</label>
													<input type="date" class="firstItem" id="from-date">
													<span>~</span>
													<input type="date" id="to-date">
												</div>
											</li>
										</ul>
									</div>
									<!--基本信息    e-->
									<!--高级信息    s-->
									<div class="filterAdvancedInfo filterInfo">
										<label class="markMsg"><i></i>高级信息</label>
										<ul>
											<li class="infoDistrict" id="profit-range">
												<label>利润</label>
												<div class="currencyInfo">
													<a href="javascript:void(0);" class="currencySelected">$</a>
													<input type="text" id="profit-min">
													<span>~</span>
													<input type="text" id="profit-max">
												</div>
											</li>
											<li id="salesperson-filter">
												<label>销售</label>
												<input id="salesperson" type="text" placeholder="Search...">
											</li>
											<li class="infoDistrict">
												<label>成本</label>
												<div class="currencyInfo">
													<a href="javascript:void(0);" class="currencySelected">$</a>
													<input type="text" id="cost-min">
													<span>~</span>
													<input type="text" id="cost-max">
												</div>
											</li>
											<li>
												<label>来源</label>
												<input id="source" type="text" placeholder="Search...">
											</li>
											<li class="infoDistrict">
												<label>收入</label>
												<div class="currencyInfo">
													<a href="javascript:void(0);" class="currencySelected">$</a>
													<input type="text" id="price-min">
													<span>~</span>
													<input type="text" id="price-max">
												</div>
											</li>
										</ul>
									</div>
								</div>
								<!--散拼团信息  s-->
								<div class="filterGroupTourInfo filterInfo">
									<label class="markMsg"><i></i>散拼团信息</label>
									<ul>
										<li class="infoDistrict">
											<label>总人数</label>
											<input type="text" id="total-number-min">
											<span>~</span>
											<input type="text" id="total-number-max">
										</li>
										<li>
											<label>团名</label>
											<input type="text" id="group-name">
										</li>
										<li>
											<label>销售商</label>
											<input id="wholesaler-input" type="text" placeholder="Search...">
										</li>
										<li class="infoDistrict">
											<label>行程日期</label>
											<input type="date" id="start-date" class="firstItem">
											<span>~</span>
											<input type="date" id="end-date">
										</li>
									</ul>
								</div>
								<!--散拼团信息  e-->
								<!--筛选信息     e-->
								<div class="actionRecord">
									<ul>
										<li><a href="javascript:void(0);" id="filter-confirm">确认</a></li>
										<li><a href="javascript:void(0);" id="filter-reset">重置</a></li>
									</ul>
								</div>
								<!--通用信息   s-->
								<div class="generalInfo filterInfo tabCard">
									<label class="markMsg"><i></i>通用信息</label>
									<ul>
										<li class="selected">
											<div class="checkbox checkbox-success">
												<input id="create_time" class="styled" type="checkbox" checked="checked">
												<label for="create_time">
					                           		创建时间
					                           		<i></i>
					             				</label>
					             			</div>
										</li>
										<li class="selected">
											<div class="checkbox checkbox-success">
												<input id="salesperson_code" class="styled" type="checkbox" checked="checked">
												<label for="salesperson_code">
					                           		销售
					                           		<i></i>
					             				</label>
					             			</div>
										</li>
										<li class="selected">
											<div class="checkbox checkbox-success">
												<input id="currency" class="styled" type="checkbox" checked="checked">
												<label for="currency">
					                           		货币
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
												<input id="revenue" class="styled" type="checkbox" checked="checked">
												<label for="revenue">
					                           		收入
					                           		<i></i>
					             				</label>
					             			</div>
										</li>
										<li class="selected">
											<div class="checkbox checkbox-success">
												<input id="expense" class="styled" type="checkbox" checked="checked">
												<label for="expense">
					                           		支出
					                           		<i></i>
					             				</label>
					             			</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
												<input id="coupon" class="styled" type="checkbox">
												<label for="coupon">
					                           		折扣金额
					                           		<i></i>
					             				</label>
					             			</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
												<input id="source_name" class="styled" type="checkbox">
												<label for="source_name">
					                           		来源
					                           		<i></i>
					             				</label>
					             			</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
												<input id="clear_status" class="styled" type="checkbox">
												<label for="clear_status">
					                           		CLEAR
					                           		<i></i>
					             				</label>
					             			</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
												<input id="lock_status" class="styled" type="checkbox">
												<label for="lock_status">
					                           		LOCK
					                           		<i></i>
					             				</label>
					             			</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
												<input id="note" class="styled" type="checkbox">
												<label for="note">
					                           		备注
					                           		<i></i>
					             				</label>
					             			</div>
										</li>
									</ul>
								</div>
								<!--通用信息   e-->
								<!--散拼团信息  s-->
								<div class="groupTourInfo filterInfo tabCard">
									<label class="markMsg"><i></i>散拼团信息</label>
									<ul>
										<li>
											<div class="checkbox checkbox-success">
												<input id="product_code" class="styled" type="checkbox">
												<label for="product_code">
					                           		团号
					                           		<i></i>
					             				</label>
					             			</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
												<input id="total_number" class="styled" type="checkbox">
												<label for="total_number">
					                           		人数
					                           		<i></i>
					             				</label>
					             			</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
												<input id="schedule" class="styled" type="checkbox">
												<label for="schedule">
					                           		行程
					                           		<i></i>
					             				</label>
					             			</div>
										</li>
										<li>
											<div class="checkbox checkbox-success">
												<input id="wholesalers" class="styled" type="checkbox">
												<label for="wholesalers">
					                           		销售商
					                           		<i></i>
					             				</label>
					             			</div>
										</li>
									</ul>
								</div>
								<!--散拼团信息  e-->
								<div class="resultInfo">
									<ul>
										<li class="title"><i>结&nbsp;&nbsp;&nbsp;&nbsp;果</i></li>
										<li class="resultNav">
											<dl>
												<dd>#</dd>
												<dd>创建时间</dd>
												<dd>销售</dd>
												<dd>货币</dd>
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
									</ul>
									<div class="nav-box eg">
										<ul class="pagination m-style" id="indivTourOrders"></ul>
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
		<script src="../js/jquery.pagination.js" type="text/javascript"></script>
		<script src="../js/homePage/public.js" type="text/javascript"></script>
		<script src="../js/homePage/accounting.js" type="text/javascript"></script>
		<script src="../js/OrderHistory/indivOrders.js" type="text/javascript"></script>
	</body>
</html>
