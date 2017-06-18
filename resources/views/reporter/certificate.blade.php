<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div style="height:800px; padding:20px; text-align:center; border: 10px solid #1976D2">
    <div style="height:750px; padding:20px; text-align:center; border: 5px solid #1976D2">
        <div>
            <img src="./img/logo.png" style= "width: 100px; height: 100px; position: absolute; left: 40"alt="">
            <span style="font-size: 40px; position: absolute; right: 40">E-Learning</span>
        </div>
        <div style="position: absolute; top: 80; text-align: center;  width: 100%;">
            <span style="font-size:42px; font-weight:bold">Certificado de {{$MODALIDAD}}</span>
            <br><br>
            <span style="font-size:25px"><i>Certifica que:</i></span>
            <br><br>
            <span style="font-size:30px"><b>{{$NOMBRE}}</b></span><br/><br/>
            <span style="font-size:25px"><i>Completó el curso:</i></span> <br/><br/>
            <span style="font-size:30px"></span>{{$CURSO}} <br/><br/>
            <span style="font-size:20px">Con la nota de: <b>{{$NOTA}}%</b></span> <br/><br/><br/><br/>
            <span style="font-size:25px"><i>Fecha:</i></span><br/>
            <span style="font-size:30px">{{$FECHA}}</span><br/><br/>
            <span style="font-size:25px"><i>Duracion:</i></span><br/>
            <span style="font-size:30px">{{$DURACION}} semanas</span><br/><br/><br/><br/><br/>

            <span style="font-size:30px">Firma: </span>

            <span style="font-size:30px">__________________________</span>
        </div>
    </div>
</div>
</body>
</html>