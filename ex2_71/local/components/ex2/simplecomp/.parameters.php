<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
	"PARAMETERS" => array(
		"PRODUCTS_IBLOCK_ID" => array(
			"NAME" => GetMessage("SIMPLECOMP_EXAM2_CAT_IBLOCK_ID"),
			"PARENT" => "BASE",
			"TYPE" => "STRING",
		),
		"CLASSIFIER_IBLOCK_ID" => array(
			"NAME" => GetMessage("SIMPLECOMP_EXAM2_CLASSIFIER_IBLOCK_ID"),
			"PARENT" => "BASE",
			"TYPE" => "STRING",
		),
		"PRODUCTS_DETAIL_TEMPLATE" => array(
			"NAME" => GetMessage("SIMPLECOMP_EXAM2_CAT_TEMPLATE"),
			"PARENT" => "BASE",
			"TYPE" => "STRING",
		),
		"PRODUCTS_PROPERTY" => array(
			"NAME" => GetMessage("SIMPLECOMP_EXAM2_CAT_PROPERTY"),
			"PARENT" => "BASE",
			"TYPE" => "STRING",
		),
		"CACHE_TIME"  =>  array("DEFAULT" => 36000000),
		"CACHE_GROUPS" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => GetMessage("SIMPLECOMP_EXAM2_CACHE_GROUPS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
	),
);