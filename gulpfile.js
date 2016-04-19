/* ------------------------------------------------------------------------ *
 * Gulp Packages
 * ------------------------------------------------------------------------ */

var gulp            = require('gulp'); 

var autoprefixer    = require('gulp-autoprefixer');
var concat          = require('gulp-concat');
var del             = require('del');
var minifyCSS       = require('gulp-minify-css');
var rename          = require('gulp-rename');
var replace         = require('gulp-replace');
var rsync           = require("rsyncwrapper");
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
https://github.com/lazd/gulp-replace
https://www.npmjs.com/package/gulp-replace
https://github.com/jedrichards/rsyncwrapper
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
 * Critical CSS
 * 
 * gulp critical-render-css
 *
 * Loop through a selection of pages in urls object.
 * Extract critical css and store in style-critical.css.
 * When ready minify using clean-css. This is used instead of minify-css as
 * it is called directly by creating a new instance new cleanCSS().
 * Currently doesn't remove duplicate media queries so complete manually.
 * https://github.com/jakubpawlowicz/clean-css/issues/508.
 *
 * Media Queries to manually remove from style-critical.css
 *
 * @media screen and (max-width:730px){.main-header-overlay__text{padding:8px;margin:8px;font-size:1.285714em}}@media screen and (max-width:550px){.main-header-overlay{top:10px}.main-header-overlay__text{padding:6px;margin:4px;font-size:1.142857em}}@media screen and (max-width:670px){.main-header-strapline__desktop{display:none}.main-header-strapline__mobile{display:block}}@media screen and (max-width:360px){.mobile-header-24-hour__phone{margin-top:21px}.mobile-header-24-hour__phone span{font-size:1.285714em}}
 * @media screen and (max-width:767px){.main-header-24-hour{display:none}.mobile-header,.mobile-header-24-hour{display:block}.main-header{display:none}}
 * @media screen and (max-width:950px){.main-header-24-hour{text-align:right}}
 * @media screen and (max-width:960px){.main-header-24-hour__phone{text-align:right}}
 * ------------------------------------------------------------------------ */


var penthouse       = require('penthouse'),
    fs              = require('fs'),
    cleanCSS        = require('clean-css'), 
    counter         = 1,
    urls            = {
        'home'      : 'http://www.SOMEURL.co.uk/', 
    };
    /*
    https://github.com/pocketjoso/penthouse
    https://github.com/jakubpawlowicz/clean-css
    https://nodejs.org/api/fs.html

/**
 * Delete all contents of dev folder.
 */
gulp.task('critical-render-css-clean', function() {
    del('style-critical.css', {force:true});
});


for (var page in urls) {
    (function(page) {
        gulp.task(page, function () {
            penthouse({
                url     : urls[page],
                css     : 'style.css',
                width   : 1200,
                height  : 900
            }, function(err, criticalCss) {
                fs.appendFile('style-critical.css', criticalCss, function (err) {
                    if (err) throw err;
                    console.log(counter + ' URL complete - ' + urls[page]);
                    if (counter == Object.keys(urls).length) {
                        console.log('All Files Done');
                        fs.readFile('style-critical.css', function (err, data) {
                            if (err) throw err;
                            var minifiedCss = new cleanCSS().minify(data).styles;
                            fs.writeFile('style-critical.css', minifiedCss, function (err) {
                                if (err) throw err;
                                console.log('CSS Minified');
                            });
                        });
                    }
                    counter++;
                });
            });
        })
    })(page);
}


var urlTasks = [];
for (var page in urls) {
    urlTasks.push(page);
}


/**
 * Set up default (local) task.
 */
gulp.task('critical-render-css', function() {
    runSequence('critical-render-css-clean', 
                urlTasks
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
 * Compile our SASS, autoprefix and create sourcemap.
 * Doesn't support globs hence the return sass rather than gulp.src.
 *
 * sourceRoot sets the path where the source files are hosted relative to the source map.
 * This makes things appear in the correct folders when viewing through developer tools.
 */
gulp.task('styles', function() {
    return sass('sass/**', { sourcemap: true, style: 'expanded' })
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
 * Dist
 * 
 * gulp dist
 *
 * Move all applicable files and folders.
 * This includes sass and all js for debugging with sourcemaps.
 * Compile SASS, compress and autoprefix.
 * Concat and minify JS to scripts.min.js
 * ------------------------------------------------------------------------ */

/**
 * Delete all contents of dist folder.
 */
gulp.task('dist-clean', function () {
    del('../dist/*');
});

/**
  * Move root .php files.
  */
gulp.task('dist-move-files', function() {
    return gulp.src(['*.php', 'screenshot.png', 'style-critical.css', '!test-styles-forms.php', '!test-styles-image-alignment.php', '!test-styles-typography.php'])
        .pipe(gulp.dest('../dist'));
});

/**
  * Move fontawesome fonts.
  */
gulp.task('dist-move-fontawesome-fonts', function() {
    return gulp.src('node_modules/font-awesome/fonts/**')
        .pipe(gulp.dest('../dist/fonts'));
});

/**
  * Move root directories and their contents.
  * Move js and SASS to be used with sourcemaps.
  */
gulp.task('dist-move-dir', function() {
    return gulp.src(['functions/**', 'img/**', 'js/**', 'languages/**', 'partials/**', 'sass/**'], { base: './'} )
        .pipe(gulp.dest('../dist'));
});

/**
 * Compile our SASS, autoprefix and create sourcemap.
 * Doesn't support globs hence the return sass rather than gulp.src.
 *
 * sourceRoot sets the path where the source files are hosted relative to the source map.
 * This makes things appear in the correct folders when viewing through developer tools.
 */
gulp.task('dist-styles', function() {
    return sass('sass/**', { sourcemap: true, style: 'compressed' })
    .on('error', function (err) {console.error('SASS Error - ', err.message);})
    .pipe(autoprefixer({browsers: ['last 5 versions']}))
    .pipe(sourcemaps.write('sourcemaps', {includeContent: false, sourceRoot: '../sass'}))
    .pipe(gulp.dest('../dist'));
});

/**
 * Pull in the plugin styles into main style.css.
 * Add to the compiled sass from dist-styles.
 * Sourcemap still works for SASS generated styles. The plugins don't use sourcemaps or SASS.
 * Also replace ..img/ path with img/.
 * Mainly uses loader.gif and is in the theme directory.
 */
gulp.task('dist-concat-plugin-styles', function() {
    return gulp.src([   '../dist/style.css', 
                        'node_modules/font-awesome/css/font-awesome.min.css'])
        .pipe(concat('style.css'))
        .pipe(replace('../', ''))
        .pipe(gulp.dest('../dist'));
});

/**
 * Cache buster for the inline and async references to styles.css in header.php
 */
gulp.task('dist-css-cache-buster', function() {
    return gulp.src('../dist/header.php')
        .pipe(replace(/style.css/g, function() {
            return 'style.' + Date.now() + '.css';        
        }))
        .pipe(gulp.dest('../dist'));
})

/**
 * Concat (rename) and minify our JS.
 *
 * sourceRoot sets the path where the source files are hosted relative to the source map.
 * This makes things appear in the correct folders when viewing through developer tools.
 *
 * Don't minimize respond.js as it's only loaded in IE8 from the footer.
 */
gulp.task('dist-scripts', function() {
    return gulp.src(['js/*.js', 'node_modules/jquery-lazyload/jquery.lazyload.js', '!js/googlemap.js', '!js/html5shiv.js', '!js/respond.js'])
        .pipe(sourcemaps.init())
        .pipe(concat('scripts.min.js'))
        .pipe(uglify())
        .pipe(sourcemaps.write('../sourcemaps', {includeContent: false, sourceRoot: '../js'}))
        .pipe(gulp.dest('../dist/js'));
});

/**
 * Minify googlemap.js
 *
 * Always use concat before uglify else source map isn't generated correctly.
 */
gulp.task('dist-scripts-google-map', function() {
    return gulp.src('js/googlemap.js')
        .pipe(concat('googlemap.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('../dist/js'));
});

/**
 * Minify respond.js and htmlshiv.js
 *
 * No concat just uglify and keep the same name.
 */
gulp.task('dist-scripts-ltie10', function() {
    return gulp.src(['js/respond.js', 'js/html5shiv.js'])
        .pipe(uglify())
        .pipe(gulp.dest('../dist/js'));
});

/**
 * Dist deploy
 *
 * Deploy the theme folder.
 */
gulp.task('dist-deploy', function() {
    rsync({
        src: "../dist/",
        dest: "CPANEL@DOMAIN:/home/CPANEL/public_html/wp-content/themes/THEMENAME",
        ssh: true,
        recursive: true,
        deleteAll: true,
        exclude: ['.DS_Store'],
        args: ["--verbose"]
    },function (error,stdout,stderr,cmd) {
        if ( error ) {
            console.log(error.message);
        } else {
            console.log(stdout);
            console.log("Deployment Complete");
        }
    })
})

/**
 * Set up dist task.
 */
gulp.task('dist', function() {
    runSequence('dist-clean',
                'dist-move-files',
                'dist-move-fontawesome-fonts',             
                'dist-move-dir',
                'dist-styles',
                'dist-concat-plugin-styles',
                'dist-css-cache-buster',    
                'dist-scripts',
                'dist-scripts-google-map',
                'dist-scripts-ltie10'//,
                //'dist-deploy'
            );
});
