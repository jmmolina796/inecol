var http = require('http');

var server = http.createServer(function(req, res){
	res.end();
}).listen(3000,"pasevic.local");
console.log("Servidor funcionando en http://pasevic.local:3000");

var io = require("socket.io").listen(server);

io.sockets.on("connection",function(socket){

	socket.on("sendLikeWall",function(data){
		//socket.emit("getLikeProyect",{can:data.can,url:data.url});
		socket.broadcast.emit("getLikeWall",{url:data.url,can:data.can});
	});

	socket.on("sendLikeComment",function(data){
		//socket.emit("getLikeProyect",{can:data.can,url:data.url});
		socket.broadcast.emit("getLikeComment",{url:data.url,idP:data.idP,can:data.can});
	});

	socket.on("sendComment",function(data){
		//socket.emit("getComment",{html:data.html,id_pub:data.id_pub,url:data.url});
		socket.broadcast.emit("getComment",{url:data.url,idP:data.idP,idC:data.idC,usr:data.usr,can:data.can});
	});

	socket.on("sendPublication",function(data){
		//socket.emit("getPublication",{idP:data.idP,url:data.url});
		socket.broadcast.emit("getPublication",{url:data.url,idP:data.idP,tp:data.tp});
	});

});