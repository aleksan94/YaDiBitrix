<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => "YaDi Plyr",
	"DESCRIPTION" => "Yandex disk media player",
	"ICON" => "/images/cat_all.gif",
	"CACHE_PATH" => "Y",
	"SORT" => 999999,
	"PATH" => array(
		"ID" => "custom",
		"NAME" => "Custom",
		"CHILD" => array(
			"ID" => "yadi",
			"NAME" => "YaDi",
			"SORT" => 999999,
		)
	),
);

?>