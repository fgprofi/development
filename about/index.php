<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("О проекте");
?>
    <main class="main">
        <div class="main__header header-main">
            <div class="containered">
                <div class="header-main__content">
                    <a class="header-main__button" href="/">назад</a>
                    <h1 class="header-main__title">О проекте</h1>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="containered">
                <? $APPLICATION->IncludeComponent("bitrix:menu", "sidebar", Array(
                        "ROOT_MENU_TYPE" => "left",  // Тип меню для первого уровня
                        "MENU_CACHE_TYPE" => "N",   // Тип кеширования
                        "MENU_CACHE_TIME" => "3600",    // Время кеширования (сек.)
                        "MENU_CACHE_USE_GROUPS" => "Y", // Учитывать права доступа
                        "MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
                        "MAX_LEVEL" => "2", // Уровень вложенности меню
                        "CHILD_MENU_TYPE" => "left",    // Тип меню для остальных уровней
                        "USE_EXT" => "Y",   // Подключать файлы с именами вида .тип_меню.menu_ext.php
                        "MENU_INCLUDE_FILE" => ".left_menu_include.php",
                        "DELAY" => "N", // Откладывать выполнение шаблона меню
                        "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                        "COMPONENT_TEMPLATE" => "sidebar"
                    ),
                    false
                );
                ?>
                <div class="center_in_block about_in_block">
                    <div class="about_in_block-left">
                        <div class="about_in_block-text">
                            <h3>Проект "Содействие повышению уровня финансовой грамотности населения"</h3>
                            <div>
                                Проект «Содействие повышению уровня финансовой грамотности населения и развитию
                                финансового
                                образования в Российской Федерации» реализуется с 2011 г. За прошедшее время в России
                                начало
                                формироваться профессиональное сообщество в области финансовой грамотности и защиты прав
                                потребителей финансовых услуг.
                            </div>
                            <div>
                                Множество людей - педагогов, экспертов, аналитиков, чиновников, журналистов, блогеров и
                                бизнесменов по всей стране так или иначе вовлечены в финансовое просвещение. Это весьма
                                неоднородное сообщество, у членов которого могут отличаться цели и задачи, что
                                существенно
                                затрудняет координацию между ними. Несмотря на наличие успешных примеров создания
                                профессиональных сообществ на уровне отдельных регионов, сообществ школьных
                                преподавателей и
                                методистов и т.п., единого сообщества пока не сложилось.
                            </div>
                            <div>
                                Настоящий проект направлен на решение этой задачи – развитие единого сообщества
                                профессионалов в
                                области финансовой грамотности. Его главные цели – упростить координацию между
                                профессионалами,
                                создать единое информационное пространство, сделать более доступными новые разработки и
                                практики. Площадкой для этого должен стать настоящий Портал сообщества профессионалов в
                                области
                                финансовой грамотности, создаваемый консорциумом в составе консультационной компании
                                «ПАКК» и
                                Института национальных проектов по заданию Минфина России.
                            </div>
                            <div>
                                Но этот проект – это не просто онлайн-площадка, облегчающая общение между
                                профессионалами и
                                поиск нужных специалистов. Речь идет о создании Сообщества, формирующего стандарты
                                деятельности
                                в области финансовой грамотности, создающего востребованные как членами сообщества, так
                                и
                                стейкхолдерами внутренние и внешние сервисы, обладающего собственной позицией. Это
                                позволит
                                сохранить внимание к проблематике финансовой грамотности вне зависимости от наличия тех
                                или иных
                                целевых программ и проектов, ведь эти вопросы одни из ключевых для жизни в современном
                                обществе.
                            </div>
                        </div>
                    </div>
                    <div class="about_in_block-right">
                        <div class="logo-block">
                            <span class="logo-block__img"
                               style="background: url(<?= SITE_TEMPLATE_PATH ?>/img/logo.svg) center center / contain no-repeat;"></span>
                        </div>
                        <div class="about_in_block-right-text">
                            Проект является частью информационно-образовательного ресурса по повышению финансовой
                            грамотности
                            населения вашифинансы.рф
                        </div>
                        <a class="link link-button" href="https://vashifinancy.ru/" target="_blank">Вашифинансы.рф</a>
                        <div class="about_in_block-right-text">
                            <a class="link link-button" href="/about/kontseptsiya/">Концепция сообщества</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>