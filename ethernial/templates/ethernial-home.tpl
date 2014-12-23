<!-- Header -->
<header id="header" style="opacity: 0;">

    <div class="background"></div>
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

    <!-- Inner -->
    <div class="inner" data-velocity="0.2">
        <header>
            <h1><a href="index.html" id="logo"><{$theme->settings('logo_text')}></a></h1>
            <p><{$theme->settings('slogan')}></p>
        </header>
        <footer>
            <a href="#welcome-message" class="btn btn-danger scrolly">Start</a>
        </footer>
    </div>

</header>

<!-- Banner -->
<section id="welcome-message" class="text-center">
    <header>
        <h2><{$theme->settings('welcome')}></h2>
        <p>
            <{$theme->settings('tagline')}>
        </p>
    </header>
</section>

<!-- Carousel -->
<div class="carousel-container">
    <section class="ether-carousel">

        <div class="inner">
            <{assign var=projects value=$ether->works(10)}>
            <{foreach item=project from=$projects}>
                <article>
                    <a href="<{$project.link}>"><img src="<{resize file=$project.image w=500 h=333}>" alt="<{$project.title}>" class="img-responsive"></a>
                    <header>
                        <h3><a href="<{$project.link}>"><{$project.title}></a></h3>
                    </header>
                    <p><{$project.description}></p>
                </article>
            <{/foreach}>
        </div>

    </section>

    <span class="fa fa-angle-left backward"></span>

    <span class="fa fa-angle-right forward"></span>
</div>

<{assign var=page value=$ether->page($theme->settings('page'))}>
<!-- Main -->
<{if $page}>
    <div class="container-fluid white-bg" id="home-page">

        <div class="container">
            <article class="row">
                <div class="col-sm-6 col-md-5">
                    <img src="<{resize file=$page->image w=700 h=500}>" class="img-responsive">
                </div>
                <div class="col-sm-6 col-md-7">
                    <header>
                        <h2><a href="<{$theme->settings('page_link')}>"><{$page->title}></a></h2>
                        <{$page->content}>
                    </header>
                    <footer>
                        <a href="<{$theme->settings('page_link')}>" class="btn btn-danger"><{$lang_continue_reading}></a>
                    </footer>
                </div>
            </article>
        </div>

    </div>
<{/if}>

<{assign var=posts value=$ether->posts(4)}>
<!-- Recent in Blog -->
<{if $posts}>
    <div class="container-fluid" id="recent-blog">

        <div class="container">

            <h2 class="text-center"><{$lang_recent_blog}></h2>

            <section class="row">
                <{foreach item=post from=$posts}>
                    <article class="col-sm-6 col-md-3 text-center">
                        <a href="<{$post->permalink()}>">
                            <img src="<{resize file=$ether->image_url($post->image) w=500 h=333}>" alt="<{$post->title}>" class="img-responsive">
                        </a>
                        <header>
                            <h3><a href="<{$post->permalink()}>"><{$post->title}></a></h3>
                        </header>
                        <p><{$post->content|strip_tags|truncate:50:' [...]'}></p>
                    </article>
                <{/foreach}>
            </section>

        </div>

    </div>
<{/if}>