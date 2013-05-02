// Generated on 2013-04-02 using generator-webapp 0.1.5
'use strict';
var lrSnippet = require('grunt-contrib-livereload/lib/utils').livereloadSnippet;
var mountFolder = function (connect, dir) {
    return connect.static(require('path').resolve(dir));
};

// # Globbing
// for performance reasons we're only matching one level down:
// 'test/spec/{,*/}*.js'
// use this if you want to match all subfolders:
// 'test/spec/**/*.js'

module.exports = function (grunt) {

    // configurable paths
    var yeomanConfig = {
        app: 'app',
        dist: 'wordpress/wp-content/themes/mariehogebrandt',
        wordpress: 'wordpress'
    };

    grunt.initConfig({
        yeoman: yeomanConfig,
        watch: {
            js: {
                files: ['<%= yeoman.app %>/scripts/{,*/}*.js'],
                tasks: ['js']
            },
            compass: {
                files: ['<%= yeoman.app %>/styles/{,*/}*.{scss,sass}'],
                tasks: ['compass', 'modernizr']
            },
            php: {
                files: ['<%= yeoman.app %>/theme/**/*.php'],
                tasks: ['phplint']
            },
            theme: {
                files: ['<%= yeoman.app %>/theme/**'],
                tasks: ['copy:theme']
            },
            livereload: {
                files: [
                    '<%= yeoman.app %>/*.html',
                    '<%= yeoman.app %>/theme/**',
                    '{.tmp,<%= yeoman.app %>}/{,*/}*.css',
                    '{.tmp,<%= yeoman.app %>}/scripts/{,*/}*.js',
                    '<%= yeoman.app %>/images/{,*/}*.{png,jpg,jpeg,webp}'
                ],
                tasks: ['livereload']
            }
        },
        phplint: {
            theme: ['<%= yeoman.app %>/theme/**/*.php']
        },
        //Add the modernizr task with the following configuration
        modernizr: {
            // [REQUIRED] Path to the build you're using for development.
            devFile: 'app/components/modernizr/modernizr.js',

            // [REQUIRED] Path to save out the built file.
            outputFile: 'app/components/modernizr/modernizr.min.js',

            // Based on default settings on http://modernizr.com/download/
            extra: {
                shiv: true,
                printshiv: false,
                load: true,
                mq: true,
                cssclasses: true
            },

            // Based on default settings on http://modernizr.com/download/
            extensibility: {
                addtest: false,
                prefixed: false,
                teststyles: false,
                testprops: false,
                testallprops: false,
                hasevents: false,
                prefixes: false,
                domprefixes: false
            },

            // By default, source is uglified before saving
            uglify: true,

            // Define any tests you want to impliticly include.
            tests: [],

            // By default, this task will crawl your project for references to Modernizr tests.
            // Set to false to disable.
            parseFiles: true,

            // When parseFiles = true, this task will crawl all *.js, *.css, *.scss files.
            // You can override this by defining a "files" array below.
            // "files" : [],
            // When parseFiles = true, matchCommunityTests = true will attempt to
            // match user-contributed tests.
            matchCommunityTests: false,

            // Have custom Modernizr tests? Add paths to their location here.
            customTests: [],

            // Files added here will be excluded when looking for Modernizr refs.
            excludeFiles: ['.tmp/**/*', 'dist/**/*', 'node_modules/**/*', 'test/**/*',
            'app/components/**/*', 'wordpress/**/*', 'app/vendor/**/*']
        },
        connect: {
            options: {
                port: 9000,
                // change this to '0.0.0.0' to access the server from outside
                hostname: 'localhost'
            },
            livereload: {
                options: {
                    middleware: function (connect) {
                        return [
                            lrSnippet,
                            mountFolder(connect, '.tmp'),
                            mountFolder(connect, 'app')
                        ];
                    }
                }
            },
            test: {
                options: {
                    middleware: function (connect) {
                        return [
                            mountFolder(connect, '.tmp'),
                            mountFolder(connect, 'test')
                        ];
                    }
                }
            },
            dist: {
                options: {
                    middleware: function (connect) {
                        return [
                            mountFolder(connect, 'dist')
                        ];
                    }
                }
            }
        },
        open: {
            server: {
                path: 'http://localhost:<%= connect.options.port %>'
            }
        },
        clean: {
            dist: ['.tmp', '<%= yeoman.dist %>/*', '<%= yeoman.wordpress %>/*'],
            server: '.tmp'
        },
        jshint: {
            options: {
                jshintrc: '.jshintrc'
            },
            all: [
                'Gruntfile.js',
                '<%= yeoman.app %>/scripts/{,*/}*.js',
                '!<%= yeoman.app %>/scripts/vendor/*',
                'test/spec/{,*/}*.js'
            ]
        },
        mocha: {
            all: {
                options: {
                    run: true,
                    urls: ['http://localhost:<%= connect.options.port %>/index.html']
                }
            }
        },
        compass: {
            options: {
                sassDir: '<%= yeoman.app %>/styles',
                cssDir: '.tmp',
                imagesDir: '<%= yeoman.app %>/styles/images',
                javascriptsDir: '<%= yeoman.app %>/scripts',
                fontsDir: '<%= yeoman.app %>/styles/fonts',
                importPath: 'app/components',
                relativeAssets: true,
                require: [
                    'breakpoint',
                    'sass-getunicode'
                ]
            },
            dist: {},
            server: {
                options: {
                    debugInfo: true
                }
            }
        },
        csscss: {
            options: {
                verbose: true,
                outputJson: true,
                compass: true,
                failWhenDuplicates: true,
                showParserErrors: true
            },
            dist: {
                src: ['.tmp/style.css']
            }
        },
        // not used since Uglify task does concat,
        // but still available if needed
        /*concat: {
            dist: {}
        },*/

        uglify: {
            dist: {
                files: {
                    '<%= yeoman.dist %>/scripts/main.js': [
                        '<%= yeoman.app %>/scripts/{,*/}*.js'
                    ],
                }
            }
        },
        useminPrepare: {
            html: '<%= yeoman.app %>/index.html',
            options: {
                dest: '<%= yeoman.dist %>'
            }
        },
        usemin: {
            html: ['<%= yeoman.dist %>/{,*/}*.html'],
            css: ['<%= yeoman.dist %>/styles/{,*/}*.css'],
            options: {
                dirs: ['<%= yeoman.dist %>']
            }
        },
        imagemin: {
            dist: {
                files: [{
                    expand: true,
                    cwd: '<%= yeoman.app %>/images',
                    src: '{,*/}*.{png,jpg,jpeg}',
                    dest: '<%= yeoman.dist %>/images'
                }]
            }
        },
        cssmin: {
            dist: {
                files: {
                    '<%= yeoman.dist %>/style.css': [
                        '.tmp/{,*/}*.css',
                        '<%= yeoman.app %>/styles/{,*/}*.css'
                    ]
                },
                options: {
                    banner: '/* \n' +
                    'Theme Name:         Marie Hogebrandt \n' +
                    'Theme URI:          http://mariehogebrandt.se/ \n' +
                    'Description:        A handcrafted theme for MarieHogebrandt.se with backend very loosely based on Roots. \n' +
                    'Version:            0.0.1 \n' +
                    'Author:             Marie Hogebrandt\n' +
                    'Author URI:         http://mariehogebrandt.se/ \n' +
                    'License:            MIT License \n' +
                    'License URI:        http://opensource.org/licenses/MIT \n' +
                    '*/'
                }
            }
        },
        htmlmin: {
            dist: {
                options: {
                    /*removeCommentsFromCDATA: true,
                    // https://github.com/yeoman/grunt-usemin/issues/44
                    //collapseWhitespace: true,
                    collapseBooleanAttributes: true,
                    removeAttributeQuotes: true,
                    removeRedundantAttributes: true,
                    useShortDoctype: true,
                    removeEmptyAttributes: true,
                    removeOptionalTags: true*/
                },
                files: [{
                    expand: true,
                    cwd: '<%= yeoman.app %>',
                    src: '*.html',
                    dest: '<%= yeoman.dist %>'
                }]
            }
        },
        copy: {
            dist: {
                files: [{
                    expand: true,
                    dot: true,
                    cwd: '<%= yeoman.app %>',
                    dest: '<%= yeoman.dist %>',
                    src: [
                        '*.{ico,txt}',
                        '.htaccess'
                    ]
                },
                {
                    cwd: '<%= yeoman.app %>/components/wordpress',
                    expand: true,
                    src: ['**'],
                    dest: '<%= yeoman.wordpress %>'
                },
                {
                    cwd: '<%= yeoman.app %>/styles/fonts',
                    expand: true,
                    src: ['**'],
                    dest: '<%= yeoman.dist %>/styles/fonts'
                },
                {
                    cwd: 'wordpress-plugins',
                    expand: true,
                    src: ['**'],
                    dest: '<%= yeoman.wordpress %>/wp-content/plugins'
                },
                {
                    dest: '<%= yeoman.wordpress %>/wp-config.php',
                    src: ['wp-config.php']
                },
                {
                    dest: '<%= yeoman.dist %>/config.json',
                    src: ['wordpress.json']
                },
                {
                    dest: '<%= yeoman.dist %>/README.md',
                    src: ['README.md']
                }]
            },
            theme: {
                files: [{
                    expand: true,
                    cwd: '<%= yeoman.app %>/theme',
                    dest: '<%= yeoman.dist %>',
                    src: ['**']
                }]
            }
        },
        phpunit: {
            classes: {
                dir: 'test/php/spec/'
            },
            options: {
                bin: '<%= yeoman.app %>/vendor/bin/phpunit',
                bootstrap: 'test/php/phpunit.php',
                colors: true
            }
        },
        bower: {
            all: {
                rjsConfig: '<%= yeoman.app %>/scripts/main.js'
            }
        },
        bumpup: {
            files: ['package.json', 'component.json', 'composer.json']
        }
    });

    // load all grunt tasks
    require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

    grunt.renameTask('regarde', 'watch');

    grunt.registerTask('js', [
        'jshint',
        'modernizr'
    ]);

    grunt.registerTask('server', function (target) {
        if (target === 'dist') {
            return grunt.task.run(['build', 'open', 'connect:dist:keepalive']);
        }

        grunt.task.run([
            'clean:server',
            'compass:server',
            'livereload-start',
            'connect:livereload',
            'open',
            'watch'
        ]);
    });

    grunt.registerTask('test', [
        'clean:server',
        'compass',
        'connect:test',
        'mocha',
        'copy:theme',
        'phpunit'
    ]);

    grunt.registerTask('build', [
        'clean:dist',
        'js',
        'phplint',
        'compass:dist',
        'useminPrepare',
        'imagemin',
        'htmlmin',
        'concat',
        'cssmin',
        'uglify',
        'copy',
        'phpunit',
        'usemin'
    ]);
    grunt.registerTask('theme', [
        'watch:theme'
    ]);

    grunt.registerTask('lint', [
        'jshint',
        'phplint'
    ]);

    grunt.registerTask('travis', [
        'lint',
        'copy',
        'test'
    ]);

    grunt.registerTask('commit', [
        'travis'
    ]);

    grunt.registerTask('default', [
        'lint',
        'test',
        'build'
    ]);
};
