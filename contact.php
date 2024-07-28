<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // メールの送信先
    $to = "your-email@example.com";
    $subject = "お問い合わせフォームからのメッセージ";
    $body = "名前: $name\nメールアドレス: $email\nメッセージ:\n$message";
    $headers = "From: $email";

    // メールを送信
    if (mail($to, $subject, $body, $headers)) {
        echo "メッセージが送信されました。ありがとうございます！";
    } else {
        echo "メッセージの送信に失敗しました。後ほど再度お試しください。";
    }
}
?>
