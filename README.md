# # 用 Laravel8 开发的诗词应用，包含前端 api 和后台管理

## 环境

| 程序 | 版本 |
| -------- | -------- |
| PHP| `>= 7.3` |
| MySQL| `>= 5.5` |
| Redis| `>= 2.8` |

### 注意
扩展包：`tymon/jwt-auth` 1.0.2 不支持 php8， 要支持php8，暂先安装 `1.0.x-dev`,等后期更新

## 安装

1. 先把项目克隆到本地

```
git clone git@github.com:ibyond/poetry.git
```

2. 打开项目目录，下载依赖扩展包

```
composer install
```

3. 复制配置文件

```
cp .env.example .env
```

自行配置`.env`里的相关配置信息

4. 生成`APP_KEY`和`JWT_SECRET`
```
php artisan key:generate
php artisan jwt:secret
```

5. 创建迁移
```
php artisan migrate
```

7. 启动队列
```
php artisan queue:work
```

8. 导入数据

解压 public 目录下的数据库文件导入数据
