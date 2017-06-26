// Plugins
const gulp = require('gulp');
const browserSync = require('browser-sync').create();
const uglify = require('gulp-uglify');
const sass = require('gulp-sass');
const concat = require('gulp-concat');
const rename = require('gulp-rename');
const imagemin = require('gulp-imagemin');
const sourcemaps = require('gulp-sourcemaps');
const ejs = require('gulp-ejs');
const gutil = require('gulp-util');
const jquery = require('jquery');
const del = require('del');
const plumber = require('gulp-plumber');
const autoprefixer = require('autoprefixer');

// Tasks


// Run Server


// Concat
gulp.task('scripts', function() {
	return gulp.src([
			'./src/js/jquery.js',
			'./src/js/bootstrap.js',
			'./src/js/index.js'
		])
		.pipe(plumber())
		.pipe(concat('index.bundle.js'))
		.pipe(uglify())
		.pipe(gulp.dest('./dist/js/'));
});

// Sass
gulp.task('styles', function(){
  	return gulp.src('src/scss/main.scss')
			.pipe(plumber())
	  	.pipe(sourcemaps.init())
			.pipe(sass())
			.pipe(rename("styles.css"))
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('dist/css'))
});

// Autoprefixer
gulp.task('autoprefixer', function () {
    const postcss      = require('gulp-postcss');
    const sourcemaps   = require('gulp-sourcemaps');
    const autoprefixer = require('autoprefixer');

    return gulp.src('./dist/*.css')
        .pipe(sourcemaps.init())
        .pipe(postcss([ autoprefixer() ]))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('./dist'));
});

// Images
gulp.task('imagemin', () =>
    gulp.src('src/img/*')
				.pipe(plumber())
        .pipe(imagemin([
			imagemin.gifsicle({interlaced: true}),
			imagemin.jpegtran({progressive: true}),
			imagemin.optipng({optimizationLevel: 5}),
			imagemin.svgo({plugins: [{removeViewBox: true}]})
		]))
        .pipe(gulp.dest('dist/img'))
);

// html
gulp.task('template', function() {
	gulp.src("./src/*.ejs")
		.pipe(plumber())
		.pipe(ejs({},{}, {ext:'.html'}))
		.pipe(gulp.dest("./dist"))
});

// clean
gulp.task('del', function() {
	del('dist/*').then(paths => {
		console.log('Deleted files and folders from dist');
	});
});

// Development
gulp.task('build', [ 'scripts', 'styles', 'imagemin', 'template']);

// Production
gulp.task('default', ['del', 'build']);
