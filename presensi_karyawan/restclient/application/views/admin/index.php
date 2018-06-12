<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Presensi Karyawan | Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Presensi Karyawan | Admin">
    <meta name="author" content="">
    
    <!-- Styles -->
    <link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet">
    
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    	<script src="<?php echo base_url() ?>assets/js/html5shiv.js"></script>
		<script src="<?php echo base_url() ?>assets/js/respond.min.js"></script>
    <![endif]-->    
    
	<style type="text/css">
		body {padding-top: 60px; padding-bottom: 20px;}
		.footer {
			padding-left: 15px;
			padding-right: 15px;			
			color: #777;
		}
		.container-narrow {margin: 0 auto;max-width: 1024px;}  
		.form-signin {
			text-align:center;
			max-width: 250px;
			padding: 19px 29px 29px;
			margin: 100px auto;
			background-color: #fff;
			border: 1px solid #e5e5e5;
			-webkit-border-radius: 5px;
			   -moz-border-radius: 5px;
					border-radius: 5px;
			-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
			   -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
					box-shadow: 0 1px 2px rgba(0,0,0,.05);
		}
		.form-signin .form-signin-heading, .form-signin .checkbox {margin-bottom: 10px;}
		.form-signin input[type="text"], .form-signin input[type="password"] {font-size: 16px; height: auto; margin-bottom: 15px; padding: 7px 9px;}
		td.nodata {text-align:center}
		.nav-tabs {margin-bottom:10px}
    </style>    
</head>
<body>
	<?php if($this->session->userdata('logged_in') === TRUE): ?>    
    <!--NavBar-->
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    	<div class="container-narrow">
        <div class="navbar-header">        
        	<a class="navbar-brand" href="<?php echo site_url(); ?>">Presensi Karyawan | Admin</a>
        </div>
        <a href="<?php echo site_url('logout'); ?>"><button type="button" class="btn btn-default btn-info navbar-right" style="margin-top:7px"><i class="glyphicon glyphicon-off"></i> Logout</button></a>
        <p class="navbar-text navbar-right">Hai, <?php echo $this->session->userdata('user') ?></p>        
        </div>
    </nav>
    <!--End NavBar--> 
    
    <div class="container-narrow">
        <div class="row" style="min-height:490px;">
            <div class="col-lg-4">
           		<div class="well sidebar-nav">                    
                <ul class="nav nav-list">
                    <li class="nav-header">Main Menu</li>                            
                    <li <?php if($this->uri->segment(2) == 'karyawan') echo "class='active'" ?>><a href="<?php echo site_url('admin/karyawan') ?>">Data Karyawan</a></li>
                    <li <?php if($this->uri->segment(2) == 'presensi') echo "class='active'" ?>><a href="<?php echo site_url('admin/presensi') ?>">Data Presensi</a></li>
                </ul>                       
                </div>
            </div>
            <div class="col-lg-8">          
                <div class="row">
                    <div class="col-lg-12">
                    	<?php $this->load->view('admin/'.$main_content); ?>
                    </div>
                </div>
            </div>
        </div>      
        
    	<hr>
        <div class="footer">
    		<p>&copy; PROJECT SIDANG</p>
    	</div>	
    </div>  
    <?php else: ?>
    <div class="container">
        <form action="" method="post" class="form-signin" role="form">
            <legend class="form-signin-heading">Admin Login</legend>
            <input type="text" name="username" value="" class="form-control" placeholder="Username">
            <input type="password" name="password" value="" class="form-control" placeholder="Password">
            <input type="submit" name="login" value="Login" class="btn btn-info" />
        </form>
    </div>
    <?php endif ?>
    
    <!-- Javascript -->
    <script src="<?php echo base_url() ?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>    
	<script src="<?php echo base_url() ?>assets/js/highcharts.js"></script>
    <script src="<?php echo base_url() ?>assets/js/modules/exporting.js"></script>
    
    <?php if($this->uri->segment(3) == 'grafik'): ?>        
    <script type="text/javascript">
	$(function () {
		var chart;
		$(document).ready(function() {
			chart = new Highcharts.Chart({
				chart: {
					renderTo: 'grafik_container',
					type: 'column'
				},
				title: {
					text: 'Grafik Rekap Presensi'
				},
				subtitle: {
					text: 'Workshop 2014'
				},
				xAxis: {
					categories: <?php echo $data_rekap['nama']; ?>
				},
				yAxis: {
					min: 0,
					title: {
						text: 'Jumlah'
					}
				},
				legend: {
					layout: 'vertical',
					backgroundColor: '#FFFFFF',
					align: 'left',
					verticalAlign: 'top',
					x: 550,
					y: -10,
					floating: true,
					shadow: true
				},
				tooltip: {
					formatter: function() {
						return ''+
							this.x +': '+ this.y +'';
					}
				},
				plotOptions: {
					column: {
						pointPadding: 0.2,
						borderWidth: 0
					}
				},
					series: [{
					name: 'Masuk',
					data: <?php echo str_replace('"','',$data_rekap['masuk']); ?>
		
				}, {
					name: 'Keluar',
					data: <?php echo str_replace('"','',$data_rekap['keluar']); ?>
		
				}, {
					name: 'Cuti',
					data: <?php echo str_replace('"','',$data_rekap['cuti']); ?>
		
				}, {
					name: 'Ijin',
					data: <?php echo str_replace('"','',$data_rekap['ijin']); ?>
		
				}]
			});
		});
		
	});
	</script>
    <?php endif; ?>
</body>
</html>
