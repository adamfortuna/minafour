'use strict';

var gulp = require('gulp');

// CSS
var sass = require('gulp-sass'),
    concat = require('gulp-concat');

// Compile CSS to dist/css/style.css
gulp.task('sass', function () {
  return gulp.src('./src/css/style.sass')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./dist/css'))
    .pipe(concat('./style.css'))
    .pipe(gulp.dest('./'));
});

gulp.task('sass:watch', function () {
  gulp.watch(['./src/css/**/*.s[a|c]ss', './src/css/style.txt'], ['sass']);
});


gulp.task('default', ['watch', 'sass']);
gulp.task('watch', ['sass:watch']);
