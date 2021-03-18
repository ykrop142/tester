<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Админ панель</title>

    <style>
        .showable
        {
            display: none;

            border: 1px #f50000 dashed;
            padding:10px;
        }

        .showlink
        {
            cursor: pointer;
        }
    </style>

</head>

<body>

<a class="showlink" data-show="reger">Регистрация пользователя</a>
<p></p>
<a class="showlink" data-show="group">Добавить группу студентов</a>
<p></p>

<div class="showable show-reger" style="text-align: center; margin-top: 18%">
    <div>Регистрация пользователей</div>
    <form action="/admin/reguser" method="post">
        @csrf
        <p>
            <input type="text" name="email" placeholder="Введите почту">
        </p>
        <p>
            <select name="permiss" >
                <option value="Студент">Студент</option>
                <option value="Преподаватель">Преподаватель</option>
                <option value="Администратор">Администратор</option>
            </select>
        </p>
        <button type="submit">ok</button>
    </form>
</div>
<div class="showable show-group" style="text-align: center; margin-top: 18%">
    <div>Добавление групп для студентов</div>
    <form action="/admin/reg_group" method="post">
        @csrf
        <p>
            <input type="text" name="group" placeholder="Введите номер группы">
        </p>
        <button type="submit">ok</button>
    </form>
</div>

<script>
    var links = document.querySelectorAll('.showlink');
    links.forEach(function(link) {
        link.addEventListener('click', function(){
            var divs = document.querySelectorAll('.showable');
            divs.forEach(function(div) {
                div.style.display = 'none';
            });

            var aim = document.querySelector('.show-' + this.getAttribute('data-show'));
            if(aim) {
                aim.style.display = 'block';
            }
        });
    });
</script>

</body>

</html>
