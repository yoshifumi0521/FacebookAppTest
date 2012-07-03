<?php

session_start();

//$_GET['code']がなかった時の処理。
if (empty($_GET['code'])) {
	
	// CSRF対策として、$_SESSION['state']に暗号化されたキーをいれる。
	$_SESSION['state'] = sha1(uniqid(mt_rand(), true));
    
	//パラメーターを渡す。
	$params = array(
		'client_id' => 'ここにAppId',
		'redirect_uri' => 'リダイレクトするurl',
		'state' => $_SESSION['state']
	 );
	$url = 'https://www.facebook.com/dialog/oauth?'.http_build_query($params);
	//$urlへ飛ばす。
	header('Location: '.$url);
	exit;
   
}
else
{
	// 認証されて帰ってきたときの処理。
	//リダイレクトして帰ってきた、 $_GET['state']と、$_SESSION['state']の一致を確認する。
	if ($_SESSION['state'] != $_GET['state'])
	{
		echo "危険！";
		exit;
	}
	
	//ここからユーザーの情報を取得する。
	$params = array(
		'client_id' => '431288256912010',
		'client_secret' => '09c341c5bc0e426d203287080fd10c2f',
		'code' => $_GET['code'],
		'redirect_uri' => 'http://localhost/local/Facebook/redirect.php'
	);
	
	//ここでアクセストークンをゲットする。
	$url = 'https://graph.facebook.com/oauth/access_token?'.http_build_query($params);
	$body = file_get_contents($url);
	parse_str($body);
	
	//ユーザー情報を取得する。$me変数にユーザー情報をいれる。
	$url = 'https://graph.facebook.com/me?access_token='.$access_token.'&fields=name,picture';
	$me = json_decode(file_get_contents($url));
	var_dump($me);
	exit;
	
	
	
	
	
    
	
	
}


?>

