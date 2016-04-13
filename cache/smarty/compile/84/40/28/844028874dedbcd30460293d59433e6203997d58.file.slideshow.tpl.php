<?php /* Smarty version Smarty-3.1.19, created on 2015-09-08 23:26:20
         compiled from "/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/modules/posslideshow/slideshow.tpl" */ ?>
<?php /*%%SmartyHeaderCode:154981951755ef2f543a55e5-15720697%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '844028874dedbcd30460293d59433e6203997d58' => 
    array (
      0 => '/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/modules/posslideshow/slideshow.tpl',
      1 => 1433071978,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '154981951755ef2f543a55e5-15720697',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'slides' => 0,
    'slide' => 0,
    'slideOptions' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55ef2f5448dc34_41876736',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55ef2f5448dc34_41876736')) {function content_55ef2f5448dc34_41876736($_smarty_tpl) {?><div class="pos-slideshow">
	<div class="flexslider ma-nivoslider">
        <div class="pos-loading"></div>
            <div id="pos-slideshow-home" class="slides">
				
                <?php $_smarty_tpl->tpl_vars['count'] = new Smarty_variable(0, null, 0);?>
                <?php  $_smarty_tpl->tpl_vars['slide'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['slide']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['slides']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['slide']->key => $_smarty_tpl->tpl_vars['slide']->value) {
$_smarty_tpl->tpl_vars['slide']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['slide']->key;
?>
					
                    <img style ="display:none" src="<?php echo $_smarty_tpl->tpl_vars['slide']->value['image'];?>
"  data-thumb="<?php echo $_smarty_tpl->tpl_vars['slide']->value['image'];?>
"  alt="" title="#htmlcaption<?php echo $_smarty_tpl->tpl_vars['slide']->value['id_pos_slideshow'];?>
"  />
			   <?php } ?>
            </div>
            <?php if ($_smarty_tpl->tpl_vars['slideOptions']->value['show_caption']!=0) {?>
                <?php  $_smarty_tpl->tpl_vars['slide'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['slide']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['slides']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['slide']->key => $_smarty_tpl->tpl_vars['slide']->value) {
$_smarty_tpl->tpl_vars['slide']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['slide']->key;
?>
                    <div id="htmlcaption<?php echo $_smarty_tpl->tpl_vars['slide']->value['id_pos_slideshow'];?>
" class="pos-slideshow-caption nivo-html-caption nivo-caption">
							<div class="timing-bar" style=" 
								position:absolute;
								top:0;
								left:0;
								z-index: 9;
								background-color: rgba(255, 255, 255, 0.7);
								height:3px;
								-webkit-animation: myfirst <?php if ($_smarty_tpl->tpl_vars['slideOptions']->value['pause_time']!='') {?><?php echo $_smarty_tpl->tpl_vars['slideOptions']->value['pause_time'];?>
<?php } else { ?>4000<?php }?>ms ease;
								-moz-animation: myfirst <?php if ($_smarty_tpl->tpl_vars['slideOptions']->value['pause_time']!='') {?><?php echo $_smarty_tpl->tpl_vars['slideOptions']->value['pause_time'];?>
<?php } else { ?>4000<?php }?>ms ease;
								-ms-animation: myfirst <?php if ($_smarty_tpl->tpl_vars['slideOptions']->value['pause_time']!='') {?><?php echo $_smarty_tpl->tpl_vars['slideOptions']->value['pause_time'];?>
<?php } else { ?>4000<?php }?>ms ease;
								animation: myfirst <?php if ($_smarty_tpl->tpl_vars['slideOptions']->value['pause_time']!='') {?><?php echo $_smarty_tpl->tpl_vars['slideOptions']->value['pause_time'];?>
<?php } else { ?>4000<?php }?>ms ease;
							"></div>
							<div class="pos-slideshow-info pos-slideshow-info<?php echo $_smarty_tpl->tpl_vars['slide']->value['id_pos_slideshow'];?>
">
								<!-- <div class="pos-slideshow-title">
									   <h3><?php echo $_smarty_tpl->tpl_vars['slide']->value['title'];?>
</h3>
								</div> -->
								<div class="pos_description hidden-xs hidden-sm">
										<?php echo $_smarty_tpl->tpl_vars['slide']->value['description'];?>

								</div>
								<?php if ($_smarty_tpl->tpl_vars['slide']->value['link']) {?>
								<div class="pos-slideshow-readmore hidden">
									<a href="<?php echo $_smarty_tpl->tpl_vars['slide']->value['link'];?>
" title="<?php echo smartyTranslate(array('s'=>('Shop now'),'mod'=>'posslideshow'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>('Shop now'),'mod'=>'posslideshow'),$_smarty_tpl);?>
</a>	
								</div>
								<?php }?>
							</div>
                    </div>
                 <?php } ?>
             <?php }?>
        </div>
    </div>
 <script type="text/javascript">
    $(window).load(function() {
		$(document).off('mouseenter').on('mouseenter', '.pos-slideshow', function(e){
		$('.pos-slideshow .timethai').addClass('pos_hover');
	});

	 $(document).off('mouseleave').on('mouseleave', '.pos-slideshow', function(e){
	   $('.pos-slideshow .timethai').removeClass('pos_hover');
	 });
        $('#pos-slideshow-home').nivoSlider({
			effect: '<?php if ($_smarty_tpl->tpl_vars['slideOptions']->value['animation_type']!='') {?><?php echo $_smarty_tpl->tpl_vars['slideOptions']->value['animation_type'];?>
<?php } else { ?>random<?php }?>',
			slices: 15,
			boxCols: 8,
			boxRows: 4,
			animSpeed: '<?php if ($_smarty_tpl->tpl_vars['slideOptions']->value['animation_speed']!='') {?><?php echo $_smarty_tpl->tpl_vars['slideOptions']->value['animation_speed'];?>
<?php } else { ?>600<?php }?>',
			pauseTime: '<?php if ($_smarty_tpl->tpl_vars['slideOptions']->value['pause_time']!='') {?><?php echo $_smarty_tpl->tpl_vars['slideOptions']->value['pause_time'];?>
<?php } else { ?>5000<?php }?>',
			startSlide: <?php if ($_smarty_tpl->tpl_vars['slideOptions']->value['start_slide']!='') {?><?php echo $_smarty_tpl->tpl_vars['slideOptions']->value['start_slide'];?>
<?php } else { ?>0<?php }?>,
			directionNav: <?php if ($_smarty_tpl->tpl_vars['slideOptions']->value['show_arrow']!=0) {?><?php echo $_smarty_tpl->tpl_vars['slideOptions']->value['show_arrow'];?>
<?php } else { ?>false<?php }?>,
			controlNav: <?php if ($_smarty_tpl->tpl_vars['slideOptions']->value['show_navigation']!=0) {?><?php echo $_smarty_tpl->tpl_vars['slideOptions']->value['show_navigation'];?>
<?php } else { ?>false<?php }?>,
			controlNavThumbs: false,
			pauseOnHover: false,
			manualAdvance: false,
			prevText: '<i class="icon-angle-left"></i>',
			nextText: '<i class="icon-angle-right"></i>',
 		});
    });
</script>
<?php }} ?>
