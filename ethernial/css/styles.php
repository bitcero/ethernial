<?php
$xoopsOption['nocommon'] = 1;
require '../../../mainfile.php';

$css_path = XOOPS_VAR_PATH . '/caches/xoops_cache/ethernial';

$files = isset($_GET['src']) ? $_GET['src'] : '';
if ( $files == '' ){
    echo "/** INVALID INPUT **/";
    exit();
}

$files = str_replace( array('../', '/'), '', $files );
$files = explode( ",", $files );
$css_strings = '';

foreach( $files as $src ){

    if ( substr( $src, -3 ) != 'css' )
        $src .= '.css';

    if ( !file_exists( $css_path . '/' . $src ) || dirname( $css_path . '/' . $src ) != $css_path )
        continue;

    $css_strings .= file_get_contents( $css_path . '/' . $src );
    //$css_content = str_replace( 'slider-and-featured.css', 'styles.php?src=slider-and-featured.css', $css_content );

}

header('Content-Type: text/css');
echo $css_strings;
exit();