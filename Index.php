# Arquivos-de-Registro
Sistema de registro em php
<?php
	include("psdc.php");
	include("class.php");

	$err = 0;

	if (isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['nick'])){
    	$conn = new Connection("12.0.0.1", "test", "root", "12345", 1337, 1);
    	//Aqui vc troca pelas configurações do seu servidor (ip, DB, user, senha, porta e tipo)
    	//Para mais informações ler o arquivo psdc.php
    	
    	$db = $conn->connect();

		$registro = new GC($_POST['user'], $_POST['pass'], $_POST['nick']);

		if($registro->register($db) > 0){
			$err = "Nickname ja registrado!";
		}
		else{
			$err = "Registrado com sucesso!";
		}
	}
{
?>

<html>
<body>
    <form method="post">
        Login
        <input type="text" name="user"><br>
        Senha
        <input type="password" name="pass"><br>
        Nick
		<input type="text" name="nick"><br>
        <input type="submit"><br>
        <?php 
        	if($err != 0){
        		echo $err;
        	}
        ?>
    </form>
</body>
</html>
