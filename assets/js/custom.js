let dataparams  = [];

function swaldel(action){
play_sound("nop");
a = false;
 a = swal({
    title: "Are you sure?",
    text: "You will not be able to recover this record/file!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Yes, Delete it!",
    cancelButtonText: "No, Cancel!",
    closeOnConfirm: false,
    closeOnCancel: false
  },
  function(isConfirm,deleted) {
    if (isConfirm) {

        $.get(action,(res)=>{
            swal("Deleted!", "Record(s) Deleted. \n ", "success");
            setTimeout(function(){
              window.location.reload(2000);
            },2000);
          })
          
    } else {
      swal("Cancelled", " :)", "error");
    } 
  });
}


function success(title, msg){ play_sound(); swal(title, msg, "success"); }
function danger(title, msg){ play_sound("nop"); swal(title, msg, "warning"); }