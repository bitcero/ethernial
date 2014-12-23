<div class="mywords-tags-container">
<{foreach item=tag from=$block.tags}>
    <a href="<{$tag.link}>" style="font-size: <{$tag.size}>em;"><{$tag.name}></a>
<{/foreach}>
</div>