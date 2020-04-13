[![Yii2](https://img.shields.io/badge/Powered_by-Yii_Framework-green.svg?style=flat)](https://www.yiiframework.com/)

# Run project

```bash
docker-compose up
docker-compose exec web composer install
```

You should access to:

- Application: [http://127.0.0.1:8000](http://127.0.0.1:8000)
- phpMyAdmin: [http://127.0.0.1:8080](http://127.0.0.1:8080)

> Notice: If you're using Docker Toolbox, change 127.0.0.1 by the IP address of your virtual machine, ie 192.168.99.100

## Run tests

### Unit tests

```bash
php vendor/bin/codecept run unit   
```

### Functional tests

```bash
php vendor/bin/codecept run functional
```