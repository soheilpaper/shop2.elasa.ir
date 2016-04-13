{if $telnumber != ''}
	<div id="contact_block">
		<h3>{l s='call us free' mod='blockcontact'}</h3>
		<span>{$telnumber|escape:'html':'UTF-8'}</span>
	</div>
{/if}