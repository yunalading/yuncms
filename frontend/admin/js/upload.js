'use strict';
var $ = require('jquery');

//使用amazeui来做类型validator
(function($) {
    if ($.AMUI && $.AMUI.validator) {
        // 增加多个正则
        $.AMUI.validator.patterns = $.extend($.AMUI.validator.patterns, {
            colorHex: /^(#([a-fA-F0-9]{6}|[a-fA-F0-9]{3}))?$/,
            latter:/^[A-Za-z0-9]+$/
        });
        // 增加单个正则
        $.AMUI.validator.patterns.yourpattern = /^your$/;
    }
})(window.jQuery);


//建立一个取到上传文件url的方法
function getObjectURL(file) {
    var url = null;
    if (window.createObjectURL !== undefined) { // basic
        url = window.createObjectURL(file);
    } else if (window.URL !== undefined) { // mozilla(firefox)
        url = window.URL.createObjectURL(file);
    } else if (window.webkitURL !== undefined) { // webkit or chrome
        url = window.webkitURL.createObjectURL(file);
    }
    return url;
}
//将取得的url传入html代码中的img的src中，实现图片上传预览。此段在图片添加起作用
$(function () {
    $("#image-upload").change(function () {
        var objUrl = getObjectURL(this.files[0]);
        if (objUrl) {
            $("#img").attr("src", objUrl);
        }
    });
});

//将取得的url传入html代码中的img的src中，实现图片上传预览。此段在广告添加起作用
$(function () {
    $("#ad-slide-cover").change(function () {
        var objUrl = getObjectURL(this.files[0]);
        if (objUrl) {
            $("#ad-slide-cover-img").attr("src", objUrl);
        }
    });
});

//将取得的url传入html代码中的img的src中，实现图片上传预览。此段在页面添加起作用
$(function () {
    $("#page-cover").change(function () {
        var objUrl = getObjectURL(this.files[0]);
        if (objUrl) {
            $("#page-img").attr("src", objUrl);
        }
    });
});

//将取得的url传入html代码中的img的src中，实现图片上传预览。此段在友情链接添加起作用
$(function () {
    $("#links-icon").change(function () {
        var objUrl = getObjectURL(this.files[0]);
        if (objUrl) {
            $("#links-img").attr("src", objUrl);
        }
    });
});
//将取得的url传入html代码中的img的src中，实现图片上传预览。此段在内容添加页面添加起作用
$(function () {
    $("#content-cover").change(function () {
        var objUrl = getObjectURL(this.files[0]);
        if (objUrl) {
            $("#content-img").attr("src", objUrl);
        }
    });
});
//如果img标签的src为空，此img就不显示

//delele页面中全选按钮事件
$("#allcheck").on('click', function () {
    $("input[name='item']").prop('checked', true);
});
//delele页面中全不选按钮事件
$("#notallcheck").on('click', function () {
    $("input[name='item']").prop('checked', false);
});

//广告添加页面的滚动按钮
$('#doc-scroll-to-btm').on('click', function () {
    var $w = $(window);
    $w.smoothScroll({position: $(document).height() - $w.height()});
});

//新建图片文件夹
$("#img-cate-cancer").on('click', function () {
    $("img-cate-name").html("");
});
$("#img-cate-confirem").on('click', function () {
    $.post({});
});

//全选处删除
$('#delete-btn').click(function () {
    var checkedNum = $("input[name='item']:checked").length;
    if (checkedNum == 0) {
        alert('请至少选择一项！');
        return;
    }
    if (confirm("确定删除所选项目？")) {

        $("input[name='item']:checked").each(function () {
            $(this).parent().parent().parent().remove();
        });

    }
});

//列表中的icon-trash删除事件处理程序
$('.am-btn-group-xs').children("a:has('.am-icon-trash')").click(function () {
    if (confirm('是否确定删除此项？')) {
        $(this).parent().parent().parent('tr').remove();

    } else {
        return false;
    }

});
//列表中给icon-edit添加编辑事件，让所有td处于可编辑状态
// $('.am-btn-group-xs').children("a:has('.am-icon-edit')").click(function(){
//    $(this).parent().parent('td').prevAll().each(function(){
//        var txt=[];
//        txt.append($(this).text());
//        $(this).append("tex[0]");
//    });
//
// });

//密码重置页面交互
$("#pwd-reset").click(function () {
    $(".admin-info").hide();
    $("#pwd-reset-form").show();
});


//admin信息 input text类型修改页面
$(".admin-info-edit").click(function () {
    var inputObj = $(this).prev()
    inputObj.removeAttr("disabled");
    inputObj.select();
    inputObj.removeClass("remove-input");
    inputObj.blur(function () {
        inputObj.addClass("remove-input");
        /*ajax代码*/
        inputObj.attr("disabled", "disabled");
    });
});
//admin信息性别类型修改页面
$(".admin-info-sex-edit").click(function () {
    $(".sex-choice").toggle();
    $(".sex-choice li").click(function () {
        /*ajax代码*/
        var lisText = $(this).children('label').html();
        $("#admin-sex").html(lisText);
        $(".sex-choice").hide();
    });
});
//为溢出隐藏添加点击展开事件
$('.am-table td').each(function () {
    $(this).click(function () {
        var $width = ($(this).css('width'));
        if ($(this).css('white-space') === 'nowrap') {
            $(this).css({'width': $width, 'white-space': 'normal', 'word-break': 'break-all'});
        } else {
            $(this).css({'white-space': 'nowrap'});
        }

    });
});

//短信配置选择服务商显示对应页面
$(function () {
    $('#msgserver-brand').change(function () {
        $('.msg-settings').css('display', 'none');
        if ($(this).find("option:selected").val() === 'msgserver-ali') {
            $('.msg-settings-ali').css('display', 'block');
        } else if ($(this).find("option:selected").val() === 'msgserver-yunxin') {
            $('.msg-settings-yunxin').css('display', 'block');
        }
    });
});
//模型添加页面相关事件
$('.model-table-button').click(function () {
    $(".model-table-add").slideToggle("slow");
});

//模型添加页面字段删除事件处理程序
$('.model-field-del').click(function () {

    var remove=$(this).parent().parent();
    $('#my-confirm').modal({
        relatedTarget: this,
        onConfirm: function(options) {
            remove.remove();
            $('#model-submit').click();

        },
        // closeOnConfirm: false,
        onCancel: function() {
            return false;
        }
    });
});
//模型添加页面根据select选择项切换对应页面显示
$('.model-field-type').change(function () {
    var host = window.location.host;
    var key = $(this).val();
    $.get('http://' + host + $(this).data('url'), function (data) {
        var Obj = JSON.parse(data);
        var mtype = 'model-field-type-' + Obj[key];
        $('.model-file').css('display', 'none');
        $('.' + mtype).css('display', 'block');
    }, 'json');
});
$(function () {
    if ($('.model-field-type').val()) {
        var hosts = window.location.host;
        var val = $('.model-field-type').val();
        $.get('http://' + hosts + $('.model-field-type').data('url'), function (data) {
            var Obj = JSON.parse(data);
            var mtype = 'model-field-type-' + Obj[val];
            $('.model-file').css('display', 'none');
            $('.' + mtype).css('display', 'block');
        }, 'json');
    }
});
//模型添加页面字段子表格删除
$('.model-remove').on('click', function () {
    var remove=$(this).parent().parent();
    $('#my-confirm').modal({
        relatedTarget: this,
        onConfirm: function(options) {
            remove.remove();
        },
        // closeOnConfirm: false,
        onCancel: function() {
            return false;
        }
    });
    /*    if (confirm('是否确定删除此项')) {
     $(this).parent().parent().remove();
     } else {
     return false;
     }*/
});

$(function () {
    var selectsnum = 0;
    var radiosnum = 0;
    var checkboxsnum = 0;
    var selects = $('.model-field-type-select').children('table').html();
    var radios = $('.model-field-type-radio').children('table').html();
    var checkboxs = $('.model-field-type-checkbox').children('table').html();
    //点击修改按钮触发ajax请求，显示页面数据。
    $('.model-field-mod').click(function () {

        var type = $(this).data('type');
        var mtype = 'model-field-type-' + type;
        var id = $(this).data('id');
        var attr_id = $(this).data('attr-id');
        var url = $(this).data('url');
        var tips = 'model-field-' + type + '-tips';
        var name = 'model-field-' + type + '-name';
        $('#attr_id').val(attr_id);

        $.post(url,
            {
                id: id,
                attr_id: attr_id
            },
            function(data){
                var Obj = JSON.parse(data);
                var arr = JSON.parse(Obj['attr']);
                var pro_name = Obj['pro_name'];
                var pro_key = Obj['pro_key'];
                var pro_cate = Obj['pro_cate'];
                $('.model-table-add').css('display', 'block');
                $('.model-file').css('display', 'none');
                $('.' + mtype).css('display', 'block');

                //以下隐藏代码因为框架的问题会有bug
                $('.model-field-type').find('option').eq(pro_cate).attr('selected', true);
                /*$('.model-field-type').trigger('changed.selected.amui');*/

                $('.model-field-type').val(pro_cate);
          /*      alert(pro_cate+'s');
                alert($('.model-field-type').val());*/
                $('#' + tips).val(pro_name);
                $('#' + name).val(pro_key);

                if (arr.length > 0) {
                    //如果类型为select，根据数据读出来的字段项，新增字段的时候需要也是select类型
                    if (type === 'select') {
                        var select= $('.' + mtype).children('table');
                        select.html(selects);
                        for (var i = 0; i < arr.length; i++) {
                            selectsnum++;
                            var keys = 'select-key[' + selectsnum + ']';
                            var vals = 'select-value[' + selectsnum + ']';
                            select.append("<tr><td><input type='text' value=" + arr[i][0] + " name=" + keys + " ></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type='text' class='js-pattern-latter' placeholder='请使用英文字符开头，可以带数字' value=" + arr[i][1] + " name=" + vals + "></td><td><a  class='model-remove' >删除</a></td></tr>");
                            (function($) {
                                if ($.AMUI && $.AMUI.validator) {
                                    // 增加多个正则
                                    $.AMUI.validator.patterns = $.extend($.AMUI.validator.patterns, {
                                        colorHex: /^(#([a-fA-F0-9]{6}|[a-fA-F0-9]{3}))?$/,
                                        latter:/^[A-Za-z0-9]+$/
                                    });
                                    // 增加单个正则
                                    $.AMUI.validator.patterns.yourpattern = /^your$/;
                                }
                            })(window.jQuery);

                            select.off('click', '**').on('click', '.model-remove', function () {

                                var removes=$(this).parent().parent();
                                alert(removes.html());
                                $('#my-confirm').modal({
                                    relatedTarget: this,
                                    onConfirm: function(options) {
                                        alert(removes.html());
                                        removes.remove();
                                    },
                                    // closeOnConfirm: false,
                                    onCancel: function() {
                                        return false;
                                    }
                                });
                            });
                        }

                    }
                    //如果类型为radio，根据数据读出来的字段项，新增字段的时候需要也是radio类型
                    else if (type === 'radio') {
                        var radio = $('.' + mtype).children('table');
                        radio.html(radios);
                        for (var j = 0; j < arr.length; j++) {
                            radiosnum++;
                            var keyr = 'radio-key[' + radiosnum + ']';
                            var valr = 'radio-value[' + radiosnum + ']';
                            radio.append("<tr> <td></td><td><input type='text'  value=" + arr[j][0] + " name=" + keyr + "></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type='text' class='js-pattern-latter' placeholder='请使用英文字符开头，可以带数字' value=" + arr[j][1] + " name=" + valr + "></td><td><a  class='model-remove' >删除</a></td></tr>");
                            radio.off('click', '**').on('click', '.model-remove', function () {
                                if (confirm('是否确定删除此项')) {
                                    $(this).parent().parent().remove();
                                } else {
                                    return false;
                                }
                            });
                        }
                    }
                    //如果类型为checkbox，根据数据读出来的字段项，新增字段的时候需要也是checkbox类型
                    else if (type === 'checkbox') {
                        var checkbox = $('.' + mtype).children('table');
                        checkbox.html(checkboxs);
                        for (var k = 0; k < arr.length; k++) {
                            checkboxsnum++;
                            var keyc = 'checkbox-key[' + checkboxsnum + ']';
                            var valc = 'checkbox-value[' + checkboxsnum + ']';
                            checkbox.append("<tr> <td></td><td><input type='text' value=" + arr[k][0] + "  name=" + keyc + "></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type='text'  class='js-pattern-latter' placeholder='请使用英文字符开头，可以带数字' value=" + arr[k][1] + " name=" + valc + "></td><td><a  class='model-remove' >删除</a></td></tr>");
                            checkbox.off('click', '**').on('click', '.model-remove', function () {
                                if (confirm('是否确定删除此项')) {
                                    $(this).parent().parent().remove();
                                } else {
                                    return false;
                                }
                            });
                        }

                    }
                }

            } );
    });

    $('.model-add').on('click', function () {
        if ($(this).parent().hasClass('model-field-type-select')) {
            var $selectTable = $(this).parent().children('table');
            selectsnum++;
            alert(selectsnum);
            var keys = 'select-key[' + selectsnum + ']';
            var vals = 'select-value[' + selectsnum + ']';
            $selectTable.append("<tr><td><input type='text' name=" + keys + "></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type='text' class='js-pattern-latter' placeholder='请使用英文字符开头，可以带数字' name=" + vals + "></td><td><a  class='model-remove' >删除</a></td></tr>");
            $selectTable.off('click', '**').on('click', '.model-remove', function () {

                $('#my-confirm').modal({
                    relatedTarget: this,
                    onConfirm: function(options) {
                        var $link = $(this.relatedTarget).prev('a');
                        var msg = $link.length ? '你要删除的链接 ID 为 ' + $link.data('id') :
                            '确定了，但不知道要整哪样';
                        alert(msg);
                    },
                    // closeOnConfirm: false,
                    onCancel: function() {
                        alert('算求，不弄了');
                    }
                });
            });

        }
        else if ($(this).parent().hasClass('model-field-type-radio')) {
            var $radioTable = $(this).parent().children('table');
            radiosnum++;
            var keyr = 'radio-key[' + radiosnum + ']';
            var valr = 'radio-value[' + radiosnum + ']';
            $radioTable.append("<tr> <td><td><input type='text'  name=" + keyr + "></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type='text' class='js-pattern-latter' placeholder='请使用英文字符开头，可以带数字' name=" + valr + "></td><td><a  class='model-remove' >删除</a></td></tr>");
            $radioTable.off('click', '**').on('click', '.model-remove', function () {
                if (confirm('是否确定删除此项')) {
                    $(this).parent().parent().remove();
                } else {
                    return false;
                }
            });

        }
        else if ($(this).parent().hasClass('model-field-type-checkbox')) {
            var $checkboxTable = $(this).parent().children('table');
            checkboxsnum++;
            var keyc = 'checkbox-key[' + checkboxsnum + ']';
            var valc = 'checkbox-value[' + checkboxsnum + ']';
            $checkboxTable.append("<tr> <td></td><td><input type='text'  name=" + keyc + "></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type='text' class='js-pattern-latter' placeholder='请使用英文字符开头，可以带数字' name=" + valc + "></td><td><a  class='model-remove' >删除</a></td></tr>");
            $checkboxTable.off('click', '**').on('click', '.model-remove', function () {
                if (confirm('是否确定删除此项')) {
                    $(this).parent().parent().remove();
                } else {
                    return false;
                }
            });

        }
    });



});
//模型页面修改按钮事件
//初始化jquery 多文件插件
$(function () {
    $('#event').AmazeuiUpload({url: '/static/lib/docs/demo.json'});

});

//maxFiles: 50, // 单次上传的数量
// maxFileSize: 10, // 单个文件允许的大小
// (M) multiThreading: false, // true为同时上传false为队列上传
// useDefTemplate: true, //是否使用表格模式 dropType: false,
// 是否允许拖拽 pasteType: false //是否允许粘贴 });
// upload.init(); //对象初始化 upload.destory();
// 对象销毁 upload.setResult(); //置入已上传的对象
// upload.selectResult(); //获取当前已经完成上传的对象


//upload上传select与选项卡联动
$('.upload-option').change(function () {
    var ttype = '.am-tab-' + $(this).val();
    $('.am-tabs-nav').find('li').removeClass('am-active');
    $('.am-tab-panel').removeClass('am-active');
    $(ttype).addClass('am-active');
});
$(function () {
    $('.am-tabs-nav').find('li').click(function () {
        var indexs = $(this).index();
        $('.upload-option').find('option').each(function () {
            $(this).attr('selected', false);
        });
        $('.upload-option').find('option').eq(indexs).attr('selected', true);
        $('.upload-option').trigger('changed.selected.amui');
    });
});

//upload上传页面复选框存值到input
$(function () {
    function jqchk() { //jquery获取复选框值
        var chk_value = [];
        $('input[name="allowExts"]:checked').each(function () {
            chk_value.push($(this).val());
        });
        $('.checkbox-value-container').val(chk_value);
    }

    $('input[name="allowExts"]').click(function () {
        jqchk();
    });
});

