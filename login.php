<html lang="de">
<head>

<?php
include("head.php");
?>
</head>
<body id="login" data-spy="scroll" data-target="#navbar">

<?php
if(isset($_GET['login'])) {
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];

    $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    $result = $statement->execute(array('email' => $email));
    $user = $statement->fetch();

    $vornameholen = $pdo->prepare('SELECT vorname FROM users WHERE email = :email');
    $vornamegeholt = $vornameholen->execute(array('email' => $email));
    $username = $vornameholen->fetch();

   $_SESSION['username'] =  $username['vorname'];

    //Überprüfung: var_dump($_SESSION);

    //Überprüfung des Passworts
    if ($user !== false && password_verify($passwort, $user['passwort'])) {
        $_SESSION['userid'] = $user['user_id'];
        header('Location: dashboard.php');
        //Alternative: die('Login erfolgreich. Weiter zu <a href="dashboard.php">internem Bereich</a>');

    } else {
        $errorMessage = "E-Mail oder Passwort war ungültig<br>";
    }

}

            if(isset($errorMessage)) {
                echo $errorMessage;
            }


include("header.php");
?>

<div class="jumbotron" id="jumbotron">
    <div class="container">
        <h1>FrogDrops</h1>
        <p>Leiche deine Daten bei uns ab!</p>
        <hr>

        <p>Möchtest Du mehr über die FrogDrops erfahren? Dann trage Dich doch in unsere Mailingliste ein.</p>

        <form class="form-inline">
            <div class="input-group">
                <span class="input-group-addon">@</span>
                <input type="email" class="form-control" placeholder="Deine Emailadresse" aria-label="Summe (gerundet zum nächsten ganzen Euro)">
            </div>
            <button class="btn btn-primary">Eintragen</button>


        </form>
    </div>
</div>

<div class="container" id="mehrInfo">

    <div class="row" id="zusammenfassung">

        <h1>Darum ist diese App so toll!</h1>
        <p class="lead">Zusammenfassung der tollen Features!</p>
    </div>

</div>






            <?php

            include("footer.php");
            ?>


</body>
</html>