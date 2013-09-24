<?php

/**
 * This file is part of the WCM\AssetBundle package, a WeCodeMore project.
 *
 * © 2013 WeCodeMore
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WCM\AssetBundle;

use WCM\AssetBundle\AbstractAssetFactory;

defined( 'ABSPATH' ) OR exit;

/**
 * Class ScriptsFactory
 *
 * @package WCMAdminCalendar
 */
final class ScriptsFactory extends AbstractAssetFactory
{
	/**
	 * Receives the arguments and passes it to the parent class.
	 * @param string $prefix
	 * @param string $path
	 * @param string $url
	 * @param array  $files
	 */
	public function __construct( $prefix, $path, $url, $files )
	{
		parent::__construct( $prefix, $path, $url, $files );
	}

	/**
	 * Sets the type to JavaScript.
	 * @return string
	 */
	public function getType()
	{
		return "js";
	}

	/**
	 * Registers a file if it isn't already registered.
	 * @param int $offset
	 */
	public function register( $offset )
	{
		$files = $this->getFiles();
		$script = $files[ $offset ];
		$handle = $this->getHandle( $script );
		! wp_script_is( $handle, 'registered' ) AND wp_register_script(
			$handle,
			$this->getUrl( $script ),
			array( 'jquery' ),
			$this->getVersion( $script ),
			true
		);
	}

	/**
	 * Enqueues a file if it isn't already in the queue.
	 * @param int $offset
	 */
	public function enqueue( $offset )
	{
		$handle = $this->getHandle( $offset );
		! wp_script_is( $handle )
			AND wp_enqueue_script( $handle );
	}
}