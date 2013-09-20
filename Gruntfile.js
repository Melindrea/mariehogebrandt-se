// Generated on 2013-04-02 using generator-webapp 0.1.5
'use strict';
var LIVERELOAD_PORT = 35729;
var lrSnippet = require('connect-livereload')({port: LIVERELOAD_PORT});
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
        dist: 'wordpress/wp-content/themes/mariehogebrandt'
    },
    wordpressConfig = {
        path: 'wordpress',
        plugins: [
            'wordpress-seo',
            'wp-typography',
            'wp-markdown',
            'wp-h5bp-htaccess'
        ]

    };

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json' ),
        yeoman: yeomanConfig,
        wordpress: wordpressConfig,
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
            templates: {
                files: ['<%= yeoman.app %>/templates/{,*/}*.hbs'],
                tasks: ['newer:assemble:pages']
            },
            livereload: {
                options: {
                    livereload: LIVERELOAD_PORT
                },
                files: [
                    '<%= yeoman.app %>/*.html',
                    '<%= yeoman.app %>/templates/{,*/}*.hbs',
                    '<%= yeoman.app %>/theme/**',
                    '{.tmp,<%= yeoman.app %>}/{,*/}*.css',
                    '{.tmp,<%= yeoman.app %>}/scripts/{,*/}*.js',
                    '<%= yeoman.app %>/images/{,*/}*.{png,jpg,jpeg,webp}'
                ],
            }
        },
        phplint: {
            theme: ['<%= yeoman.app %>/theme/**/*.php']
        },
        //Add the modernizr task with the following configuration
        modernizr: {
            // [REQUIRED] Path to the build you're using for development.
            devFile: '<%= yeoman.app %>/components/modernizr/modernizr.js',

            // [REQUIRED] Path to save out the built file.
            outputFile: '<%= yeoman.app %>/components/modernizr/modernizr.min.js',

            files: [
                '<%= yeoman.app %>/scripts/{,*/}*.js',
                '.tmp/styles/{,*/}*.css',
                '!<%= yeoman.app %>/scripts/vendor/*'
            ],
            uglify: true
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
                            mountFolder(connect, yeomanConfig.app)
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
                            mountFolder(connect, yeomanConfig.dist)
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
            dist: ['.tmp', '<%= yeoman.dist %>/*', '<%= wordpress.path %>/*'],
            server: '.tmp'
        },
        jshint: {
            options: {
                jshintrc: '.jshintrc'
            },
            all: [
                'Gruntfile.js',
                '<%= yeoman.app %>/scripts/{,*/}*.js',
                'tasks/{,*/}*.js',
                'test/spec/{,*/}*.js'
            ]
        },
        jsvalidate: {
            files: [
                'Gruntfile.js',
                '<%= yeoman.app %>/scripts/{,*/}*.js',
                'tasks/{,*/}*.js',
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
                cssDir: '.tmp/styles',
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
                src: ['.tmp/styles/site.css', '.tmp/styles/rtl.css']
            }
        },
        assemble: {
            options: {
                flatten: true,
                layout: 'default.hbs',
                layoutdir: 'app/src/templates/layouts',
                partials: ['app/src/templates/partials/*.hbs'],
                helpers: 'app/src/templates/helpers/*.js',
                pkg: '<%= pkg %>',
                data: 'app/src/data/*.json'
            },
            pages: {
                files: {
                    'app/src/': [
                        'app/src/templates/pages/*.hbs'
                    ]
                }
            },
            resume: {
                options: {
                    layout: 'resume.hbs'
                },
                files: {
                    'app/src/assets/resume/': ['app/src/templates/resumes/*.hbs']
                }
            },
            personalLetter: {
                options: {
                    layout: 'personal-letter.hbs'
                },
                files: {
                    'app/src/assets/personal-letters/': ['app/src/templates/personal-letters/*.hbs']
                }
            }
        },
        ftpush: {
            build: {
                auth: {
                    host: 'ftpcluster.loopia.se',
                    port: 21,
                    authKey: 'blog'
                },
                src: '<%= yeoman.dist %>/',
                dest: '/'
                // exclusions: []
                // keep: []
            }
        },
        useminPrepare: {
            html: '<%= yeoman.app %>/index.html',
            options: {
                dest: '<%= yeoman.dist %>'
            }
        },
        usemin: {
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
        svgmin: {
            dist: {
                files: [{
                    expand: true,
                    cwd: '<%= yeoman.app %>/images',
                    src: '{,*/}*.svg',
                    dest: '<%= yeoman.dist %>/images'
                }]
            }
        },
        cssmin: {
            // This task is pre-configured if you do not wish to use Usemin
            // blocks for your CSS. By default, the Usemin block from your
            // `index.html` will take care of minification, e.g.
            //
            //     <!-- build:css({.tmp,app}) styles/main.css -->
            // dist: {
            //     files: {
            //         '<%= yeoman.dist %>/styles/site.min.css': [
            //             '.tmp/styles/{,*/}*.css',
            //             '<%= yeoman.app %>/styles/{,*/}*.css'
            //         ]
            //     }
            // }
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
                        '.htaccess',
                        'images/{,*/}*.{webp,gif}',
                        'styles/fonts/*'
                    ]
                },
                {
                    cwd: '<%= yeoman.app %>/components/wordpress',
                    expand: true,
                    src: ['**'],
                    dest: '<%= wordpress.path %>'
                },
                {
                    cwd: '<%= yeoman.app %>/styles/fonts',
                    expand: true,
                    src: ['**'],
                    dest: '<%= yeoman.dist %>/styles/fonts'
                },
                {
                    cwd: 'app/components',
                    expand: true,
                    src: [
                        'wordpress-seo/**',
                        'wp-typography/**',
                        'wp-markdown/**',
                        'wp-h5bp-htaccess/**',
                        'advanced-custom-fields/**',
                        'acf-flexible-content/**',
                        'acf-gallery/**',
                        'acf-options-page/**',
                        'acf-repeater/**',
                        'contact-form-7/**',
                        'contact-form-7-honeypot/**',
                        'theme-check/**',
                        'wp-pagenavi/**'
                    ],
                    dest: '<%= wordpress.path %>/wp-content/plugins'
                },
                {
                    dest: '<%= wordpress.path %>/wp-config.php',
                    src: ['wp-config.php']
                },
                {
                    dest: '<%= yeoman.dist %>/style.css',
                    src: ['style.css']
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
        wpRev: {
            dist: {
                files: {
                    src: [
                        '<%= yeoman.dist %>/scripts/{,*/}*.js',
                        '<%= yeoman.dist %>/styles/{,*/}*.css'
                    ]
                },
            },
            options: {
                file: '<%= yeoman.dist %>/lib/scripts.php'
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
        bumpup: {
            files: ['package.json', 'component.json', 'composer.json']
        },
        shell: {
            screenshot: {
                command: 'casperjs ' +
                '--viewportSizes="[[320,480],[320,568],[600,1024],[1024,768],[1280,800],[1440,900]]" ' +
                '--urls="http://mariehogebrandt.se" screenshot.js ' +
                '--dir="../../../screenshots/"',
                options: {
                    stdout: true,
                    execOptions: {
                        cwd: 'app/components/js-responsive-screenshots/'
                    },
                    stderr: true
                }
            }
        },
        concurrent: {
            server: [
                'compass',
                'js'
            ],
            test: [
                'compass',
                'js'
            ],
            dist: [
                'js',
                'compass',
                'imagemin',
                'svgmin'
            ]
        }
    });

    // show elapsed time at the end
    require('time-grunt')(grunt);
    // load all grunt tasks
    require('load-grunt-tasks')(grunt);
    grunt.loadNpmTasks('assemble');
    grunt.loadTasks('tasks');

    grunt.registerTask('js', [
        'jshint',
        'jsvalidate',
        'modernizr'
    ]);

    grunt.registerTask('server', function (target) {
        if (target === 'dist') {
            return grunt.task.run(['build', 'open', 'connect:dist:keepalive']);
        }

        grunt.task.run([
            'clean:server',
            'concurrent:server',
            'connect:livereload',
            'open',
            'watch'
        ]);
    });

    grunt.registerTask('test', [
        'clean:server',
        'concurrent:test',
        'connect:test',
        'mocha'//,
        // 'copy:theme',
        // 'phpunit'
    ]);

    grunt.registerTask('build', [
        'clean:dist',
        'phplint',
        'useminPrepare',
        'concurrent:dist',
        'imagemin',
        'concat',
        'cssmin',
        'uglify',
        'copy',
        // 'wpRev',
        'usemin'
    ]);

    grunt.registerTask('buildTheme', [
        'clean:dist',
        'phplint',
        'useminPrepare',
        'concurrent:dist',
        'imagemin',
        'concat',
        'cssmin',
        'uglify',
        'copy',
        'usemin'
    ]);
    grunt.registerTask('theme', [
        'watch:theme'
    ]);

    grunt.registerTask('lint', [
        'jshint',
        'jsvalidate',
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

    grunt.registerTask('assembler', [
        'newer:assemble:pages'
    ]);
};
