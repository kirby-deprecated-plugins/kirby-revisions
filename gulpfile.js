var gulp = require('gulp');

var autoprefixer = require('gulp-autoprefixer');
var cssmin = require('gulp-cssmin');
var notify = require('gulp-notify');
var rename = require('gulp-rename');
var sass = require('gulp-sass');

// CSS
gulp.task('css', function() {
	gulp.src('field/assets/scss/style.scss')
		.pipe(sass())
		.pipe(autoprefixer())
		.pipe(gulp.dest('field/assets/css'))
		.pipe(cssmin())
		.pipe(rename({suffix: '.min'}))
		.pipe(gulp.dest('field/assets/css'))
		.pipe(notify("CSS generated!"))
	;
});

// Default
gulp.task('default',function() {
	gulp.watch('field/assets/scss/**/*.scss',['css']);
});