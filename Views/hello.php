<?php $this->layout('layouts/main', [
        'title' => $title
]) ?>

<?php $this->start('menu') ?>
    <li><a href="/about"><i class="glyphicon glyphicon-book"></i> About2</a></li>
    <li><a href="/cabinet"><i class="glyphicon glyphicon-user"></i> Cabinet2</a></li>
<?php $this->stop() ?>

<div class="jumbotron">
    <h2><?=$this->e($title)?></h2>
    <p>
        Congratulations! You have successfully created your application.
    </p>
</div>
