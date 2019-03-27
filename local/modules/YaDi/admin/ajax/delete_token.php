<?
define('NOT_CHECK_FILE_PERMISSIONS', true);
define('PUBLIC_AJAX_MODE', true);
define('NO_KEEP_STATISTIC', 'Y');
define('STOP_STATISTICS', true);
define('BX_SECURITY_SHOW_MESSAGE', true);

require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

\Bitrix\Main\Loader::includeModule('yadi');

$tokenID = $_POST['id'];

$yadi_db = new \YaDi\DataBase();
if($yadi_db->DeleteToken($tokenID)) {
	$response = ['code' => 1000, 'message' => 'Токен успешно удален'];
}
else {
	$response = ['code' => 1001, 'message' => 'Ошибка удаления'];
}
echo json_encode($response);