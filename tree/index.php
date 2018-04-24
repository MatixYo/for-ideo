<?php

require_once('Model.php');
require_once('View.php');

function isDescending() {
	return isset($_GET['order']) && $_GET['order'] === 'desc';
}

$model = new Model;

if(isset($_POST['path']) && isset($_POST['add'])) {
	$model->add($_POST['path'], $_POST['add']); 
} elseif(isset($_POST['path']) && isset($_POST['edit'])) {
	$model->edit($_POST['path'], $_POST['edit']);
} elseif(isset($_POST['source']) && isset($_POST['destination'])) {
	$model->move($_POST['source'], $_POST['destination']);
} elseif(isset($_POST['remove'])) {
	$model->remove($_POST['remove']);
}

$view = new View($model->get(isDescending()));

?>

<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>ideo</title>
		<link rel="stylesheet" href="styles.css?<?=rand()?>">
	</head>
	<body>
		<a id="order" href="?order=<?= isDescending() ? 'asc' : 'desc' ?>">Sortowanie: <?= isDescending() ? 'Z-A' : 'A-Z' ?></a><label><input id="show-all" type="checkbox" checked>Pokaż wszystkie</label>
		<form action="" method="post">
			<?= $view->get() ?>
		</form>
		<script src="script.js?<?=rand()?>"></script>
	</body>
</html>
