# WCM Asset Bundle

An easy to use Stylesheets & Javascript Asset/Dependency Loader for WordPress.

## What it does

The WCM Dependency Loader loads files and scripts enables the developer to register, queue,
count and loop all files. Scripts get added after the content to the `wp_footer` hook in themes.
All files get a query arg added, which is the UNIX timestamp of date where the files
contents were changed the last time. This helps cache busting in browsers, while still
enabling them to cache files as long as they didn't change.

The folder structure inherits from the
[Symfony2 cookbook recommendation](http://symfony.com/doc/current/cookbook/bundles/best_practices.html).

## Install

Best installed using Composer. But as well supports *npm*, *bower* and the *component* package managers.

### Composer

This example composer file will install the dev/master branch from the GitHub account.
It will run `npm install` after `composer install` and `npm update` after `composer update`.

```
{
	"config" : {
		"vendor-dir" : "vendor"
	},
	"require" : {
		"php" :             ">=5.3.3",
		"wcm/assetbundle" : "dev-master"
	},
	"repositories": [
		{
			"type" : "git",
			"url" :  "git://github.com/franz-josef-kaiser/AssetBundle.git"
		}
	],
	"minimum-stability" : "dev",
	"scripts" : {
		"post-install-cmd" : "npm install",
		"post-update-cmd" :  "npm update"
	},
	"autoload" : {
		"psr-0" : {
			"YourPluginName" : "src/"
		}
	}
}
```

## How To

Example script loading using a method.
The file `filename` will get loaded (to the footer).
Minified/Uglified scripts expected to have the `.min` extension.
Expected to have the scripts in a folder structure like you know it from
common node and similar projects: `assets/scripts/vendor/your-dependency/filename.ext`.
Such structure makes it easier to exclude all shared third party code
in a `.gitignore` file by a single folder name.

```
public function loadScripts( $hook_suffix )
{
	$path = 'assets/scripts/vendor/your-dependency';
	$loader = new ScriptsLoader(
		'some-handle',
		plugin_dir_path( __FILE__ ).$path,
		plugins_url( $path, __FILE__ ),
		array( 'filename' )
	);
	foreach ( $loader as $offset => $script )
	{
		$loader->register( $offset );
		$loader->enqueue( $offset );
	}
}
```

Example style loading using a method.
Loads a file named `style.css` from the `~/assets/css` folder.
Appends `.min.css` if `SCRIPT_DEBUG` isn't set to `true`.

```
public function loadStyles( $hook_suffix )
{
	$loader = new StylesLoader(
		'some-handle',
		plugin_dir_path( __FILE__ ).'assets/css',
		plugin_dir_url( __FILE__ ).'assets/css',
		array( 'style' )
	);
	foreach ( $loader as $offset => $script )
	{
		$loader->register( $offset );
		$loader->enqueue( $offset );
	}
}
```

Keep in mind that the appropriate hooks are `wp_enqueue_script`, `login_enqueue_script`
and `admin_enqueue_script` to load *both* styles and scripts.

### @TODO

Will come with a future version:

 1. ---Handling/Appending script debug file extension `.min`---
 1. Localizing script to transport vars from PHP to Javascript
 1. Dependency handling

### Notes

This "Bundle" is the first attempt to bring reusable bundles to WordPress.
Those bundles should be shared using composer.