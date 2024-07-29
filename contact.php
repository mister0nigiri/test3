<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name1 = htmlspecialchars($_POST['name1']);
    $name2 = htmlspecialchars($_POST['name2']);
    $furigana1 = htmlspecialchars($_POST['furigana1']);
    $furigana2 = htmlspecialchars($_POST['furigana2']);
    $email = htmlspecialchars($_POST['email']);
    $tel = htmlspecialchars($_POST['tel']);
    $license = htmlspecialchars($_POST['license']);
    $textarea = htmlspecialchars($_POST['textarea']);

    // メールの送信先
    $to = "gongyongjunyou@gmail.com";
    $subject = "お問い合わせフォームからのメッセージ";
    $body = "名前: $name1 $name2\nフリガナ: $furigana1 $furigana2\nメールアドレス: $email\n電話番号: $tel\nお持ちの資格: $license\n備考:\n$textarea";
    $headers = "From: $email";

    // メールを送信
    if (mail($to, $subject, $body, $headers)) {
        echo "メッセージが送信されました。ありがとうございます！";
    } else {
        echo "メッセージの送信に失敗しました。後ほど再度お試しください。";
    }
}
?>
