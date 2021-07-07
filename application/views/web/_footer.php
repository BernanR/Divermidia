<div id='whats'  class="whats" style="left: auto;left: 5%;" >
    <a 
    data-toggle="tooltip" data-placement="right" title="Posso ajudar?"
    class="whats-button" 
    href="https://api.whatsapp.com/send?phone=<?= $config->whatsapp_number?>" 
    target="_blank">
        <img  src="<?= base_url('assets/img/icons/')?>business_whats.png" alt="Whatsapp Divermídia" >
    </a>
</div>

<footer class="navbar-fixed-bottom">
    <div>
        <p>Divermidia 2021 | Todos os direitos reservados | (11) 94780-7349 / email@divermidia.com.br</p>
    </div>
</footer>

<script>
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
