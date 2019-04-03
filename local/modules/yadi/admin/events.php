<?
$ERRORS = [];
$SUCCESS;

if(isset($_POST['get_token_btn'])) {
	if(empty($_POST['CLIENT_ID'])) $ERRORS[] = "Не указано обязательное поле <b>CLIENT_ID</b>";
	if(empty($_POST['CLIENT_SECRET'])) $ERRORS[] = "Не указано обязательное поле <b>Client Secret</b>";

	if(empty($ERRORS)) {
		$url = 'https://oauth.yandex.ru/authorize';

		$clientID = trim($_POST['CLIENT_ID']);
		$clientSecret = trim($_POST['CLIENT_SECRET']);
		$tokenName = trim($_POST['TOKEN_NAME']);

		$_SESSION['YANDEX_OAUTH']['CLIENT_ID'] = $clientID;
		$_SESSION['YANDEX_OAUTH']['CLIENT_SECRET'] = $clientSecret;
		$_SESSION['YANDEX_OAUTH']['TOKEN_NAME'] = $tokenName;

		$params = array(
		    'response_type' => 'code',
		    'client_id'     => $clientID,
		    'display'       => 'popup',
		    'redirect_uri' => "http://".$_SERVER['SERVER_NAME']."/bitrix/admin/yadi_get_token.php"
		);

		header('Location: ' . $url . '?' . urldecode(http_build_query($params)));
	}
}
else if($_GET['code']) {
	$clientID = trim($_SESSION['YANDEX_OAUTH']['CLIENT_ID']);
	$clientSecret = trim($_SESSION['YANDEX_OAUTH']['CLIENT_SECRET']);
	$tokenName = trim($_SESSION['YANDEX_OAUTH']['TOKEN_NAME']);
	unset($_SESSION['YANDEX_OAUTH']['CLIENT_ID']);
	unset($_SESSION['YANDEX_OAUTH']['CLIENT_SECRET']);
	unset($_SESSION['YANDEX_OAUTH']['TOKEN_NAME']);

    $result = false;

    $params = array(
        'grant_type'    => 'authorization_code',
        'code'          => $_GET['code'],
        'client_id'     => $clientID,
        'client_secret' => $clientSecret
    );

    $url = 'https://oauth.yandex.ru/token';

    $curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	$result = curl_exec($curl);
	curl_close($curl);

	$tokenInfo = json_decode($result, true);

	if(!empty($tokenInfo['error'])) $ERRORS[] = "<b>".$tokenInfo['error'].".</b> ".$tokenInfo['error_description'];

	if(empty($ERRORS)) {
		$token = $tokenInfo['access_token'];

		\Bitrix\Main\Loader::includeModule('yadi');
		$yadi_db = new \YaDi\DataBase();
		$arTokens = $yadi_db->GetTokenList();
		foreach($arTokens as $value) {
			if($value['token'] == $token) {
				$ERRORS[] = "Токен <b>".$token."</b> уже существует в списке токенов";
				break;
			}
		}

		if(empty($ERRORS)) {
			$yadi_db->AddToken($token, $tokenName);
			header('Location: '.$_SERVER['PHP_SELF'].'?'.urldecode(http_build_query(['token' => $token])));
		}
	}
}
else if($_GET['token']) {
	$token = trim($_GET['token']);
	$SUCCESS = ['TITLE' => 'Токен получен', 'MESSAGE' => 'Ваш токен: <b>'.$token.'</b></br>успешно добавлен в список токенов'];
}

if(!empty($ERRORS)) {
	$message = new CAdminMessage(['MESSAGE' => 'Ошибка', 'TYPE' => 'ERROR', 'DETAILS' => implode("<br/>", $ERRORS), 'HTML' => true]);
	echo $message->Show();
}
else if(!empty($SUCCESS)) {
	$message = new CAdminMessage(['MESSAGE' => $SUCCESS['TITLE'], 'TYPE' => 'OK', 'DETAILS' => $SUCCESS['MESSAGE'], 'HTML' => true]);
	echo $message->Show();
}