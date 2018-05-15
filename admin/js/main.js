var lastView = "Views/_Terrenos.html";
var backbuttonView = lastView;
var loadingView = $("#loadingView").html();
var tmpError500 = $("#tmp-error500").html();
var tmpOptions = $("#tmp-options").html();
$(function() {
    $("#btnTerrenos").on("click", function() {
        $("#renderBody").handlebars(loadingView);
        getTerrenos();
    });
    $("#btnAsesores").on("click", function() {
        getAsesores();
    });

    $(document).on("click", ".asyncView", function(e) {
        e.preventDefault();
        var view = $(this).data("href");
        partialView(view);
    });

    $(document).on("click", ".lastView", function() {
        partialView(backbuttonView);
    });
});

function partialView(view, data) {
    var Deferred = $.Deferred();
    $("#renderBody").handlebars(loadingView);
    $.get(view, data).then(function(tmp) {
        if (tmp) {
            $("#renderBody").handlebars(tmp, data);
            updateViews(view);
            $.material.init();
            Deferred.resolve(tmp);
        } else {
            partialView("Views/_Terrenos.html");
            Deferred.fail(tmp);
        }
    }, error500);
    return Deferred.promise();
}

function updateViews(view) {
    backbuttonView = lastView;
    lastView = view;
}

function error500() {
    $("#renderBody").handlebars(tmpError500);
}

function getTerrenos() {
    var Deferred = $.Deferred();
    var view = "Views/_Terrenos.html";
    $.ajax({
            url: 'Controllers/TerrenosController.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: "getTerrenos"
            },
        })
        .done(function(terrenos) {
            partialView(view, terrenos).then(function() {
                $("#tableTerrenos").bootstrapTable({
                    data: terrenos
                });
            });
            Deferred.resolve(terrenos);
        })
        .fail(function(err) {
            console.log("error");
            Deferred.fail(err);
        });
    return Deferred.promise();
}

function getAsesores() {
    var Deferred = $.Deferred();
    var view = "Views/_Asesores.html";
    $.ajax({
            url: 'Controllers/AsesoresController.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: "getAsesores"
            },
        })
        .done(function(asesores) {
            partialView(view, asesores).then(function() {
                $("#tableAsesores").bootstrapTable({
                    data: asesores
                });
            });
            Deferred.resolve(asesores);
        })
        .fail(function(err) {
            console.log("error");
            Deferred.fail(err);
        });
    return Deferred.promise();
}

function setBootstrapTable(table) {
    var Deferred = $.Deferred();
    $(table).bootstrapTable({
        pagination: true,
        search: true
    });
    return Deferred.promise();
}

function combo(url, data, select) {
    $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: data,
        })
        .done(function(r) {
            var options = [$("<option>", {
                value: "",
                text: data.vcText,
                selected: true
            })];
            $.each(r, function(i, t) {
                var k = Object.keys(t);
                var regex = /\w+(Id|id)$/g;
                var val, txt;
                if (regex.test(k[0])) {
                    val = t[k[0]];
                    txt = t[k[1]];
                } else {
                    val = t[k[1]];
                    txt = t[k[0]];
                }
                options.push($("<option>", {
                    value: val,
                    text: txt
                }));
            });
            $(select).html(options);
        })
        .fail(function(err) {
            console.error("error", err);
        });
}

if (!String.prototype.format) {
    String.prototype.format = function() {
        var args = arguments;
        return this.replace(/{(\d+)}/g, function(match, number) {
            return typeof args[number] != 'undefined' ? args[number] : match;
        });
    };
}
if (!String.prototype.trim) {
    String.prototype.trim = function() {
        return this.replace(/^\s+|\s+$/g, '');
    };
}

function formatActivo(text) {
    return (+text === 1) ? "Si" : "No";
}

function formatMoney(text) {
    return "$" + Number(text).formatMoney();
}
Number.prototype.formatMoney = function(c, d, t) {
    var n = this,
        c = isNaN(c = Math.abs(c)) ? 2 : c,
        d = d == undefined ? "." : d,
        t = t == undefined ? "," : t,
        s = n < 0 ? "-" : "",
        i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
        j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};
$.fn.serializeObject = function() {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};
