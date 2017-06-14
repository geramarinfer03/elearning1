<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div style="width:800px; height:600px; padding:20px; text-align:center; border: 10px solid #787878">
    <div style="width:750px; height:550px; padding:20px; text-align:center; border: 5px solid #787878">
        <span style="font-size:50px; font-weight:bold">Certificado de participación</span>
        <br><br>
        <span style="font-size:25px"><i>Certifica que:</i></span>
        <br><br>
        <span style="font-size:30px"><b>{{$NOMBRE}}</b></span><br/><br/>
        <span style="font-size:25px"><i>Completó el curso:</i></span> <br/><br/>
        <span style="font-size:30px"></span>{{$CURSO}} <br/><br/>
        <span style="font-size:20px">Con la nota de: <b>{{$NOTA}}%</b></span> <br/><br/><br/><br/>
        <span style="font-size:25px"><i>Fecha:</i></span><br>
         
        <span style="font-size:30px">{{$FECHA}}</span>
    </div>
</div>
</body>
</html>