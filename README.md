РАЗВЕРТЫВАНИЕ СРЕДЫ РАЗРАБОТКИ
------------------------------

1) Клонировать репозиторий
~~~
git clone git@github.com:SweaterPower/textgarret.git
~~~
2) Перейти в папку репозитория
~~~
cd ./textgarret
~~~
3) Создать файл .env и задать переменные окружения
~~~
MYSQL_HOST=
MYSQL_DATABASE=
MYSQL_ROOT_PASSWORD=
MYSQL_USER=
MYSQL_PASSWORD=
MYSQL_PORT=
FILES_DIRECTORY=
~~~
4) Собрать и запустить докер-контейнеры
~~~
docker-compose up -d --build
~~~
5) Выполнить миграции БД
~~~
docker-compose exec php bash yii migrate --interactive=0 --compact=1
~~~

Приложение будет доступно по адресу
~~~
http://localhost:8000/
~~~

ЗАПУСК АВТОТЕСТОВ
-----------------
1) Установить переменные для тестового окружения в .env
~~~
TEST_MYSQL_HOST=
TEST_MYSQL_DATABASE=
TEST_MYSQL_ROOT_PASSWORD=
TEST_MYSQL_USER=
TEST_MYSQL_PASSWORD=
TEST_MYSQL_PORT=
~~~
ВАЖНО: Значения MYSQL_PORT и TEST_MYSQL_PORT не должны совпадать
2) Запустить контейнер тестовой БД
~~~
docker-compose -f docker-compose-tests.yml up -d --build
~~~
3) Зайти в командную строку php контейнера
~~~
docker-compose exec php bash
~~~
4) Запустить миграции для тестовой базы
~~~
./tests/bin/yii migrate/fresh --interactive=0 --compact=1
~~~
5) Запустить автотесты
~~~
./vendor/bin/codecept run
~~~
Закончив работу с тестами, можно остановить контейнер тестовой БД
~~~
docker-compose -f docker-compose-tests.yml stop
~~~