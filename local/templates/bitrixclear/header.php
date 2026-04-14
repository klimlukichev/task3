<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Page\Asset;

include $_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/.settings.php";
?>
<!DOCTYPE html>
<html lang="<?= $arTemplateParams["HTML_LANG"]; ?>">
    <head>
        <?php Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/init.js"); ?>

        <?php Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/main.css"); ?>

        <?php $APPLICATION->ShowHead(); ?>
        <style>
            html,
            body {
                background: #fff !important;
                background-color: #fff !important;
                background-image: none !important;
            }
        </style>

        <title><?php $APPLICATION->ShowTitle(); ?></title>
    </head>
    <body>
        <div id="panel"><?php $APPLICATION->ShowPanel(); ?></div>
