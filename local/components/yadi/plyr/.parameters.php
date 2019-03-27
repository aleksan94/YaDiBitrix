<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

\Bitrix\Main\Loader::includeModule('yadi');

$yadi_db = new \Yadi\DataBase();
$arTokenList = $yadi_db->GetTokenList();
foreach($arTokenList as $tokenData) {
	$value = $tokenData['token'];
	if(!empty($tokenData['name']) && ($tokenData['name'] != $tokenData['token'])) $value = $tokenData['token']." (".$tokenData['name'].")";
	$arTokens[$tokenData['token']] = $value;
}

$arComponentParameters = array(
	"GROUPS" => array(
		),
	"PARAMETERS" => array(
		"ADD_TOKEN" => array(
			'PARENT' => 'BASE',
			"NAME" => "Ссылка получения токена",
			"TYPE" => "CUSTOM",
			"JS_FILE" => "/local/components/YaDi/plyr/parameters.js",
			"JS_EVENT" => "GetToken"
		),
		"TOKEN" => array(
			"PARENT" => "BASE",
			"NAME" => "oAuth Token",
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"MULTIPLE" => "N",
			"VALUES" => $arTokens
		),
		/*"TOKEN" => array(
			"PARENT" => "BASE",
			"NAME" => "oAuth Token",
			"TYPE" => "STRING",
		),*/
		"LINK" => array(
			"PARENT" => "BASE",
			"NAME" => "Расшаренная ссылка на видео",
			"TYPE" => "STRING",
		),
	),
);
?>
