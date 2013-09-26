<?php

namespace WCM\AssetBundle;

/**
 * Plugin Name: WCM Asset Bundle
 * Plugin URI:  http://github.com/franz-josef-kaiser/AssetBundle
 * Description: <strong>Needs PHP 5.3+</strong> Asset Management for WordPress. Only activate if you intend to use it as a standalone plugin.
 * Author:      Franz Josef Kaiser
 * Author URI:  http://unserkaiser.com
 * Text Domain: wcmab_textdomain
 * Domain Path: /Resources/translations
 * Network:
 * Version:     0.1.0-alpha
 */

defined( 'ABSPATH' ) OR exit;

require plugin_dir_path( __FILE__ ).'/vendor/autoload.php';

use WCM\AssetBundle\Services\ScriptsFactory,
	WCM\AssetBundle\Services\StylesFactory;

/**
 * Class WCMAssetBundle
 *
 * @package WCM\AssetBundle
 */
class WCMAssetBundle {
}