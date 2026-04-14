<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */

$this->setFrameMode(true);

$sections = $arResult["SECTIONS"] ?? [];
if ($sections === []) {
    return;
}

$currentSectionId = (string)($arParams["CURRENT_SECTION_ID"] ?? "");
$allUrl = (string)($arParams["ALL_URL"] ?? "/news/");
?>
<nav class="news-sections" aria-label="Разделы новостей">
    <a class="news-sections__link<?= $currentSectionId === "" ? " is-active" : "" ?>" href="<?= htmlspecialcharsbx($allUrl) ?>">
        Все новости
    </a>

    <?php foreach ($sections as $arSection): ?>
        <?php
        $sectionId = (string)($arSection["ID"] ?? "");
        $sectionUrl = (string)($arSection["SECTION_PAGE_URL"] ?? "");
        if ($sectionUrl === "") {
            continue;
        }
        ?>
        <a
            class="news-sections__link<?= $sectionId === $currentSectionId ? " is-active" : "" ?>"
            href="<?= htmlspecialcharsbx($sectionUrl) ?>"
        >
            <?= htmlspecialcharsbx($arSection["NAME"]) ?>
        </a>
    <?php endforeach; ?>
</nav>
