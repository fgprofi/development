<? if ( ! defined( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true ) {
	die();
}
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
$this->setFrameMode( true );
$filePhoto["src"] = "/bitrix/templates/pakk/img/avatar.svg";
if ( isset( $arResult["PROPERTIES"]["PHOTO"]["VALUE"] ) && $arResult["PROPERTIES"]["PHOTO"]["VALUE"] != "" ) {
	$filePhoto = CFile::ResizeImageGet( $arResult["PROPERTIES"]["PHOTO"]["VALUE"], array( 'width'  => 160,
	                                                                                      'height' => 160
	), BX_RESIZE_IMAGE_EXACT, true );
}
$surName    = "";
$middleName = "";
if ( isset( $arResult["PROPERTIES"]["SURNAME"]["VALUE"] ) && $arResult["PROPERTIES"]["SURNAME"]["VALUE"] != "" ) {
	$surName = $arResult["PROPERTIES"]["SURNAME"]["VALUE"];
}
if ( isset( $arResult["PROPERTIES"]["MIDDLENAME"]["VALUE"] ) && $arResult["PROPERTIES"]["MIDDLENAME"]["VALUE"] != "" ) {
	$middleName = $arResult["PROPERTIES"]["MIDDLENAME"]["VALUE"];
}
if ( isset( $arResult["PROPERTIES"]["FIRST_NAME"]["VALUE"] ) && $arResult["PROPERTIES"]["FIRST_NAME"]["VALUE"] != "" ) {
	$first_name = $arResult["PROPERTIES"]["FIRST_NAME"]["VALUE"];
}
$fullName = $surName . ' ' . $first_name . ' ' . $middleName;
$typeFace = "Юридическое лицо";
if ( $arParams["IBLOCK_ID"] == 7 ) {
	$typeFace = "Физическое лицо";
} ?>
    <main class="main">

        <div class="content">
            <div class="containered">
                <?if(!isAdministrator()):?>
                <div class="sidebar">
                    <div class="sidebar__name">Мой профиль</div>
                    <ul class="sidebar__list">
                        <li class="sidebar__item">
                            <a class="sidebar__link drop-login__menu-item_feedback"
                               href="#">Обратная связь</a>
                        </li>
                        <li class="sidebar__item">
                            <a class="sidebar__link logout_href"
                               href="">Выход</a>
                        </li>
                    </ul>
                </div>
                <?else:?>
                    <div class="sidebar">
                        <div class="sidebar__name">Модерация</div>
                        <ul class="sidebar__list">
                            <li class="sidebar__item">
                                <a class="sidebar__link"
                                   href="/admin/">Пользователи</a>
                            </li>
                            <li class="sidebar__item f_need_moderation">
                                <a class="sidebar__link"
                                   href="/admin/queries_f/">Запросы физ.лица</a>
                            </li>
                            <li class="sidebar__item u_need_moderation">
                                <a class="sidebar__link"
                                   href="/admin/queries_u/">Запросы юр.лица</a>
                            </li>
                            <li class="sidebar__item">
                                <a class="sidebar__link logout_href" >Выход</a>
                            </li>
                        </ul>
                    </div>
                <?endif;?>
                <div class="account">
                    <div class="account__info">
                        <p class="account__name"><?= $fullName ?></p>
                        <p class="account__identifier">
                            <span class="account__id">ID: <?= $arResult["ID"] ?></span>
                            <span class="account__status"><?= $typeFace ?></span>
                        </p>
	                    <? if ($arResult["FIELDS"]['ACTIVE'] == "Y" || isAdministrator()): ?>
                            <a class="account__btn btn" href="/personal/edit/?id=<?= base64_encode($arResult[PROPERTIES][USER_ID][VALUE]) ?>">Редактировать профиль</a>
	                    <? endif; ?>
                    </div>
                    <div class="account__image">
                        <div class="account__img-wrap img-wrap">
                            <img class="img"
                                 src="<?= $filePhoto["src"] ?>"
                                 alt="">
                        </div>
                    </div>
					<? if ( $arResult["PROPERTIES"]["VERIFICATION_PASSED_BY_MODERATOR"]["VALUE"] == "" ): ?>
                        <div class="account__state state-account">
                            <p class="state-account__name">Ваш профиль проверяется модератором.</p>
                            <p class="state-account__desc">После проведения проверки данная надпись исчезнет.
                                При возникновении вопросов <a class="state-account__link drop-login__menu-item_feedback" href="#">свяжитесь с администратором.</a></p>
                        </div>
					<? else: ?>
                        <?$file = 'close_message.json';
                        $data = file_get_contents($file, true);
                        $data = json_decode($data, true);
                        if(!in_array($arResult["ID"], $data)):?>
                            <div class="account__state state-account state-account_success">
                                <div class="close_mess" data-user-id="<?= $arResult["ID"] ?>"></div>
                                <p class="state-account__name">Проверка Вашего профиля модератором завершена.</p>
                            </div>
                        <?endif;?>
					<? endif; ?>
					<? if ( $arResult["FIELDS"]['ACTIVE'] != "Y" ): ?>
                        <div class="account__state state-account state-account_failed">
                            <p class="state-account__name">Ваш профиль не активен.</p>
                            <p class="state-account__desc">Чтобы узнать причину необходимо
                                <a class="state-account__link drop-login__menu-item_feedback" href="#">связаться с администратором.</a>
                            </p>
                        </div>
					<? endif; ?>
                </div>
            </div>
        </div>
    </main>
<? //echo "<pre>"; print_r($arResult); echo "</pre>";?>