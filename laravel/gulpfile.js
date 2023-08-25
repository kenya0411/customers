// 必要なモジュールをインポートします。
var gulp = require( 'gulp' );
var sass = require('gulp-sass')(require('sass'));
var plumber = require( 'gulp-plumber' ); // エラーハンドリングのためのモジュール
var notify = require( 'gulp-notify' ); // エラー通知のためのモジュール
var sassGlob = require( 'gulp-sass-glob' ); // SASSファイルのインポートを簡単にするモジュール
var mmq = require( 'gulp-merge-media-queries' ); // メディアクエリをマージするためのモジュール
var browserSync = require( 'browser-sync' ).create(); // ブラウザの自動リロードのためのモジュール
var postcss = require( 'gulp-postcss' ); // CSSを変換するためのツール
var autoprefixer = require( 'autoprefixer' ); // ベンダープレフィックスの自動付与
var cssdeclsort = require( 'css-declaration-sorter' ); // CSS宣言の自動ソート
var config = require('./gulpconfig.json'); // 外部からの設定ファイルをインポート
const changed = require('gulp-changed'); // 変更があったファイルだけを処理
var imagemin = require( 'gulp-imagemin' ); // 画像の最適化
var pngquant = require( 'imagemin-pngquant' ); // PNGの最適化
var mozjpeg = require( 'imagemin-mozjpeg' ); // JPEGの最適化
var del = require('del');//ファイルの削除
//変更されたファイルのみをコンパイル
var cache = require('gulp-cached');
var progeny = require('gulp-progeny');

// ファイルのパスを設定
let paths = config.paths;


// 新たなclean-cssタスクを作成
gulp.task('clean-css', (done) => {
  return del([`${paths.dist}/scss/**/*.css`]);
});


// パーシャルのコンパイルタスク
gulp.task('sass-partials', (done) => {
  return gulp
  .src(paths.sass)
  .pipe(plumber({ errorHandler: notify.onError("Error: <%= error.message %>") }))
  .pipe(sass().on('error', sass.logError))
  .pipe(sassGlob())
  .pipe(browserSync.stream())
  .pipe(postcss([
    autoprefixer({
      overrideBrowserslist: ["last 2 versions", "ie >= 11", "Android >= 4"],
      cascade: false,
      grid: "autoplace"
    })
  ]))
  .pipe(gulp.dest(paths.dist));
  done();
});

// 非パーシャルのコンパイルタスク
gulp.task( 'sass-others', (done) => {
  return gulp
  .src( paths.sass ) // ソースとなるSassファイルの指定
    .pipe(cache('sass'))  // cacheを適用する
    .pipe(progeny())  // 変更されたファイルだけを選択する
  .pipe( plumber({ errorHandler: notify.onError("Error: <%= error.message %>") })) // エラーが出ても処理を止めない
  .pipe(sass().on('error', sass.logError)) // Sassのコンパイルとエラーログの出力
    .pipe(changed(paths.dist)) // 変更があったファイルのみをコンパイル
  .pipe(sassGlob()) // Sassの@importにおけるglobを有効にする
  .pipe(browserSync.stream()) // リロード時に位置を固定
    .pipe(postcss([
      autoprefixer({
        browsers: ["last 2 versions", "ie >= 11", "Android >= 4"], // 対応ブラウザ
        cascade: false,
        grid: "autoplace"
      })
    ])) // ベンダープレフィックスの付与
    .pipe(gulp.dest(paths.dist)); // コンパイル後のCSSを出力
  done();
})




// ブラウザを自動リロードするための設定
gulp.task( 'browser-sync', (done) =>{
  browserSync.init({
        proxy: config.url,  // 開発用のサーバーURL
        open: true, // ブラウザを自動で開く
        watchOptions: {
            debounceDelay: 1000  //1秒間、タスクの再実行を抑制
        }
  });
  done();
});

// ブラウザをリロード
gulp.task( 'bs-reload', (done)=> {
  browserSync.reload();
  done();
});

// 画像の最適化タスク
gulp.task('img', (done)=> {
  gulp.src(config.img)
  .pipe(imagemin([
      pngquant({ quality: [.65,.80], speed: 1 }),
      mozjpeg({ quality: 100 }),
      imagemin.svgo(),
      imagemin.gifsicle()
    ]
  ))
  .pipe(gulp.dest(config.imgdest));
});

// ファイルを監視し、変更があればブラウザをリロードするデフォルトタスク
gulp.task( 'default', gulp.series(( 'browser-sync' ), (done) => {

  gulp.watch(paths.partials, gulp.series('sass-partials', 'bs-reload'));
  gulp.watch(paths.sass, gulp.series('sass-others', 'bs-reload','clean-css'));
  gulp.watch( './**/*.php', gulp.series( 'bs-reload')) // phpファイルの変更を監視
  gulp.watch( './**/*.js', gulp.series( 'bs-reload' )) // jsファイルの変更を監視
  done();
}));
