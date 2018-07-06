	function homePage() {
		weather(); //天气
		calendar(); //日历
		pendingMatters(); //待处理事项
		infoTips(); //相关提醒
		$(".homePage").find(".otherUserInfo.pendingItem").find("a.addNewItem").on("mousedown",function(){
			$(this).addClass("selected");
		});
		$(".homePage").find(".otherUserInfo.pendingItem").find("a.addNewItem").on("mouseup",function(){
			$(this).removeClass("selected");
		});
	}
	//天气
	function weather() {
		$.ajax({
			type: "post",
			url: "https://free-api.heweather.com/s6/weather/now?location=auto_ip&key=925b767a1d834c66bd48b642a78f8550",
			success: function(result) {
				var weather = JSON.stringify(result);
				//console.log(weather);
				var now = result.HeWeather6[0].now; //现在的天气
				var basic = result.HeWeather6[0].basic; //基本信息
				var weather_code = now.cond_code; //天气代码
				var weather_txt = now.cond_txt;
				var weather_tmp = now.tmp; //温度
				var wind_sc = now.wind_sc; //风力
				var wind_dir = now.wind_dir; //风向
				//当前城市
				var current_city = basic.location;
				var e = '<ul><li class="tmp">' + weather_tmp + '&deg;' + '</li>' +
					//'<li class="currentCity">' + current_city + '</li>' +
					//'<li class="condTxt">' + weather_txt + '</li>' +
					//'<li class="windDir">' + wind_dir + '</li>' +
					//'<li class="windSc">' + wind_sc + "级" + '</li>' +
					'<li class="otherInfo">' +
					'<dl>' +
					'<dd class="currentCity">' + current_city + '</dd>' +
					'<dd class="condTxt">' + weather_txt + '</dd>' +
					'<dd class="windDir">' + wind_dir + '</dd>' +
					'<dd class="windSc">' + wind_sc + "级" + '</dd>' +
					'</dl>' +
					'</li>' +
					'</ul>' +
					'<img src="img/cond-icon-heweather/' + weather_code + '.png" />';
				$("#weather").append(e);
			},
			error: function() {
				console.log('fail');
			}
		});
	}
	//日历
	function calendar() {
		layui.use(['layer', 'form', 'jquery', 'laydate', 'util'], function() {
			var layer = layui.layer,
				$ = layui.jquery,
				laydate = layui.laydate,
				util = layui.util,
				form = layui.form;
			var data = {};
			var new_date = new Date();
			loding_date(new_date, data);
			//日历插件
			function loding_date(date_value, data) {
				laydate.render({
					elem: '#calendar',
					type: 'date',
					theme: 'grid',
					max: '2099-06-16 23:59:59',
					position: 'static',
					range: false,
					value: date_value,
					calendar: false,
					btns: false,
					ready: function(Date) {
						var monthChangeFlag = false;
						var date = util.toDateString(Date * 1000, 'yyyy-MM-dd'); //当前日期
						currentDate(date, monthChangeFlag);
						dateArr = date.split('-');
						dateArr[1] = dateArr[1].replace("0", "");
						var dateMonth = [];
						dateMonth.push(dateArr[0]);
						dateMonth.push(dateArr[1]);
						dateMonth = dateMonth.join('-'); //2018-7
						$("i.laydate-next-m,i.laydate-prev-m").unbind("click").click(function() {
							$("td.layui-this").removeClass("layui-this");//td的默认标记
							var monthTxt = $(this).parent().find(".laydate-set-ym").find("span").attr("lay-ym");
							console.log(dateMonth);
							if(monthTxt == dateMonth) {
								monthChangeFlag = false;
							} else {
								monthChangeFlag = true;
							}
							currentDate(date, monthChangeFlag);//标记当前日期
						});

					},
					done: function(value, date, endDate) {
						//console.log(value); //得到日期生成的值，如：2017-08-18
						//console.log(date); //得到日期时间对象：{year: 2017, month: 8, date: 18, hours: 0, minutes: 0, seconds: 0}
						//console.log(endDate); //得结束的日期时间对象
						if($(".layui-this").find("span.laydate-day-mark").text() !== "") {
							//修改备注
							date_chose_delete(value, data);
							$(".layui-layer-rim").removeClass("addNoteBox");
							$(".layui-layer-rim").find(".layui-layer-btn").find("a").addClass("layui-col-md4");
							$(".layui-layer-rim").find(".layui-layer-btn").find("a").addClass("layui-col-sm4");
							$(".layui-layer-rim").find(".layui-layer-btn").find("a").addClass("layui-col-xs4");
						} else {
							//添加备注
							date_chose(value, data); //添加
							$(".layui-layer-rim").addClass("addNoteBox");
							$(".layui-layer-rim").find(".layui-layer-btn").find("a").addClass("layui-col-md6");
							$(".layui-layer-rim").find(".layui-layer-btn").find("a").addClass("layui-col-sm6");
							$(".layui-layer-rim").find(".layui-layer-btn").find("a").addClass("layui-col-xs6");
						}
						//调用弹出层方法
						//date_chose(value, data);
					},
					mark: data
				});
			}
			//标记当前日期
			function currentDate(date, flag) {
				var tdBox = $(".layui-laydate-content").find("td");
				for(var i = 0; i < tdBox.length; i++) {
					var now = $(tdBox[i]).attr("lay-ymd");
					dateArr = date.split('-');
					dateArr[1] = dateArr[1].replace("0", "");
					dateArr[2] = dateArr[2].replace("0", "");
					date = dateArr.join('-');
					if($.trim($(tdBox[i]).attr("lay-ymd")) == $.trim(date)) {
						if(!flag) {
							tdBox.eq(i).attr("id", "currentDate");
						}
					} else {
						tdBox.eq(i).attr("id", "");
					}
				}
			}

			//获取隐藏的弹出层内容
			var date_choebox = $('.date_box').html();
			//添加备注
			function date_chose(obj_date, data) {
				var index = layer.open({
					type: 1,
					skin: 'layui-layer-rim calendarInfo',
					title: '添加备注',
					area: ['400px', '300px'], //宽高
					btn: ['确定', '取消'],
					content: '<div class="text_box">' +
						'<form class="layui-form" action="">' +
						'<div class="layui-form-item layui-form-text">' +
						' <textarea id="text_book_title" placeholder=""  class="layui-textarea"></textarea>' +
						' <textarea id="text_book" placeholder=""  class="layui-textarea"></textarea>' +
						'</div>' +
						'</form>' +
						'</div>',
					success: function() {
						$('#text_book_title').val(data[obj_date]);
					},
					yes: function() {
						//调用添加/编辑标注方法
						if($('#text_book_title').val() != '' || $('#text_book').val() != '') {
							chose_moban(obj_date, data);
							layer.close(index);
						} else {
							layer.msg('不能为空', {
								icon: 2
							});
						}
					},
				});
			}
			//删除备注
			function date_chose_delete(obj_date, data) {
				var index = layer.open({
					type: 1,
					skin: 'layui-layer-rim calendarInfo',
					title: '修改备注',
					area: ['400px', '300px'], //宽高
					btn: ['修改', '取消', '删除'],
					content: '<div class="text_box">' +
						'<form class="layui-form" action="">' +
						'<div class="layui-form-item layui-form-text">' +
						' <textarea id="text_book_title" placeholder=""  class="layui-textarea"></textarea>' +
						' <textarea id="text_book" placeholder=""  class="layui-textarea"></textarea>' +
						'</div>' +
						'</form>' +
						'</div>',
					success: function() {
						$('#text_book_title').val(data[obj_date])
					},
					yes: function() {
						if($('#text_book').val() != '') {
							chose_moban(obj_date, data);
							layer.close(index);
						} else {
							layer.msg('不能为空', {
								icon: 2
							});
						}

					},
					btn3: function() {
						chexiao(obj_date, data);
					},
				});
			}
			//定义添加/编辑标注方法
			function chose_moban(obj_date, markJson) {
				//获取弹出层val
				var chose_moban_val = $('#text_book_title').val();
				$('#calendar').html('');
				//添加属性 
				markJson[obj_date] = chose_moban_val;
				//再次调用日历控件，
				loding_date(obj_date, markJson);

			}
			//撤销选择
			function chexiao(obj_date, markJson) {
				delete markJson[obj_date];
				console.log(JSON.stringify(markJson));
				$('#calendar').html('');
				loding_date(obj_date, markJson);

			}
		});
	}
	//待处理事项
	function pendingMatters() {
		$(".homePage").find(".otherUserInfo.pendingItem").find("a.addNewItem").on("click", function() {
//			addNewMatters();
			var l=$(".homePage").find(".otherUserInfo.pendingItem").find("ul").find("li").length;
			var l=l+1;
				if(l>=1&&l<=5){
					$(".homePage").find(".otherUserInfo.pendingItem").find("ul").css({
					"overflow-y":"hidden",
					"height":"auto"
					});
					addNewMatters();
				}
				else if(l>5&&l<=10){
					$(".homePage").find(".otherUserInfo.pendingItem").find("ul").css({
					"overflow-y":"scroll",
					"height":"246px"
					});
					addNewMatters();
				}
				else if(l>10){
					layer.msg('默认只可添加10条处理事项',{
					icon:0,
					time:1000
					})
				}
		});
	}
	//添加处理事项
	function addNewMatters() {
		layer.open({
			type: 1,
			title: '添加事项',
			skin: 'layui-layer-rim newMatters',
			area: ['400px', '300px'], //宽高
			btn: ['添加', '取消'],
			content: '<div class="text_box">' +
				'<form class="layui-form" action="">' +
				'<div class="layui-form-item layui-form-text">' +
				' <textarea id="text_book_title" placeholder=""  class="layui-textarea"></textarea>' +
				' <textarea id="text_book" placeholder=""  class="layui-textarea"></textarea>' +
				'</div>' +
				'</form>' +
				'</div>',
			yes: function(index) {
				var matterTxt =$.trim($(".newMatters").find("#text_book_title").val());
				var e='<li>'+
				'<a href="javascript:void(0);">'+
					'<i></i><span>'+matterTxt+
				'</span></a>'+
				'</li>';
				layer.msg('添加成功',{
					icon:1,
					time:1000
				})
				$(".homePage").find(".otherUserInfo.pendingItem").find("ul").append(e);
				layer.close(index);
				amendMatter();
			}
		});
		$(".layui-layer-rim").find(".layui-layer-btn").find("a").addClass("layui-col-md6");
		$(".layui-layer-rim").find(".layui-layer-btn").find("a").addClass("layui-col-sm6");
		$(".layui-layer-rim").find(".layui-layer-btn").find("a").addClass("layui-col-xs6");
		$(".layui-layer-btn.layui-layer-btn-").css("margin-top", "2px");

	}
	//修改已添加的事项
	function amendMatter() {
		$(".homePage").find(".otherUserInfo.pendingItem").find("ul").find("li").unbind("click").on("click", function() {
			var thisLi=$(this);
			var thisMatter=thisLi.find('span').text();
			layer.open({
				type: 1,
				skin: 'layui-layer-rim amendMatters',
				title: '修改事项',
				area: ['400px', '300px'],
				btn: ['修改', '取消'],
				content: '<div class="text_box">' +
					'<form class="layui-form" action="">' +
					'<div class="layui-form-item layui-form-text">' +
					' <textarea id="text_book_title" placeholder=""  class="layui-textarea">'+ thisMatter + '</textarea>' +
					' <textarea id="text_book" placeholder=""  class="layui-textarea"></textarea>' +
					'</div>' +
					'</form>' +
					'</div>',
				yes: function(index) {
					//修改
					var matterTxt = $(".amendMatters").find("#text_book_title").val();
					thisLi.find('span').text(matterTxt);
					thisMatter=matterTxt;//文本域
					layer.msg('修改成功', {
						icon: 1,
						time: 1000
					});
					layer.close(index);
				}
			});
			$(".layui-layer-rim").find(".layui-layer-btn").find("a").addClass("layui-col-md6");
			$(".layui-layer-rim").find(".layui-layer-btn").find("a").addClass("layui-col-sm6");
			$(".layui-layer-rim").find(".layui-layer-btn").find("a").addClass("layui-col-xs6");
			$(".layui-layer-btn.layui-layer-btn-").css("margin-top", "2px");

		});
	}

	//相关提醒
	function infoTips() {
		$(".otherUserInfo.noticeInfo").find("ul").find("li").on("click", function() {
			var index = $(this).index();
			var titleInfo = $(this).find("a").find("label").text();
			titleInfo = titleInfo.replace("[", "");
			titleInfo = titleInfo.replace("]", "");
			titleInfo = $.trim(titleInfo);
			var notice = index + '_信息信息信息信息信息信息信息信息信息信息信息信息信息信息信息信息信息信息信息';
			layer.open({
				type: 1,
				skin: 'layui-layer-rim infoTips',
				title: titleInfo,
				area: ['252px', '224px'],
				btn: ['确定'],
				content: '<div class="text_box">' +
					'<form class="layui-form" action="">' +
					'<div class="layui-form-item layui-form-text">' +
					' <p>' + titleInfo + '信息' + notice + '</p>' +
					'</div>' +
					'</form>' +
					'</div>',
			});

		});

	}