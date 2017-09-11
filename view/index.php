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
            <a class="navbar-brand" href="<?= $base_url ?>">madeira<b>madeira</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown <?= $error == 0 ? "" : "open" ?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Área Administrativa</b> <span class="caret"></span></a>
                    <ul id="login-dp" class="dropdown-menu">
                        <li>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="div_error_admin" class="alert alert-danger" role="alert" style="display:<?= $error == 0 ? "none" : "block" ?>">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        Não foi possível efetuar o login. Tente novamente.
                                    </div>                

                                    <form class="form" method="POST" role="form" action="<?= $base_url ?>" id="login-nav">
                                        <div id="div_admin_email" class="form-group">
                                            <label class="sr-only" for="admin_email">Email</label>
                                            <input type="email" class="form-control" id="admin_email" name="admin_email" placeholder="Email">
                                        </div>
                                        <div id="error_admin_email" class="alert alert-danger" role="alert" style="display:none">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                            <span id="msg_admin_email">Informe um email válido!</span>
                                        </div>                

                                        <div id="div_admin_password" class="form-group">
                                            <label class="sr-only" for="admin_password">Senha</label>
                                            <input type="password" class="form-control" id="admin_password" name="admin_password" placeholder="Senha">
                                        </div>
                                        <div id="error_admin_password" class="alert alert-danger" role="alert" style="display:none">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                            <span id="msg_admin_password">Informe uma senha!</span>
                                        </div>                

                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary btn-block" value="Login">
                                        </div>
                                    </form>
                                </div>
                            </div> 
                        </li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div class="container">  
    <div id="div_success" class="alert alert-success" role="alert" style="display:<?= (int) $create === 1 ? "block" : "none" ?>">
        <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
        Cadastro realizado com sucesso!
    </div>                
    <div id="div_error" class="alert alert-danger" role="alert" style="display:<?= (int) $create === 2 ? "block" : "none" ?>">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        Não foi possível efetuar o cadastro. Tente novamente.
    </div>                

    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-10 col-sm-offset-1">                    
        <div class="panel panel-default" >
            <div class="panel-heading">
                <div class="panel-title">Cadastre para receber nossas novidades</div>
            </div>

            <div style="padding-top:30px" class="panel-body" >
                <form id="signup" class="form-horizontal" role="form" accept-charset="UTF-8" method="POST" action="<?= $base_url ?>">
                    <input type="hidden" name="method" id="method" value="save" />
                    <input type="hidden" name="base_url" id="base_url" value="<?= $base_url ?>" disabled />

                    <div id="div_name" style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="name" type="text" class="form-control" name="name" placeholder="Nome Completo" value="" > 
                    </div> 
                    <div id="error_name" class="alert alert-danger" role="alert" style="display:none">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        Você deve preencher seu nome completo!
                    </div>                

                    <div id="div_email" style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="">
                    </div>
                    <div id="error_email" class="alert alert-danger" role="alert" style="display:none">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span id="msg_email"></span>
                    </div>                

                    <div id="div_mobile" style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                        <input id="mobile" type="text" class="form-control" name="mobile" placeholder="Celular" data-mask="(00) 00000-0000" data-mask-selectonfocus="true" value="">
                    </div>
                    <div id="error_mobile" class="alert alert-danger" role="alert" style="display:none">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        Informe seu celular corretamente!
                    </div>                

                    <div id="div_birthdate" style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        <input id="birthdate" type="text" class="form-control" name="birthdate" placeholder="Data de Nascimento" data-mask="00/00/0000" data-mask-selectonfocus="true" value="">
                    </div>
                    <div id="error_birthdate" class="alert alert-danger" role="alert" style="display:none">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        Informe seu aniversário corretamente!
                    </div>                

                    <div class="input-group">
                        <div class="radio">
                            <label><input type="radio" name="accept" value="0" checked>Aceito receber novidades por email e celular</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="accept" value="1">Quero novidades somente por email</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="accept" value="2">Quero novidades somente por celular</label>
                        </div>                     
                    </div>


                    <div style="margin-top:10px" class="form-group">
                        <!-- Button -->

                        <div class="col-md-12 controls">
                            <input type="submit" id="btn_signup" class="btn btn-success btn-block" value="Cadastrar">
                        </div>
                    </div>

                </form>     

            </div>                     
        </div>  
    </div>
</div>

