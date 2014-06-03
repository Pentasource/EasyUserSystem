<?php

require_once 'inc/LoginSystem.class.php';

$isLoggedIn = LoginSystem::isLoggedIn();

?>
<!DOCTYPE html>
<html>
<head>

</head>
<body>
<?php
if ($isLoggedIn) {
    /** @var User $user */
    $user = $_SESSION['user'];
    echo <<<HTML

<h1>Willkommen, {$user->getUserName()}</h1>

HTML;

} else {
    echo <<<HTML

<h1>Willkommen!</h1>

<form action="login.php" method="post">
<h2>Login</h2>
<input type="text" name="username" placeholder="username">
<input type="password" name="password" placeholder="password">
<input type="submit">
</form>


<form action="register.php" method="post">
<h2>Registrieren</h2>
<input type="text" name="username" placeholder="username">
<input type="email" name="email" placeholder="email">
<input type="password" name="password" placeholder="password">
<input type="submit">
</form>

HTML;

}
?>
</body>
</html>