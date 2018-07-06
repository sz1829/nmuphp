function accountingNav() {
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
	$(".accountingNav ul").find("li").find("a").on("click", function() {
		if(!$(this).parent().hasClass("accountingNav-active")) {
				$(this).parent().addClass("accountingNav-active");
			} else {
				$(this).parent().removeClass("accountingNav-active");
			}
		$(".nav-box").css("display", "none");
		var pages=["OrderHistory.php","GroupTourHistory.php","IndividualTourHistory.php","AirTicketHistory.php","GroupAndIndividual.php","GroupAndAirticket.php","IndividualAndAirTicket.php"];
		//都取消选中
		if(!($(".groupTour").hasClass("accountingNav-active") )&& (!$(".individualTour").hasClass("accountingNav-active")) && (!$(".airTicket").hasClass("accountingNav-active"))) {
			$(".recordAll").addClass("accountingNav-active");
			$(this).attr("href",pages[0]);
			/*$(".allHistory").css("display","block");
			$(".groupHistory").css("display","none");
			$(".indiviHistory").css("display","none");
			$(".airticketHistory").css("display","none");*/
			
		}
		//只选中独立团
		if($(".groupTour").hasClass("accountingNav-active") && (!$(".individualTour").hasClass("accountingNav-active")) && (!$(".airTicket").hasClass("accountingNav-active"))) {
			$(".recordAll").removeClass("accountingNav-active");
			$(this).attr("href",pages[1]);
			/*$(".allHistory").css("display","none");
			$(".groupHistory").css("display","block");
			$(".indiviHistory").css("display","none");
			$(".airticketHistory").css("display","none");*/
		}
		//只选中散拼团
		if($(".individualTour").hasClass("accountingNav-active") && (!$(".groupTour").hasClass("accountingNav-active")) && (!$(".airTicket").hasClass("accountingNav-active"))) {
			$(".recordAll").removeClass("accountingNav-active");
			$(this).attr("href",pages[2]);
			/*$(".allHistory").css("display","none");
			$(".groupHistory").css("display","none");
			$(".indiviHistory").css("display","block");
			$(".airticketHistory").css("display","none");*/

		}
		//只选中机票
		if($(".airTicket").hasClass("accountingNav-active") && (!$(".groupTour").hasClass("accountingNav-active")) && (!$(".individualTour").hasClass("accountingNav-active"))) {
			$(".recordAll").removeClass("accountingNav-active");
			$(this).attr("href",pages[3]);
			/*$(".allHistory").css("display","none");
			$(".groupHistory").css("display","none");
			$(".indiviHistory").css("display","none");
			$(".airticketHistory").css("display","block");*/
			
		}
		//选中独立团+散拼团
		if($(".groupTour").hasClass("accountingNav-active") && ($(".individualTour").hasClass("accountingNav-active")) && (!$(".airTicket").hasClass("accountingNav-active"))) {
			$(".recordAll").removeClass("accountingNav-active");
			$(this).attr("href",pages[4]);
			/*$(".allHistory").css("display","block");
			$(".groupHistory").css("display","none");
			$(".indiviHistory").css("display","none");
			$(".airticketHistory").css("display","none");*/

		}
		//选中独立团+机票
		if($(".groupTour").hasClass("accountingNav-active") && (!$(".individualTour").hasClass("accountingNav-active")) && ($(".airTicket").hasClass("accountingNav-active"))) {
			$(".recordAll").removeClass("accountingNav-active");
			$(this).attr("href",pages[5]);
//			$(".allHistory").css("display","block");
//			$(".groupHistory").css("display","none");
//			$(".indiviHistory").css("display","none");
//			$(".airticketHistory").css("display","none");
		}
		//选中机票+散拼团
		if(!$(".groupTour").hasClass("accountingNav-active") && ($(".individualTour").hasClass("accountingNav-active")) && ($(".airTicket").hasClass("accountingNav-active"))) {
			$(".recordAll").removeClass("accountingNav-active");
			$(this).attr("href",pages[6]);
//			$(".allHistory").css("display","block");
//			$(".groupHistory").css("display","none");
//			$(".indiviHistory").css("display","none");
//			$(".airticketHistory").css("display","none");
		}
		//同时选中
		if($(".airTicket").hasClass("accountingNav-active") && ($(".groupTour").hasClass("accountingNav-active")) && ($(".individualTour").hasClass("accountingNav-active"))) {
			$(".recordAll").addClass("accountingNav-active");
			$(this).attr("href",pages[0]);
			/*$(".allHistory").css("display","block");
			$(".groupHistory").css("display","none");
			$(".indiviHistory").css("display","none");
			$(".airticketHistory").css("display","none");*/
			setTimeout(function() {
				accountingHide();
			}, 100);
		}

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

	function accountingHide() {
		$(".groupTour").delay("slow").removeClass("accountingNav-active");
		$(".individualTour").delay("slow").removeClass("accountingNav-active");
		$(".airTicket").delay("slow").removeClass("accountingNav-active");
	}
	$(".accountingNav ul").find("li.recordAll").find("a").on("click", function() {
		$(this).parent().addClass("accountingNav-active");
		$(this).attr("href","OrderHistory.php");
		/*$(".allHistory").css("display","block");
		$(".groupHistory").css("display","none");
		$(".indiviHistory").css("display","none");
		$(".airtickeHistory").css("display","none");*/
		$(this).parent().siblings("li").removeClass("accountingNav-active");
	});

}
//状态切换
function labToggle(labOuter) {
	labOuter.find("a").on("click", function() {
		if(!$(this).hasClass("option-active")) {
				$(this).addClass("option-active");
		} else {
				$(this).removeClass("option-active");
		}
	});
}
//时间区间
function accountDateRange(dateSelect, dateInfo) {
	dateSelect.find("select").on("change", function() {
		var currentText = $(this).find("option:selected").text();
		if(currentText == "Customized") {
			dateInfo.css("visibility", "initial");
			dateInfo.css("display", "inline-block");
			var dateBox=$(".filterInfo ul li.dateOption .groupTourDateRange").find("input");
			var dateSelectBox=$(".filterInfo ul li.dateOption").find("select").outerWidth();
			var spanWidth=$(".filterInfo ul li.dateOption").find("span").outerWidth();
			dateBox.css("cssText","width:"+(dateSelectBox-spanWidth)/2+"px"+"!important");
		} else {
			dateInfo.css("visibility", "hidden");
			dateInfo.css("display", "none");
		}

	});
	$(window).resize(function() {
		var dateBox=$(".filterInfo ul li.dateOption .groupTourDateRange").find("input");
		var dateSelectBox=$(".filterInfo ul li.dateOption").find("select").outerWidth();
		var spanWidth=$(".filterInfo ul li.dateOption").find("span").outerWidth();
		dateBox.css("cssText","width:"+(dateSelectBox-spanWidth)/2+"px"+"!important");
//		console.log(dateBox.css("width"));
	});
	
	
	
	$("li.finishDateOption").find("select").on("change", function() {
		var currentText = $(this).find("option:selected").text();
		if(currentText == "Customized") {
			$(".finishDateRange").css("display", "block");
		} else {
			$(".finishDateRange").css("display", "none");
		}

	});
	
	var dateBox=$(".filterInfo ul li.dateOption .groupTourDateRange").find("input");
	var dateSelectBox=$(".filterInfo ul li.dateOption").find("select").outerWidth();
	var spanWidth=$(".filterInfo ul li.dateOption").find("span").outerWidth();
	dateBox.css("cssText","width:"+(dateSelectBox-spanWidth)/2+"px"+"!important");
	
	
}
//选中状态
function checkedCell() {
	$(".bms-tab").find("ul.accountRecordMsg").find("li").click(function() {
		$(this).addClass("accounting-active").siblings().removeClass("accounting-active");
	});
}
//通用信息选择
function generalInfo() {
	$(".showMsg .floor .groupMsg").find(".tabCard ul li").find("input[type='checkbox']").on("click", function() {
		var txt = $.trim($(this).parent().find("label:visible").text());
		var e = `<dd class="new">` + txt + `</dd>`;
		var e2 = `<dd class="new"></dd>`;
		var dlBox = $(".resultInfo").find("ul li.resultNav").find("dl");
		var liBox = $(".resultInfo").find("ul li.resultDetail").find("dl");
		if(!$(this).parent().parent("li").hasClass("selected")) {
			//选中某一项
			$(this).parent().parent("li").addClass("selected");
			$(e).appendTo(dlBox);
			$(e2).appendTo(liBox);
			var dWidth = dlBox.find("dd").outerWidth();
			var newWidth = dWidth * (dlBox.find("dd").length);
			$(".resultInfo ul").css({
				"width": newWidth,
			});
			if(newWidth > $(".resultInfo").outerWidth()) {
				$(".resultInfo").css({
					"overflow-x": "scroll",
				});
			}

		} else {
			for(var i = 0; i < dlBox.find("dd").length; i++) {
				if(txt == $.trim($(dlBox.find("dd")[i]).text())) {
					var dWidth = dlBox.find("dd").outerWidth();
					var newWidth = dWidth * (dlBox.find("dd").length);
					if(newWidth > dWidth * 2) {
						$(this).parent().parent("li").removeClass("selected");
						$(dlBox.find("dd")[i]).remove();
						for(var j = 0; j < $(".resultInfo").find("ul li.resultDetail").length; j++) {
							var dWidth = dlBox.find("dd").outerWidth();
							var newWidth = dWidth * (dlBox.find("dd").length);
							$(".resultInfo ul").css({
								"width": newWidth,
							});
							$($(".resultInfo").find("ul li.resultDetail")[j]).find("dl").find("dd").eq(i).remove();
							if(newWidth < $(".resultInfo").outerWidth()) {
								$(".resultInfo").css({
									"overflow-x": "initial",
								});
							}

						}

					}
					else{
						alert("至少选中一条通用信息");
						$(this).attr("checked","checked");
					}
				}
			}

		}
	});
}