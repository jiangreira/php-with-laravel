<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charts</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
    <style>
        body {
            height: 100%;
            font-family: 'Noto Sans TC', sans-serif;
        }

        span {
            color: teal;
            font-size: 1rem;
        }
    </style>
</head>

<body>
    <div class="container-fulid">
        @include('layout/nav')
    </div>
    <div class="container mt-3">
        <h4 class="mt-3 mb-3">圖表</h4>
    </div>
    <div class="chart container">
        <table class="table">
            <tr>
                <th><span>圖表一</span></th>
                <th>
                    <div id="choose1">
                    </div>
                </th>
                <th><button id='choose1btn' class="btn btn-primary">更新/產生</button></th>
            </tr>
        </table>
        <div class="chart-container" style="position: relative; height:40vh; width:40vw">
            <canvas id="myChart1" width="400" height="400"></canvas>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
    {{-- 顯示近三期資料，如要多增加sql Limit要改 --}}
    <script>
        $.ajax({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        url: '{{ url("/chooseperiod")}}',
        success: function(re) {
            var data=JSON.parse(re);
            var print="";
            for(i=0;i<data.length;i++){
                print+=`
                    <input class="choose1 mr-1" name="choose1[]" type="checkbox" id="${data[i].iddetail}" value="${data[i].iddetail}">${data[i].Period}
                `;
            }
            $('#choose1').html(print);
        }
    })
    </script>
    {{-- 圖表一根據異動透過ajax產生圖表 --}}
    <script>
        var choose1data;
        var Labels=['BCable','BWireless','B_ADSL','B_Cable_Modem','Mobile'];
        var Period=new Array();
        var BCable=new Array();
        var BWireless=new Array();
        var BADSL=new Array();
        var B_Cable_Modem=new Array();
        var Mobile=new Array();
        var print=new Array();
        var chart1= document.getElementById("myChart1").getContext("2d");
        $('#choose1btn').click(function(e){
            var perioddata=[];
            var num;
            e.preventDefault();
            $("input[type=checkbox]:checked").each(function () {
                perioddata.push($(this).val());
            });
            if(perioddata.length===1){
                num=0;
            }else {
                num=1;
            }
            perioddata=perioddata.toString();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "get",
                url: '{{ url("/chart1period")}}',
                data: { perioddata ,num},
                success: function(re) {
                    choose1data=JSON.parse(re);
                    choose1data.forEach(function(data){
                        Period.push(data.Period);
                        BCable.push(data.BCable);
                        BWireless.push(data.BWireless);
                        BADSL.push(data.B_ADSL);
                        B_Cable_Modem.push(data.B_Cable_Modem);
                        Mobile.push(data.Mobile);
                    });
                    for(i=0;i<choose1data.length;i++){
                        print.push({
                            label:`${Period[i]}`,
                            datasets:{
                                lebel:`${Period[i]}`,
                                data:[`${BCable[i]}`,`${BWireless[i]}`,`${BADSL[i]}`,`${B_Cable_Modem[i]}`,`${Mobile[i]}`],
                                borderColor: [
                                    'rgba(54, 162, 235, 1)'
                                    ],
                                borderWidth:1
                            }
                        })
                    }
                    console.log(print);               
                    var newdata={
                        labels:Labels,
                        datasets:print
                    }
                    var myRadarChart = new Chart(chart1,{
                        type:'bar',
                        data:newdata
                    })




                    // var myRadarChart = new Chart(chart1, {
                    //     type: 'bar',
                    //     data: {
                    //         labels:Labels,
                    //         datasets: print,
                    //     },
                    //     options: {
                    //         responsive: true,
                    //         scales: {
                    //             yAxes: [{
                    //                 ticks: {
                    //                     beginAtZero: true
                    //                     }
                    //                 }]
                    //             },
                    //         legend: {
					//             position: 'top',
                    //             },
                    //         title: {
					//             display: true,
					//             text: 'Chart.js Radar Chart'
				    //             }
                    //         }
                    //     });
                    //     console.log(myRadarChart.data);
                    // }
                }
            })
        })
                    
    </script>
    {{-- 圖表一 --}}
    {{-- <script>
       
        var myRadarChart = new Chart(chart1, {
            type: 'line',
            data: {
                labels: ['BCable', 'BWireless', 'Mobile'],
                datasets: [{
                    label: '108/02',
                    data: [5709385, 27636603, 27465300],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                },
                {
                    label: '108/01',
                    data: [5702740, 27559885, 27399749],
                    borderColor: [
                        'rgba(255, 193, 7, 1)',
                    ],
                    borderWidth: 1
                }            
            ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                legend: {
					position: 'top',
                },
                title: {
					display: true,
					text: 'Chart.js Radar Chart'
				}
            }
        });
    </script> --}}
</body>

</html>