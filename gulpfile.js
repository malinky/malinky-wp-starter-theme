/* ------------------------------------------------------------------------ *
 * Gulp Packages
 * ------------------------------------------------------------------------ */
var gulp 		= require('gulp'); 

var concat 		= require('gulp-concat');
var runSequence = require('run-sequence');
var sass 		= require('gulp-ruby-sass');
var sourcemaps 	= require('gulp-sourcemaps');
var uglify 		= require('gulp-uglify');

/*
https://github.com/wearefractal/gulp-concat
https://www.npmjs.com/package/gulp-concat
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

gulp.task('dev-move', function() {
    return gulp.src(['*', '**', '!dev{,/**}', '!prod{,/**}', '!gulpfile.js', '!node_modules{,/**}', '!package.json', ])
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
    return sass('dev/sass', { sourcemap: true, style: 'compressed' })
	    .on('error', function (err) {
	      console.error('SASS Error - ', err.message);
	   	})
	    .pipe(sourcemaps.write('sourcemaps', {includeContent: false, sourceRoot: '../sass'}))
	    .pipe(gulp.dest('devs'));
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
    return gulp.src(['dev/js/*.js', '!dev/js/modernizr-2.8.3.js', '!dev/js/respond.js'])
		.pipe(sourcemaps.init())
		.pipe(concat('scripts.min.js'))
        .pipe(uglify())
        .pipe(sourcemaps.write('../sourcemaps', {includeContent: false, sourceRoot: '../js'}))
        .pipe(gulp.dest('dev/js'));
});

/**
 * Set up dev task.
 */
gulp.task('dev', function() {
  	runSequence('dev-move', 'dev-sass', 'dev-scripts');
})