module.exports = function( grunt ) {
	"use strict";

	grunt.initConfig( {
		pkg : grunt.file.readJSON( 'package.json' ),
		uglify : {
			options : {
				banner : '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
			},
			build : {
				src :  'src/<%= pkg.name %>.js',
				dest : 'build/<%= pkg.name %>.min.js'
			}
		}
	} );

	grunt.loadNpmTasks( 'grunt-contrib-uglify' );
	grunt.registerTask( 'default', [ 'uglify' ] );
	grunt.loadNpmTasks( 'grunt-contrib-jshint' );
	grunt.loadNpmTasks( 'grunt-contrib-qunit' );
	grunt.loadNpmTasks( 'grunt-contrib-watch' );
	grunt.loadNpmTasks( 'grunt-contrib-concat' );
};