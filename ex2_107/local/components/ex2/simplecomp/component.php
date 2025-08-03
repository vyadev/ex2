<?

// в [ex2-71] не задана реализация в параметрах шаблона ссылки на детальную, поэтому здесь простой DETAIL_PAGE_URL

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader,
	Bitrix\Iblock;

if(!Loader::includeModule("iblock"))
{
	ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
	return;
}


if (!isset($arParams["CACHE_TIME"])) {
	$arParams["CACHE_TIME"] = 36000000;
}

if (!isset($arParams["CLASSIFIER_IBLOCK_ID"])) { 
	$arParams["CLASSIFIER_IBLOCK_ID"] = 0;
}

if (!isset($arParams["PRODUCTS_IBLOCK_ID"])) { 
	$arParams["PRODUCTS_IBLOCK_ID"] = 0;
}

if (!isset($arParams["PRODUCTS_PROPERTY"])) { 
	$arParams["PRODUCTS_PROPERTY"] = trim($arParams["PRODUCTS_PROPERTY"]);
}


global $USER;

if ($this->StartResultCache(false, array($USER->GetGroups()))) {

	//Получим список классификаторов
	$rsElements = CIBlockElement::GetList(
		Array(),
		Array(
			"IBLOCK_ID" => $arParams["CLASSIFIER_IBLOCK_ID"],
			"ACTIVE" => "Y",
			"CHECK_PERMISSIONS" => $arParams["CACHE_GROUPS"],
		),
		false,
		false,
		Array(
		 	"IBLOCK_ID", 
		 	"ID",
		 	"NAME",
	 	)
	);

	$arClassif = array();
	$arClassifId = array();

	$arResult["COUNT"] = array();

	while ($arElement = $rsElements->Fetch()) {
		$arClassifId[] = $arElement["ID"];
		$arClassif[$arElement["ID"]] = $arElement;
	}

	$arResult["COUNT"] = count($arClassifId);


	//Получаем список элементов с привязками к классификатору
	$arSelect = array(
		 	"IBLOCK_ID", 
		 	"ID",
		 	"NAME",
		 	"PROPERTY_". $arParams["PRODUCTS_PROPERTY"],
		 	"PROPERTY_PRICE",
		 	"PROPERTY_ARTNUMBER",
		 	"PROPERTY_MATERIAL",
		 	"DETAIL_PAGE_URL",
	);

	$arFilter = array(
			"IBLOCK_ID" => $arParams["PRODUCTS_IBLOCK_ID"],
			"ACTIVE" => "Y",
			"CHECK_PERMISSIONS" => $arParams["CACHE_GROUPS"],
			"PROPERTY_". $arParams["PRODUCTS_PROPERTY"] => $arClassifId,
	);

	$rsElements = CIBlockElement::GetList(
		array(
			"NAME" => "asc",
			"SORT" => "asc",
		),
		$arFilter,
		false,
		false,
		$arSelect
	);

	$arResult["CLASSIF"] = array();
	
	while ($arElement = $rsElements->GetNext()) {
		$arClassif[$arElement["PROPERTY_FIRM_VALUE"]]["ELEMENTS"][$arElement["ID"]] = $arElement;		
	}
	
	$arResult["CLASSIF"] = $arClassif;

	$this->SetResultCacheKeys(array("COUNT"));

	$this->includeComponentTemplate();	

} else {
	$this->AbortResultCache();
}

	$APPLICATION->SetTitle(GetMessage("SIMPLECOMP_EXAM2_COUNT"). $arResult["COUNT"]);
?>