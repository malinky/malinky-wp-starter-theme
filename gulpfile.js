/* ------------------------------------------------------------------------ *
 * Gulp Packages
 * ------------------------------------------------------------------------ */

var gulp            = require('gulp'); 

var autoprefixer    = require('gulp-autoprefixer');
var concat          = require('gulp-concat');
var cssUrlAdjuster  = require('gulp-css-url-adjuster');
var del             = require('del');
var minifyCSS       = require('gulp-minify-css');
var rename          = require('gulp-rename');
var replace         = require('gulp-replace');
var rsync           = require("rsyncwrapper").rsync;
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
https://github.com/casualrelaxation/gulp-css-url-adjuster
https://www.npmjs.com/package/gulp-css-url-adjuster
https://github.com/sindresorhus/del
https://www.npmjs.com/package/del
https://github.com/jonathanepollack/gulp-minify-css
https://www.npmjs.com/package/gulp-minify-css
https://github.com/hparra/gulp-rename
https://www.npmjs.com/package/gulp-rename
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
    return gulp.src(['*.php', 'screenshot.png', 'style-critical.css', '!test-styles-forms.php', '!test-styles-image-alignment.php', '!test-styles-typography.php'])
        .pipe(gulp.dest('../dev'));
});


/**
  * Move fontawesome fonts.
  */
gulp.task('dev-move-fontawesome-fonts', function() {
    return gulp.src('bower_components/fontawesome/fonts/**')
        .pipe(gulp.dest('../dev/fonts'));
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
 * Pull in the plugin styles into main style.css.
 * Add to the compiled sass from dev-styles.
 * Sourcemap still works for SASS gnerated styles. The plugins don't use sourcemaps or SASS.
 * Also replace ..img/ path with img/.
 * Mainly uses loader.gif and is in the theme directory.
 */
gulp.task('dev-concat-plugin-styles', function() {
    return gulp.src([   '../dev/style.css', 
                        'bower_components/fontawesome/css/font-awesome.min.css'])
        .pipe(concat('style.css'))
        .pipe(cssUrlAdjuster({
            replace:  ['../','']
        }))
        .pipe(minifyCSS())
        .pipe(gulp.dest('../dev'));
});


/**
 * Cache buster for the inline and async references to styles.css in header.php
 */
gulp.task('dev-css-cache-buster', function() {
    return gulp.src('../dev/header.php')
        .pipe(replace(/style.css/g, function() {
            return 'style.' + Date.now() + '.css';        
        }))
        .pipe(gulp.dest('../dev'));
})


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
 * Dev deploy
 *
 * Deploy the theme folder.
 */
gulp.task('dev-deploy', function() {
    rsync({
        src: "../dev/",
        dest: "CPANEL@DOMAIN:/home/CPANEL/public_html/dev/wp-content/themes/THEMENAME",
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
 * Set up dev task.
 */
gulp.task('dev', function() {
    runSequence('dev-clean', 
                'dev-move-files', 
                'dev-move-fontawesome-fonts',                 
                'dev-move-dir', 
                'dev-styles', 
                'dev-concat-plugin-styles', 
                'dev-css-cache-buster',           
                'dev-scripts', 
                'dev-scripts-google-map', 
                'dev-scripts-modernizer', 
                'dev-scripts-ltie10', 
                'dev-deploy'                
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
    return gulp.src(['*.php', 'screenshot.png', 'style-critical.css', '!test-styles-forms.php', '!test-styles-image-alignment.php', '!test-styles-typography.php'])
        .pipe(gulp.dest('../prod'));
});


/**
  * Move fontawesome fonts.
  */
gulp.task('prod-move-fontawesome-fonts', function() {
    return gulp.src('bower_components/fontawesome/fonts/**')
        .pipe(gulp.dest('../prod/fonts'));
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
 * Pull in the plugin styles into main style.css.
 * Add to the compiled sass from dev-styles.
 * Sourcemap still works for SASS gnerated styles. The plugins don't use sourcemaps or SASS.
 * Also replace ..img/ path with img/.
 * Mainly uses loader.gif and is in the theme directory.
 */
gulp.task('prod-concat-plugin-styles', function() {
    return gulp.src([   '../prod/style.css', 
                        'bower_components/fontawesome/css/font-awesome.min.css'])
        .pipe(concat('style.css'))
        .pipe(cssUrlAdjuster({
            replace:  ['../','']
        }))
        .pipe(minifyCSS())
        .pipe(gulp.dest('../prod'));
});


/**
 * Cache buster for the inline and async references to styles.css in header.php
 */
gulp.task('prod-css-cache-buster', function() {
    return gulp.src('../prod/header.php')
        .pipe(replace(/style.css/g, function() {
            return 'style.' + Date.now() + '.css';        
        }))
        .pipe(gulp.dest('../prod'));
})


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
 * Prod deploy
 *
 * Deploy the theme folder.
 */
gulp.task('prod-deploy', function() {
    rsync({
        src: "../prod/",
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
 * Set up prod task.
 */
gulp.task('prod', function() {
    runSequence('prod-clean', 
                'prod-move-files', 
                'prod-move-fontawesome-fonts',                 
                'prod-move-dir', 
                'prod-styles', 
                'prod-concat-plugin-styles', 
                'prod-css-cache-buster',                 
                'prod-scripts', 
                'prod-scripts-google-map', 
                'prod-scripts-modernizer',
                'prod-scripts-ltie10', 
                'prod-deploy'
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