$(document).ready(function() {
    salesAction();

    /*
     *   销售人员的搜索列表
     */
    $("#performance-filter-salesperson").on('focus', function() {
        var current_id = $(this).attr('id');
        var url = location.protocol.concat("//").concat(location.host).concat('/database/autoComplete.php');
        $.ajax({
            url: url,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            type: 'post',
            data: {
                target: "salesperson"
            },
            success: function(response) {
                autocomplete(document.getElementById(current_id), JSON.parse(response));
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });

        // autocomplete(document.getElementById(current_id), ['abc', '123']);
    });


    function loadDisplayInfo() {
        var time_filter = $("#time_filter").val();
        var startTime = ($("#startTime").val() == "") ? getTime(new Date(), time_filter, 11) : $("#startTime").val();
        var endTime = ($("#endTime").val() == "") ? formatDate(new Date()) : $("#endTime").val();

        $("ul.rankingList1 li.detailInfo").remove();

        var url = location.protocol.concat("//").concat(location.host).concat('/database/Management/SalesPerformance.php');
        $.ajax({
            url: url,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            type: 'POST',
            data: {
                action: 'getGeneralPerformance',
                time_filter: time_filter,
                start_date: startTime,
                end_date: endTime
            },
            success: function(response) {
                response = JSON.parse(response);
                for (var i = 0; i < response[0].length; i++) {
                    var $html = `
                        <li class="detailInfo">
                            <dl>
                                <dd class="time">` + response[0][i] + `</dd>
                                <dd class="groupTour">` + response[1][i] + `</dd>
                                <dd class="individualTour">` + response[2][i] + `</dd>
                                <dd class="airTicket">` + response[3][i] + `</dd>
                                <dd class="sum">` + response[4][i] + `</dd>
                            </dl>
                        </li>
                    `
                    $("ul.rankingList1").append($html);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }

    loadDisplayInfo();
    $("#time_filter, #startTime, #endTime").on('change', function() {
        loadDisplayInfo();
    });
});



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

function getTime(date, time_filter, diff) {
    var month = "";
    if (time_filter == 'daily') {
        date.setDate(date.getDate() - diff);
    } else if (time_filter == 'monthly') {
        month = date.getMonth() - diff;
        date.setDate(1);
        date.setMonth(month);
    } else if (time_filter == 'seasonly') {
        month = date.getMonth() - diff * 3 - 2;
        date.setDate(1);
        date.setMonth(month);
    } else if (time_filter == 'hyearly') {
        month = date.getMonth() - diff * 6 - 5;
        date.setDate(1);
        date.setMonth(month);
    } else if (time_filter == 'yearly') {
        var year = date.getFullYear() - diff;
        date.setYear(year);
        date.setDate(1);
        date.setMonth(0);
    }
    return formatDate(date);
}

function loadSalesPerformance(salesperson) {
    var startTime = ($("#startTime").val() == "") ? getTime(new Date(), $("#time_filter").val(), 11) : $("#startTime").val();
    var endTime = ($("#endTime").val() == "") ? formatDate(new Date()) : $("#endTime").val();
    var data = {
        action: 'getGeneralPerformance',
        salesperson: salesperson,
        time_filter: $("#time_filter").val(),
        start_date: startTime,
        end_date: endTime
    }

    $("ul.rankingList1 li.detailInfo").remove();

    var url = location.protocol.concat("//").concat(location.host).concat('/database/Management/SalesPerformance.php');
    $.ajax({
        url: url,
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        type: 'POST',
        data: data,
        success: function(response) {
            response = JSON.parse(response);
            for (var i = 0; i < response[0].length; i++) {
                var $html = `
                    <li class="detailInfo">
                        <dl>
                            <dd class="time">` + response[0][i] + `</dd>
                            <dd class="groupTour">` + response[1][i] + `</dd>
                            <dd class="individualTour">` + response[2][i] + `</dd>
                            <dd class="airTicket">` + response[3][i] + `</dd>
                            <dd class="sum">` + response[4][i] + `</dd>
                        </dl>
                    </li>
                `
                $("ul.rankingList1").append($html);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

//加/减
function salesAction() {
    $(".optionItem").on("mousedown", function() {
        $(this).addClass("option-active");
    });
    $(".optionItem").on("mouseup", function() {
        $(this).removeClass("option-active");
    });
    $("ul.salesNav").find("li").find("a.confirmBtn").on("mousedown", function() {
        $(this).addClass("selected");
    });
    $("ul.salesNav").find("li").find("a.confirmBtn").on("mouseup", function() {
        $(this).removeClass("selected");
    });


    //添加
    $(".plusItem").on("click", function() {
        $("li.salesFilter").css("visibility", "visible");
        // $("li.salesFilter").find("input").on("keydown", function() {
        //     if (event.keyCode == 13) {
        //         var salesNameTxt = $.trim($("li.salesFilter").find("input").val())
        //         var salesInfo = $.trim($(".salesName").text());
        //         if ($(".salesName").length < 6) {
        //             if (salesInfo.indexOf(salesNameTxt) !== -1) {
        //                 // alert("输入的销售人员信息不能一致");
        //                 $("li.salesFilter").find("input").val("");
        //             } else {
        //                 var e = `<li class="salesName">` + salesNameTxt + `</li>`;
        //                 $(".rightInfo ul").append(e);
        //                 //当前为背景为灰色
        //                 $("li.salesName:last").addClass("selected").siblings("li.salesName").removeClass("selected");
        //                 salesNameState(); //选中状态
        //                 $("#performance-filter-salesperson").val("");
        //                 loadSalesPerformance(salesNameTxt);
        //             }
        //         } else {
        //             alert("最多添加6人");
        //         }
        //     }
        // });
        minusAction();
        //确认添加:
        $("ul.salesNav").find("li").find("a.confirmBtn").on("click", function() {
            var salesNameTxt = $.trim($("li.salesFilter").find("input").val());
            var salesInfo = $.trim($(".salesName").text());
            if (salesInfo.indexOf(salesNameTxt) !== -1) {
                alert("输入的销售人员信息不能一致");
                $("li.salesFilter").find("input").val("");
            } else {
                var e = `<li class="salesName">` + salesNameTxt + `</li>`;
                $(".rightInfo ul").append(e);
                //当前为背景为灰色
                $("li.salesName:last").addClass("selected").siblings("li.salesName").removeClass("selected");
                salesNameState(); //选中状态
                $("#performance-filter-salesperson").val("");
                loadSalesPerformance(salesNameTxt);
            }
        });
    });
}

//移除
function minusAction() {
    $(".minusItem").on("click", function() {
        //移除当前选中的元素
        $(".rightInfo ul").find("li.salesName.selected").remove("");
        $("li.salesFilter").find("input").val("");
        //移除至只剩下一个
        if ($(".rightInfo ul").find("li.salesName").length == 1) {
            $("ul.rankingList1").fadeIn("slow");
            $("ul.rankingList2").css("display", "none");
        }
        if ($(".rightInfo ul").find("li.salesName").length > 1) {
            $(".salesDetail").empty();
        }
        //全部移除
        if ($(".rightInfo ul").find("li.salesName").length < 1) {
            $("ul.rankingList1").fadeIn("slow");
            $("ul.rankingList2").css("display", "none");
        }
        salesAction();
    });
}

function selectSales() {
    var startTime = ($("#startTime").val() == "") ? getTime(new Date(), $("#time_filter").val(), 11) : $("#startTime").val();
    var endTime = ($("#endTime").val() == "") ? formatDate(new Date()) : $("#endTime").val();
    var data = {
        action: 'getSpecificPerformance',
        time_filter: $("#time_filter").val(),
        start_date: startTime,
        end_date: endTime
    }
    var salespersons = [];
    for (var i = 0; i < $("li.salesName.selected").length; i++) {
        salespersons.push($($("li.salesName.selected")[i]).text());
    }
    Object.assign(data, {
        salespersons: JSON.stringify(salespersons)
    });
    multipleSalespersonChose(data);
}


//销售人员的选中状态
function salesNameState() {
    $(".rightInfo").find("ul").find("li.salesName").unbind("click").on("click", function() {
        if (!$(this).hasClass("selected")) {
            $(this).addClass("selected");
            salesChart(); //表1和表2的切换
            heightRange();

            $("ul.rankingList2 li.detailInfo").remove();

            if ($("li.salesName.selected").length >= 2) {
                selectSales();
            } else {
                var salesperson = $("li.salesName.selected")[0].innerHTML;
                loadSalesPerformance(salesperson);
            }
        } else {
            $(this).removeClass("selected");

            $("ul.rankingList2 li.detailInfo").remove();

            if ($("li.salesName.selected").length >= 2) {
                selectSales();
            } else if ($("li.salesName.selected").length == 1) {
                //当前选中只剩下一个元素时
                $("ul.rankingList1").fadeIn("slow");
                $("ul.rankingList2").css("display", "none");
                var salesperson = $("li.salesName.selected")[0].innerHTML;
                loadSalesPerformance(salesperson);
            } else {
                loadSalesPerformance();
            }
        }
    });
}

//销售人员业绩信息表
function salesChart() {
    var selectedNum = $(".rightInfo ul").find("li.salesName.selected").length;
    var timeList = $("ul.rankingList1").find("li.detailInfo").find("dd.time"); //日期
    var groupTourList = $("ul.rankingList1").find("li.detailInfo").find("dd.groupTour"); //独立团
    var individualTourList = $("ul.rankingList1").find("li.detailInfo").find("dd.individualTour"); //散拼团
    var airTicketList = $("ul.rankingList1").find("li.detailInfo").find("dd.airTicket"); //机票
    var sumList = $("ul.rankingList1").find("li.detailInfo").find("dd.sum");
    var selectBox = $(".leftInfo").find("li").find("select");
    //当前销售人员为1条时：
    if (selectedNum == 1) {
        $("ul.rankingList1").fadeIn("slow");
        $("ul.rankingList2").css("display", "none");
        //默认按天显示
        if ($.trim(selectBox.find("option:selected").text()) == "每日") {
            for (var i = 0; i < timeList.length; i++) {
                var dataInfo = "2018-03-" + (i + 1); //日期
                var groupTourInfo = parseInt("463" + i); //独立团
                var individualTourInfo = parseInt("449" + i); //散拼团
                var airTicketInfo = parseInt("522" + i); //机票
                var sumInfo = parseInt(groupTourInfo + individualTourInfo + airTicketInfo); //总和
                $(timeList[i]).text(dataInfo);
                $(groupTourList[i]).text(groupTourInfo);
                $(individualTourList[i]).text(individualTourInfo);
                $(airTicketList[i]).text(airTicketInfo);
                $(sumList[i]).text(sumInfo);
            }
        }
        selectDate(); //日期选择
    }
    //销售人员表中的销售人员为多条时:
    else if (selectedNum > 1) {
        $("ul.rankingList2").fadeIn("slow");
        $("ul.rankingList1").css("display", "none");
    }
}
//销售人员表中的销售人员为多条时:
function moreSalesInfo(salesList, i) {
    //销售人员名字
    var salesBox = $("dd.sales").find("dl.salesDetail");
    var salesBoxInfo = `
					<dd class="salesInfo">` + salesList + `
					</dd>
							`;
    salesBox.append(salesBoxInfo);

    //独立团部分
    var groupTourBox = $("dd.groupTour").find("dl.salesDetail");
    var data = [140, 155, 133];
    var maxItem = Math.max.apply(null, data);
    var groupTourInfo = salesBoxInfo = `
					<dd class="groupInfo">` + data[i] + `
					</dd>
							`;
    groupTourBox.append(groupTourInfo);
    if (data[i] == maxItem) {
        $(groupTourBox.find("dd")[i]).addClass("max"); //最大值标记为红色
    }
    var newHeight = $("dd.sales").height();
    $("dd.sales").siblings("dd").css("height", newHeight);
    heightRange();
}


function autoWrap() {
    var detailCell = $(".performanceTheam").find("ul.rankingList2").find("li.detailInfo").find("dd.cellBox");
    for (var i = 0; i < detailCell.length; i++) {
        if ($(detailCell[i]).height() >= 32) {
            var currentHeight = $(".performanceTheam").find("ul.rankingList2").find("li.detailInfo").eq(i).height();
            $(".performanceTheam").find("ul.rankingList2").find("li.detailInfo").eq(i).find("dd.cellBox").css({
                "height": currentHeight,
                "line-height": currentHeight + "px"
            });
            $(".performanceTheam").find("ul.rankingList2").find("li.detailInfo").eq(i).find("dd.time.cellBox").find("dl").find("dd")
                .css("cssText", "height:" + currentHeight + "px" + "!important ;" + "line-height:" + currentHeight + "px" + "!important");
        }
    }
}


function multipleSalespersonChose(data) {
    var salespersons = JSON.parse(data['salespersons']);

    var url = location.protocol.concat("//").concat(location.host).concat('/database/Management/SalesPerformance.php');
    $.ajax({
        url: url,
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        type: 'POST',
        data: data,
        success: function(response) {
            response = JSON.parse(response);

            var dateInfo = [];
            var salespersonInfo = [];
            var groupSum = [];
            var indivSum = [];
            var airTicketSum = [];
            var totalSum = [];

            for (var i = 0; i < response[0][0].length; i++) {
                dateInfo.push(response[0][0][i]);
            }

            for (var i = 0; i < response.length; i++) {
                salespersonInfo.push(salespersons[i]);
                groupSum.push(response[i][1]);
                indivSum.push(response[i][2]);
                airTicketSum.push(response[i][3]);
                totalSum.push(response[i][4]);
            }

            for (var i = 0; i < dateInfo.length; i++) {
                $("ul.rankingList2").append(
                    `
                    <li class="detailInfo">
                        <dl>
                            <dd class="time cellBox">
                                <dl class="salesDetail">
                                    <dd>` + dateInfo[i] + `</dd>
                                </dl>
                            </dd>
                            <dd class="sales cellBox">
                                <dl class="salesDetail"></dl>
                            </dd>
                            <dd class="groupTour cellBox">
                                <dl class="salesDetail"></dl>
                            </dd>
                            <dd class="individualTour cellBox">
                                <dl class="salesDetail"></dl>
                            </dd>
                            <dd class="airTicket cellBox">
                                <dl class="salesDetail"></dl>
                            </dd>
                            <dd class="sum cellBox">
                                <dl class="salesDetail"></dl>
                            </dd>
                        </dl>
                    </li>
                    `
                );
            }
            for (var i = 0; i < dateInfo.length; i++) {
                for (var j = 0; j < groupSum.length; j++) {
                    if (j != 0) {
                        $("ul.rankingList2 li.detailInfo dd.time:eq(" + i + ") dl.salesDetail").append(`<dd></dd>`);
                    }
                    $("ul.rankingList2 li.detailInfo dd.sales:eq(" + i + ") dl.salesDetail").append(`<dd class="groupInfo">` + salespersonInfo[j] + `</dd>`);
                    $("ul.rankingList2 li.detailInfo dd.groupTour:eq(" + i + ") dl.salesDetail").append(`<dd class="groupInfo">` + groupSum[j][i] + `</dd>`);
                    $("ul.rankingList2 li.detailInfo dd.individualTour:eq(" + i + ") dl.salesDetail").append(`<dd class="indivInfo">` + indivSum[j][i] + `</dd>`);
                    $("ul.rankingList2 li.detailInfo dd.airTicket:eq(" + i + ") dl.salesDetail").append(`<dd class="airInfo">` + airTicketSum[j][i] + `</dd>`);
                    $("ul.rankingList2 li.detailInfo dd.sum:eq(" + i + ") dl.salesDetail").append(`<dd class="totalInfo">` + totalSum[j][i] + `</dd>`);
                }
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}
