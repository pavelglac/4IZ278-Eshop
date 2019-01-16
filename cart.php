<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <title>Nákupní košík</title>
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

    <?php include "view/header.php";?>

    <div class="cart center" id="typewriter">

        <h1 class="text-center">Nákupní košík</h1>

        <?php

        require_once 'controllers/db_carts.php';
        $obj = new DB_carts();
        $products = $obj->cart($_SESSION['user_id']);

        if (empty($products)) {?><h2 class="text-center">Nemáte žádné zboží v košíku</h2><?php }

        foreach($products as $row) { ?>

        <div class="item">

            <i class="<?= $row['icon'] ?> fa-6x icon"></i>
            <div class="cart--text">

                <h2><?= $row['name'] ?></h2>
                <p class="text-justify"><?= $row['description'] ?></p>

            </div>
            <a href="remove.php?id=<?= $row['item'] ?>">&#215;</a>

        </div>

    <?php }

    if (!empty($products)) {?><a href="pay.php" class="btn continue">Zaplatit</a><?php } ?>
    </div>



<div class="empty"></div>

</div>




<script src="release/js/main.js" async="" defer=""></script>

</body>
</html>