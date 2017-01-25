'use strict';
var gulp = require('gulp');
var browserify = require('gulp-browserify');
var sourcemaps = require('gulp-sourcemaps');
var jshint = require('gulp-jshint');
var uglify = require('gulp-uglify');
var minify = require('gulp-minify-css');
var $ = require('gulp-load-plugins')();
var pkg = require('./package.json');
//项目配置文件
var config = {
    AUTOPREFIXER_BROWSERS: [
        'ie >= 8',
        'ie_mob >= 10',
        'ff >= 30',
        'chrome >= 34',
        'safari >= 7',
        'opera >= 23',
        'ios >= 7',
        'android >= 2.3',
        'bb >= 10'
    ]
};
var dateFormat = 'UTC:yyyy-mm-dd"T"HH:mm:ss Z';
var banner = [
    '/*! <%= pkg.name %> v<%= pkg.version %><%=ver%>',
    'by yunalading Team',
    '<%= pkg.homepage %>',
    '(c) ' + $.util.date(Date.now(), 'UTC:yyyy') + ' HTTGO, Inc.',
    '<%= pkg.license.type %>',
    $.util.date(Date.now(), dateFormat) + ' */ \n'
].join(' | ');

gulp.task('build:admin-js',function () {
    gulp.src('./frontend/admin/js/admin.js').pipe(sourcemaps.init()).pipe(browserify()).pipe($.header(banner,{pkg:pkg,ver:''})).pipe($.plumber({errorHandler:function(err){
        console.log(err);
        this.emit('end');
    }})).pipe(jshint()).pipe(gulp.dest('./public/static/admin/js')).pipe(uglify()).pipe($.rename({
        'suffix': '.min',
        'extname': '.js'
    })).pipe(sourcemaps.write('./')).pipe(gulp.dest('./public/static/admin/js'));
});

gulp.task('build:admin-less',function () {
    gulp.src('./frontend/admin/less/admin.less').pipe(sourcemaps.init()).pipe($.header(banner,{pkg:pkg,ver:''})).pipe($.plumber({errorHandler:function (err) {
        console.log(err);
        this.emit('end');
    }})).pipe($.less()).pipe($.autoprefixer({browsers:config.AUTOPREFIXER_BROWSERS})).pipe(gulp.dest('./public/static/admin/css')).pipe(minify()).pipe($.rename({
        'suffix': '.min',
        'extname': '.css'
    })).pipe(sourcemaps.write('./')).pipe(gulp.dest('./public/static/admin/css'));
});

gulp.task('build:home-js',function () {
    gulp.src('./frontend/home/**/js/home.js').pipe(sourcemaps.init()).pipe(browserify()).pipe($.header(banner,{pkg:pkg,ver:''})).pipe($.plumber({errorHandler:function(err){
        console.log(err);
        this.emit('end');
    }})).pipe(jshint()).pipe(gulp.dest('./public/static/home')).pipe(uglify()).pipe($.rename({
        'suffix': '.min',
        'extname': '.js'
    })).pipe(sourcemaps.write('./')).pipe(gulp.dest('./public/static/home'));
});

gulp.task('build:home-less',function () {
    gulp.src('./frontend/home/**/less/home.less').pipe(sourcemaps.init()).pipe($.header(banner,{pkg:pkg,ver:''})).pipe($.plumber({errorHandler:function (err) {
        console.log(err);
        this.emit('end');
    }})).pipe($.less()).pipe($.autoprefixer({browsers:config.AUTOPREFIXER_BROWSERS})).pipe($.rename(function (path) {
        path.dirname = path.dirname.replace('less','css');
    })).pipe(gulp.dest('./public/static/home')).pipe(minify()).pipe($.rename({
        'suffix': '.min',
        'extname': '.css'
    })).pipe(sourcemaps.write('./')).pipe(gulp.dest('./public/static/home'));
});

gulp.task('build:install-js',function () {
    gulp.src('./frontend/install/js/install.js').pipe(sourcemaps.init()).pipe(browserify()).pipe($.header(banner,{pkg:pkg,ver:''})).pipe($.plumber({errorHandler:function(err){
        console.log(err);
        this.emit('end');
    }})).pipe(jshint()).pipe(gulp.dest('./public/static/install/js')).pipe(uglify()).pipe($.rename({
        'suffix': '.min',
        'extname': '.js'
    })).pipe(sourcemaps.write('./')).pipe(gulp.dest('./public/static/install/js'));
});

gulp.task('build:install-less',function () {
    gulp.src('./frontend/install/less/install.less').pipe(sourcemaps.init()).pipe($.header(banner,{pkg:pkg,ver:''})).pipe($.plumber({errorHandler:function (err) {
        console.log(err);
        this.emit('end');
    }})).pipe($.less()).pipe($.autoprefixer({browsers:config.AUTOPREFIXER_BROWSERS})).pipe(gulp.dest('./public/static/install/css')).pipe(minify()).pipe($.rename({
        'suffix': '.min',
        'extname': '.css'
    })).pipe(sourcemaps.write('./')).pipe(gulp.dest('./public/static/install/css'));
});

gulp.task('copy:jquery',function () {
    gulp.src('./node_modules/jquery/dist/**/*').pipe(gulp.dest('./public/static/common/jquery'));
});

gulp.task('copy:handlebars',function(){
    gulp.src('./node_modules/handlebars/dist/**/*').pipe(gulp.dest('./public/static/common/handlebars'));
});

gulp.task('copy:amazeui',function () {
    gulp.src('./node_modules/amazeui/dist/**/*').pipe(gulp.dest('./public/static/common/amazeui'));
});

gulp.task('copy:common',['copy:jquery','copy:handlebars','copy:amazeui']);

gulp.task('build',['build:admin-js','build:home-js','build:install-js','build:admin-less','build:home-less','build:install-less']);

gulp.task('watch',function(){
    gulp.watch(['./frontend/admin/js/**/*.js'],['build:admin-js']);
    gulp.watch(['./frontend/admin/less/**/*.less'],['build:admin-less']);

    gulp.watch(['./frontend/home/**/js/**/*.js'],['build:home-js']);
    gulp.watch(['./frontend/home/**/less/**/*.less'],['build:home-less']);

    gulp.watch(['./frontend/install/js/**/*.js'],['build:install-js']);
    gulp.watch(['./frontend/install/less/**/*.less'],['build:install-less']);
});

gulp.task('default',['copy:common','build','watch']);