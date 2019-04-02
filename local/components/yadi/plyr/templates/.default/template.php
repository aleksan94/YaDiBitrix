<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//$APPLICATION->AddHeadScript("/local/js/jquery-3.3.1.min.js");
CJSCore::Init(array("jquery"));

$this->addExternalCss("/local/css/plyr.css");
//$this->addExternalJS("/local/js/jquery-3.3.1.min.js");
$this->addExternalJS("/local/js/plyr.min.js");

?>

<!-- <script type="text/javascript" src="/local/js/jquery-3.3.1.min.js"></script> -->

<div class="plyr-player-video-container">
	<video class="plyr-player-video" token="<?=trim($arParams['TOKEN'])?>" media-link="<?=trim($arParams['LINK'])?>" plyr-id="<?=randString()?>"></video>
</div>

