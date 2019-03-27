<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$seek = (int)$_REQUEST['bytes'];
$speed = (int)$_REQUEST['speed'];
$fileSize = (int)$_REQUEST['fileSize'];
$fileName = $_REQUEST['fileName'];

$file = dirname(__DIR__)."/assets/videoplayback.webm";
if(empty($fileSize)) $fileSize = filesize($file);
$fp = fopen($file, 'r');
if($seek > 0) fseek($fp, $seek);
$data = fread($fp, $speed);
fclose($fp);

if(empty($fileName)) $fileName = randString();
$fp = fopen(dirname(__DIR__)."/assets/".$fileName, 'a');
$bytes = fwrite($fp, $data);
fclose($fp);

$response['bytes'] = $bytes;
$response['fileName'] = $fileName;
$response['fileSize'] = $fileSize;

echo json_encode($response);