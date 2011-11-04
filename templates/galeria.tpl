{include file="header.tpl"}
{include file="menu.tpl"}
<div class="pikachoose">
	<ul id="pikame" class="jcarousel-skin-pika">
	{foreach from=$fotos item="foto"}
		<li>
			<a href="{$foto['content']}">
				<img src="{$foto['url']}"/>
			</a>
		</li>
	{/foreach}
	</ul>
</div>

{include file="footer.tpl"}
