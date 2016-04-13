
<script type="text/javascript">
window.___gcfg =  {ldelim}
	lang: '{$gpo_lang_code}',
  parsetags: 'onload'
{rdelim};

(function() {ldelim}
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  {rdelim})();
</script>
{if $gpo_cover && $gpo_cover != ''}
<!-- Update your html tag to include the itemscope and itemtype attributes. -->
<html itemscope itemtype="http://schema.org/Product">

<!-- Add the following three tags inside head. -->
<meta itemprop="image" content="{$gpo_cover}">
{/if}