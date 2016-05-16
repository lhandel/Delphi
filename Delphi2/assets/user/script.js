var temp = 0;
var ewt = 1;
var temp_time= new Date().getMinutes();
$(document).ready(function(){

  countdown();

  function pad(d) {
    return (d < 10) ? '0' + d.toString() : d.toString();
  }
  function countdown(){

    var dataString = {
      public_id : public_id
    };

        $.ajax({
        site_url('/application/controllers/User.php?f=u_ewt'),
        data:  dataString,
        cache: false,
        success:function(result){
          var current_time = new Date().getMinutes();
//          $("#ewt_user").html(result.flag);


          if(result.state == 1){ // if the user is called to the queue his state is 1
            $("#ewt_user").html("It's your turn");

          }
          else if(result.state == 4){
            $("#ewr_user").html("You got removed from the queue")
          }

          else if(result.flag ==1||result.content==0){
            $("#display_minute").hide();
            $("#display_ewt").hide();
            $("#clock_icon").hide();
            $("p").css({"font-weight":"bold", "font-size":"25px"});
            $("#ewt_user").html("It will soon be your turn </br>please return to the store");
            $("#in_queue").html(result.inline);
          }


          else {
            $("#in_queue").html(result.inline);
            $("#ewt_user").html(result.content);
          }

        }
    });
  }
  setInterval(countdown,1000);

  function blink() {
      $("#ewt").fadeTo(100, 0.1).fadeTo(200, 1.0);
    }









})
