<?php /* Smarty version Smarty-3.1.19, created on 2015-09-08 23:26:19
         compiled from "/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/modules/zopimfree/header-new-widget.tpl" */ ?>
<?php /*%%SmartyHeaderCode:63032617755ef2f535b72b8-17275437%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '438838c49711c9e84ddf3cec8de3f4e229321bce' => 
    array (
      0 => '/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/modules/zopimfree/header-new-widget.tpl',
      1 => 1441347862,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '63032617755ef2f535b72b8-17275437',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'widgetid' => 0,
    'customerName' => 0,
    'customerEmail' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55ef2f53622763_07621621',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55ef2f53622763_07621621')) {function content_55ef2f53622763_07621621($_smarty_tpl) {?><?php if (!isset($_GET['content_only'])) {?>
<!--Start of Zopim Live Chat Script-->

<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
$.src='//v2.zopim.com/?<?php echo $_smarty_tpl->tpl_vars['widgetid']->value;?>
';z.t=+new Date;$.
type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');

</script>
<!--End of Zopim Live Chat Script-->

<?php if ($_smarty_tpl->tpl_vars['customerName']->value&&$_smarty_tpl->tpl_vars['customerEmail']->value) {?>

<script>
  $zopim(function() {
    $zopim.livechat.setName('<?php if ($_smarty_tpl->tpl_vars['customerName']->value) {?><?php echo $_smarty_tpl->tpl_vars['customerName']->value;?>
<?php }?>');
    $zopim.livechat.setEmail('<?php if ($_smarty_tpl->tpl_vars['customerEmail']->value) {?><?php echo $_smarty_tpl->tpl_vars['customerEmail']->value;?>
<?php }?>');
  });
</script>

<?php }?>
<?php }?><?php }} ?>
