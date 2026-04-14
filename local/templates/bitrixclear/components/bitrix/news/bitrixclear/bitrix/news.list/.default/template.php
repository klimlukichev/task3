<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @var CBitrixComponentTemplate $this */
$this->setFrameMode(true);
?>
<?php if ($arParams["DISPLAY_TOP_PAGER"]): ?>
	<div class="news-list__pager news-list__pager--top"><?= $arResult["NAV_STRING"] ?></div>
<?php endif; ?>

<div class="newslist-article-hover">
	<div class="article-list">
		<?php foreach ($arResult["ITEMS"] as $arItem): ?>
			<?php
			$this->AddEditAction($arItem["ID"], $arItem["EDIT_LINK"], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction(
				$arItem["ID"],
				$arItem["DELETE_LINK"],
				CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
				["CONFIRM" => GetMessage("CT_BNL_ELEMENT_DELETE_CONFIRM")]
			);

			$hasDetailUrl = !$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"]);
			$image = $arItem["PREVIEW_PICTURE"] ?? $arItem["DETAIL_PICTURE"] ?? null;
			$previewText = trim(
				html_entity_decode(
					strip_tags((string)($arItem["PREVIEW_TEXT"] ?? "")),
					ENT_QUOTES | ENT_HTML5,
					"UTF-8"
				)
			);
			?>
			<div class="article-list__item" id="<?= $this->GetEditAreaId($arItem["ID"]); ?>">
				<?php if ($hasDetailUrl): ?>
					<a class="article-item" href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
				<?php else: ?>
					<div class="article-item">
				<?php endif; ?>
					<div class="article-item__wrapper">
						<div class="article-item__media">
							<?php if ($arParams["DISPLAY_DATE"] !== "N" && $arItem["DISPLAY_ACTIVE_FROM"]): ?>
								<div class="article-item__date"><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></div>
							<?php endif; ?>
							<?php if (is_array($image)): ?>
								<div class="article-item__image">
									<img
										src="<?= $image["SRC"] ?>"
										alt="<?= htmlspecialcharsbx((string)($image["ALT"] ?: $arItem["NAME"])) ?>"
										loading="lazy"
									/>
								</div>
							<?php endif; ?>
						</div>
						<div class="article-item__main">
							<?php if ($arParams["DISPLAY_NAME"] !== "N" && $arItem["NAME"]): ?>
								<div class="article-item__title"><?= htmlspecialcharsbx($arItem["NAME"]) ?></div>
							<?php endif; ?>
							<?php if ($arParams["DISPLAY_PREVIEW_TEXT"] !== "N" && $previewText !== ""): ?>
								<div class="article-item__content"><?= htmlspecialcharsbx($previewText) ?></div>
							<?php endif; ?>
						</div>
					</div>
				<?php if ($hasDetailUrl): ?>
					</a>
				<?php else: ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
</div>

<?php if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
	<div class="news-list__pager news-list__pager--bottom"><?= $arResult["NAV_STRING"] ?></div>
<?php endif; ?>
