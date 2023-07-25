<?php
    // CONNECTION
$server = "localhost";
$user = "root";
$pass = "";
$name = "permessi";

$connectionDB = new MySQLI($server, $user, $pass, $name)

if($connectionDB->connect_error)
{
    die("connessione Fallita, " . $connectionDB->connect_error);
}

$usernameLOGIN = mysqli_real_escape_string($connessioneDB, $_POST['username']);

    // DECLARED STRING
$string = " SELECT users.hashpw, users.saltpw
            FROM users
            WHERE users.username = $usernameLOGIN"

    // EXECUTE STRING
    $result = $connessioneDB->query($query);

    $passwordLOGIN = mysqli_real_escape_string($connessioneDB, $_POST['password']);

    if ($result->num_rows == 1) 
    {
        $row = $result->fetch_assoc();
        $hashPW = $row['hashPW'];
        $saltPW = $row['saltPW'];
    
        // PASSWORD VERIFY

        if (password_verify($passwordLOGIN . $saltPW, $hashPW)) 
        {
            echo "La password è corretta!";
            session_start();
            $_SESSION["user"] = $_POST["username"];
            $_SESSION["pasw"] = $hashPW;
            header('Location: C:\Users\4ser\Desktop\Site');
        } 
        else 
        {
            echo "La password è errata, Riprovare";
        }
    } 
    else 
    {
        echo "Utente non trovato!";
    }


    // CLOSE CONNECTION
        mysqli_close($connessioneDB);


?>