
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

                    <?php if ( $_page->id == 6 ):  ?>
                        <?php $video = getGallery(6, false); ?>
                        <div class="col col-8 text-center">
                            <div class="video-agencia">
                                <iframe src="https://www.youtube.com/embed/<?=$video[0]->url?>" title="<?=$video[0]->title?>"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                                </iframe>
                                <p class="demo text-center">DEMO REEL 2021</p>
                            </div>
                        </div>
                    <?php endif ?>

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
    <div class="row justify-content-lg-center">
        <div class="col-sm-8">
            <?php $this->load->view('web/_form_main') ?>
        </div>
    </div>
</div>
