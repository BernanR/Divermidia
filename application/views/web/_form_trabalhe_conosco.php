<div class="form-col d-flex justify-content-center mb-5 col-sm-12 form-footer trabalhe-cnsco">            
    <!-- <form class="form w-75" data-remote="true" focus-response="#message" id="form" method="POST" action="<?= base_url() ?>contactmail"> -->
        <fieldset class="blue-field">
            <legend class="center">Deseja obter um orçamento rápido, preencha os campos abaixo.</legend>
            <div class="row">
                <div class="flex-align-center col-md-12 col-lg-6 mb-3">
                    <div class="row">
                        <div class="col-md-2 col-sm-12 icon-form-col">
                            <div class="mt-3">
                                <img class="form-image" src="<?= img_url('icons/blue_user_ico.png') ?>" title="Nome" alt="Digite seu nome">
                            </div>
                        </div>
                        <div class="col-md-10 col-sm-12 ">
                            <div class="pr-2 innerClassPr5 mt-3">
                                <input name="name" id="name" type="text" placeholder="SEU NOME*" class="form-control">
                            </div>    
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-sm-12 col-md-2 icon-form-col">
                            <div class="mt-3">
                                <img class="form-image" src="<?= img_url('icons/blue_mail_ico.png') ?>" title="Email">
                            </div>
                        </div>
                        <div class="col-md-10 col-sm-12 ">
                            <div class="pr-2 innerClassPr5 mt-3">
                                <input name="email"  type="email" id="email" placeholder="SEU EMAIL*" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-2 icon-form-col">
                            <div class="mt-3">
                                <img class="form-image" src="<?= img_url('icons/blue_phone_ico.png') ?>" title="Telefone">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-10">
                            <div class="pr-2 innerClassPr5 mt-3">
                                <input id="phone" name="phone" maxlength="15"  type="tel" placeholder="SEU TELEFONE*" class="form-control phone_with_ddd">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-align-center col-md-12 col-lg-6 mb-3">
                    <div class="row">
                        <div class="col-sm-12 col-md-2 icon-form-col">
                            <div class="mt-3">
                                <img class="form-image" src="<?= img_url('icons/blue_message_ico.png') ?>" title="Mensagem" alt="message-icon">
                            </div>
                        </div>
                        <div class="col-md-10 col-sm-12">
                            <div class="pr-5 mt-3">
                                <textarea class="form-control"  name="input_message" id="input_message"  placeholder="SUA MENSAGEM*" cols="30" rows="4"></textarea>
                            </div>
                        </div>                        
                    </div>
                    <div id="captha" class="row"></div>
                </div>           
            </div> 

            <div class="row">
                <div id="message" class="col-md-12 col-sm-12">                   
                </div>
            </div>

            <span class="bottom-legend">
                <button type="submit" id="submit" class="btn blue btn-dark">ENVIAR</button>            
            </span>
            <br>
        </fieldset>
    <!-- </form>  -->
</div>