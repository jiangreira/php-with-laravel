<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            height: 100%;
            font-family: 'Noto Sans TC', sans-serif;
        }

        /* tr td{
            text-align: center;
        } */
    </style>
</head>

<body>
    @if (session('createok'))
    <script>
        alert('新增成功')
    </script>
    @elseif(session('updateok'))
    <script>
        alert("{{ Session::get('updateok')}}")
    </script>
    @endif

    <div class="container-fulid">
        @include('layout/nav')
    </div>
    <div class="container mt-3 d-flex justify-content-center">
        <h4 class="mt-3 mb-3">清單列表</h4>
        <hr>
        <button id="createbtn" class="btn btn-primary float-right mb-3 mr-2">新增</button>
        <button id="deletebtn" class="btn btn-primary float-right mb-3 mr-2">刪除</button>
        <button id="exportbtn" class="btn btn-primary float-right mb-3">匯出</button>
    </div>
    <div class="container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">選取</th>
                    <th scope="col">功能</th>
                    <th scope="col">#</th>
                    <th scope="col">區間</th>
                    <th scope="col">寬頻有線(total)</th>
                    <th scope="col">寬頻無線(total)</th>
                    <th scope="col">行動上網(total)</th>
                </tr>
            </thead>
            @if($data==='nodata')
            <tr>
                <td colspan="6" class="text-center">無資料</td>
            </tr>
            @else
            @foreach ($data as $detail)
            <tr>
                <td class="text-center">
                    <input class="form-check-input" type="checkbox" value="{{ $detail['Id'] }}" id="defaultCheck1">
                </td>
                <td><a href="{{ url('/edit',$detail['Id'])}}" class="btn btn-info btn-sm material-icons">create</a></td>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $detail['Period'] }}</td>
                <td>{{ $detail['BCable'] }}</td>
                <td>{{ $detail['BWireless'] }}</td>
                <td>{{ $detail['Mobile'] }}</td>
            </tr>
            @endforeach
            @endif
            <tbody>
            </tbody>
        </table>

    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
    {{-- 選取匯出 --}}
    <script>
        $('#exportbtn').click(function(){
            var perioddata=[];
            $("input[type=checkbox]:checked").each(function () {
                perioddata.push($(this).val());
            });
            if(perioddata.length==0){
                alert('請至少選一筆');
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: '{{ url("/list/exportlist")}}',
                data: { perioddata },
                success: function(response, textStatus, request) {
                    // $data=JSON.parse(re)
                    // console.log(data);
                    // console.log(typeof($data));
                    var a = document.createElement("a");
                    a.href = response.file; 
                    a.download = response.name;
                    document.body.appendChild(a);
                    a.click();
                    a.remove();
                    }
                })
            })
    </script>
    {{-- 選取刪除 --}}
    <script>
        $('#deletebtn').click(function(){
            var deldata=[];
            $("input[type=checkbox]:checked").each(function () {
                deldata.push($(this).val());
            });
            if(deldata.length==0){
                alert('請至少選一筆');
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '{{ url("/list/deletelist")}}',
                data: { deldata },
                success: function(re) {
                    if(re=="ok"){
                        alert('成功');
                    }
                    console.log(re)
                    // $('input[type="checkbox"]').each(function(i, v) {
                        // $(v).prop('checked', false);
                        // });
                        location.reload();
                }
            });
        })
        
    </script>
    {{-- 導向 --}}
    <script>
        $('#createbtn').click(function(){
            window.location = "{{ url('/create')}}"
        })
    </script>
</body>

</html>