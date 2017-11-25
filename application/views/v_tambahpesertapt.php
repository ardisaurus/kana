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
                <h3>Peserta Baru dari Perguruan tinggi</h3>
            </div> <!-- /widget-header -->
          
          <div class="widget-content">
                       
                <?php echo form_open_multipart('pesertapt/tambah', 'class="form-horizontal" role="form"'); ?>
                  <fieldset>
                    
                    <div class="control-group">                     
                      <label class="control-label" for="nama" >NIM</label>
                      <div class="controls">
                        <input type="text" id="nim" name="nim" value="<?php echo set_value('nim');?>" >
                      </div>       
                    </div> <!-- /control-group -->
                    
                    <div class="control-group">                     
                      <label class="control-label" for="nama">Nama</label>
                      <div class="controls">
                        <input type="text" id="nama" name="nama" value="<?php echo set_value('nama');?>" >
                      </div>
                    </div> <!-- /control-group -->

                    <div class="control-group">                     
                      <label for="lembaga" class="col-sm-3 control-label">Lembaga</label>
                      <div class="controls">
                        <select name="lembaga" class="form-control" id="lembaga">
                          <option>- Select Lembaga -</option>
                          <?php foreach($lembaga as $prov){
                            echo "<option value='".$prov->id_lembaga."'>".$prov->nama.'</option>';
                          } ?> 
                        </select>
                      </div>
                    </div> <!-- /control-group -->

                    <div class="control-group">                     
                      <label for="jurusan" class="col-sm-3 control-label">Jurusan</label>
                      <div class="controls">
                        <select name="jurusan" class="form-control" id="jurusan">
                          <option value=''>Select Jurusan</option>
                        </select>
                      </div>
                    </div> <!-- /control-group --> 

                    <div class="control-group">                     
                      <label for="divisi" class="col-sm-3 control-label">Divisi</label>
                      <div class="controls">
                        <select name="divisi" class="form-control" id="divisi">
                          <option>- Select Divisi -</option>
                          <?php foreach($divisi as $prov){
                            echo '<option value="'.$prov->id_divisi.'">'.$prov->nama.'</option>';
                          } ?>
                        </select>
                      </div>
                    </div> <!-- /control-group -->

                    <div class="control-group">                     
                      <label for="pembimbing" class="col-sm-3 control-label">Pembimbing</label>
                      <div class="controls">
                        <select name="pembimbing" class="form-control" id="pembimbing">
                          <option value=''>Select Pembimbing</option>
                        </select>
                      </div>
                    </div> <!-- /control-group -->  

                     <div class="control-group">                      
                      <label class="control-label" for="radiobtns">Tanggal Mulai</label>                      
                      <div class="controls">
                        <select name="harimulai" class="form-control">
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
                        <select name="bulanmulai" class="form-control">
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
                        <select name="tahunmulai" class="form-control">
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
                      <label class="control-label" for="radiobtns">Tanggal Selesai</label>                      
                      <div class="controls">
                        <select name="hariselesai" class="form-control">
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
                        <select name="bulanselesai" class="form-control">
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
                        <select name="tahunselesai" class="form-control">
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
                      <a href="<?php echo site_url('pesertapt');?>" class="btn">Batal</a>
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