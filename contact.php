<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name1 = htmlspecialchars($_POST['name1']);
    $name2 = htmlspecialchars($_POST['name2']);
    $furigana1 = htmlspecialchars($_POST['furigana1']);
    $furigana2 = htmlspecialchars($_POST['furigana2']);
    $email = htmlspecialchars($_POST['email']);
    $tel = htmlspecialchars($_POST['tel']);
    $license1 = htmlspecialchars($_POST['license1']);
    $license2 = htmlspecialchars($_POST['license2']);
    $textarea = htmlspecialchars($_POST['textarea']);

    // メールの送信先
    $to = "info@skypleasure.co.jp";
    $subject = "=?UTF-8?B?" . base64_encode("サンズ訪問介護ステーションお問い合わせフォームからのメッセージ") . "?=";
    $body = "
    新しいお問い合わせがありました。\n
    -----------------------\n
    お名前: $name1 $name2\n
    フリガナ: $furigana1 $furigana2\n
    メールアドレス: $email\n
    電話番号: $tel\n
    お持ちの資格: $license1 $license2\n
    備考:\n
    $textarea\n
    -----------------------\n
    ";
    
    $headers = "From: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $headers .= "Content-Transfer-Encoding: 8bit\r\n";

    // 管理者へのメールを送信
    if (mail($to, $subject, $body, $headers)) {

        // 自動返信メールの設定
        $autoReplySubject = "=?UTF-8?B?" . base64_encode("お問い合わせありがとうございます") . "?=";
        $autoReplyBody = "
        $name1 $name2 様\n
        お問い合わせありがとうございます。以下の内容でお問い合わせを受け付けました。\n
        -----------------------\n
        名前: $name1 $name2\n
        フリガナ: $furigana1 $furigana2\n
        メールアドレス: $email\n
        電話番号: $tel\n
        お持ちの資格: $license1 $license2\n
        備考:\n$textarea\n
        -----------------------\n
        追って担当者よりご連絡いたします。\n
        ";

        // 日本語をエンコードしたFromヘッダー
        $encodedFromName = "=?UTF-8?B?" . base64_encode("サンズ訪問介護ステーション") . "?=";
        $autoReplyHeaders = "From: $encodedFromName <no-reply@example.com>\r\n";
        $autoReplyHeaders .= "Reply-To: no-reply@example.com\r\n";
        $autoReplyHeaders .= "MIME-Version: 1.0\r\n";
        $autoReplyHeaders .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $autoReplyHeaders .= "Content-Transfer-Encoding: 8bit\r\n";

        // 自動返信メールを送信
        mail($email, $autoReplySubject, $autoReplyBody, $autoReplyHeaders);

        // メール送信成功後にサンクスページにリダイレクト
        header("Location: thanks.html");
        exit;
    } else {
        echo "メッセージの送信に失敗しました。後ほど再度お試しください。";
    }
} else {
    echo "不正なアクセスです。";
}
?>
