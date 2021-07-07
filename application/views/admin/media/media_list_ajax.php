<?php if (isset($data) && count($data)> 0): ?>
    
      <div class="jFiler-items jFiler-row">
        <ul class="jFiler-items-list jFiler-items-grid">
          <?php foreach ($data as $v): ?>
            <li class="jFiler-item" data-jfiler-index="0">                       
              <div class="jFiler-item-container">                            
                <div class="jFiler-item-inner">                                
                  <div class="jFiler-item-thumb">                                    
                    <div class="jFiler-item-status"></div>                                    
                    <div class="jFiler-item-info">                                        
                      <span class="jFiler-item-title"><b id="titulo_<?=$v->id?>" title="<?=$v->title?>"></b></span>                      
                    </div>                                    
                    <div class="jFiler-item-thumb-image">
                      <img src="<?=base_url($v->path . '/' . $v->file)?>" alt="<?= $v->title?>">
                    </div>                                    
                    <input type="text" class="logo-gradiente-3.png">                                
                  </div>                                
                  <div class="jFiler-item-assets jFiler-row"> 
                    <ul class="list-inline pull-right">    
                      <li>
                        <a title="Copiar link" onClick="link_copy(this)" class="link_copy icon-jfi-file-text">
                          <input style="position:absolute;left:-1000000px;" class="url_file" value="<?=base_url($v->path . '/' . $v->file)?>" />
                        </a>
                      </li>                                 
                      <li>
                        <a onClick="dlete_file_media(this)" style="padding-left: 16px;" title="Excluir" class="btn-mini icon-jfi-trash jFiler-item-trash-action dlete_file_media" href="javascript:void(0)" data-href="api/delete-media/<?=$v->id; ?>"></a>
                      </li>                                    
                    </ul>                                
                  </div>                            
                </div>                        
              </div>
            </li>
        <?php endforeach ?>
        </ul>
      </div>
    
  <?php endif ?>