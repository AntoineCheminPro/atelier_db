<?php 
// if a login form is submitted
if (!empty ($_POST) && isset($_POST["login"])) {
    // connect to database
    try{
        $db = new PDO('mysql:host=localhost;dbname=banque_php', 'BanquePHP', 'banque76');
    
    } catch (PDOException $e){
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
    // never trust user input -> preparer la requête
    $query = $db->prepare(
        "SELECT * FROM User
        WHERE email = :email"
    );
    $query->execute([
        "email" => $_POST['email']

    ]);
    $user = $query ->fetch (PDO::FETCH_ASSOC);
    if ($user) {
        // if an user has been found
        if(password_verify($_POST['password'], $user['password'])){
            //if pasword match
            session_start();
            $_SESSION['user']=$user;
            header("Location: index.php");
        }
    }

}
?>

<h1> Vous connecter</h1>

<form action="" method="post">
    <div>
        <input type="email" name="email" value="">
    </div>
    <div>
        <input type="password" name="password" value="">
    </div>
    <div>
        <input type="submit" name="login" value="se connecter">
    </div>
</form>