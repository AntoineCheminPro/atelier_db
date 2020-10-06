<?php 
session_start();
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header("Location: login.php");
}

// connect to database
try{
    $db = new PDO('mysql:host=localhost;dbname=banque_php', 'BanquePHP', 'banque76');

} catch (PDOException $e){
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

if (!empty($_POST) && isset($_POST["new_account"])){
    //ATTENTION : ici on part du principe que les données ont été vérifiées sinon requete préparée
// preparation de la requête
    $query = $db ->prepare(
        "INSERT INTO Account(amount, opening_date, account_type, user_id)
        VALUES (:amount,  NOW(), :account_type, 1)"
    );
    // execution de la requête avec les valeurs
    $result = $query->execute([
        "amount" => $_POST["amount"],
        "account_type" => $_POST["account_type"]
        ]);
}
// send the query to mysql
$query = $db -> query("SELECT * FROM Account");
// Extract data from query as an associative array (fetch quand 1 seul, renvoi un tableau associatif et non pas un tableau dans un tableau)
$accounts = $query -> fetchAll(PDO::FETCH_ASSOC);


?>

<h1> Ma premiére base de données</h1>

<form action="" method="post">
<div>
    <p>montant</p>
    <input type="number" name="amount">
</div>
<div>
    <p>type de compte</p>
    <select name="account_type">
    <option value="compte courant">Compte courant</option>
    <option value="livret A">Livret A</option>
</div>
<div>
    <input type="submit" name="new_account" valeur="envoyer">
</div>
</form>



<h2>Les comptes</h2>

<?php 
foreach ($accounts as $key => $account) {
    echo "<p>" . $account["account_type"] . " : " . $account["amount"] . "</p>";
}
?>