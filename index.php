<?php
if (preg_match('#^/news(?:/|$)#', (string)($_SERVER["REQUEST_URI"] ?? ""))) {
	require $_SERVER["DOCUMENT_ROOT"] . "/news/index.php";
	return;
}

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php";
// $APPLICATION->SetTitle("Главная");

ob_start();





$APPLICATION->AddViewContent("main_slider", ob_get_clean());

$APPLICATION->IncludeComponent(
	"bitrix:news",
	"bitrixclear",
	array(
		"IBLOCK_TYPE" => "abilities",
		"IBLOCK_ID" => "4",
		"NEWS_COUNT" => "4",
		"USE_SEARCH" => "N",
		"USE_RSS" => "N",
		"USE_RATING" => "N",
		"USE_CATEGORIES" => "N",
		"USE_REVIEW" => "N",
		"USE_FILTER" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"CHECK_DATES" => "Y",
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/news/",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "Y",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_ELEMENT_CHAIN" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"LIST_ACTIVE_DATE_FORMAT" => "d M Y",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d M Y",
		"LIST_FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
			3 => "DETAIL_PICTURE",
			4 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
			3 => "DETAIL_PICTURE",
			4 => "DETAIL_TEXT",
			5 => "",
		),
		"DETAIL_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Новости",
		"PAGER_TEMPLATE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "N",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_SHOW_ALL" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"DETAIL_SET_CANONICAL_URL" => "N",
		"USE_PERMISSIONS" => "N",
		"GROUP_PERMISSIONS" => array(
			0 => "2",
		),
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "section/#SECTION_ID#/",
			"detail" => "#ELEMENT_ID#/",
		),
	),
	false
);

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php";