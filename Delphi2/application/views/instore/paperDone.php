
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Grab ticket</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

    <meta name="apple-mobile-web-app-capable" content="yes">

    <link rel="stylesheet" href="<?php echo site_url('assets/templates.css'); ?>" media="screen" title="no title" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href=<?php echo site_url('assets/instore/style.css')?> media="screen" title="no title" charset="utf-8">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:500,700,400|Open+Sans:400,600' rel='stylesheet' type='text/css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" charset="utf-8"></script>

    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">

    <script type='text/javascript' src='<?php echo site_url('assets/js/StarWebPrintBuilder.js'); ?>'></script>
    <script type='text/javascript' src='<?php echo site_url('assets/js/StarWebPrintTrader.js'); ?>'></script>
    <script type='text/javascript'>
    <!--
    var cursor         = 0;
    var lineSpace      = 0;
    var leftPosition   = 0;
    var centerPosition = 0;
    var rightPosition  = 0;

    /***********************************************************/
    /* print a sample receipt using API in StarWebPrintBuilder */
    /***********************************************************/
    function onSendMessageApi(q_no,service) {
        var builder = new StarWebPrintBuilder();

        var request = '';

        request += builder.createInitializationElement();

        request += builder.createAlignmentElement({position:'center'});
        request += builder.createTextElement({data:'Welcome to DQ\n'});
        request += builder.createAlignmentElement({position:'center'});
        request += builder.createTextElement({ linespace: 24,width:4, height: 4, data:' \n'});
        request += builder.createTextElement({width:2, height: 2, data:'Queue Number\n'});
        request += builder.createTextElement({ width:1, height: 1, data:'\n'});
        request += builder.createTextElement({emphasis:true});
        request += builder.createTextElement({ linespace: 24,width:5, height: 5, data:q_no+'\n'});
        request += builder.createTextElement({ linespace: 24,width:2, height: 2, data:' \n'});
        request += builder.createTextElement({ width:3, height: 2, data:service+'\n'});
        request += builder.createCutPaperElement({feed:true});


        sendMessageApi(request);
    }

    function sendMessageApi(request) {
    	nowPrinting();

        var url = 'http:/'+'/localhost:8001/StarWebPRNT/SendMessage';

        var trader = new StarWebPrintTrader({url:url});

        trader.onReceive = function (response) {
            var msg = '- onReceive -\n\n';

            msg += 'TraderSuccess : [ ' + response.traderSuccess + ' ]\n';

    //      msg += 'TraderCode : [ ' + response.traderCode + ' ]\n';

            msg += 'TraderStatus : [ ' + response.traderStatus + ',\n';

            if (trader.isCoverOpen            ({traderStatus:response.traderStatus})) {msg += '\tCoverOpen,\n';}
            if (trader.isOffLine              ({traderStatus:response.traderStatus})) {msg += '\tOffLine,\n';}
            if (trader.isCompulsionSwitchClose({traderStatus:response.traderStatus})) {msg += '\tCompulsionSwitchClose,\n';}
            if (trader.isEtbCommandExecute    ({traderStatus:response.traderStatus})) {msg += '\tEtbCommandExecute,\n';}
            if (trader.isHighTemperatureStop  ({traderStatus:response.traderStatus})) {msg += '\tHighTemperatureStop,\n';}
            if (trader.isNonRecoverableError  ({traderStatus:response.traderStatus})) {msg += '\tNonRecoverableError,\n';}
            if (trader.isAutoCutterError      ({traderStatus:response.traderStatus})) {msg += '\tAutoCutterError,\n';}
            if (trader.isBlackMarkError       ({traderStatus:response.traderStatus})) {msg += '\tBlackMarkError,\n';}
            if (trader.isPaperEnd             ({traderStatus:response.traderStatus})) {msg += '\tPaperEnd,\n';}
            if (trader.isPaperNearEnd         ({traderStatus:response.traderStatus})) {msg += '\tPaperNearEnd,\n';}

            window.setTimeout(function(){
                $("body").fadeOut(500,function(){
                   window.location.href = '<?php echo site_url('index.php/instore/index'); ?>';
                })
            },5000);
          //	document.location.href = '<?php echo site_url('index.php/instore/index'); ?>';
    //        msg += '\tEtbCounter = ' + trader.extractionEtbCounter({traderStatus:response.traderStatus}).toString() + ' ]\n';

    //      msg += 'Status : [ ' + response.status + ' ]\n';
    //
    //      msg += 'ResponseText : [ ' + response.responseText + ' ]\n';

    //        alert(msg);
        }

        trader.onError = function (response) {
            var msg = '- onError -\n\n';

            msg += '\tStatus:' + response.status + '\n';

            msg += '\tResponseText:' + response.responseText;

            alert(msg);
        }

        trader.sendMessage({request:request});
    }

    /***************************************/
    /* print a sample receipt using canvas */
    /***************************************/
    function DrawLeftText(text) {
        var canvas = document.getElementById('canvasPaper');

        if (canvas.getContext) {
            var context = canvas.getContext('2d');

            context.textAlign = 'left';

            context.fillText(text, leftPosition, cursor);

            context.textAlign = 'start';
        }
    }

    function DrawCenterText(text) {
        var canvas = document.getElementById('canvasPaper');

        if (canvas.getContext) {
            var context = canvas.getContext('2d');

            context.textAlign = 'center';

            context.fillText(text, centerPosition, cursor);

            context.textAlign = 'start';
        }
    }

    function DrawRightText(text) {
        var canvas = document.getElementById('canvasPaper');

        if (canvas.getContext) {
            var context = canvas.getContext('2d');

            context.textAlign = 'right';

            context.fillText(text, rightPosition, cursor);

            context.textAlign = 'start';
        }
    }

    function onSendMessageCanvas() {
        switch (document.getElementById('paperWidth').value) {
            case 'inch2' :
                buildMessageCanvas(28, 28, 384, 1);
                sendMessageCanvas(1);
                break;
            case 'inch3DotImpact' :
                buildMessageCanvas(32, 32, 576, 1.5);
                sendMessageCanvas(1.5);
                break;
            default :
                buildMessageCanvas(32, 32, 576, 1.5);
                sendMessageCanvas(1.5);
                break;
            case 'inch4' :
                buildMessageCanvas(48, 48, 832, 2);
                sendMessageCanvas(2);
                break;
        }
    }

    function buildMessageCanvas(fontSize, lineSpace, receiptWidth, logoScale) {
        var canvas = document.getElementById('canvasPaper');

        if (canvas.getContext) {
            var context = canvas.getContext('2d');

            context.clearRect(0, 0, canvas.width, canvas.height);

    //      context.textAlign    = 'start';
            context.textBaseline = 'top';

            var font = '';

            font += fontSize + 'px ';

            font += 'Arial';

            context.font = font;

            leftPosition   =  0;
    //      centerPosition =  canvas.width       / 2;
            centerPosition = (canvas.width - 16) / 2;
    //      rightPosition  =  canvas.width;
            rightPosition  = (canvas.width - 16);

    //      cursor = 0;
            cursor = 55 * logoScale;

            DrawRightText('TEL 9999-99-9999'); cursor += lineSpace;

            cursor += lineSpace;

            DrawCenterText('Thank you for your coming.');  cursor += lineSpace;
            DrawCenterText("We hope you'll visit again."); cursor += lineSpace;

            cursor += lineSpace;

            DrawLeftText('Apple');    DrawRightText('$20.00');  cursor += lineSpace;
            DrawLeftText('Banana');   DrawRightText('$30.00');  cursor += lineSpace;
            DrawLeftText('Grape');    DrawRightText('$40.00');  cursor += lineSpace;
            DrawLeftText('Lemon');    DrawRightText('$50.00');  cursor += lineSpace;
            DrawLeftText('Orange');   DrawRightText('$60.00');  cursor += lineSpace;
            DrawLeftText('Subtotal'); DrawRightText('$200.00'); cursor += lineSpace;

            cursor += lineSpace;

            DrawLeftText('Tax');      DrawRightText('$10.00');  cursor += lineSpace;

            context.fillRect(0, cursor - 2, receiptWidth, 2);     // Underline

            DrawLeftText('Total');    DrawRightText('$210.00'); cursor += lineSpace;

            cursor += lineSpace;

            DrawLeftText('Received'); DrawRightText('$300.00'); cursor += lineSpace;
            DrawLeftText('Change');   DrawRightText('$90.00');  cursor += lineSpace;

    //      alert('Cursor:' + cursor + ', ' + 'Canvas:' + canvas.height);
        }
    }

    function sendMessageCanvas(logoScale) {
    	nowPrinting();
        var image = new Image();

        image.src = 'img/StarLogo1.jpg' + '?' + new Date().getTime();

        var canvas = document.getElementById('canvasPaper');

        if (canvas.getContext) {
            var context = canvas.getContext('2d');

            image.onload = function () {
                context.drawImage(image, canvas.width - image.width * logoScale, 0, image.width * logoScale, image.height * logoScale);

                var url = document.getElementById('url').value;

                var trader = new StarWebPrintTrader({url:url});

                trader.onReceive = function (response) {
                    var msg = '- onReceive -\n\n';

                    msg += 'TraderSuccess : [ ' + response.traderSuccess + ' ]\n';

        //              msg += 'TraderCode : [ ' + response.traderCode + ' ]\n';

                    msg += 'TraderStatus : [ ' + response.traderStatus + ',\n';

                    if (trader.isCoverOpen            ({traderStatus:response.traderStatus})) {msg += '\tCoverOpen,\n';}
                    if (trader.isOffLine              ({traderStatus:response.traderStatus})) {msg += '\tOffLine,\n';}
                    if (trader.isCompulsionSwitchClose({traderStatus:response.traderStatus})) {msg += '\tCompulsionSwitchClose,\n';}
                    if (trader.isEtbCommandExecute    ({traderStatus:response.traderStatus})) {msg += '\tEtbCommandExecute,\n';}
                    if (trader.isHighTemperatureStop  ({traderStatus:response.traderStatus})) {msg += '\tHighTemperatureStop,\n';}
                    if (trader.isNonRecoverableError  ({traderStatus:response.traderStatus})) {msg += '\tNonRecoverableError,\n';}
                    if (trader.isAutoCutterError      ({traderStatus:response.traderStatus})) {msg += '\tAutoCutterError,\n';}
                    if (trader.isBlackMarkError       ({traderStatus:response.traderStatus})) {msg += '\tBlackMarkError,\n';}
                    if (trader.isPaperEnd             ({traderStatus:response.traderStatus})) {msg += '\tPaperEnd,\n';}
                    if (trader.isPaperNearEnd         ({traderStatus:response.traderStatus})) {msg += '\tPaperNearEnd,\n';}

                    msg += '\tEtbCounter = ' + trader.extractionEtbCounter({traderStatus:response.traderStatus}).toString() + ' ]\n';

        //              msg += 'Status : [ ' + response.status + ' ]\n';
        //
        //              msg += 'ResponseText : [ ' + response.responseText + ' ]\n';

                    alert(msg);
                }

                trader.onError = function (response) {
                    var msg = '- onError -\n\n';

                    msg += '\tStatus:' + response.status + '\n';

                    msg += '\tResponseText:' + response.responseText;

                    alert(msg);
                }

                try {
                    var builder = new StarWebPrintBuilder();

                    var request = '';

                    request += builder.createInitializationElement();

                    request += builder.createBitImageElement({context:context, x:0, y:0, width:canvas.width, height:canvas.height});

                    request += builder.createCutPaperElement({feed:true});

                    trader.sendMessage({request:request});
                }
                catch (e) {
                    alert(e.message);
                }
            }
        }

        image.onerror = function () {
            alert('Image file was not able to be loaded.');
        }
    }

    function onResizeCanvas() {
        var canvas = document.getElementById('canvasPaper');

        if (canvas.getContext) {
            var context = canvas.getContext('2d');

            switch (document.getElementById('paperWidth').value) {
                case 'inch2' :
                    canvas.width = 384;
                    canvas.height = 555;
                    break;
                case 'inch3DotImpact' :
                    canvas.width = 576;
                    canvas.height = 640;
                    break;
                default :
                    canvas.width = 576;
                    canvas.height = 640;
                    break;
                case 'inch4' :
                    canvas.width = 832;
                    canvas.height = 952;
                    break;
            }
            document.getElementById('canvasPaper').style.width="700px";
        }
    }
    function nowLoading(){
    	document.getElementById('form').style.display="block";
    	document.getElementById('overlay').style.display="none";
    	document.getElementById('nowLoadingWrapper').style.display="none";
    }
    function nowPrinting(){
    	document.getElementById('overlay').style.display="block";
    	document.getElementById('nowPrintingWrapper').style.display="table";
    	timer = setTimeout(function (){
    		document.getElementById('overlay').style.opacity= 0.0;
    		document.getElementById('overlay').style.transition= "all 0.3s";
    		intimer = setTimeout(function (){
    			document.getElementById('overlay').style.display="none";
    		document.getElementById('overlay').style.opacity= 1;
    	        clearTimeout(intimer);
    		}, 300);
    		document.getElementById('nowPrintingWrapper').style.display="none";
            clearTimeout(timer);
    	}, 7000);
    }
    window.onload = function() {
    	nowLoading();
    	onResizeCanvas();
    }
    // -->
    </script>
  </head>
  <body  <?php echo $theme; ?>  onload="onSendMessageApi(<?php echo $q_no?>,'<?php echo $service?>')">
    <div class="container">

      <h2 style="margin-top:60px; font-size: 50px;">Grab Your <br>Ticket <br><b><h1 style="font-size: 60px; margin-top: 10px;">Here!</h1></b></h2>
      <div class="icon-arrowdown">
        <i class="fa fa-arrow-down" aria-hidden="true"></i>
      </div>
      <div id="overlay">
    		<div id="nowPrintingWrapper">
    			<section id="nowPrinting">
    			</section>
    		</div>
    		<div id="nowLoadingWrapper">
    			<section id="nowLoading">
    			</section>
    		</div>
      </div>


    </div>

  </body>
</html>
