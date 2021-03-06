# Source code of my Portfolio

このリポジトリでは[ポートフォリオ](https://cleopatras-dream.sakura.ne.jp/portfolio/pages/login.php)のソースコードをご覧いただけます。

- このポートフォリオには非公開情報が含まれるため、一般公開はしていません。事前にIDとパスワードをお送りした方だけが閲覧できます。
- ログイン機能はPHPとSQLiteを用いて実装しています。
- フロントエンドは Vue + Vuetify で作成しています。
- ディレクトリ構成の説明
  - **app**
    - **api** : Ajaxの応答を行うphpプログラムを格納しています。
    - **pages** : webページを格納しています。webページはphpファイルです。
    - **private** : 外部からの直接アクセスができないディレクトリです。
      - **classes** : PHPのクラス定義ファイルを格納しています。
      - **data** : SQLiteのデータベースファイル等のデータファイルを格納しています。gitの管理外のためGitHub上では見えません。
      - **html-include** : PHPで読み込むためのhtmlの共通パーツです。
    - **public** : cssの定義ファイル、Javascriptファイル、画像ファイル等の公開リソースを格納しています。
      - **images** : 画像ファイルです。gitの管理外のためGitHub上では見えません。

