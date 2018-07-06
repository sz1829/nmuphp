$(document).ready(function() {
	/*
	 *  载入当前页的数据
	 */
	function loadCurrentPage(data) {
		var url = location.protocol.concat("//").concat(location.host).concat('/database/GroupTourGetOrder.php');
		$.ajax({
			url: url,
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			type: 'GET',
			data: data,
			success: function(response) {
				$('ul.tabListDetail').empty();
				$('ul.tabListDetail').append(response);

			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
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
	}

	function loadData(data) {
		var url = location.protocol.concat("//").concat(location.host).concat('/database/getOrderCount.php');
		$.ajax({
			url: url,
			type: 'GET',
			data: data,
			success: function(response) {
				if(response == 0) {
					$(".noResultBox").css("display", "block");
				} else {
					$('.tabListDetail').empty();
					$('#p3').pagination({
						totalData: response,
						showData: 15,
						current: 0,
						coping: true,
						homePage: '首页',
						endPage: '末页',
						prevContent: '上页',
						nextContent: '下页',
						callback: function(api) {
							var i = api.getCurrent(); //获取当前页
							var inputData = data;
							Object.assign(inputData, {
								offset: (i - 1) * 15
							});
							loadCurrentPage(inputData);
						}
					});
					$('ul.pagination').find('a').click();
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	}
	/*
	 * 载入默认数据
	 */
	loadData(getFilterData());

	function getTodayYYYYMMDD() {
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth() + 1;
		var yyyy = today.getFullYear();
		if(dd < 10) {
			dd = '0' + dd;
		}
		if(mm < 10) {
			mm = '0' + mm;
		}
		today = yyyy + '-' + mm + '-' + dd;
		return today;
	}

	/*
	 *   Retuan date in 'YYYY-MM-DD' format
	 */
	function formatDate(date) {
		var month = '' + (date.getMonth() + 1),
			day = '' + date.getDate(),
			year = date.getFullYear();

		if(month.length < 2) month = '0' + month;
		if(day.length < 2) day = '0' + day;

		return [year, month, day].join('-');
	}

	function getFilterData() {
		var from_date = "";
		var to_date = "";
		var transaction_id = $("#group-update-transaction-id-filter").val();
		var group_code = $("#group-update-group-code-filter").val();

		today = getTodayYYYYMMDD();

		var data = {
			orderType: 'group',
			transaction_id: transaction_id,
			group_code: group_code
		};
		if($("#group-update-date-filter").val() == '1') {
			Object.assign(data, {
				from_date: delByTransDate(today, 0),
				to_date: addByTransDate(today, 1)
			});
		} else if($("#group-update-date-filter").val() == '30') {
			Object.assign(data, {
				from_date: delByTransDate(today, 29),
				to_date: addByTransDate(today, 1)
			});
		} else if($("#group-update-date-filter").val() == '90') {
			Object.assign(data, {
				from_date: delByTransDate(today, 89),
				to_date: addByTransDate(today, 1)
			});
		} else if($("#group-update-date-filter").val() == '180') {
			Object.assign(data, {
				from_date: delByTransDate(today, 179),
				to_date: addByTransDate(today, 1)
			});
		} else {
			var dates = $("#group-update-to-date").val().split("-");
			var date = new Date(dates[0], dates[1] - 1, dates[2]);
			var toDate = new Date(date);
			toDate.setDate(date.getDate() + 1);
			toDate = formatDate(toDate);

			Object.assign(data, {
				from_date: $("#group-update-from-date").val(),
				to_date: toDate
			});
		}
		return data;
	}

	/*
	 * 根据筛选条件得到独立团信息
	 */
	$("#group-tour-update-filter").on('click', function() {
		var data = getFilterData();
		loadData(data);
	});
	$("#group-tour-update-reset").on('click', function() {
		$("#group-update-date-filter").val("30");
		$("#group-update-from-date").val("");
		$("#group-update-to-date").val("");
		$(".selectRange").css("display", "none");
		$("#group-update-transaction-id-filter").val("");
		$("#group-update-group-code-filter").val("");
		var data = getFilterData();
		loadData(data);
	});

	/*
	 * 显示选中订单的具体信息
	 */
	$(document).on('click', 'ul.tabListDetail li', function() {
		$(this).addClass("active").siblings().removeClass("active");
		var transactionId = $('.active').find('dl dd.listNum a')['0'].innerText;
		$("#groupDiscountNotice_update").css("display", "none");

		var url = location.protocol.concat("//").concat(location.host).concat('/database/GroupTourEditOrder.php');
		$.ajax({
			url: url,
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			type: 'GET',
			data: {
				action: 'getDetail',
				transaction_id: transactionId
			},
			success: function(response) {
				response = JSON.parse(response);
				$("#updateGroupNum").val(response['group_code']);
				$("#updateFlightNumber").val(response['flight_number']);
				$("#updateBusCompany").val(response['bus_company']);
				$("#updateSalesperson").val(response['salesperson_code']);
				$("#updateTouristGuide").val(response['guide_name']);
				$("#updateGuideTel").val(response['guide_phone']);
				$("#updateAgency").val(response['agency_name']);
				$("#updateSource").val(response['source_name']);
				$("#upadteLeaderNum").val(response['leader_number']);
				$("#updateVisitorNum").val(response['tourist_number']);
				$("#updateNote").val(response['note']);
				$("#updateStartTime").val(response['start_date'].substring(0, 10));
				$("#updateEndTime").val(response['end_date'].substring(0, 10));
				$("#updateDayCount").val(response['duration']);
				$("#updateCurrency").val(response['currency']);
				$("#updatePaymentType").val(response['payment_type']);
				$("#updatePrice").val(response['price']);
				$("#updateReserve").val(response['reserve']);
				$("#updateWriteOff").val(response['write_off']);
				$("#updateTotalCost").val(response['total_cost']);

				if(response['cc_id'] != null) {
					$(".discount-code").addClass("option-active");
					$(".coupon").removeClass("option-active");
					$("#groupDiscountText_update").val(response['cc_code']);
				} else if(response['coupon'] != null) {
					$(".discount-code").removeClass("option-active");
					$(".coupon").addClass("option-active");
					$("#groupDiscountText_update").val(response['coupon']);
				} else {
					$("#groupDiscountText_update").val("");
					$(".discount-code").removeClass("option-active");
					$(".coupon").removeClass("option-active");
				}
				$("#dialog").css("display", "block");
				autoCenter($("#dialog"));
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	});

	function autoCenter(el) {
		var bodyW = $(window).width();
		var bodyH = $(window).height();
		var elW = el.width();
		var elH = el.height();
		$("#dialog").css({
			"left": (bodyW - elW) / 2 + 'px',
			"top": (bodyH - elH) / 2 + 'px'
		});
	};

	/*
	 * 得到销售，导游和来源的下拉列表
	 */
	$("#updateSalesperson, #updateTouristGuide, #updateSource").on('focus', function() {
		var current_id = $(this).attr('id');
		var target = "";
		if(current_id == 'updateSalesperson') {
			target = 'salesperson';
		} else if(current_id == 'updateSource') {
			target = 'source';
		} else if(current_id == 'updateTouristGuide') {
			target = 'touristGuide';
		}

		var url = location.protocol.concat("//").concat(location.host).concat('/database/autoComplete.php');
		$.ajax({
			url: url,
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			type: 'post',
			data: {
				target: target
			},
			success: function(response) {
				autocomplete(document.getElementById(current_id), JSON.parse(response));
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
		// 模拟数据
		// autocomplete(document.getElementById(current_id), ['alex', 'terry']);
	});

	// 得到更新窗口数据
	function getUpdateInfo() {
		var data = {
			action: 'updateOrder',
			transactionId: $('.active').find('dl dd.listNum a')['0'].innerText,

			group_code: $("#updateGroupNum").val(),
			flight_number: $("#updateFlightNumber").val(),
			bus_company: $("#updateBusCompany").val(),
			salesperson: $("#updateSalesperson").val(),
			tourist_guide: $("#updateTouristGuide").val(),
			guide_phone: $("#updateGuideTel").val(),
			agency: $("#updateAgency").val(),
			source: $("#updateSource").val(),
			leader_number: $("#upadteLeaderNum").val(),
			visitor_number: $("#updateVisitorNum").val(),
			note: $("#updateNote").val(),

			start_date: $("#updateStartTime").val(),
			end_date: $("#updateEndTime").val(),
			duration: $("#updateDayCount").val(),

			currency: $("#updateCurrency").val(),
			payment_type: $("#updatePaymentType").val(),
			price: $("#updatePrice").val(),
			reserve: $("#updateReserve").val(),
			write_off: $("#updateWriteOff").val(),
			total_cost: $("#updateTotalCost").val(),
			coupon: $("#groupDiscountText_update").val()
		}
		return data;
	}
	// 更新订单列表的内容
	function updateDisplayInfo(data) {
		$("li.active").find("dd.listGroupNum a").text(data['group_code']);
		$("li.active").find("dd.listJourney a").text(data['start_date'] + '/' + data['end_date']);
		$("li.active").find("dd.listPayment a").text(data['payment_type']);
		$("li.active").find("dd.listCurrency a").text(data['currency']);
		$("li.active").find("dd.listPrice a").text(data['price']);
		$("li.active").find("dd.listCost a").text(data['total_cost'] + '(' + data['reserve'] + '/' + data['write_off'] + ')');
		var reg = /^\d+(\.\d{1,2})?$/;
		var couponValue = 0;
		if(reg.test($("#groupDiscountText_update").val())) {
			couponValue = $("#groupDiscountText_update").val();
			$("li.active").find("dd.listDiscount a").text(couponValue);
			$("li.active").find("dd.listProfit a").text(data['price'] - data['total_cost'] - couponValue);
		} else {
			var url = location.protocol.concat("//").concat(location.host).concat('/database/couponSearch.php');
			$.ajax({
				url: url,
				type: 'post',
				data: {
					couponCode: $("#groupDiscountText_update").val()
				},
				success: function(response) {
					if(response == "") {
						couponValue = 0;
					} else if(response == 'Expired') {
						couponValue = 0;
					} else {
						couponValue = response;
					}
					$("li.active").find("dd.listDiscount a").text(couponValue);
					$("li.active").find("dd.listProfit a").text(data['price'] - data['total_cost'] - couponValue);
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});
		}
		$("li.active").find("dd.item-note").text($("#updateNote").val());
	}

	/*
	 * 修改订单内容
	 */
	$("#updateConfirm").on('click', function() {
		$(".updateEditConfirmBox").css("display", "block");
	});
	$("#updateEditActionConfirm").on('click', function() {
		var data = getUpdateInfo();
		var url = location.protocol.concat("//").concat(location.host).concat('/database/GroupTourEditOrder.php');
		$.ajax({
			url: url,
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			type: 'POST',
			data: data,
			success: function(response) {
				updateDisplayInfo(data);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
		$(".updateEditConfirmBox").css("display", "none");
	});
	$("#updateEditActionCancel").on('click', function() {
		$(".updateEditConfirmBox").css("display", "none");
	});

	/*
	 * 下载准备金
	 */
	$("#updateAndDownloadConfirm").on('click', function() {
		$(".updateAndDownloadConfirmBox").css("display", "block");
	});
	$("#updateAndDownloadActionConfirm").on('click', function() {
		var data = getUpdateInfo();
		var leaderNum = $("#upadteLeaderNum").val(); //导游人数
		var vistorNum = $("#updateVisitorNum").val(); //游客人数
		var tourGuide = $("#updateTouristGuide").val(); //导游
		var startTime = $("#updateStartTime").val(); //出发日期
		var numOfDay = $("#updateDayCount").val(); //天数
		var reserve = $("#updateReserve").val(); //准备金

		var url = location.protocol.concat("//").concat(location.host).concat('/database/GroupTourEditOrder.php');
		$.ajax({
			url: url,
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			type: 'POST',
			data: data,
			success: function(response) {
				var data = getUpdateInfo();
				updateDisplayInfo(data);

				var data = [
					['导游', tourGuide, '出团日期', startTime],
					['领队人数', leaderNum, '游客人数', vistorNum],
					['日期', '午餐', '晚餐', '备注']
				];

				var reserveInput = [];
				$('.reserveInput').each(function() {
					reserveInput.push($(this).val());
				});
				var reserveInfo = [];
				for(var offset = 0; offset < numOfDay; offset++) {
					var row = new Array(addByTransDate(startTime, offset), reserveInput[offset * 2], reserveInput[offset * 2 + 1])
					data.push(row);
				}
				data.push(new Array('司机小费', $('.driverTipInput').val()));
				data.push(new Array('准备金', reserve));

				var csv = '准备金\n';
				data.forEach(function(row) {
					csv += row.join(',');
					csv += "\n";
				});

				var hiddenElement = document.createElement('a');
				hiddenElement.href = 'data:text/csv;charset=utf-8,%EF%BB%BF' + encodeURI(csv);
				hiddenElement.download = '准备金.csv';
				hiddenElement.click();
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
		$(".updateAndDownloadConfirmBox").css("display", "none");
	});
	$("#updateAndDownloadActionCancel").on('click', function() {
		$(".updateAndDownloadConfirmBox").css("display", "none");
	});

	/*
	 * 删除订单
	 */
	$("#deleteConfirm").on('click', function() {
		$(".updateDeleteConfirmBox").css("display", "block");
		$(".updateDeleteConfirmBox").find(".confirmNotice").text("确认删除");
	});
	$("#updateDeleteActionConfirm").on('click', function() {
		var transactionId = $('.active').find('dl dd.listNum a')['0'].innerText;
		var url = location.protocol.concat("//").concat(location.host).concat('/database/GroupTourEditOrder.php');
		$.ajax({
			url: url,
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			type: 'GET',
			data: {
				action: 'deleteOrder',
				transaction_id: transactionId
			},
			success: function(response) {
				console.log("删除成功");
				$("#dialog").css("display", "none");
				$(".updateDeleteConfirmBox").css("display", "none");
				$(".active").remove();
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	});
	$("#updateDeleteActionCancel").on('click', function() {
		$(".updateDeleteConfirmBox").css("display", "none");
	});

	$("#noResultBox .actionBox #actionCancel").on('click', function() {
		$("#noResultBox").css("display", "none");
	});
});

//独立团点击订单号弹出新窗口
function dragForm() {
	var $dialog = $("#dialog");
	//自动居中对话框
	function autoCenter(el) {
		var bodyW = $(window).width();
		var bodyH = $(window).height();
		var elW = el.width();
		var elH = el.height();
		$dialog.css({
			"left": (bodyW - elW) / 2 + 'px',
			"top": (bodyH - elH) / 2 + 'px'
		});
	};
	//点击弹出对话框
	$(".callout_button").click(function() {
		$dialog.css("display", "block");
		var getGroupNum = $(this).parent().siblings("dd.getGroupNum").text();
		$dialog.find("#updateGroupNum").val(getGroupNum); //团号
		autoCenter($dialog);
	});
	//点击关闭对话框
	$(".close_button").click(function() {
		$dialog.css("display", "none");
	});

	//窗口大小改变时，对话框始终居中
	window.onresize = function() {
		autoCenter($dialog);
	};
	//确认/重置选中状态

	$(".updateInfo ul.filterBox  li  dl.confirmMsg dd ").find("a").on("mousedown", function() {
		$(this).addClass("confirm-active");
	});
	$(".updateInfo ul.filterBox  li  dl.confirmMsg dd ").find("a").on("mouseup", function() {
		$(this).removeClass("confirm-active");
	});
	$("a#updateProTab").on("mousedown", function() {
		$(this).addClass("tabhover");
	});
	$("a#updateProTab").on("mouseup", function() {
		$(this).removeClass("tabhover");
	});
	$("a#updateProTab").on("click", function() {
		if($(".updateUserCard.userTab").css("display") == "block") {
			var reserveInputWidth = $(".updateUserCard.userTab").find("ul").find("li").find("input.reserveInput").outerWidth(true);
			var driverTipInputWidth = ((reserveInputWidth - 10) * 2) + "px";
			$("input.driverTipInput").css("cssText", "width:" + driverTipInputWidth + "!important");
		}
	});
	$(window).resize(function() {
		if($(".updateUserCard.userTab").css("display") == "block") {
			var reserveInputWidth = $(".updateUserCard.userTab").find("ul").find("li").find("input.reserveInput").outerWidth(true);
			var driverTipInputWidth = ((reserveInputWidth - 10) * 2) + "px";
			$("input.driverTipInput").css("cssText", "width:" + driverTipInputWidth + "!important");
			console.log(reserveInputWidth);
		}
	});

}
