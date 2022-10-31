// ***INCLUDES - Gulp***
// src = source, dest = destination, placement of files.
// watch = looks for updates in files, any changes, series - runs task in a series, paralell - runs tasks paralell from eachother
const browserSync = require('browser-sync');
const { src, dest, watch, series, parallel } = require('gulp');
const imagemin = require('gulp-imagemin');
const sass = require('gulp-sass')(require('sass'));
const sourcemaps = require('gulp-sourcemaps');
const ts = require("gulp-typescript");
const tsProject = ts.createProject("tsconfig.json");



// Search ways
const files = {
    htmlPath: "src/**/*.html", // goes into src folder, looks for files with ending .html
    cssPath: "src/**/*.css", // goes into src folder, looks for files with ending .css
    sassPath: "src/sass/*.scss",
    // jsPath: "src/**/*.js", // goes into src folder, looks for files with ending .js
    imagePath: "src/images/*", // goes into src folder, looks for evertything in the folder
    tsPath: "src/typescript/*.ts"
}

//***TASKS***
//HTML task, copy files
function copyHTML() {
    return src(files.htmlPath) // return html files
        .pipe(dest("pub")) // Pipe, direct theese files to destination -> folder pub (publication)
}

// Transpile Typescript
function typescriptTask() {
    return src(files.tsPath, { sourcemaps: true })
        .pipe(tsProject())
        .pipe(dest("pub/js"))
        .pipe(browserSync.stream());

}


//image-task
function imageTask() {
    //return images
    return src(files.imagePath)
        .pipe(imagemin([
            //settings for how much images should be compressed
            imagemin.gifsicle({ interlaced: true }),
            imagemin.mozjpeg({ quality: 70, progressive: true }),
            imagemin.optipng({ optimizationLevel: 5 }),
            imagemin.svgo({
                plugins: [
                    { removeViewBox: true },
                    { cleanupIDs: false }
                ]
            })
        ]))
        .pipe(dest('pub/images')); // direct theese files to pub folder

}

function sassTask() {
    return src(files.sassPath)
        .pipe(sourcemaps.init())
        .pipe(sass({ outputStyle: 'compressed' }).on("error", sass.logError))
        .pipe(sourcemaps.write('./maps'))
        .pipe(dest("pub/css"))
        .pipe(browserSync.stream());
}



//Watch function
function watchTask() {
    // browsersync start
    browserSync.init({
        server: "./pub" // watch this catalog for changes
    })
    watch([files.htmlPath, files.tsPath, files.imagePath, files.sassPath], parallel(copyHTML, typescriptTask, imageTask, sassTask)).on('change', browserSync.reload); // if changes, reload
}

//exports of functions to make the accessable
exports.default = series(
    //functions to run
    parallel(copyHTML, typescriptTask, imageTask, sassTask),
    watchTask
);