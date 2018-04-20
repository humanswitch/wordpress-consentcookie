var gulp = require('gulp');
var zip = require('gulp-zip');

gulp.task('zip', function () {
  return gulp.src([
    './**/*', 
    '!./{node_modules,node_modules/**/*}', 
    '!./assets/{sass,sass/*}', 
    '!./gulpfile.js', 
    '!./package.json', 
    '!./package-lock.json'
  ])
    .pipe(zip('consentcookie.zip'))
    .pipe(gulp.dest('./../'));
});