<form class="main-form" action="POST">
    <div class="row">
        <p class="text-form-title"><strong>Solicite um orçamento</strong></p>
        <div class="col-7 mb-12 m-0 pr-dvm">
            <input name="name" type="text" class="form-divm form-control" placeholder="Nome:" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="col-5 m-0 pl-dvm">
            <input name="phone" type="tel" class="form-divm form-control" placeholder="Telefone:" id="exampleInputPassword1">
        </div>
        <div class="col-12">
        <textarea name="message" placeholder="Mensagem:" class="form-divm form-control"></textarea>
        </div>
        <div class="col-12 error-msg d-none">
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <div class="message">
                    An example danger alert with an icon
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        
        <div class="botao">
            <p>
                <button type="submit" class="btn btn-primary btn-enviar pulse-animate">Enviar</button>
            </p>
        </div>  
    </div>
      
</form>