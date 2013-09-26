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
 * Class StylesLoader
 *
 * @package WCM\AssetBundle
 * @author Franz Josef Kaiser <wecodemore@gmail.com>
 */
final class StylesFactory extends AbstractAssetFactory
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
	 * Sets the type to CSS/Stylesheets.
	 * @return string
	 */
	public function getType()
	{
		return "css";
	}

	/**
	 * Registers a file if it isn't already registered.
	 * @param int $offset
	 */
	public function register( $offset )
	{
		$files = $this->getFiles();
		$style = $files[ $offset ];
		$handle = $this->getHandle( $style );
		! wp_style_is( $handle, 'registered' ) AND wp_register_style(
			$handle,
			$this->getUrl( $style ),
			array(),
			$this->getVersion( $style )
		);
	}

	/**
	 * Enqueues a file if it isn't already in the enqueue.
	 * @param int $offset
	 */
	public function enqueue( $offset )
	{
		$handle = $this->getHandle( $offset );
		! wp_style_is( $handle )
			AND wp_enqueue_style( $handle );
	}
}