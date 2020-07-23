<script src='//cdn.bootcss.com/socket.io/1.3.7/socket.io.js'></script>
<script>
// 初始化io对象
var socket = io('http://'+document.domain+':2120');
// uid 可以为网站用户的uid，作为例子这里用session_id代替
var uid = 1;
// 当socket连接后发送登录请求
socket.on('connect', function(){
	socket.emit('login', uid);
	});
// 当服务端推送来消息时触发，这里简单的aler出来，用户可做成自己的展示效果
socket.on('new_msg', function(msg){alert(msg);});
//socket.emit('take1', uid);
</script>