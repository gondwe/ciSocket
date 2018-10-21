</body>
</html>


<div id="pushnotif" style="top:15px; position:fixed;right:15px;width:100%">

</div>

<div id='swaly' class="alert text-light alert-dismissible fade pull-right col-md-4" 
	style='background:purple; margin:5px;bottom:5px; position:fixed;right:5px; border-radius:55px; display:none' role="alert">
  <strong>Info ! </strong><span id='memos'></span>
</div>

<script>


// function myrefresh(){
//     var h = window.location.hash.split('#')[1];
//     h = h == "" || h == "#" || h == undefined ? "home" : h;
//     $( "#play" ).hide().load( "loader.php?page="+h ).fadeIn(3000);
//     // $( "#play" ).load( "loader.php?page="+h );

// }

// $(document).ready(()=>{
// 	// myrefresh();
// 	 $( "#play" ).hide().load( "loader.php?page=" ).fadeIn(3000);
// });




// chat server

            // var conn = null;
			// var isConnected = false;
			// toggleConnect();

			// $(function() {
			// 	setOffline();
			// });

			// function setOnline() {
			// 	$("#status").removeClass("label-warning");
			// 	$("#status").addClass("label-success");
			// 	$("#status").html("Connected");
			// 	$("button.connect").html("Disconnect");
			// 	$("#offlineActions").hide();
			// 	$("#onlineActions").show();
			// 	isConnected = true;
			// }

			// function setOffline() {
			// 	$("#status").addClass("label-warning");
			// 	$("#status").removeClass("label-success");
			// 	$("#status").html("Disconnected");
			// 	$("button.connect").html("Connect");
			// 	$("#offlineActions").show();
			// 	$("#onlineActions").hide();
			// 	isConnected = false;
			// }

			// function send(msg=null,user=null) {
			// 	// msg = $("#message").val();
			// 	// user = $("#username").val();
			// 	user = 'admin';
			// 	msg = '<div id="swal2" class="alert text-light alert-dismissible show fade pull-right col-md-4" style="background:red; margin:5px; border-radius:55px;" role="alert"> <strong>Alert ! </strong><span id="chatTarget"></span><button type="button" class="close" style="border-left:1px solid #333;background:#000;border-radius: 0px 50px 50px 0px;" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			// 	spill(user);

			// 	if (msg == "" || user =="") {
			// 		alert("Can't send an empty message / username");
			// 		return;
			// 	}
			// 	conn.send(msg+"|||"+user);
			// 	$("#pushnotif").prepend(user+":" + msg + "<br/>");
			// }

			// function toggleConnect() {
			// 	var uri = 'ws://127.0.0.1:8080/';
			// 	// var uri = $("#conn_str").val();
			// 	if (isConnected) {
			// 		setOffline();
			// 		return;
			// 	}
			// 	conn = new WebSocket(uri);

			// 	conn.onmessage = function(e) {
			// 		data = e.data.split("|||");
			// 		message = data[0];
			// 		user = data[1];
					
			// 		// console.log(e.data);


			// 		$("#pushnotif").prepend( user+" : "+message + "<br/>");
			// 	}

			// 	conn.onopen = function(e) {
			// 		console.log(e);
			// 		setOnline();
			// 		console.log("Connected");
			// 		isConnected = true;
			// 	};

			// 	conn.onclose = function(e) {
			// 		console.log("Disconnected");
			// 		setOffline();
			// 	};

			// }

	function ndkpush(){

	}

	function pf(i){ console.log(i); }
	function spill(i){pf(i);}
		
	function play_sound(f='info'){
		$base_url = "<?=base_url("")?>"
		audioElement = document.createElement('audio');
		audioElement.setAttribute('src', $base_url + 'assets/'+f+'.mp3');
		audioElement.setAttribute('autoplay', 'autoplay');
		audioElement.load();
		audioElement.play();
	}

</script>


<!-- <div class="m-5"> -->
<!-- <h3>This is a websocket demo using basic websockets</h3>

		<div id="offlineActions">
			<div>Server IP: <input type="text" id="conn_str" value="ws://127.0.0.1:8080/"/></div>

		</div>
		<div id="statusBox">
			<span id="status" class="label label-warning">Disconnected</span>
			<button onclick='toggleConnect();' class="connect">Connect</button>
		</div>
		<div id="onlineActions" class="display: none">
			<input type="text" id="username" required placeholder="Enter Username" />
			<input type="text" id="message" placeholder="Message" />
			<button onclick='send();' class="send" >Send Message</button>
		</div>
		<div id="chatTarget" style="overflow-x: scroll; height:400px; max-height: 400px;">
		</div>
</div> -->



<?php 

// $ex = exec("php -q X:\sites\house\socket\bin\chat-server.php");
// pf($ex);

?>



<div class='fixed-bottom pb-1'style="text-align:center; background:#fff; z-index:-10;" >
     <small style='color:#bbb; width:100%; background:#fff; ' >All Rights Reserved &copy 2018 Lighthouse For Christ Eye Center</small>
    </body>
</div>

<script src='<?=base_url('assets/js/popper.min.js')?>'></script>
<script src='<?=base_url('assets/js/bootstrap.min.js')?>'></script>
<script src='<?=base_url('assets/js/jquery.dataTables.min.js')?>'></script>
<script src='<?=base_url('assets/js/sweetalert.min.js')?>'></script>
<script src='<?=base_url('assets/js/custom.js')?>'></script>
<script src='<?=base_url('assets/js/searchbox.js')?>'></script>


<?php 
if(isset($this->session->infoh)){
	?><script>play_sound();swal('Success', '<?=$this->session->infoh ?>', 'success');</script><?php
	unset($_SESSION["infoh"]);
}
if(isset($this->session->errorh)){
	?><script>play_sound('nop');swal('Error', '<?=$this->session->errorh ?>', 'warning');</script><?php
	unset($_SESSION["errorh"]);
}
if(isset($this->session->notice)){
	notify($this->session->notice);
	?><script>play_sound('nop');</script><?php
	unset($_SESSION["notice"]);
}
if(isset($this->session->wnotice)){
	notify($this->session->wnotice,1);
	?><script>play_sound('nop');</script><?php
	unset($_SESSION["wnotice"]);
}

?>


<div id="flashMsgModal" class="modal fade" role="dialog" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" id="flashMsgHeader">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <center><i id="flashMsgIcon"></i> <font id="flashMsg"></font></center>
                    </div>
                </div>
            </div>
        </div>
        <!--Modal end-->

        <!--modal to display transaction receipt when a transaction's ref is clicked on the transaction list table --->
        <div class="modal fade" role='dialog' data-backdrop='static' id="transReceiptModal">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header hidden-print d-print-none">
                        <span class="text-center">Transaction Receipt</span>
                        <button class="close pull-right" data-dismiss='modal'>&times;</button>
                    </div>
                    <div class="modal-body" id='transReceipt'></div>
                </div>
            </div>
        </div>
        <!--- End of modal--->


        <!---Login Modal--->
        <div class="modal fade" role='dialog' data-backdrop='static' id='logInModal'>
            <div class="modal-dialog">
                <!---- Log in div below----->
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close closeLogInModal">&times;</button>
                        <h4 class="text-center">Log In</h4>
                        <div id="logInModalFMsg" class="text-center errMsg"></div>
                    </div>
                    <div class="modal-body">
                        <form name="logInModalForm">
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <label for='logInModalEmail' class="control-label">E-mail</label>
                                    <input type="email" id='logInModalEmail' class="form-control checkField" placeholder="E-mail" autofocus>
                                    <span class="help-block errMsg" id="logInModalEmailErr"></span>
                                </div>
                                <div class="col-sm-12 form-group">
                                    <label for='logInPassword' class="control-label">Password</label>
                                    <input type="password" id='logInModalPassword'class="form-control checkField" placeholder="Password">
                                    <span class="help-block errMsg" id="logInModalPasswordErr"></span>
                                </div>
                            </div>

                            <div class="row">
                                <!--<div class="col-sm-6 pull-left">
                                    <input type="checkbox" class="control-label" id='remMe'> Remember me
                                </div>-->
                                <div class="col-sm-4"></div>
                                <div class="col-sm-2 pull-right">
                                    <button id='loginModalSubmit' class="btn btn-primary">Log in</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!---- End of log in div----->
            </div>
        </div>
        <!---end of Login Modal-->