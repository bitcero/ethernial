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

function ethernial_tweetie_show( $options ){

    RMTemplate::get()->add_script( XOOPS_THEME_URL . '/ethernial/blocks/tweetie/tweetie.min.js' );
    $params = '{';
    foreach( $options as $name => $value ){

        if ( $value == '' )
            continue;

        switch( $name ){
            case 'consumer_key':
            case 'consumer_secret':
            case 'access_token':
            case 'access_secret':
                break;
            case 'date':
                $name = 'dateFormat';
                $params .= ($params == '{' ? '' : ', ') . $name . ': ' . '"' . $value . '"';
                break;
            case 'replies':
                $name = 'hideReplies';
                $value = $value == 1 ? 'false' : 'true';
                $params .= ($params == '{' ? '' : ', ') . $name . ': ' . $value;
                break;
            case 'count':
                $params .= ($params == '{' ? '' : ', ') . $name . ': ' . $value;
                break;
            default:
                $params .= ($params == '{' ? '' : ', ') . $name . ': ' . '"' . $value . '"';
                break;
        }

    }
    $params .= ', apiPath: "' . XOOPS_THEME_URL . '/ethernial/blocks/tweetie/tweet.php"}';

    $block['params'] = $params;
    $block['container'] = RMUtilities::randomString( 5, true, false, true, true );

    return $block;

}

function ethernial_tweetie_edit( $options ){
    ob_start();
    ?>

    <div class="panel panel-danger">
        <div class="panel-heading">
            <h3 class="panel-title">Authorization Fields</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="consumer-key"><?php _e('Consumer key', 'ethernial'); ?></label>
                        <input type="text" class="form-control" value="<?php echo $options['consumer_key']; ?>" name="options[consumer_key]" id="consumer-key">
                        <small class="help-block"><?php _e('Get one from dev.twitter.com/apps.', 'ethernial'); ?></small>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="access-token"><?php _e('Access token', 'ethernial'); ?></label>
                    <input type="text" class="form-control" value="<?php echo $options['access_token']; ?>" name="options[access_token]" id="access-token">
                    <small class="help-block"><?php _e('Get one from dev.twitter.com/apps.', 'ethernial'); ?></small>
                </div>
            </div>

            <div class="row ">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="consumer-secret"><?php _e('Consumer secret key', 'ethernial'); ?></label>
                        <input type="text" class="form-control" value="<?php echo $options['consumer_secret']; ?>" name="options[consumer_secret]" id="consumer-secret">
                        <small class="help-block"><?php _e('Get one from dev.twitter.com/apps.', 'ethernial'); ?></small>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="access-secret"><?php _e('Access token secret', 'ethernial'); ?></label>
                    <input type="text" class="form-control" value="<?php echo $options['access_secret']; ?>" name="options[access_secret]" id="access-secret">
                    <small class="help-block"><?php _e('Get one from dev.twitter.com/apps.', 'ethernial'); ?></small>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-sm-6">
            <label for="tw-username"><?php _e('Username', 'ethernial'); ?></label>
            <input type="text" name="options[username]" value="<?php echo $options['username']; ?>" class="form-control" id="tw-username">
            <small class="help-block"><?php _e('Option to load tweets from another account or list owner\'s username.', 'ethernial'); ?>'</small>
        </div>
        <div class="col-sm-6">
            <label for="tw-list"><?php _e('List', 'ethernial'); ?></label>
            <input type="text" name="options[list]" value="<?php echo $options['list']; ?>" class="form-control" id="tw-list">
            <small class="help-block"><?php _e('List name to load tweets from. If you define list name you also must define the username of the list owner in the username option.', 'ethernial'); ?>'</small>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <label for="tw-hashtag"><?php _e('Hashtag', 'ethernial'); ?></label>
            <input type="text" name="options[hashtag]" value="<?php echo $options['hashtag']; ?>" class="form-control" id="tw-hashtag">
            <small class="help-block"><?php _e('Option to load tweets with a specific hashtag.', 'ethernial'); ?>'</small>
        </div>
        <div class="col-sm-6">
            <label for="tw-count"><?php _e('Twets count', 'ethernial'); ?></label>
            <input type="text" name="options[count]" value="<?php echo $options['count']; ?>" class="form-control" id="tw-count">
            <small class="help-block"><?php _e('Number of tweets you want to display.', 'ethernial'); ?>'</small>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <label for="tw-replies"><?php _e('Show replies', 'ethernial'); ?></label>
            <span class="clearfix"></span>
            <label class="checkbox-inline">
                <input type="radio" value="1" name="options[replies]"<?php echo $options['replies']==1 ? ' checked' : ''; ?>> <?php _e('Show', 'ethernial'); ?>
            </label>
            <label class="checkbox-inline">
                <input type="radio" value="0" name="options[replies]"<?php echo $options['replies']==1 ? '' : ' checked'; ?>> <?php _e('Hide', 'ethernial'); ?>
            </label>
            <small class="help-block"><?php _e('Select "Hide" if you want to hide "@" replies as well.', 'ethernial'); ?>'</small>
        </div>
        <div class="col-sm-6">
            <label for="tw-date"><?php _e('Date format', 'ethernial'); ?></label>
            <input type="text" name="options[date]" value="<?php echo $options['date']; ?>" class="form-control" id="tw-date">
            <small class="help-block"><?php echo sprintf(__('Your date format, reference %s table for available formats.', 'ethernial'), '<a href="https://github.com/sonnyt/Tweetie#date-format">' . __('this', 'ethernial') . '</a>'); ?>'</small>
        </div>
    </div>

    <div class="form-group">
        <label for="tw-template"><?php _e('Template', 'ethernial'); ?></label>
        <textarea name="options[template]" class="form-control" id="tw-template" rows="4"><?php echo TextCleaner::getInstance()->specialchars( $options['template'] ); ?></textarea>
        <small class="help-block"><?php echo sprintf( __('Format how you want to show your tweets. Feel free to add HTML, see %s table for more refrence.', 'ethernial'), '<a href="https://github.com/sonnyt/Tweetie#templating">' . __('this', 'ethernial') . '</a>' ); ?></small>
    </div>

    <?php
    $form = ob_get_clean();
    return $form;
}

/**
 * Get the mywords categories
 */
if(!function_exists("onfocus_mywords_categories")){
    function onfocus_mywords_categories(){

        static $mw_categos;
        xoops_load('mwfunctions', 'mywords');

        if(!empty($mw_categos)) return $mw_categos;

        $categos = array();

        MWFunctions::categos_list($categos);

        $mw_categos[0] = __('All categories','onfocus');
        foreach($categos as $cat){
            $mw_categos[$cat['id_cat']] = str_repeat("&#151;", $cat['indent']) . $cat['name'];
        }

        return $mw_categos;

    }
}