
<?php foreach($products as $product): ?> 

    <?php $product->itsInCart = hasProductCart($product->id) ?>
    <div class="col-md-12 col-lg-6 pt-4 item">
        <div class="row product-row pt-5 pr-lg">
            <div class="product-col-image col-sm-6">
            <img class="product-img" src="<?=$this->image_handler->thumb('./assets/img/products/', $product->file, 250, 250, false); ?>" alt="produto" title="<?=$product->title?>">
            
        </div>
            <div class="product-col-desc col-sm-6">
                <h3 class="title-desc"> <?=$product->name?> </h3>
                <h6 class="subtitle-desc mb-3"><?=$product->title?> </h6>

                <p class="text-desc mb-3 no-mb-mobile"><?=$product->resume?></p>

                <div class="flex">
                    <a href="<?= base_url('produto/'.$product->slug)?>" class="blue btn btn-primary mr-2">LEIA MAIS</a>
                    <a href="<?= base_url('cart/add/'.$product->id) ?>" 
                        class="<?= ($product->itsInCart ) ? 'btn-success' : 'orange' ?>  btn btn-primary"
                    >

                        <?php if($product->itsInCart): ?>
                            JÁ ESTÁ NO ORÇAMENTO
                        <?php else: ?>    
                            ADICIONAR AO ORÇAMENTO
                        <?php endif; ?>
                    </a>
                </div>
            </div>
        </div>            
    </div>
<?php endforeach ?>