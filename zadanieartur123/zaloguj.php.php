<?php

session_start();

if((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
{
header('Location: index.php');
exit();
}

require_once "connect.php";

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if($polaczenie->connect_errno!=0){
  echo "Error: ".$polaczenie->connect_errno;
}else{

  $user = $_POST['login'];
  $haslo = $_POST['haslo'];

  $sql = "select * from rejestracja where login = '$user' and haslo = '$haslo'";

  If ($rezultat = @$polaczenie->query($sql))
  {
    $ile_userow = $rezultat->num_rows;
    if($ile_userow>0)
    {
      $wiersz = $rezultat->fetch_assoc();
      $_SESSION['zalogowany'] = true;
      $_SESSION['id'] = $wiersz['id'];
      $_SESSION['user'] = $wiersz['login'];

      unset($_SESSION['blad']);
      $rezultat->free_result();
      header('Location: strona.php');

    } else{
      $_SESSION['blad'] ='<span style="color:red">Nieprawidłowy login lub hasło!</span>';
       header('Location: index.php');
    }

  }

  $polaczenie->close();
}

?>