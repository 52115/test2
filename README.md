# mogitate（果物通販サイト）
## 環境構築
### 1. Docker ビルド
```bash
git clone git@github.com:estra-inc/confirmation-test-contact-form.git
cd confirmation-test-contact-form
docker-compose up -d --build
  Mac の M1 / M2 チップで発生する可能性のあるエラー: no matching manifest for linux/arm64/v8 in the manifest list entries が表示されてビルドできない場合は、docker-compose.yml の mysql に platform を追記してください。

mysql:
  platform: linux/x86_64  # この行を追加
  image: mysql:8.0.26
  environment:
    ...

### 2. Laravel 環境構築
docker-compose exec php bash
composer install

###環境変数の設定
.env.example を .env にコピー、または新しく .env を作成し、以下を追加してください。
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass

###アプリケーションキー作成
php artisan key:generate

###マイグレーション・シーディング
php artisan migrate
php artisan db:seed

###使用技術（実行環境）
技術	バージョン
PHP	8.3.0
Laravel	8.83.27
MySQL	8.0.26

###ER図
![ER 図](./docs/er.png)

###開発環境
アプリケーション:	http://localhost/
phpMyAdmin	http://localhost:8080/