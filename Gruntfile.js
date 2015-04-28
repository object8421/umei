'use strict';
module.exports = function (grunt) {
    var constructPromptStr, pkg, promptInputErr;
    //require('load-grunt-tasks')(grunt);
    pkg = grunt.file.readJSON('package.json');
    grunt.initConfig({
        // Metadata
        pkg: grunt.file.readJSON('package.json'),
        param: {},
        banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - ' +
        '<%= grunt.template.today("yyyy-mm-dd") %>\n' +
        '<%= pkg.homepage ? "* " + pkg.homepage + "\\n" : "" %>' +
        '* Copyright (c) <%= grunt.template.today("yyyy") %> <%= pkg.author.name %>;' +
        ' Licensed <%= props.license %> */\n',
        uglify: {
            dist: {
                files: [{
                    expand: true,
                    src: '<%= grunt.option("param") %>/js/**/*.js',
                }]
            }
        },
        yuidoc: {
            compile: {
                name: '<%= pkg.name %>',
                description: '<%= pkg.description %>',
                version: '<%= pkg.version %>',
                url: '<%= pkg.homepage %>',
                options: {
                    linkNatives: true,
                    //attributesEmit:true,
                    exclude: 'js/libraries/',
                    paths: ['js/'],
                    //themedir: 'path/to/custom/theme/',
                    outdir: 'docs/docs/'
                    //'no-sort':''
                }
            }
        },
        plato: {
            your_task: {
                options: {
                    //jshint : false,
                    switchcase: false,
                    //exclude: /(\.min)|(jquery.*)/    // excludes source files finishing with ".min.js"
                },
                files: {
                    'docs/code-complexity-report': ['js/**/*.js', 'room/script/**/*.js', '!js/libraries/**/*.js']
                }
            }
        },
        copy: {
            dist: {
                files: [
                    {
                        expand: true,
                        src: [['js/**/*', 'css/**/*', 'images/**/*', 'protected/views/**/*']],
                        dest: '<%= grunt.option("param") %>/'
                    }
                ]
            },
            uumie: {
                files: [
                    {
                        expand: true,
                        src: [['**/**/*']],
                        dest: '<%= grunt.option("param") %>/'
                    }
                ]
            },
            'applymin-test': {
                expand: true, src: ['protected/views/site/room.php'], dest: '<%= grunt.option("param") %>/'
            }
        },
        clean: {
            dist: {
                files: [
                    {
                        dot: true,
                        src: ['<%= grunt.option("param") %>/**/*', '<%= grunt.option("param") %>/**/*.zip']
                    }
                ]
            }
        },
        cssmin: {
            dist: {
                expand: true,
                src: ['<%= grunt.option("param")+"/"%>css/*{,/*}*.css'],
                dest: ''
            }
        },
        imagemin: {
            options: {
                optimizationLevel: 1
            },
            dist: {
                files: [{
                    expand: true,
                    src: ['<%= grunt.option("param") %>/images/**/*.{png,jpg,gif}']
                }]
            }
        },
        replace: {
            dist: {
                src: ['<%= grunt.option("param") %>/protected/views/site/room.php'],
                overwrite: true,
                replacements: [{
                    from: '<%= grunt.option("param") %>/',
                    to: '/'
                }]
            }
        },
        applymin: {
            options: {
                staticPattern: /\/((css|js).*?\.(css|js))/i,
            },
            beginmin: '<%= grunt.option("param") %>/protected/views/site/room.php',
            endmin: '<%= grunt.option("param")==""?"dist":grunt.option("param") %>'
        },
    });
    grunt.loadNpmTasks('grunt-applymin');
    grunt.loadNpmTasks('grunt-text-replace');
    grunt.loadNpmTasks('grunt-contrib-yuidoc');
    grunt.loadNpmTasks('grunt-readme');
    grunt.loadNpmTasks('grunt-plato');
    grunt.loadNpmTasks('grunt-rev');
    grunt.loadNpmTasks('grunt-usemin');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-htmlmin');
    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks('grunt-regex-replace');
    grunt.registerTask('default', ['yuidoc', 'readme', 'plato']);

    grunt.registerTask('build', function (arg1, arg2) {
        if (arguments.length === 0) {
            return grunt.log.error(this.name + ", no args");
        } else {
            grunt.log.writeln(this.name + ", " + arg1 + " " + arg2);
        }
        var obj = {
            test: 'dist',
            formal: '',
            'new': '../uumie-build'
        }
        var environment = obj[arg1];
        grunt.option('param', environment)
        grunt.log.writeln(grunt.option('param'))
        var arr = ['applymin:beginmin', 'concat', 'uglify', 'cssmin', 'rev', 'applymin:endmin', 'replace', 'imagemin'];
        //todo uumie not completed
        if (environment == 'dist' || environment == 'uumie') {
            arr = ['clean', 'copy:' + environment].concat(arr)
        } else if (environment !== '') {
            arr = []
        }
        grunt.task.run(arr)
    });
    grunt.registerTask('applymin-test', ['clean', 'copy:applymin-test', 'applymin:beginmin', 'concat', 'uglify', 'cssmin', 'rev', 'applymin:endmin', 'replace']);
};

