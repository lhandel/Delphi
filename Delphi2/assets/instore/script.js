
  /* After 5 sec redirect back to start page */

    window.setTimeout(function(){
        $("body").fadeOut(500,function(){
           window.location.href = base_url;
        })
    },5000);
