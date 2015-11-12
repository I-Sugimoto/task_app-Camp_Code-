-- データベースの作成
create database task_app;

-- 作業ユーザーの設定
grant all on task_app.* to testuser@localhost identified by '9999';

-- 使用するデータベースの宣言
use task_app

-- テーブルの作成
create table tasks (
    id int primary key auto_increment,
    title varchar(255),
    status varchar(10) default 'notyet',
    created_at datetime,
    updated_at datetime
);

-- テスト用のレコードを入れておく
insert into tasks (title, created_at, updated_at) values
('報告書を作成する', now(), now()),
('コピー用紙を購入する', now(), now()),
('年賀状を書く', now(), now());
