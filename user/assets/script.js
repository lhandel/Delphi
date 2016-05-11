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
        url: 'ewt.php',
        data:  dataString,
        cache: false,
        success:function(result){
          var current_time = new Date().getMinutes();
//          $("#ewt_user").html(result.flag);
          if(result.flag ==1){
            $("#display_minute").hide();
            $("#display_ewt").hide();
            $("#clock_icon").hide();
            $("p").css({"font-weight":"bold", "font-size":"25px"});
            $("#ewt_user").html("It will soon be your turn </br>please return to the store");
          }
          else if(result.content>0){
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
