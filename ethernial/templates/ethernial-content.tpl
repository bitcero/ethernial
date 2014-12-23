<!-- Header -->
<header id="header" class="header-content">
    <!-- Nav -->
    <nav id="navigation" class="navbar navbar-default" role="navigation">
        <div class="container-fluid text-center">

            <div class="collapse navbar-collapse" id="main-navigation">
                <ul class="nav navbar-nav">

                    <{foreach item=menu from=$theme->menu('main')}>
                        <li<{if $menu.submenu}> class="dropdown"<{/if}>>
                            <a target="<{$menu.target}>" rel="<{$menu.rel}>" href="<{$menu.url}>"<{if $menu.submenu}> data-toggle="dropdown" class="dropdown-toggle"<{/if}>>
                                <{$menu.title}>
                                <{if $menu.submenu}>
                                    <span class="caret"></span>
                                <{/if}>
                            </a>
                            <{if $menu.submenu}>
                                <ul class="dropdown-menu animated fadeInDown" role="menu">
                                    <{foreach item=sub from=$menu.submenu}>
                                        <li>
                                            <a target="<{$sub.target}>" rel="<{$sub.rel}>" href="<{$sub.url}>"><{$sub.title}></a>
                                        </li>
                                    <{/foreach}>
                                </ul>
                            <{/if}>
                        </li>
                    <{/foreach}>

                </ul>
            </div>

        </div>
    </nav>

    <div class="container">
        <h1><{if $xoops_moduletitle != ''}><{$xoops_moduletitle}><{else}><{$xoops_pagetitle}><{/if}></h1>
    </div>

</header>

<div class="container">

    <div class="row">

        <!-- Left blocks -->
        <{if $theme->settings('sidebar')=='left'}>
            <{if $xoBlocks.ether_sidebar}>
            <div class="col-sm-4 left-blocks">
                <ul class="sidebar">
                <{foreach item=block key=i from=$xoBlocks.ether_sidebar}>
                    <li id="<{$i}>" class="block-item">
                        <h4 class="block-title"><{$block.title}></h4>
                        <div class="block-content">
                            <{$block.content}>
                        </div>
                    </li>
                <{/foreach}>
                </ul>
            </div>
            <{/if}>
        <{/if}>

        <!-- Main contents -->
        <div class="<{if $xoBlocks.ether_sidebar}>col-sm-8<{else}>col-xs-12<{/if}><{if $theme->settings('sidebar')=='left'}>  xoops-contents-left<{elseif $theme->settings('sidebar')=='right'}>  xoops-contents-right<{/if}>">
            <{$xoops_contents}>
        </div>

        <!-- Right blocks -->
        <{if $theme->settings('sidebar')=='right'}>
            <{if $xoBlocks.ether_sidebar}>
                <div class="col-sm-4 right-blocks">
                    <ul class="sidebar">
                        <{foreach item=block key=i from=$xoBlocks.ether_sidebar}>
                            <li id="<{$i}>" class="block-item">
                                <h4 class="block-title"><{$block.title}></h4>
                                <div class="block-content">
                                    <{$block.content}>
                                </div>
                            </li>
                        <{/foreach}>
                    </ul>
                </div>
            <{/if}>
        <{/if}>

    </div>

</div>