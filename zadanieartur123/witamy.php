<?php 
session_start();
if (isset($_SESSION['udanarejestracja'])) 
{
header('Location: index.php');
exit();
}else{
    unset($_SESSION['udanarejestracja']);
}
?>


<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fajna stronka</title>
</head>
<body>
    Dziękujemy za rejestrację!
    <p>Formularz logowania oraz rejestracji</p>
    <a href ="index.php">Zaloguj się na swoje konto!</a>
    <br><br>


<?php 
if(isset($_SESSION['blad'])) echo $_SESSION['blad'];
?>

</body>
</html>