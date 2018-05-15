var gulp = require('gulp');
const src = "www/";
//Plugins
var plugins = require("gulp-load-plugins")({
    pattern: '*'
});

//Servidor de Desarrollo
gulp.task('serve', ["watchOnly"], function() {
    plugins.browserSync.init({
        open: true,
        port: 9000,
        server: {
            baseDir: './www'
        }
    });
});
//Tarea para ver el nombre de los plugins en consola
gulp.task("plugins", function() {
    console.log(plugins);
});
//Tarea para procesar el CSS
//gulp.task('css', function() {
//return gulp.src(`${src}css/*.css`)
//.pipe(plugins.sourcemaps.init())
//.pipe(plugins.postcss([plugins.autoprefixer({ browsers: ['last 2 versions'] })]))
//.pipe(plugins.sourcemaps.write('.'))
//.pipe(plugins.concat('app.css'))
////.pipe(plugins.rename({ suffix: '.min' }))
//.pipe(gulp.dest(src + 'css'))
//.pipe(plugins.browserSync.stream())
//});

//Tarea para procesar javascript
// Concatenate & Minify JS
//gulp.task('js', function() {
//return gulp.src(`${src}js/*.js`)
//.pipe(plugins.order([
//"jquery-1.11.2.min.js",
//"bootstrap.min.js",
//"handlebars-v4.0.5.js",
//"Core.handlebars.js",
//"jquery.vide.js",
//"typed.min.js",
//"aos.js",
//"main.js"
//]))
//.pipe(plugins.concat('app.js'))
////.pipe(plugins.rename({ suffix: '.min' }))
////.pipe(plugins.uglify())
//.pipe(gulp.dest(src + 'js'));
//});
//Tarea para procesar las imagenes
//gulp.task('img', function() {
//return gulp.src(`${src}img/**/*`)
//.pipe(plugins.cache(plugins.imagemin({ optimizationLevel: 5, progressive: true, interlaced: true })))
//.pipe(gulp.dest(dist + 'img'));
//});
//
////Tarea para procesar html
//gulp.task('html', function() {
//return gulp.src(`${src}*.html`)
//.pipe(plugins.htmlMinifier({ collapseWhitespace: true }))
//.pipe(gulp.dest(dist))
//.pipe(plugins.browserSync.stream())
//});
//
//
//// Tarea para vigilar los cambios
//gulp.task('watch', function() {
//gulp.watch(`${src}/css/*.css`, ['css', plugins.browserSync.reload]);
//gulp.watch([`${src}/js/*.js`, 'main.js'], ['js', plugins.browserSync.reload]);
//gulp.watch(`${src}/img/*`, ['img']);
//gulp.watch(`${src}/*.html`, ['html']);
//});

gulp.task('watchOnly', function() {
    //gulp.watch(`${src}/css/*.css`, [plugins.browserSync.reload]);
    //gulp.watch([`${src}/js/*.js`, 'main.js'], [plugins.browserSync.reload]);
    //gulp.watch(`${src}/img/*`, [plugins.browserSync.reload]);
    //gulp.watch(`${src}/*.html`, [plugins.browserSync.reload]);
});

gulp.task('default', ['serve']);
