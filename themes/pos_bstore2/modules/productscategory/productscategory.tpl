{*
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2015 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{if count($categoryProducts) > 0 && $categoryProducts !== false}
<section class="blockproductscategory">
	<div class="title_block">
			<h3>{l s='RELATED PRODUCTS' mod='productscategory'}</h3>
			<div class="navi">
				<a class="prevtab"><i class="icon-angle-left"></i></a>
				<a class="nexttab"><i class="icon-angle-right"></i></a>
			</div>
		</div>
	<div class="block_content">
		<div class="row">
			<div class="productscategorysld">
			{foreach from=$categoryProducts item='categoryProduct' name=categoryProduct}
				<div class="item">
					<div class="home_tab_img">
						<a href="{$link->getProductLink($categoryProduct.id_product, $categoryProduct.link_rewrite, $categoryProduct.category, $categoryProduct.ean13)}" class="lnk_img product-image" title="{$categoryProduct.name|htmlspecialchars}">
							<img src="{$link->getImageLink($categoryProduct.link_rewrite, $categoryProduct.id_image, 'home_default')|escape:'html':'UTF-8'}" alt="{$categoryProduct.name|htmlspecialchars}" class="img-responsive"/>
						</a>
					</div>
					<div class="comment_box">
						{hook h='displayProductListReviews' product=$categoryProduct}
					</div>
					<h5 itemprop="name" class="product-name">
						<a href="{$link->getProductLink($categoryProduct.id_product, $categoryProduct.link_rewrite, $categoryProduct.category, $categoryProduct.ean13)|escape:'html':'UTF-8'}" title="{$categoryProduct.name|htmlspecialchars}">{$categoryProduct.name|escape:'html':'UTF-8'}</a>
					</h5>
					{if $ProdDisplayPrice && $categoryProduct.show_price == 1 && !isset($restricted_country_mode) && !$PS_CATALOG_MODE}
						<p class="price_display">
						{if isset($categoryProduct.specific_prices) && $categoryProduct.specific_prices
						&& ($categoryProduct.displayed_price|number_format:2 !== $categoryProduct.price_without_reduction|number_format:2)}

							<span class="price special-price">{convertPrice price=$categoryProduct.displayed_price}</span>
							<span class="old-price">{displayWtPrice p=$categoryProduct.price_without_reduction}</span>

						{else}
							<span class="price">{convertPrice price=$categoryProduct.displayed_price}</span>
						{/if}
						</p>
					{else}
					<br />
					{/if}
				</div>
			{/foreach}
			</div>
		</div>
	</div>
</section>
{/if}