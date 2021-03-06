# Web制作用にカスタマイズしたGulp.js
- コーディング用の環境設定をまとめたリポジトリです
- PHPファイルを編集した際の自動リロードにも対応しています
- サンプルファイルとして、お問い合わせページ、画像アップローダーを作成しています

## 実行環境
- Windows10
- `node.js`: v12.16.2
- `npm`: 6.14.5
- `gulp`: 4.0.2

※Macでもインストールすべきものは同じ

## 初期設定
- `node.js`がインストールされていること
- 必要であれば`yarn`をインストールしておく

## ディレクトリ構成
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
- `gulp-sass-glob`により`scss`ファイルのインポートを短い記述でまとめる事もできる
```scss
// gulp-sass-glob導入前
@import "layout/_main";
@import "layout/_sub";
@import "foundation/_base";
@import "foundation/_mixin";
@import "object/component/_sample";
@import "object/project/_test";
@import "object/project/_test2";

// gulp-sass-glob導入後
@import "layout/**";
@import "foundation/**";
@import "object/**";
```
- `babelify`により`browserify`と連携して、ES6の記述のJavaScriptもバンドルして対応する
    - `@babel/preset-env`、`@babel/core`が必要

# 追加
- **bootstrap5**を導入

## インストール方法

- `yarn`を使用してインストールします

```sh
yarn add bootstrap 
```

## style.scss に bootstrap.scssをインポートする

- ディレクトリ構成に注意する

```scss
// style.scss
@import '../../node_modules/bootstrap/scss/bootstrap.scss'; // 追記する
```