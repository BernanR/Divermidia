
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <header>
                <h1 id="page-title">Resultado para a busca <span class="destaque">"<?=$title?>"</span></h1>
            </header>
        </div>
    </div>

    <div class="list-group search-content">
        <?php if(count($result) > 0): ?>
            <?php foreach($result as $item):?>
                <a href="<?=base_url($item['slug'])?>" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="card flex-row flex-wrap product-list">                            
                        <div class="card-block px-2">
                            <h4 class="card-title"><?=$item['title']?></h4>
                            <small><?=$item['resumo']?></small>
                        </div>
                        <div class="w-100"></div>
                    </div>
                </a>
            <?php endforeach ?>
        <?php else: ?>
            <div class="alert alert-danger">
                <p>Não há informação no site para a busca inserida.</p>
                <small>Por favor, caso não encontre o que procura, nos envie uma mensagem através do formulário abaixo e em breve retornaremos o contato.</small>
            </div>
        <?php endif ?>
    </div>

    <div class="mt-3 row ">    
        <?php $this->load->view('web/_form_footer') ?>       
    </div>
</div>
