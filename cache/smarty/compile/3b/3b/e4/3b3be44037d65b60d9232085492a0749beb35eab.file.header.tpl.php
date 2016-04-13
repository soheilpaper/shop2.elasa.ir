<?php /* Smarty version Smarty-3.1.19, created on 2015-09-08 23:26:19
         compiled from "/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/modules/gplusone/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:44979542655ef2f535526d2-37855314%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3b3be44037d65b60d9232085492a0749beb35eab' => 
    array (
      0 => '/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/modules/gplusone/header.tpl',
      1 => 1440995182,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '44979542655ef2f535526d2-37855314',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'gpo_lang_code' => 0,
    'gpo_cover' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55ef2f535a8006_73506511',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55ef2f535a8006_73506511')) {function content_55ef2f535a8006_73506511($_smarty_tpl) {?>
<script type="text/javascript">
window.___gcfg =  {
	lang: '<?php echo $_smarty_tpl->tpl_vars['gpo_lang_code']->value;?>
',
  parsetags: 'onload'
};

(function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<?php if ($_smarty_tpl->tpl_vars['gpo_cover']->value&&$_smarty_tpl->tpl_vars['gpo_cover']->value!='') {?>
<!-- Update your html tag to include the itemscope and itemtype attributes. -->
<html itemscope itemtype="http://schema.org/Product">

<!-- Add the following three tags inside head. -->
<meta itemprop="image" content="<?php echo $_smarty_tpl->tpl_vars['gpo_cover']->value;?>
">
<?php }?><?php }} ?>
