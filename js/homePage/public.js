//导航切换效果
function qiehuan() {
	//左右两侧保持高度相等
	var leftHeight = $(".navInfo ul").height()
	var rightHeight = $(".theamInfo").height();
	if(rightHeight > leftHeight) {
		$(this).blur();
		$(".navInfo ul").css("height", rightHeight);
	}
	if(rightHeight < leftHeight) {
		$(this).blur();
		$(".navInfo ul").css("height", rightHeight);
	}

	//左右侧信息切换
	$(".navInfo").find("li").on('click', function() {
		var index = $(this).index();
		$(this).css({
			"background-color": "#9295ff",
			"font-weight": "bold"
		}).siblings().css({
			"background-color": "#fff",
			"font-weight": "normal"
		});
		$(this).find(".detailMsg").slideDown("slow");
		$(this).siblings().find(".detailMsg").slideUp("slow");
		var leftHeight = $(".navInfo ul").height()
		var rightHeight = $(".theamInfo").height();
		if(rightHeight > leftHeight) {
			$(this).blur();
			$(".navInfo ul").css("height", rightHeight);
		}
		if(rightHeight < leftHeight) {
			$(this).blur();
			$(".navInfo ul").css("height", rightHeight);
		}

	});
	//导航二级菜单切换
	$(".navInfo").find("li").find(".detailMsg").find("dd").on("click", function() {
		$(".addItem").addClass("card-active").siblings().removeClass("card-active");
		var tindex = $(this).index();
		var parentLab = $(this).parent();
		var pindex = parentLab.parent().index();
		$(this).parent("li").siblings().find(".detailMsg dd").find("label").css({
			"background-color": "#e5e5e5",
		});
		$(this).find("label").css({
			"background-color": "#fbd608",
		});
		$(this).siblings().find("label").css({
			"background-color": "#e5e5e5",
		});
		$(this).find("a").css({
			"font-weight": "bold"

		});
		$(this).siblings().find("a").css({
			"font-weight": "normal"
		});
		var leftHeight = $(".navInfo ul").height()
		var rightHeight = $(".theamInfo").height();
		if(rightHeight > leftHeight) {
			$(this).blur();
			$(".navInfo ul").css("height", rightHeight);
		}
		if(rightHeight < leftHeight) {
			$(this).blur();
			$(".navInfo ul").css("height", rightHeight);
		}

	});
	//独立团:添加和更新的切换
	$(".showMsg").find(".navGroup").find("ul").find("li").on("click", function() {
		if($(".updateItem").css("display") == "block") {}
		var gindex = $(this).index();
		var pElement = $(this).parentsUntil(".showMsg");
		$(this).addClass("card-active").siblings().removeClass("card-active");
		var leftHeight = $(".navInfo ul").height()
		var rightHeight = $(".theamInfo").height();
		if(rightHeight > leftHeight) {
			$(this).blur();
			$(".navInfo ul").css("height", rightHeight);
		}
		if(rightHeight < leftHeight) {
			$(this).blur();
			$(".navInfo ul").css("height", rightHeight);
		}

	});

}
//主页的图片替换
function changeImg() {
	$(".shouye").on("click", function() {
		$(this).find("img").attr("src", "img/c_shouye.png");
		$(".yewu").find("img").attr("src", "img/yewu.png");
		$(".kuaiji").find("img").attr("src", "img/kuaiji.png");
		$(".guanli").find("img").attr("src", "img/guanli.png");
		$(".qita").find("img").attr("src", "img/qita.png");
	});
	$(".yewu").on("click", function() {
		$(this).find("img").attr("src", "img/c_yewu.png");
		$(".kuaiji").find("img").attr("src", "img/kuaiji.png");
		$(".guanli").find("img").attr("src", "img/guanli.png");
		$(".qita").find("img").attr("src", "img/qita.png");
		$(".shouye").find("img").attr("src", "img/shouye.png");
	});
	$(".kuaiji").on("click", function() {
		$(this).find("img").attr("src", "img/c_kuaiji.png");
		$(".qita").find("img").attr("src", "img/qita.png");
		$(".shouye").find("img").attr("src", "img/shouye.png");
		$(".guanli").find("img").attr("src", "img/guanli.png");
		$(".yewu").find("img").attr("src", "img/yewu.png");
	});
	$(".guanli").on("click", function() {
		$(this).find("img").attr("src", "img/c_guanli.png");
		$(".qita").find("img").attr("src", "img/qita.png");
		$(".shouye").find("img").attr("src", "img/shouye.png");
		$(".yewu").find("img").attr("src", "img/yewu.png");
		$(".kuaiji").find("img").attr("src", "img/kuaiji.png");
	});
	$(".qita").on("click", function() {
		$(this).find("img").attr("src", "img/c_qita.png");
		$(".shouye").find("img").attr("src", "img/shouye.png");
		$(".yewu").find("img").attr("src", "img/yewu.png");
		$(".kuaiji").find("img").attr("src", "img/kuaiji.png");
		$(".guanli").find("img").attr("src", "img/guanli.png");
	});
	$(".addItem").click(function() {
		$(this).find("img").attr("src", "img/add.png");
		$(".updateItem").find("img").attr("src", "img/c_refresh.png");
	});
	$(".updateItem").click(function() {
		$(this).find("img").attr("src", "img/refresh.png");
		$(".addItem").find("img").attr("src", "img/c_add.png");
		//左右两侧保持高度相等
		var leftHeight = $(".navInfo ul").height()
		var rightHeight = $(".theamInfo").height();
		if(rightHeight > leftHeight) {
			$(this).blur();
			$(".navInfo ul").css("height", rightHeight);
		}
	});
}
//分页的图片替换
function tabsChangeImg() {
	$(".shouye").on("click", function() {
		$(this).find("img").attr("src", "../img/c_shouye.png");
		$(".yewu").find("img").attr("src", "../img/yewu.png");
		$(".kuaiji").find("img").attr("src", "../img/kuaiji.png");
		$(".guanli").find("img").attr("src", "../img/guanli.png");
		$(".qita").find("img").attr("src", "../img/qita.png");
	});
	$(".yewu").on("click", function() {
		$(this).find("img").attr("src", "../img/c_yewu.png");
		$(".kuaiji").find("img").attr("src", "../img/kuaiji.png");
		$(".guanli").find("img").attr("src", "../img/guanli.png");
		$(".qita").find("img").attr("src", "../img/qita.png");
		$(".shouye").find("img").attr("src", "../img/shouye.png");
	});
	$(".kuaiji").on("click", function() {
		$(this).find("img").attr("src", "../img/c_kuaiji.png");
		$(".qita").find("img").attr("src", "../img/qita.png");
		$(".shouye").find("img").attr("src", "../img/shouye.png");
		$(".guanli").find("img").attr("src", "../img/guanli.png");
		$(".yewu").find("img").attr("src", "../img/yewu.png");
	});
	$(".guanli").on("click", function() {
		$(this).find("img").attr("src", "../img/c_guanli.png");
		$(".qita").find("img").attr("src", "../img/qita.png");
		$(".shouye").find("img").attr("src", "../img/shouye.png");
		$(".yewu").find("img").attr("src", "../img/yewu.png");
		$(".kuaiji").find("img").attr("src", "../img/kuaiji.png");
	});
	$(".qita").on("click", function() {
		$(this).find("img").attr("src", "../img/c_qita.png");
		$(".shouye").find("img").attr("src", "../img/shouye.png");
		$(".yewu").find("img").attr("src", "../img/yewu.png");
		$(".kuaiji").find("img").attr("src", "../img/kuaiji.png");
		$(".guanli").find("img").attr("src", "../img/guanli.png");
	});
}

function DateDiff(sDate1, sDate2) { //sDate1和sDate2是yyyy-MM-dd格式
	var aDate, oDate1, oDate2, iDays;
	aDate = sDate1.split("-");
	oDate1 = new Date(aDate[1] + '-' + aDate[2] + '-' + aDate[0]); //转换为yyyy-MM-dd格式
	aDate = sDate2.split("-");
	oDate2 = new Date(aDate[1] + '-' + aDate[2] + '-' + aDate[0]);
	iDays = parseInt(Math.abs(oDate1 - oDate2) / 1000 / 60 / 60 / 24); //把相差的毫秒数转换为天数

	return iDays; //返回相差天数
}
function addByTransDate(dateParameter, num) {
	var translateDate = "",
		dateString = "",
		monthString = "",
		dayString = "";
	translateDate = dateParameter.replace("-", "/").replace("-", "/");;

	var newDate = new Date(translateDate);
	newDate = newDate.valueOf();
	newDate = newDate + num * 24 * 60 * 60 * 1000; //备注 如果是往前计算日期则为减号 否则为加号
	newDate = new Date(newDate);

	//如果月份长度少于2，则前加 0 补位
	if((newDate.getMonth() + 1).toString().length == 1) {
		monthString = 0 + "" + (newDate.getMonth() + 1).toString();
	} else {
		monthString = (newDate.getMonth() + 1).toString();
	}

	//如果天数长度少于2，则前加 0 补位
	if(newDate.getDate().toString().length == 1) {

		dayString = 0 + "" + newDate.getDate().toString();
	} else {

		dayString = newDate.getDate().toString();
	}

	dateString = newDate.getFullYear() + "-" + monthString + "-" + dayString;
	return dateString;

}
function delByTransDate(dateParameter, num) {
	var translateDate = "",
		dateString = "",
		monthString = "",
		dayString = "";
	translateDate = dateParameter.replace("-", "/").replace("-", "/");;

	var newDate = new Date(translateDate);
	newDate = newDate.valueOf();
	newDate = newDate - num * 24 * 60 * 60 * 1000; //备注 如果是往前计算日期则为减号 否则为加号
	newDate = new Date(newDate);

	//如果月份长度少于2，则前加 0 补位
	if((newDate.getMonth() + 1).toString().length == 1) {
		monthString = 0 + "" + (newDate.getMonth() + 1).toString();
	} else {
		monthString = (newDate.getMonth() + 1).toString();
	}

	//如果天数长度少于2，则前加 0 补位
	if(newDate.getDate().toString().length == 1) {

		dayString = 0 + "" + newDate.getDate().toString();
	} else {

		dayString = newDate.getDate().toString();
	}

	dateString = newDate.getFullYear() + "-" + monthString + "-" + dayString;
	return dateString;

}
//储备金
////表单
//function tourGuide_check() {
//	var reg = /^[A-Za-z]\w+$/; //正则表达式 必须以字母开头的账号
//	if($("#tourGuide").val().search(reg) == -1) {
//		alert("导游名字必须是以 字母开头的 可以包含数字字母下划线的字符串");
//		return false;
//	} else {
//		alert("导游名字验证成功");
//		return true;
//	}
//	return true;
//}
////导游电话验证
//function mobile_check() {
//	var reg = /^(13|15|17|18)\d{9}$/;
//	if(guideTel = $("#guideTel").val().search(reg) == -1) {
//		alert("手机格式不正确 应该是 1 （3|5|7|8）xxx xxx xxx  总共11位的纯数字");
//		return false;
//	} else {
//		return true;
//	}
//	return true;
//}
////团号验证     让其是至少三位数字
//function guide_check() {
//	var reg = /^\d{3,}$/;
//	if($("#groupNum").val().search(reg) == -1) {
//		alert("团号至少是3位数字");
//		return false;
//	} else {
//		alert("团号验证成功");
//		return true;
//	}
//	return true;
//}
////代理商名字验证
//function agent_check() {
//	var reg = /^[A-Za-z]\w+$/;
//	if($("#agent").val().search(reg) == -1) {
//		alert("代理商名字必须是以字母开头的 可以包含数字字母下划线的字符");
//		return false;
//	} else {
//		alert("代理商名字验证成功");
//		return true;
//	}
//	return true;
//}
////人数验证
//function numOfPeople_check() {
//	var reg = /^\d{1,}$/;
//	if($("#leadNum").val().search(reg) == -1 || $("#visitorNum").val().search(reg) == -1) {
//		alert("人数至少是1位数字");
//		return false;
//	} else {
//		alert("人数验证成功");
//		return true;
//	}
//	return true;
//}

var generateDateCount = function(endDay, startDay) {
	var endDay = new Date(endDay);
	var startDay = new Date(startDay);
	var diff = new Date(endDay - startDay);
	var days = diff / 1000 / 60 / 60 / 24 + 1;
	return days;
}

$(document).ready(function() {
	$(".header .user-info ul li.login").find("a").on("mousedown",function(){
		$(this).addClass("selected");
	});
	$(".header .user-info ul li.login").find("a").on("mouseup",function(){
		$(this).removeClass("selected");
	});
	$(".createOrderButton").on("click", function() {
		$("#customerInfoArea").hide();
		$("#customerInfoArea .updateInfo").hide();
		$("#customerInfoAreaDivider").hide();
	});

	//散拼团-根据结束日期生成天数
	$('#indiv_endTime').on('change', function() {
		var startTime1 = $('#indiv_startTime').val();
		var endTime1 = $('#indiv_endTime').val();
		var startNum1 = parseInt(startTime1.replace(/-/g, ''), 10);
		var endNum1 = parseInt(endTime1.replace(/-/g, ''), 10);
		if(startNum1 > endNum1) {
			$('#indiv_endTime').removeAttr('value');
			$('#indiv_num_days').removeAttr('value');
			alert("结束时间不能在开始时间之前！");
		} else {
			var days = generateDateCount(endTime1, startTime1);
			if(!isNaN(days)) {
				$('#indiv_num_days').val(days);
			}
		}
	});

	//散拼团-根据天数计算结束日期
	$('#indiv_num_days').on('keyup', function() {
		$('#indiv_endTime').val(addByTransDate($('#indiv_startTime').val(), parseInt($('#indiv_num_days').val()) - 1));
	});

	// 散拼团-根据出发日期计算天数或者结束日期
	$('#indiv_startTime').on('change', function() {
		var startTime = $('#indiv_startTime').val();
		var endTime = $('#indiv_endTime').val();

		var startNum = parseInt(startTime.replace(/-/g, ''), 10);
		var endNum = parseInt(endTime.replace(/-/g, ''), 10);

		var startDay = new Date(startTime);
		var endDay = new Date(endTime);

		if(endDay == 'Invalid Date') {
			var diff = $('#indiv_num_days').val();
			if(diff != undefined) {
				$('#endTime').val(addByTransDate(startTime, parseInt(diff) - 1));
			}
		} else {
			if(startNum > endNum) {
				$('#indiv_endTime').removeAttr('value');
				$('#indiv_num_days').removeAttr('value');
				alert("结束时间不能在开始时间之前");
			} else {
				$('#indiv_num_days').val(generateDateCount(endDay, startDay));
			}
		}
	});

	$('div.header div.nm-right li.login a').on('click', function () {
		console.log("Logout....");
		var url = location.protocol.concat("//").concat(location.host).concat('/database/Authentication/logout.php');
		$.ajax({
			url: url,
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			type: 'GET',
			data: {},
			success: function(response) {
				console.log(response);
				if (response == 'Successfully logout') {
					window.location.href = location.protocol.concat("//").concat(location.host).concat('/login.php');
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	});
});
//更新
function dateRange() {
	$(".showMsg").find(".datePicker").find("select").on("change", function() {
		var currentText = $(this).find("option:selected").text();
		if(currentText == "Customized") {
			$(".datePicker").find(".selectRange").css("display", "inline-block");
			$(this).parentsUntil(".showMsg").siblings().find(".datePicker").find(".selectRange").css("display", "none");
			$(".datePicker").trigger("change");
			$(this).parentsUntil(".showMsg").siblings().find(".datePicker").find("select").find("option").eq(0).attr("selected", 'selected'); //默认选中第一个
		} else {
			$(".datePicker").find(".selectRange").css("display", "none");
		}
	});
}
//分页
//function fenye() {
//	$('#p3').pagination({
//		totalData: 100,
//		showData: 15,
//		coping: true,
//		coping: true,
//		homePage: '首页',
//		endPage: '末页',
//		prevContent: '上页',
//		nextContent: '下页',
//		callback: function(api) {
//			var i = api.getCurrent(); //获取当前页
//			$('#logBox').html('<li class="reportTitle">' +
//				'<dl>' +
//				'<dd>订单号</dd>' +
//				'<dd>团号</dd>' +
//				'<dd>状态</dd>' +
//				'<dd>销售人员</dd>' +
//				'<dd>利润</dd>' +
//				'<dd>备用金</dd>' +
//				'<dd>报账</dd>' +
//				'<dd>巴士公司</dd>' +
//				'<dd>出团日期</dd>' +
//				'<dd>导游</dd>' +
//				'</dl>' +
//				'</li>' + '<li>' + '<dl>' +
//				'<dd>' + '<a class="callout_button">订单' + i + '</a>' + '</dd>' +
//				'<dd class="getGroupNum">456' + i + '</dd>' +
//				'<dd>seleted</dd>' +
//				'<dd>Alex</dd>' +
//				'<dd>100</dd>' +
//				'<dd>300</dd>' +
//				'<dd>200</dd>' +
//				'<dd>abc company</dd>' +
//				'<dd>2018-08-01</dd>' +
//				'<dd class="guideName">Alex</dd>' +
//				'</dl>' +
//				'</li>');
//			$(".callout_button").click(function() {
//				$("#dialog").css("display", "block");
//				var getGroupNum = $(this).parent().siblings("dd.getGroupNum").text();
//				$("#dialog").find("#updateGroupNum").val(getGroupNum); //团号
//				autoCenter($("#dialog"));
//			});
//
//			function autoCenter(el) {
//				var bodyW = $(window).width();
//				var bodyH = $(window).height();
//				var elW = el.width();
//				var elH = el.height();
//				$("#dialog").css({
//					"left": (bodyW - elW) / 2 + 'px',
//					"top": (bodyH - elH) / 2 + 'px'
//				});
//			};
//			var leftHeight = $(".navInfo ul").height()
//			var rightHeight = $(".theamInfo").height();
//			if(rightHeight > leftHeight) {
//				$(this).blur();
//				$(".navInfo ul").css("height", rightHeight);
//			}
//			if(rightHeight < leftHeight) {
//				$(this).blur();
//				$(".navInfo ul").css("height", rightHeight);
//			}
//		}
//	});
//	$('#p4').pagination({
//		totalData: 100,
//		showData: 15,
//		coping: true,
//		coping: true,
//		homePage: '首页',
//		endPage: '末页',
//		prevContent: '上页',
//		nextContent: '下页',
//		callback: function(api) {
//			var i = api.getCurrent(); //获取当前页
//			$('#logBox2').html('<li class="reportTitle">' +
//				'<dl>' +
//				'<dd>订单号</dd>' +
//				'<dd>创建时间</dd>' +
//				'<dd>导游</dd>' +
//				'<dd>团号</dd>' +
//				'<dd>零售商</dd>' +
//				'<dd>销售人员</dd>' +
//				'<dd>价格</dd>' +
//				'<dd>收到金额</dd>' +
//				'<dd>利润</dd>' +
//				'<dd>Clear</dd>' +
//				'<dd>Lock</dd>' +
//				'</dl>' +
//				'</li>' + '<li>' + '<dl>' +
//				'<dd>' + '<a class="callout_button2">12' + i + '</a>' + '</dd>' +
//				'<dd>2018-03-' + i + '</dd>' +
//				'<dd class="guideName2">Alex</dd>' +
//				'<dd class="getGroupNum2">456' + i + '</dd>' +
//				'<dd>途牛</dd>' +
//				'<dd>Terry</dd>' +
//				'<dd>100</dd>' +
//				'<dd>300</dd>' +
//				'<dd>20</dd>' +
//				'<dd>Yes</dd>' +
//				'<dd>No</dd>' +
//				'</dl>' +
//				'</li>');
//			$(".callout_button2").click(function() {
//				$("#dialog2").css("display", "block");
//				var getGroupNum = $(this).parent().siblings("dd.getGroupNum2").text();
//				$("#dialog2").find("#updateGroupNum2").val(getGroupNum); //团号
//				autoCenter($("#dialog2"));
//			});
//
//			function autoCenter(el) {
//				var bodyW = $(window).width();
//				var bodyH = $(window).height();
//				var elW = el.width();
//				var elH = el.height();
//				$("#dialog2").css({
//					"left": (bodyW - elW) / 2 + 'px',
//					"top": (bodyH - elH) / 2 + 'px'
//				});
//			};
//			var leftHeight = $(".navInfo ul").height()
//			var rightHeight = $(".theamInfo").height();
//			if(rightHeight > leftHeight) {
//				$(this).blur();
//				$(".navInfo ul").css("height", rightHeight);
//			}
//			if(rightHeight < leftHeight) {
//				$(this).blur();
//				$(".navInfo ul").css("height", rightHeight);
//			}
//
//		}
//	});
//}
//更新部分弹出的对话框的相应操作
function actionForm(actionCancel, actionDelete, actionAmend, actionDialog) {
	//取消订单
	actionCancel.find("a").on("click", function() {
		actionDialog.css("display", "none");
	});
	//删除订单
	actionDelete.find("a").on("click", function() {
		delFlag = $("#updateGroupNum").val(); //团号
		for(var i = 0; i < $("dd.getGroupNum").length; i++) {
			if($($("dd.getGroupNum")[i]).text() == delFlag) {
				$($("dd.getGroupNum")[i]).parent().parent().remove(); //删除团号相同的订单
			}
		}
		//散拼团更新页删除
		delFlag2 = $("#updateGroupNum2").val(); //团号
		for(var i = 0; i < $("dd.getGroupNum2").length; i++) {
			if($($("dd.getGroupNum2")[i]).text() == delFlag2) {
				$($("dd.getGroupNum2")[i]).parent().parent().remove(); //删除团号相同的订单
			}
		}

		//actionDialog.css("display", "none");
		var leftHeight = $(".navInfo ul").height()
		var rightHeight = $(".theamInfo").height();
		if(rightHeight < leftHeight) {
			$(this).blur();
			$(".navInfo ul").css("height", rightHeight);
		}
	});
	//修改订单
	actionAmend.find("a").on("click", function() {
		delFlag = $("#updateGroupNum").val(); //团号
		var guideText = $("#updateGuide").val(); //修改的导游信息
		for(var i = 0; i < $("dd.getGroupNum").length; i++) {
			if($($("dd.getGroupNum")[i]).text() == delFlag) {
				$($("dd.getGroupNum")[i]).parent().parent().find(".guideName").text(guideText); //修改导游名字
				$($("dd.getGroupNum")[i]).parent().parent().css("background-color", "#f2f5ff");
			}
		}
		//散拼团更新页修改
		delFlag2 = $("#updateGroupNum2").val(); //团号
		var guideText = $("#updateGuide2").val(); //修改的导游信息
		for(var i = 0; i < $("dd.getGroupNum2").length; i++) {
			if($($("dd.getGroupNum2")[i]).text() == delFlag2) {
				$($("dd.getGroupNum2")[i]).parent().parent().find(".guideName2").text(guideText); //修改导游名字
				$($("dd.getGroupNum2")[i]).parent().parent().css("background-color", "#f2f5ff");
			}
		}
		//actionDialog.css("display", "none");
	});
}

function generateReport() {
	$("a#generate").on("click", function() {
		$("#logBox2").css("display", "block");
		$(".nav-box").css("display", "block");
		heightRange();
	});
}
//统一高度
//左右两侧保持高度相等
window.onload = function heightRange() {
	var leftHeight = $(".navInfo ul").height()
	var rightHeight = $(".theamInfo").height();
	if(rightHeight > leftHeight) {
		$(this).blur();
		$(".navInfo ul").css("height", rightHeight);
	}
	if(rightHeight < leftHeight) {
		$(this).blur();
		$(".navInfo ul").css("height", rightHeight);
	}
}

function heightRange() {
	var leftHeight = $(".navInfo ul").height()
	var rightHeight = $(".theamInfo").height();
	if(rightHeight > leftHeight) {
		$(this).blur();
		$(".navInfo ul").css("height", rightHeight);
	}
	if(rightHeight < leftHeight) {
		$(this).blur();
		$(".navInfo ul").css("height", rightHeight);
	}
}

//更新页面准备金计算表:
//传入：触发框，领队人数，游客人数，起始时间，结束时间，天数，准备金表，接收天数，接收开始时间，接收人数
function updateCashReport(updateReserve, leadNum, visitorNum, fundMsg, msgDayNum, msgStartTime, msgPeopleCount, startTime, endTime, dayCount) {
	// 点击准备金弹出准备金计算表
	updateReserve.on("focus", function() {
		if(leadNum.val() !== "" && visitorNum.val() !== "" &&
			startTime.val() !== "" && dayCount.val() !== "") {
			fundMsg.css("display", "block");
			msgDayNum.val(dayCount.val());
			msgStartTime.val(startTime.val());
			msgPeopleCount.val(parseInt(leadNum.val()) + parseInt(visitorNum.val()));
			var leftHeight = $(".navInfo ul").height()
			var rightHeight = $(".theamInfo").height();
			if(rightHeight > leftHeight) {
				$(this).blur();
				$(".navInfo ul").css("height", rightHeight);
			}
		} else {
			updateReserve.blur();
			alert("请填写出团人数，领队人数和日期信息");
		}

	});
	//生成报表：
	var addListItem1 = function(html) {
		var $html = $(html);
		$('#updateUserTab').append($html);
		$html.addClass("reserveListItem1");
	}
	$("a#updateProTab").on("click", function() {
//		$(this).addClass("tabhover");
		$(".updateUserTab").empty();
		$(".updateDriverTipItem").empty();
		var lunch = $("#updateLunch").val();
		var dinner = $('#updateDinner').val();
		var count = msgDayNum.val(); //天数
		var lhnum = msgStartTime.val(); //出发日期
		var numPeople = msgPeopleCount.val();
		var date;
		for(var i = 0; i < count; i++) {
			date = addByTransDate(lhnum, i);
			addListItem1("<li>" + "<label>" + date + "</label></li>");
		}
		$('.reserveListItem1').each(function() {
			var $lunchHtml = $("<input type='text' value='" + lunch + "'/>");
			$(this).append($lunchHtml);
			$lunchHtml.addClass("reserveInput");
			var $dinnerHtml = $("<input type='text' value='" + dinner + "'/>");
			$(this).append($dinnerHtml);
			$dinnerHtml.addClass("reserveInput");
		});
		$('.updateDriverTipItem').append("<label>司机小费</label>");
		var $tipHtml = $("<input type='text' value='" + 5 * count * numPeople + "'/>");
		$('.updateDriverTipItem').append($tipHtml);
		$tipHtml.addClass("driverTipInput");

		fundMsg.css("display", "block");
		$(".updateUserCard").css("display", "block");

		// 准备金 = 司机小费 + （午餐 + 晚餐）* 天数 * 人数
		updateReserve.val(Number($('.driverTipInput').val()) + (Number(lunch) + Number(dinner)) * count * numPeople);

		//左右两侧保持高度相等
		var leftHeight = $(".navInfo ul").height();
		var rightHeight = $(".theamInfo").height();
		if(rightHeight > leftHeight) {
			$(this).blur();
			$(".navInfo ul").css("height", rightHeight);
		}
		if(rightHeight < leftHeight) {
			$(this).blur();
			$(".theamInfo").css("height", leftHeight);
		}
	});

	// 修改午餐或晚餐和司机小费，自动更新准备金
	$(document).on('keyup', '.reserveInput, .driverTipInput', function() {
		var sum = 0;
		var numPeople = msgPeopleCount.val();
		$('.reserveInput').each(function() {
			sum += Number($(this).val());
		});
		updateReserve.val(sum * numPeople + Number($('.driverTipInput').val()));
	});
}

function dateTimeCalculate(startTime, endTime, dayCount) {
	// 根据出发日期计算天数或者结束日期
	startTime.on('change', function() {
		var startTime_update = startTime.val();
		var endTime_update = endTime.val();

		var startNum = parseInt(startTime_update.replace(/-/g, ''), 10);
		var endNum = parseInt(endTime_update.replace(/-/g, ''), 10);

		var startDay = new Date(startTime_update);
		var endDay = new Date(endTime_update);

		if(endDay == 'Invalid Date') {
			var diff = dayCount.val();
			if(diff != undefined) {
				endTime.val(addByTransDate(startTime_update, parseInt(diff) - 1));
			}
		} else {
			if(startNum > endNum) {
				endTime.removeAttr('value');
				dayCount.removeAttr('value');
				alert("结束时间不能在开始时间之前");
			} else {
				dayCount.val(generateDateCount(endDay, startDay));
			}
		}
	});
	// 根据结束日期生成天数
	endTime.on('change', function() {
		var startTimes = startTime.val();
		var endTimes = endTime.val();
		var startNum = parseInt(startTimes.replace(/-/g, ''), 10);
		var endNum = parseInt(endTimes.replace(/-/g, ''), 10);
		if(startNum > endNum) {
			endTime.removeAttr('value');
			dayCount.removeAttr('value');
			alert("结束时间不能在开始时间之前！");
		} else {
			var days = generateDateCount(endTimes, startTimes);
			if(!isNaN(days)) {
				dayCount.val(days);
			}
		}
	});
	//根据天数计算结束日期
	dayCount.on('keyup', function() {
		endTime.val(addByTransDate(startTime.val(), parseInt(dayCount.val()) - 1));
	});
	var generateDateCount = function(endDay, startDay) {
		var endDay = new Date(endDay);
		var startDay = new Date(startDay);
		var diff = new Date(endDay - startDay);
		var days = diff / 1000 / 60 / 60 / 24 + 1;
		return days;
	}
}
//利润计算
//收到金额、返现、价格（总花费）、利润
function profit(amountReceived, returnCash, cost, profit) {
	returnCash.on('keypress', function() {
		var received = amountReceived.val(); //收到金额
		var backCash = returnCash.val(); //返现
		var totalCost = cost.val(); //总花费
		var profits = parseInt(received) + parseInt(backCash) - parseInt(totalCost);
		profit.val(profits);
	});
}
//折扣
function tourDiscount(discountText, discountNotice, discountApply, subtractNum, discountOption) {
	heightRange();
	discountOption.find("dd").on("click", function() {
		$(this).addClass("option-active").siblings().removeClass("option-active");
	});
	discountApply.on("click", function() {
		//选中折扣金额
		if(discountOption.find("dd.coupon").hasClass("option-active")) {
			var reg = /^\d+(\.\d{1,2})?$/;
			if(discountText.val() == "" || !reg.test(discountText.val())) {
				discountNotice.css("display", "none");
				alert('请输入正确的折扣金额');
			} else {
				discountNotice.css("display", "block");
				subtractNum.text('优惠金额: ' + discountText.val());
				heightRange();
			}
		}
		//选中折扣码
		else {
			var url = location.protocol.concat("//").concat(location.host).concat('/database/couponSearch.php');
			$.ajax({
				url: url,
				type: 'post',
				data: {
					couponCode: discountText.val()
				},
				success: function(response) {
					console.log(response);
					if(response == "") {
						alert('折扣码不存在, 请重新输入正确的折扣码');
						discountNotice.css("display", "none")
					} else if(response == 'Expired') {
						discountNotice.css("display", "block");
						subtractNum.text('该折扣码已过期');
					} else {
						discountNotice.css("display", "block");
						subtractNum.text('优惠金额: ' + response);
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});
		}
	});
}
//点击提交弹出确认框
function confirmBox(submitInfo, confirmBox1, actionConfirm, actionCancel) {
	heightRange();
	actionCancel.on("click", function() {
		confirmBox1.css("display", "none");
	});
}

//function createAndUpdate() {
//  $(".showMsg").find(".navGroup").find("ul").find("li.updateItem").on("click", function() {
//      heightRange();
//  });
//  $(".navInfo").find("li").find(".detailMsg").find("dd").on("click", function() {
//     heightRange();
//  });
//}

// 生成搜索列表
function autocomplete(inp, arr) {
	/*
	  the autocomplete function takes two arguments,
	  the text field element and an array of possible autocompleted values
	*/
	var currentFocus;
	/*execute a function when someone writes in the text field:*/
	inp.addEventListener("input", function(e) {
		var a, b, i, val = this.value;
		/*close any already open lists of autocompleted values*/
		closeAllLists();
		if(!val) {
			return false;
		}
		currentFocus = -1;
		/*create a DIV element that will contain the items (values):*/
		a = document.createElement("DIV");
		a.setAttribute("id", this.id + "autocomplete-list");
		a.setAttribute("class", "autocomplete-items");
		/*append the DIV element as a child of the autocomplete container:*/
		this.parentNode.appendChild(a);
		/*for each item in the array...*/
		var resCount = 0;
		for(i = 0; i < arr.length; i++) {
			/*check if the item starts with the same letters as the text field value:*/
			if(arr[i].toUpperCase().includes(val.toUpperCase())) {
				/*create a DIV element for each matching element:*/
				b = document.createElement("DIV");
				var index = arr[i].toUpperCase().indexOf(val.toUpperCase());
				/*make the matching letters bold:*/
				b.innerHTML = arr[i].substring(0, index);
				b.innerHTML += "<strong>" + arr[i].substring(index, index + val.length) + "</strong>";
				b.innerHTML += arr[i].substring(index + val.length);
				/*insert a input field that will hold the current array item's value:*/
				b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
				/*execute a function when someone clicks on the item value (DIV element):*/
				b.addEventListener("click", function(e) {
					/*insert the value for the autocomplete text field:*/
					inp.value = this.getElementsByTagName("input")[0].value;
					/*close the list of autocompleted values,
					(or any other open lists of autocompleted values:*/
					closeAllLists();
				});
				a.appendChild(b);
				resCount++;
			}
		}
		if(resCount == 0) {
			b = document.createElement("DIV");
			b.innerHTML = "<strong>No matched result</strong>";
			a.appendChild(b);
		}
	});
	/*execute a function presses a key on the keyboard:*/
	inp.addEventListener("keyup", function(e) {
		var x = document.getElementById(this.id + "autocomplete-list");
		if(x) {
			x = x.getElementsByTagName("div");
		}
		if(e.keyCode == 40) {
			/*If the arrow DOWN key is pressed,
			increase the currentFocus variable:*/
			currentFocus++;
			/*and and make the current item more visible:*/
			addActive(x);
		} else if(e.keyCode == 38) { //up
			/*If the arrow UP key is pressed,
			decrease the currentFocus variable:*/
			currentFocus--;
			/*and and make the current item more visible:*/
			addActive(x);
		} else if(e.keyCode == 13) {
			/*If the ENTER key is pressed, prevent the form from being submitted,*/
			e.preventDefault();
			if(currentFocus > -1) {
				/*and simulate a click on the "active" item:*/
				if(x) {
					x[currentFocus].click();
				}
			}
		}
	});

	function addActive(x) {
		/*a function to classify an item as "active":*/
		if(!x) {
			return false;
		}
		/*start by removing the "active" class on all items:*/
		removeActive(x);
		if(currentFocus >= x.length) {
			currentFocus = 0;
		}
		if(currentFocus < 0) {
			currentFocus = (x.length - 1);
		}
		/*add class "autocomplete-active":*/
		x[currentFocus].classList.add("autocomplete-active");
	}

	function removeActive(x) {
		/*a function to remove the "active" class from all autocomplete items:*/
		for(var i = 0; i < x.length; i++) {
			x[i].classList.remove("autocomplete-active");
		}
	}

	function closeAllLists(elmnt) {
		/*close all autocomplete lists in the document,
		except the one passed as an argument:*/
		var x = document.getElementsByClassName("autocomplete-items");
		for(var i = 0; i < x.length; i++) {
			if(elmnt != x[i] && elmnt != inp) {
				x[i].parentNode.removeChild(x[i]);
			}
		}
	}
	/*execute a function when someone clicks in the document:*/
	document.addEventListener("click", function(e) {
		closeAllLists(e.target);
	});
}

//提交成功的提示框
function successToolTip() {
	$("#confirmInfoBox").find("button.actionConfirm").on("click", function() {
		$("#successToolTip").removeClass("nm-hide");
	});

}
