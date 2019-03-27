<?
namespace YaDi;
/**
 * 
 */
class DataBase
{
	private $dataBaseName = 'yadi_oauth_token';

	public function CheckTable()
	{
		global $DB;
		$sql = "
			CREATE TABLE IF NOT EXISTS $this->dataBaseName (
				`id` INT(11) NOT NULL AUTO_INCREMENT,
				`name` TEXT NOT NULL,
				`token` TEXT NOT NULL,
				PRIMARY KEY(`id`) 
			)
		";
		return $DB->Query($sql);
	}

	public function ShowColumns()
	{
		global $DB;
		$sql = "
			SHOW COLUMNS FROM $this->dataBaseName
		";
		$res = $DB->Query($sql);
		while($row = $res->Fetch()) {
			$columns[] = $row;
		}
		return $columns;
	}

	public function DropTable()
	{
		global $DB;
		$sql = "
			DROP TABLE $this->dataBaseName
		";
		return $DB->Query($sql);		
	}

	public function GetTokenList()
	{
		global $DB;
		$sql = "
			SELECT * FROM $this->dataBaseName
		";
		$res = $DB->Query($sql);
		while($row = $res->Fetch()) {
			$arResult[] = $row;
		}
		return $arResult;
	}

	public function AddToken($token, $name = false)
	{
		try {
			if(empty($token)) throw new \Exception("Не указан токен", 1001);			
		} catch (\Exception $e) {
			die($e);
		}

		global $DB;

		if(empty($name)) $name = $token;

		$sql = "
			INSERT INTO $this->dataBaseName (token, name) VALUES ('$token', '$name')
		";
		return $DB->Query($sql);
	}

	public function DeleteToken($tokenID)
	{
		try {
			if(empty($tokenID)) throw new \Exception("Не указан ID токена", 1002);	
		} catch (\Exception $e) {
			die($e);
		}

		global $DB;

		$sql = "
			DELETE FROM $this->dataBaseName WHERE id = $tokenID
		";
		return $DB->Query($sql);
	}
}