<!DOCTYPE html>
<html>
<head>
    <title>Laravel Ajax Post Request Example</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src = "//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
<div class="modal fade" id="TestModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="container">
                    <span class="success" style="color:green; margin-top:10px; margin-bottom: 10px;">

    </span>
                    <form id="ajaxform" onsubmit="return false;">


                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<button type="button" name="id" value="7" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TestModal"  onclick="test()">
    Посмотреть тест
</button>
<script>

  //  $(".save-data").click(function(event){
    //    event.preventDefault();
  function test(){

        let id = $("button[name=id]").val();
        let _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "getmsg",
            type:"POST",
            data:{
                id:id,
                _token: _token
            },
            success:function(response){
                //console.log(response);
                if(response) {
                    $('.success').text(response.success);
                    $("#ajaxform")[0].reset();
                }
            },
        });
    };
</script>

</body>
</html>
