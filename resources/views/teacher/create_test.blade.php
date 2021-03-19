<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Создание теста {{$_GET['nametest']}}</title>
</head>
<body>
<form action="/teacher/add_quest" method="post" style="text-align: center; margin-top: 18%">
    @csrf
    Заполнение вопросов и ответов для теста <h2>{{$_GET['nametest']}}</h2>
    <input type="hidden" name="name_test" value="{{$_GET['nametest']}}">
    <p>
        <input type="text" name="quest" placeholder="Введите вопрос №{{$_GET['numb_quest']  ?? '1'}} ">
    </p>
    <p>
        <input type="text" name="ask1" placeholder="Введите правельный ответ">
        <input type="text" name="ask2" placeholder="Введите неправельный ответ">
    </p>
    <p>
        <input type="text" name="ask3" placeholder="Введите неправельный ответ">
        <input type="text" name="ask4" placeholder="Введите неправельный ответ">
    </p>
    <button type="submit">Следующий вопрос</button>
    <button type="submit" value="end" name="end">Завершить создание теста</button>
</form>
</body>
</html>
