<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Presensi Karyawan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Presensi Karyawan">
    <meta name="author" content="">
    
    <!-- Styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
      <script src="assets/js/respond.min.js"></script>
    <![endif]-->     
</head>
<body>
<div class="container">
<div class="header">
<script type="text/javascript">
    //set timezone
    <?php date_default_timezone_set('Asia/Jakarta'); ?>
    //buat object date berdasarkan waktu di server
    var serverTime = new Date(<?php print date('Y, m, d, H, i, s, 0'); ?>);
    //buat object date berdasarkan waktu di client
    var clientTime = new Date();
    //hitung selisih
    var Diff = serverTime.getTime() - clientTime.getTime();    
    //fungsi displayTime yang dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik
    function displayServerTime(){
        //buat object date berdasarkan waktu di client
        var clientTime = new Date();
        //buat object date dengan menghitung selisih waktu client dan server
        var time = new Date(clientTime.getTime() + Diff);
        //ambil nilai jam
        var sh = time.getHours().toString();
        //ambil nilai menit
        var sm = time.getMinutes().toString();
        //ambil nilai detik
        var ss = time.getSeconds().toString();
        //tampilkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
        document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
    }
</script>
</head>
<body onload="setInterval('displayServerTime()', 1000);">
<div style="text-align:center;">
<h1 class="text-muted">Portal Presensi Karyawan</h1>
    <h1 id="clock"></h1>
</div>
</div>



	<div class="row main-content">
        <div class="col-lg-7">
        
        <!-- Menampilkan Error -->
        <?php if(validation_errors()): ?>
            <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo validation_errors(); ?>
            </div>
        <?php endif?>        
        <!-- End Menampilkan Error -->
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
  
        <form action="" method="post" class="form-horizontal" role="form">
            <div class="form-group">
                <label class="col-sm-2 control-label">NIP</label>
                <div class="col-sm-10">
                    <input type="text" name="nip" class="form-control" placeholder="NIP" value="<?php echo set_value('nip'); ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Jenis</label>
                <div class="col-sm-10">                
                    <div class="radio">
                        <label>
                            <input type="radio" name="jenis" value="masuk" <?php echo set_radio('jenis', 'masuk'); ?>> Masuk                
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="jenis" value="keluar" <?php echo set_radio('jenis', 'keluar'); ?>>Keluar
                        </label>                    
                    </div>                
                    <div class="radio">
                        <label>
                            <input type="radio" name="jenis" value="ijin" <?php echo set_radio('jenis', 'ijin'); ?>> Ijin                
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="jenis" value="cuti" <?php echo set_radio('jenis', 'cuti'); ?>>cuti
                        </label>                    
                    </div>                
                    

                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-success" value="Enter">
                </div>
            </div>
            
        </form>
            
        </div>
        
        <div class="col-lg-5 well">
        	<?php if($data_presensi): ?>
            <?php foreach($data_presensi as $dp): ?>
        	<div class="content-item">
                <h4><?php echo $dp['nama'] ?></h4>
                <p>Presensi <span class="text-info"><?php echo $dp['jenis'] ?></span> pada <?php echo date('d F Y H:i',$dp['waktu']) ?>.</p>
            </div>
            <?php endforeach ?>
            <?php endif ?>            
        </div>
    </div> 

	<hr>
    <div class="footer">
    	<p>&copy; Project Sidang</p>
    </div> 

</div> <!-- /container -->
<!-- Javascript -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
