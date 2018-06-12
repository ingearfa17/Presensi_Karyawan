<h3>Presensi</h3>

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
    <li <?php if($this->uri->segment(3) == 'view' || $this->uri->segment(3) == '') echo "class='active'" ?>><a href="<?php echo site_url('admin/presensi'); ?>">View Presensi</a></li>
    <li <?php if($this->uri->segment(3) == 'grafik') echo "class='active'" ?>><a href="<?php echo site_url('admin/presensi/grafik'); ?>">Grafik</a></li>
</ul>
<!-- End Menampilkan Tab -->

<?php if(validation_errors()): ?>
	<div class="alert alert-error">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo validation_errors(); ?>
    </div>
<?php endif?>

<?php if($this->uri->segment(3)=='view' || $this->uri->segment(3)==''): ?>
              
	<table class="table table-condensed table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>            
            <th>Masuk</th>
            <th>Keluar</th>
            <th>Cuti</th>
            <th>Ijin</th>
        </tr>
    </thead>
    <tbody>
    	<?php if(!empty($data_query)):?>
        <?php $i=1+$this->uri->segment(4);?>
			<?php foreach($data_query as $dt):?>
                <tr>	
                    <td><?php echo $i++ ?></td>
                    <td><?php echo $dt['nama'] ?></td>
                    <td><?php echo $dt['total_masuk'] ?></td>
                    <td><?php echo $dt['total_keluar'] ?></td>
                    <td><?php echo $dt['total_cuti'] ?></td>
                    <td><?php echo $dt['total_ijin'] ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
        		<tr>	
                    <td colspan="7" class="nodata text-muted">No Data</td>
                </tr>
        <?php endif; ?>        
    </tbody>
    </table>
    
<?php elseif($this->uri->segment(3)=='grafik'): ?>

<div id="grafik_container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
    
<?php endif; ?>

