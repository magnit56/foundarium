<ul>
<h2>Требования Laravel</h2>
<li>PHP ^8.0.2 (У меня 8.1.5)</li>
<li>BCMath PHP Extension</li>
<li>Ctype PHP Extension</li>
<li>Fileinfo PHP extension</li>
<li>JSON PHP Extension</li>
<li>Mbstring PHP Extension</li>
<li>OpenSSL PHP Extension</li>
<li>PDO PHP Extension</li>
<li>Tokenizer PHP Extension</li>
<li>XML PHP Extension</li>
<li>Еще требование pdo_sqlite(кажется так называется расширение php, которое нужно установить, в проекте мы использовали базу данных SQLite)</li>
</ul>

<code>$ make setup</code> - для установки пакетов и наката миграций<br>
<code>$ php artisan db:seed</code> - Заполнить базу данных 10 машинами и 20 пользователями, если база данных все-таки не заполнилась после предыдущей команды<br>
<code>$ make start</code> - для запуска веб-сервера<br>
<code>$ make test</code> - для запуска тестов<br>

Документация swagger находится <a href="http://localhost:8000/api/documentation">здесь</a>.
Ну в смысле на веб-сервере с api она находится.
