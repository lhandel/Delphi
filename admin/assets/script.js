

$(document).ready(function(){

    var startpost;
    $(".menuToggle").click(function(){
      openMenu();
    });

    var isopen = false; // boolean for tracking the menu
    var kup = true; // used for fixing bug when you pressdown M
    var input = false;
    $("input").keydown(function(){
      input=true;
    });
    $("input").keyup(function(){
      input=false;
    });

    $(document).keydown(function(e) {

        // Go to a page with numbers
        if(e.which>48 && e.which<58 && isopen){
            var target = $("#item"+(e.which-48)).attr('href');
            if(target!=undefined)
              document.location = target;
        }
        // Close menu with escape
        if(e.which==27){
          closeMenu();
          $('.container-popup').hide();} //closes popupform

        // Open or close menu with M
        if(e.which==77 && isopen && kup && !input){
              kup = false;
              closeMenu();
        }else if(e.which==77 && !isopen && kup && !input){
            kup = false;
            openMenu();
        }
    });

    $(document).keyup(function(e) {
      kup = true;
    });

    // Close menu on scroll
    var hasBeenTrigged = false;
    $(window).scroll(function() {
        var diff = Math.abs($(this).scrollTop()-startpost);
        if (diff >= 15 && !hasBeenTrigged) {
          closeMenu();
        }else if(!hasBeenTrigged){
          // make a cool animation when you start scrolling
          $(".menu").css({left:(-8+(diff/2))+'px'});
        }
    });

    // Check if the user clicked outside the menu, then close the menu
    $(document).mouseup(function (e){
  	    var container = $(".menu");
  	    if (!container.is(e.target) // if the target of the click isn't the container...
  	        && container.has(e.target).length === 0){
  	        closeMenu();
  	    }
  	});

    // function for opening the menu
    function openMenu(){
      startpost = $(window).scrollTop();
      hasBeenTrigged = false;
      isopen = true;
      $(".menu").animate({left:'-8px'},200);
    }

    // function for closing the menu
    function closeMenu(){
      isopen = false;
      $(".menu").animate({left:'-208px'},200);
      hasBeenTrigged = true;
    }

});

function startLiveUpdate(){
  setInterval(liveUpdateList,5000);
}

function liveUpdateList(){
  $.ajax({
    url:    "liveList.php",
    cache:  false,
    success:function(result){

      $.each(result, function( index, value ) {
          $("#Q"+value.s_id).html(value.queue_count);
          $("#H"+value.s_id).html(value.handler);
          $("#E"+value.s_id).html(value.ewt);
      });

    }
  });
}
/* setting page */
function popup_s(toggle,s_id){
  $('.container-popup').fadeIn(450);
  $('#settingButton').attr('name',toggle); //reminder time or edit name etc.
  $('#sID').val(s_id);
  if(toggle=='rem'){ //if you try to change the reminder, you can only type numbers
    $('#contID').attr('type','number');
  }
}
