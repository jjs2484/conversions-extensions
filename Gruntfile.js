module.exports = function(grunt) {
	
	// Force use of Unix newlines
	grunt.util.linefeed = '\n';
	
	// Configuration
	grunt.initConfig({
		sass: {
			dist: {
				options: {
					style: 'nested',
					precision: 5,
				},
				files: {
					'build/plugin.css': 'sass/frontend.scss',
					'build/conversions-customizer.css': 'sass/customizer.scss',
				}
			}
		},
		concat: {
			basic_and_extras: {
				files: {
					'build/plugin.js': ['node_modules/slick-carousel/slick/slick.js', 'node_modules/counterup2/dist/index.js', 'homepage/js/frontend.js'],
					'build/conversions-customizer.js': ['repeater/js/conversions-repeater.js', 'repeater/js/fontawesome-iconpicker.js', 'homepage/js/customizer-sorting.js', 'homepage/js/customizer-conditionals.js'],
				},
			},
		},
		lineending: {
			dist: {
				options: {
					eol: 'lf'
				},
				files: {
					'build/plugin.css': ['build/plugin.css'],
					'build/plugin.js': ['build/plugin.js'],
				}
			}
		},
		postcss: {
			options: {
				processors: [
					require('autoprefixer')({
						overrideBrowserslist: ['> 0.5%, last 2 versions, Firefox ESR, not dead']
					})
				]
			},
			dist: {
				src: 'build/plugin.css'
			}
		},
		rtlcss: {
			myTask:{
				options: {
					opts: {
						clean:false
					},
				},
				expand : true,
				src    : ['build/plugin.css'],
				ext    : '.rtl.css'
			}
		},
		cssmin: {
			target: {
				files: {
					'build/plugin.min.css': ['build/plugin.css'],
					'build/plugin.rtl.min.css': ['build/plugin.rtl.css'],
					'build/conversions-customizer.min.css': ['build/conversions-customizer.css'],
				}
			}
		},
		uglify: {
			options: {
				mangle: false,
			},
			my_target: {
				files: {
					'build/plugin.min.js': ['build/plugin.js'],
					'build/conversions-customizer.min.js': ['build/conversions-customizer.js'],
				}
			}
		},
		watch: {
			sass: {
				files: ['sass/*.scss'],
				tasks: ['all'],
			},
			scripts: {
				files: ['js/*.js'],
				tasks: ['all'],
			},
		},
		copy: {
			main: {
				files: [
					// includes files within path
					{ 
						expand: true,
						flatten: true,
						src: ['node_modules/slick-carousel/slick/fonts/*'], 
						dest: 'fonts/',
						filter: 'isFile'
					},
				],
			},
		},
	});

	// Load plugins
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('@lodder/grunt-postcss');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-rtlcss');
	grunt.loadNpmTasks('grunt-lineending');
	
	// Run All Tasks
	grunt.registerTask('all', ['sass', 'concat', 'lineending', 'postcss', 'rtlcss', 'cssmin', 'uglify', 'copy']);

};