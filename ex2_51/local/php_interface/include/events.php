<?

AddEventHandler("main", "OnBeforeEventAdd", "OnBeforeEventAddHandler");

function OnBeforeEventAddHandler(&$event, &$lid, &$arFields)
{
    if ($event == "FEEDBACK_FORM") {
        global $USER;
        if ($USER->IsAuthorized()) {
            $arFields["AUTHOR"] = GetMessage("AUTH_USER", array(
              "#ID#" => $USER->GetID(),
              "#LOGIN#" => $USER->GetLogin(),
              "#NAME#" => $USER->GetFullName(),
              "#NAME_FROM_FORM#" => $arFields["AUTHOR"],
            ));
        } else {
            $arFields["AUTHOR"] = GetMessage("NO_AUTH_USER", array(
              "#NAME_FROM_FORM#" => $arFields["AUTHOR"],
            ));
        }
    }

    CEventLog::Add(array(
      "SEVERITY" => "SECURITY",
      "AUDIT_TYPE_ID" => GetMessage("REPLACEMENT"),
      "MODULE_ID" => "main",
      "ITEM_ID" => $event,
      "DESCRIPTION" => GetMessage("REPLACEMENT")."-".$arFields["AUTHOR"],
    ));
}
