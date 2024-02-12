<?php 
session_start();
if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
{
header('Location: strona.php');
exit();
}
?>


<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fajna stronka</title>
</head>
<body>
    <p>Formularz logowania oraz rejestracji</p>
    <a href ="rejestracja.php">Rejestracja - załóż darmowe konto klikając tutaj!</a>
    <br><br>
<form action="zaloguj.php.php" method="post">
    Login: <br> <input type="text" name ="login"> <br>
    Hasło: <br> <input type="password" name ="haslo"> <br> <br>
    <input type="submit" value="Zaloguj się">
</form>

<?php 
if(isset($_SESSION['blad'])) echo $_SESSION['blad'];
?>

</body>
</html>