<?php
	if(!isset($_SESSION['login_user'])){
		header('location: ../../login.php'); // Mengarahkan ke Home Page
	}
	//link buat paging
	$linkaksi = 'index.php?page=dashboard';

	if(isset($_GET['act']))
	{
		$act = $_GET['act'];
		$linkaksi .= '&act=$act';
	}
	else
	{
		$act = '';
	}

	$aksi = 'pages/dashboard/act_dashboard.php';

	switch ($act) {
		case 'form':
			if(!empty($_GET['id']))
			{
				$act = "$aksi?page=dashboard&act=edit";
				$query = mysqli_query($conn, "SELECT * FROM dashboard WHERE id_dashboard = '$_GET[id]'");
				$temukan = mysqli_num_rows($query);
				if($temukan > 0)
				{
					$c = mysqli_fetch_assoc($query);
				}
				else
				{
					header("location:index.php?page=dashboard");
				}

			}
			else
			{
				$act = "$aksi?page=dashboard&act=simpan";
			}

		echo"<div class='col-md-12'>
          <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'> dashboard</h3>
			</div>";
			
            echo"<form role='form'  method='POST' action='$act' enctype='multipart/form-data' >
              <div class='box-body'>
                <div class='form-group'>
                  
                  <input type='hidden' class='form-control' name='id' value='"?><?php echo isset($c['id_dashboard']) ? $c['id_dashboard'] : '';?><?php echo"'"?> <?php echo isset($c['id_dashboard']) ? ' readonly' : ' ';?><?php echo" >
								</div>
					<div class='form-group'><label >AAA</label>
					<input type='text' class='form-control' placeholder='Aaa' name='aaa' value='"?><?php echo isset($c['aaa']) ? $c['aaa'] : '';?><?php echo"'"?> <?php echo isset($c['aaa']) ? ' ' : ' ';?><?php echo" >
										</div><div class='box-footer'>
					<button type='submit' class='btn btn-primary'>Submit</button> <button type='button' class='btn btn-primary' onclick='history.back()'><i class='fa fa-rotate-left'></i> Kembali</button>
				</div>
			  </div>			
            </form>
          </div>
        </div>
		";
		break;

		default :
		echo'
		<div class="col-xs-12">
         <div class="box">
            <div class="box-header">
					<div class="nav-tabs-custom" style="color: white; background-color: blue">
    		<marquee scrollamount="10"><h1>Selamat datang di <b>System Informasi Yayasan EAS</b> ( <b>ENERGI</b> <b>AMANAH</b> <b>SEJATERAH</b>)</h1></marquee>    
		</div>
		</div>

	<div class="container-fluid">
     <div >
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-blue">
              <div class="inner">
                 <h3>'?><?php
                $query_pengembangan_wakaf = "SELECT COUNT(*) AS TOTAL_PENGEMBANGAN FROM pengembangan_uang_wakaf ";
                $result_pengembangan = $conn->query($query_pengembangan_wakaf);
                if($result_pengembangan->num_rows > 0 ) {
                $total_pengembangan_wakaf_uang = $result_pengembangan->fetch_assoc();
                    echo"".$total_pengembangan_wakaf_uang['TOTAL_PENGEMBANGAN'] . "";
                  }
                 ?><?php echo'</h3>

                <p>Di Kembangkan</p>
              </div>
              <div class="icon">
                <i class="fa fa-creative-commons"></i>
              </div>
              <a href="index.php?page=pengembangan_uang_wakaf" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3>Rp'?><?php
                $query_wakaf_money = "SELECT SUM(jumlah_uang) AS wakaf_uang FROM uang_wakaf ";
                $result = $conn->query($query_wakaf_money);
                if($result->num_rows > 0 ) {
                $total_wakaf_uang = $result->fetch_assoc();
                    echo"". number_format($total_wakaf_uang['wakaf_uang'], 0, ',', '.') . "";
                  }
                 ?><?php echo'</h3>

                <p>Jumlah Wakaf Uang</p>
              </div>
              
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="index.php?page=uang_wakaf" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3>'?><?php
                $query_wakaf_reciver = "SELECT COUNT(*) AS TOTAL_RECIVER FROM penerima_uang_wakaf ";
                $result_reciver = $conn->query($query_wakaf_reciver);
                if($result_reciver->num_rows > 0 ) {
                $total_reciver_wakaf_uang = $result_reciver->fetch_assoc();
                    echo"".$total_reciver_wakaf_uang['TOTAL_RECIVER'] . "";
                  }
                 ?><?php echo'</h3>

                <p>Penerima Manfaat Wakaf</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="index.php?page=penerima_uang_wakaf" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
               <h3>'?><?php
                $query_wakaf_distribution = "SELECT COUNT(*) AS TOTAL_DISTRIBUTION FROM pendistribusian_uang_wakaf ";
                $result_distribution = $conn->query($query_wakaf_distribution);
                if($result_distribution->num_rows > 0 ) {
                $total_distribution_wakaf_uang = $result_distribution->fetch_assoc();
                    echo"".$total_distribution_wakaf_uang['TOTAL_DISTRIBUTION'] . "";
                  }
                 ?><?php echo'</h3>

                <p>Yang di Distribusikan</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="index.php?page=pendistribusian_uang_wakaf" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
    
<div class="nav-tabs">
    <ul class="nav nav-tabs pull-right" id="myTab">
        <li><a href="myChart" data-toggle="tab">Income</a></li>
        <li class="pull-left header"><i class="fa fa-inbox"></i> Grafik</li>
    </ul>
    <div class="tab-content no-padding relative">
      <canvas id="myChart" width="50" height="25"></canvas>
</div>

</div>

		</div>
        </div>';

		break;
	}

	
?>
<script>
  fetch('/wakaf/value_dashboard.php')
  .then(res => res.json())
  .then(json => {
    console.log(json); 

    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: json.labels,
        datasets: [{
          label: 'Total yang di distribusikan berdasarkan%',
          data: json.data,
          backgroundColor: 'rgba(54,162,235,0.6)',
          borderColor: 'rgba(54,162,235,1)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  });

</script>



              <!--<table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
					<th>No</th>
						<th>AAA</th>
						<th>Action</th>
                </tr>
                </thead>
                <tbody>";
				$query = "SELECT * FROM dashboard ";
				$sql_kul = mysqli_query($conn, $query);
				$fd_kul = mysqli_num_rows($sql_kul);
				
				if($fd_kul > 0)
				{
					$no =  1;
					while ($m = mysqli_fetch_assoc($sql_kul)) {
						echo"<tr>
						
							<td>$no</td>
							<td>$m[aaa]</td>
							<td><a href='index.php?page=dashboard&act=form&id=$m[id_dashboard]'><i class='fa fa-pencil-square w3-large w3-text-blue'></i></a> 
							<a href='$aksi?page=dashboard&act=hapus&id=$m[id_dashboard]' onclick=\"return confirm('Are You sure want to delete?');\"><i class='fa fa-trash w3-large w3-text-red'></i></a></td>
						
						</tr>";
						$no++;
					}
				}
				else
				{
					echo"<tr>
						<td colspan='3'><div class='w3-center'><i>Data dashboard Not Found.</i></div></td>
					</tr>";
				}
				
				
                echo "</tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
          </div>-->