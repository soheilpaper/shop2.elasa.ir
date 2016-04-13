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
{if !isset($content_only) || !$content_only}
					</div><!-- #center_column -->
					{if isset($right_column_size) && !empty($right_column_size)}
						<div id="right_column" class="col-xs-12 col-sm-{$right_column_size|intval} column">{$HOOK_RIGHT_COLUMN}</div>
					{/if}
					</div><!-- .row -->
				</div><!-- #columns -->
			</div><!-- .columns-container -->
			<div class="brandSlider">
				<div class="container">
					{hook h="brandSlider"}
				</div>
			</div>
			<div class="static_bottom_out">
				<div class="container">
					<div class="row">
						{hook h="blockPosition5"}
					</div>
				</div>
			</div>
					{hook h="blockFooterExtra"}
				<!-- Footer -->
			<div class="footer-container">
				<footer id="footer">
					<div class="container footer_center">
						<div class="row">
							<div class="col-xs-12 col-sm-3">
								<div class="footer_center1">
									{hook h="blockFooter1"}
								</div>
							</div>
							<div class="col-xs-12 col-sm-9">
								<div class="footer_center2">
									<div class="row">
									{hook h="blockFooter2"}
									</div>
								</div>
								<div class="footer_center3">
									<div class="row">
									{hook h="blockFooter3"}
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="footer_bottom">
						<div class="container">
							{hook h="blockFooter4"}
							{hook h="blockFooter5"}
						</div>
					</div>
					{if isset($HOOK_FOOTER)} {$HOOK_FOOTER} {/if}
				</footer>
			</div><!-- #footer -->
		</div><!-- #page -->
{/if}
{include file="$tpl_dir./global.tpl"}
<div class="back-top"><a href= "#" class="back-top-button hidden-xs"></a></div>
	</body>
</html>