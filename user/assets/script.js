var temp = 0;
var ewt = 10;
$(document).ready(function(){
  lookup();
  countdown();

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

  function pad(d) {
    return (d < 10) ? '0' + d.toString() : d.toString();
  }
  function countdown(){

    var dataString = {
      u_id : u_id
    };

        $.ajax({
        url: 'ewt.php',
        data:  dataString,
        success:function(result){
          if(ewt>0){
            if(result.content == temp){
              ewt--;
            }
            else{
              ewt = result.content;
              temp = result.content;
            }
            var display = pad(Math.floor(ewt/60))+':'+pad(ewt%60);
            $("#ewt_user").html(display);
          }
          else{
            $("#ewt_user").html("it is your time");
          }
        }
    });
  }
  setInterval(countdown,60000);

  function blink() {
      $("#ewt").fadeTo(100, 0.1).fadeTo(200, 1.0);
    }









})
