<?php

/*
 * Get Uri path
 *
 */
function getUri()
{
	$uri = trim($_SERVER['REQUEST_URI'], '/');
	
	return rawurldecode($uri);
}

/*
 * Check auth
 *
 */
function isAuth()
{
	return (bool) isset($_SESSION['user']);
}

/*
* Get user data
*
*/
function getUserData(int $id, $db)
{
	$stmt = $db->prepare('SELECT * FROM users WHERE id = :id');
	$stmt->execute([':id' => $id]);
	return $stmt->fetch();
}

/*
 * Login
 *
 */
function login($db)
{
	$stmt = $db->prepare('SELECT * FROM users WHERE `email` = :email');
	$stmt->execute([':email' => $_POST['email']]);
	
	if($user = $stmt->fetch())
	{
		if( password_verify($_POST['password'], $user['password']) )
		{
			$_SESSION['msg'][] = 'Вы успешно авторизованы!';
			$_SESSION['user'] = $user;
			return true;
		} else {
			$_SESSION['msg'][] = 'Пароль не верный!';
			redirect('login');
		}
	} else {
		$_SESSION['msg'][] = 'Такого пользователя не существует!';
		redirect('login');
	}

	//dd($user);
}

/*
 * Register
 *
 */
function verifyRegisterData()
{
	
	$name = clearInput($_POST['name']);
	$email = clearInput($_POST['email']);
	$password = clearInput($_POST['password']);
	$repeatPassword = clearInput($_POST['repeat_password']);

	if(empty($email)){
		$_SESSION['msg'][] = 'Поле с E-Mail не может быть пустым!';
	}
	if(empty($password)) {
		$_SESSION['msg'][] = 'Заполните поле с паролем!';
	}
	if(empty($repeatPassword)) {
		$_SESSION['msg'][] = 'Напишите повторный пароль!';
	}
	if($password !== $repeatPassword){
		$_SESSION['msg'][] = 'Пароли не совпадают!';
	}
	if(isset($_SESSION['msg'])){
		return false;
	}

	return true;
}

function register($db)
{
	// Проверим, есть ли в базе такой email
	$stmt = $db->prepare('SELECT email FROM users WHERE `email` = :email');
	$stmt->execute([':email' => $_POST['email']]);
	$email = $stmt->fetch(PDO::FETCH_ASSOC);

	// если есть, выкинем ошибку
	if($email){
		$_SESSION['msg'][] = 'Такой E-Mail уже зарегистрирован!';
		return false;
	}

	// если есть, продолжим регистрацию
	$stmt = $db->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
	$result = $stmt->execute([
			':name' => $_POST['name'],
			':email' => $_POST['email'],
			':password' => password_hash($_POST['password'], PASSWORD_BCRYPT)
		]);
	return $result;
}

/*
* Logout
*
*/
function logout()
{
	session_destroy();
	redirect('login');
}

/*
* Change name
*
*/
function changeName($db)
{
	$stmt = $db->prepare('UPDATE users SET `name` = :name WHERE `id` = :id');
	return $stmt->execute([
		':name' => $_POST['name'],
		':id' => $_SESSION['user']['id'],
	]);
}

/*
* Dump & die
*
*/
function dd($arr)
{
	echo "<pre>";
	var_dump($arr);
    echo "</pre>";
    exit();
}

/*
 * Redirect
 *
 */
function redirect(string $path)
{
	if($path === 'home')
	{
		$path = '/';
	}

	return header("Location: {$path}");
	exit();
}

/*
* Show info message
*
*/
function showMessage()
{
	if(isset($_SESSION['msg']))
	{
		$msg = $_SESSION['msg'];
		unset($_SESSION['msg']);

		foreach($msg as $item){
			echo "<div class='alert alert-secondary mb-3'>{$item}</div>";
		}
	}
}

function clearInput(string $data)
{
	$data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}