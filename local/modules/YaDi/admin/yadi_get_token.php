<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/prolog.php");

require($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/prolog_admin_after.php");

//$this->addExternalJS("/local/js/jquery-3.3.1.min.js");
$APPLICATION->AddHeadScript('/local/js/jquery-3.3.1.min.js');

$APPLICATION->SetTitle("Получить oAuth Token");

require(__DIR__."/events.php");

require(__DIR__."/tabs/token_list.php");
?>

<form method="POST" action="<?=$APPLICATION->GetCurPageParam()?>" name="get_token_form" enctype="multipart/form-data">

<?
$arTabs = array(
  	array(
	  	"DIV" => "get_token_block",
	    "TAB" => "Получить токен",
	    "ICON" => "main_user_edit",
	    "TITLE" => "Получить oAuth token",
	    "CONTENT" => file_get_contents(__DIR__."/tabs/get_token.php")
	),
	array(
		"DIV" => "token_list",
	    "TAB" => "Список токенов",
	    "ICON" => "main_user_edit",
	    "TITLE" => "Список добавленных токенов",
	    "CONTENT" => token_list_html()
	)
);

$tabControl = new CAdminTabControl("tabControl", $arTabs);
$tabControl->Begin();
?>
</form>
<?
$tabControl->End();

require($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/epilog_admin.php");