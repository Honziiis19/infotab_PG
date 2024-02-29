<!DOCTYPE html>

<html lang="cs-cz">
<head>
<meta charset="utf-8"/>
<title>Informační tabule</title>
<link rel="stylesheet" href="css/style-003.css">
<link rel="stylesheet" href="panel/style-002.css">
<link rel="stylesheet" href="css/reveal/reveal.css">
<link rel="stylesheet" href="css/reveal/theme/white.css">
<script src="panel/show_panel-001.js" defer></script>
<script src="panel/showTime-001.js" defer></script>
<script src="panel/showDate-001.js" defer></script>
<script src="panel/showWeather-001.js" defer></script>
</head>

<body class="noselect">

<div class="main">      
    <div class="reveal" style="position: relative; top: 0px">
      <div class="slides">
      <?php include "main/gallery.php"; ?>
      </div>
    </div>
</div>

<div class="panel">
    <div class="top-info">
        <div class="datetime-info">
          <div id="clock">00:00</div>
          <div id="date">dd.mm.yy</div>
        </div>
        <div id="weather">
        <p align="center">
        <img id="image" src="" style="vertical-align: middle" /><span id="teplota">20</span><span id="deg">°</span>
      </p>
        <p align="center"><span id="stav"></span>
      </p>
        <p align="center">
        Tlak: <span id="tlak">1000</span>hPa
      </p>
        <p align="center">Vlhkost: <span id="vlhkost">53</span>%
      </p>
        </div>
    </div>
    <div id="scrollable">
    <div id="Aktuálně" >Aktuálně</div>
    <div id="udalosti"></div>
    </div>
</div>

<div class="scroll">
    <div id="text"><?php include "scroll/get_text.php"; ?></div>
</div>



<script src="js/reveal/reveal.js"></script>
<script>
Reveal.initialize({
    autoSlide: 10000,
    defaultTiming: 1000,
    controls: false,
    loop: true,
    progress: false,
	//width: "55%",
	//height: "50%",
	//margin: 0,
	minScale: 0.9,
	maxScale: 2.0,
    revealjs_center: true
});
</script>

</body>
</html> 
