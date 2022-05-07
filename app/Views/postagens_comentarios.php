
                                            
                                                <?= count($comentarios) ?> <?= count($comentarios)>1 ? lang("Site.home.comments.plural", [], $user->lang) : lang("Site.home.comments.singular", [], $user->lang) ?><br />
                                                <?php foreach($comentarios as $comentario): 
                                                    $criadoEm = new \DateTime($comentario->created_at);
                                                ?>
                                                    <div class="comentarios">
                                                        <div class="comentarios-text"><?= $comentario->texto ?></div>
                                                        <div class="comentarios-comp">
                                                            <div class="comentarios-comp-by">
                                                                <?= lang("Site.home.comments.by", [], $user->lang) ?> <?= $comentario->usuarios_nome ?>
                                                                <?= lang("Site.home.comments.at", [], $user->lang) ?> <?= $criadoEm->format($user->date_format .' '. $user->time_format) ?>
                                                            </div>
                                                            <div class="comentarios-comp-control">
                                                                <span class="comentarios-comp-control-retorno"></span>
                                                                <?php if($comentario->usuarios_id == ($user->usuarios_id ?? 0)): ?>
                                                                    <span class="btn-sm text-error comentarios-excluir" data-key="<?= $comentario->key ?>"><i class="far fa-trash-alt"></i></span>
                                                                <?php endif ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            