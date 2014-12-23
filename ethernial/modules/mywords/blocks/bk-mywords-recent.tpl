<div class="mwrecent-block">
    <ul>
    <{foreach item=post from=$block.posts}>
	    <li>
            <img src="<{resize file=$post.image w=200 h=200}>" class="post-image pull-left" alt="<{$post.title}>">
            <div class="post-info">
                <a href="<{$post.link}>"><{$post.title}></a><br />
                <{if $post.date}><small><{$post.date}></small><{/if}>
                <{if $post.hits!=''}><small><{if $post.date}> - <{/if}><{$post.hits}></small><{/if}>
                <{if $post.comments!=''}><small><{if $post.date}> - <{/if}><{$post.comments}></small><{/if}>
                <{if $post.content!=''}><br /><{$post.content}><{/if}>
            </div>
	    </li>
    <{/foreach}>
    </ul>
</div>