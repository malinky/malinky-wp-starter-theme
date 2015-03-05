/* ------------------------------------------------------------------------ *
 * Gulp Packages
 * ------------------------------------------------------------------------ */

var gulp        = require('gulp'); 

var autoprefixer    = require('gulp-autoprefixer');
var concat          = require('gulp-concat');
var del             = require('del');
var minifyCSS       = require('gulp-minify-css');
var rename          = require('gulp-rename');
var runSequence     = require('run-sequence');
var sass            = require('gulp-ruby-sass');
var sourcemaps      = require('gulp-sourcemaps');
var uglify          = require('gulp-uglify');

/*
https://github.com/sindresorhus/gulp-autoprefixer
https://www.npmjs.com/package/gulp-autoprefixer
Browser List for Autoprefixer https://github.com/ai/browserslist
https://github.com/wearefractal/gulp-concat
https://www.npmjs.com/package/gulp-concat
https://github.com/sindresorhus/del
https://www.npmjs.com/package/del
https://github.com/jonathanepollack/gulp-minify-css
https://www.npmjs.com/package/gulp-minify-css
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
 * Local
 * 
 * gulp
 *
 * Compile SASS and create sourcemap.
 * Sourcemap is stored in sourcemaps folder.
 * Sourcemap is linked into correct folder structure from developer tools.
 * ------------------------------------------------------------------------ */

/**
 * Compile our SASS, autoprefix and create sourcemap.
 * Doesn't support globs hence the return sass rather than gulp.src.
 *
 * sourceRoot sets the path where the source files are hosted relative to the source map.
 * This makes things appear in the correct folders when viewing through developer tools.
 */
gulp.task('styles', function() {
    return sass('sass', { sourcemap: true, style: 'expanded' })
    .on('error', function (err) {console.error('SASS Error - ', err.message);})
    .pipe(autoprefixer({browsers: ['last 5 versions']}))
    .pipe(sourcemaps.write('sourcemaps', {includeContent: false, sourceRoot: '../sass'}))
    .pipe(gulp.dest('./'));
});


/**
 * Watch files for changes.
 */
gulp.task('watch', function() {
    gulp.watch('sass/**/*.scss', ['styles']);
});


/**
 * Set up default (local) task.
 */
gulp.task('default', function() {
    runSequence('styles', 
                'watch'
    );
})


/* ------------------------------------------------------------------------ *
 * Dev
 * 
 * gulp dev
 *
 * Move all applicable files and folders.
 * This includes sass and all js for debugging with sourcemaps.
 * Compile SASS, compress and autoprefix.
 * Concat and minify JS to scripts.min.js
 * ------------------------------------------------------------------------ */

/**
 * Delete all contents of dev folder.
 */
gulp.task('dev-clean', function (cb) {
    del('../dev/*', {force:true}, cb);
});


/**
  * Move root .php files.
  */
gulp.task('dev-move-files', function() {
    return gulp.src(['*.php', 'screenshot.png', '!test-styles-forms.php', '!test-styles-image-alignment.php', '!test-styles-typography.php'])
        .pipe(gulp.dest('../dev'));
});


/**
  * Move root directories and their contents.
  * Move js and SASS to be used with root maps on dev.
  */
gulp.task('dev-move-dir', function() {
    return gulp.src(['img/**', 'js/**', 'languages/**', 'sass/**'], { base: './'} )
        .pipe(gulp.dest('../dev'));
});


/**
 * Compile our SASS, autoprefix and create sourcemap.
 * Doesn't support globs hence the return sass rather than gulp.src.
 *
 * sourceRoot sets the path where the source files are hosted relative to the source map.
 * This makes things appear in the correct folders when viewing through developer tools.
 */
gulp.task('dev-styles', function() {
    return sass('sass', { sourcemap: true, style: 'compressed' })
    .on('error', function (err) {console.error('SASS Error - ', err.message);})
    .pipe(autoprefixer({browsers: ['last 5 versions']}))
    .pipe(sourcemaps.write('sourcemaps', {includeContent: false, sourceRoot: '../sass'}))
    .pipe(gulp.dest('../dev'));
});


/**
 * Concat (rename) and minify our JS.
 *
 * sourceRoot sets the path where the source files are hosted relative to the source map.
 * This makes things appear in the correct folders when viewing through developer tools.
 *
 * Don't minimize modernizer seperatley as it is loaded in the header.
 * Don't minimize respond.js as it's only loaded in IE8 from the footer.
 */
gulp.task('dev-scripts', function() {
    return gulp.src(['js/*.js', '!js/googlemap.js', '!js/html5shiv.js', '!js/modernizr-2.8.3.js', '!js/respond.js'])
        .pipe(sourcemaps.init())
        .pipe(concat('scripts.min.js'))
        .pipe(uglify())
        .pipe(sourcemaps.write('../sourcemaps', {includeContent: false, sourceRoot: '../js'}))
        .pipe(gulp.dest('../dev/js'));
});


/**
 * Minify googlemap.js
 *
 * Always use concat before uglify else source map isn't generated correctly.
 */
gulp.task('dev-scripts-google-map', function() {
    return gulp.src('js/googlemap.js')
        .pipe(concat('googlemap.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('../dev/js'));
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
        .pipe(gulp.dest('../dev/js'));
});


/**
 * Minify respond.js and htmlshiv.js
 *
 * No concat just uglify and keep the same name.
 */
gulp.task('dev-scripts-ltie10', function() {
    return gulp.src(['js/respond.js', 'js/html5shiv.js'])
        .pipe(uglify())
        .pipe(gulp.dest('../dev/js'));
});


/**
 * Set up dev task.
 */
gulp.task('dev', function() {
    runSequence('dev-clean', 
                'dev-move-files', 
                'dev-move-dir', 
                'dev-styles',  
                'dev-scripts', 
                'dev-scripts-google-map', 
                'dev-scripts-modernizer', 
                'dev-scripts-ltie10'
            );
})


/* ------------------------------------------------------------------------ *
 * Prod
 * 
 * gulp prod
 *
 * Move all applicable files and folders.
 * Don't move js and css. Just the minimized versions are used in live no sourcemaps.
 * Compile SASS, compress and autoprefix.
 * Concat and minify JS to scripts.min.js
 * ------------------------------------------------------------------------ */

/**
 * Delete all contents of prod folder.
 */
gulp.task('prod-clean', function (cb) {
    del('../prod/*', {force:true}, cb);
});


/**
  * Move root .php files
  */
gulp.task('prod-move-files', function() {
    return gulp.src(['*.php', 'screenshot.png', '!test-styles-forms.php', '!test-styles-image-alignment.php', '!test-styles-typography.php'])
        .pipe(gulp.dest('../prod'));
});


/**
  * Move root directories and their contents.
  */
gulp.task('prod-move-dir', function() {
    return gulp.src(['img/**', 'languages/**'], { base: './'} )
        .pipe(gulp.dest('../prod'));
});


/**
 * Compile our SASS, autoprefix.
 * Doesn't support globs hence the return sass rather than gulp.src.
 */
gulp.task('prod-styles', function() {
    return sass('sass', { sourcemap: true, style: 'compressed' })
    .on('error', function (err) {console.error('SASS Error - ', err.message);})
    .pipe(autoprefixer({browsers: ['last 5 versions']}))
    .pipe(gulp.dest('../prod'));
});


/**
 * Concat (rename) and minify our JS.
 *
 * Don't minimize google maps as it's loaded on it's on and wp_localize_script with php settings if applicable.
 * Don't minimize moderinzer seperatley as it is loaded in the header.
 * Don't minimize respond.js as it's only loaded in IE8 from the footer.
 */
gulp.task('prod-scripts', function() {
    return gulp.src(['js/*.js', '!js/googlemap.js', '!js/html5shiv.js', '!js/modernizr-2.8.3.js', '!js/respond.js'])
        .pipe(concat('scripts.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('../prod/js'));
});


/**
 * Minify googlemap.js
 *
 * Always use concat before uglify else source map isn't generated correctly.
 */
gulp.task('prod-scripts-google-map', function() {
    return gulp.src('js/googlemap.js')
        .pipe(concat('googlemap.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('../prod/js'));
});


/**
 * Minify modernizr.js.
 *
 * Always use concat before uglify else source map isn't generated correctly.
 */
gulp.task('prod-scripts-modernizer', function() {
    return gulp.src('js/modernizr-2.8.3.js')
        .pipe(concat('modernizr-2.8.3.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('../prod/js'));
});


/**
 * Minify respond.js and htmlshiv.js.
 *
 * No concat just uglify and keep the same name.
 */
gulp.task('prod-scripts-ltie10', function() {
    return gulp.src(['js/respond.js', 'js/html5shiv.js'])
        .pipe(uglify())
        .pipe(gulp.dest('../prod/js'));
});


/**
 * Set up prod task.
 */
gulp.task('prod', function() {
    runSequence('prod-clean', 
                'prod-move-files', 
                'prod-move-dir', 
                'prod-styles', 
                'prod-scripts', 
                'prod-scripts-google-map', 
                'prod-scripts-modernizer',
                'prod-scripts-ltie10'
            );
})





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