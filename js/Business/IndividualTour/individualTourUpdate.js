$(document).ready(function() {
	/*
	 *  载入当前页的数据
	 */
	function loadCurrentPage(data) {
		var url = location.protocol.concat("//").concat(location.host).concat('/database/Business/IndividualTour/IndividualTourGetOrder.php');
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
					$('#p4').pagination({
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

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [year, month, day].join('-');
    }

	function getFilterData() {
		var from_date = "";
		var to_date = "";
		var transaction_id = $("#individual-update-transaction-id-filter").val();
		var product_code = $("#individual-update-product-code-filter").val();

		today = getTodayYYYYMMDD();

		var data = {
			orderType: 'individual',
			transaction_id: transaction_id,
			product_code: product_code
		};
		if($("#individual-update-date-filter").val() == '1') {
			Object.assign(data, {
				from_date: delByTransDate(today, 0),
				to_date: addByTransDate(today, 1)
			});
		} else if($("#individual-update-date-filter").val() == '30') {
			Object.assign(data, {
				from_date: delByTransDate(today, 29),
				to_date: addByTransDate(today, 1)
			});
		} else if($("#individual-update-date-filter").val() == '90') {
			Object.assign(data, {
				from_date: delByTransDate(today, 89),
				to_date: addByTransDate(today, 1)
			});
		} else if($("#individual-update-date-filter").val() == '180') {
			Object.assign(data, {
				from_date: delByTransDate(today, 179),
				to_date: addByTransDate(today, 1)
			});
		} else {
			var dates = $("#individual-update-to-date").val().split("-");
            var date = new Date(dates[0], dates[1] - 1, dates[2]);
            var toDate = new Date(date);
            toDate.setDate(date.getDate()+1);
            toDate = formatDate(toDate);

			Object.assign(data, {
				from_date: $("#individual-update-from-date").val(),
				to_date: toDate
			});
		}
		return data;
	}

	/*
	 * 根据筛选条件得到独立团信息
	 */
	$("#individual-tour-update-filter").on('click', function() {
		var data = getFilterData();
		loadData(data);
	});
	$("#individual-tour-update-reset").on('click', function() {
		$("#individual-update-date-filter").val("30");
		$("#individual-update-from-date").val("");
		$("#individual-update-to-date").val("");
		$(".selectRange").css("display", "none");
		$("#individual-update-transaction-id-filter").val("");
		$("#individual-update-product-code-filter").val("");
		var data = getFilterData();
		loadData(data);
	});

	/*
	 * 显示选中订单的具体信息
	 */
	$(document).on('click', 'ul.tabListDetail li', function() {
		$(this).addClass("active").siblings().removeClass("active");
		var transactionId = $('.active').find('dl dd.listNum a')['0'].innerText;
		$("#indivDiscountNotice_update").css("display", "none");

		var url = location.protocol.concat("//").concat(location.host).concat('/database/Business/IndividualTour/EditOrder.php');
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
				individual_tour_id = response['indiv_tour_id'];
				$("#update-product-code").val(response['product_code']);
				$("#update-tour-name").val(response['tour_name']);
				$("#update-salesperson").val(response['salesperson_code']);
				$("#update-wholesaler").val(response['wholesaler_code']);
				$("#update-indiv-number").val(response['indiv_number']);
				$("#update-source").val(response['source_name']);
				$("#update-note").val(response['note']);
				$("#update-start-date").val(response['depart_date'].substring(0, 10));
				$("#update-end-date").val(response['arrival_date'].substring(0, 10));
				$("#update-day-count").val(response['duration']);
				$("#update-currency").val(response['currency']);
				$("#update-payment-type").val(response['payment_type']);
				$("#update-total-cost").val(response['expense']);
				$("#update-receive").val(response['received']);
				if(response['cc_id'] != null) {
					$(".discount-code").addClass("option-active");
					$(".coupon").removeClass("option-active");
					$("#indivDiscountText_update").val(response['cc_code']);
				} else if(response['coupon'] != null) {
					$(".discount-code").removeClass("option-active");
					$(".coupon").addClass("option-active");
					$("#indivDiscountText_update").val(response['coupon']);
				} else {
					$("#indivDiscountText_update").val("");
					$(".discount-code").removeClass("option-active");
					$(".coupon").removeClass("option-active");
				}
				$("#dialog2").css("display", "block");
				autoCenter($("#dialog2"));
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
		$.ajax({
			url: url,
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			type: 'GET',
			data: {
				action: 'getCustomerList',
				transaction_id: transactionId
			},
			success: function(response) {
				individualTourCustomerList.length = 0;
				addCustomerList.length = 0;
				updateCustomerList.length = 0;
				deleteCustomerList.length = 0;

				$('.update-customer-info').remove();

				response = JSON.parse(response);
				for(var i = 0; i < response.length; i++) {
					individualTourCustomerList.push(response[i]);
					var customerInfo = "";
					// Detect Chinese input
					var reg = /[\u3040-\u30ff\u3400-\u4dbf\u4e00-\u9fff\uf900-\ufaff\uff66-\uff9f]/;
					if(reg.test(response[i]['lname'])) {
						customerInfo = response[i]['lname'] + response[i]['fname'];
					} else {
						customerInfo = response[i]['fname'] + ' ' + response[i]['lname'];
					}
					if(response[i]['gender'] != 'UNKNOWN') {
						customerInfo += ' / ' + response[i]['gender'];
					}
					if(response[i]['birth_date'] != null) {
						customerInfo += ' / ' + response[i]['birth_date'].substring(0, 10);
					}

					var email = (response[i]['email'] == null) ? '' : response[i]['email'];

					var phone = (response[i]['phone'] == null) ? '' : response[i]['phone'];

					var otherContact = "";
					if(response[i]['other_contact_number'] != null) {
						otherContact = response[i]['other_contact_type'] + ': ' + response[i]['other_contact_number'];
					}

					var zipcode = (response[i]['zipcode'] == null) ? '' : response[i]['zipcode'];

					var joinInfo = "";
					if(response[i]['join_date'] != null) {
						joinInfo += response[i]['join_date'].substring(0, 10);
					}
					if(response[i]['join_location'] != null) {
						joinInfo += ' / ' + response[i]['join_location'];
					}

					var leaveInfo = "";
					if(response[i]['leave_date'] != null) {
						leaveInfo += response[i]['leave_date'].substring(0, 10);
					}
					if(response[i]['leave_location'] != null) {
						leaveInfo += ' / ' + response[i]['leave_location'];
					}

					var note = (response[i]['note'] == null) ? '' : response[i]['note'];

					var customerData = {
						customerInfo: customerInfo,
						email: email,
						phone: phone,
						otherContact: otherContact,
						zipcode: zipcode,
						joinInfo: joinInfo,
						leaveInfo: leaveInfo,
						note: note
					}

					addCustomer(customerData);
				}

				$("#customerInfoArea").show();
				$("#customerInfoArea .updateInfo").show();
				$("#customerInfoAreaDivider").show();
				actionClientsChart();

			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	});

	function addCustomer(data) {
		var e =
			`
			<li class="update-customer-info">
				<dl>
					<dd class='customer-information'>` + data['customerInfo'] + `</dd>
					<dd class='customer-email'>` + data['email'] + `</dd>
					<dd class='customer-phone'>` + data['phone'] + `</dd>
					<dd class='customer-otherContact'>` + data['otherContact'] + `</dd>
					<dd class='customer-zipcode'>` + data['zipcode'] + `</dd>
					<dd class='customer-join-information'>` + data['joinInfo'] + `</dd>
					<dd class='customer-leave-information'>` + data['leaveInfo'] + `</dd>
					<dd class='customer-note'>` + data['note'] + `</dd>
					<dd>` +
			'<a href="javascript:void(0)" class="editInfo">编辑</a>' +
			'<a href="javascript:void(0)" class="deleteCustomerInfo">删除</a>' +

			+`</dd>
				</dl>
			</li>
			`;
		$(e).appendTo("#customerInfo").addClass("customerInfo");
	}

	function autoCenter(el) {
		var bodyW = $(window).width();
		var bodyH = $(window).height();
		var elW = el.width();
		var elH = el.height();
		$("#dialog2").css({
			"left": (bodyW - elW) / 2 + 'px',
			"top": (bodyH - elH) / 2 + 'px'
		});
	};

	/*
	 * 得到销售，导游和来源的下拉列表
	 */
	$("#update-salesperson, #update-wholesaler, #update-source").on('focus', function() {
		var current_id = $(this).attr('id');
		var target = "";
		if(current_id == 'update-salesperson') {
			target = 'salesperson';
		} else if(current_id == 'update-source') {
			target = 'source';
		} else if(current_id == 'update-wholesaler') {
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
		// 模拟数据
		// autocomplete(document.getElementById(current_id), ['alex', 'terry']);
	});

	// 得到更新窗口数据
	function getUpdateInfo() {
		var data = {
			action: 'updateOrder',
			transactionId: $('.active').find('dl dd.listNum a')['0'].innerText,

			product_code: $("#update-product-code").val(),
			tour_name: $("#update-tour-name").val(),
			salesperson: $("#update-salesperson").val(),
			wholesaler: $("#update-wholesaler").val(),
			indiv_number: $("#update-indiv-number").val(),
			source: $("#update-source").val(),
			note: $("#update-note").val(),
			start_date: $("#update-start-date").val(),
			end_date: $("#update-end-date").val(),
			durating: $("#update-day-count").val(),
			currency: $("#update-currency").val(),
			payment_type: $("#update-payment-type").val(),
			total_cost: $("#update-total-cost").val(),
			receive: $("#update-receive").val(),
			coupon: $("#indivDiscountText_update").val()
		}
		return data;
	}

	/*
	 * 修改订单内容
	 */
	$("#updateConfirm").on('click', function() {
		$(".updateEditConfirmBox").css("display", "block");
	});
	$("#updateEditActionConfirm").on('click', function() {
		var data = getUpdateInfo();
		var displayData = data;
		var url = location.protocol.concat("//").concat(location.host).concat('/database/Business/IndividualTour/EditOrder.php');
		$.ajax({
			url: url,
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			type: 'POST',
			data: data,
			success: function(response) {
				updateDisplayInfo(displayData);
				var url = location.protocol.concat("//").concat(location.host).concat('/database/addCustomerDB.php');
				// 添加新的客户
				for (var i = 0; i < addCustomerList.length; i++) {
					var data = {
						fname: addCustomerList[i].fname,
						lname: addCustomerList[i].lname,
						email: addCustomerList[i].email,
						phone: addCustomerList[i].phone,
						otherContactWay: addCustomerList[i].other_contact_type,
						otherContactInfo: addCustomerList[i].other_contact_number,
						birthday: addCustomerList[i].birthday,
						gender: addCustomerList[i].gender,
						zipcode: addCustomerList[i].zipcode,
						joinDate: addCustomerList[i].join_date,
						joinLocation: addCustomerList[i].join_location,
						leaveDate: addCustomerList[i].leave_date,
						leaveLocation: addCustomerList[i].leave_location,
						notice: addCustomerList[i].note,
						individualTourId: addCustomerList[i].individual_tour_id
					};
					$.ajax({
						url: url,
						headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
						type: 'POST',
						data: data,
						success: function(response) {
							console.log("添加成功");
						},
						error: function(jqXHR, textStatus, errorThrown) {
							console.log(textStatus, errorThrown);
						}
					});
				}

				// 删除已有的客户
				var url = location.protocol.concat("//").concat(location.host).concat('/database/Business/IndividualTour/EditOrder.php');
				for (var i = 0; i < deleteCustomerList.length; i++) {
					var data = deleteCustomerList[i];
					Object.assign(data, {
						action: 'deleteCustomer'
					});
					$.ajax({
						url: url,
						headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
						type: 'POST',
						data: data,
						success: function(response) {
							console.log("删除成功");
						},
						error: function(jqXHR, textStatus, errorThrown) {
							console.log(textStatus, errorThrown);
						}
					});
				}

				// 修改已有的客户
				var url = location.protocol.concat("//").concat(location.host).concat('/database/Business/IndividualTour/EditOrder.php');
				for (var i = 0; i < updateCustomerList.length; i++) {
					var data = updateCustomerList[i];
					Object.assign(data, {
						action: 'updateCustomer'
					});
					$.ajax({
						url: url,
						headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
						type: 'POST',
						data: data,
						success: function(response) {
							console.log(response);
						},
						error: function(jqXHR, textStatus, errorThrown) {
							console.log(textStatus, errorThrown);
						}
					});
				}
				$("#dialog2").css("display", "none");
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
	* 添加新的客户信息
	*/
	$("#add-customer-confirm").on('click', function() {
		data = getCustomerEditInfo();
		if (!data) {
			return;
		}
		Object.assign(data, {
			individual_tour_id: individual_tour_id
		});
		addCustomerList.push(data);
		individualTourCustomerList.push(data);

		var customerInfo = "";
		// Detect Chinese input
		var reg = /[\u3040-\u30ff\u3400-\u4dbf\u4e00-\u9fff\uf900-\ufaff\uff66-\uff9f]/;
		if(reg.test(data['lname'])) {
			customerInfo = data['lname'] + data['fname'];
		} else {
			customerInfo = data['fname'] + ' ' + data['lname'];
		}
		if(data['gender'] != 'UNKNOWN') {
			customerInfo += ' / ' + data['gender'];
		}
		if(data['birthday'] != "") {
			customerInfo += ' / ' + data['birthday'].substring(0, 10);
		}

		var email = (data['email'] == "") ? '' : data['email'];

		var phone = (data['phone'] == "") ? '' : data['phone'];

		var otherContact = "";
		if(data['other_contact_number'] != "") {
			otherContact = data['other_contact_type'] + ': ' + data['other_contact_number'];
		}

		var zipcode = (data['zipcode'] == "") ? '' : data['zipcode'];

		var joinInfo = "";
		if(data['join_date'] != "") {
			joinInfo += data['join_date'].substring(0, 10);
		}
		if(data['join_location'] != "") {
			joinInfo += ' / ' + data['join_location'];
		}

		var leaveInfo = "";
		if(data['leave_date'] != "") {
			leaveInfo += data['leave_date'].substring(0, 10);
		}
		if(data['leave_location'] != "") {
			leaveInfo += ' / ' + data['leave_location'];
		}

		var note = (data['note'] == "") ? '' : data['note'];

		var customerData = {
			customerInfo: customerInfo,
			email: email,
			phone: phone,
			otherContact: otherContact,
			zipcode: zipcode,
			joinInfo: joinInfo,
			leaveInfo: leaveInfo,
			note: note
		}

		addCustomer(customerData);
		resetCustomerInfo();
		$(".customerInfo.addClients").fadeOut();
	});

	/*
	* 删除客户信息
	*/
	$(document).on('click', '.deleteCustomerInfo', function() {
		var index = $(".deleteCustomerInfo").index(this);
		$(".update-customer-info").eq(index).remove();
		if (individualTourCustomerList[index]['customer_id'] != null) {
			// 删除已经存在在数据库里的客户
			deleteCustomerList.push({
				customer_id: individualTourCustomerList[index]['customer_id'],
				individual_tour_id: individualTourCustomerList[index]['indiv_tour_id']
			});
		} else {
			// 删除新添加的客户
			for (var i = 0; i < addCustomerList.length; i++) {
				if (addCustomerList[i]['fname'] == individualTourCustomerList[index]['fname'] &&
					addCustomerList[i]['lname'] == individualTourCustomerList[index]['lname']) {
						addCustomerList.splice(i, 1);
					}
			}
		}
		individualTourCustomerList.splice(index, 1);
		$(this).parentsUntil("li").remove();
	});

	/*
	* 更新客户信息
	*/
	$("#update-customer-confirm").on('click', function() {
		var data = getCustomerEditInfo();
		if (!data) {
			return;
		}
		var reg = /[\u3040-\u30ff\u3400-\u4dbf\u4e00-\u9fff\uf900-\ufaff\uff66-\uff9f]/;
		individualTourCustomerList[customer_index]['lname'] = data['lname'];
		individualTourCustomerList[customer_index]['fname'] = data['fname'];
		individualTourCustomerList[customer_index]['birth_date'] = data['birthday'];
		individualTourCustomerList[customer_index]['gender'] = data['gender'];
		var customer_info = "";
		if(reg.test(data['lname'])) {
			customer_info = data['lname'] + data['fname'];
		} else {
			customer_info = data['fname'] + ' ' + data['lname'];
		}
		if (data['gender'] != 'UNKNOWN') {
			customer_info += " / " + data['gender'];
		}
		if (data['birthday'] != null) {
			customer_info += " / " + data['birthday'].substring(0, 10);
		}
		$(".update-customer-info").eq(customer_index).find(".customer-information").text(customer_info);


		individualTourCustomerList[customer_index]['phone'] = data['phone'];
		$(".update-customer-info").eq(customer_index).find(".customer-phone").text(data['phone']);

		individualTourCustomerList[customer_index]['other_contact_type'] = data['other_contact_type'];
		individualTourCustomerList[customer_index]['other_contact_number'] = data['other_contact_number'];
		if (data['other_contact_number'] != null) {
			$(".update-customer-info").eq(customer_index).find(".customer-otherContact").text(data['other_contact_type'] + ": " + data['other_contact_number']);
		}

		individualTourCustomerList[customer_index]['email'] = data['email'];
		$(".update-customer-info").eq(customer_index).find(".customer-email").text(data['email']);

		individualTourCustomerList[customer_index]['zipcode'] = data['zipcode'];
		$(".update-customer-info").eq(customer_index).find(".customer-zipcode").text(data['zipcode']);

		individualTourCustomerList[customer_index]['note'] = data['note'];
		$(".update-customer-info").eq(customer_index).find(".customer-note").text(data['note']);

		individualTourCustomerList[customer_index]['join_date'] = data['join_date'];
		individualTourCustomerList[customer_index]['join_location'] = data['join_location'];
		$(".update-customer-info").eq(customer_index).find(".customer-join-information").text(data['join_date'] + ' / ' + data['join_location']);

		individualTourCustomerList[customer_index]['leave_date'] = data['leave_date'];
		individualTourCustomerList[customer_index]['leave_location'] = data['leave_location'];
		$(".update-customer-info").eq(customer_index).find(".customer-leave-information").text(data['leave_date'] + ' / ' + data['leave_location']);

		if (individualTourCustomerList[customer_index]['customer_id'] != null) {
			// 更新数据库里已有的客户信息
			for (var i = 0; i < updateCustomerList.length; i++) {
				if (updateCustomerList[i]['fname'] == individualTourCustomerList[customer_index]['fname'] &&
					updateCustomerList[i]['lname'] == individualTourCustomerList[customer_index]['lname']) {
						updateCustomerList.splice(i, 1);
					}
			}
			updateCustomerList.push(individualTourCustomerList[customer_index]);
		} else {
			// 更新新添加的客户信息
			for (var i = 0; i < addCustomerList.length; i++) {
				if (addCustomerList[i]['fname'] == individualTourCustomerList[customer_index]['fname'] &&
					addCustomerList[i]['lname'] == individualTourCustomerList[customer_index]['lname']) {
						addCustomerList.splice(i, 1);
					}
			}
			addCustomerList.push(individualTourCustomerList[customer_index]);
		}

		resetCustomerInfo();
		$(".customerInfo.addClients").fadeOut();
	});

	$("#add-customer-other-contact").on('change', function() {
		$("#add-customer-other-contact-label").text($("#add-customer-other-contact").val() + '帐号');
	});

	// 更新订单列表的内容
	function updateDisplayInfo(data) {
		$("li.active").find("dd.listGroupNum a").text(data['product_code']);
		$("li.active").find("dd.listSales a").text(data['wholesaler']);
		$("li.active").find("dd.listJourney a").text(data['start_date'] + '/' + data['end_date']);
		$("li.active").find("dd.listPayment a").text(data['payment_type']);
		$("li.active").find("dd.listCurrency a").text(data['currency']);
		$("li.active").find("dd.listPrice a").text(data['receive']);
		$("li.active").find("dd.listCost a").text(data['total_cost']);

		var reg = /^\d+(\.\d{1,2})?$/;
		var couponValue = 0;
		if(reg.test($("#indivDiscountText_update").val())) {
			couponValue = $("#indivDiscountText_update").val();
			$("li.active").find("dd.listDiscount a").text(couponValue);
			$("li.active").find("dd.listProfit a").text(data['receive'] - data['total_cost'] - couponValue);
		} else {
			var url = location.protocol.concat("//").concat(location.host).concat('/database/couponSearch.php');
			$.ajax({
				url: url,
				type: 'post',
				data: {
					couponCode: $("#indivDiscountText_update").val()
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
					$("li.active").find("dd.listProfit a").text(data['receive'] - data['total_cost'] - couponValue);
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});
		}
	}

	/*
	 * 删除订单
	 */
	$("#deleteConfirm").on('click', function() {
		$(".updateDeleteConfirmBox").css("display", "block");
		$(".updateDeleteConfirmBox").find(".confirmNotice").text("确认删除");
	});
	$("#updateDeleteActionConfirm").on('click', function() {
		var transactionId = $('.active').find('dl dd.listNum a')['0'].innerText;
		var url = location.protocol.concat("//").concat(location.host).concat('/database/Business/IndividualTour/EditOrder.php');
		$.ajax({
			url: url,
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			type: 'POST',
			data: {
				action: 'deleteOrder',
				transaction_id: transactionId
			},
			success: function(response) {
				$("#dialog2").css("display", "none");
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
//散拼团点击订单号弹出新窗口
function dragForm2() {
	var $dialog2 = $("#dialog2");
	//自动居中对话框
	function autoCenter(el) {
		var bodyW = $(window).width();
		var bodyH = $(window).height();
		var elW = el.width();
		var elH = el.outerHeight();
		$dialog2.css({
			"left": (bodyW - elW) / 2 + 'px',
			"top": (bodyH - elH) / 2 + 'px'
		});
//		alert(bodyH+"\n"+elH);
	};
	//点击弹出对话框
	$(document).on('click', '.callout_button2', function() {
		$dialog2.css("display", "block");
		autoCenter($dialog2);
	});
	//点击关闭对话框
	$(".close_button2").click(function() {
		$dialog2.css("display", "none");
	});

	//窗口大小改变时，对话框始终居中
	window.onresize = function() {
		autoCenter($dialog2);

	};
	//确认/重置选中状态

	$(".updateInfo ul.filterBox  li  dl.confirmMsg dd ").find("a").on("mousedown", function() {
		$(this).addClass("confirm-active");
	});
	$(".updateInfo ul.filterBox  li  dl.confirmMsg dd ").find("a").on("mouseup", function() {
		$(this).removeClass("confirm-active");
	});

}

function addClients() {
	$(".addClients_update").on("click", function() {
		resetCustomerInfo();
		$("p.confirmAdd").removeClass("nm-hide");
		$("p.confirmAmend").addClass("nm-hide");
		$(".customerInfo.addClients").fadeIn();
	});
	$("#closeAddBox").on("click", function() {
		$(".customerInfo.addClients").fadeOut();
	});
}

function autoCenterBox(el) {
	var bodyW = $(window).width();
	var bodyH = $(window).height();
	var elW = el.width();
	var elH = el.outerHeight();
	el.css({
		"left": (bodyW - elW) / 2 + 'px',
		"top": (bodyH - elH) / 2 + 'px'
	});
};

function actionClientsChart() {
	/*
	* 显示选中的客户的编辑窗口
	*/
	$(document).on('click', '.editInfo', function() {
		$(".customerInfo.addClients").fadeIn();
		$("p.confirmAdd").addClass("nm-hide");
		$("p.confirmAmend").removeClass("nm-hide");
		resetCustomerInfo();

		var index = $(".editInfo").index(this);
		customer_index = index;

		var current_customer = individualTourCustomerList[index];
		$("#add-customer-lname").val(current_customer['lname']);
		$("#add-customer-fname").val(current_customer['fname']);
		$("#add-customer-phone").val(current_customer['phone']);
		$("#add-customer-other-contact").val(current_customer['other_contact_type']);
		$("#add-customer-other-contact-number").val(current_customer['other_contact_number']);

		if (current_customer['birth_date'] != null) {
			$("#add-customer-birthday").val(current_customer['birth_date'].substring(0, 10));
		} else {
			$("#add-customer-birthday").val("");
		}
		$("#add-customer-gender").val(current_customer['gender']);
		$("#add-customer-email").val(current_customer['email']);
		$("#add-customer-zipcode").val(current_customer['zipcode']);
		$("#add-customer-note").val(current_customer['note']);

		if (current_customer['join_date'] != null) {
			$("#add-customer-join-date").val(current_customer['join_date'].substring(0, 10));
		} else {
			$("#add-customer-join-date").val("");
		}
		$("#add-customer-join-location").val(current_customer['join_location']);
		if (current_customer['leave_date'] != null) {
			$("#add-customer-leave-date").val(current_customer['leave_date'].substring(0, 10));
		} else {
			$("#add-customer-leave-date").val("");
		}
		$("#add-customer-leave-location").val(current_customer['leave_location']);
	});

}

function resetCustomerInfo() {
	$("#add-customer-lname").val("");
	$("#add-customer-fname").val("");
	$("#add-customer-phone").val("");
	$("#add-customer-other-contact").val("WeChat");
	$("#add-customer-other-contact-label").text("WeChat帐号");
	$("#add-customer-other-contact-number").val("");

	$("#add-customer-birthday").val("");
	$("#add-customer-gender").val("");
	$("#add-customer-email").val("");
	$("#add-customer-zipcode").val("");
	$("#add-customer-note").val("");

	$("#add-customer-join-date").val("");
	$("#add-customer-join-location").val("");
	$("#add-customer-leave-date").val("");
	$("#add-customer-leave-location").val("");
}

function getCustomerEditInfo() {
	if ($("#add-customer-lname").val() == "" || $("#add-customer-fname").val() == "") {
		alert("请输入客户姓名!");
		return false;
	}
	return data = {
		lname: $("#add-customer-lname").val(),
		fname: $("#add-customer-fname").val(),
		phone: $("#add-customer-phone").val(),
		other_contact_type: $("#add-customer-other-contact").val(),
		other_contact_number: $("#add-customer-other-contact-number").val(),
		birthday: $("#add-customer-birthday").val(),
		gender: $("#add-customer-gender").val(),
		email: $("#add-customer-email").val(),
		zipcode: $("#add-customer-zipcode").val(),
		note: $("#add-customer-note").val(),
		join_date: $("#add-customer-join-date").val(),
		join_location: $("#add-customer-join-location").val(),
		leave_date: $("#add-customer-leave-date").val(),
		leave_location: $("#add-customer-leave-location").val()
	};
}
