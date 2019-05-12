<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/index/bootstrap.min.css">
</head>
<style>
    p{
        text-align: center;
        /*border-right:grey 2px solid;*/
    }
</style>
<body>

{{--<table>--}}
{{--@foreach($res as $r)--}}
{{--<tr>--}}
    {{--<th>--}}
        {{----}}
    {{--</th>--}}
{{--</tr>--}}
    {{--<tr>--}}
        {{----}}
        {{--<td>--}}
            {{--<span>{{ $r['date'] }}  ({{ $r['week'] }}) </span>--}}
        {{--</td>--}}
        {{--<td>--}}
            {{--{{ $r['daytemp'] }}°/{{ $r['nighttemp'] }}--}}
        {{--</td>--}}
        {{--<td>--}}
            {{--{{ $r['dayweather'] }}--}}
        {{--</td>--}}
    {{--</tr>--}}
{{--@endforeach--}}
{{--</table>--}}

@foreach($res as $r)
<div style="display: inline-block;">

    <p>{{ $r['date'] }} <span @if($r['week'] == '今天') style="color: darkorange" @endif> ({{ $r['week'] }}) </span><p/>
    <p>
        <span @if($r['daytemp'] > 24) style="color: orangered" @elseif($r['daytemp'] < 15) style="color: orangered" @endif>{{ $r['daytemp'] }}°</span>/{{ $r['nighttemp'] }}°
    </p>
    <p>
        <span @if(strpos($r['dayweather'], '雨') != false)  style="color: cornflowerblue" @endif>{{ $r['dayweather'] }}</span>/<span @if(strpos($r['nightweather'], '雨') != false)  style="color: cornflowerblue" @endif>{{ $r['nightweather'] }} </span>
    </p>
    <p>{{ $r['daywind'] }}/{{ $r['nightwind'] }}</p>
    <p>{{ $r['daypower'] }}/{{ $r['nightpower'] }}</p>
</div>
@endforeach
</body>
</html>