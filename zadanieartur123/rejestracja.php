<?php 
session_start();

if(isset($_POST['login1']))
{
   $wszytsko_OK=true;

   $login1 = $_POST['login1'];

   if (strlen($login1)<5)
   {
    
   }
   if(ctype_alnum($login1)==false)
   {
    $wszytsko_OK=false;
    $_SESSION['e_login1']="Login może składac się z literi cyfr";
   }
   $haslo1 = $_POST['haslo1'];
   $haslo2 = $_POST['haslo2'];

   if ((strlen($haslo1)<5) || (strlen($haslo1)>20))
   {
   
    $_SESSION['e_haslo']="Hasło ma zaweirać od 5 do 20 znaków!";
   }
   if($haslo1!=$haslo2)
   { 
    $wszytsko_OK=false;
    $_SESSION['e_haslo']="Hasła nie są identyczne!";
   }
    if (!isset($_POST['regulamin']))
    {
    $wszytsko_OK=false;
    $_SESSION['e_regulamin']="Potwierdź regulamin!";
    }
  require_once "connect.php";

try{
     $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
     if($polaczenie->connect_errno!=0){
        throw new Exception(mysqli_connect_errno());
      }
      else{
        $rezultat = $polaczenie->query("SELECT id FROM rejestracja where login='$login1'");
        if (!$rezultat) throw new Exeception($polaczenie->error);
         
        $ile_takich_loginow = $rezultat->num_rows;
        if($ile_takich_loginow>0)
        {
          $wszytsko_OK=false;
          $_SESSION['e_login1']="Istnieje już takie konto z takim loginem!";
        }
        if($wszytsko_OK==true)
        {
            if($polaczenie->query("insert into rejestracja values (NULL,'$login1', '$haslo1')"))
            {
                $_SESSION['udanarejestracja']=true;
                header('Location: witamy.php');
            }
            else
            {
                throw new Exeception($polaczenie->error);
            }
        }

        $polaczenie->close();
      }

  }
  catch(Exception $e)
  {
    echo '<span style="color:red;">Błąd serwera</span>';
    echo '<br> Szczegółowe informacje: '.$e;
  }


   if($wszytsko_OK==true)
   {
   echo "Udana walidacja";
   exit();
   }
}

?>


<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Darmowa rejestracja</title>
    <style>
        .error{
            color:red;
            margin-top:10px;
            margin-bottom:10px;
        }
     </style>
</head>
<body>
    <form method="post">
          Login: <br> <input type="text" name="login1"> <br>
          <?php 
          if(isset($_SESSION['e_login1']))
          {
            echo'<div class="error">'.$_SESSION['e_login1'].'</div>';
            unset($_SESSION['e_login1']);
          }
          
          ?>
          Hasło: <br> <input type="password" name="haslo1"> <br>
          <?php 
          if(isset($_SESSION['e_haslo']))
          {
            echo'<div class="error">'.$_SESSION['e_haslo'].'</div>';
            unset($_SESSION['e_haslo']);
          }
          ?>
          Powtórz hasło: <br> <input type="password" name="haslo2"> <br>
          <label>
          <input type="checkbox" name="regulamin"> Akceptuję regulamin
          </label>
          <?php 
          if(isset($_SESSION['e_regulamin']))
          {
            echo'<div class="error">'.$_SESSION['e_regulamin'].'</div>';
            unset($_SESSION['e_regulamin']);
          }
          ?> <br><br>
          <input type="submit" value="Zajerestruj się">
    </form>
</body>
</html>