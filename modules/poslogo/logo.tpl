<div class="pos-logo">
	<div class="title_block">
		<h3>{l s='BRAND & CLIENTS' mod='poslogo'}</h3>
		<div class="navi">
			<a class="prevtab"><i class="icon-angle-left"></i></a>
			<a class="nexttab"><i class="icon-angle-right"></i></a>
		</div>
	</div>
	<div class="pos-content-logo">
		<div class="row">
		<div class="pos-logo-slide">
			{foreach from=$logos item=logo name=posLogo}
				<div class="item">
				    <a href ="{$logo.link}">
						<img class="img-responsive" src ="{$logo.image}" alt ="{l s='Logo' mod='poslogo'}" />
				    </a>
				</div>
			{/foreach}
		</div>
		</div>
	</div>
</div>
<script type="text/javascript"> 
    $(document).ready(function() {
		var logo = $(".pos-logo-slide");
		logo.owlCarousel({
		items :{$slideOptions.min_item},
		itemsDesktop : [1024,4],
		itemsDesktopSmall : [900,3], 
		itemsTablet: [600,2], 
		itemsMobile : [480,1]
		});
		 
		// Custom Navigation Events
		$(".pos-logo .nexttab").click(function(){
		logo.trigger('owl.next');
		})
		$(".pos-logo .prevtab").click(function(){
		logo.trigger('owl.prev');
		})     
    });
</script>