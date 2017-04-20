上传组件一般都需要后端服务支持，我用ngnix模拟了一个Json文件，作为Post提交文件的应答输出；

如果要操作docs下面的demo，请先切换到nginx目录下面。
执行：start nginx
启动nginx服务后，然后在切换到docs，体验demo；（请查阅80端口是否被其他服务占用，影响nginx启动）

体验完毕后，请执行  nginx -s quit，以此来正常关闭nginx服务；

目前组件支持两种模式
1.Table 模式
2.Card 模式

关键字：useDefTemplate  true = Table模式 | false = Card模式

使用方法：
1.页面引入样式和脚本
例如：
引入样式：
<link rel="stylesheet" href="../dist/amazeui.min.css"/>
<link rel="stylesheet" href="../dist/amazeui.upload.css"/>
引入脚本：
<script src="../dist/jquery.min.js"></script>
<script src="../dist/amazeui.min.js"></script>
<script src="../dist/amazeui.upload.js"></script>

2.页面中定义Div，并声明Div id；
例如：
<div id="event"></div>

3.页面初始化时加载相应的参数
例如：
$(function(){
 	$('#event').Upload({url : 'http://localhost/demo.json'});
});



遗留问题：
1.目前尚未提供外部模块建立接口，只能修改内部的方法：建立其他的展示模版，并提供其他模版的操作项；
2.所有的模版没有采用handlebars，均为Html的字符串；
3.上传组件依赖后端服务响应，响应失败后，虽然结果集中不会增加ID，但是对于前端尚未有更多的测试；
4.默认模版中，自定义类型可显示相应的示例图片。为了减少调试时间，我取消了该样式，在下个版本那种会增加进去；图片加载还存在问题，需要考虑采用懒加载的模式，加载完成后在显示图片；
5.类型限定比较简陋
6.消息提示采用的原始alert，下个版本替换为AmazeUI的标准功能项；
7.AmazeUI 采用标准的对象封装，下个版本会参考这种方式，重构目前的功能，能够和AmazeUI进行统一打包，并使用AmazeUI中相关的UI的各种事件，减少依赖和解耦；
