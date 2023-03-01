const { src, dest, watch, parallel } = require("gulp");

// CSS
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const postcss = require('gulp-postcss');
const sourcemaps = require('gulp-sourcemaps');

// images 
const imagemin = require("gulp-imagemin"); // Minify images
const notify = require("gulp-notify");
const cache = require("gulp-cache");
const clean = require("gulp-clean");
const webp = require("gulp-webp");
const avif = require('gulp-avif');

// JS
const concat = require("gulp-concat");
const terser = require("gulp-terser-js");
const rename = require("gulp-rename");


const paths = {
  scss: "src/scss/**/*.scss",
  js: "src/js/**/*.js",
  images: "src/img/**/*",
};

function css() {
  return (
    src(paths.scss)
      .pipe(sourcemaps.init())
      .pipe(sass({outputStyle: 'expanded'}))
      .pipe(postcss([autoprefixer(), cssnano()]))
      // .pipe(postcss([autoprefixer()]))
      .pipe(sourcemaps.write("."))
      .pipe(dest("./public/build/css"))
  );
}

function javascript() {
  return (
    src(paths.js)
      .pipe(sourcemaps.init())
      .pipe(concat("bundle.js"))
      .pipe(terser())
      .pipe(sourcemaps.write("."))
      .pipe(rename({ suffix: ".min" }))
      .pipe(dest("./public/build/js"))
  );
}

function images() {
  return src(paths.images)
    .pipe(cache(imagemin({ optimizationLevel: 3 })))
    .pipe(dest("./public/build/img"))
    .pipe(notify({ message: "Imagen Completada" }));
}

function convertToWebp() {
  return src(paths.images)
    .pipe(webp())
    .pipe(dest("./public/build/img"))
    .pipe(notify({ message: "Imagen Completada" }));
}

function convertToAvif( done ) {
  const options = {
      quality: 50
  };
  src('src/img/**/*.{png,jpg}')
      .pipe( avif(options) )
      .pipe( dest('./public/build/img') )
  done();
}

function watchFiles() {
  watch(paths.scss, css);
  watch(paths.js, javascript);
  watch(paths.images, images);
  watch(paths.images, convertToWebp);
}

exports.css = css;
exports.watchFiles = watchFiles;
exports.javascript = javascript;
exports.default = parallel(css, javascript, images, convertToWebp, convertToAvif, watchFiles);
