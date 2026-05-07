# アプリケーション名
フリマアプリ（COACHTECH）

## 環境構築
Docker（Laravel Sail）を使用した環境構築手順です。

```bash
# 1. リポジトリのクローンとディレクトリへの移動
git clone https://github.com/hana20210115/coachtech-frima.git
cd coachtech-frima

# 2. Composerパッケージのインストール
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs

# 3. 環境変数の設定
cp .env.example .env

# ※コピーして作成された .env ファイルをエディタで開き、以下の3点を修正・追記してください。
#
# ① データベースの接続情報をSail（Docker）の初期設定に合わせる
#   DB_CONNECTION=mysql
#   DB_HOST=mysql
#   DB_PORT=3306
#   DB_DATABASE=coachtech_frima
#   DB_USERNAME=sail
#   DB_PASSWORD=password
#
# ② Stripe決済用のAPIキーを設定する
#   Stripeダッシュボードにログイン後、「開発者」>「APIキー」から取得したテストキーを末尾に追記してください。
#   URL: https://dashboard.stripe.com/
#
#   STRIPE_KEY=pk_test_************************
#   STRIPE_SECRET=sk_test_************************
#
# ③ メール送信（Mailtrap）の設定を自身の認証情報に変更する
#   Mailtrapにログイン後、「Email Testing」>「Inboxes」>「My Inbox」から
#   表示されているUsernameとPasswordを以下に書き換えてください。
#   URL: https://mailtrap.io/
#
#   MAIL_MAILER=smtp
#   MAIL_HOST=sandbox.smtp.mailtrap.io
#   MAIL_PORT=2525
#   MAIL_USERNAME=取得したユーザー名
#   MAIL_PASSWORD=取得したパスワード

# 4. Dockerコンテナのビルドと起動
./vendor/bin/sail up -d --build

# 5. アプリケーションキーの生成
./vendor/bin/sail artisan key:generate

# 6. 画像保存用のストレージリンク作成
./vendor/bin/sail artisan storage:link

# 7. データベースのマイグレーションとシーディング
./vendor/bin/sail artisan migrate:fresh --seed
```
## ⚠️ トラブルシューティング（環境構築でつまずきやすいポイント）

特にWindows（WSL2）環境で構築する際に起きやすいエラーと、その解決策をまとめています。

### 1. `Dockerコンテナのビルド` の途中で `exit code: 100` などのエラーが出て止まってしまう
* **原因:** Windows (WSL2) 環境において、パッケージダウンロード時にセキュリティ通信（TLS）のパケットサイズが大きすぎて通信が遮断されてしまうネットワークのバグ（MTU問題）が原因の可能性が高いです。
* **解決策:** Ubuntuのターミナルで以下のコマンドを実行し、通信の通り道のサイズ（MTU）を調整してから、再度ビルドを実行してください。
```bash
# 1. 通信サイズを調整する（パスワードを求められたらUbuntuのパスワードを入力）
sudo ip link set dev eth0 mtu 1350

# 2. キャッシュを使わずに再ビルドする
./vendor/bin/sail build --no-cache
./vendor/bin/sail up -d
```



## テスト用アカウント・決済情報
動作確認の際は、以下のテスト用情報をご利用ください。
**※実際のクレジットカード情報は絶対に入力しないでください。**

### 1. テスト用カード情報（Stripeテスト環境）
| 項目 | テスト用入力値 |
| :--- | :--- |
| **カード番号** | `4242 4242 4242 4242` |
| **有効期限** | `12 / 34` （または将来の任意の日付） |
| **CVC / セキュリティコード** | `123` |

### 2. テスト用ユーザー（シーディング済み）
- **メールアドレス**: `admin@example.com`
- **パスワード**: `password`

## 使用技術(実行環境)
- PHP 8.5.3
- Laravel 10.50.2
- MySQL 8.4.8
- Laravel Sail (Docker)
- Stripe (決済システム)
- Tailwind CSS

## ER図
![ER図](./er-diagram.png)

## URL
- 開発環境：http://localhost/
- ユーザー登録：http://localhost/register
- ログイン：http://localhost/login