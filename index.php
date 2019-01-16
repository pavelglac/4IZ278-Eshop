<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 25.05.2018
 * Time: 2:48
 */

session_start();
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <title>Eshop</title>
    <?php include "view/head.php";?>
</head>
<body>

	<script>function p() {var link = document.createElement( "link" );link.href = "https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css";link.type = "text/css";link.rel = "stylesheet";document.getElementsByTagName( "head" )[0].appendChild( link );AOS.init();}</script>
	<script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js" async="" defer="" onload="p();"></script>

	<div class="background"></div>

	<div class="welcome container" id="welcome">

		<div id="particles-js" style="position: absolute;top: 0px;left: 0px;"></div>
		<script>function l(){particlesJS.load("particles-js","particlesjs-config.json",function(){console.log("callback - particles.js config loaded")});}</script>
		<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js" onload="l()" async=""></script>

    <?php include "view/header_main.php";?>

			<div class="typewriter open" id="typewriter">
				<div class="typewrite" data-period="2000" data-type='[ "Uživatelský zážitek", "Nezapomenutelnost", "Profesionalita", "Jedinečnost" ]'>
					<span class="wrap"></span>
				</div>
			</div>
			<script>var TxtType=function(t,e,i){this.toRotate=e,this.el=t,this.loopNum=0,this.period=parseInt(i,10)||2e3,this.txt="",this.tick(),this.isDeleting=!1};TxtType.prototype.tick=function(){var t=this.loopNum%this.toRotate.length,e=this.toRotate[t];this.isDeleting?this.txt=e.substring(0,this.txt.length-1):this.txt=e.substring(0,this.txt.length+1),this.el.innerHTML='<span class="wrap">'+this.txt+"</span>";var i=this,s=200-100*Math.random();this.isDeleting&&(s/=2),this.isDeleting||this.txt!==e?this.isDeleting&&""===this.txt&&(this.isDeleting=!1,this.loopNum++,s=500):(s=this.period,this.isDeleting=!0),setTimeout(function(){i.tick()},s)},window.onload=function(){for(var t=document.getElementsByClassName("typewrite"),e=0;e<t.length;e++){var i=t[e].getAttribute("data-type"),s=t[e].getAttribute("data-period");i&&new TxtType(t[e],JSON.parse(i),s)}var n=document.createElement("style");n.type="text/css",n.innerHTML=".typewrite > .wrap { border-right: 0.08em solid #fff}",document.body.appendChild(n)};</script>

			<div class="arrow bounce" id="arrow">
				<i class="fas fa-arrow-down fa-2x"></i>
			</div>

	</div>

	<div class="about" id="about">
		<section class="center" data-aos="flip-left">
			<div class="profile-img">
                <img src="img/profile-sm.jpg" class="center"  srcset="img/profile.jpg 960w, img/profile-sm.jpg 480w, img/profile-sm.jpg 340w" sizes="(min-width: 768px) 340px, 90vw" height="340" alt="Profilový obrázek">
				<div class="spinner"></div>
			</div>
			<div class="profile-text text-justify">
				<h2>Kdo jsem?</h2>
				<p>Jmenuji se Pavel Glac a jsem studentem Vysoké školy ekonomické v Praze. Webům se věnuji krátkou chvíli, ale o to s větší chutí. Baví mě posouvat uživatelský zážitek na vyšší úroveň, jelikož web by se nemněl psát pro zadavatele, ale pro konečně uživatele. Předtím, než jsem začal zkoumat frontend webů, tak jsem se věnoval grafice, takže v této oblasti mám zkušenosti. V roce 2018 jsem podstoupil školení na vývoj wordpress šablon. Vývoj šablon a statických webů má vždy uživatel plně pod svou kontrolou.</p>
			</div>
		</section>
	</div>


	<main id="products">
		<div class="products center">

            <?php

                require_once 'controllers/db_products.php';
                $obj = new DB_products();
                $products = $obj->products_all();

                foreach($products as $row) { ?>

                    <div class="product text-justify">
                        <i class="<?= $row['icon'] ?> fa-8x center"></i>
                        <h2><?= $row['name'] ?></h2>
                        <p><?= $row['description'] ?></p>
                        <div class="center buy"><a href="buy.php?id=<?= $row['id'] ?>"><p>Objednat</p></a></div>
                    </div>

            <?php } ?>


		</div>
	</main>

</body>
</html>