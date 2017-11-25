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
                <h3>Surat Baru</h3>
            </div> <!-- /widget-header -->
          
          <div class="widget-content">
                       
                <?php echo form_open_multipart('surat/tambah', 'class="form-horizontal" role="form"'); ?>
                  <fieldset>

                    <div class="control-group">                     
                      <label class="control-label" for="no_surat_keluar" >Nomor Surat Keluar</label>
                      <div class="controls">
                        <input type="text" id="no_surat_keluar" name="no_surat_keluar" value="<?php echo set_value('no_surat_keluar');?>" >
                      </div>       
                    </div> <!-- /control-group -->

                     <div class="control-group">                      
                      <label class="control-label" for="radiobtns">Tanggal Keluar</label>                      
                      <div class="controls">
                        <select name="harikeluar" class="form-control">
                          <option value="0"> - Hari - </option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                          <option value="13">13</option>
                          <option value="14">14</option>
                          <option value="15">15</option>
                          <option value="16">16</option>
                          <option value="17">17</option>
                          <option value="18">18</option>
                          <option value="19">19</option>
                          <option value="20">20</option>
                          <option value="21">21</option>
                          <option value="22">22</option>
                          <option value="23">23</option>
                          <option value="24">24</option>
                          <option value="25">25</option>
                          <option value="26">26</option>
                          <option value="27">27</option>
                          <option value="28">28</option>
                          <option value="29">29</option>
                          <option value="30">30</option>
                          <option value="31">31</option>
                        </select>
                        <select name="bulankeluar" class="form-control">
                          <option value="0"> - Bulan - </option>
                          <option value="1">Januari</option>
                          <option value="2">Febuari</option>
                          <option value="3">Maret</option>
                          <option value="4">April</option>
                          <option value="5">Mei</option>
                          <option value="6">Juni</option>
                          <option value="7">Juli</option>
                          <option value="8">Augustus</option>
                          <option value="9">September</option>
                          <option value="10">Oktober</option>
                          <option value="11">November</option>
                          <option value="12">Desember</option>
                        </select>
                        <select name="tahunkeluar" class="form-control">
                          <option value="0"> - Tahun - </option>
                          <?php
                            for ($i=6; $i >0 ; $i--) {  
                              $x=365*$i;                             
                              $oneYearOn = date('Y',strtotime(date("Y-m-d", mktime()) . " - $x day"));
                              echo "<option value='".$oneYearOn."'>".$oneYearOn."</option>";
                            } 
                            for ($i=0; $i <6 ; $i++) {  
                              $x=365*$i;                             
                              $oneYearOn = date('Y',strtotime(date("Y-m-d", mktime()) . " + $x day"));
                              echo "<option value='".$oneYearOn."'>".$oneYearOn."</option>";
                            }
                           ?>
                        </select>
                      </div>  <!-- /controls -->      
                    </div> <!-- /control-group -->

                    <div class="control-group">                     
                      <label class="control-label" for="kepada" >Kepada</label>
                      <div class="controls">
                        <input type="text" id="kepada" name="kepada" value="<?php echo set_value('kepada');?>" >
                      </div>       
                    </div> <!-- /control-group -->
                    
                    <div class="control-group">                     
                      <label class="control-label" for="no_surat_masuk" >Nomor Surat Masuk</label>
                      <div class="controls">
                        <input type="text" id="no_surat_masuk" name="no_surat_masuk" value="<?php echo set_value('no_surat_masuk');?>" >
                      </div>       
                    </div> <!-- /control-group -->

                     <div class="control-group">                      
                      <label class="control-label" for="radiobtns">Tanggal Surat Masuk</label>                      
                      <div class="controls">
                        <select name="harimasuk" class="form-control">
                          <option value="0"> - Hari - </option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                          <option value="13">13</option>
                          <option value="14">14</option>
                          <option value="15">15</option>
                          <option value="16">16</option>
                          <option value="17">17</option>
                          <option value="18">18</option>
                          <option value="19">19</option>
                          <option value="20">20</option>
                          <option value="21">21</option>
                          <option value="22">22</option>
                          <option value="23">23</option>
                          <option value="24">24</option>
                          <option value="25">25</option>
                          <option value="26">26</option>
                          <option value="27">27</option>
                          <option value="28">28</option>
                          <option value="29">29</option>
                          <option value="30">30</option>
                          <option value="31">31</option>
                        </select>
                        <select name="bulanmasuk" class="form-control">
                          <option value="0"> - Bulan - </option>
                          <option value="1">Januari</option>
                          <option value="2">Febuari</option>
                          <option value="3">Maret</option>
                          <option value="4">April</option>
                          <option value="5">Mei</option>
                          <option value="6">Juni</option>
                          <option value="7">Juli</option>
                          <option value="8">Augustus</option>
                          <option value="9">September</option>
                          <option value="10">Oktober</option>
                          <option value="11">November</option>
                          <option value="12">Desember</option>
                        </select>
                        <select name="tahunmasuk" class="form-control">
                          <option value="0"> - Tahun - </option>
                          <?php
                            for ($i=6; $i >0 ; $i--) {  
                              $x=365*$i;                             
                              $oneYearOn = date('Y',strtotime(date("Y-m-d", mktime()) . " - $x day"));
                              echo "<option value='".$oneYearOn."'>".$oneYearOn."</option>";
                            } 
                            for ($i=0; $i <6 ; $i++) {  
                              $x=365*$i;                             
                              $oneYearOn = date('Y',strtotime(date("Y-m-d", mktime()) . " + $x day"));
                              echo "<option value='".$oneYearOn."'>".$oneYearOn."</option>";
                            }
                           ?>
                        </select>
                      </div>  <!-- /controls -->      
                    </div> <!-- /control-group -->

                    <div class="form-actions">
                      <button type="submit" class="btn btn-success">Tambah</button> 
                      <a href="<?php echo site_url('surat');?>" class="btn">Batal</a>
                    </div> <!-- /form-actions -->
                  </fieldset>
                </form>

          </div> <!-- /widget-content -->
            
        </div> <!-- /widget -->
            
        </div> <!-- /span8 -->

        </div> <!-- /row -->
  
      </div> <!-- /container -->
      
  </div> <!-- /main-inner -->
    
</div> <!-- /main -->