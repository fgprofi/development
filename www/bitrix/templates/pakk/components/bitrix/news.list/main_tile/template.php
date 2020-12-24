<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
//echo "<pre>"; print_r($arResult["ITEMS"]); echo "</pre>";
?>
<div class="content">
    <div class="containered">
        <div class="nav__list">
            <?foreach($arResult["ITEMS"] as $item):?>
            <?$shadowClass = "";
            if($item["PROPERTIES"]["SHADOW"]["VALUE_XML_ID"]){
                $shadowClass = " ".$item["PROPERTIES"]["SHADOW"]["VALUE_XML_ID"];
            }
            ?>
            <a class="nav__item item-nav<?= $shadowClass ?> item-nav<?= $hoverClass ?>" href="<?= $item["PROPERTIES"]["LINK"]["VALUE"] ?>">
                <div class="item-nav__name">
                    <div class="item-nav__name_pic" style="background-image: url(<?= $item["PREVIEW_PICTURE"]["SRC"] ?>);"></div>
                    <?= $item["NAME"] ?>
                </div>
                <div class="item-nav__desc">
                    <?= $item["PREVIEW_TEXT"] ?>
                </div>
            </a>
            <?endforeach;?>
        </div>
    </div>
</div>