'use strict';

var $ = require('jquery');

//建立一个取到上传文件url的方法
function getObjectURL(file) {
    var url = null;
    if (window.createObjectURL != undefined) { // basic
        url = window.createObjectURL(file);
    } else if (window.URL != undefined) { // mozilla(firefox)
        url = window.URL.createObjectURL(file);
    } else if (window.webkitURL != undefined) { // webkit or chrome
        url = window.webkitURL.createObjectURL(file);
    }
    return url;
}
//将取得的url传入html代码中的img的src中，实现图片上传预览。此段在图片添加起作用
$(function () {
    $("#image-upload").change(function () {
        var objUrl = getObjectURL(this.files[0]);
        console.log("objUrl = " + objUrl);
        if (objUrl) {
            $("#img").attr("src", objUrl);
        }
    });
});

//将取得的url传入html代码中的img的src中，实现图片上传预览。此段在广告添加起作用
$(function () {
    $("#ad-slide-cover").change(function () {
        var objUrl = getObjectURL(this.files[0]);
        console.log("objUrl = " + objUrl);
        if (objUrl) {
            $("#ad-slide-cover-img").attr("src", objUrl);
        }
    });
});

//将取得的url传入html代码中的img的src中，实现图片上传预览。此段在页面添加起作用
$(function () {
    $("#page-cover").change(function () {
        var objUrl = getObjectURL(this.files[0]);
        console.log("objUrl = " + objUrl);
        if (objUrl) {
            $("#page-img").attr("src", objUrl);
        }
    });
});

//将取得的url传入html代码中的img的src中，实现图片上传预览。此段在友情链接添加起作用
$(function () {
    $("#links-icon").change(function () {
        var objUrl = getObjectURL(this.files[0]);
        console.log("objUrl = " + objUrl);
        if (objUrl) {
            $("#links-img").attr("src", objUrl);
        }
    });
});
//delele页面中全选按钮事件
$("#allcheck").on('click',function(){
    $("input[name='item']").prop('checked',true);
});
//delele页面中全不选按钮事件
$("#notallcheck").on('click',function(){
    $("input[name='item']").prop('checked',false);
});

//广告添加页面的滚动按钮
$('#doc-scroll-to-btm').on('click', function() {
    var $w = $(window);
    $w.smoothScroll({position: $(document).height() - $w.height()});
});

//新建图片文件夹
$("#img-cate-cancer").on('click',function(){
$("img-cate-name").html("");
});
$("#img-cate-confirem").on('click',function(){
    $.post({

    });
});

//全选处删除
$('#delete-btn').click(function(){
    var checkedNum = $("input[name='item']:checked").length;
    if(checkedNum == 0){
        alert('请至少选择一项！');
        return;
    }
    if(confirm("确定删除所选项目？")){
        var  checkedList = new Array();
        $("input[name='item']:checked").each(function(){
            checkedList.push($(this).val());
            $("#delete-list").html(checkedList);
        });

    }
});

//列表中的icon-trash删除事件处理程序
$('.am-btn-group-xs').children("a:has('.am-icon-trash')").click(function(){
    if(confirm('是否确定删除此项？')){
        $(this).parent().parent().parent('tr').remove();
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
$("#pwd-reset").click(function(){
    $(".admin-info").hide();
    $("#pwd-reset-form").show();
});


//admin信息 input text类型修改页面
$(".admin-info-edit").click(function(){
    var inputObj=$(this).prev()
    inputObj.removeAttr("disabled");
    inputObj.select();
    inputObj.removeClass("remove-input");
    inputObj.blur(function(){
        inputObj.addClass("remove-input");
        /*ajax代码*/
        inputObj.attr("disabled","disabled");
    });
});
//admin信息性别类型修改页面
$(".admin-info-sex-edit").click(function(){
    $(".sex-choice").toggle();
    $(".sex-choice li").click(function(){
        /*ajax代码*/
        var lisText=$(this).children('label').html();
        $("#admin-sex").html(lisText);
        $(".sex-choice").hide();
    });

});
//为溢出隐藏添加点击展开事件
$('.am-table td').each(function(){
   $(this).click(function(){
       if($(this).css('white-space')=='nowrap'){
           $(this).css({'white-space':'normal'});
       }else{
           $(this).css({'white-space':'nowrap'});
       }
   });
});