<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @var CBitrixComponentTemplate $this */

$this->setFrameMode(true);

$image = $arResult["DETAIL_PICTURE"]
    ?? $arResult["PREVIEW_PICTURE"]
    ?? ($arResult["FIELDS"]["DETAIL_PICTURE"] ?? null)
    ?? ($arResult["FIELDS"]["PREVIEW_PICTURE"] ?? null);

if (
    !is_array($image)
    && !empty($arResult["ID"])
    && CModule::IncludeModule("iblock")
) {
    $res = CIBlockElement::GetList(
        [],
        [
            "IBLOCK_ID" => $arResult["IBLOCK_ID"],
            "ID" => $arResult["ID"],
            "ACTIVE" => "Y",
        ],
        false,
        false,
        ["ID", "PREVIEW_PICTURE", "DETAIL_PICTURE"]
    );

    if ($element = $res->GetNext()) {
        $pictureId = (int)($element["DETAIL_PICTURE"] ?: $element["PREVIEW_PICTURE"]);
        if ($pictureId > 0) {
            $image = CFile::GetFileArray($pictureId);
        }
    }
}

$previewText = html_entity_decode(
    (string)($arResult["FIELDS"]["PREVIEW_TEXT"] ?? $arResult["PREVIEW_TEXT"] ?? ""),
    ENT_QUOTES | ENT_HTML5,
    "UTF-8"
);
$backUrl = (string)($arResult["LIST_PAGE_URL"] ?? $arResult["~LIST_PAGE_URL"] ?? $arParams["IBLOCK_URL"] ?? "/news/");
?>
<article class="article-card">
    <?php if ($arParams["DISPLAY_NAME"] !== "N" && $arResult["NAME"]): ?>
        <h1 class="article-card__title"><?= htmlspecialcharsbx($arResult["NAME"]) ?></h1>
    <?php endif; ?>

    <?php if ($arParams["DISPLAY_DATE"] !== "N" && $arResult["DISPLAY_ACTIVE_FROM"]): ?>
        <div class="article-card__date"><?= $arResult["DISPLAY_ACTIVE_FROM"] ?></div>
    <?php endif; ?>

    <div class="article-card__content">
        <?php if ($arParams["DISPLAY_PICTURE"] !== "N" && is_array($image)): ?>
            <div class="article-card__image sticky">
                <img
                    src="<?= $image["SRC"] ?>"
                    alt="<?= htmlspecialcharsbx((string)($image["ALT"] ?: $arResult["NAME"])) ?>"
                    title="<?= htmlspecialcharsbx((string)($image["TITLE"] ?: $arResult["NAME"])) ?>"
                    data-object-fit="cover"
                />
            </div>
        <?php endif; ?>

        <div class="article-card__text">
            <?php if ($arParams["DISPLAY_PREVIEW_TEXT"] !== "N" && $previewText !== "" && $arResult["DETAIL_TEXT"] !== ""): ?>
                <div class="article-card__lead block-content"><?= $previewText ?></div>
            <?php endif; ?>

            <div class="block-content" data-anim="anim-3">
                <?php if ($arResult["NAV_RESULT"]): ?>
                    <?php if ($arParams["DISPLAY_TOP_PAGER"]): ?>
                        <div class="news-detail__pager news-detail__pager--top"><?= $arResult["NAV_STRING"] ?></div>
                    <?php endif; ?>
                    <?= $arResult["NAV_TEXT"] ?>
                    <?php if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
                        <div class="news-detail__pager news-detail__pager--bottom"><?= $arResult["NAV_STRING"] ?></div>
                    <?php endif; ?>
                <?php elseif ($arResult["DETAIL_TEXT"] <> ""): ?>
                    <?= $arResult["DETAIL_TEXT"] ?>
                <?php else: ?>
                    <?= $arResult["PREVIEW_TEXT"] ?>
                <?php endif; ?>
            </div>

            <a class="article-card__button" href="<?= htmlspecialcharsbx($backUrl) ?>">Назад к новостям</a>

            <?php if (array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] === "Y"): ?>
                <div class="news-detail-share">
                    <noindex>
                        <?php
                        $APPLICATION->IncludeComponent(
                            "bitrix:main.share",
                            "",
                            [
                                "HANDLERS" => $arParams["SHARE_HANDLERS"],
                                "PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
                                "PAGE_TITLE" => $arResult["~NAME"],
                                "SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
                                "SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
                                "HIDE" => $arParams["SHARE_HIDE"],
                            ],
                            $component,
                            ["HIDE_ICONS" => "Y"]
                        );
                        ?>
                    </noindex>
                </div>
            <?php endif; ?>
        </div>
    </div>
</article>