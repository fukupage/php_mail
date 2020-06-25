<?php
ini_set('display_errors', 1);
session_start();

$mode = !empty($_POST['mode']) ? $_POST['mode'] :
$error = "";
$name = "";
$email = "";
$message = "";
$error = "";
$error_name = "";
$error_email = "";
$error_message = "";
$to = "";
$subject = "";
$msg = "";
$header = "";
$result = "";

if ($mode) {
  if (empty($_SESSION['token'] || $_SESSION['token'] != $_POST['token'])) {
    die('不正とは太ぇ野郎だ！　おめえ、ぶっころすぞ！！');
  } else {
    $name = htmlspecialchars($_POST['name']);
  }

  if (empty($_POST['email'])) {
    $error_email = 'メアド無しとは何事だ！　おめえ、ぶんなぐるぞ！！' . "\n";
  } else {
    $email = htmlspecialchars($_POST['email']);
  }

  if (empty($_POST['message'])) {
    $error_message = '本文なしとかふざけるな！！　おめえ、やっつけるぞ！！' . "\n";
  } else {
    $message = htmlspecialchars($_POST['message']);
  }

  if ($error_name || $error_email || $error_message) {
    $mode = 'input';
  }

  if ($mode == 'submit') {
session_destroy();

    $to = 'fukupage@gmail.com';
    $subject = 'お問い合わせがありました。';
    $msg = 'お名前：' . $name . "\n"
      . 'メールアドレス：' . $email . "\n"
      . '本文：' . $message . "\n";
    $header = 'From: sendonly@bowworks.biz';
    $result = mb_send_mail($to, $subject, $msg, $header);
    if ($result) {
      header('Location: thanks.html');
      exit();
    } else {
      $mode = 'error';
      $error = 'メール、送られへんかってんorz';
    }
  }
} else {
  $mode = 'input';
  $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>メールフォーム</title>
</head>

<body>
  <!-- 入力 -->
  <?php if ($mode == 'input'):  ?>
    <h1>メールフォームです</h1>
    <form action="index.php" method="POST">
      <input type="hidden" name="mode" value="confirm">
      <input type="hidden" name="token" value="<?php print $_SESSION['token']; ?>">
      <?php if ($error) : ?><p<strong><?php print nl2br($error); ?></strong></p><?php endif; ?>
        <?php if ($error_name) : ?><p><em><?php print $error_name; ?></em></p><?php endif; ?>
          <P>氏名：<input type="text" name="name" value="<?php print $name; ?>"></p>
          <?php if ($error_email) : ?><p><em><?php print $error_email; ?></em></p><?php endif; ?>
            <P>メールアドレス：<input type="text" name="email" value="<?php print $email; ?>"></p>
            <p>
              <?php if ($error_message) : ?><p><em><?php print $error_message; ?></em></p><?php endif; ?>
                <textarea name="message" cols="30" rows="10"><?php print $message; ?></textarea>
              </p>
              <P><button type="submit">送信</button></p>
            </form>
  <!-- 入力 -->
  <!-- 確認 -->
  <?php elseif ($mode == 'confirm'): ?>
    <h1>確認です</h1>
    <p>お名前<?php print $name; ?></p>
    <p>メールアドレス<?php print $email; ?></p>
    <p>メッセージ<?php print nl2br($message); ?></p>
    <form action="index.php" method="POST">
      <input type="hidden" name="mode" value="submit">
      <input type="hidden" name="token" value="<?php print $_SESSION['token']; ?>">
      <input type="hidden" name="name" value="<?php print $name; ?>">
      <input type="hidden" name="email" value="<?php print $email; ?>">
      <input type="hidden" name="message" value="<?php print $message; ?>">
        <P><button type="submit">送信</button></p>
    </form>

    <form action="index.php" method="POST">
      <input type="hidden" name="mode" value="input">
      <input type="hidden" name="token" value="<?php print $_SESSION['token']; ?>">
      <input type="hidden" name="name" value="<?php print $name; ?>">
      <input type="hidden" name="email" value="<?php print $email; ?>">
      <input type="hidden" name="message" value="<?php print $message; ?>">
        <P><button type="submit">戻る</button></p>
    </form>
  <?php else: ?>
    <p>エラーが発生したDEATH！！</p>
  <?php if($error):?><p><em><?php print $error; ?></em></p><?php endif; ?>
  <?php endif; ?>
  <!-- /確認 -->
</body>

</html>
