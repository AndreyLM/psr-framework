<header class="app-header">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">
                    Application
                </a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <?php $this->start('menu') ?>
                        <li><a href="/about"><i class="glyphicon glyphicon-book"></i> About</a></li>
                        <li><a href="/cabinet"><i class="glyphicon glyphicon-user"></i> Cabinet</a></li>
                    <?php $this->stop() ?>
                    <?= $this->section('menu'); ?>
                </ul>
            </div>
        </div>
    </nav>
</header>