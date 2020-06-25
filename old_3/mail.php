<?php ini_set('display_errors', 1); ?>
<?php
$error = "";
$name = "";
$email = "";
$message = "";
$error_name = "";
$error_email = "";
$error_message = "";
$to = "";
$subject = "";
$msg = "";
$header = "";
$result = "";
if(isset($_POST['name'])){
  if(empty($_POST['name'])){
    $error_name = '名無しとは何事だ！　おめえ、ぶっころすぞ！！'."\n";
  } else {
    $name = htmlspecialchars($_POST['name']);
  }

  if(empty($_POST['email'])){
    $error_email = 'メアド無しとは何事だ！　おめえ、ぶんなぐるぞ！！'."\n";
  } else {
    $email = htmlspecialchars($_POST['email']);
  }

  if(empty($_POST['message'])){
    $error_message = '本文なしとかふざけるな！！　おめえ、やっつけるぞ！！'."\n";
  } else {
    $message = htmlspecialchars($_POST['message']);
  }

  if(!$error_name && !$error_email && !$error_message){
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
      $error = 'メール、送られへんかってんorz';
    }
  }
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
  <h1>メールフォームです</h1>
  <form action="mail.php" method="POST">
  <?php if($error):?><p<strong><?php print nl2br($error); ?></strong></p><?php endif; ?>
  <?php if($error_name):?><p><em><?php print $error_name; ?></em></p><?php endif; ?>
    <P>氏名：<input type="text" name="name" value="<?php print $name; ?>"></p>
  <?php if($error_email):?><p><em><?php print $error_email; ?></em></p><?php endif; ?>
    <P>メールアドレス：<input type="text" name="email" value="<?php print $email; ?>"></p>
    <p>
      <?php if($error_message):?><p><em><?php print $error_message; ?></em></p><?php endif; ?>
      <textarea name="message" cols="30" rows="10"><?php print $message; ?></textarea>
    </p>
    <P><button type="submit">送信</button></p>
  </form>
</body>

</html>
