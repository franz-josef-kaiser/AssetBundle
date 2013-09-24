<?php

/*
 * This file is part of the WCM\AssetBundle package, a WeCodeMore project.
 *
 * © 2013 WeCodeMore
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

if ( ! $loader = @include __DIR__.'/../vendor/autoload.php' )
{
	die( 'You must set up the project dependencies, run the following commands:'.PHP_EOL.
		'curl -s http://getcomposer.org/installer | php'.PHP_EOL.
		'php composer.phar install'.PHP_EOL);
}

$loader->add( 'WCM\AssetBundle\Test', __DIR__ );