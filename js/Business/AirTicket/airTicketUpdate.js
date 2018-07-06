$(document).ready(function() {
    /*
    *  载入当前页的数据
    */
    function loadCurrentPage(data) {
        var url = location.protocol.concat("//").concat(location.host).concat('/database/Business/AirTicket/AirTicketGetOrder.php');
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
        if (rightHeight > leftHeight) {
            $(this).blur();
            $(".navInfo ul").css("height", rightHeight);
        }
        if (rightHeight < leftHeight) {
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
                if (response == 0) {
                    $(".noResultBox").css("display", "block");
                } else {
                    $('.tabListDetail').empty();
                    $('#airticket-pagination').pagination({
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
        if (dd < 10) {
            dd = '0' + dd;
        }
        if (mm < 10) {
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
        var transaction_id = $("#airticket-update-transaction-id-filter").val();
        var locator = $("#airticket-update-locator-filter").val();

        today = getTodayYYYYMMDD();

        var data = {
            orderType: 'airticket',
            transaction_id: transaction_id,
            locator: locator
        };
        if ($("#airticket-update-date-filter").val() == '1') {
            Object.assign(data, {
                from_date: delByTransDate(today, 0),
                to_date: addByTransDate(today, 1)
            });
        } else if ($("#airticket-update-date-filter").val() == '30') {
            Object.assign(data, {
                from_date: delByTransDate(today, 29),
                to_date: addByTransDate(today, 1)
            });
        } else if ($("#airticket-update-date-filter").val() == '90') {
            Object.assign(data, {
                from_date: delByTransDate(today, 89),
                to_date: addByTransDate(today, 1)
            });
        } else if ($("#airticket-update-date-filter").val() == '180') {
            Object.assign(data, {
                from_date: delByTransDate(today, 179),
                to_date: addByTransDate(today, 1)
            });
        } else {
            var dates = $("#airticket-update-to-date").val().split("-");
            var date = new Date(dates[0], dates[1] - 1, dates[2]);
            var toDate = new Date(date);
            toDate.setDate(date.getDate()+1);
            toDate = formatDate(toDate);

            Object.assign(data, {
                from_date: $("#airticket-update-from-date").val(),
                to_date: toDate
            });
        }
        return data;
    }

    /*
    * 根据筛选条件得到独立团信息
    */
    $("#airticket-update-filter").on('click', function() {
        var data = getFilterData();
        loadData(data);
    });
    $("#airticket-update-reset").on('click', function() {
        $("#airticket-update-date-filter").val("30");
        $("#airticket-update-from-date").val("");
        $("#airticket-update-to-date").val("");
        $(".selectRange").css("display", "none");
        $("#airticket-update-transaction-id-filter").val("");
        $("#airticket-update-locator-filter").val("");
        var data = getFilterData();
        loadData(data);
    });


    /*
    * 显示选中订单的具体信息
    */
    $(document).on('click', 'ul.tabListDetail li', function() {
        $(this).addClass("active").siblings().removeClass("active");
        var transactionId = $('.active').find('dl dd.listNum a')['0'].innerText;
        $("#airTicketDiscountNotice_update").css("display", "none");

        var url = location.protocol.concat("//").concat(location.host).concat('/database/Business/AirTicket/EditOrder.php');
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

                $("#update-flight-number").val(response['flight_code']);
                $("#update-salesperson").val(response['salesperson_code']);
                $("#update-locator").val(response['locators']);
                if (response['round_trip'] == 'oneway') {
                    $(".update-round").removeClass("option-active");
                    $(".update-oneway").addClass("option-active");
                } else {
                    $(".update-round").addClass("option-active");
                    $(".update-oneway").removeClass("option-active");
                }
                if (response['ticket_type'] == 'individual') {
                    $(".update-group").removeClass("option-active");
                    $(".update-individual").addClass("option-active");
                } else {
                    $(".update-group").addClass("option-active");
                    $(".update-individual").removeClass("option-active");
                }
                $("#update-adult-number").val(response['adult_number']);
                $("#update-children-number").val(response['child_number']);
                $("#update-infant-number").val(response['infant_number']);
                $("#update-total-number").val(
                    Number(response['adult_number']) + Number(response['child_number']) + Number(response['infant_number'])
                );
                $("#update-source").val(response['source_name']);
                $("#update-note").val(response['note']);

                $("#update-leave-date").val(response['depart_date'].substring(0, 10));
                $("#update-leave-location").val(response['depart_location']);
                $("#update-arrive-date").val(response['arrival_date'].substring(0, 10));
                $("#update-arrive-location").val(response['arrival_location']);

                $("#update-currency").val(response['currency']);
                $("#update-payment-type").val(response['payment_type']);
                $("#update-cost").val(response['expense']);
                $("#update-receive1").val(response['received']);
                $("#update-receive2").val(response['received2']);

                if (response['cc_id'] != null) {
                    $(".discount-code").addClass("option-active");
                    $(".coupon").removeClass("option-active");
                    $("#airTicketDiscountText_update").val(response['cc_code']);
                } else if (response['coupon'] != null) {
                    $(".discount-code").removeClass("option-active");
                    $(".coupon").addClass("option-active");
                    $("#airTicketDiscountText_update").val(response['coupon']);
                } else {
                    $("#airTicketDiscountText_update").val("");
                    $(".discount-code").removeClass("option-active");
                    $(".coupon").removeClass("option-active");
                }
                $("#airticket-dialog").css("display", "block");
                autoCenter($("#airticket-dialog"));
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
                response = JSON.parse(response);
                var other_contact_type = response['other_contact_type'].charAt(0).toUpperCase() + response['other_contact_type'].slice(1);
                $("#update-customer-lname").val(response['lname']);
                $("#update-customer-fname").val(response['fname']);
                $("#update-customer-phone").val(response['phone']);
                $("#update-customer-otherContact").val(other_contact_type);
                $("#update-customer-otherContactLabel").text(other_contact_type + '帐号');
                $("#update-customer-otherContactNumber").val(response['other_contact_number']);
                $("#update-customer-birthday").val(response['birth_date'].substring(0, 10));
                $("#update-customer-gender").val(response['gender']);
                $("#update-customer-email").val(response['email']);
                $("#update-customer-zipcode").val(response['zipcode']);
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
        $("#dialog2").css({
            "left": (bodyW - elW) / 2 + 'px',
            "top": (bodyH - elH) / 2 + 'px'
        });
    };

    //其他联系方式：
	 $("#update-customer-otherContact").on('change', function() {
         $("#update-customer-otherContactLabel").text($("#update-customer-otherContact").val() + '帐号');
     });

    /*
    * 得到销售，导游和来源的下拉列表
    */
    $("#update-salesperson, #update-source").on('focus', function() {
        var current_id = $(this).attr('id');
        var target = "";
        if (current_id == 'update-salesperson') {
            target = 'salesperson';
        } else if (current_id == 'update-source') {
            target = 'source';
        }
        var url = location.protocol.concat("//").concat(location.host).concat('/database/autoComplete.php');
        $.ajax({
            url: url,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            type: 'post',
            data: { target: target },
            success: function(response) { autocomplete(document.getElementById(current_id), JSON.parse(response)); },
            error: function(jqXHR, textStatus, errorThrown) { console.log(textStatus, errorThrown); }
        });
        // 模拟数据
        // autocomplete(document.getElementById(current_id), ['alex', 'terry']);
    });

    // 得到更新窗口数据
    function getUpdateInfo() {
        var round_trip = 'oneway';
        if ($("#update-round-trip").hasClass('option-active')) {
            round_trip = 'round';
        }
        var ticket_type = 'individual';
        if ($("#update-ticket-type").hasClass('option-active')) {
            ticket_type = 'group';
        }
        var data = {
            action: 'updateOrder',
            transactionId: $('.active').find('dl dd.listNum a')['0'].innerText,

            flight_code: $("#update-flight-number").val(),
            salesperson: $("#update-salesperson").val(),
            locator: $("#update-locator").val(),
            round_trip: round_trip,
            ticket_type: ticket_type,
            adult_number: $("#update-adult-number").val(),
            children_number: $("#update-children-number").val(),
            infant_number: $("#update-infant-number").val(),
            total_number: $("#update-total-number").val(),
            source: $("#update-source").val(),
            note: $("#update-note").val(),
            leave_date: $("#update-leave-date").val(),
            leave_location: $("#update-leave-location").val(),
            arrive_date: $("#update-arrive-date").val(),
            arrive_location: $("#update-arrive-location").val(),
            currency: $("#update-currency").val(),
            payment_type: $("#update-payment-type").val(),
            cost: $("#update-cost").val(),
            receive1: $("#update-receive1").val(),
            receive2: $("#update-receive2").val(),
            coupon: $("#airTicketDiscountText_update").val(),

            lname: $("#update-customer-lname").val(),
            fname: $("#update-customer-fname").val(),
            phone: $("#update-customer-phone").val(),
            other_contact_type: $("#update-customer-otherContact").val(),
            other_contact_number: $("#update-customer-otherContactNumber").val(),

            birthday: $("#update-customer-birthday").val(),
            gender: $("#update-customer-gender").val(),
            email: $("#update-customer-email").val(),
            zipcode: $("#update-customer-zipcode").val(),
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
        var url = location.protocol.concat("//").concat(location.host).concat('/database/Business/AirTicket/EditOrder.php');
        $.ajax({
            url: url,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            type: 'POST',
            data: data,
            success: function(response) {
                updateDisplayInfo(data);
                $("#airticket-dialog").css("display", "none");
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

    // 更新订单列表的内容
	function updateDisplayInfo(data) {
		$("li.active").find("dd.listFightNum a").text(data['flight_code']);
		$("li.active").find("dd.listLocation a").text(data['locator']);
        $("li.active").find("dd.listPayment a").text(data['payment_type']);
        $("li.active").find("dd.listCurrency a").text(data['currency']);
		$("li.active").find("dd.listPrice a").text(data['receive1']);
        $("li.active").find("dd.listReturnCash a").text(data['receive2']);
		$("li.active").find("dd.listCost a").text(data['cost']);

		var reg = /^\d+(\.\d{1,2})?$/;
		var couponValue = 0;
		if(reg.test(data['coupon'])) {
			couponValue = Number(data['coupon']);
			$("li.active").find("dd.listDiscount a").text(couponValue);
			$("li.active").find("dd.listProfit a").text(Number(data['receive1']) + Number(data['receive2']) - Number(data['cost']) - couponValue);
		} else {
			var url = location.protocol.concat("//").concat(location.host).concat('/database/couponSearch.php');
			$.ajax({
				url: url,
				type: 'post',
				data: {
					couponCode: data['coupon']
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
					$("li.active").find("dd.listProfit a").text(Number(data['receive1']) + Number(data['receive2']) - Number(data['cost']) - couponValue);
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
        var url = location.protocol.concat("//").concat(location.host).concat('/database/Business/AirTicket/EditOrder.php');
        $.ajax({
            url: url,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            type: 'POST',
            data: { action: 'deleteOrder', transaction_id: transactionId },
            success: function(response) {
                $("#airticket-dialog").css("display", "none");
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
function dragAirBox() {
    var $dialog2 = $("#airticket-dialog");
    //机票弹出对话框
    function autoCenter(el) {
        var bodyW = $(window).width();
        var bodyH = $(window).height();
        var elW = el.width();
        var elH = el.outerHeight();
        $dialog2.css({
            "left": (bodyW - elW) / 2 + 'px',
            "top": (bodyH - elH) / 2 + 'px'
        });
    };
    //点击弹出对话框
    $(document).on('click', '.callout_button_plane', function() {
        $("#airticket-dialog").css("display", "block");
        autoCenter($("#airticket-dialog"));
    });
    //点击关闭对话框
    $(".close_button-plane").click(function() {
        $("#airticket-dialog").css("display", "none");
    });

    //窗口大小改变时，对话框始终居中
    window.onresize = function() {
        autoCenter($("#airticket-dialog"));
    };
    //确认/重置选中状态

	$(".updateInfo ul.filterBox  li  dl.confirmMsg dd ").find("a").on("mousedown", function() {
		$(this).addClass("confirm-active");
	});
	$(".updateInfo ul.filterBox  li  dl.confirmMsg dd ").find("a").on("mouseup", function() {
		$(this).removeClass("confirm-active");
	});

}

//单程、往返
function airTicketOption(){
	 //机票部分 (团票/散票;往返/单程切换)
    $(".ticket-option").find("dd").on("click", function() {
        $(this).addClass("option-active").siblings().removeClass("option-active");
    });
}
//总人数计算
function headCount() {
    $("#update-adult-number, #update-children-number, #update-infant-number").on("keyup", function() {
        var sum = parseInt($("#update-adult-number").val())
                + parseInt($("#update-children-number").val())
                + parseInt($("#update-infant-number").val());
        $("#update-total-number").val(sum);
    })
}

function autoCenterBox(el) {
    var bodyW = $("body").width()+17;
    var bodyH = $(window).height();
    var elW = el.width();
    var elH = el.outerHeight();
    el.css({
        "left": (bodyW - parseFloat(bodyW*elW/100)) / 2 + 'px',
        "top": (bodyH - elH) / 2 + 'px'
    });
};
