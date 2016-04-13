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
    'ab7b78b10c2f3f8d831698582650c9439e15ccdc' => 
    array (
      0 => '/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/modules/possearchcategories/possearch-instantsearch.tpl',
      1 => 1403318600,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31854619155ef2f5417b7e0-85428701',
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55ef5a281a5c08_95654458',
  'has_nocache_code' => false,
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55ef5a281a5c08_95654458')) {function content_55ef5a281a5c08_95654458($_smarty_tpl) {?>
<!-- pos search module TOP -->
<div id="pos_search_top" class="wrap_seach list-inline">
	<form method="get" action="http://shop2.elasa.ir/index.php?controller=search" id="searchbox" class="form-inline form_search" role="form">
		<label for="pos_query_top"><!-- image on background --></label>
        <input type="hidden" name="controller" value="search" />
        <input type="hidden" name="orderby" value="position" />
        <input type="hidden" name="orderway" value="desc" />
			<div class="pos_search form-group">
                                    <select name="poscats" class="selectpicker">
					 <option value="">Categories</option>
                        <option value="3">--nozzles </option><option value="5">---Nozzles dancing devil </option><option value="12">--fountain water pump </option><option value="27">---santrifiuj </option><option value="13">--LED Lamps </option><option value="26">--The lighting </option>
                    </select>
                            </div>
			<input class="search_query form-control" type="text" placeholder="Enter your search key ... " id="pos_query_top" name="search_query" value="" />
			<button type="submit" name="submit_search" value="Search" class="btn btn-default submit_search">
				<i class="icon-search"></i>
			</button>
    </form>
</div>
	<script type="text/javascript">
	// <![CDATA[
		$('document').ready( function() {
			$("#pos_query_top")
				.autocomplete(
					'http://shop2.elasa.ir/index.php?controller=search', {
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
							id_lang: 1
						}
					}
				)
				.result(function(event, data, formatted) {
					$('#pos_query_top').val(data.pname);
					document.location.href = data.product_link;
				})
		});
	</script>



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
