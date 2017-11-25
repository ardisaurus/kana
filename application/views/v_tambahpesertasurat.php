<div class="main">
  
  <div class="main-inner">

      <div class="container">
  
        <div class="row">
          <?php if (validation_errors()) {?>
            <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <?php echo validation_errors();?>
            </div>
        <?php } ?>
        <?php if ($this->session->flashdata('message')) { ?>
            <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $this->session->flashdata('message');?>
                </div>          
            <?php } ?>
          <div class="span12">          
            
            <div class="widget ">
              
              <div class="widget-header">
                <i class="icon-user"></i>
                <h3>Peserta Pada Surat <?php echo $this->session->userdata('no_surat_keluar'); ?></h3>
            </div> <!-- /widget-header -->
          
          <div class="widget-content">
                       
                  <fieldset>
                    <?php 
                        $i=1;
                          if ($datapeserta) {                    
                              foreach ($datapeserta as $peserta) {
                     ?>
                    <div class="control-group">                     
                      <label class="control-label" for="no_surat_keluar" >Peserta <?php echo $i; ?> : <?php echo $peserta->nama_peserta; ?> <a href="#modalhapus<?php echo $peserta->idsuratpeserta; ?>" data-toggle="modal"><i class="icon-remove"></i></a></label>

                    <div id="modalhapus<?php echo $peserta->idsuratpeserta; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalhapusLabel<?php echo $peserta->idsuratpeserta; ?>" aria-hidden="true">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="modalhapusLabel<?php echo $peserta->idsuratpeserta; ?>">Hapus peserta</h3>
                        </div>
                        <div class="modal-body">
                          <form id="hapus-admin" class="form-horizontal" action="<?php echo site_url('surat/hapuspeserta');?>" method="post">
                            <div class="controls">
                              <input type="hidden" id="idsuratpeserta" name="idsuratpeserta" value="<?php echo $peserta->idsuratpeserta; ?>">
                            </div>
                            <div class="controls">
                              Hapus peserta <strong><?php echo $peserta->nama_peserta; ?> dari daftar</strong>?
                            </div>                  
                          </div>
                          <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                            <button class="btn btn-danger">Hapus</button>
                            </form>
                          </div>
                        </div>
                    </div> <!-- /control-group -->
                    <?php 
                        $i++;
                        }
                      }
                     ?>
                    <div class="control-group" align="center">                     
                      <?php if (count($datapeserta)<4) { ?>
                            <a href="<?php echo site_url('surat/listpeserta');?>" class="btn btn-success"> <i class="btn-icon-only icon-plus"> </i> Tambah</a>                          
                        <?php }  ?>       
                    </div> <!-- /control-group -->                                          

                    <div class="form-actions">
                      <a href="<?php echo site_url('surat');?>" class="btn btn-info">Simpan</a>
                    </div> <!-- /form-actions -->
                  </fieldset>

          </div> <!-- /widget-content -->
            
        </div> <!-- /widget -->
            
        </div> <!-- /span8 -->

        </div> <!-- /row -->
  
      </div> <!-- /container -->
      
  </div> <!-- /main-inner -->
    
</div> <!-- /main -->