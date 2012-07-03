<?php

session_start();

//セッションがなかったら、login.phpに送る処理。
if (empty($_SESSION['user'])) 
{
	//login.phpに飛ばす。
	header('Location: login.php');
	//以下の処理は行わないように、exitする。
    exit;
}





?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ホーム画面</title>
</head>
<body>


</body>
</html>








