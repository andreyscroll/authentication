<?php

session_start();

require_once 'functions.php';

// Show info message
showMessage();

$uri = getUri();
$httpMethod = $_SERVER['REQUEST_METHOD'];
$db = new PDO('sqlite:database/data.db');

switch ($uri)
{
	// Home page
	case '':

		if(isAuth())
		{
			$data = getUserData($_SESSION['user']['id'], $db);
			require_once 'views/index.tpl';
		} else {
			redirect('login');
		}
		
	break;
	
	// Login
	case 'login':
		
		if($httpMethod == 'POST')
		{			
			if(login($db))
			{
				redirect('home');
			}
		}

		require_once 'views/login.tpl';

	break;
	
	// Register
	case 'register':
		
		if($httpMethod == 'POST')
		{		
			if(!verifyRegisterData())
			{
				redirect('register');
			} 
			elseif(register($db))
			{
				$_SESSION['msg'][] = 'Регистрация прошла успешно! Авторизуйтесь.';
				redirect('login');
			} else {
				redirect('register');
			}
		}

		require_once 'views/register.tpl';

	break;

	// Logout
	case 'logout':
		logout();
	break;

	// Change name
	case 'setting/name':
		if($httpMethod == 'POST')
		{
			if(changeName($db)){
				$_SESSION['msg'][] = 'Имя успешно изменено!';
				redirect('home');
			}
		}
	break;
	
	default:
		echo '404 not found';
}
