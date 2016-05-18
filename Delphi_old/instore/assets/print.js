<!DOCTYPE html>
<!--
//
// StarWebPRNT Sample(Canvas Handwriting)
//
// Version 1.2.0
//
// Copyright (C) 2012-2015 STAR MICRONICS CO., LTD. All Rights Reserved.
//
-->
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<title>StarWebPRNT Sample(Comparison Receipt Design)</title>

<link href="css/import.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="style.css" media="screen">

<link href="css/style_comparisonreceiptdesign.css" rel="stylesheet" type="text/css">
<script type='text/javascript' src='assets/StarWebPrintBuilder.js'></script>
<script type='text/javascript' src='assets/StarWebPrintTrader.js'></script>
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
function onSendMessageApi() {
  var builder = new StarWebPrintBuilder();

  var request = '';

  request += builder.createInitializationElement();
  request += builder.createAlignmentElement({position:'center'});
  request += builder.createTextElement({data:'Welcome to DQ\n'});
  request += builder.createTextElement({data:'7 \n'});
/*  switch (document.getElementById('paperWidth').value) {
      case 'inch2' :

          break;
      case 'inch3DotImpact' :
          request += builder.createTextElement({characterspace:2});

          request += builder.createAlignmentElement({position:'right'});
          request += builder.createLogoElement({number:1});
          request += builder.createTextElement({data:'TEL 9999-99-9999\n'});
          request += builder.createAlignmentElement({position:'left'});

          request += builder.createTextElement({data:'\n'});

          request += builder.createAlignmentElement({position:'center'});
          request += builder.createTextElement({data:'Thank you for your coming. \n'});
          request += builder.createTextElement({data:"We hope you'll visit again.\n"});
          request += builder.createAlignmentElement({position:'left'});

          request += builder.createTextElement({data:'\n'});

          request += builder.createTextElement({data:'Apple                               $20.00\n'});
          request += builder.createTextElement({data:'Banana                              $30.00\n'});
          request += builder.createTextElement({data:'Grape                               $40.00\n'});
          request += builder.createTextElement({data:'Lemon                               $50.00\n'});
          request += builder.createTextElement({data:'Orange                              $60.00\n'});
          request += builder.createTextElement({emphasis:true, data:'Subtotal                           $200.00\n'});
          request += builder.createTextElement({data:'\n'});

          request += builder.createTextElement({underline:true, data:'Tax                                 $10.00\n'});
          request += builder.createTextElement({underline:false});

          request += builder.createTextElement({emphasis:true});
          request += builder.createTextElement({width:2, data:'Total         $210.00\n'});
          request += builder.createTextElement({width:1});
          request += builder.createTextElement({emphasis:false});

          request += builder.createTextElement({data:'\n'});

          request += builder.createTextElement({data:'Received                           $300.00\n'});

          request += builder.createTextElement({width:2, data:'Change         $90.00\n'});
          request += builder.createTextElement({width:1});
          request += builder.createTextElement({data:'\n'});

          request += builder.createTextElement({characterspace:0});
          break;
      default :
          request += builder.createTextElement({characterspace:0});

          request += builder.createAlignmentElement({position:'right'});
          request += builder.createLogoElement({number:1});
          request += builder.createTextElement({data:'TEL 9999-99-9999\n'});
          request += builder.createAlignmentElement({position:'left'});

          request += builder.createTextElement({data:'\n'});

          request += builder.createAlignmentElement({position:'center'});
          request += builder.createTextElement({data:'Thank you for your coming. \n'});
          request += builder.createTextElement({data:"We hope you'll visit again.\n"});
          request += builder.createAlignmentElement({position:'left'});

          request += builder.createTextElement({data:'\n'});

          request += builder.createTextElement({data:'Apple                                     $20.00\n'});
          request += builder.createTextElement({data:'Banana                                    $30.00\n'});
          request += builder.createTextElement({data:'Grape                                     $40.00\n'});
          request += builder.createTextElement({data:'Lemon                                     $50.00\n'});
          request += builder.createTextElement({data:'Orange                                    $60.00\n'});
          request += builder.createTextElement({emphasis:true, data:'Subtotal                                 $200.00\n'});
          request += builder.createTextElement({data:'\n'});

          request += builder.createTextElement({underline:true, data:'Tax                                       $10.00\n'});
          request += builder.createTextElement({underline:false});

          request += builder.createTextElement({emphasis:true});
          request += builder.createTextElement({width:2, data:'Total            $210.00\n'});
          request += builder.createTextElement({width:1});
          request += builder.createTextElement({emphasis:false});

          request += builder.createTextElement({data:'\n'});

          request += builder.createTextElement({data:'Received                                 $300.00\n'});

          request += builder.createTextElement({width:2, data:'Change            $90.00\n'});
          request += builder.createTextElement({width:1});
          request += builder.createTextElement({data:'\n'});

          request += builder.createTextElement({characterspace:0});
          break;
      case 'inch4' :
          request += builder.createTextElement({characterspace:1});

          request += builder.createAlignmentElement({position:'right'});
          request += builder.createLogoElement({number:1});
          request += builder.createTextElement({data:'TEL 9999-99-9999\n'});
          request += builder.createAlignmentElement({position:'left'});

          request += builder.createTextElement({data:'\n'});

          request += builder.createAlignmentElement({position:'center'});
          request += builder.createTextElement({data:'Thank you for your coming. \n'});
          request += builder.createTextElement({data:"We hope you'll visit again.\n"});
          request += builder.createAlignmentElement({position:'left'});

          request += builder.createTextElement({data:'\n'});

          request += builder.createTextElement({data:'Apple                                                     $20.00\n'});
          request += builder.createTextElement({data:'Banana                                                    $30.00\n'});
          request += builder.createTextElement({data:'Grape                                                     $40.00\n'});
          request += builder.createTextElement({data:'Lemon                                                     $50.00\n'});
          request += builder.createTextElement({data:'Orange                                                    $60.00\n'});
          request += builder.createTextElement({emphasis:true, data:'Subtotal                                                 $200.00\n'});
          request += builder.createTextElement({data:'\n'});

          request += builder.createTextElement({underline:true, data:'Tax                                                       $10.00\n'});
          request += builder.createTextElement({underline:false});

          request += builder.createTextElement({emphasis:true});
          request += builder.createTextElement({width:2, data:'Total                    $210.00\n'});
          request += builder.createTextElement({width:1});
          request += builder.createTextElement({emphasis:false});

          request += builder.createTextElement({data:'\n'});

          request += builder.createTextElement({data:'Received                                                 $300.00\n'});

          request += builder.createTextElement({width:2, data:'Change                    $90.00\n'});
          request += builder.createTextElement({width:1});
          request += builder.createTextElement({data:'\n'});

          request += builder.createTextElement({characterspace:0});
          break;
  }*/

  request += builder.createCutPaperElement({feed:true});

  sendMessageApi(request);
}

function sendMessageApi(request) {
nowPrinting();
  var url = document.getElementById('url').value;

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

      msg += '\tEtbCounter = ' + trader.extractionEtbCounter({traderStatus:response.traderStatus}).toString() + ' ]\n';

//      msg += 'Status : [ ' + response.status + ' ]\n';
//
//      msg += 'ResponseText : [ ' + response.responseText + ' ]\n';

      alert(msg);
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
<noscript>
  Your browser does not support JavaScript!
</noscript>

</head>

<body>

<div id="overlay">
  <div id="nowPrintingWrapper">
    <section id="nowPrinting">
      <h1>Now Printing</h1>
      <p><img src="images/icon_loading.gif" /></p>
    </section>
  </div>
  <div id="nowLoadingWrapper">
    <section id="nowLoading">
      <h1>Now Loading</h1>
      <p><img src="images/icon_loading.gif" /></p>
    </section>
  </div>
</div>

<header id="global-header">
<h1><a href="A001.html"><img src="images/logo_01.png" alt="HOME" width="108" height="61"></a></h1>
<div id="sub-logo"><a href="http://www.star-m.jp/" target="_blank"><img src="images/logo_02.png" alt="" width="120" height="13"></a></div>
</header>

<section class="btmMg20">
<h2 class="h2-tit-01 btmMg20">Comparison : Receipt Design</h2>
</section>

  <form onsubmit='return false;' id="form">
  <div id='canvasFrame' style='display:none'>
    <canvas id='canvasPaper' width='576' height='640'></canvas>
  </div>
  <div class="container">

    <footer>
      <dl>
        <dt>Paper Width</dt>
        <dd>:
          <select id='paperWidth' onchange='onResizeCanvas()'>
            <option value='inch2' selected='selected'>2 Inch</option>
            <option value='inch3'>3 Inch</option>
            <option value='inch4'>4 Inch</option>
          </select>

        </dd>
      </dl>
      <dl>
        <dt>URL</dt>
        <dd>:
                  <input id="url" type="text" value="http://localhost:8001/StarWebPRNT/SendMessage" /></dd>
      </dl>

      <input id="sendBtnAPI" type="button" value="Send (API)" onclick="onSendMessageApi()" />
      <div id="canvasSecond">
        <canvas width='0' height='15'>
          Your browser does not support Canvas!
        </canvas>
      </div>
      <input id="sendBtnCanvas" type="button" value="Send (Canvas)" onclick="onSendMessageCanvas()" />
    </footer>
  </div>
</form>

  <div class="to_top">
  </div>
<footer id="global-footer" class="clearfix">
<a href="http://www.star-m.jp/products/s_print/sdk_webprnt/manual/index.htm" target="_blank"><img src="images/footer-logo.png" width="123" alt="" id="footer-logo"></a>
  <img src="images/footer-image.png"height="54" alt=""/>
</footer>

</body>
</html>
