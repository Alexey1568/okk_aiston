<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OKK Aiston</title>
</head>
<body>
  <header>
    <h1>OKK Aiston</h1>
  </header>
  <section>
    <h2>Описание</h2>
    <p>
      Проект представляет собой Laravel-приложение для обработки задач, включающее транскрибацию аудио, оценку качества и интеграцию с внешними сервисами. В системе реализованы API для регистрации, аутентификации, создания задач и получения результатов, а также планировщик для регулярной обработки задач.
    </p>
  </section>

  <section>
    <h2>Доступ к приложению</h2>
    <p>
      Приложение доступно по адресу: <a href="http://localhost:8000">http://localhost:8000</a>.<br>
      При отправке запросов необходимо использовать порт <strong>8000</strong>.
    </p>
  </section>

  <section>
    <h2>Требования</h2>
    <ul>
      <li><a href="https://www.docker.com/">Docker</a> и <a href="https://docs.docker.com/compose/">docker-compose</a></li>
      <li>Git</li>
    </ul>
  </section>

  <section>
    <h2>Установка и запуск</h2>
    <ol>
      <li>
        <strong>Клонирование репозитория:</strong>
        <pre><code>git clone https://github.com/Alexey1568/okk_aiston
cd okk_aiston</code></pre>
      </li>
      <li>
        <strong>Сборка Docker образов:</strong>
        <pre><code>docker-compose build</code></pre>
      </li>
      <li>
        <strong>Запуск контейнеров:</strong>
        <pre><code>docker-compose up</code></pre>
        <p>После успешного запуска приложение будет доступно по адресу: <a href="http://localhost:8000">http://localhost:8000</a>.</p>
      </li>
    </ol>
  </section>

  <section>
    <h2>Тестирование API</h2>
    <p>Приложение предоставляет следующие API эндпоинты:</p>
    <article>
      <h3>Регистрация пользователя</h3>
      <ul>
        <li><strong>URL:</strong> <code>http://localhost:8000/register</code></li>
        <li><strong>Метод:</strong> POST</li>
        <li>
          <strong>Параметры:</strong>
          <ul>
            <li><code>name</code> – имя пользователя</li>
            <li><code>email</code> – email</li>
            <li><code>password</code> – пароль</li>
          </ul>
        </li>
      </ul>
    </article>
    <article>
      <h3>Аутентификация пользователя</h3>
      <ul>
        <li><strong>URL:</strong> <code>http://localhost:8000/login</code></li>
        <li><strong>Метод:</strong> POST</li>
        <li>
          <strong>Параметры:</strong>
          <ul>
            <li><code>email</code> – email</li>
            <li><code>password</code> – пароль</li>
          </ul>
        </li>
        <li>
          <strong>Примечание:</strong> Эндпоинт требует аутентификации (middleware <code>auth:sanctum</code>).
        </li>
      </ul>
    </article>
    <article>
      <h3>Выход из системы</h3>
      <ul>
        <li><strong>URL:</strong> <code>http://localhost:8000/logout</code></li>
        <li><strong>Метод:</strong> POST</li>
        <li>
          <strong>Примечание:</strong> Эндпоинт требует аутентификации (middleware <code>auth:sanctum</code>).
        </li>
      </ul>
    </article>
    <article>
      <h3>Создание задачи</h3>
      <ul>
        <li><strong>URL:</strong> <code>http://localhost:8000/task/create</code></li>
        <li><strong>Метод:</strong> POST</li>
        <li>
          <strong>Параметры:</strong>
          <ul>
            <li><code>audio_url</code> – URL аудиофайла (обязательно, должен быть корректным URL)</li>
            <li><code>status</code> – статус задачи (по умолчанию <code>new</code>)</li>
            <li><code>metadata</code> – дополнительные данные (необязательно)</li>
          </ul>
 <li>
          <strong>Примечание:</strong> Эндпоинт требует аутентификации (middleware <code>auth:sanctum</code>).
        </li>
        </li>
      </ul>
    </article>
    <article>
      <h3>Получение результата задачи</h3>
      <ul>
        <li><strong>URL:</strong> <code>http://localhost:8000/task/result/{task}</code></li>
        <li><strong>Метод:</strong> GET</li>
        <li><strong>Параметры:</strong> <code>{task}</code> – идентификатор задачи</li>
 <li>
          <strong>Примечание:</strong> Эндпоинт требует аутентификации (middleware <code>auth:sanctum</code>).
        </li>
      </ul>
    </article>
    <p>Для тестирования API можно использовать <a href="https://www.postman.com/">Postman</a> или <a href="https://curl.se/">curl</a>.</p>
  </section>
  <section>
    <h2>Планировщик задач</h2>
    <p>
      Планировщик настроен через Laravel Scheduler и реализует периодическую обработку задач.
      Задача в кроне будет создана при запуске контейнера.
    </p>
    <ul>
      <li>
        <strong>Описание:</strong> В классе <code>Kernel</code> в методе <code>schedule</code> задан запуск задачи каждые 5 минут, которая обрабатывает задачи и запускает событие <code>TaskCompleted</code> при завершении обработки.
      </li>
    </ul>
  </section>


</body>
</html>
