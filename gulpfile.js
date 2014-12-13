/* ------------------------------------------------------------------------ *
 * Gulp Packages
 * ------------------------------------------------------------------------ */

var gulp        = require('gulp'); 

var concat      = require('gulp-concat');
var del         = require('del');
var rename      = require('gulp-rename');
var runSequence = require('run-sequence');
var sass        = require('gulp-ruby-sass');
var sourcemaps  = require('gulp-sourcemaps');
var uglify      = require('gulp-uglify');

/*
https://github.com/wearefractal/gulp-concat
https://www.npmjs.com/package/gulp-concat
https://github.com/sindresorhus/del
https://www.npmjs.com/package/del
https://github.com/hparra/gulp-rename
https://www.npmjs.com/package/gulp-rename
https://github.com/OverZealous/run-sequence
https://www.npmjs.com/package/run-sequence
https://github.com/sindresorhus/gulp-ruby-sass/tree/rw/1.0
https://www.npmjs.com/package/gulp-ruby-sass
https://github.com/floridoo/gulp-sourcemaps
https://www.npmjs.com/package/gulp-sourcemaps
https://github.com/terinjokes/gulp-uglify
https://www.npmjs.com/package/gulp-uglify
https://github.com/terinjokes/gulp-uglify/issues/56
*/





/* ------------------------------------------------------------------------ *
 * Copy parent files into child.
 * Run from parent theme directory.
 * 
 * gulp child-theme-setup
 *
 * Grab all folders and files in parent SASS folder.
 * Exclude style.scss file as this is already in the child theme and
 * contains Wordpress specific child theme info.
 * ------------------------------------------------------------------------ */

/**
 * Copy parent SASS into child theme.
 */
gulp.task('child-theme-sass', function() {
    return gulp.src(['sass/**', '!sass/style.scss'])
    .pipe(gulp.dest('../malinky-wp-starter-theme-child/sass'));
});

/**
 * Copy other files into child theme.
 */
gulp.task('child-theme-files', function() {
    return gulp.src(['gulpfile.js', 'package.json'])
    .pipe(gulp.dest('../malinky-wp-starter-theme-child'));
});

/**
 * Run child-theme-setup task.
 */
gulp.task('child-theme-setup', function() {
    runSequence('child-theme-sass', 
                'child-theme-files'
            );
})





/* ------------------------------------------------------------------------ *
 * Local
 * 
 * gulp
 *
 * Compile SASS and create sourcemap.
 * Sourcemap is stored in sourcemaps folder.
 * Sourcemap is linked into correct folder structure from developer tools.
 * ------------------------------------------------------------------------ */

/**
 * Compile our SASS.
 * Doesn't support globs hence the return sass rather than gulp.src.
 *
 * sourceRoot sets the path where the source files are hosted relative to the source map.
 * This makes things appear in the correct folders when viewing through developer tools.
 */
gulp.task('sass', function() {
    return sass('sass', { sourcemap: true, style: 'expanded' })
    .on('error', function (err) {
      console.error('SASS Error - ', err.message);
   	})
    .pipe(sourcemaps.write('sourcemaps', {includeContent: false, sourceRoot: '../sass'}))
    .pipe(gulp.dest('./'));
});


/**
 * Watch files for changes.
 */
gulp.task('watch', function() {
    gulp.watch('sass/**/*.scss', ['sass']);
});

/**
 * Set up default (local) task.
 */
gulp.task('default', ['sass', 'watch']);





/* ------------------------------------------------------------------------ *
 * Dev
 * 
 * gulp dev
 *
 * Move all applicable files and folders.
 * This includes sass and all js for debugging with sourcemaps.
 * Compile SASS again, overwriting locally moved style.css to compress CSS.
 * Concat and minify JS to scripts.js
 * ------------------------------------------------------------------------ */

/**
 * Delete all contents of dev folder.
 */
gulp.task('dev-clean', function (cb) {
    del('dev/*', cb);
});


/**
  * Move root .php and .css files (which is all that need moving from root of theme).
  */
gulp.task('dev-move-files', function() {
    return gulp.src('*.php')
        .pipe(gulp.dest('dev'));
});


/**
  * Move root directories and their contents.
  */
gulp.task('dev-move-dir', function() {
    return gulp.src(['inc/**/*', 'js/**/*', 'languages/**/*', 'sass/**/*'], { base: './'} )
        .pipe(gulp.dest('dev'));
});


/**
 * Compile our SASS.
 * Doesn't support globs hence the return sass rather than gulp.src.
 *
 * sourceRoot sets the path where the source files are hosted relative to the source map.
 * This makes things appear in the correct folders when viewing through developer tools.
 *
 */
gulp.task('dev-sass', function() {
    return sass('sass', { sourcemap: true, style: 'compressed' })
	    .on('error', function (err) {
	      console.error('SASS Error - ', err.message);
	   	})
	    .pipe(sourcemaps.write('sourcemaps', {includeContent: false, sourceRoot: '../sass'}))
	    .pipe(gulp.dest('dev'));
});


/**
 * Concat (rename) and minify our JS.
 *
 * sourceRoot sets the path where the source files are hosted relative to the source map.
 * This makes things appear in the correct folders when viewing through developer tools.
 *
 * Don't minimize respond.js as it's only loaded in IE8 from header and it breaks during minification.
 */
gulp.task('dev-scripts', function() {
    return gulp.src(['js/*.js', '!js/modernizr-2.8.3.js', '!js/respond.js'])
		.pipe(sourcemaps.init())
		.pipe(concat('scripts.min.js'))
        .pipe(uglify())
        .pipe(sourcemaps.write('../sourcemaps', {includeContent: false, sourceRoot: '../js'}))
        .pipe(gulp.dest('dev/js'));
});


/**
 * Minify modernizr.js.
 *
 * Always use concat before uglify else source map isn't generated correctly.
 */
gulp.task('dev-scripts-modernizer', function() {
    return gulp.src(['js/modernizr-2.8.3.js'])
        .pipe(sourcemaps.init())
        .pipe(concat('modernizr-2.8.3.min.js'))
        .pipe(uglify())
        .pipe(sourcemaps.write('../sourcemaps', {includeContent: false, sourceRoot: '../js'}))
        .pipe(gulp.dest('dev/js'));
});


/**
 * Set up dev task.
 */
gulp.task('dev', function() {
  	runSequence('dev-clean', 
                'dev-move-files', 
                'dev-move-dir', 
                'dev-sass', 
                'dev-scripts', 
                'dev-scripts-modernizer'
            );
})