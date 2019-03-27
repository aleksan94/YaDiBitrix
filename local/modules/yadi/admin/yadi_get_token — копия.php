<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/prolog.php");

require($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/prolog_admin_after.php");

$APPLICATION->SetTitle("Получить oAuth Token");
?>

<form method="POST" action="<?=$APPLICATION->GetCurPageParam()?>" name="get_token" enctype="multipart/form-data">

<?ob_start();?>
<center><h3>Параметры Yandex oAuth</h3></center>	
<tr>
	<td width="40%">Client ID</td>
	<td width="60%"><input type="text" name="CLIENT_ID"></td>
</tr>
<tr>
	<td width="40%">Client Secret</td>
	<td width="60%"><input type="text" name="CLIENT_SECRET"></td>
</tr>
<tr>
	<td>
		<input type="button" value="Получить токен" id="test_start" onclick="" class="adm-btn-green">
	</td>
</tr>
<?
$content = ob_get_contents();
ob_end_clean();

$arTabs = array(
  	array(
	  	"DIV" => "get_token",
	    "TAB" => "Получить токен",
	    "ICON" => "main_user_edit",
	    "TITLE" => "Получить oAuth token",
	    "CONTENT" => $content
	),
	array(
		"DIV" => "token_list",
	    "TAB" => "Список токенов",
	    "ICON" => "main_user_edit",
	    "TITLE" => "Получить добавленных токенов",
	    "CONTENT" => $content
	)
);

$tabControl = new CAdminTabControl("tabControl", $arTabs);
$tabControl->Begin();
/*$tabControl->Buttons(array(
  "back_url" => $_REQUEST["back_url"],
  "btnApply" => false, // не показывать кнопку применить
  "btnSave" => false,  // не показывать кнопку сохранить
));*/
?>
<!-- <input class="mybutton" type="submit" name="save" value="Нажми меня!!!! ;-)" title="Моя кнопка для сохранения" /> -->
</form>
<?
$tabControl->End();
//echo "<pre>";print_r(get_class_methods($tabControl));echo "</pre>";

require($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/epilog_admin.php");