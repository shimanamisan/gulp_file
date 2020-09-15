# gulp_file
コーディング用の環境設定をまとめたリポジトリです。

## 実行環境
- Windows10
- `node.js`: v12.16.2
- `npm`: 6.14.5
- `gulp`: 4.0.2

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
## 注意
- `babel-plugin-transform-runtime`を入れていないとエラーが出るかもしれない
- 後にこのパッケージをアンインストールしても動作に以上はなかったので削除した