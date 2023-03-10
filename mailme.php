<?php

header('Content-Type: application/json; charset=utf-8');
// header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
header("Access-Control-Allow-Origin: * ");
header('Access-Control-Allow-Credentials: false');
header('Access-Control-Allow-Method: POST,OPTIONS');
header('Access-Control-Max-Age: 86400');

if (isset($_POST['name'])) {
    // echo json_encode($_POST['name'], TRUE);

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: Portfolio Website' . "\r\n";
    // $headers .= 'Cc: myboss@example.com' . "\r\n";
    $body = '
    <h1>' . filter_var($_POST['subject'], FILTER_SANITIZE_STRING) . '</h1>
    <p>' . filter_var($_POST['message'], FILTER_SANITIZE_STRING) . '</p>

    <div>' . filter_var($_POST['name'], FILTER_SANITIZE_STRING) . '</div>
    <div><a href="mailto:' .filter_var($_POST['email'] , FILTER_SANITIZE_STRING) . '">' . filter_var($_POST['email'], FILTER_SANITIZE_STRING) . '</a> </div>
    <div><a href="tel:' . filter_var($_POST['phone'], FILTER_SANITIZE_STRING) . '">' . filter_var($_POST['phone'], FILTER_SANITIZE_STRING) . '</a> </div>
    ';
    mail("hi@heinsoe.com",  filter_var($_POST['name'], FILTER_SANITIZE_STRING) . ' sent from my portfolio', $body, $headers, "-f noreply@heinsoe.com");

    $reply = array("msg" => "ကျေးဇူးတင်ပါရေ မကြာခင်အကြောင်းပြန်ပီးပါမယ်");
    echo json_encode($reply, TRUE);
} else {
}

?>