<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src = "//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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
        table,td,th,tr{
            border: 1px solid grey;
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
    <table>
        <tr>
            <th>
                Название теста
            </th>
            <th>
                Доступ группы
            </th>
        </tr>
        @foreach($tests as $test)
            <div class="modal fade" id="TestModal{{$test->id}}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">{{$test->name_test}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <span class="success"  style="color:green; margin-top:10px; margin-bottom: 10px;"></span>


                            <div class="container" >
                                <div class="row" id="ask1">

                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        <tr>
            <td>
                {{$test->name_test}}
            </td>
            <td>
                {{$test->numb_group}}
            </td>
            <td>
                <button type="button" name="ids" value="{{$test->id}}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TestModal{{$test->id}}"  onclick="test({{$test->id}})">
                    Посмотреть тест
                </button>
            </td>
        </tr>
        @endforeach
    </table>
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

    function test(e){
        let ids = e;
        let _token   = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "teacher/getmsg",
            type:"POST",
            data:{
                ids:ids,
                _token: _token
            },
            success:function(response){
               // console.log(response);
                if(response) {
                   // let x ='<div class="row">' +
                   //     '<div class="col" id="ask1">' +
                   //     response.ids +
                   //     '</div>';// +
                   //     //'<div class="col">' +
                   //    // 'цифра' +
                   let q =response.col;
                    let y = '';
                    for (let i =0;i<q;i++){
                        y=y+'<div class="col-12" id="ask1">'+response.students[i]['name']+
                            ' '+response.students[i]['fam']+' Группа: '+response.group[i]['name_group']+
                            ' Оценка: '+ response.bal[i]['ball']+' <a href="https://tester.greenkras.ru/teacher/view/'+
                            response.idu[i]+ids+'">Результаты теста</a>';
                    }
                    $('#ask1').html(y);
                }
            },
        });
    }
</script>

</body>

</html>
