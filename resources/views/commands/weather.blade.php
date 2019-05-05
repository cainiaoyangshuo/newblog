<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/index/bootstrap.min.css">
</head>

<body>

@foreach($res as $r)


    <tr>
        <th>
            {{ $r['date'] }} <span></span> ({{ $r['week'] }})
        </th>
    </tr>
    <tr>
        <td>
            白天：<br>
            {{ $r['daytemp'] }}°
            {{ $r['dayweather'] }}
        </td>
    </tr>

@endforeach
</body>
</html>