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
        CopyDirFiles(__DIR__."/files/", $_SERVER['DOCUMENT_ROOT'], true, true);
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
        unlink($_SERVER['DOCUMENT_ROOT']."/local/css/plyr.css");
        if(count(scandir($_SERVER['DOCUMENT_ROOT']."/local/css/")) === 2) rmdir($_SERVER['DOCUMENT_ROOT']."/local/css/");        
        unlink($_SERVER['DOCUMENT_ROOT']."/local/js/jquery-3.3.1.min.js");
        unlink($_SERVER['DOCUMENT_ROOT']."/local/js/plyr.min.js");
        unlink($_SERVER['DOCUMENT_ROOT']."/local/js/plyr.polyfilled.min.js");
        if(count(scandir($_SERVER['DOCUMENT_ROOT']."/local/js/")) === 2) rmdir($_SERVER['DOCUMENT_ROOT']."/local/js/");
        DeleteDirFilesEx("/local/components/yadi");
        // удаляем таблицу
        require(dirname(__DIR__)."/classes/db.php");
        $yadi_db = new \YaDi\DataBase();
        $yadi_db->DropTable();
        // удаляем модуль
        UnRegisterModule($this->MODULE_ID);
    }
}