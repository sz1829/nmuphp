$(document).ready(function () {
    function loadDepartment() {
        var url = location.protocol.concat("//").concat(location.host).concat('/database/Other/OtherManagement.php');
        $.ajax({
            url: url,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            type: 'GET',
            data: {
                action: 'getDepartment'
            },
            success: function(response) {
                $("li.departmentInfo").remove();
                response = JSON.parse(response);
                for (var i = 0; i < response.length; i++) {
                    $html = `
                        <li class="departmentInfo">
                            <dl>
                                <dd class="divisionName">` + response[i]['department_name'] + `</dd>
                                <dd class="divisionDetail">` + response[i]['description'] + `</dd>
                            </dl>
                        </li>
                    `;
                    $("div.divisionCard").find("ul.divisionMsg").append($html);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }

    loadDepartment();

    $("#add-department-confirm").on('click', function () {
        var department_name = $("#department-name").val().trim();
        var description = $("#department-detail").val().trim();
        if (department_name == "") {
            return;
        }

        var url = location.protocol.concat("//").concat(location.host).concat('/database/Other/OtherManagement.php');
        $.ajax({
            url: url,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            type: 'POST',
            data: {
                action: 'addDepartment',
                department_name: department_name,
                description: description
            },
            success: function(response) {
                loadDepartment();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });

    $("#add-department-reset").on('click', function () {
        $("#department-name").val("");
        $("#department-detail").val("");
    });



    $(".manageCard.exchangeRateCard").find(".manegeDetailInfo").find("input[type='text']").on("focus",function(){
		$(".manageCard.exchangeRateCard").find("ul").find("li").find("a.confirmAmend").addClass("selected");
	});

    function loadExchangeRate() {
        var url = location.protocol.concat("//").concat(location.host).concat('/database/Other/OtherManagement.php');
        $.ajax({
            url: url,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            type: 'GET',
            data: {
                action: 'getExchangeRate'
            },
            success: function(response) {
                $("#exchange-rate").val(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }

    loadExchangeRate();

    $("#update-exchange-rate-confirm").on('click', function () {
        var url = location.protocol.concat("//").concat(location.host).concat('/database/Other/OtherManagement.php');
        $.ajax({
            url: url,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            type: 'POST',
            data: {
                action: 'updateExchangeRate',
                exchange_rate: $("#exchange-rate").val()
            },
            success: function(response) {
                $("#update-exchange-rate-confirm").removeClass("selected");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });

    $("#reset-exchange-rate").on('click', function () {
        loadExchangeRate();
    });



    function loadCustomerSource() {
        $("#customer-source-list").empty();
        var url = location.protocol.concat("//").concat(location.host).concat('/database/Other/OtherManagement.php');
        $.ajax({
            url: url,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            type: 'GET',
            data: {
                action: 'getCustomerSource'
            },
            success: function(response) {
                response = JSON.parse(response);
                for (var i = 0; i < response.length; i++) {
                    $("#customer-source-list").append(`<dd>` + response[i]['source_name'] + `</dd>`);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }

    loadCustomerSource();

    $("#customer-source-confirm").on('click', function () {
        if ($("#customer-source-name").val() == "") {
            return;
        }
        var url = location.protocol.concat("//").concat(location.host).concat('/database/Other/OtherManagement.php');
        $.ajax({
            url: url,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            type: 'POST',
            data: {
                action: 'addCustomerSource',
                source_name: $("#customer-source-name").val()
            },
            success: function(response) {
                loadCustomerSource();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });

    $("#delete-customer-source").on('click', function () {
        var data = {
            action: 'deleteCustomerSource'
        }
        var list = [];
        for (var i = 0; i < $("dd.selected").length; i++) {
            list.push($("dd.selected").eq(i).html());
        }
        Object.assign(data, {
            list: JSON.stringify(list)
        });


        var url = location.protocol.concat("//").concat(location.host).concat('/database/Other/OtherManagement.php');
        $.ajax({
            url: url,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            type: 'POST',
            data: data,
            success: function(response) {
                loadCustomerSource();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
});
