<?php ini_set('display_errors', 1); ?>
<?php
$name = isset($_POST['name'])? htmlspecialchars($_POST['name']):'おめえ、ぶっころすぞ';
$age = isset($_POST['age'])? htmlspecialchars($_POST['age']):'おめえ、ぶっつぶすぞ';

// if (isset($_POST['name'])) {
//   $name = htmlspecialchars($_POST['name']);
// } else {
//   $name = 'おめえ、ぶっころすぞ';
// }

// if (isset($_POST['age'])) {
//   $age = htmlspecialchars($_POST['age']);
// } else {
//   $age = 'おめえ、ぶっつぶすぞ';
// }

if (isset($_POST['gender'])) {
  $gender = htmlspecialchars($_POST['gender']);
  if($gender === 'male'){
    $gender = '男性';
  } else {
    $gender = '女性';
  }
} else {
  $age = '両性具有';
}

if (isset($_POST['address'])) {
  $addr = htmlspecialchars($_POST['address']);
  switch ($addr) {
    case '':
      $address = '空白でした…。';
      break;
    case 'sapporo':
      $address = '札幌';
      break;
    case 'sendai':
      $address = '仙台';
      break;
    case 'tokyo':
      $address = '東京';
      break;
    case 'nagoya':
      $address = '名古屋';
      break;
    case 'osaka':
      $address = '大阪';
      break;
    case 'hakata':
      $address = '博多';
      break;
    case 'other':
      $address = '住所不定';
      break;
    default:
      $address = '住所不明';
  }
} else {
  $address = 'この宿無しめ';
}
$message = isset($_POST['message'])? htmlspecialchars($_POST['message']):'日本語でおk';

$to = 'fukupage@gmail.com';
$subject = 'お問い合わせがありました。';
$msg = 'お名前：'.$name . "\n"
 . '年齢：'. $age . "\n"
 . '性別：'. $gender . "\n"
 . '住所：'. $address . "\n"
 . '本文：'. $message . "\n";
 $header = 'From: sendonly@bowworks.biz';
 $result = mb_send_mail($to,$subject,$msg,$header);
if(isset($result)){
  $msg = 'メール、送っといたでー';
} else{
  $msg = 'メール、送られへんかってんorz';
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
  <h1>ありがとうございました！</h1>
  <p><strong><?php print $msg; ?></strong></p>
  <p>お名前：<?php print $name; ?></p>
  <p>年齢：<?php print $age; ?></p>
  <p>性別：<?php print $gender; ?></p>
  <p>住所：<?php print $address; ?></p>
  <p>本文：<?php print nl2br($message); ?></p>
</body>

</html>
