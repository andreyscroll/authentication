<!doctype html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Регистрация</title>
	<link rel="stylesheet" href="src/bootstrap.min.css">
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-md-8 m-auto">

			<ul class="list-unstyled">
				<li><a href="/login">Логин</a></li>
			</ul>

			<h1>Регистрация</h1>

			<p>* - обязательные для заполнения поля!</p>

			<form action="/register" method="POST">
				<div class="mb-3">
					<label for="name" class="form-label">Имя</label>
					<input type="text" name="name" id="name" class="form-control">
				</div>
				
				<div class="mb-3">
					<label for="email" class="form-label">E-Mail*</label>
					<input type="text" name="email" id="email" class="form-control">
				</div>

				<div class="mb-3">
					<label for="password" class="form-label">Пароль*</label>
					<input type="password" name="password" id="password" class="form-control">
				</div>

				<div class="mb-3">
					<label for="repeat_password" class="form-label">Повторите пароль*</label>
					<input type="password" name="repeat_password" id="repeat_password" class="form-control">
				</div>

				<div>
					<input type="submit" class="btn btn-primary btn-sm mt-2" value="Регистрация">
				</div>
			</form>

		</div>
	</div>
</div>

</body>
</html>