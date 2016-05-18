
  /* After 5 sec redirect back to start page */

    window.setTimeout(function(){
        $("body").fadeOut(500,function(){
           window.location.href = 'http://localhost/Delphi/Delphi2/index.php/instore';
        })
    },5000);
