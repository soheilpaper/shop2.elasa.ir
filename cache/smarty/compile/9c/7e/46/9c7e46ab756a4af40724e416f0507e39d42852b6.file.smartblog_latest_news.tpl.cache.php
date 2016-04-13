<?php /* Smarty version Smarty-3.1.19, created on 2015-09-08 23:26:21
         compiled from "/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/modules/smartbloghomelatestnews/views/templates/front/smartblog_latest_news.tpl" */ ?>
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
  'function' => 
  array (
  ),
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
  'unifunc' => 'content_55ef2f553088f7_94469663',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55ef2f553088f7_94469663')) {function content_55ef2f553088f7_94469663($_smarty_tpl) {?><div class="col-xs-12">
<div class="home_blog">
    <div class="title_block">
		<a class="blog_lnk" href="<?php echo smartblog::GetSmartBlogLink('smartblog');?>
">
			<?php echo smartyTranslate(array('s'=>'Latest News','mod'=>'smartbloghomelatestnews'),$_smarty_tpl);?>

		</a>
		<div class="navi">
			<a class="prevtab"><i class="icon-angle-left"></i></a>
			<a class="nexttab"><i class="icon-angle-right"></i></a>
		</div>
	</div>
    <div class="block_content">
    <div class="row">
    <div class="blogSlider">
        <?php if (isset($_smarty_tpl->tpl_vars['view_data']->value)&&!empty($_smarty_tpl->tpl_vars['view_data']->value)) {?>
            <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
            <?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['view_data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value) {
$_smarty_tpl->tpl_vars['post']->_loop = true;
?>
                    <?php $_smarty_tpl->tpl_vars["options"] = new Smarty_variable(null, null, 0);?>
                    <?php $_smarty_tpl->createLocalArrayVariable('options', null, 0);
$_smarty_tpl->tpl_vars['options']->value['id_post'] = $_smarty_tpl->tpl_vars['post']->value['id'];?>
                    <?php $_smarty_tpl->createLocalArrayVariable('options', null, 0);
$_smarty_tpl->tpl_vars['options']->value['slug'] = $_smarty_tpl->tpl_vars['post']->value['link_rewrite'];?>
                    <div class="blog_item">
                        <div class="blog_img_holder">
                             <a href="<?php echo smartblog::GetSmartBlogLink('smartblog_post',$_smarty_tpl->tpl_vars['options']->value);?>
"><img alt="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
" class="feat_img_small img-responsive" src="<?php echo $_smarty_tpl->tpl_vars['modules_dir']->value;?>
smartblog/images/<?php echo $_smarty_tpl->tpl_vars['post']->value['post_img'];?>
-home-default.jpg"></a>
                        </div>
						<div class="blog_info">
							<a class="post_title" href="<?php echo smartblog::GetSmartBlogLink('smartblog_post',$_smarty_tpl->tpl_vars['options']->value);?>
"><?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
</a>
							<p>
								<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate(mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['short_description'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8'),100,'...');?>

							</p>
							<span class="post_date"><i class="icon-calendar"></i><?php echo $_smarty_tpl->tpl_vars['post']->value['date_added'];?>
</span>
							<div class="rd_more">
								<a href="<?php echo smartblog::GetSmartBlogLink('smartblog_post',$_smarty_tpl->tpl_vars['options']->value);?>
"><?php echo smartyTranslate(array('s'=>'Read More','mod'=>'smartbloghomelatestnews'),$_smarty_tpl);?>
&nbsp;&nbsp;&nbsp;<i class="icon-long-arrow-right"></i></a>
							</div>
						</div>
                    </div>
                
                <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
            <?php } ?>
        <?php }?>
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
