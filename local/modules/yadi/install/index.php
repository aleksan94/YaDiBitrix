<?
/**
 * 
 */
class yadi extends CModule
{
	public $MODULE_ID = "yadi";
    public $MODULE_NAME = "YaDi";
	public $MODULE_VERSION = '1.0';
  	public $MODULE_VERSION_DATE = '2019-03-13';

	public function DoInstall()
    {
        // копируем файл админки
        copy(__DIR__."/files/yadi_get_token.php", $_SERVER['DOCUMENT_ROOT']."/bitrix/admin/yadi_get_token.php");
        // добавляем таблицу  
        require(dirname(__DIR__)."/classes/db.php");
        $yadi_db = new \YaDi\DataBase();
        $yadi_db->CheckTable();
        // регистрируем модуль
        RegisterModule($this->MODULE_ID);
    }

    public function DoUninstall()
    {
        // удаляем файл админки
        unlink($_SERVER['DOCUMENT_ROOT']."/bitrix/admin/yadi_get_token.php");
        // даляем таблицу
        require(dirname(__DIR__)."/classes/db.php");
        $yadi_db = new \YaDi\DataBase();
        $yadi_db->DropTable();
        // удаляем модуль
        UnRegisterModule($this->MODULE_ID);
    }
}