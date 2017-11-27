# 闹萌（东山奈央最萌大赛）


### 安装部署运行

```
cp .env.example .env
vim .env
```

```
composer install
npm install
npm run production
php artisan key:generate
php artisan admin:install
php artisan migrate
php artisan storage:link
```


```
tar -C /usr/local --strip-components 1 -xJf node-v4.4.4-linux.x64.tar.xz
```


### Larvel Admin 升级 1.5

```mysql
use naomoe;
alter table admin_permissions add column http_method varchar(255) null;
alter table admin_permissions add column http_path text null;
```
