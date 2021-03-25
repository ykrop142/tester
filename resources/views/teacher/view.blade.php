<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table,td,th,tr{
            border: 1px solid grey;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td>
                название вопроса
            </td>
            <td>
                номер вопроса
            </td>
            <td>
                ответ
            </td>
        </tr>
        @foreach($res as $reses)
            @if(!empty($reses['name']))
                <p>Имя:  {{$reses['name']}}</p>
            @endif
            @if(!empty($reses['fam']))
                <p>Фамилия:  {{$reses['fam']}}</p>
            @endif
                @if(!empty($reses['numb_group']))
                    <p>Номер группы: {{$reses['numb_group']}}</p>
                @endif
            @if(!empty($reses['name']))
                <p>Номер телефона: {{$reses['phon_numb']}}</p>
            @endif
            @if(!empty($reses['name']))
                <p>Название теста: {{$reses['name_test']}}</p>
            @endif
            @if(!empty($reses['name']))
                <p>Итоговая оценка: {{$reses['ocenka']}}</p>
            @endif
            @if(!empty($reses['name_quest']))
                <tr>
                    <td>
                        <p>{{$reses['name_quest']}}</p>
                    </td>
            @endif
            @if(!empty($reses['numb_quest']))
                    <td>
                        <p>{{$reses['numb_quest']}}</p>
                    </td>
            @endif
            @if(!empty($reses['ask']))
                    <td>
                        <p style="color:{{$reses['color']}}">{{$reses['ask']}}</p>
                    </td>
                </tr>
            @endif
        @endforeach
    </table>
</body>
</html>
