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

use WCM\AssetBundle\Services\AssetInterface;

defined( 'ABSPATH' ) OR exit;

/**
 * Class DependencyLoader
 *
 * @package WCM\AssetBundle
 * @author Franz Josef Kaiser <wecodemore@gmail.com>
 */
abstract class AbstractAssetFactory implements \Iterator, AssetInterface
{
	private $pointer = 0;

	private $path    = '';
	private $url     = '';
	private $prefix  = '';
	private $files   = array();

	/**
	 * Set all needed input arguments.
	 * @param string $prefix
	 * @param string $path
	 * @param string $url
	 * @param array  $files
	 */
	public function __construct( $prefix, $path, $url, $files )
	{
		$this->pointer = 0;

		$this->setPrefix( $prefix );
		$this->setPath( $path );
		$this->setUrl( $url );
		$this->setFiles( $files );
	}

	/**
	 * Fixes the prefix. In case.
	 * @param string $prefix
	 * @return string
	 */
	public function setPrefix( $prefix )
	{
		is_int( strrpos( $prefix, '_', -1 ) )
			AND $prefix = rtrim( $prefix, "_" );
		is_int( strrpos( $prefix, '-', -1 ) )
			AND $prefix = rtrim( $prefix, "-" );

		$this->prefix = "{$prefix}_";
	}

	/**
	 * @param $type
	 */
	public function setType( $type )
	{
		empty( $this->type )
			AND $this->type = $type;
	}

	/**
	 * @param string $path
	 */
	public function setPath( $path )
	{
		empty( $this->path )
			AND $this->path = \trailingslashit( $path );
	}

	/**
	 * @param string $url
	 */
	public function setUrl( $url )
	{
		empty( $this->url )
			AND $this->url = $url;
	}

	/**
	 * @param $files
	 */
	public function setFiles( $files )
	{
		$this->files = ! is_array( $files )
			? array( $files )
			: $files;
	}

	/**
	 * @return string
	 */
	public function getPrefix()
	{
		return $this->prefix;
	}

	/**
	 * @param string $file
	 * @return string
	 */
	public function getHandle( $file )
	{
		$offset = array_search( $file, $this->files );
		return $this->getPrefix().$this->files[ $offset ];
	}

	/**
	 * @return string
	 */
	abstract public function getType();

	/**
	 * @return string
	 */
	public function getPath()
	{
		return $this->path;
	}

	/**
	 * @param string $file
	 * @return string
	 */
	public function getUrl( $file )
	{
		$file = "{$file}{$this->getExt()}.{$this->getType()}";
		return \trailingslashit( $this->url ).$file;
	}

	public function getExt()
	{
		return ( ! defined( 'SCRIPT_DEBUG' ) OR ! SCRIPT_DEBUG ) ? '.min' : '';
	}

	/**
	 * @return array
	 */
	public function getFiles()
	{
		return $this->files;
	}

	/**
	 * @param string $file
	 * @return int|string
	 */
	public function getVersion( $file )
	{
		$file = "{$file}{$this->getExt()}.{$this->getType()}";
		return filemtime( $this->getPath().$file );
	}

	/**
	 * @return mixed
	 */
	public function current()
	{
		return $this->files[ $this->pointer ];
	}

	/**
	 *
	 */
	public function next()
	{
		++$this->pointer;
	}

	/**
	 * @return int|mixed
	 */
	public function key()
	{
		return $this->pointer;
	}

	/**
	 *
	 */
	public function rewind()
	{
		$this->pointer = 0;
	}

	/**
	 * @return bool
	 */
	public function valid()
	{
		return isset( $this->files[ $this->pointer ] );
	}

	/**
	 * @return int
	 */
	public function count()
	{
		return count( array_keys( $this->files ) );
	}

	/**
	 * @param mixed $offset
	 * @param mixed $value
	 */
	public function offsetSet( $offset, $value )
	{
		if ( null === $offset )
			$this->files[] = $value;
		else
			$this->files[ $offset ] = $value;
	}

	/**
	 * @param mixed $offset
	 * @return bool
	 */
	public function offsetExists( $offset )
	{
		return isset( $this->files[ $offset ] );
	}

	/**
	 * @param mixed $offset
	 */
	public function offsetUnset( $offset )
	{
		unset( $this->files[ $offset ] );
	}

	/**
	 * @param mixed $offset
	 * @return mixed|null
	 */
	public function offsetGet( $offset )
	{
		return isset( $this->files[ $offset ] )
			? $this->files[ $offset ]
			: null;
	}

	/**
	 * @param int $file
	 */
	abstract function register( $file );

	/**
	 * @param int $file
	 * @return mixed
	 */
	abstract function enqueue( $file );
}