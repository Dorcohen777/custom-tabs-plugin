const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));

function compileSass(done) {
    gulp.src('scss/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('css'))
        .on('end', done); // Signal async completion
}

function watchFiles() {
    gulp.watch('scss/**/*.scss', compileSass);
}

exports.build = compileSass;
exports.watch = watchFiles;

exports.default = gulp.series(compileSass, watchFiles);
