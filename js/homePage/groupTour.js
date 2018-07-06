$(document).ready(function() {
    //取消表单提交
    $("#groupTourCancel").on("click", function() {
        $("a#proTab").removeClass("tabhover");
        $('#createGroupTourForm').trigger("reset"); //重置表单
        $(".fundMsg").css("display", "none");
        $(".userTab").css("display", "none");
        $(".split").css("display", "none");
        var leftHeight = $(".navInfo ul").height()
        var rightHeight = $(".theamInfo").height();
        if (rightHeight < leftHeight) {
            $(this).blur();
            $(".navInfo ul").css("height", rightHeight);
        }
        $("#groupDiscountNotice").addClass("nm-hide");
    });

    // Check whether all required information is given
    function checkInput() {
        if ($("#groupNum").val() == "" || $("#flightNum").val() == "" || $("#busCompany").val() == "" ||
            $("#salespersonInput").val() == "" || $("#tourGuide").val() == "" || $("#guideTel").val() == "" ||
            $("#agent").val() == "" || $("#leadNum").val() == "" || $("#visitorNum").val() == "" || $("#note").val() == "" ||
            $("#price").val() == "" || $("#write_off").val() == "" || $("#totalCost").val() == "") {
            alert("看看你是不是填完了");
            return false;
        }
        return true;
    }

    function getInputData() {
        var data = {
            groupNum: $("#groupNum").val(),
            flightNum: $("#flightNum").val(),
            busCompany: $("#busCompany").val(),
            salespersonInput: $("#salespersonInput").val(),
            tourGuide: $("#tourGuide").val(),
            guideTel: $("#guideTel").val(),
            agency: $("#agent").val(),
            groupTourSource: $('#groupTourSource').val(),
            leaderNumber: $("#leadNum").val(),
            visitorNumber: $("#visitorNum").val(),
            note: $("#note").val(),
            startTime: $("#startTime").val(),
            endTime: $("#endTime").val(),
            duration: $("#dateCount").val(),
            currency: $("#currency").val(),
            paymentType: $("#paymentType").val(),
            price: $("#price").val(),
            reserve: $("#reserve").val(),
            write_off: $("#write_off").val(),
            total_cost: $("#totalCost").val(),
            coupon: $("#groupDiscountText").val()
        };
        return data;
    }

    function resetInputForm() {
        $("#groupDiscountNotice").addClass("nm-hide");

        // Reset input form to default setting
        $('#createGroupTourForm').trigger("reset"); //重置表单
        $(".fundMsg").css("display", "none");
        $(".userTab").css("display", "none");
        $(".split").css("display", "none");
        var leftHeight = $(".navInfo ul").height()
        var rightHeight = $(".theamInfo").height();
        if (rightHeight < leftHeight) {
            $(this).blur();
            $(".navInfo ul").css("height", rightHeight);
        }
    }

    //表单提交
    $("#groupTourSubmit").on('click', function() {
        if (!checkInput()) {
            return false;
        }
        // 弹出确认提示框
        $(".grouptourCreateConfirmBox").css("display", "block");
    });
    // 点击确认
    $("#groupTourCreateActionConfirm").on('click', function() {
        var inputData = getInputData();
        console.log("开始提交");

        var url = location.protocol.concat("//").concat(location.host).concat('/database/GroupTourCreateDB.php');
        $.ajax({
            url: url,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            type: 'post',
            data: inputData,
            success: function(response) {
                // console.log("提交成功");
                // $(this).parent().siblings("p.confirmNotice").text("提交成功");
    			// $(this).parent().siblings("p.confirmTitle").find("img").attr("src","../img/userConfirm.png");
                resetInputForm();
                $(".grouptourCreateConfirmBox").css("display", "none");
                $(".grouptourCreateSuccessBox").css("display", "block");
                $(".grouptourCreateSuccessBox p.confirmNotice").text("提交成功");
                $(".grouptourCreateSuccessBox p.confirmNotice").find("img").attr("src","../img/userConfirm.png");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("提交失败");
                console.log(textStatus, errorThrown);
            }
        });
    });
    // 点击取消
    $("#groupTourCreateActionCancel").on('click', function() {
        $(".grouptourCreateConfirmBox").css("display", "none");
    });
    $("#grouptourCreateSuccessConfirm").on('click', function() {
        $(".grouptourCreateSuccessBox").css("display", "none");
    });

    //表单提交并下载
    $("#groupTourSubmitAndDownload").on('click', function() {
        if (!checkInput()) {
            return false;
        }
        // 弹出确认提示框
        $(".grouptourDownloadBox").css("display", "block");
    });
    // 点击确认
    $("#groupTourDownloadActionConfirm").on('click', function() {
        var inputData = getInputData();

        var leaderNum = $("#leadNum").val(); //导游人数
        var vistorNum = $("#visitorNum").val(); //游客人数
        var tourGuide = $("#tourGuide").val(); //导游
        var startTime = $("#startTime").val(); //出发日期
        var numOfDay = $("#dateCount").val(); //天数
        var reserve = $("#reserve").val(); //准备金

        console.log("开始提交");

        var url = location.protocol.concat("//").concat(location.host).concat('/database/GroupTourCreateDB.php');
        $.ajax({
            url: url,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            type: 'post',
            data: inputData,
            success: function(response) {
                console.log("提交成功，开始下载准备金表");
                $("#groupDiscountNotice").addClass("nm-hide");
                // generate csv file
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
                for (var offset = 0; offset < numOfDay; offset++) {
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

                resetInputForm();
                $(".grouptourDownloadBox").css("display", "none");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("提交失败");
                console.log(textStatus, errorThrown);
            }
        });
    });
    // 点击取消
    $("#groupTourDownloadActionCancel").on('click', function() {
        $(".grouptourDownloadBox").css("display", "none");
    });

    // 根据结束日期生成天数
    $('#endTime').on('change', function() {
        var startTime = $('#startTime').val();
        var endTime = $('#endTime').val();
        var startNum = parseInt(startTime.replace(/-/g, ''), 10);
        var endNum = parseInt(endTime.replace(/-/g, ''), 10);
        if (startNum > endNum) {
            $('#endTime').removeAttr('value');
            $('#dateCount').removeAttr('value');
            alert("结束时间不能在开始时间之前！");
        } else {
            var days = generateDateCount(endTime, startTime);
            if (!isNaN(days)) {
                $('#dateCount').val(days);
            }
        }
    });

    // 根据天数计算结束日期
    $('#dateCount').on('keyup', function() {
        $('#endTime').val(addByTransDate($('#startTime').val(), parseInt($('#dateCount').val()) - 1));
    });

    // 根据出发日期计算天数或者结束日期
    $('#startTime').on('change', function() {
        var startTime = $('#startTime').val();
        var endTime = $('#endTime').val();

        var startNum = parseInt(startTime.replace(/-/g, ''), 10);
        var endNum = parseInt(endTime.replace(/-/g, ''), 10);

        var startDay = new Date(startTime);
        var endDay = new Date(endTime);

        if (endDay == 'Invalid Date') {
            var diff = $('#dateCount').val();
            if (diff != undefined) {
                $('#endTime').val(addByTransDate(startTime, parseInt(diff) - 1));
            }
        } else {
            if (startNum > endNum) {
                $('#endTime').removeAttr('value');
                $('#dateCount').removeAttr('value');
                alert("结束时间不能在开始时间之前");
            } else {
                $('#dateCount').val(generateDateCount(endDay, startDay));
            }
        }
    });

    // 点击准备金弹出准备金计算表
    $("#reserve").on("focus", function() {
        if ($(".leadnum").val() !== "" && $(".visitorNum").val() !== "" &&
            $("#startTime").val() !== "" && $("#dateCount").val() !== "") {

            $("#fundMsg").css("display", "block");
            $(".split").css("display", "block");
            $(".showMsg .teamIndie .groupMsg").css("height", "auto");

            $(".daynum").val($("#dateCount").val());
            $(".startime").val($("#startTime").val());
            $("#peopleCount").val(parseInt($("#leadNum").val()) + parseInt($("#visitorNum").val()));

            var leftHeight = $(".navInfo ul").height()
            var rightHeight = $(".theamInfo").height();
            if (rightHeight > leftHeight) {
                $(this).blur();
                $(".navInfo ul").css("height", rightHeight);
            }
        } else {
            $("#reserve").blur();
            alert("请填写出团人数，领队人数和日期信息");
        }
    });

    var addListItem = function(html) {
        var $html = $(html);
        $('.userTab1').append($html);
        $html.addClass("reserveListItem");
    }
    $("a#proTab").on("mousedown",function(){
    	$(this).addClass("tabhover");
    });
    $("a#proTab").on("mouseup",function(){
    	$(this).removeClass("tabhover");
    });


    $("a#proTab").on("click", function() {
//      $(this).addClass("tabhover");
        $(".userTab1").empty();
        $(".driverTipItem").empty();
        var lunch = $("#lunch").val();
        var dinner = $('#dinner').val();
        var count = $(".daynum").val(); //天数
        var lhnum = $(".startime").val(); //出发日期
        var numPeople = $("#peopleCount").val();
        var date;
        for (var i = 0; i < count; i++) {
            date = addByTransDate(lhnum, i);
            addListItem("<li>" + "<label>" + date + "</label></li>");
        }
        $('.reserveListItem').each(function() {
            var $lunchHtml = $("<input type='text' value='" + lunch + "'/>");
            $(this).append($lunchHtml);
            $lunchHtml.addClass("reserveInput");
            var $dinnerHtml = $("<input type='text' value='" + dinner + "'/>");
            $(this).append($dinnerHtml);
            $dinnerHtml.addClass("reserveInput");
        });
        $('.driverTipItem').append("<label>司机小费</label>");
        var $tipHtml = $("<input type='text' value='" + 5 * count * numPeople + "'/>");
        $('.driverTipItem').append($tipHtml);
        $tipHtml.addClass("driverTipInput");

        $("#fundMsg").css("display", "block");
        $(".userTab").css("display", "block");

        // 准备金 = 司机小费 + （午餐 + 晚餐）* 天数 * 人数
        $('#reserve').val(Number($('.driverTipInput').val()) + (Number(lunch) + Number(dinner)) * count * numPeople);

        //左右两侧保持高度相等
        var leftHeight = $(".navInfo ul").height();
        var rightHeight = $(".theamInfo").height();
        if (rightHeight > leftHeight) {
            $(this).blur();
            $(".navInfo ul").css("height", rightHeight);
        }
        if (rightHeight < leftHeight) {
            $(this).blur();
            $(".theamInfo").css("height", leftHeight);
        }
    });

    // 修改午餐或晚餐和司机小费，自动更新准备金
    $(document).on('keyup', '.reserveInput, .driverTipInput', function() {
        var sum = 0;
        var numPeople = $("#peopleCount").val();
        $('.reserveInput').each(function() {
            sum += Number($(this).val());
        });
        $('#reserve').val(sum * numPeople + Number($('.driverTipInput').val()));
    });

    $("#salespersonInput, #groupTourSource, #tourGuide").on('focus', function() {
        var current_id = $(this).attr('id');
        var target = "";
        if (current_id == 'salespersonInput') {
            target = 'salesperson';
        } else if (current_id == 'groupTourSource') {
            target = 'source';
        } else if (current_id == 'tourGuide') {
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
    });
});
