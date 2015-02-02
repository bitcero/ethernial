<?php

class EthernialThemeRmcommonPreload
{

    public function eventRmcommonGetStyles( $styles ){
        global $etherStyles;
        $css_url = XOOPS_THEME_URL . '/ethernial/css';

        if ( isset( $styles['bootstrap'] ) )
            $etherStyles[] = 'bootstrap.css';

        if ( isset( $styles['ethernialstylesphpsrcstylescss'] ) )
            $etherStyles[] = 'styles.css';

        if ( isset( $styles['mywordsmywordscss'] ) )
            $etherStyles[] = 'mywords.css';

        if ( isset( $styles['mywordsmwblockscss'] ) )
            $etherStyles[] = 'mywords-blocks.css';

        if ( isset( $styles['qpagesmaincss'] ) )
            $etherStyles[] = 'qpages.css';

        if ( isset( $styles['docsstandalonecss'] ) )
            $etherStyles[] = 'docs.css';

        $styles['bootstrap']['url'] = $css_url . '/styles.php?src=' . implode(",", $etherStyles);

        /*if ( isset( $styles['mywordsmwblockscss'] ) )
            $styles['mywordsmwblockscss']['url'] = $css_url . '/styles.php?src=mywords-mwblocks.css';*/

        unset($styles['rmcommonpagenavcss']);
        //unset($styles['rmcommoncommentscss']);
        unset($styles['ethernialstylesphpsrcstylescss']);
        unset($styles['mywordsmywordscss'], $styles['mywordsmwblockscss']);
        //unset($styles['qpagesmaincss']);
        //unset($styles['docsstandalonecss']);

        return $styles;
    }

    public function eventRmcommonBlockSaved( $block ){

        if ( $block->file != 'ethernial.tweetie.php' )
            return $block;

        $file = <<<CONFIG
<?php
    /**
     * Your Twitter App Info
     */

    // Consumer Key
    define('CONSUMER_KEY', '%s');
    define('CONSUMER_SECRET', '%s');

    // User Access Token
    define('ACCESS_TOKEN', '%s');
    define('ACCESS_SECRET', '%s');

	// Cache Settings
	define('CACHE_ENABLED', false);
	define('CACHE_LIFETIME', 3600); // in seconds
	define('HASH_SALT', md5(dirname(__FILE__)));
CONFIG;

        $options = $block->options;
        $file = sprintf( $file, $options['consumer_key'], $options['consumer_secret'], $options['access_token'], $options['access_secret'] );

        file_put_contents( XOOPS_CACHE_PATH . '/tweetie.php', $file );

        return $block;

    }



}