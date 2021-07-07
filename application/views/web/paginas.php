
<div class="container" id="page_<?=$_page->id?>">
    <div class="row">
        <div class="col-sm-12">
            <header>
                <h1 id="page-title" ><?=$_page->title?></h1>
            </header>
        </div>
    </div>    
    <div class="row">
        <div class="col-sm-12">
            <div id="content" class="article text-content col-sm-12" >
                <article id="wikiArticle">
                    <?=$_page->content ?>  
                </article>
            </div>
        </div>
    </div>
</div>
<?php $galery = getGallery($_page->gallery_id)?>
<?php if ($galery):  ?>
    <div class="full-carousel">    
        <?=$galery?>
    </div>
<?php endif ?>

<div class="container mt-4 form-footer" >
    <div class="mt-3 row ">    
        <?php $this->load->view('web/_form_footer')?>
    </div>
</div>