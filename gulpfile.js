var gulp        = require('gulp');
var browserSync = require('browser-sync').create();
var sass        = require('gulp-sass');

gulp.task('serve', ['sassNews','sassAdmin'], function() {
    browserSync.init({
        server: {
            baseDir: './web'
        }
    });

    //scss
    gulp.watch('web/news/scss/**/*.scss', ['sassNews']);
    gulp.watch('web/news/scss/main.scss', ['sassNews']);
    gulp.watch('web/admin/scss/**/*.scss', ['sassAdmin']);
    gulp.watch('web/admin/scss/main.scss', ['sassAdmin']);
    //html
    gulp.watch('web/index.html').on('change', browserSync.reload);
    gulp.watch('web/**/*.html').on('change', browserSync.reload);
    //js
    gulp.watch("web/**/js/*.js", ['js-watch']);
});

gulp.task('sassNews', function(){
  return gulp.src('web/news/scss/main.scss')
        .pipe(sass())
        .pipe(gulp.dest('web/news/css'))
        .pipe(browserSync.stream());
});

gulp.task('sassAdmin', function(){
  return gulp.src('web/admin/scss/main.scss')
        .pipe(sass())
        .pipe(gulp.dest('web/admin/css'))
        .pipe(browserSync.stream());
});

gulp.task('js-watch', function (done) {
    browserSync.reload();
    done();
});

gulp.task('default',['serve']);
