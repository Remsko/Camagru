<html><body>
<div class='con additem'>
<form method="POST" action=create.php >
Prénom: <input type='text' name='firstname' value=''/>
<br />
Nom: <input type='text' name='lastname' value=''/>
<br />
Adresse mail: <input type='text' name='mail' value=''/>
<br />
Mot de passe: <input type='password' name='passwd' value=''/>
<br />
<input type='submit' name='submit' value="OK">
<br /> 
</form>
</div>
</body>
</html>
<?PHP
session_start();
function auth($login, $passwd, $bdd)
{
	$req = "SELECT id, passwd FROM Users WHERE firstname = '" . mysqli_real_escape_string($bdd, $login) . "'";
	$result = mysqli_query($bdd, $req);
	while ($tmp = mysqli_fetch_assoc($result)) {
		if ($tmp['passwd'] === hash("whirlpool", $passwd))
		{
			$_SESSION['firstname'] = $login;
			$_SESSION['userid'] = $tmp['id'];
			mysqli_free_result($result);
			$sql = "SELECT id FROM Admin WHERE Users_id='" . $_SESSION['userid'] . "'";
			$result2 = mysqli_query($bdd, $sql);
			while ($tmp = mysqli_fetch_assoc($result2)) {
				$_SESSION['admin'] = true;
			}
			mysqli_free_result($result);
			return (true);
		}
	}
	mysqli_free_result($result);
	return (false);
}
?>