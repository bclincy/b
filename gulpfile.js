const gulp = require('gulp');
const autoprefixer = require('gulp-autoprefixer');
const sourcemaps = require('gulp-sourcemaps');
const concat = require('gulp-concat');
const gulpif = require('gulp-if');
const minify = require('gulp-clean-css');
const plumber = require('gulp-plumber');
const sass = require('gulp-sass');
const uglify = require('gulp-uglify');
const util = require('gulp-util');

const config = {
	    assetsDir: 'public/assets',
	    bowerDir: 'vendor/components',
	    production: !!util.env.production,
	    sourceMaps: !util.env.production,
	    webDir: 'public'
};
gulp.task('styles', function() {
	console.log(config.production);
});

gulp.task('default',['styles'], function(){
	    console.log('hello world');
});

