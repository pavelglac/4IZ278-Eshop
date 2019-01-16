<?php

if (!session_id()) {
    session_start();
}

require_once __DIR__ . '/php-graph-sdk-5.x/src/Facebook/autoload.php';

$fb = new Facebook\Facebook([
    'app_id' => '214121056038706', // TODO Replace {app-id} with your app-id
    'app_secret' => 'ee395d44e09e27ef3556383bc0ef541c', // TODO Replace {app-secret} with your app-secret
    'default_graph_version' => 'v2.10',
]);




$helper = $fb->getRedirectLoginHelper();

if (isset($_GET['state'])) {
    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
}

try {
    $accessToken = $helper->getAccessToken();
    $response = $fb->get('/me?fields=id,email', "$accessToken");
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (! isset($accessToken)) {
    if ($helper->getError()) {
        header('HTTP/1.0 401 Unauthorized');
        echo "Error: " . $helper->getError() . "\n";
        echo "Error Code: " . $helper->getErrorCode() . "\n";
        echo "Error Reason: " . $helper->getErrorReason() . "\n";
        echo "Error Description: " . $helper->getErrorDescription() . "\n";
    } else {
        header('HTTP/1.0 400 Bad Request');
        echo 'Bad request';
    }
    exit;
}

// Logged in
$user = $response->getGraphUser();

$email =$user['email'];
$password =$user['id'];
echo "$password";

require_once 'controllers/db_users.php';
$obj = new DB_users();

if ($obj->email_exist($email)){

    $existing_user = $obj->user_data($email);

    if (password_verify($password, $existing_user["password"])) {

        $_SESSION['user_id'] = $existing_user["id"];

        header('Location: index.php');
        exit();
    }else{

        die("Cyhba při přihlášení");

    }
}else{

    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $obj->user_insert($email, $hashed);

    $_SESSION['user_id'] = $obj->user_id($email);;

    header('Location: index.php');
    exit();
}

// You can redirect them to a members-only page.
//header('Location: https://example.com/members.php');