<?

AddEventHandler("main", "OnBeforeProlog", "OnBeforePrologHandler");

function OnBeforePrologHandler()
{
    global $APPLICATION;
    $curPage = $APPLICATION->GetCurPage();

    if (CModule::IncludeModule("iblock")) {
        $arFilter = array(
          "IBLOCK_ID" => 6, // здесь ID инфоблока с метатегами
          "NAME" => $curPage,
        );
        $arSelect = array("IBLOCK_ID", "ID", "PROPERTY_TITLE", "PROPERTY_DESCRIPTION");

        $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);

        if ($arRes = $res->Fetch()) {
            $APPLICATION->SetPageProperty("title", $arRes["PROPERTY_TITLE_VALUE"]);
            $APPLICATION->SetPageProperty("description", $arRes["PROPERTY_DESCRIPTION_VALUE"]);
        }
    }
}
