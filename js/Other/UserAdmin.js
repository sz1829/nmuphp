$(document).ready(function() {
	cardToggle();
	manageToggle();
	confirmAddInfo();
	confirmInfo();

	$("#create-user-confirm").on("click", function() {
		var username = $("#create-username").val();
		var password = $("#create-password").val();

		if(username == "" || password == "") {
			return;
		}

		var group = $($("div.userGroup ul li.selected")[0])[0]['innerText'];
		var user_group = "";
		if(group == '销售人员') {
			user_group = 'normal';
		} else if(group == '会计') {
			user_group = 'accounting';
		} else {
			user_group = 'admin';
		}

		var url = location.protocol.concat("//").concat(location.host).concat('/database/Other/UserAdmin.php');
		$.ajax({
			url: url,
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			type: 'POST',
			data: {
				action: 'createUser',
				username: username,
				password: password,
				user_group: user_group
			},
			success: function(response) {
				console.log(response);
				$("#create-username").val("");
				$("#create-password").val("");
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	});

	$("#update-password-confirm").on("click", function() {
		var username = $("#update-username").val();
		var password = $("#update-password").val();
		if(username == "" || password == "") {
			return;
		}

		var url = location.protocol.concat("//").concat(location.host).concat('/database/Other/UserAdmin.php');
		$.ajax({
			url: url,
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			type: 'POST',
			data: {
				action: 'updatePassword',
				username: username,
				password: password
			},
			success: function(response) {
				console.log(response);
				$("#update-username").val("");
				$("#update-password").val("");
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	});
});

function cardToggle() {
	$(".usersManageNav").find("li").on("click", function() {
		var index = $(this).index();
		$(this).addClass("current-item").siblings("li").removeClass("current-item");
		$(".usersManageInfo").eq(index).css("display", "block").siblings(".usersManageInfo").css("display", "none");
		// $("input[type='password']").val("");
		// $("input[type='text']").val("");
		// $(".usersInfo ul").find("li").removeClass("selected");
		// $(".userGroup ul").find("li").removeClass("selected");
	});
}

function manageToggle() {
	//销售人员
	$(".userGroup").find("li.salesNav").on("click", function() {
		$(this).addClass("selected").siblings().removeClass("selected");
		// $("input.userName").val(" ");
		// $(".usersInfo ul").find("li").removeClass("selected");
		// var userNameList = ["Sales.A", "Sales.B", "Sales.C", "Sales.D"];
		// var userName = $(".usersInfo ul li dl").find("dd.userName");
		// for (var i = 0; i < userNameList.length; i++) {
		//     $(userName[i]).text($.trim(userNameList[i]));
		// }
	});
	//会计
	$(".userGroup").find("li.accountingNav").on("click", function() {
		$(this).addClass("selected").siblings().removeClass("selected");
		// $("input.userName").val(" ");
		// $(".usersInfo ul").find("li").removeClass("selected");
		// var userNameList = ["Accountant.A", "Accountant.B", "Accountant.C", "Accountant.D"];
		// var userName = $(".usersInfo ul li dl").find("dd.userName");
		// for (var i = 0; i < userNameList.length; i++) {
		//     $(userName[i]).text($.trim(userNameList[i]));
		// }
	});
	//管理员
	$(".userGroup").find("li.managerNav").on("click", function() {
		$(this).addClass("selected").siblings().removeClass("selected");
		// $("input.userName").val(" ");
		// $(".usersInfo ul").find("li").removeClass("selected");
		// var userNameList = ["Manager.A", "Manager.B", "Manager.C", "Manager.D"];
		// var userName = $(".usersInfo ul li dl").find("dd.userName");
		// for (var i = 0; i < userNameList.length; i++) {
		//     $(userName[i]).text($.trim(userNameList[i]));
		// }
	});
}

function confirmAddInfo() {
	$("#create-user-confirm").on("click", function() {
		$(".confirmUsersInfo").find("p.confirmNotice").text("添加成功");
		userName = $("#create-username").val();
		userPassWord = $("#create-password").val();
		copyInfo(userName, userPassWord);
	});
}

function confirmInfo() {
	$("#update-password-confirm").on("click", function() {
		$(".confirmUsersInfo").find("p.confirmNotice").text("修改成功");
		userName = $("#update-userName").val();
		userPassWord = $("#update-password").val();
		copyInfo(userName, userPassWord);
	});
}

function copyInfo(userName, userPassWord) {
	if(userPassWord !== "" && userName !== "") {
		$(".confirmUsersInfo").fadeIn();
		$(".copyInfo").unbind("click");
		var clipboard = new ClipboardJS('.copyInfo', {
			text: function() {
				alert("复制成功!");
				return "用户名:" + userName + "\n" + "密码:" + userPassWord
			}
		});
		$(".actionCancel").on("click", function() {
			$(".confirmUsersInfo").fadeOut();
			clipboard.destroy();
		});
	} else {
		alert("请确认要添加的用户名和密码已输入");
	}
}
