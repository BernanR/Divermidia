<?php
    $banner = get_banners_site('produtos_fix_banner');
?>

<?php if(isset($banner[2])): //banners responsive?>
    <input disabled value="<?=$banner[0]?>" id="banner_desktop" hidden="hidden" type="text">
    <input disabled value="<?=$banner[3]?>" id="mobile_banner" hidden="hidden" type="text">
    <script src="<?= base_url('assets/js/web/')?>changeMobileBanner.js?v=1"></script>
<?php endif;?>
<div class="mt-4 hero-unit row ">
    <div class="col-sm-12">
        <img src="<?= img_url('banners/'. $banner[0])?>" alt="<?=$banner[1]?>" id="banner" title="<?=$banner[1]?>">
    </div>
</div>

<div class="container mt-3 mb-4">
    <p>Distribuímos os melhores materiais do mercado.</p>
</div>

<div class="container">
    <form origem="cart" action="<?= base_url('sendlist') ?>" method="POST" focus-response="#message" data-remote="true" id="form" class="no-styled-form">
        <?php if(sizeof($cartItems) > 0 ):?>
            <div class="table-responsive-md">
                <table class="table mb-4">
                    <thead>
                        <tr>
                            <th scope="col">EXCLUIR</th>
                            <th scope="col">PRODUTO</th>
                            <th scope="col">DESCRIÇÃO</th>
                            <th scope="col">QUANTIDADE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($cartItems as $key => $product):?>
                            <tr>
                                <td class="wd-8 relative text-center">
                                    <div class="flex absolute-center">

                                        <a href="<?= base_url('cart/delete')?>/<?=$product['rowid']?>" class="red-x">
                                            <h1>X</h1>
                                        </a>

                                    </div>
                                </td>
                                <td class="wd-25 relative text-center">
                                    <div class="flex">
                                    <img class="product-img" src="<?=$this->image_handler->thumb('./assets/img/products/', $product['options']->file, 250, 250, false); ?>" title="<?=$product['options']->title?>" alt="<?=$product['options']->title?>">
                                    </div>
                                </td>
                                <td class="wd-50 relative text-center">
                                    <div class="flex absolute-center">
                                        <a href="<?=base_url('produto/' . $product['options']->slug )?>">
                                            <h3 class="title-desc"> <?= $product['options']->name; ?>  </h3>
                                        </a>
                                        <h6 class="subtitle-desc mb-3"> <?=$product['options']->title?></h6>
                                    </div>
                                </td>
                                <td class="wd-16 relative text-center">
                                    <div class="flex absolute-center">
                                        <input min="1" value="<?= $product['qty'] ?>" class="qtd-input" type="number" name="qtd_produto_<?=$key?>" id="qtd_produto_<?=$key?>" data-id="<?=$key?>">
                                    </div>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                        
                    </tbody>
                </table>
            </div>

        <?php else:?>
            
            <div style="font-size: 22px;" class="alert alert-warning">
                Você não possui produtos na lista de orçamento.
            </div>

        <?php endif; ?>

        <div class="text-right">
            <!-- ALTERAR URL -->
            <a class="btn btn-dark orange add-more" href="<?= base_url('produtos/all') ?>">ADICIONAR MAIS PRODUTOS</a>
        </div>
        <div class="text-center mt-4 mb-3">
            <p class="simple">
                para que sua solicitação seja encaminhada com sucesso, preencha os dados abaixo em seguida envie a solicitação.
            </p>
        </div>
        <div class="orange">
            <div class="row">
                <div class="flex-align-center col-md-12 col-lg-6 mb-3">
                    <div class="row">
                        <div class="col-md-2 col-sm-12 icon-form-col">
                            <div class="mt-3 pad-l-in-767">
                                <img class="form-image" src="<?= base_url('assets/img/icons/')?>form_name_ico.png" title="Nome" alt="Digite seu nome">
                            </div>
                        </div>
                        <div class="col-md-10 col-sm-12 ">
                            <div class="pr-2 pad-l-in-767 innerClassPr5 mt-3">
                                <input name="name" id="name" type="text" placeholder="SEU NOME*" class="form-control">
                            </div>    
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-2 icon-form-col">
                            <div class="mt-3 pad-l-in-767">
                                <img class="form-image" src="<?= base_url('assets/img/icons/')?>form_mail_ico.png" title="Email">
                            </div>
                        </div>
                        <div class="col-md-10 col-sm-12 ">
                            <div class="pr-2 pad-l-in-767 innerClassPr5 mt-3">
                                <input name="email"  type="email" id="email" placeholder="SEU EMAIL*" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-2 icon-form-col">
                            <div class="mt-3 pad-l-in-767">
                                <img class="form-image" src="<?= base_url('assets/img/icons/')?>form_phone_ico.png" title="Telefone">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-10">
                            <div class="pr-2 pad-l-in-767 innerClassPr5 mt-3">
                                <input id="phone" name="phone" maxlength="15"  type="tel" placeholder="SEU TELEFONE*" class="form-control phone_with_ddd">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-align-center col-md-12 col-lg-6 mb-3">
                    <div class="row">
                        <div class="col-sm-12 col-md-2 icon-form-col">
                            <div class="mt-3 pad-l-in-767">
                                <img class="form-image" src="<?= base_url('assets/img/icons/')?>form_message_ico.png" title="Mensagem" alt="message-icon">
                            </div>
                        </div>
                        <div class="col-md-10 col-sm-12">
                            <div class="pr-5 pad-l-in-767 mt-3">
                                <textarea class="form-control"  name="input_message" id="input_message"  placeholder="SUA MENSAGEM*" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>           
            </div> 
        </div>
        <div class="container flex-just-center bottom-line">
            <div class="row mt-3 pb-5 without-pl-mobile " >
                <div class="col-sm-12 ">
                    <div id="message" style="display: none;"></div>
                    <div class="mb-2" style="text-align: center;">
                        <div style="display: none;" class="mb-2" id="message"></div>
                        <button type="submit" id="submit" class="btn btn-dark">ENVIAR LISTA</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>   