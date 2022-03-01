
var gulp = require( 'gulp' );
var sass = require( 'gulp-sass' );
var plumber = require( 'gulp-plumber' );
var notify = require( 'gulp-notify' );
var sassGlob = require( 'gulp-sass-glob' );
var mmq = require( 'gulp-merge-media-queries' );
var browserSync = require( 'browser-sync' ).create();
var postcss = require( 'gulp-postcss' );
var autoprefixer = require( 'autoprefixer' );
var cssdeclsort = require( 'css-declaration-sorter' );
var config = require('./gulpconfig.json');//外部コンフィグ出力
const changed = require('gulp-changed');
var imagemin = require( 'gulp-imagemin' );
var pngquant = require( 'imagemin-pngquant' );
var mozjpeg = require( 'imagemin-mozjpeg' );
var paths = {
  work: 'src',
  sass: './scss/**/*.sass',
  dist: './',
  // distCss: 'dist/css'
};
//sassのコンパイル
gulp.task( 'sass', (done) => {
  return gulp
	.src( paths.sass )
	.pipe( plumber({ errorHandler: notify.onError("Error: <%= error.message %>") }))
	.pipe(sass().on('error', sass.logError))/*エラーログを解除*/
  
    .pipe(changed(paths.dist))

	// .pipe(gulp.dest(dist))
	.pipe(sassGlob()) // Sassの@importにおけるglobを有効にする
	.pipe(browserSync.stream())//リロード時に位置を固定
    .pipe(postcss([
      autoprefixer({
        // ☆IEは11以上、Androidは4.4以上
        // その他は最新2バージョンで必要なベンダープレフィックスを付与する設定
        browsers: ["last 2 versions", "ie >= 11", "Android >= 4"],
        cascade: false,
        grid: "autoplace"
      })
    ]))
    .pipe(gulp.dest(paths.dist));
	done();

})

//sassファイルを監視
gulp.task( 'watch', (done) => {
	gulp.watch( paths.sass,  gulp.series( 'sass' ));//watchをするファイルを選択
	done();
});

//ブラウザを自動リロード
gulp.task( 'browser-sync', (done) =>{
	browserSync.init({
        proxy: config.url,  
        open: true,
        watchOptions: {
            debounceDelay: 1000  //1秒間、タスクの再実行を抑制
        }
	});
	done();
});


gulp.task( 'bs-reload', (done)=> {
	browserSync.reload();
	done();
});


gulp.task('img', (done)=> {
  gulp.src(config.img)
  .pipe(imagemin(
    [
      pngquant({ quality: [.65,.80], speed: 1 }),

      mozjpeg({ quality: 100 }),
      imagemin.svgo(),
      imagemin.gifsicle()
    ]
  ))
  .pipe(gulp.dest(config.imgdest));
});


//ファイルを監視して自動リロード
gulp.task( 'default', gulp.series(( 'browser-sync' ), (done) => {

	gulp.watch( paths.sass, gulp.series( 'sass','bs-reload'))
	gulp.watch( './**/*.php', gulp.series( 'bs-reload'))
	gulp.watch( './*.html', gulp.series( 'bs-reload' ))
	gulp.watch( './js/*.js', gulp.series( 'bs-reload' ))
	done();
}));

