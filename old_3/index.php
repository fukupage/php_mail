<?php
$namae = "";
$email = "";
$honbun = "";
$error = "";
$error_namae = "";
$error_email = "";
$error_honbun = "";

if (isset($_POST['namae'])) {
    if (empty($_POST['namae'])) {
        $error_namae = "お名前を入力してください\n";
    } else {
        $namae = htmlspecialchars($_POST['namae']);
    }
    if (empty($_POST['email'])) {
        $error_email = "メールアドレスを入力してください\n";
    } else {
        $email = htmlspecialchars($_POST['email']);
    }
    if (empty($_POST['honbun'])) {
        $error_honbun = "本文を入力してください\n";
    } else {
        $honbun = htmlspecialchars($_POST['honbun']);
    }

    if (!$error_namae && !$error_email && !$error_honbun) {
        $to = 'yourmail@example.com';
        $subject = 'お問合せがありました';
        $message = 'お名前：' . $namae . "\n"
                . 'メールアドレス：' . $email . "\n"
                . '本文：' . $honbun . "\n";
        $header = 'From: sendonly@example.com';
        $result = mb_send_mail($to, $subject, $message, $header);

        if ($result) {
            header('Location: http://your-domain/thanks.html');
            exit;
        } else {
            $error = 'メール送信に失敗しました';
        }
    }
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>index.php</title>
</head>
<body>

<form action="index.php" method="post">
    <?php if ($error): ?><p><em><?php echo $error; ?></em></p><?php endif; ?>

    <?php if ($error_namae): ?><p><em><?php echo $error_namae; ?></em></p><?php endif; ?>
    <p>お名前：<input type="text" name="namae" value="<?php echo $namae; ?>"></p>
    <?php if ($error_email): ?><p><em><?php echo $error_email; ?></em></p><?php endif; ?>
    <p>メールアドレス：<input type="email" name="email" value="<?php echo $email; ?>"></p>
    <?php if ($error_honbun): ?><p><em><?php echo $error_honbun; ?></em></p><?php endif; ?>
    <p>本文：<textarea name="honbun" cols="50" rows="10"><?php echo $honbun; ?></textarea></p>
    <p><button type="submit">送信</button></p>
</form>

</body>
</html>
