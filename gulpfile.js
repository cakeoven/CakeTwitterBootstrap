var gulp = require('gulp');
var rename = require("gulp-rename");

gulp.task('default', function () {

    //javascript
    gulp.src('bower_components/jquery/dist/jquery.js')
        .pipe(gulp.dest('webroot/js'));
    gulp.src('bower_components/jquery/dist/jquery.min.js')
        .pipe(gulp.dest('webroot/js'));
    gulp.src('bower_components/bootstrap/dist/js/bootstrap.js')
        .pipe(gulp.dest('webroot/js'));
    gulp.src('bower_components/bootstrap/dist/js/bootstrap.min.js')
        .pipe(gulp.dest('webroot/js'));
    gulp.src('bower_components/clockpicker/dist/bootstrap-clockpicker.js')
        .pipe(rename('clockpicker.js'))
        .pipe(gulp.dest('webroot/js'));
    gulp.src('bower_components/clockpicker/dist/bootstrap-clockpicker.min.js')
        .pipe(rename('clockpicker.min.js'))
        .pipe(gulp.dest('webroot/js'));
    gulp.src('bower_components/chosen/chosen.jquery.js')
        .pipe(rename('chosen.js'))
        .pipe(gulp.dest('webroot/js'));
    gulp.src('bower_components/fontawesome-iconpicker/dist/js/fontawesome-iconpicker.js')
        .pipe(rename('iconpicker.js'))
        .pipe(gulp.dest('webroot/js'));
    gulp.src('bower_components/fontawesome-iconpicker/dist/js/fontawesome-iconpicker.min.js')
        .pipe(rename('iconpicker.min.js'))
        .pipe(gulp.dest('webroot/js'));

    //fonts
    gulp.src('bower_components/font-awesome/fonts/*')
        .pipe(gulp.dest('webroot/fonts'));

    //css
    gulp.src('bower_components/font-awesome/css/*')
        .pipe(gulp.dest('webroot/css'));
    gulp.src('bower_components/chosen/chosen.css')
        .pipe(gulp.dest('webroot/css'));

    gulp.src('bower_components/bootstrap/dist/css/bootstrap.css')
        .pipe(gulp.dest('webroot/css'));
    gulp.src('bower_components/bootstrap/dist/css/bootstrap.css.map')
        .pipe(gulp.dest('webroot/css'));
    gulp.src('bower_components/bootstrap/dist/css/bootstrap.min.css')
        .pipe(gulp.dest('webroot/css'));
    gulp.src('bower_components/bootstrap/dist/css/bootstrap.min.css.map')
        .pipe(gulp.dest('webroot/css'));
    gulp.src('bower_components/bootstrap-chosen/bootstrap-chosen.css')
        .pipe(rename('chosen.css'))
        .pipe(gulp.dest('webroot/css'));
    gulp.src('bower_components/clockpicker/dist/bootstrap-clockpicker.css')
        .pipe(rename('clockpicker.css'))
        .pipe(gulp.dest('webroot/css'));
    gulp.src('bower_components/clockpicker/dist/bootstrap-clockpicker.min.css')
        .pipe(rename('clockpicker.min.css'))
        .pipe(gulp.dest('webroot/css'));
    gulp.src('bower_components/fontawesome-iconpicker/dist/css/fontawesome-iconpicker.css')
        .pipe(rename('iconpicker.css'))
        .pipe(gulp.dest('webroot/css'));
    gulp.src('bower_components/fontawesome-iconpicker/dist/css/fontawesome-iconpicker.min.css')
        .pipe(rename('iconpicker.min.css'))
        .pipe(gulp.dest('webroot/css'));
});
