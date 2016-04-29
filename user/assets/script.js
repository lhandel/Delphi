$(document).ready(function(){
  lookup();

  //setInterval(lookup,2000);
  function lookup(){

    var dataString = {
      u_id : u_id
    };
    $.ajax({
      url:    "in_line.php",
      data :  dataString,
      cache:  false,
      success:function(result){
        $("#in_queue").html(result.content);
      }
    });
  }
  setInterval(lookup,1000);

})
