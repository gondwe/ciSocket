
function play_sound() {
    var audioElement = document.createElement('audio');
    audioElement.setAttribute('src', '/house/assets/info.mp3');
    audioElement.setAttribute('autoplay', 'autoplay');
    audioElement.load();
    audioElement.play();
}


function spill(a){console.log(a);}
$(document).on("submit", "form", function(event){
	event.preventDefault();
	event.stopImmediatePropagation();
	
    actionpage = $(this).attr("action");
 
	
    
	if(actionpage.indexOf(".php") < 0){
        actionpage = actionpage  + ".php";
    }
    ppx = actionpage.indexOf(".php");
    pps = actionpage.substring(0,ppx);
    bigpage = [
        "save",
        "insert",
    ]
    
    // $("#play").load("anime/index.html");
    
    $.ajax({
        url: "pages/"+actionpage,
        type: $(this).attr("method"),
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (data, status){
            if(bigpage.includes(pps))
            {
                myrefresh();
            }
            document.getElementById("swal").classList.add("show");
            document.getElementById("swal").style.visibility = "visible";
            document.getElementById("memos").innerHTML = $.trim(data);
           
        },
        error: function (xhr, desc, err){/* console.log(err); */}
	});  
    // play_sound();
    send();
	setTimeout(() => {
        document.getElementById("swal").style.visibility = "hidden";
	}, 3000);
    
});