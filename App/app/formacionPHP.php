<?php


// Declaración de variables
// Variables tipo number
$a = 10;
$b = 2;

// variables tipo string
$text1 = "Hola";
$text2 = 'Igor';

$totalSuma = $a + $b;
$totalResta = $a - $b;
$totalMult = $a * $b;
$totalDiv = $a / $b;

$saludo1 = "$text1 $text2";
$saludo2 = $text1.' '.$text2;

echo "Concatenación con comilla simple y punto: ".$text1.' '.$text2.'<br>';

echo "Concatenación con comilla doble: "."$text1 $text2"."<br>";

echo "La suma de a + b = ".$totalSuma."<br>";
echo "La resta de a - b = ".$totalResta."<br>";
echo "La multiplicación de a x b = ".$totalMult."<br>";
echo "La división de a / b = ".$totalDiv."<br>";

// variable de tipo boolean
$interruptor = true;

// Condiciones en PHP
if($interruptor == true){
    // Si interruptor es true, este código se ejecuta
    echo "interruptor es true"."<br>";
}else{
    echo "interruptor no es true"."<br>";
}

// $variableDuda = "Existo?";
if(isset($variableDuda)==true){
    echo "Existe". "<br>";
}else{
    echo "No Existe<br>";
}

$fecha = date("d-m-Y");
echo "Hoy es ".$fecha."<br>";

date_default_timezone_set('Europe/Madrid');
$hora = date("H:m:s");
echo "Son las ".$hora."<br>";

$fechaHora = date("H:m:s d-m-Y");
echo $fechaHora ."<br>";

// Coger la IP del usuario que se conecta
$ipUsuario = $_SERVER['REMOTE_ADDR'];
echo $ipUsuario.'<br>';

// Coger la URL por la que el usuario está
$url = $_SERVER['PHP_SELF'];
echo "El usuario viene de: ".$url.'<br>';

// Entender comillas anidadas dentro de comillas
echo "<a href='#' title='Mi Title'>Soy un enlace, bienvenido $saludo2</a>" .'<br>';

// Entender comillas anidadas dentro de comillas (al revés)
echo '<a href="#" title="Mi Title">Soy un enlace, bienvenido '.$saludo2.'</a>' .'<br>';




?>