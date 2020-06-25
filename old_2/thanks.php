<?php ini_set('display_errors', 1); ?>
<?php
$error = '';
$name = '';
$email = '';
$message = '';
$to = '';
$subject = '';
$msg = '';
$header = '';
$result = '';

if (empty($_POST['name'])) {
  $error = 'おめえ、ぶっころすぞ'."\n";
} else {
  $name = htmlspecialchars($_POST['name']);
}

if (empty($_POST['email'])) {
  $error .= 'おめえ、なかすぞ'."\n";
} else {
  $email .= htmlspecialchars($_POST['email']);
}

if (empty($_POST['message'])) {
  $error .= '日本語でおk'."\n";
} else {
  $message = htmlspecialchars($_POST['message']);
}

if ($error) {
  $msg = 'メール、送られへんかってんorz';
  header('Location: index.html');
  exit();
  } else {
    $to = 'fukupage@gmail.com';
    $subject = 'お問い合わせがありました。';
    $msg = 'お名前：' . $name . "\n"
      . 'メールアドレス：' . $email . "\n"
      . '本文：' . $message . "\n";
    $header = 'From: sendonly@bowworks.biz';
    $result = mb_send_mail($to, $subject, $msg, $header);
    if (isset($result)) {
      $msg = 'メール、送っといたでー';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ありがとうございました！</title>
</head>

<body>
  <?php if ($error) : ?>
    <p<strong><?php print nl2br($error); ?><?php print $error ?></strong></p>
    <?php else : ?>
      <h1>ありがとうございました！</h1>
      <p><strong><?php print $msg; ?></strong></p>
      <p>お名前：<?php print $name; ?></p>
      <p>メールアドレス：<?php print $email; ?></p>
      <p>本文：<?php print nl2br($message); ?></p>
    <?php endif; ?>
</body>

</html>
