<ul id="navigation"> 
{foreach from=$data key=title item=page} 
   <li> 
		<a href="{$SCRIPT_NAME}?view={$page}"> 
			{$title}<br /> 
		</a> 
	</li> 
{/foreach} 
</ul>
