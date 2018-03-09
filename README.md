# charts
This is a chart package for laravel.

# 一、安装

## 1、安装包

```bash
composer require hefengbao/charts
```
## 2、服务提供者
如果是 Laravel 5.5 以下版本，则需要把 `ChartsServiceProvider` 添加到 `config/app.php` 中：

```bash
HeFengbao\Charts\ChartsServiceProvider::class,
```

## 3、发布配置文件（可选）
```bash
php artisan vendor:publish --tag=charts_config
```

# 二、文档