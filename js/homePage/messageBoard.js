//留言板
function messageBoard() {
	autoWrap();
	addQuestion();
	answerQuestion();
	resolvedIssues();
	confirmInfo();
	toUsersManagePage();
	$(window).resize(function(){
		autoWrap();
	});
	
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
//文字换行
function autoWrap() {
	for(var i = 0; i < $("ul.messageCard li.messageDetail").length; i++) {
		var dlHeight = $("ul.messageCard li.messageDetail").eq(i).find("dl").height();
		$("ul.messageCard li.messageDetail").eq(i).find("dl").find("dd").css("height", dlHeight + "px");
		$("ul.messageCard li.messageDetail").eq(i).find("dl").find("dd").css("overflow","hidden");
	}
}
//添加问题部分
function addQuestion() {
	$("ul.answerAndAdd li.addItem").on("click", function() {
		$(this).addClass("selected");
		$(".detailMsg.addCard").css("display", "inline-block");
		$(".detailMsg.answerCard").css("display", "none");
		$(".detailMsg.resolvedCard").css("visibility","hidden");
		$("ul.answerAndAdd li.answerItem").removeClass("selected");
		$("ul.messageCard li.messageDetail").removeClass("selected");
		$(".rightMeaaageTab").find(".detailMsg.addCard").find("ul").find("li").find("textarea").val("");
		 heightRange();
	});
	//添加
	$(".rightMeaaageTab .detailMsg.addCard ul li.actionFilerBox").find("a:first").unbind("click").on("click", function() {
		var questionTxt = $.trim($(".rightMeaaageTab .detailMsg ul li.questionInfoTxt").find("textarea").val());
		var moreTxt = $.trim($(".rightMeaaageTab .detailMsg ul li.moreInfoTxt").find("textarea").val());
		var typeInfo = $(".filterMessage ul li select").val();
		var salesName = $(".filterMessage ul li input").val();
		var e = "<li class='messageDetail'>" +
			"<dl>" +
			"<dd class='askItem'>" + salesName + "</dd>" +
			"<dd class='askTime'></dd>" +
			"<dd class='problemType'>" + typeInfo + "</dd>" +
			"<dd class='problemContent'>" + questionTxt + "</dd>" +
			"<dd class='moreInfo'>" + moreTxt + "</dd>" +
			"<dd class='answerInfo'></dd>" +
			"</dl>" +
			"</li>";
		$("ul.messageCard").append(e);
		autoWrap();
		answerQuestion();
		heightRange();
	});
	//清空
	$(".rightMeaaageTab .detailMsg.addCard ul li.actionFilerBox").find("a:last").on("click", function() {
		$(".rightMeaaageTab .detailMsg ul li.questionInfoTxt").find("textarea").val("");
		$(".rightMeaaageTab .detailMsg ul li.moreInfoTxt").find("textarea").val("");
	});

}
//解答问题部分
function answerQuestion() {
	$("ul.messageCard li.messageDetail").unbind("click").on("click", function() {
		var thisLi = $(this);
		if($(this).hasClass("selected")) {
			$(this).removeClass("selected");
		} else {
			$(this).addClass("selected");
			$(this).siblings().removeClass("selected");
			$(".detailMsg.addCard").css("display", "none");
			$(".detailMsg.resolvedCard").css("visibility","hidden");
			$(".detailMsg.answerCard").css("display", "inline-block");
			$(".rightMeaaageTab").find(".detailMsg.answerCard").find("ul").find("li").find("textarea").val("");
			$("ul.answerAndAdd li.answerItem").addClass("selected");
			$("ul.answerAndAdd li.addItem").removeClass("selected");
			var questionTxt = $.trim($(this).find("dd.problemContent").text());
			var moreTxt = $.trim($(this).find("dd.moreInfo").text());
			$("p.answerTxt").html(questionTxt);
			$("p.answerMoreInfo").html(moreTxt);
			 heightRange();
			//回复
			$(".detailMsg.answerCard").find("ul li.actionFilerBox").find("a:first").unbind("click").on("click", function() {
				var replayTxt = $(".detailMsg.answerCard").find("textarea").val();
				thisLi.find("dl").find("dd.answerInfo").text(replayTxt);
				autoWrap();//回复文字换行
				$("ul.messageCard").find("li.messageDetail.selected").find("dl").find("dd.answerInfo").css({
					"width":"22%",
					"padding-left":"1%",
					"text-align":"left"
				});
			});
			//清空
			$(".detailMsg.answerCard").find("ul li.actionFilerBox").find("a:last").on("click", function() {
				$(".detailMsg.answerCard").find("textarea").val("");
			});
		}

	});
}
//确认
function confirmInfo(){
	$(".filterMessage ul li select").find("option").on("mouseenter",function(){
		$(this).addClass("hover");
		console.log("11111111");
	});
	$(".filterMessage ul li").find("a").on("click",function(){
		var typeInfo=$(".filterMessage ul li select").val();
		var salesInfo=$(".filterMessage ul li input[type=text]").val();
		console.log(typeInfo+"\n"+salesInfo);
		
	});
	$(".filterMessage ul li").find("a").on("mousedown",function(){
		$(this).addClass("selected");
	});
	$(".filterMessage ul li").find("a").on("mouseup",function(){
		$(this).removeClass("selected");
	});
	
}

//已解决的问题
function resolvedIssues() {
	$(".messageBoard .leftMessageTab ul.problemMsg input[type='checkbox']").on("click", function() {
		//未选中状态
		if(!$(this).attr("checked")) {
			$("ul.messageCard li.messageDetail").removeClass("selected");
			$(this).parent().parent("ul.problemMsg").find("li:last").css("visibility", "visible");
			for(var i = 0; i < $("ul.messageCard li.messageDetail").length; i++) {
				if($("ul.messageCard li.messageDetail").eq(i).find("dd.answerInfo").text() !== "") {
					$("ul.messageCard li.messageDetail").eq(i).addClass("resolved");
					$(".detailMsg.addCard").css("display","none");
					$(".detailMsg.answerCard").css("display", "none");
					$(".detailMsg.resolvedCard").css("visibility","visible");
					$("ul.answerAndAdd li.answerItem").addClass("selected");
					$("ul.answerAndAdd li.addItem").removeClass("selected");
					$("ul.messageCard li.messageDetail").unbind("click");
					$("ul.answerAndAdd li.addItem").unbind("click");
					$(".rightMeaaageTab .detailMsg.resolvedCard").find("ul").find("li.actionFilerBox").find("a");
					var questionTxt=$.trim($("ul.messageCard li.messageDetail").eq(i).find("dd.problemContent").text());
					var moreTxt=$.trim($("ul.messageCard li.messageDetail").eq(i).find("dd.moreInfo").text());
					$("p.answerTxt").html(questionTxt);
					$("p.answerMoreInfo").html(moreTxt);
				}

			}
		} else {
			$(this).parent().parent("ul.problemMsg").find("li:last").css("visibility", "hidden");
			$("ul.messageCard li.messageDetail").removeClass("resolved");
			$(".detailMsg.addCard").css("display","inline-block");
			$(".detailMsg.resolvedCard").css("visibility","hidden");
			$(".detailMsg.answerCard").css("display", "none");
			$("ul.answerAndAdd li.answerItem").removeClass("selected");
			$("ul.answerAndAdd li.addItem").addClass("selected");
			$("ul.messageCard li.messageDetail").removeClass("selected");
			addQuestion();
			answerQuestion();
			//						$("ul.answerAndAdd li.addItem").addClass("selected");
			$(".rightMeaaageTab").find(".detailMsg.addCard").find("ul").find("li").find("textarea").val("");

		}

	});

}
//跳转到用户管理页面
function toUsersManagePage() {
	var isSales = true;
	$("a#toUsersManagePage").on("click", function() {
		//对于销售人员:
		if(isSales == true) {
			$(this).attr("href", "UsersManageToSales.php");
		}
		//对于管理人员:
		if(isSales == false) {
			$(this).attr("href", "UsersManageToAdmin.php");
		}
	});
}