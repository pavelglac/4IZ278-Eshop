module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    watch: {
        sass: {
          files: ['scss/**/*.scss'],
          tasks: ['sass', 'group_css_media_queries','cssmin', 'clean'],
        }

    },

    sass: {
      target: {
        files: [{
        'acss/style.css' : ['scss/style.scss'],
        }]
      }

    },

    uglify: {
      options:{
          manage:false
      },
      target: {
        files: [{
        // 'js/main.min.js' : ['js/main.js'],
        expand: true,
        cwd: 'js/',
        src: ['**/*.js', '!**/*.min.js'],
        dest: 'release/js',
        }]
      }
    },

    group_css_media_queries: {
      target: {
        files: [{
        expand: true,
        cwd: 'acss/',
        src: '**/*.css',
        dest: 'grouped/',
        }]
      }
    },

    cssmin: {
    target: {
      files: [{
        expand: true,
        cwd: 'grouped/',
        src: ['**/*.css', '!**/*.min.css'],
        dest: 'css/',
        ext: '.min.css'
      }]
    }
  },

  clean: {
    build: ['.sass-cache/', 'acss/', 'grouped/'],
  },

  autoprefixer:{

 target: {
      files: [{
        expand: true,
        cwd: 'css/',
        src: ['**/*.css'],
        dest: 'xcss/'
      }]
    }



    },

 postcss: {
          options: {
              map: false,
              processors: [
                  require('autoprefixer')
              ]
          },
          dist: {
              src: 'css/*.css'
          }
      },

  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-group-css-media-queries');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-postcss');
  grunt.loadNpmTasks('grunt-autoprefixer');

  // Default task(s).
  grunt.registerTask('default', ['sass', 'group_css_media_queries','cssmin', 'clean']);
  grunt.registerTask('pre', ['autoprefixer']);
 // grunt.registerTask('default', ['watch']);

};