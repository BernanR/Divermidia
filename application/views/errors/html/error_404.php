


<div class="mt-4 hero-unit row erro404">
    <div class="col-sm-12 text-center">
        <h1 class="title-desc text-center">Desculpe, não encontramos a página que você procura.</h1>
        <h2><strong>Vamos tentar novamente?</strong></h2>
    </div>
</div>


<div class="row text-center erro404">
      <div class="col-lg-12">
         <div class="search"> 
           <form action="<?=base_url('busca')?>" method="get">
               <input type="text" name="search"><input type="submit" value="Go">
             </form>
         </div>
      </div>
</div>

<div class="row text-center erro404">
	<div class="col-lg-12">
		<p>
			Ou você pode entrar em contato conosco através do formulário abaixo:
		</p>
	</div>
</div>

<div class="mt-5 row ">
    <?php
        $this->load->view('web/_form_footer')
    ?>        
</div>
