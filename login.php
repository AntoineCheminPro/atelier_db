<?php 
// if a login form is submitted
if (!empty ($_POST) && isset($_POST["login"])) {
var_dump($_POST);
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