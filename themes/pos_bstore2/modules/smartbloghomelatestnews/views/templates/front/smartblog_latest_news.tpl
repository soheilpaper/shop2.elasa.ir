
<div class="home_blog">
    <div class="title_block">
		<a class="blog_lnk" href="{smartblog::GetSmartBlogLink('smartblog')}">
			{l s='Latest News' mod='smartbloghomelatestnews'}
		</a>
		<div class="navi">
			<a class="prevtab"><i class="icon-angle-left"></i></a>
			<a class="nexttab"><i class="icon-angle-right"></i></a>
		</div>
	</div>
    <div class="block_content">
    <div class="row">
    <div class="blogSlider">
        {if isset($view_data) AND !empty($view_data)}
            {assign var='i' value=1}
            {foreach from=$view_data item=post}
                    {assign var="options" value=null}
                    {$options.id_post = $post.id}
                    {$options.slug = $post.link_rewrite}
                    <div class="blog_item">
                        <div class="blog_img_holder">
                             <a href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}"><img alt="{$post.title}" class="feat_img_small img-responsive" src="{$modules_dir}smartblog/images/{$post.post_img}-home-default.jpg"></a>
                        </div>
						<div class="blog_info">
							<a class="post_title" href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}">{$post.title}</a>
							<p>
								{$post.short_description|escape:'htmlall':'UTF-8'|truncate:100:'...'}
							</p>
							<span class="post_date"><i class="icon-calendar"></i>{$post.date_added}</span>
							<div class="rd_more">
								<a href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}">{l s='Read More' mod='smartbloghomelatestnews'}&nbsp;&nbsp;&nbsp;<i class="icon-long-arrow-right"></i></a>
							</div>
						</div>
                    </div>
                
                {$i=$i+1}
            {/foreach}
        {/if}
     </div>
     </div>
     </div>
</div>
<script>
	$(document).ready(function() {
		var blogSlider = $(".blogSlider");
		blogSlider.owlCarousel({
			items : 4,
			itemsDesktop : [1199,3],
			itemsDesktopSmall : [991,3], 
			itemsTablet: [767,2], 
			itemsMobile : [480,1],
			autoPlay :  false,
			stopOnHover: false,
		});
		
		// Custom Navigation Events
		$(".home_blog .nexttab").click(function(){
		blogSlider.trigger('owl.next');})
		$(".home_blog .prevtab").click(function(){
		blogSlider.trigger('owl.prev');})   
	});
</script>