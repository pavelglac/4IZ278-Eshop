<?php

session_start();

require_once 'controllers/db.php';
$warning = false;

require_once __DIR__ . '/php-graph-sdk-5.x/src/Facebook/autoload.php';

$fb = new Facebook\Facebook([
    'app_id' => '214121056038706', // TODO Replace {app-id} with your app-id
    'app_secret' => 'ee395d44e09e27ef3556383bc0ef541c', // TODO Replace {app-secret} with your app-secret
    'default_graph_version' => 'v2.2',
]);
$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('https://www.pavelglac.com/fb-callback.php', $permissions);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once 'controllers/db_users.php';
    $obj = new DB_users();

    if ($_POST ["type"] == 1) {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $existing_user = $obj->user_data($email);

        if (password_verify($password, $existing_user["password"])) {

            $_SESSION['user_id'] = $existing_user["id"];

            header('Location: index.php');
            exit();

        } else {

            $warning = true;
            $message = "Špatně zadané uživatelské jméno nebo heslo.";

        }

    }

    if ($_POST ["type"] == 2) {
        $email = $_POST['email'];

        require_once 'model/validations.php';
        $val = new validations();

        if (!$val->emailvalidation($email)){

            if (!$obj->email_exist($email)) {

                $password = $_POST['password'];
                $hashed = password_hash($password, PASSWORD_DEFAULT);

                $obj->user_insert($email, $hashed);

                $_SESSION['user_id'] = $obj->user_id($email);;

                header('Location: index.php');
                exit();
            }
            else{

                $warning = true;
                $message = "Email již existuje.";

            }
        }
        else{

            $warning = true;
            $message = "Nesprávný formát emailové schránky.";

        }
    }

}

?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <title>Přihlášení</title>
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

    <?php
    if ($warning){

        echo "<script type='text/javascript'>alert('$message');</script>";

    }
    ?>
    <script>
    function pt() {
        document.getElementById("lock").innerHTML = "Registrace";
        document.getElementById("method").setAttribute("value", "2");
        document.getElementById("buttonlogintoregister").innerHTML = "Registrovat";

        document.getElementById("footer-text").innerHTML = "Máte účet?";
        var span = document.createElement("span");
        span.setAttribute("class", "sign-up");
        span.setAttribute("onclick", "px()");
        span.setAttribute("id", "register");
        document.getElementById("footer-text").appendChild(span);
        document.getElementById("register").innerHTML = " Přihlašte se";



    }
function px() {
    document.getElementById("lock").innerHTML = "Přihlášení";
    document.getElementById("method").setAttribute("value", "1");
    document.getElementById("buttonlogintoregister").innerHTML = "Přihlásit";

    document.getElementById("footer-text").innerHTML = "Nemáte účet?";
    var span = document.createElement("span");
    span.setAttribute("class", "sign-up");
    span.setAttribute("onclick", "pt()");
    span.setAttribute("id", "register");
    document.getElementById("footer-text").appendChild(span);
    document.getElementById("register").innerHTML = " Zaregistrujte se";


}
</script>

<div class="box center" id="typewriter">

    <div id="header">
        <div id="cont-lock"><i class="material-icons lock" id="lock">Přihlášení</i></div>
        <div id="bottom-head"></div>
    </div>

    <form method="post">

        <div class="group">
            <input class="inputMaterial" name="email" type="email" required>
            <input style="display: none;" type="text" name="type" value="1" id="method" required>
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>E-mail</label>
        </div>

        <div class="group">
            <input class="inputMaterial" type="password" name="password" required>
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Heslo</label>
        </div>

        <div class="fb-login text-center"><?php echo '<a href="' . htmlspecialchars($loginUrl) . '">Přihlásit se přes Facebook</a>'; ?></div>
        <button id="buttonlogintoregister" type="submit">Přihlásit</button>

    </form>

    <div id="footer-box"><p class="footer-text" id="footer-text">Nemáte účet?<span class="sign-up" onclick="pt()" id="register"> Zaregistrujte se</span></p></div>

</div>


<div class="empty"></div>

</div>




<script src="release/js/main.js" async="" defer=""></script>

</body>
</html>