'use strict';
var $ = require('jquery');

//建立一个取到上传文件url的方法
function getObjectURL(file) {
    var url = null;
    if (window.createObjectURL !==undefined) { // basic
        url = window.createObjectURL(file);
    } else if (window.URL !==undefined) { // mozilla(firefox)
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
//将取得的url传入html代码中的img的src中，实现图片上传预览。此段在内容添加页面添加起作用
$(function () {
    $("#content-cover").change(function () {
        var objUrl = getObjectURL(this.files[0]);
        console.log("objUrl = " + objUrl);
        if (objUrl) {
            $("#content-img").attr("src", objUrl);
        }
    });
});
//如果img标签的src为空，此img就不显示

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

        $("input[name='item']:checked").each(function(){
         $(this).parent().parent().parent().remove();
        });

    }
});

//列表中的icon-trash删除事件处理程序
$('.am-btn-group-xs').children("a:has('.am-icon-trash')").click(function(){
    if(confirm('是否确定删除此项？')){
        $(this).parent().parent().parent('tr').remove();

    } else{
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
      var $width=($(this).css('width'));

           if ($(this).css('white-space') === 'nowrap') {
               $(this).css({'width':$width,'white-space': 'normal', 'word-break': 'break-all'});
           } else {
               $(this).css({'white-space': 'nowrap'});
           }

   });
});
//上传设置里验证信息自定义

//   利用cookie给文章编辑器传值
/*$('.content-md-edit').click(function(){
    var tds= $(this).parent().parent().parent().parent().children();
   var title=tds.eq(2).text();
   var intro=tds.eq(3).text();
   var content=tds.eq(4).text();
   var ckey='title,intro,comment';
   document.cookie= ckey+"="+title+","+intro+","+content;


});*/
//短信配置选择服务商显示对应页面
$(function(){
    $('#msgserver-brand').change(function(){
    $('.msg-settings').css('display','none');
    if($(this).find("option:selected").val()==='msgserver-ali'){
        $('.msg-settings-ali').css('display','block');
    }else if($(this).find("option:selected").val()==='msgserver-yunxin'){
        $('.msg-settings-yunxin').css('display','block');
    }
});
});
//模型添加页面相关事件
$('.model-table-button').click(function(){
    $(".model-table-add").slideToggle("slow");
});

//模型添加页面字段删除事件处理程序
$('.model-field-del').click(function(){
    if(confirm('是否确定删除此项？')){
        $(this).parent().parent().remove();
    }else{
        return false;
    }
});
//模型添加页面根据select选择项切换对应页面显示
$('.model-field-type').change(function(){
    var host = window.location.host;
    var key=$(this).val();
$.get('http://'+host+$(this).data('url'),function(data){
    var Obj=JSON.parse(data);
    var mtype='model-field-type-'+Obj[key];
    if(key==='1'||key==='2'||key==='3'){
        $('.model-file').css('display','none');
        $('.model-fielf-type-default').css('display','block');
    }else{
        $('.model-file').css('display','none');
        $('.'+mtype).css('display','block');
    }
},'json');
});

$(function(){
    if($('.model-table-add').css('display')==='block'){
        var hosts = window.location.host;
        var val=$('.model-field-type').val();
        $.get('http://'+hosts+$(this).data('url'),function(data){
            var Obj=JSON.parse(data);
            var mtype='model-field-type-'+Obj[val];
            if(val==='1'||val==='2'||val==='3'){
                $('.model-file').css('display','none');
                $('.model-fielf-type-default').css('display','block');
            }else{
                $('.model-file').css('display','none');
                $('.'+mtype).css('display','block');
            }
        },'json');
    }
});
//模型添加页面字段子表格删除
$('.model-remove').on('click',function(){
    if(confirm('是否确定删除此项')){
        $(this).parent().parent().remove();
    }else{
        return false;
    }
});
//模型添加页面字段子表格增加
$('.model-add').on('click', function  (){
    if($(this).parent().hasClass('model-field-type-select')){
        var $selectTable=$(this).parent().children('table');
        $selectTable.append("<tr><td><input type='text'></td><td>----</td><td><input type='text'</td><td><a  class='model-remove' >删除</a></td></tr>");
        $selectTable.off('click','**').on('click','.model-remove',function(){
            if(confirm('是否确定删除此项')){
                $(this).parent().parent().remove();
            }else{
                return false;
            }
        });
    }
    else if($(this).parent().hasClass('model-field-type-radio')){
        var $radioTable=$(this).parent().children('table');
        $radioTable.append("<tr> <td><input type='radio' disabled></td><td><input type='text'></td><td>----</td><td><input type='text'</td><td><a  class='model-remove' >删除</a></td></tr>");
        $radioTable.off('click','**').on('click','.model-remove',function(){
            if(confirm('是否确定删除此项')){
                $(this).parent().parent().remove();
            }else{
                return false;
            }
        });
    }
    else if($(this).parent().hasClass('model-field-type-checkbox')){
        var $checkboxTable=$(this).parent().children('table');
        $checkboxTable.append("<tr> <td><input type='checkbox' disabled></td><td><input type='text'></td><td>----</td><td><input type='text'</td><td><a  class='model-remove' >删除</a></td></tr>");
        $checkboxTable.off('click','**').on('click','.model-remove',function(){
            if(confirm('是否确定删除此项')){
                $(this).parent().parent().remove();
            }else{
                return false;
            }
        });
    }
});
