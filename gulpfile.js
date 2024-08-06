// Load plugins
const gulp = require("gulp");
const plumber = require("gulp-plumber");
const sass = require("gulp-sass")(require("sass"));
const notify = require("gulp-notify");
const wpPot = require("gulp-wp-pot");
const clean = require("gulp-clean");
const rename = require("gulp-rename");
const sourcemaps = require("gulp-sourcemaps");
const zip = require("gulp-zip");
const cleanCSS = require("gulp-clean-css");
const uglify = require("gulp-uglify");
const package = require("./package.json");

// Paths
const paths = {
  scss: {
    src: "src/assets/css/**/*.css",
    dest: "src/assets/css/",
  },
  js: {
    src: "src/assets/js/**/*.js",
    dest: "src/assets/js/",
  },
};

// Error handler
const onError = function (err) {
  notify.onError({
    title: "Gulp",
    subtitle: "Failure!",
    message: "Error: <%= error.message %>",
    sound: "Basso",
  })(err);
  this.emit("end");
};

// Generate .pot file
gulp.task("makepot", function () {
  return gulp
    .src("**/*.php")
    .pipe(
      plumber({
        errorHandler: onError,
      })
    )
    .pipe(
      wpPot({
        domain: "plugin-boilerplate",
        package: "Plugin Boilerplate",
      })
    )
    // Change Plugin File Name
    .pipe(gulp.dest("languages/plugin-boilerplate.php"));
});

// Clean zip and build directories
gulp.task("clean-zip", function () {
  return gulp
    .src("./*.zip", {
      read: false,
      allowEmpty: true,
    })
    .pipe(clean());
});

gulp.task("clean-build", function () {
  return gulp
    .src("./build", {
      read: false,
      allowEmpty: true,
    })
    .pipe(clean());
});

// Copy files to build directory
gulp.task("copy", function () {
  return gulp
    .src([
      "./**/*.*",
      "!./build/**",
      "!src/assets/**/*.map",
      "!src/assets/react/**",
      "!src/assets/scss/**",
      "!src/Admin/Framework/assets/scss/**",
      "!src/assets/sass/**",
      "!src/assets/.sass-cache",
      "!./node_modules/**",
      "!./v2-library/**",
      "!./test/**",
      "!./.docz/**",
      "!./**/*.zip",
      "!.github",
      "!.vscode",
      "!./readme.md",
      "!.DS_Store",
      "!./**/.DS_Store",
      "!./LICENSE.txt",
      "!./icofont-collection.txt",
      "!./*.lock",
      "!./*.js",
      "!./*.json",
      "!yarn-error.log",
      "!bin/**",
      "!tests/**",
      "!.env",
      "!vendor/bin/**",
      "!vendor/doctrine/**",
      "!vendor/myclabs/**",
      "!vendor/nikic/**",
      "!vendor/phar-io/**",
      "!vendor/phpdocumentor/**",
      "!vendor/phpspec/**",
      "!vendor/phpunit/**",
      "!vendor/sebastian/**",
      "!vendor/theseer/**",
      "!vendor/webmozart/**",
      "!vendor/yoast/**",
      "!.phpunit.result.cache",
      "!.travis.yml",
      "!phpunit.xml.dist",
      "!phpunit.xml",
      "!phpcs.xml",
      "!phpcs.xml.dist",
    ])
    .pipe(gulp.dest("build/plugin-boilerplate/"));
});

// Create a zip file
gulp.task("make-zip", function () {
  return gulp
    .src("./build/**/*.*")
    .pipe(zip(`plugin-boilerplate-v${package.version}.zip`))
    .pipe(gulp.dest("./"));
});
// Clean only minified JavaScript files
gulp.task("cleanMinifiedCSS", function () {
  return gulp
    .src(`${paths.scss.dest}/*.min.css`, { read: false, allowEmpty: true })
    .pipe(clean());
});
// Minify CSS
gulp.task("minify-css", function () {
  return gulp
    .src(paths.scss.src)
    .pipe(sass().on("error", sass.logError))
    .pipe(cleanCSS())
    .pipe(rename({ suffix: ".min" }))
    .pipe(gulp.dest(paths.scss.dest));
});

// Clean only minified JavaScript files
gulp.task("cleanMinifiedJs", function () {
  return gulp
    .src(`${paths.js.dest}/*.min.js`, { read: false, allowEmpty: true })
    .pipe(clean());
});

// Minify JS
gulp.task("minify-js", function () {
  return gulp
    .src(paths.js.src)
    .pipe(uglify())
    .pipe(rename({ suffix: ".min" }))
    .pipe(gulp.dest(paths.js.dest));
});

// Convert images to WebP format
function convertToWebp() {
  return gulp
    .src(paths.images.src)
    .pipe(webp())
    .pipe(gulp.dest(paths.images.dest));
}

// Watch for changes
gulp.task("watch", function () {
  gulp.watch(paths.scss.src, gulp.series("cleanMinifiedCSS", "minify-css"));
  gulp.watch(paths.js.src, gulp.series("cleanMinifiedJs", "minify-js"));
  gulp.watch(paths.scss.src, gulp.series(...task_keys));
});

// Export tasks
exports.default = gulp.series(
  "clean-zip",
  "clean-build",
  "cleanMinifiedCSS",
  "minify-css",
  "cleanMinifiedJs",
  "minify-js",
  "makepot",
  "copy",
  "make-zip"
);

exports.minifyCss = gulp.series("cleanMinifiedCSS", "minify-css");
exports.minifyJs = gulp.series("cleanMinifiedJs", "minify-js");
exports.watch = gulp.series("watch");
