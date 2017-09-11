<?php include("menu_admin.php"); ?>
<div class="container col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading">Agenda</div>
        <div class="panel-body">
            <table id="list" class="display" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Celular</th>
                        <th>Data Nasc.</th>
                        <th>Contatar por</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <?php if (!empty($contacts)) : ?>
                    <tbody>
                        <?php foreach ($contacts as $contact) : ?>
                            <tr>
                                <td><?= $contact['name'] ?></td>
                                <td><?= $contact['email'] ?></td>
                                <td><?= "(" . substr($contact['mobile'], 0, 2) . ") " . substr($contact['mobile'], 2, 5) . "-" . substr($contact['mobile'], -4) ?></td>
                                <td><?= $settings->date_to_human_date($contact['birthdate']) ?></td>
                                <td>
                                    <?php if ($contact['accept'] == 0 || $contact['accept'] == 1) : ?>
                                        <a href="mailto:<?= $contact['email'] ?>" type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-envelope"></span></a>
                                    <?php endif; ?>
                                    <?php if ($contact['accept'] == 0 || $contact['accept'] == 2) : ?>
                                        <a href="tel:<?= $contact['mobile'] ?>" type="button" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-phone"></span></a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-xs update" data-toggle="modal" data-target="#update" pk_agenda="<?= $contact['pk_agenda'] ?>"><span class="glyphicon glyphicon-ok"></span></button>
                                    <button type="button" class="btn btn-danger btn-xs delete" data-toggle="modal" data-target="#delete" pk_agenda="<?= $contact['pk_agenda'] ?>"><span class="glyphicon glyphicon-remove"></span></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                <?php endif; ?>                
            </table>
        </div>
    </div>    
</div>

<!-- Modal -->
<div class="modal fade" id="update" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Editar Dados</h4>
            </div>
            <form id="signup" class="form-horizontal" role="form" accept-charset="UTF-8" method="POST" action="<?= $base_url ?>admin.php?update">
                <div class="modal-body">

                    <input type="hidden" name="method" id="method" value="update" />
                    <input type="hidden" name="pk_agenda" id="pk_agenda" value="0" />
                    <input type="hidden" name="base_url" id="base_url" value="<?= $base_url ?>" disabled />

                    <div id="div_name" style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="name" type="text" class="form-control" name="name" placeholder="Nome Completo" value="" > 
                    </div> 
                    <div id="error_name" class="alert alert-danger" role="alert" style="display:none">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        Você deve preencher nome e sobrenome!
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
                        Informe o celular corretamente!
                    </div>                

                    <div id="div_birthdate" style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        <input id="birthdate" type="text" class="form-control" name="birthdate" placeholder="Data de Nascimento" data-mask="00/00/0000" data-mask-selectonfocus="true" value="">
                    </div>
                    <div id="error_birthdate" class="alert alert-danger" role="alert" style="display:none">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        Informe o aniversário corretamente!
                    </div>                

                    <div class="input-group">
                        <div class="radio">
                            <label><input type="radio" name="accept" value="0" checked>Enviar novidades por email e celular</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="accept" value="1">Somente por email</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="accept" value="2">Somente por celular</label>
                        </div>                     
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </form>     
        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="delete" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header btn-danger">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Apagar Registro</h4>
            </div>
            <form id="signup" class="form-horizontal" role="form" accept-charset="UTF-8" method="POST" action="<?= $base_url ?>admin.php?delete">
                <div class="modal-body">
                    <input type="hidden" name="method" id="method" value="delete" />
                    <input type="hidden" name="pk_agenda_delete" id="pk_agenda_delete" value="0" />
                    Deseja apagar este registro?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Apagar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </form>     
        </div>

    </div>
</div>