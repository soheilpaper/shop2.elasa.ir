<?php /*%%SmartyHeaderCode:116931596455ef2f55279dc6-65430920%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9c7e46ab756a4af40724e416f0507e39d42852b6' => 
    array (
      0 => '/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/modules/smartbloghomelatestnews/views/templates/front/smartblog_latest_news.tpl',
      1 => 1434823344,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '116931596455ef2f55279dc6-65430920',
  'variables' => 
  array (
    'view_data' => 0,
    'post' => 0,
    'options' => 0,
    'modules_dir' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55ef2f55313ec7_65235511',
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55ef2f55313ec7_65235511')) {function content_55ef2f55313ec7_65235511($_smarty_tpl) {?><div class="col-xs-12">
<div class="home_blog">
    <div class="title_block">
		<a class="blog_lnk" href="http://shop2.elasa.ir/index.php?fc=module&module=smartblog&controller=category&id_lang=3">
			آخرین اخبار
		</a>
		<div class="navi">
			<a class="prevtab"><i class="icon-angle-left"></i></a>
			<a class="nexttab"><i class="icon-angle-right"></i></a>
		</div>
	</div>
    <div class="block_content">
    <div class="row">
    <div class="blogSlider">
                                                                                                                <div class="blog_item">
                        <div class="blog_img_holder">
                             <a href="http://shop2.elasa.ir/index.php?fc=module&module=smartblog&id_post=6&controller=details&id_lang=3"><img alt="اصول طراحی آبنما" class="feat_img_small img-responsive" src="/modules/smartblog/images/6-home-default.jpg"></a>
                        </div>
						<div class="blog_info">
							<a class="post_title" href="http://shop2.elasa.ir/index.php?fc=module&module=smartblog&id_post=6&controller=details&id_lang=3">اصول طراحی آبنما</a>
							<p>
								&#1570;&#1576;&#1606;&#1605;&#1575; &#1575;&#1604;&#1605;&#1575;&#1606;&#1740;...
							</p>
							<span class="post_date"><i class="icon-calendar"></i>2015-08-30 19:25:15</span>
							<div class="rd_more">
								<a href="http://shop2.elasa.ir/index.php?fc=module&module=smartblog&id_post=6&controller=details&id_lang=3">ادامه مطلب&nbsp;&nbsp;&nbsp;<i class="icon-long-arrow-right"></i></a>
							</div>
						</div>
                    </div>
                
                                         </div>
     </div>
     </div>
</div>
</div>
<script>
	$(document).ready(function() {
		var blogSlider = $(".blogSlider");
		blogSlider.owlCarousel({
			items : 4,
			itemsDesktop : [1199,3],
			itemsDesktopSmall : [991,3], 
			itemsTablet: [767,2], 
			itemsMobile : [480,1],
			autoPlay :  false,
			stopOnHover: false,
		});
		
		// Custom Navigation Events
		$(".home_blog .nexttab").click(function(){
		blogSlider.trigger('owl.next');})
		$(".home_blog .prevtab").click(function(){
		blogSlider.trigger('owl.prev');})   
	});
</script><?php }} ?>
