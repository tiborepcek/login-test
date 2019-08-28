<?php
if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
}

session_start();

$userinfo = array(
                'Tibor'=>'tajne'
                );

if(isset($_GET['logout'])) {
    $_SESSION['username'] = '';
    header('Location:  ' . $_SERVER['PHP_SELF']);
}

if(isset($_POST['username'])) {
    if($userinfo[$_POST['username']] == $_POST['password']) {
        $_SESSION['username'] = $_POST['username'];
    }else {
        echo '<p style="color: red">Nesprávne meno a/alebo heslo. Skúste to znova s nižšie uvedenými prihlasovacími údajmi.</p>';
    }
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login test</title>
        <style>
			body {margin: 1em}
        </style>
    </head>
    <body>
		<h1>Skúšobný prihlasovací formulár</h1>
		<p>Tento formulár slúži na prezentovanie automatického vyplnenia prihlasovacích údajov pomocou správcu hesiel. Webový prehliadač nebude vyžadovať uloženie prihlasovacích údajov na neskoršie automatické vyplnenie. Odoslané údaje sú až do odhlásenia uložené iba v relácii PHP a inak sa nikam neodosielajú.</p>
		<ul>
			<li>Meno = Tibor</li>
			<li>Heslo = tajne</li>
		</ul>
        <?php if($_SESSION['username']): ?>
            <p style="color: green">Úspešne ste sa príhlásili ako používateľ <b><?=$_SESSION['username']?></b>. <a href="?logout=1">Odhlásiť sa</a></p>
        <?php endif; ?>
        <form name="login" action="" method="post" autocomplete="off">
            Meno:  <input style="font-size: 20px; width: 90%; margin: 10px 10px 20px 20px; padding: 10px; font-family: courier" type="text" name="username" value="" autocomplete="new-password" readonly 
onfocus="this.removeAttribute('readonly');" required autofocus /><br />
            Heslo:  <input style="font-size: 20px; width: 90%; margin: 10px 10px 20px 20px; padding: 10px; font-family: courier" type="password" name="password" value="" autocomplete="new-password" required readonly 
onfocus="this.removeAttribute('readonly');" /><br />
            <input style="font-weight: bold; font-size: 20px; margin: 10px 0; padding: 10px; height: auto; width: auto; background: #fdfdfd; border: 1px solid #bbb; border-radius: 10px;" type="submit" name="submit" value="Poslať" />
        </form>
    </body>
</html>
