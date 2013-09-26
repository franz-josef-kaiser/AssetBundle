<?php

/**
 * This file is part of the WCM\AssetBundle package, a WeCodeMore project.
 *
 * © 2013 WeCodeMore
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WCM\AssetBundle\Services;

defined( 'ABSPATH' ) OR exit;

/**
 * Class DependencyInterface
 *
 * @package WCM\AssetBundle
 * @author Franz Josef Kaiser <wecodemore@gmail.com>
 */
interface AssetInterface extends \Countable, \ArrayAccess, \Traversable
{
	/**
	 * Set the prefix for the Dependency Handle
	 * @param  string $prefix
	 * @return string
	 */
	public function setPrefix( $prefix );

	/**
	 * Set the Dependency Directory Path
	 * @param  string $path
	 * @return string
	 */
	public function setPath( $path );

	/**
	 * Set the Dependency Directory URL
	 * @param  string $url
	 * @return string
	 */
	public function setUrl( $url );

	/**
	 * Return the Dependency Handle prefix
	 * @return string
	 */
	public function getPrefix();

	/**
	 * Return the file type.
	 * @example "css"
	 * @return string
	 */
	public function getType();

	/**
	 * Return the path to the Dependencies directory
	 * @return string
	 */
	public function getPath();

	/**
	 * Return the URL to the Dependencies directory
	 * @param  string $file
	 * @return string
	 */
	public function getUrl( $file );

	/**
	 * Returns the handle used to identify the current Dependency.
	 * @param  string $file
	 * @return string
	 */
	public function getHandle( $file );

	/**
	 * Returns an array of all Dependencies of the current instance.
	 * @return array
	 */
	public function getFiles();

	/**
	 * Return the last time where the file was changed.
	 * To be used as query arg on the file to prevent browsers
	 * caching files upon change.
	 * @param  string $file
	 * @return string
	 */
	public function getVersion( $file );

	/**
	 * Register a dependency.
	 * Gets called during looping.
	 * @param  int $offset
	 * @return void
	 */
	public function register( $offset );

	/**
	 * Load a Dependency.
	 * Gets called during looping.
	 * @param  int $offset
	 * @return mixed
	 */
	public function enqueue( $offset );
}