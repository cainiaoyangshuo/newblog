<!DOCTYPE html>
<html lang="en">
<head>
    <script src="/js/index/jquery.js"></script>

</head>
<body>


<div id="test">
    <a href="javascript:void(0)">运行websocket</a>
</div>

<script type="text/javascript">


$("#test").click(function(){
if("WebSocket" in window){
console.log("您的浏览器支持websocket\n");
var ws = new WebSocket("ws://127.0.0.1:9502");//创建websocket对象
ws.onopen = function(){
// ws.send("连接已建立\n");
    var msg = '测试数据1';
ws.send(msg);
console.log("数据发送中 : " + msg);
}

ws.onmessage = function(evt){
var recv_msg = evt.data;
console.log("接受到的数据为:"+recv_msg);
}

ws.onerror = function(evt,e){
console.log("错误信息为"+e);
}

ws.onclose = function(){
console.log("连接已关闭");
}

}else{
console.log("您的浏览器不支持websocket\n");
}
});

</script>
</body>
</html>