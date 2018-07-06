//散拼团的js
//散拼团表单提交
function sendFormMsg() {
	function getData() {
		var data = {
			indiv_tour_id: $("#indiv_tour_id").val(),
			indiv_tour_name: $("#indiv_tour_name").val(),
			indiv_salesperson: $("#indiv_salesperson").val(),
			indiv_wholesaler: $("#indiv_wholesaler").val(),
			indiv_touristCount: $("#indiv_touristCount").val(),
			indiv_source: $("#indiv_source").val(),
			indiv_note: $("#indiv_note").val(),
			indiv_startTime: $("#indiv_startTime").val(),
			indiv_endTime: $("#indiv_endTime").val(),
			indiv_num_days: $("#indiv_num_days").val(),
			indiv_total_cost: $("#indiv_total_cost").val(),
			indiv_exchange_rate: $("#indiv_exchange_rate").val()
		};

		var currency = [];
		var coupon = [];
		var payment_amount = [];

		for (var i = 0; i < individualTourCustomerList.length; i++) {
			currency.push(individualTourCustomerList[i].indiv_currency);
			coupon.push(individualTourCustomerList[i].indivDiscountText);
			payment_amount.push(individualTourCustomerList[i].indiv_price);
		}
		Object.assign(data, {
			currency: JSON.stringify(currency),
			coupon: JSON.stringify(coupon),
			payment_amount: JSON.stringify(payment_amount)
		});

		return data;
	}

	function resetInputForm() {
		$("#indivDiscountNotice").addClass("nm-hide");
		$('#createIndivTourForm').trigger("reset"); //重置表单

		$("li.customerInfo").remove();
		$("#customerInfoArea").hide();
		$("#customerInfoArea .updateInfo").hide();
		$("#customerInfoAreaDivider").hide();
		individualTourCustomerList.length = 0;
		var leftHeight = $(".navInfo ul").height()
		var rightHeight = $(".theamInfo").height();
		if(rightHeight < leftHeight) {
			$(this).blur();
			$(".navInfo ul").css("height", rightHeight);
		}
	}

	$("#indivTourSubmit").click(function() {
		var indiv_tour_id = $("#indiv_tour_id").val(); //散拼团团号
		var indiv_tour_name = $("#indiv_tour_name").val(); //散拼团团名
		var indiv_salesperson = $("#indiv_salesperson").val() //散拼团销售
		var indiv_wholesaler = $("#indiv_wholesaler").val(); //零售商
		var indiv_touristCount = $("#indiv_touristCount").val(); //参团人数
		var indiv_source = $("#indiv_source").val(); //来源
		var indiv_note = $("#indiv_note").val(); //备注
		var indiv_startTime = $("#indiv_startTime").val() //出发日期
		var indiv_endTime = $("#indiv_endTime").val() //结束日期
		var indiv_num_days = $("#indiv_num_days").val() //天数
		var indiv_total_cost = $("#indiv_total_cost").val() //总花费


		if(indiv_tour_id == "" || indiv_tour_name == "" || indiv_salesperson == "" || indiv_wholesaler == "" ||
			indiv_touristCount == "" || indiv_source == "" || indiv_startTime == "" || indiv_endTime == "" || indiv_total_cost == "") {
			alert("看看你是不是填完了");
			return false;
		}
		$(".individualtourCreateConfirmBox").css("display", "block");
	});

	$("#individualTourCreateActionConfirm").on('click', function() {
		var inputData = getData();

		var url = location.protocol.concat("//").concat(location.host).concat('/database/IndividualTourCreateDB.php');
		$.ajax({
			url: url,
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			type: 'post',
			data: inputData,
			success: function(response) {
				var exchange_rate = inputData['indiv_exchange_rate'];
				var individualTourId = response;
				for(var i = 0; i < individualTourCustomerList.length; i++) {
					customerData = {
						fname: individualTourCustomerList[i].firstName,
						lname: individualTourCustomerList[i].lastName,
						email: individualTourCustomerList[i].email,
						phone: individualTourCustomerList[i].phone,
						otherContactWay: individualTourCustomerList[i].otherContactWay,
						otherContactInfo: individualTourCustomerList[i].otherContactNumber,
						birthday: individualTourCustomerList[i].birthday,
						gender: individualTourCustomerList[i].gender,
						zipcode: individualTourCustomerList[i].zipcode,
						joinDate: individualTourCustomerList[i].joinDate,
						joinLocation: individualTourCustomerList[i].joinLocation,
						leaveDate: individualTourCustomerList[i].leaveDate,
						leaveLocation: individualTourCustomerList[i].leaveLocation,
						notice: individualTourCustomerList[i].notice,

						currency: individualTourCustomerList[i].indiv_currency,
						paymentType: individualTourCustomerList[i].indiv_payment_type,
						price: individualTourCustomerList[i].indiv_price,
						coupon: individualTourCustomerList[i].indivDiscountText,

						individualTourId: individualTourId,
						exchange_rate: exchange_rate
					}

					var url = location.protocol.concat("//").concat(location.host).concat('/database/addCustomerDB.php');
					$.ajax({
						url: url,
						headers: {
							'Content-Type': 'application/x-www-form-urlencoded'
						},
						type: 'post',
						data: customerData,
						success: function(response) {
							resetInputForm();
							$(".individualtourCreateConfirmBox").css("display", "none");

							$(".individualtourCreateSuccessBox").css("display", "block");
							$(".individualtourCreateSuccessBox p.confirmNotice").text("提交成功");
							$(".individualtourCreateSuccessBox p.confirmNotice").find("img").attr("src","../img/userConfirm.png");
						},
						error: function(jqXHR, textStatus, errorThrown) {
							console.log("插入失败")
							console.log(textStatus, errorThrown);
						}
					});
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	});

	$("#individualTourCreateActionCancel").on('click', function() {
		$(".individualtourCreateConfirmBox").css("display", "none");
	});
	$("#individualtourCreateSuccessConfirm").on('click', function() {
		$(".individualtourCreateSuccessBox").css("display", "none");
	});
}
//添加客户
function addClients() {
	$("#indivOtherContact").on('change', function() {
		$("#indivOtherContactLabel").text($("#indivOtherContact").val() + "帐号");
	});

	$(".newClients").on("click", function() {
		$(".newClientsMsg").css({
			"display": "block",
			"margin-top": "20px",
			"padding-top": "10px",
			"border-top": "dashed 1px #d2d2d2"
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

	$("#addCustomerInfo").on("click", function() {
		if($('#indivFirstName').val() == "" || $("#indivLastName") == "" || $("#indiv_price").val() == "") {
			alert("请确认姓名和价格信息已填写");
		} else {
			var customerInfo = {
				lastName: $('#indivLastName').val(),
				firstName: $('#indivFirstName').val(),
				email: $("#indivClientEmail").val(),
				phone: $("#indivClientTel").val(),
				otherContactWay: $("#indivOtherContact").val(),
				otherContactNumber: $("#indivOtherContactNumber").val(),
				birthday: $("#indivBirthday").val(),
				gender: $("#indivGender").val(),
				zipcode: $("#indivZipCode").val(),
				notice: $("#indivOtherMsg").val(),
				joinDate: $("#indivJoinDate").val(),
				joinLocation: $("#indivJoinLocation").val(),
				leaveDate: $("#indivLeaveDate").val(),
				leaveLocation: $("#indivLeaveLocation").val(),

				indiv_currency: $("#indiv_currency").val(),
				indiv_payment_type: $("#indiv_payment_type").val(),
				indiv_price: $("#indiv_price").val()
			};

			if ($("#indivDiscountText").val() != "" && document.getElementById('indivDiscountNotice').style.display === 'block') {
				Object.assign(customerInfo, {
					indivDiscountText: $("#indivDiscountText").val()
				})
			} else {
				Object.assign(customerInfo, {
					indivDiscountText: 0
				})
			}
			individualTourCustomerList.push(customerInfo);

			// 如果没填其他联系方式，则不显示该栏信息
			var otherContactInfo = ($("#indivOtherContactNumber").val() == "") ? "" : $("#indivOtherContact").val() + ": " + $("#indivOtherContactNumber").val();
			var joinGroup; //参团
			var leaveGroup; //离团
			var customer; //客户
			if(customerInfo.joinDate == "" || customerInfo.joinLocation == "") {
				joinGroup = customerInfo.joinDate + customerInfo.joinLocation;
			} else {
				joinGroup = customerInfo.joinDate + ' / ' + customerInfo.joinLocation;
			}
			if(customerInfo.leaveDate == "" || customerInfo.leaveLocation == "") {
				leaveGroup = customerInfo.leaveDate + customerInfo.leaveLocation;

			} else {
				leaveGroup = customerInfo.leaveDate + ' / ' + customerInfo.leaveLocation;
			}
			if(customerInfo.birthday == "") {
				customer = customerInfo.lastName + ' ' + customerInfo.firstName + ' / ' + customerInfo.gender + customerInfo.birthday;
			} else {
				customer = customerInfo.lastName + ' ' + customerInfo.firstName + ' / ' + customerInfo.gender + ' / ' + customerInfo.birthday;
			}

			var paymentInfo = "";
			if ($("#indivDiscountText").val() == "") {
				paymentInfo = $("#indiv_currency").val() + $("#indiv_price").val()
			} else if (document.getElementById('indivDiscountNotice').style.display === 'block') {
				var acturalPayment = ($("#indiv_price").val() - $("#indivSubtractNum").text().replace(/[^0-9\.]+/g,""));
				paymentInfo = $("#indiv_currency").val() + acturalPayment + " (" + $("#indiv_price").val() + "-" + $("#indivSubtractNum").text().replace(/[^0-9\.]+/g,"") + ")";
			} else {
				paymentInfo = $("#indiv_currency").val() + $("#indiv_price").val()
			}

			var e =
				`
			<li>
				<dl>
					<dd class="display-customer-info">` + customer + `</dd>
					<dd class="display-customer-email">` + $("#indivClientEmail").val() + `</dd>
					<dd class="display-customer-phone">` + $("#indivClientTel").val() + `</dd>
					<dd class="display-customer-other-contact">` + otherContactInfo + `</dd>
					<dd class="display-customer-zipcode">` + $("#indivZipCode").val() + `</dd>
					<dd class="display-customer-join-info">` + joinGroup + `</dd>
					<dd class="display-customer-leave-info">` + leaveGroup + `</dd>
					<dd class="display-customer-actual paymentactual">` + paymentInfo + `</dd>
					<dd class="display-customer-other-msg">` + $("#indivOtherMsg").val() + `</dd>
					<dd>` +
				'<a href="javascript:void(0)" class="editInfo">编辑</a>' +
				'<a href="javascript:void(0)" class="deleteCustomerInfo">删除</a>' +

				+`</dd>
				</dl>
			</li>
			`;

			$("#customerInfoArea").show();
			$("#customerInfoArea .updateInfo").show();
			$("#customerInfoAreaDivider").show();
			$(e).appendTo("#customerInfo").addClass("customerInfo");
			$("#indivDiscountNotice").css("display", "none");

			var leftHeight = $(".navInfo ul").height()
			var rightHeight = $(".theamInfo").height();
			if(rightHeight > leftHeight) {
				$(this).blur();
				$(".navInfo ul").css("height", rightHeight);
			}
			// Reset form
			resetCustomerForm();
		}
	});
	$("#indivTourCancel").on("click", function() {
		$('.addCustomerArea').empty();
		$('#createIndivTourForm').trigger('reset');
		resetCustomerForm();

		$("#indivDiscountNotice").addClass("nm-hide");
		$("li.customerInfo").remove();
		$("#customerInfoArea").hide();
		$("#customerInfoArea .updateInfo").hide();
		$("#customerInfoAreaDivider").hide();
		individualTourCustomerList.length = 0;

		var leftHeight = $(".navInfo ul").height()
		var rightHeight = $(".theamInfo").height();
		if(rightHeight < leftHeight) {
			$(".navInfo ul").css("height", rightHeight);
		}
	});


	$("#indiv_startTime").on("change", function() {
		$("#joinDate").val($(this).val());
	});
	$("#indiv_endTime").on("change", function() {
		$("#leaveDate").val($(this).val());
	});
	$("#otherContact").on("change", function() {
		$("#otherContactLabel").text($(this).val() + "帐号");
	});
	$("#edit-otherContact").on("change", function() {
		$("#edit-otherContactLabel").text($(this).val() + "帐号");
	});
}
//客户信息验证
function client_check() {
	//电话验证
	$("#clientTel").on('change', function() {
		var reg = /^(?:\(?[0\+]?\d{1,3}\)?)[\s-]?(?:0|\d{1,4})[\s-]?(?:(?:13\d{9})|(?:\d{7,8}))$/;
		if($(this).val().search(reg) == -1) {
			alert("电话号码格式不正确");
			$(this).addClass("error");
			$(this).focus();
		} else {
			$(this).blur();
			$(this).removeClass("error");
			$(this).next("input").focus();
		}
		return true;
	});
	//邮箱验证
	$("#clientEmail").on('change', function() {
		var reg = /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/;
		if($(this).val().search(reg) == -1) {
			$(this).addClass("error");
			$(this).focus();
			alert("邮箱格式不正确");
		} else {
			$(this).blur();
			$(this).removeClass("error");
			$(this).next("input").focus();
		}
		return true;
	});
	//生日验证
	$("#birthday").on('change', function() {
		var reg = /^[\d]{4}[-\ ][\d]{1,2}[-\ ][\d]{1,2}$/;
		if($(this).val().search(reg) == -1) {
			alert("邮箱格式不正确,请参考1995-10-11格式填写");
			$(this).addClass("error");
			$(this).focus();
		} else {
			$(this).blur();
			$(this).removeClass("error");
			$(this).next("input").focus();
		}
		return true;
	});
	//邮政编码验证
	$("#zipCode").on('change', function() {
		var reg = /^[0-9][0-9]{5}$/;
		if($(this).val().search(reg) == -1) {
			alert("邮政编码格式不正确,请参考712000格式填写");
			$(this).addClass("error");
			$(this).focus();
		} else {
			$(this).blur();
			$(this).removeClass("error");
			$(this).next("input").focus();
		}
		return true;
	});
}

function checkedCell() {
	$(".bms-tab").find("ul.accountRecordMsg").find("li").click(function() {
		$(this).addClass("accounting-active").siblings().removeClass("accounting-active");
	});
}

function resetCustomerForm() {
	$("#indivLastName").val("");
	$("#indivFirstName").val("");
	$("#indivClientEmail").val("");
	$("#indivClientTel").val("");
	$("#indivOtherContact").val("WeChat");
	$("#indivOtherContactLabel").text("WeChat帐号");
	$("#indivOtherContactNumber").val("");
	$("#indivBirthday").val("");
	$("#indivGender").val("M");
	$("#indivZipCode").val("");
	$("#indivOtherMsg").val("");
	$("#indivJoinDate").val("");
	$("#indivJoinLocation").val("");
	$("#indivLeaveDate").val("");
	$("#indivLeaveLocation").val("");
	$("#indiv_currency").val("USD");
	$("#indiv_payment_type").val("creditcard");
	$("#indiv_price").val("");
	$("#indivDiscountText").val("");
}

$(document).ready(function() {
	$("#indiv_salesperson, #indiv_wholesaler, #indiv_source").on('focus', function() {
		var current_id = $(this).attr('id');
		var target = "";
		if(current_id == 'indiv_salesperson') {
			target = 'salesperson';
		} else if(current_id == 'indiv_source') {
			target = 'source';
		} else if(current_id == 'indiv_wholesaler') {
			target = 'wholesaler';
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
	});

	//删除客户信息
	$(document).on('click', '.deleteCustomerInfo', function() {
		var index = $(".editInfo").index(this);
		individualTourCustomerList.splice(index, 1);
		$(this).parent().parent().parent().remove();
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
		if (individualTourCustomerList.length == 0) {
			$("#customerInfoArea").hide();
			$("#customerInfoArea .updateInfo").hide();
			$("#customerInfoAreaDivider").hide();
		}
	});

	var pos;
	//编辑客户信息
	$(document).on('click', '.editInfo', function() {
		var index = $(".editInfo").index(this);
		var currentCustomerInfo = individualTourCustomerList[index];

		// 显示客户信息
		$(".editcustomerInfo").css("display", "block");
		$("#edit-lastName").val(currentCustomerInfo['lastName']);
		$("#edit-firstName").val(currentCustomerInfo['firstName']);
		$("#edit-clientEmail").val(currentCustomerInfo['email']);
		$("#edit-clientTel").val(currentCustomerInfo['phone']);
		$("#edit-otherContact").val(currentCustomerInfo['otherContactWay']);
		$("#edit-otherContactLabel").text(currentCustomerInfo['otherContactWay'] + "帐号");
		$("#edit-otherContactNumber").val(currentCustomerInfo['otherContactNumber']);
		$("#edit-birthday").val(currentCustomerInfo['birthday']);
		$("#edit-gender").val(currentCustomerInfo['gender']);
		$("#edit-zipCode").val(currentCustomerInfo['zipcode']);
		$("#edit-otherMsg").val(currentCustomerInfo['notice']);
		$("#edit-joinDate").val(currentCustomerInfo['joinDate']);
		$("#edit-joinLocation").val(currentCustomerInfo['joinLocation']);
		$("#edit-leaveDate").val(currentCustomerInfo['leaveDate']);
		$("#edit-leaveLocation").val(currentCustomerInfo['leaveLocation']);

		$("#edit_indiv_currency").val(currentCustomerInfo['indiv_currency']);
		$("#edit_indiv_payment_type").val(currentCustomerInfo['indiv_payment_type']);
		$("#edit_indiv_price").val(currentCustomerInfo['indiv_price']);
		$("#edit_indivTourDiscountText").val(currentCustomerInfo['indivDiscountText']);

		if (!isNaN($("#edit_indivTourDiscountText").val())) {
			$("#edit_indivDiscountOption dd.coupon").addClass("option-active");
			$("#edit_indivDiscountOption dd.discount-code").removeClass("option-active");
		} else {
			$("#edit_indivDiscountOption dd.coupon").removeClass("option-active");
			$("#edit_indivDiscountOption dd.discount-code").addClass("option-active");
		}

		pos = index;
	});

	//确认修改
	$(document).on('click', '#edit-CustomerInfo', function() {
		if($('#edit-firstName').val() == "" || $("#edit-lastName").val() == "" || $("#edit_indivTourDiscountText").val() == "") {
			alert("请确认姓名和价格信息已填写");
		} else {
			alert("信息已修改");
			$(".editcustomerInfo").css("display", "none");
			$(this).blur();

			// 个人信息
			individualTourCustomerList[pos]['lastName'] = $("#edit-lastName").val();
			individualTourCustomerList[pos]['firstName'] = $("#edit-firstName").val();
			individualTourCustomerList[pos]['gender'] = $("#edit-gender").val();
			individualTourCustomerList[pos]['birthday'] = $("#edit-birthday").val();
			if ($("#edit-birthday").val() == "") {
				$("ul#customerInfo").find("li.customerInfo dd.display-customer-info:eq(" + pos + ")").text(
					$("#edit-firstName").val() + " " + $("#edit-lastName").val() + ' / ' + $("#edit-gender").val()
				);
			} else {
				$("ul#customerInfo").find("li.customerInfo dd.display-customer-info:eq(" + pos + ")").text(
					$("#edit-firstName").val() + " " + $("#edit-lastName").val() + ' / ' + $("#edit-gender").val() + " / " + $("#edit-birthday").val()
				);
			}

			// 邮箱
			individualTourCustomerList[pos]['email'] = $("#edit-clientEmail").val();
			$("ul#customerInfo").find("li.customerInfo dd.display-customer-email:eq(" + pos + ")").text($("#edit-clientEmail").val());

			// 电话
			individualTourCustomerList[pos]['phone'] = $("#edit-clientTel").val();
			$("ul#customerInfo").find("li.customerInfo dd.display-customer-phone:eq(" + pos + ")").text($("#edit-clientTel").val());

			// 其他联系方式
			individualTourCustomerList[pos]['otherContactWay'] = $("#edit-otherContact").val();
			individualTourCustomerList[pos]['otherContactNumber'] = $("#edit-otherContactNumber").val();
			if ($("#edit-otherContactNumber").val() != "") {
				$("ul#customerInfo").find("li.customerInfo dd.display-customer-other-contact:eq(" + pos + ")").text(
					$("#edit-otherContact").val() + ": " + $("#edit-otherContactNumber").val()
				);
			}
			individualTourCustomerList[pos]['zipcode'] = $("#edit-zipCode").val();
			$("ul#customerInfo").find("li.customerInfo dd.display-customer-zipcode:eq(" + pos + ")").text($("#edit-zipCode").val());

			// 参团信息
			individualTourCustomerList[pos]['joinDate'] = $("#edit-joinDate").val();
			individualTourCustomerList[pos]['joinLocation'] = $("#edit-joinLocation").val();
			if($("#edit-joinDate").val() == "" || $("#edit-joinLocation").val() == "") {
				$("ul#customerInfo").find("li.customerInfo dd.display-customer-join-info:eq(" + pos + ")").text(
					joinInfo = $("#edit-joinDate").val() + $("#edit-joinLocation").val()
				);
			} else {
				$("ul#customerInfo").find("li.customerInfo dd.display-customer-join-info:eq(" + pos + ")").text(
					joinInfo = $("#edit-joinDate").val() + " / " + $("#edit-joinLocation").val()
				);
			}

			// 离团信息
			individualTourCustomerList[pos]['leaveDate'] = $("#edit-leaveDate").val();
			individualTourCustomerList[pos]['leaveLocation'] = $("#edit-leaveLocation").val();
			if($("#edit-leaveDate").val() == "" || $("#edit-leaveLocation").val() == "") {
				$("ul#customerInfo").find("li.customerInfo dd.display-customer-leave-info:eq(" + pos + ")").text(
					joinInfo = $("#edit-leaveDate").val() + $("#edit-leaveLocation").val()
				);
			} else {
				$("ul#customerInfo").find("li.customerInfo dd.display-customer-leave-info:eq(" + pos + ")").text(
					joinInfo = $("#edit-leaveDate").val() + " / " + $("#edit-leaveLocation").val()
				);
			}

			// 注意事项
			individualTourCustomerList[pos]['notice'] = $("#edit-otherMsg").val();
			$("ul#customerInfo").find("li.customerInfo dd.display-customer-other-msg:eq(" + pos + ")").text($("#edit-otherMsg").val());

			// 实际支付信息
			individualTourCustomerList[pos]['indiv_currency'] = $("#edit_indiv_currency").val();
			individualTourCustomerList[pos]['indiv_payment_type'] = $("#edit_indiv_payment_type").val();
			individualTourCustomerList[pos]['indiv_price'] = $("#edit_indiv_price").val();

			if ($("#edit_indivTourDiscountText").val() != "" && document.getElementById('edit_indivTourDiscountNotice').style.display === 'block') {
				individualTourCustomerList[pos]['indivDiscountText'] = $("#edit_indivTourDiscountText").val();
			} else {
				individualTourCustomerList[pos]['indivDiscountText'] = 0;
			}

			var paymentInfo = "";
			if ($("#edit_indivTourDiscountText").val() == "") {
				paymentInfo = $("#edit_indiv_currency").val() + $("#edit_indiv_price").val()
			} else if (document.getElementById('edit_indivTourDiscountNotice').style.display === 'block') {
				var acturalPayment = ($("#edit_indiv_price").val() - $("#edit_indivTourSubtractNum").text().replace(/[^0-9\.]+/g,""));
				paymentInfo = $("#edit_indiv_currency").val() + acturalPayment + " (" + $("#edit_indiv_price").val() + "-" + $("#edit_indivTourSubtractNum").text().replace(/[^0-9\.]+/g,"") + ")";
			} else {
				paymentInfo = $("#edit_indiv_currency").val() + $("#edit_indiv_price").val()
			}
			$("ul#customerInfo").find("li.customerInfo dd.display-customer-actual:eq(" + pos + ")").text(paymentInfo);

			console.log(individualTourCustomerList);
		}
	});
	//取消编辑框
	$("#close-customer").on("click", function() {
		$(".editcustomerInfo").css("display", "none");
	});
	//确认/重置选中状态
	$(".updateInfo ul.filterBox  li  dl.confirmMsg dd ").find("a").on("mousedown", function() {
		$(this).addClass("confirm-active");
	});
	$(".updateInfo ul.filterBox  li  dl.confirmMsg dd ").find("a").on("mouseup", function() {
		$(this).removeClass("confirm-active");
	});


});
