{include file="header.tpl"}
{include file="menu.tpl"}
{foreach from=$fotos item="foto"}
<form action=  "{$SCRIPT_NAME}?action=orderBy" method="post">
	<a href="{$SCRIPT_NAME}?action=foto&fotoId={$foto['id']}"><img src="{$foto['url']}"< /img></a>
{/foreach}

{include file="footer.tpl"}
