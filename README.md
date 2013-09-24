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

## How To

Example script loading using a method. `jquery` is added as dependency.
Minified/Uglified scripts expected to have the `.min` extension.
Expected to have the scripts in a folder structure like you know it from
common node and similar projects: `assets/scripts/vendor/your-dependency/filename.ext`.
Such structure makes it easier to exclude all shared third party code
in a `.gitignore` file by a single folder name.

```
public function loadScripts( $hook_suffix )
{
	$min  = defined( 'SCRIPT_DEBUG' ) and SCRIPT_DEBUG ? '.min' : '';
	$path = 'assets/scripts/vendor/some-script';
	$loader = new ScriptsLoader(
		'some-handle',
		plugin_dir_path( __FILE__ )."/{$path}/SomeScript{$min}.js",
		plugins_url( "{$path}/SomeScript{$min}.js", __FILE__ ),
		array( 'jquery' )
	);
	foreach ( $loader as $offset => $script )
	{
		$loader->register( $offset );
		$loader->enqueue( $offset );
	}
}
```

Example style loading using a method. Has `style` as dependency.

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

 1. Handling/Appending script debug file extension `.min`
 1. Localizing script to transport vars from PHP to Javascript

### Notes

This "Bundle" is the first attempt to bring reusable bundles to WordPress.
Those bundles should be shared using composer.