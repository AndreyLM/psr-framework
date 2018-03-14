<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?= isset($title) ? $this->e($title) : 'Psr' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
    <style>
        body { padding-top: 70px; }
        .app { display: flex; min-height: 100vh; flex-direction: column; }
        .app-content { flex: 1; }
        .app-footer { padding-bottom: 1em; }
    </style>
</head>
<body class="app">

<?= $this->insert('partials/header') ?>

<div class="app-content">
    <main class="container">

        <?=$this->section('content')?>

    </main>
</div>

<?= $this->insert('partials/footer') ?>

<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
