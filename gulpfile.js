var gulp = require('gulp'); 

var sass = require('gulp-sass');

/**
 * Compile our Sass.
 */
gulp.task('sass', function() {
    return gulp.src('sass/*.scss')
        .pipe(sass())
        .pipe(gulp.dest('css'));
});

/**
 * Watch files for changes.
 */
gulp.task('watch', function() {
    gulp.watch('scss/*.scss', ['sass']);
});

/**
 * Set up default task.
 */
gulp.task('default', ['sass', 'watch']);