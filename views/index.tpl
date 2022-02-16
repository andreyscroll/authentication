<!doctype html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Личный кабинет</title>
	<link rel="stylesheet" href="src/bootstrap.min.css">
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-md-8 m-auto">

			<h1>Личный кабинет</h1>

			<p class="text-success">Добро пожаловать, <?php echo $name = $data['name'] ?: 'Noname'; ?></p>

			<p><i>E-Mail</i>: <?= $data['email'] ?></p>

			<form action="/setting/name" method="POST">
				<div class="mb-3">
					<label for="name" class="form-label">Изменить имя</label>
					<input type="text" name="name" id="name" class="form-control" value="<?= $data['name'] ?>">
					<input type="submit" class="btn btn-primary btn-sm mt-2" value="Сохранить">
				</div>
			</form>

			<p><a href="/logout" class="btn btn-danger btn-sm">Выйти</a></p>

		</div>
	</div>
</div>

</body>
</html>