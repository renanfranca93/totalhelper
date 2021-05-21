<?php

if(isset($_GET['err'])){
	$message='Usuário e/ou senha incorretos!';

}else{
	$message='';
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link rel="stylesheet" href="assets/css/login_style.css">
		<link rel="shortcut icon" href="assets/images/icon.png" />
    	<link rel="icon" href="assets/images/favicon.ico" />
	</head>
	<body>
		<div class="login">
			
			<h1> <img src="./assets/images/sisae_logo.png" width="120px"></h1>
			<div id="messageArea">
				<p class="letraMiuda"><?php echo $message ?></p>
			</div>
			<form action="services/authenticate.php" method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="submit" value="Entrar">
			</form>
		</div>
	</body>
</html>