<div class="main">
	
	<div class="main-inner">

	    <div class="container">
	
	      <div class="row">
	      	
	      	<div class="span12">

	      		<?php if ($this->session->flashdata('message')) { ?>
	      		<div class="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $this->session->flashdata('message');?>
                </div>      		
	      		<?php } ?>

	      		<div class="widget ">
	      			
	      			<div class="widget-header">
	      				<i class="icon-user"></i>
	      				<h3>Akun</h3>
	  				</div> <!-- /widget-header -->
					
					<div class="widget-content">
						<div class="control-group">
							<div class="controls">
							<!-- Button to trigger modal -->
                                Nama : <?php 

                                foreach ($userdetail as $detail) {echo $detail->nama;} 

                                ?> <a href="#modalnama" class="btn btn-mini" data-toggle="modal" ><i class="icon-edit"></i> Ubah</a>
                                <!-- Modal -->
                                <div id="modalnama" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalnamaLabel" aria-hidden="true">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h3 id="modalnamaLabel">Ubah Nama</h3>
                                    </div>
                                    <div class="modal-body">
										<form id="edit-profile" class="form-horizontal" action="<?php echo site_url('akun/ubahnama');?>" method="post">
                                    	<div class="control-group">											
											<label class="control-label" for="nama">Nama Baru</label>
											<div class="controls">
												<input type="text" id="nama" name="nama">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                                        <button class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
							</div> <!-- /controls -->
							<br>
							<div class="controls">
							<!-- Button to trigger modal -->
                                Email : <?php 

                                foreach ($userdetail as $detail) {echo $detail->email;} 

                                ?> <a href="#modalemail" class="btn btn-mini" data-toggle="modal" ><i class="icon-edit"></i> Ubah</a>
                                <!-- Modal -->
                                <div id="modalemail" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalemailLabel" aria-hidden="true">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h3 id="modalemailLabel">Ubah Email</h3>
                                    </div>
                                    <div class="modal-body">
										<form id="edit-profile" class="form-horizontal" action="<?php echo site_url('akun/ubahemail');?>" method="post">
                                    	<div class="control-group">											
											<label class="control-label" for="emailbaru">Email Baru</label>
											<div class="controls">
												<input type="email" id="emailbaru" name="emailbaru">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                                        <button class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
							</div> <!-- /controls -->
							<div align="right">
								<div class="controls">
								<!-- Button to trigger modal -->
                                	<a href="#modalpassword" role="button" class="btn btn-warning" data-toggle="modal"><i class="icon-lock"></i> Ubah Kata Sandi </a>
                                    
          							<?php if(count($admin_num)>1){ ?>
                                	<a href="#myModal" role="button" class="btn btn-danger" data-toggle="modal"><i class="icon-remove"></i> Hapus Akun</a>
                                	<?php } ?>
                                    
								</div> <!-- /controls -->
							</div>
                                    <div id="modalpassword" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalpasswordLabel" aria-hidden="true">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            	<h3 id="modalpasswordLabel">Ubah Kata Sandi</h3>
                                        </div>
                                        <div class="modal-body">
											<form id="edit-profile" class="form-horizontal" action="<?php echo site_url('akun/ubahpassword');?>" method="post">
                                            <label class="control-label" for="passwordlama">Kata Sandi Lama</label>
											<div class="controls">
												<input type="password" id="passwordlama" name="passwordlama">
											</div>
											<br>
											<label class="control-label" for="passwordbaru">Kata Sandi Baru</label>
											<div class="controls">
												<input type="password" id="passwordbaru" name="passwordbaru">
												<p class="help-block"><i class="icon-info-sign"></i> Masukan kombinasi antara 6-12 karakter.</p>
											</div>
											<br>
											<label class="control-label" for="passwordbaru2">Ulangi Kata Sandi Baru</label>
											<div class="controls">
												<input type="password" id="passwordbaru2" name="passwordbaru2">
											</div>
                                        </div>
                                        <div class="modal-footer">
                                        	<button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                                            <button class="btn btn-warning">Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            	<h3 id="myModalLabel">Hapus Akun</h3>
                                        </div>
                                        <div class="modal-body">
											<form id="edit-profile" class="form-horizontal" action="<?php echo site_url('akun/hapusakun');?>" method="post">
                                            <label class="control-label" for="passwordlama">Kata Sandi</label>
											<div class="controls">
												<input type="password" id="password" name="password">
											</div>
                                        </div>
                                        <div class="modal-footer">
                                        	<button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                                            <button class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Modal -->
								<!-- Button to trigger modal -->	
						</div> <!-- /control-group -->
					</div> <!-- /widget-content -->
						
				</div> <!-- /widget -->
	      		
		    </div> <!-- /span8 -->
	      	
	      </div> <!-- /row -->
	
	    </div> <!-- /container -->
	    
	</div> <!-- /main-inner -->
    
</div> <!-- /main -->