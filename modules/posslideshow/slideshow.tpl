<div class="pos-slideshow">
	<div class="flexslider ma-nivoslider">
        <div class="pos-loading"></div>
            <div id="pos-slideshow-home" class="slides">
				
                {$count=0}
                {foreach from=$slides key=key item=slide}
					
                    <img style ="display:none" src="{$slide.image}"  data-thumb="{$slide.image}"  alt="" title="#htmlcaption{$slide.id_pos_slideshow}"  />
			   {/foreach}
            </div>
            {if $slideOptions.show_caption != 0}
                {foreach from=$slides key=key item=slide}
                    <div id="htmlcaption{$slide.id_pos_slideshow}" class="pos-slideshow-caption nivo-html-caption nivo-caption">
							<div class="timing-bar" style=" 
								position:absolute;
								top:0;
								left:0;
								z-index: 9;
								background-color: rgba(255, 255, 255, 0.7);
								height:3px;
								-webkit-animation: myfirst {if $slideOptions.pause_time != ''}{$slideOptions.pause_time}{else}4000{/if}ms ease;
								-moz-animation: myfirst {if $slideOptions.pause_time != ''}{$slideOptions.pause_time}{else}4000{/if}ms ease;
								-ms-animation: myfirst {if $slideOptions.pause_time != ''}{$slideOptions.pause_time}{else}4000{/if}ms ease;
								animation: myfirst {if $slideOptions.pause_time != ''}{$slideOptions.pause_time}{else}4000{/if}ms ease;
							"></div>
							<div class="pos-slideshow-info pos-slideshow-info{$slide.id_pos_slideshow}">
								<!-- <div class="pos-slideshow-title">
									   <h3>{$slide.title}</h3>
								</div> -->
								<div class="pos_description hidden-xs hidden-sm">
										{$slide.description}
								</div>
								{if $slide.link}
								<div class="pos-slideshow-readmore hidden">
									<a href="{$slide.link}" title="{l s=('Shop now') mod='posslideshow'}">{l s=('Shop now') mod='posslideshow'}</a>	
								</div>
								{/if}
							</div>
                    </div>
                 {/foreach}
             {/if}
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
			effect: '{if $slideOptions.animation_type != ''}{$slideOptions.animation_type}{else}random{/if}',
			slices: 15,
			boxCols: 8,
			boxRows: 4,
			animSpeed: '{if $slideOptions.animation_speed != ''}{$slideOptions.animation_speed}{else}600{/if}',
			pauseTime: '{if $slideOptions.pause_time != ''}{$slideOptions.pause_time}{else}5000{/if}',
			startSlide: {if $slideOptions.start_slide != ''}{$slideOptions.start_slide}{else}0{/if},
			directionNav: {if $slideOptions.show_arrow != 0}{$slideOptions.show_arrow}{else}false{/if},
			controlNav: {if $slideOptions.show_navigation != 0}{$slideOptions.show_navigation}{else}false{/if},
			controlNavThumbs: false,
			pauseOnHover: false,
			manualAdvance: false,
			prevText: '<i class="icon-angle-left"></i>',
			nextText: '<i class="icon-angle-right"></i>',
 		});
    });
</script>
