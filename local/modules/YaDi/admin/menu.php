<?
$arMenu = array(
    "parent_menu" => "global_menu_services", // поместим в раздел "Сервис"
    "sort"        => 100,                    // вес пункта меню
    "url"         => "",  // ссылка на пункте меню
    "text"        => "YaDi",       // текст пункта меню
    "title"       => "Модуль воспроизведения медиа файлов с Яндекс.Диск", // текст всплывающей подсказки
    "icon"        => "form_menu_icon", // малая иконка
    "page_icon"   => "form_page_icon", // большая иконка
    "items_id"    => "menu_yadi_token",  // идентификатор ветви
    "items"       => array(),          // остальные уровни меню сформируем ниже.
);
$arItems[] = array(
    "text"      => "Получить Токен",
    "title"     => "Получить oAuth Token по логину и паролю oAuth авторизации Яндекса", // текст всплывающей подсказки
    "url"       => "yadi_get_token.php?lang=".LANGUAGE_ID,
    "icon"      => "form_menu_icon",
    "page_icon" => "form_page_icon",
    "more_url"  => array(),
);
$arMenu['items'] = $arItems;

return $arMenu;