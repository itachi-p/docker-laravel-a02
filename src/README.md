# Docker & Laravel

## PHP8.3 & Laravel & MySQL(8.0) & Nginx でイメージ作成

PHPのバージョンはデフォルトで8.3を利用
変更する場合は`docker-compose.yml`のapp>build>targetの「php83」を適宜変更
変更時は`./infra/app/Dockerfile`の指定のバージョンのコメントアウトを解除

※Laravel11以降はPHP8.2以上でないと動かないので注意

問題なければ以下のコマンドを実行
`docker-compose up -d`

### 新規でLaravelプロジェクトを作成する場合

```bash
# 最新バージョン
$ docker-compose exec app composer create-project --prefer-dist laravel/laravel .

# バージョン指定の場合
$ docker-compose exec app composer create-project --prefer-dist "laravel/laravel=6.*" .
```

ブラウザで `http://localhost` にアクセスするとLaravelの初期画面が表示される

### 既存のLaravelプロジェクトの場合

既存のプロジェクトがある場合はsrcディレクトリ直下にクローンし、下記の通りcomposer installを行う。

```bash
git clone git@github.com:juno1140/vuesplash.git ./src
$ docker-compose exec app composer install
$ docker-compose exec app cp .env.example .env
$ docker-compose exec app php artisan key:generate
$ docker-compose exec app php artisan storage:link
```

composer installでエラーが出る場合はPHPのバージョンやパッケージを確認

ブラウザで`http://localhost`にアクセスすると、アプリの初期画面が表示される。

### データベースの接続とmigration

`.env`のDB情報の部分を以下のように編集（一部抜粋）

```.env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=user
DB_PASSWORD=password
```

編集したらマイグレーションを実行

`docker-compose exec app php artisan migrate`

### コンテナへのアクセス

各コンテナへは以下のコマンドで入ることができる

```bash
#### appコンテナ
$ docker-compose exec app bash

#### webコンテナ
$ docker-compose exec web sh

#### dbコンテナ
$ docker-compose exec db bash
```

---

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
