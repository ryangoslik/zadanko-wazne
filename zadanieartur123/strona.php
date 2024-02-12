<?php 
session_start(); 

if(!isset($_SESSION['zalogowany']))
{
    header('location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona</title>
</head>
<body>

<?php 

echo "<p> Witaj użytkowniku ".$_SESSION['user'].'![<a href="logout.php">Wyloguj się!</a>]</p>';

?>

</body>
</html>