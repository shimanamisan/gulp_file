# gulp_file
コーディング用の環境設定をまとめたリポジトリです。

## 実行環境
- Windows10
- `node.js`: v12.16.2
- `npm`: 6.14.5
- `gulp`: 4.0.2

※Macでもインストールすべきものは同じ


## 初期設定
- `node.js`がインストールされていること
- 必要であれば`yarn`をインストールしておく

### ディレクトリ構成
```
root/
　├ src/
　│　├ js/
　│　├ scss/**
　├ dist/
　│　├ js/bundle.min.js
　│　├ css/style.min.css
```

## 機能
- `browser-sync`をPHPファイルにも対応
- `gulp-sass-glob`により`scss`ファイルのインポートを短い記述でまとめる
```scss
// gulp-sass-glob導入前
@import "layout/_main";
@import "layout/_sub";
@import "foundation/_base";
@import "foundation/_mixin";
@import "object/component/_sample";
@import "object/component/project/_test";
@import "object/component/project/_test2";

// gulp-sass-glob導入後
@import "layout/**";
@import "foundation/**";
@import "object/**";
```
- `babelify`により`browserify`と連携して、ES6の記述のJavaScriptもバンドルして対応する
    - `@babel/preset-env`、`@babel/core`が必要