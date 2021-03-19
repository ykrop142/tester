<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Панель преподавателя</title>

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

<a class="showlink" data-show="createtest">Создать тест</a>
<p></p>
<a class="showlink" data-show="edittest">Редактировать тест</a>
<p></p>
<a class="showlink" data-show="checkres">Посмотреть результаты теста</a>
<p></p>

<div class="showable show-createtest" style="text-align: center; margin-top: 18%">
    <form action="/teacher/create_name" method="post">
        @csrf
        <input type="text" name="name_test" placeholder="Введите название теста">
        <select name="group" >
            @foreach($group as $grouper)
                <option value="{{$grouper->name_group}}">{{$grouper->name_group}}</option>
            @endforeach

        </select>
        <button type="submit">перейти к созданию теста</button>
    </form>
</div>
<div class="showable show-edittest" style="text-align: center; margin-top: 18%">
2
</div>

<div class="showable show-checkres" style="text-align: center; margin-top: 18%">
3
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
