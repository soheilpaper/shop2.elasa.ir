<div class="navleft-container hidden-xs">
	<div class="pt_vmegamenu_title">
		<h2>{l s='Category' mod='posvegamenu'}</h2>
	</div>
    <div id="pt_vmegamenu" class="pt_vmegamenu">
        {$megamenu}
    </div>
<div class="clearfix"></div>
</div>

<script type="text/javascript">
//<![CDATA[
var VMEGAMENU_POPUP_EFFECT = {$effect};
//]]>

$(document).ready(function(){
    $("#pt_ver_menu_link ul li").each(function(){
        var url = document.URL;
        $("#pt_ver_menu_link ul li a").removeClass("act");
        $('#pt_ver_menu_link ul li a[href="'+url+'"]').addClass('act');
    }); 
        
    $('.pt_menu.active').hover(function(){
        if(VMEGAMENU_POPUP_EFFECT == 0) $(this).find('.popup').stop(true,true).slideDown('');
        if(VMEGAMENU_POPUP_EFFECT == 1) $(this).find('.popup').stop(true,true).fadeIn('');
        if(VMEGAMENU_POPUP_EFFECT == 2) $(this).find('.popup').stop(true,true).show('');
    },function(){
        if(VMEGAMENU_POPUP_EFFECT == 0) $(this).find('.popup').stop(true,true).slideUp('');
        if(VMEGAMENU_POPUP_EFFECT == 1) $(this).find('.popup').stop(true,true).fadeOut('');
        if(VMEGAMENU_POPUP_EFFECT == 2) $(this).find('.popup').stop(true,true).hide('');
    });
});
</script>