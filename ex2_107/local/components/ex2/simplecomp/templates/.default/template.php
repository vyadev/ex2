<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?=GetMessage("TIME")?><?echo time();?>

<?if (count($arResult["CLASSIF"]) > 0):?>
	<ul>
		<?foreach ($arResult["CLASSIF"] as $arClassif):?>
			<li><b><?=$arClassif["NAME"]?></b></li>

			<?if (count($arClassif["ELEMENTS"]) > 0):?>
				<ul>
					<?foreach ($arClassif["ELEMENTS"] as $arElem):?>
						<li>
							<?=$arElem["NAME"]?> - 
							<?=$arElem["PROPERTY_PRICE_VALUE"]?> - 
							<?=$arElem["PROPERTY_MATERIAL_VALUE"]?> - 
							<?=$arElem["PROPERTY_ARTNUMBER_VALUE"]?>
						 	<a href="<?=$arElem["DETAIL_PAGE_URL"]?>">ссылка на детальный просмотр</a>
						</li>
					<?endforeach?>
				</ul>
			<?endif?>
		<?endforeach?>
	</ul>
<?endif?>