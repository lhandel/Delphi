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


  function countdown(){

    var dataString = {
      s_id : s_id
    };

        $.ajax({
        url: 'ewt.php',
        type: 'post',
        data:  dataString,
        success: function(response) {

            if(ewt>0){  // Thanks for the code
              if(response == temp){
                ewt--;
              }
              else{
                ewt = response;
                temp = response;
              }
              var display = response;
              $("#ewt").html(display);
            }
            else{
              $("#ewt").html("It's your turn next");
              blink();
            }
          }
    });
  }
  setInterval(countdown,1000);

  function blink() {
      $("#ewt").fadeTo(100, 0.1).fadeTo(200, 1.0);
    }









})
