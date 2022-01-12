<canvas id="myCanvas" width="360" height="240" style="border-width: 4px; border-style: inset;border-color:#f00;background:#eee;">
</canvas>

<script>
var canvas = document.getElementById('myCanvas');
var ctx = canvas.getContext('2d');

ctx.fillStyle   = '#0000ff'; // color de relleno azul
ctx.strokeStyle = '#ff0000'; // color de borde rojo
ctx.lineWidth   = 4;       // grosor de línea

// Rectangulo con relleno
ctx.fillRect(0, 0, 150, 50);


// Rectangulo sin relleno
ctx.strokeRect(160,  5, 150, 50);


// Estrella
ctx.beginPath();
ctx.moveTo(26,60);

ctx.lineTo(78,60);
ctx.lineTo(96,108);
ctx.lineTo(150,108);
ctx.lineTo(108,138);
ctx.lineTo(126,186);

ctx.lineTo(78,156);
ctx.lineTo(30,186);
ctx.lineTo(48,138);
ctx.lineTo(0,108);
ctx.lineTo(60,108);

ctx.lineTo(78,60);
ctx.closePath();
ctx.fillStyle='#ff0' //color de la estrella
ctx.fill();


//HOMBRECITO
//cabeza 
ctx.beginPath();
ctx.arc(250, 85, 25, 0 , 2* Math.PI, false);
ctx.stroke();

//tronco del cuerpo
ctx.beginPath();
ctx.moveTo(250,110);
ctx.lineTo(250,110);
ctx.lineTo(250,170);
ctx.stroke();

//piernas
ctx.beginPath();
ctx.moveTo(210,200);
ctx.lineTo(210,200);
ctx.lineTo(250,170);
ctx.lineTo(290,200);
ctx.stroke();

//brazos
ctx.beginPath();
ctx.moveTo(225,110);
ctx.lineTo(225,110);
ctx.lineTo(250,130);
ctx.lineTo(275,110);
ctx.stroke();


</script>