<h3>Karyawan</h3>

<!-- Menampilkan Flashdata -->
<?php 
if($this->session->flashdata('sukses')):
?>
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
	<?php echo $this->session->flashdata('sukses'); ?>
</div>
<?php endif; ?>
<!-- End Menampilkan Flashdata -->  

<!-- Menampilakan Tab -->
<ul class="nav nav-tabs">
    <li <?php if($this->uri->segment(3) == 'view' || $this->uri->segment(3) == '') echo "class='active'" ?>><a href="<?php echo site_url('admin/karyawan'); ?>">View Karyawan</a></li>
    <li <?php if($this->uri->segment(3) == 'add') echo "class='active'" ?>><a href="<?php echo site_url('admin/karyawan/add'); ?>">Add Karyawan</a></li>
    <?php if($this->uri->segment(3)=='edit'): ?>
    <li class='active'><a href="<?php echo current_url() ?>">Edit Karyawan</a></li>
    <?php endif; ?>
</ul>
<!-- End Menampilkan Tab -->

<?php if(validation_errors()): ?>
	<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo validation_errors(); ?>
    </div>
<?php endif?>

<?php if($this->uri->segment(3)=='add' || $this->uri->segment(3)=='edit'): ?>
                
	<form action="" method="post" role="form">        
        <div class="form-group">
            <label class="control-label">NIP</label>                          
            <input type="text" class="form-control" name="nip" value="<?php echo set_value('nip', isset($default['nip'])?$default['nip']:''); ?>" />
        </div> 
        <div class="form-group">
            <label class="control-label">Nama</label>                            
            <input type="text" class="form-control" name="nama" value="<?php echo set_value('nama', isset($default['nama'])?$default['nama']:''); ?>" />
        </div> 
        <div class="form-group">
            <label class="control-label">Password</label>               
            <input type="text" class="form-control" name="password" value="<?php echo set_value('password', isset($default['password'])?$default['password']:''); ?>" />
        </div>              	                    	                   
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
    
<?php else: ?>

	<table class="table table-condensed table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>NIP</th>
            <th>Nama</th>            
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    	<?php if(!empty($data_query)):?>
        <?php $i=1+$this->uri->segment(4);?>
			<?php foreach($data_query as $dt):?>
                <tr>	
                    <td><?php echo $i++ ?></td>
                    <td><?php echo $dt['nip'] ?></td>
                    <td><?php echo $dt['nama'] ?></td>
                    <td>
                    	<div class="btn-group">
                        <a href="<?php echo site_url('admin/karyawan/edit/'.$dt['idkaryawan']); ?>" class="btn btn-info btn-xs">Edit</a>
                   		<a href="<?php echo site_url('admin/karyawan/delete/'.$dt['idkaryawan']); ?>" onclick="return confirmDelete()" class="btn btn-danger btn-xs">Delete</a>                      
                        </div>  
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
        		<tr>	
                    <td colspan="7" class="nodata text-muted">No Data</td>
                </tr>
        <?php endif; ?>        
    </tbody>
    </table>
    <?php echo !empty($paging)? $paging : '' ; ?>
    
<?php endif; ?>
