@extends('layout.app')

@section('contents')
    <script src="https://cdn.bootcss.com/echarts/4.1.0-release/echarts.min.js"></script>
    <h1>7天订单统计</h1>
    <hr/>
    @include('layout._errors')
    <div id="main" style="width: 600px;height:400px;"></div>
    <script type="text/javascript">
        var myChart = echarts.init(document.getElementById('main'));

        var option = {
            title: {
                text: '最近三个月订单'
            },
            tooltip: {},
            legend: {
                data:['订单量']
            },
            xAxis: {
                data: {!! json_encode(array_keys($result)) !!}
            },
            yAxis: {},
            series: [{
                name: '订单量',
                type: 'bar',
                data: {!! json_encode(array_values($result)) !!}
            }]
        };
        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>
    @stop