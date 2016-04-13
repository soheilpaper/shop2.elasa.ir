<?php /* Smarty version Smarty-3.1.19, created on 2015-09-08 23:26:20
         compiled from "/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/modules/possearchcategories/possearch-instantsearch.tpl" */ ?>
<?php /*%%SmartyHeaderCode:84158489655ef2f541eb7e6-77528116%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ab7b78b10c2f3f8d831698582650c9439e15ccdc' => 
    array (
      0 => '/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/modules/possearchcategories/possearch-instantsearch.tpl',
      1 => 1403318600,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '84158489655ef2f541eb7e6-77528116',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'instantsearch' => 0,
    'possearch_type' => 0,
    'search_ssl' => 0,
    'link' => 0,
    'cookie' => 0,
    'ajaxsearch' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55ef2f54225a71_08395469',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55ef2f54225a71_08395469')) {function content_55ef2f54225a71_08395469($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['instantsearch']->value) {?>
	<script type="text/javascript">
	// <![CDATA[
		function tryToCloseInstantSearch() {
			if ($('#old_center_column').length > 0)
			{
				$('#center_column').remove();
				$('#old_center_column').attr('id', 'center_column');
				$('#center_column').show();
				return false;
			}
		}
		instantSearchQueries = new Array();
		function stopInstantSearchQueries() {
			for(i=0;i<instantSearchQueries.length;i++) {
				instantSearchQueries[i].abort();
			}
			instantSearchQueries = new Array();
		}
		$("#pos_query_<?php echo $_smarty_tpl->tpl_vars['possearch_type']->value;?>
").keyup(function(){
            console.log([])
			if($(this).val().length > 0){
				stopInstantSearchQueries();
				instantSearchQuery = $.ajax({
					url: '<?php if ($_smarty_tpl->tpl_vars['search_ssl']->value==1) {?><?php echo addslashes($_smarty_tpl->tpl_vars['link']->value->getPageLink('search',true));?>
<?php } else { ?><?php echo addslashes($_smarty_tpl->tpl_vars['link']->value->getPageLink('search'));?>
<?php }?>',
					data: {
						instantSearch: 1,
						id_lang: <?php echo $_smarty_tpl->tpl_vars['cookie']->value->id_lang;?>
,
						q: $(this).val(),
					},
					dataType: 'html',
					type: 'POST',
					success: function(data){
						if($("#pos_query_<?php echo $_smarty_tpl->tpl_vars['possearch_type']->value;?>
").val().length > 0)
						{
							tryToCloseInstantSearch();
							$('#center_column').attr('id', 'ol_column').after('d_center_column');
                            $('#old_center<div id="center_column" class="' + $('#old_center_column').attr('class') + '">'+data+'</div>');
							$('#old_center_column').hide();
							// Button override
							ajaxCart.overrideButtonsInThePage();
							$("#instant_search_results a.close").click(function() {
								$("#pos_query_<?php echo $_smarty_tpl->tpl_vars['possearch_type']->value;?>
").val('');
								return tryToCloseInstantSearch();
							});
							return false;
						}
						else
							tryToCloseInstantSearch();
					}
				});
				instantSearchQueries.push(instantSearchQuery);
			}
			else
				tryToCloseInstantSearch();
		});
	// ]]>
	</script>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['ajaxsearch']->value) {?>
	<script type="text/javascript">
	// <![CDATA[
		$('document').ready( function() {
			$("#pos_query_<?php echo $_smarty_tpl->tpl_vars['possearch_type']->value;?>
")
				.autocomplete(
					'<?php if ($_smarty_tpl->tpl_vars['search_ssl']->value==1) {?><?php echo addslashes($_smarty_tpl->tpl_vars['link']->value->getPageLink('search',true));?>
<?php } else { ?><?php echo addslashes($_smarty_tpl->tpl_vars['link']->value->getPageLink('search'));?>
<?php }?>', {
                        minChars: 3,
						max: 10,
						width: 500,
						selectFirst: false,
                        loadingClass: "ac_loading",
                        inputClass: "ac_input",
						scroll: false,
						dataType: "json",
						formatItem: function(data, i, max, value, term) {
							return value;
						},
						parse: function(data) {
							var mytab = new Array();
							for (var i = 0; i < data.length; i++)
								mytab[mytab.length] = {  data: data[i], value: data[i].cname + ' > ' + data[i].pname };
							return mytab;
						},
						extraParams: {
							ajaxSearch:1,
							id_lang: <?php echo $_smarty_tpl->tpl_vars['cookie']->value->id_lang;?>

						}
					}
				)
				.result(function(event, data, formatted) {
					$('#pos_query_<?php echo $_smarty_tpl->tpl_vars['possearch_type']->value;?>
').val(data.pname);
					document.location.href = data.product_link;
				})
		});
	</script>

<?php }?><?php }} ?>
