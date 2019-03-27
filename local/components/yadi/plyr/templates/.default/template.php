<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->addExternalCss("/local/css/plyr.css");
$this->addExternalJS("/local/js/jquery-3.3.1.min.js");
$this->addExternalJS("/local/js/plyr.min.js");

?>

<video class="plyr-player-video" token="<?=trim($arParams['TOKEN'])?>" media-link="<?=trim($arParams['LINK'])?>" plyr-id="<?=randString()?>"></video>

