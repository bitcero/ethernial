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

class Ethernial_Helper
{

    /**
     * Get works from Professional Works
     * @param int $limit Max number of items to get
     * @param int $length Description length in chars
     * @return array
     */
    public function works( $limit, $length = 50 ){

        $works = Works_Functions::get_works( $limit, null, 'public', false, '', $length );
        return $works;

    }

    /**
     * Get a specific page from QuickPages
     * @param int $id Page identifier
     * @return null|QPPage
     */
    public function page( $id ){

        if ( $id <= 0 )
            return null;

        include_once XOOPS_ROOT_PATH . '/modules/qpages/class/qppage.class.php';

        $id = intval( $id );
        $page = new QPPage( $id );
        $page->image = RMImage::get()->load_from_params( $page->getVar('image', 'e') );
        if ( $page->isNew() )
            return null;

        return $page;

    }

    public function posts( $limit ){

        include_once XOOPS_ROOT_PATH . '/modules/mywords/class/mwfunctions.php';
        $posts = MWFunctions::get_posts( 0, $limit );
        return $posts;

    }

    public function image_url( $params ){

        if ( $params == '' )
            return '';

        return RMImage::get()->load_from_params( $params );

    }

    public function block_title( $title ){

        if ( preg_match( "/^fa /", $title ) )
            return '<span class="' . $title . ' block-title"></span>';
        else
            return '<h4>' . $title . '</h4>';

    }

    public function related_columns(){
        $mc = RMSettings::module_settings( 'mywords' );
        $cols = ceil(12 / $mc->related_num);
        return $cols;
    }

}