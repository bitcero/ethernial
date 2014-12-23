<?php
/**
 * Ethernial Theme
 * A XOOPS theme designed for XOOPS and Common Utilities using xThemes
 * 
 * Copyright © 2014 Eduardo Cortés
 * -----------------------------------------------------------------
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 * -----------------------------------------------------------------
 * @package      Ethernial Theme
 * @author       Eduardo Cortés <yo@eduardocortes.mx>
 * @copyright    2009 - 2014 Eduardo Cortés
 * @license      GPL v2
 * @link         http://eduardocortes.mx
 * @link         http://xoopsmexico.net
 */

$GLOBALS['etherStyles'] = array();

class Ethernial extends XtTheme implements XtITheme
{
    /**
     * This function must return all information about
     * theme. The information must return as an array
     */
    public function details(){

        $details = array(
            'name' => 'Ethernial Theme',
            'description' => __('A XOOPS theme designed for XOOPS and Common Utilities and created by Eduardo Cortés.','ethernial'),
            'version' => '1.0.0',
            'author' => 'Eduardo Cortes (bitcero)',
            'uri' => 'http://xoopsmexico.net',
            'author_uri' => 'http://eduardocortes.mx',
            'author_email' => 'i.bitcero@gmail.com',
            'license' => 'GPL 2',
            'dir' => 'ethernial',
            'screenshot' => 'images/screenshot.jpg',
            'social' => array(
                'twitter' => 'http://www.twitter.com/bitcero/',
                'google-plus' => 'https://plus.google.com/u/0/115179107044073767092/',
                'linkedin' => 'http://www.linkedin.com/in/bitcero/',
                'instagram' => 'http://www.instagram.com/eduardocortesh/',
                'github' => 'http://github.com/bitcero/',
                'blog' => 'http://eduardocortes.mx/blog/',
            )
        );

        return $details;

    }

    public function haveMenus(){

        $menu['main'] = array(
            'title' => __('Menú principal', 'ethernial'),
            'levels' => 2
        );

        return $menu;

    }

    public function options(){
        global $xoopsConfig;

        $options = include('ether-settings.php');
        return $options;
    }

    public function init(){
        global $xoopsTpl, $xtAssembler, $xoopsModule;
        
        //RMTemplate::get()->add_style( $this->settings('sans_font') );
        //RMTemplate::get()->add_style( $this->settings('serif_font') );
        RMTemplate::get()->add_style( $this->settings('sansfont') );
        RMTemplate::get()->add_style( 'styles.php?src=bootstrap.css', 'ethernial', array(), 'theme' );
        RMTemplate::get()->add_style( 'styles.php?src=styles.css', 'ethernial', array(), 'theme' );
        RMTemplate::get()->add_style( 'animate.css', 'ethernial', array(), 'theme' );
        RMTemplate::get()->add_script( 'jquery.debounce.min.js', 'ethernial', array('footer' => 1 ), 'theme' );
        RMTemplate::get()->add_script( 'jquery.scrolly.js', 'ethernial', array('footer' => 1 ), 'theme' );

        if( !defined( 'XMEX_CLOSED' ) ){
            RMTemplate::get()->add_style( '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' );
            RMTemplate::get()->add_script( 'https://code.jquery.com/jquery-2.1.1.min.js' );
            RMTemplate::get()->add_script( '//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js', '', array( 'footer' => 1 ) );
        }

        if ( $xtAssembler->isHome() ){
            RMTemplate::get()->add_script( 'jquery.mousewheel.min.js', 'ethernial', array('footer' => 1 ), 'theme' );
            RMTemplate::get()->add_script( 'jquery.kinetic.min.js', 'ethernial', array('footer' => 1 ), 'theme' );

            //Language
            $xoopsTpl->assign('lang_continue_reading', __('Continue Reading', 'ethernial') );
            $xoopsTpl->assign('lang_recent_blog', __('Recent in Blog', 'ethernial') );

        } else {

            $xoopsTpl->assign( 'xoops_moduletitle', $xoopsModule ? $xoopsModule->getVar('name') : '' );
            $xoopsTpl->assign('lang_read_more', __('Read More &raquo;', 'ethernial') );

        }

        RMTemplate::get()->add_head_script('var bgheader = "' . $this->settings('bgheader') . '";');

        RMTemplate::get()->add_script( 'main.js', 'ethernial', array('footer' => 1 ), 'theme' );

        // Redirection messages
        if ( isset( $_SESSION['cu_redirect_messages'] ) ) {
            array_walk( $_SESSION['cu_redirect_messages'], function( &$item, $key ){

                $item['text'] = html_entity_decode( $item['text'] );

            });
            $xoopsTpl->assign('system_messages', $_SESSION['cu_redirect_messages'] );
            unset($_SESSION['cu_redirect_messages']);
        }


    }

    public function register(){
        $plugins[] = array(
            'name'  =>  'Ethernial_Helper',     // Class name
            'var'   =>  'ether',
            'file'  =>  'helper.class.php'
        );

        return $plugins;
    }

    public function on_install(){

        return true;

    }

    public function on_uninstall(){

        return true;
    }

    public function blocks_positions(){

        $positions = array(
            'ether_sidebar'    => __('Ethernial Lateral','ethernial'),
            'ether_footer'    => __('Ethernial Footer','ethernial')
        );

        return $positions;
    }

    public function blocks(){

        $blocks = array();

        /**
         * Recent posts for center position
         */
        $blocks[] = array(
            'file' => "ethernial.tweetie.php",
            'name' => __('Tweetie for Ethernial','ethernial'),
            'description' => __('Simple twitter feed block for Ethernial', 'ethernial'),
            'show_func' => "ethernial_tweetie_show",
            'edit_func' => "ethernial_tweetie_edit",
            'template' => 'ethernial-tweetie.tpl',
            'dirname' => 'ethernial',
            'type' => 'theme',
            'options' => array(
                'username'          => '',
                'list'              => '',
                'consumer_key'      => '',
                'consumer_secret'   => '',
                'access_token'      => '',
                'access_secret'     => '',
                'hashtag'           => '',
                'count'             => 5,
                'replies'           => 1,
                'date'              => '%b %d, %Y',
                'template'          => '{{avatar}}<em>{{date}}</em>em> <p>{{tweet}}</p>'
            )
        );

        return $blocks;

    }

    public function control_panel(){

    }
}