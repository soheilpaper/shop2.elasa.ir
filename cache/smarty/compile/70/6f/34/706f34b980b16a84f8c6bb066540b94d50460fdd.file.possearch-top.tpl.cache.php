<?php /* Smarty version Smarty-3.1.19, created on 2015-09-08 23:26:20
         compiled from "/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/modules/possearchcategories/possearch-top.tpl" */ ?>
<?php /*%%SmartyHeaderCode:31854619155ef2f5417b7e0-85428701%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '706f34b980b16a84f8c6bb066540b94d50460fdd' => 
    array (
      0 => '/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/modules/possearchcategories/possearch-top.tpl',
      1 => 1440885670,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31854619155ef2f5417b7e0-85428701',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
    'cate_on' => 0,
    'categories_option' => 0,
    'search_query' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55ef2f541e4528_26915470',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55ef2f541e4528_26915470')) {function content_55ef2f541e4528_26915470($_smarty_tpl) {?>

<!-- pos search module TOP -->
<div id="pos_search_top" class="wrap_seach list-inline">
	<form method="get" action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('search'), ENT_QUOTES, 'UTF-8', true);?>
" id="searchbox" class="form-inline form_search" role="form">
		<label for="pos_query_top"><!-- image on background --></label>
        <input type="hidden" name="controller" value="search" />
        <input type="hidden" name="orderby" value="position" />
        <input type="hidden" name="orderway" value="desc" />
			<div class="pos_search form-group">
                <?php if ($_smarty_tpl->tpl_vars['cate_on']->value==1) {?>
                    <select name="poscats" class="selectpicker">
					 <option value=""><?php echo smartyTranslate(array('s'=>'Categories','mod'=>'possearchcategories'),$_smarty_tpl);?>
</option>
                        <?php echo $_smarty_tpl->tpl_vars['categories_option']->value;?>

                    </select>
                <?php }?>
            </div>
			<input class="search_query form-control" type="text" placeholder="<?php echo smartyTranslate(array('s'=>'Enter your search key ... ','mod'=>'possearchcategories'),$_smarty_tpl);?>
" id="pos_query_top" name="search_query" value="<?php echo stripslashes(htmlspecialchars($_smarty_tpl->tpl_vars['search_query']->value, ENT_QUOTES, 'UTF-8', true));?>
" />
			<button type="submit" name="submit_search" value="<?php echo smartyTranslate(array('s'=>'Search','mod'=>'possearchcategories'),$_smarty_tpl);?>
" class="btn btn-default submit_search">
				<i class="icon-search"></i>
			</button>
    </form>
</div>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['self']->value)."/possearch-instantsearch.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>


<script type="text/javascript">
    $(window).on('load', function () {

        $('.selectpicker').selectpicker({
            'selectedText': 'cat'
        });

        // $('.selectpicker').selectpicker('hide');
    });
</script>
<!-- /pos search module TOP -->
<?php }} ?>
