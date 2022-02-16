<!doctype html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Логин</title>
	<link rel="stylesheet" href="src/bootstrap.min.css">
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-md-8 m-auto">

			<ul class="list-unstyled">
				<li><a href="/register">Регистрация</a></li>
			</ul>

			<h1>Логин</h1>

			<form action="/login" method="POST">
				<div class="mb-3">
					<label for="email" class="form-label">Логин</label>
					<input type="text" name="email" id="email" class="form-control">
				</div>

				<div class="mb-3">
					<label for="password" class="form-label">Пароль</label>
					<input type="password" name="password" id="password" class="form-control">
				</div>
				
				<div>
					<input type="submit" class="btn btn-primary btn-sm mt-2" value="Войти">
				</div>
			</form>

		</div>
	</div>
</div>

</body>
</html>