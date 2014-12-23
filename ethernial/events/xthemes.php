<?php

class EthernialThemeXthemesPreload
{

    public function eventXthemeSaveSettings( $settings ){

        $settings = (object) $settings;

        $less_path = XOOPS_THEME_PATH . '/ethernial/less';
        $css_path = XOOPS_CACHE_PATH . '/ethernial';
        if ( !is_dir( $css_path ) )
            mkdir( $css_path, 0777 );

        $files = array();

        if ( $settings->bootstrap )
            $files[] = 'bootstrap.less';

        if ( $settings->ethernial )
            $files[] = 'styles.less';

        if ( $settings->mywords ) {
            $files[] = 'mywords.less';
            $files[] = 'mywords-blocks.less';
        }

        if ( $settings->qpages )
            $files[] = 'qpages.less';

        if ( $settings->docs ) {
            $files[] = 'docs.less';
        }

        if (empty( $files ) )
            return;

        ob_start();
        include $less_path . '/variables.less';
        $variables = ob_get_clean();
        include_once XOOPS_THEME_PATH . '/ethernial/assemble/compiler/Less.php';

        foreach( $files as $file ){
            $less = new Less_Parser( array( 'compress' => true ) );
            $less->SetImportDirs( array(
                $less_path => '/ethernial/',
                $less_path . '/mixins' => '/ethernial/'
            ) );
            $file_content = str_replace('@import "variables.less";', '', file_get_contents( $less_path . '/' . $file ) );

            if ( $settings->ethernial && $file == 'styles.less' )
                $file_content .= $settings->css;

            $less->parse( $variables . "\n" . $file_content );
            $css = $less->getCss();
            file_put_contents( $css_path . '/' . str_replace( array('less', '/'), array('css', '-'), $file), $css );
            $css = '';
        }

    }

}