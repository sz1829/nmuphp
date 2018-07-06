//机票部分的js

//单程、往返
function airTicketOption(){
	 //机票部分 (团票/散票;往返/单程切换)
    $(".ticket-option").find("dd").on("click", function() {
        $(this).addClass("option-active").siblings().removeClass("option-active");

    });
    //单程/往返:
    $(".flightCodeNav").find("dd.roundTripItem").on("click",function(){
    	$(".singleTripInfo").css("display","none");
    	$(".roundTripInfo").css("display","inline-block");
    });
    $(".flightCodeNav").find("dd.singleTripItem").on("click",function(){
    	$(".singleTripInfo").css("display","inline-block");
    	$(".roundTripInfo").css("display","none");
    });
}
//总人数计算
function headCount() {
    $("#air-ticket-create-adult-number, #air-ticket-create-children-number, #air-ticket-create-baby-number").on("keyup", function() {
        var sum = parseInt($("#air-ticket-create-adult-number").val())
                + parseInt($("#air-ticket-create-children-number").val())
                + parseInt($("#air-ticket-create-baby-number").val());
        $("#air-ticket-create-total-number").val(sum);
    })
}

$(document).ready(function() {
    $("#ticket-create-customer-otherContact").on('change', function() {
        $("#ticket-create-customer-otherContactLabel").text(
            $("#ticket-create-customer-otherContact").val() + '帐号'
        );
    });

    $("#airticket_salesperson, #airticket_source").on('focus', function() {
        var current_id = $(this).attr('id');
        var target = "";
        if (current_id == 'airticket_salesperson') {
            target = 'salesperson';
        } else if (current_id == 'airticket_source') {
            target = 'source';
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

    function resetCustomerForm() {
        $("#ticket-create-customer-lastName").val("");
        $("#ticket-create-customer-firstName").val("");
        $("#ticket-create-customer-phone").val("");
        $("#ticket-create-customer-otherContact").val("");
        $("#ticket-create-customer-otherContactLabel").text("WeChat帐号");
        $("#ticket-create-customer-otherContactNumber").val("");
        $("#ticket-create-customer-birthday").val("");
        $("#ticket-create-customer-gender").val("");
        $("#ticket-create-customer-email").val("");
        $("#ticket-create-customer-zipcode").val("");
        $("#ticket-create-customer-otherMsg").val("");
    }

    $("#indivTourCancel").on("click", function() {
        // $("a#proTab").removeClass("tabhover");
        $('#createAirTicketForm').trigger("reset"); //重置表单
        resetCustomerForm();
        var leftHeight = $(".navInfo ul").height()
        var rightHeight = $(".theamInfo").height();
        if (rightHeight < leftHeight) {
            $(this).blur();
            $(".navInfo ul").css("height", rightHeight);
        }
        $("#airTicketDiscountNotice").addClass("nm-hide");
    });

    function getData() {
        var data = {
            flightCode: $("#air-ticket-create-flight-code").val(),
            salesperson: $("#airticket_salesperson").val(),
            locator: $("#air-ticket-create-locator").val(),
            roundTrip: ($("#air-ticket-create-round-trip").attr('class') == 'option-active') ? 'round' : 'oneway',
            ticketType: ($("#air-ticket-create-ticket-type").attr('class') == 'option-active') ? 'group' : 'individual',
            numOfAdult: $("#air-ticket-create-adult-number").val(),
            numOfChildren: $("#air-ticket-create-children-number").val(),
            numOfBaby: $("#air-ticket-create-baby-number").val(),
            numPassenger: $("#air-ticket-create-total-number").val(),
            source: $("#airticket_source").val(),
            note: $("#air-ticket-create-note").val(),


            leaveDate: $("#air-ticket-create-leave-date").val(),
            arriveDate: $("#air-ticket-create-arrive-date").val(),
            leaveLocation: $("#air-ticket-create-leave-location").val(),
            arriveLocation: $("#air-ticket-create-arrive-location").val(),


            currency: $("#air-ticket-create-currency").val(),
            payType: $("#air-ticket-create-payment-type").val(),
            expense: $("#air-ticket-create-expense").val(),
            price: $("#air-ticket-create-price").val(),
            received2: $("#air-ticket-create-received2").val(),
            discount:  $("#airTicketDiscountText").val(),
            lastName: $("#ticket-create-customer-lastName").val(),
            firstName: $("#ticket-create-customer-firstName").val(),
            phone: $("#ticket-create-customer-phone").val(),
            otherContact: $("#ticket-create-customer-otherContact").val(),
            otherContactNumber: $("#ticket-create-customer-otherContactNumber").val(),
            birthday: $("#ticket-create-customer-birthday").val(),
            gender: $("#ticket-create-customer-gender").val(),
            email: $("#ticket-create-customer-email").val(),
            zipcode: $("#ticket-create-customer-zipcode").val(),
            otherMsg: $("#ticket-create-customer-otherMsg").val()
        };
        return data;
    }

    function resetInputForm() {
        $("#airTicketDiscountNotice").addClass("nm-hide");
        $('#createAirTicketForm').trigger("reset"); //重置表单
        resetCustomerForm();
        var leftHeight = $(".navInfo ul").height()
        var rightHeight = $(".theamInfo").height();
        if (rightHeight < leftHeight) {
            $(this).blur();
            $(".navInfo ul").css("height", rightHeight);
        }
    }

    $("#airTicketSubmit").on('click', function() {
        var data = getData();
        if (data['flightCode'] == "" || data['salesperson'] == "" || data['locator'] == "" ||
            data['numOfAdult'] == "" || data['numOfChildren'] == "" || data['numOfBaby'] == "" ||
            data['source'] == "" || data['leaveDate'] == "" || data['arriveDate'] == "" || data['leaveLocation'] == "" ||
            data['arriveLocation'] == "" || data['expense'] == "" || data['price'] == "" || data['received2'] == "" ||
            data['lastName'] == "" || data['firstName'] == "" || data['phone'] == "" || data['birthday'] == ""||data['gender']=="UNKNOWN") {
            //必填项：
            $("#ticket-create-customer-lastName").addClass("nm-error");
            $("#ticket-create-customer-firstName").addClass("nm-error");
            $("#ticket-create-customer-phone").addClass("nm-error");
            $("#ticket-create-customer-birthday").addClass("nm-error");
            $("#ticket-create-customer-email").addClass("nm-error");
            $("#ticket-create-customer-gender").addClass("nm-error");
            alert("看看你是不是填完了");
            return false;
        }
        $(".airticketCreateConfirmBox").css("display", "block");
    });

    $("#airticketCreateActionConfirm").on('click', function() {
        var inputData = getData();

        var url = location.protocol.concat("//").concat(location.host).concat('/database/AirTicketCreateDB.php');
        $.ajax({
            url: url,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            type: 'post',
            data: inputData,
            success: function(response) {
                resetInputForm();
                $(".airticketCreateConfirmBox").css("display", "none");
                $(".airticketCreateSuccessBox").css("display", "block");
                $(".airticketCreateSuccessBox p.confirmNotice").text("提交成功");
                $(".airticketCreateSuccessBox p.confirmNotice").find("img").attr("src","../img/userConfirm.png");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });

    $("#airticketCreateActionCancel").on('click', function() {
        $(".airticketCreateConfirmBox").css("display", "none");
    });
    $("#airticketCreateSuccessConfirm").on('click', function() {
        $(".airticketCreateSuccessBox").css("display", "none");
    });
});
//分页
function airTicketPagination(){
	 $('#plane-pagination').pagination({
        totalData: 100,
        showData: 15,
        coping: true,
        coping: true,
        homePage: '首页',
        endPage: '末页',
        prevContent: '上页',
        nextContent: '下页',
        callback: function(api) {
            var i = api.getCurrent(); //获取当前页
            $('#logBox-plane').html('<li class="callout_button_plane>' + '<dl>' +
                '<dd>' + '<a">12' + i + '</a>' + '</dd>' +
                '<dd>2018-04-07</dd>' +
                '<dd>2018-04-17</dd>' +
                '<dd>FGOEGTI</dd>' +
                '<dd>enffsv</dd>' +
                '<dd>2675.00</dd>' +
                '<dd>2613.00(1461.00/581.00)</dd>' +
                '<dd>SW3518</dd>'+
                '<dd>NREFQ&nbsp;CORP.</dd>' +
                '<dd>2018-05-15/2018-05-25</dd>' +
                '<dd>Ildlw Anlb</dd>' +
                '<dd>18817268152</dd>' +
                '<dd>wbre</dd>' +
                '<dd>Jyepgrwt</dd>' +
                '<dd>27.00</dd>' +
                '<dd>N</dd>' +
                '<dd>N</dd>' +
                '<dd>Null</dd>' +
                '</dl>' +
                '</li>');
            //机票更新部分（弹出对话框）
            $(".callout_button_plane").click(function() {
                $("#dialog-plane").css("display", "block");
                autoCenter($("#dialog-plane"));
            });

            function autoCenter(el) {
                var bodyW = $(window).width();
                var bodyH = $(window).height();
                var elW = el.width();
                var elH = el.height();
                $("#dialog-plane").css({
                    "left": (bodyW - elW) / 2 + 'px',
                    "top": (bodyH - elH) / 2 + 'px'
                });
            };
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
    });
}
function checkedCell(){
	$(".bms-tab").find("ul.accountRecordMsg").find("li").click(function(){
		$(this).addClass("accounting-active").siblings().removeClass("accounting-active");
	});
}
function dateRangew() {
    $(".showMsg").find(".datePicker").find("select").on("change", function() {
        var currentText = $(this).find("option:selected").text();
        if (currentText == "Customized") {
            $(".datePicker").find(".selectRange").css("display", "inline-block");
            $(this).parentsUntil(".showMsg").siblings().find(".datePicker").find(".selectRange").css("display", "none");
            $(".datePicker").trigger("change");
            $(this).parentsUntil(".showMsg").siblings().find(".datePicker").find("select").find("option").eq(0).attr("selected", 'selected'); //默认选中第一个
        } else {
            $(".datePicker").find(".selectRange").css("display", "none");
        }
    });
}
//验证
function checkClientInfo(checkInputBox){
checkInputBox.on("focus",function(){
	if($(this).val()==""){
		$(this).addClass("nm-error");
	}
	if($(this).val()!==""){
		$(this).removeClass("nm-error");
	}
});
checkInputBox.on("blur",function(){
	if($(this).val()==""){
		$(this).addClass("nm-error");
	}
	if($(this).val()!==""){
		$(this).removeClass("nm-error");
	}
});

$("select#ticket-create-customer-gender").on("change",function(){
	var currentText = $(this).find("option:selected").text();
	if(currentText=="Unknown"){
			$(this).addClass("nm-error");
		}else{
			$(this).removeClass("nm-error");
		}
});
$("select#ticket-create-customer-gender").on("blur",function(){
	var currentText = $(this).find("option:selected").text();
	if(currentText=="Unknown"){
			$(this).addClass("nm-error");
		}else{
		    $(this).removeClass("nm-error");
		}
    });
}

function addClients(){
	$(".confirmAmend").find("a").on("click",function(){
		$(".customerInfo.addClients").fadeOut();
	});
	$("#closeAddBox").on("click",function(){
		$(".customerInfo.addClients").fadeOut();
	});
}

function autoCenterBox(el) {
    var bodyW = $("body").width()+17;
    var bodyH = $(window).height();
    var elW = el.width();
    var elH = el.height();
    el.css({
        "left": (bodyW - parseFloat(bodyW*elW/100)) / 2 + 'px',
        "top": (bodyH - elH) / 2 + 'px'
    });
};
