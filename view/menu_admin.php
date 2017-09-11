<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= $base_url ?>admin.php">madeira<b>madeira</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown active">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= $base_url ?>admin.php">Dashboard</a></li>
                        <li><a href="<?= $base_url ?>admin.php?list">Agenda</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown <?= $error == 0 ? "" : "open" ?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b><?= $_SESSION['email'] ?></b> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?= $base_url ?>admin.php?logout">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<input type="hidden" name="base_url" id="base_url" value="<?= $base_url ?>" disabled />