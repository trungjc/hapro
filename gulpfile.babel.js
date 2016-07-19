// generated on 2016-01-08 using generator-gulp-webapp 1.0.4
import gulp from 'gulp';
import gulpLoadPlugins from 'gulp-load-plugins';
import browserSync from 'browser-sync';
import del from 'del';
import {
    stream as wiredep
}
from 'wiredep';

const $ = gulpLoadPlugins();
const reload = browserSync.reload;

var concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    sass = require('gulp-sass'),
    uglify = require('gulp-uglify');

gulp.task('styles', () => {
    return gulp.src('app/assets/sass/*.scss')
        .pipe($.plumber())
        .pipe($.sourcemaps.init())
        .pipe($.sass.sync({
            outputStyle: 'expanded',
            precision: 10,
            includePaths: ['.']
        }).on('error', $.sass.logError))
        .pipe($.autoprefixer({
            browsers: ['> 1%', 'last 2 versions', 'Firefox ESR']
        }))
        .pipe($.sourcemaps.write())
        .pipe(gulp.dest('.tmp/assets/css'))
        .pipe(reload({
            stream: true
        }));
});

function lint(files, options) {
    return () => {
        return gulp.src(files)
            .pipe(reload({
                stream: true,
                once: true
            }))
            .pipe($.eslint(options))
            .pipe($.eslint.format())
            .pipe($.if(!browserSync.active, $.eslint.failAfterError()));
    };
}
const testLintOptions = {
    env: {
        mocha: true
    }
};

gulp.task('lint', lint('app/assets/js/**/*.js'));
gulp.task('lint:test', lint('test/spec/**/*.js', testLintOptions));

gulp.task('views', () => {
    return gulp.src('app/*.jade')
        .pipe($.jade({
            pretty: true
        }))
        .pipe(gulp.dest('.tmp'))
        .pipe(reload({
            stream: true
        }));
});

//css vendor
gulp.task('sass-vendor', function() {
    gulp.src([
            // 'bower_components/Swiper/dist/css/swiper.css'
        ])
        .pipe(sass())
        .pipe(concat('vendor.css'))
        .pipe(gulp.dest('dist/assets/css'))
        // .pipe(gulp.dest('../wp-content/themes/baring/assets/styles/'));
});

//css main
gulp.task('sass', function() {
    gulp.src([
            'app/assets/sass/*.scss'
        ])
        .pipe(sass())
        .pipe(concat('main.css'))
        .pipe(gulp.dest('dist/assets/css'))
        // .pipe(gulp.dest('../wp-content/themes/baring/assets/styles/'));
});

// Modernize script
gulp.task('modernize-js', function() {
    return gulp
        .src([
            'bower_components/modernizr/modernizr.js'
        ])
        .pipe(gulp.dest('dist/assets/js'))
        //.pipe(uglify())
        .pipe(gulp.dest('dist/assets/js'))
        // .pipe(gulp.dest('../wp-content/themes/baring/assets/scripts'))
        .pipe(notify({
            message: 'Modernize - Scripts task complete'
        }))
});

// Main script
gulp.task('main-js', function() {
    return gulp
        .src([
            'app/assets/js/main.js',
            'app/assets/js/fire.js'
        ])
        .pipe(concat('main.js'))
        .pipe(gulp.dest('dist/assets/js'))
        //.pipe(uglify())
        .pipe(gulp.dest('dist/assets/js'))
        // .pipe(gulp.dest('../wp-content/themes/baring/assets/scripts'))
        .pipe(notify({
            message: 'Main - Scripts task complete'
        }))
});

// Plugins script
gulp.task('vendor-js', function() {
    return gulp
        .src([
            'bower_components/jquery/dist/jquery.js',
            'bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js'
        ])
        .pipe(concat('vendor.js'))
        .pipe(gulp.dest('dist/assets/js'))
        .pipe(uglify())
        .pipe(gulp.dest('dist/assets/js'))
        // .pipe(gulp.dest('../wp-content/themes/baring/assets/scripts'))
        .pipe(notify({
            message: 'Vendor - Scripts task complete'
        }))

});

gulp.task('html', ['views', 'styles'], () => {
    // return gulp.src('app/*.html')
    return gulp.src(['app/*.html', '.tmp/*.html'])
        .pipe($.useref({
            searchPath: ['.tmp', 'app', '.']
        }))
        // .pipe($.if('*.js', $.uglify()))
        // .pipe($.if('*.css', $.cssnano()))
        // .pipe($.if('*.html', $.htmlmin()))
        .pipe(gulp.dest('dist'));
});

gulp.task('images', () => {
    return gulp.src('app/assets/images/**/*')
        .pipe($.if($.if.isFile, $.cache($.imagemin({
                progressive: true,
                interlaced: true,
                // don't remove IDs from SVGs, they are often used
                // as hooks for embedding and styling
                svgoPlugins: [{
                    cleanupIDs: false
                }]
            }))
            .on('error', function(err) {
                console.log(err);
                this.end();
            })))
        .pipe(gulp.dest('dist/assets/images'));
    // .pipe(gulp.dest('../wp-content/themes/baring/assets/images'));
});

gulp.task('fonts', () => {
    return gulp.src(require('main-bower-files')('**/*.{eot,svg,ttf,woff,woff2}', function(err) {})
            .concat('app/assts/fonts/**/*'))
        .pipe(gulp.dest('.tmp/assets/fonts'))
        .pipe(gulp.dest('dist/assets/fonts'));
    // .pipe(gulp.dest('../wp-content/themes/baring/assets/fonts'));
});

gulp.task('extras', () => {
    return gulp.src([
        'app/*.*',
        '!app/*.html',
        '!app/*.jade'
    ], {
        dot: true
    }).pipe(gulp.dest('dist'));
});

gulp.task('clean', del.bind(null, ['.tmp', 'dist']));

gulp.task('serve', ['views', 'styles'], () => {
    browserSync({
        notify: false,
        port: 9000,
        server: {
            baseDir: ['.tmp', 'app'],
            routes: {
                '/bower_components': 'bower_components'
            }
        }
    });

    gulp.watch([
        'app/*.html',
        '.tmp/*.html',
        'app/assets/js/**/*.js',
        'app/assets/images/**/*',
        '.tmp/assets/fonts/**/*'
    ]).on('change', reload);

    gulp.watch('app/**/*.jade', ['views']);
    gulp.watch('app/assets/sass/**/*.scss', ['styles']);
    gulp.watch('app/assets/fonts/**/*', ['fonts']);
    gulp.watch('bower.json', ['wiredep', 'fonts']);
});

gulp.task('serve:dist', () => {
    browserSync({
        notify: false,
        port: 9000,
        server: {
            baseDir: ['dist']
        }
    });
});

gulp.task('serve:test', () => {
    browserSync({
        notify: false,
        port: 9000,
        ui: false,
        server: {
            baseDir: 'test',
            routes: {
                '/scripts': 'app/assets/js',
                '/bower_components': 'bower_components'
            }
        }
    });

    gulp.watch('test/spec/**/*.js').on('change', reload);
    gulp.watch('test/spec/**/*.js', ['lint:test']);
});

// inject bower components
gulp.task('wiredep', () => {
    gulp.src('app/assets/sass/*.scss')
        .pipe(wiredep({
            ignorePath: /^(\.\.\/)+/
        }))
        .pipe(gulp.dest('app/assets/css'));

    // gulp.src('app/*.html')
    gulp.src('app/layouts/*.jade')
        .pipe(wiredep({
            exclude: ['bootstrap-sass'],
            ignorePath: /^(\.\.\/)*\.\./
        }))
        .pipe(gulp.dest('app'));
});

gulp.task('build', ['views', 'images', 'html', 'modernize-js', 'vendor-js', 'main-js', 'sass-vendor', 'sass', 'fonts', 'extras'], () => {
    return gulp.src('dist/**/*').pipe($.size({
        title: 'build',
        gzip: true
    }));
});

gulp.task('default', ['clean'], () => {
    gulp.start('build');
});
