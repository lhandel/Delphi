$(document).ready(function(){

            var startpost;
            $(".menuToggle").click(function(){
              openMenu();
            });

            var mkey = false;
            var isopen = false;
            var kup = true;
            $(document).keydown(function(e) {

                // Go to a page
                if(e.which>48 && e.which<58 && isopen){
                    var target = $("#item"+(e.which-48)).attr('href');
                    if(target!=undefined)
                      document.location = target;
                }

                if(e.which==27)
                  closeMenu();
                if(e.which==77)
                  mkey = true;

                if(mkey && isopen && kup){
                      kup = false;
                      closeMenu();
                }else if(mkey && !isopen && kup){
                    kup = false;
                    openMenu();
                }
            });

            $(document).keyup(function(e) {
              mkey= false;
              kup = true;
            });

            var hasBeenTrigged = false;
            $(window).scroll(function() {
                var diff = Math.abs($(this).scrollTop()-startpost);
                if (diff >= 15 && !hasBeenTrigged) { // if scroll is greater/equal then 100 and hasBeenTrigged is set to false.
                  closeMenu();
                }else if(!hasBeenTrigged){
                  $(".menu").css({left:(-8+(diff/3))+'px'});
                }
            });

            $(document).mouseup(function (e){
          	    var container = $(".menu");
          	    if (!container.is(e.target) // if the target of the click isn't the container...
          	        && container.has(e.target).length === 0){
          	        closeMenu();
          	    }
          	});

            function openMenu(){
              startpost = $(window).scrollTop();
              hasBeenTrigged = false;
              isopen = true;
              $(".menu").animate({left:'-8px'},200);
            }

            function closeMenu(){
              isopen = false;
              $(".menu").animate({left:'-208px'},200);
              hasBeenTrigged = true;
            }
        });
