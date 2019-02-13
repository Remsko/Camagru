<?php
echo "<a href='create.php'> <span class='btn'>>Inscription</span></a><br /> <br />";
if (isset($_POST['login']) && isset($_POST['passwd']) && isset($_POST['submit']) && $_POST['submit'] === "OK")
{
	$_SESSION['loged'] = auth($_POST['login'], $_POST['passwd'], $bdd);
	if(isset($_SESSION['loged']))
		header("Location: ../index.php");
}
if (isset($_POST['submit']))
	echo "Login Error <br />";
echo "<html><body>";
echo "<div class='con additem'>";
echo '<form method="post" action=login.php >';
echo "Prénom: <input type='text' name='login' value=''/>";
echo "<br />";
echo "Mot de passe: <input type='password' name='passwd' value=''/>";
echo "<br />";
echo "<input type='submit' name='submit' value='OK'>";
echo "<br \>";
echo "</form>";
echo "</html></body>";
?>