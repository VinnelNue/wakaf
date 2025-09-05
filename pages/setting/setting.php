<?php
	if(!isset($_SESSION['login_user'])){
		header('location: ../../login.php'); // Mengarahkan ke Home Page
	}
		
	$id_user_login = $_SESSION['login_id'];
	//link buat paging
	$linkaksi = 'index.php?page=setting';

	if(isset($_GET['act']))
	{
		$act = $_GET['act'];
		$linkaksi .= '&act=$act';
	}
	else
	{
		$act = '';
	}

	$aksi = 'pages/setting/act_setting.php';

	switch ($act) {
		case 'form':
			if(!empty($_GET['id']))
			{
				$act = "$aksi?page=setting&act=edit";
				$query = mysqli_query($conn, "SELECT * FROM setting WHERE id_usr = '$_GET[id]'");
				$temukan = mysqli_num_rows($query);
				if($temukan > 0)
				{
					$c = mysqli_fetch_assoc($query);
				}
				else
				{
					header("location:index.php?page=setting");
				}

			}
			else
			{
				$act = "$aksi?page=setting&act=simpan";
			}

		echo"<div class='col-md-12'>
          <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'> setting</h3>
			</div>";
			
            echo"<form role='form'  method='POST' action='$act' enctype='multipart/form-data' >
              <div class='box-body'>
                <div class='form-group'>
                  
                  <input type='hidden' class='form-control' name='id' value='"?><?php echo isset($c['id_usr']) ? $c['id_usr'] : '';?><?php echo"'"?> <?php echo isset($c['id_usr']) ? ' readonly' : ' ';?><?php echo" >
								</div>
				 <div class='form-group'>
   				 <label>USERNAME</label>
   				 <select class='form-control' name='id_user'>"?><?php echo"
      		     <option value=''>-- Pilih WAKIF --</option>"?><?php
        
        // mengamil data dari tabel wakif
      			  $wakifQuery = mysqli_query($conn, "SELECT id_user, nama_lengkap FROM user");
       			  while ($row = mysqli_fetch_assoc($wakifQuery)) {
       		      $selected = (isset($c['id_user']) && $c['id_user'] == $row['id_user']) ? 'selected' : '';
        	      echo "<option value='{$row['id_user']}' $selected>{$row['nama_lengkap']}</option>";
        			}
       			 ?><?php echo"
   				 </select>
				</div>

					<div class='form-group'>
              		<label for='photo_profil'required>PHOTO PROFIL</label>
             		<input type='file' class='form-control' placeholder='Photo Profil' name='photo_profil' value='"?><?php echo isset($c['photo_profil']) ? $c['photo_profil'] : '';?><?php echo"'"?> <?php echo isset($c['photo_profil']) ? ' ' : ' ';?><?php echo" >
					<small class='text-muted'>Format JPG/PNG, max 2MB</small>
					</div>
					</div><div class='box-footer'>
					<button type='submit' class='btn btn-primary'>Submit</button> <button type='button' class='btn btn-primary' onclick='history.back()'><i class='fa fa-rotate-left'></i> Kembali</button>
				</div>
			  </div>			
            </form>
          </div>
        </div>
		";
		break;

		case 'form_register':
			if(!empty($_GET['id']))
			{
				$act = "$aksi?page=setting&act=edit_register";
				$query = mysqli_query($conn, "SELECT * FROM user WHERE id_user = '$_GET[id]'");
				$temukan = mysqli_num_rows($query);
				if($temukan > 0)
				{
					$c = mysqli_fetch_assoc($query);
				}
				else
				{
					header("location:index.php?page=setting");
				}

			}
			else
			{
				$act = "$aksi?page=setting&act=simpan_register";
			}

		echo"<div class='col-md-12'>
          <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'> setting</h3>
			</div>";
			
            echo"<form role='form'  method='POST' action='$act' enctype='multipart/form-data' >
              <div class='box-body'>
                <div class='form-group'>
                  
                  <input type='hidden' class='form-control' name='id' value='"?><?php echo isset($c['id_usr']) ? $c['id_usr'] : '';?><?php echo"'"?> <?php echo isset($c['id_usr']) ? ' readonly' : ' ';?><?php echo" >
								</div>

					<div class='form-group'><label >USERNAME</label>
					<input type='text' class='form-control' placeholder='Username' name='username' value='"?><?php echo isset($c['username']) ? $c['username'] : '';?><?php echo"'"?> <?php echo isset($c['username']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >PASSWORD</label>
					<input type='text' class='form-control' placeholder='Password' name='password' value='"?><?php echo isset($c['password']) ? $c['password'] : '';?><?php echo"'"?> <?php echo isset($c['password']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >NAMA LENGKAP</label>
					<input type='text' class='form-control' placeholder='Nama' name='nama' value='"?><?php echo isset($c['nama']) ? $c['nama'] : '';?><?php echo"'"?> <?php echo isset($c['nama']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'>
    				<label>LEVEL</label>
   					<select class='form-control' name='level' required>
       			    <option value=''>-- Level User --</option>
        			<option value='admin'"?><?php if(isset($c['admin']) && $c['admin'] == 'admin') echo 'selected'; ?><?php echo " > Admin"?></option><?php echo" >
        			<option value='sekertaris'"?><?php if(isset($c['sekertaris']) && $c['sekertaris'] == 'sekertaris') echo 'selected'; ?><?php echo" >Sekertaris"?></option><?php echo" >
					<option value='bendahara'"?><?php if(isset($c['bendahara']) && $c['bendahara'] == 'bendahara') echo 'selected'; ?><?php echo" >Bendahara"?></option><?php echo" >
 					<option value='user'"?><?php if(isset($c['user']) && $c['user'] == 'user') echo 'selected'; ?><?php echo" >User"?></option><?php echo" >
   </select>
</div>

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
		echo"
		<div class='col-xs-12'>
         <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>setting</h3><br/>
			  <small>setting</small><br/><br/>
			"?><?php 
		if ($_SESSION['level'] === 'admin') {
    // Admin lihat semua data
	echo"<a href='index.php?page=setting&act=form' class='w3-btn w3-big w3-blue' style='font-size:16px'><i class='fa fa-file'></i> ADD DATA</a>
		     ";
       echo" <p><a href='index.php?page=setting&act=form_register' class='w3-btn w3-big w3-blue' style='font-size:16px'><i class='fa fa-file'></i> ADD DATA USER</a>
		      </p>";
		} else {
    // hanya datanya sendiri
 	 echo" <a href='index.php?page=setting&act=form' class='w3-btn w3-big w3-blue' style='font-size:16px'><i class='fa fa-file'></i> ADD DATA</a>
		      ";
			} 
			  ?><?php echo"
			  </div>
            <div class='box-body'>
			 <div class='table-responsive'>
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
					<th>No</th>
						<th>NAMA LENGKAP</th>
						<th>USERNAME</th>
						<th>PASSWORD</th>
						"?><?php 
		if ($_SESSION['level'] === 'admin') {
   			echo"<th>LEVEL</th> ";
			echo"<th>LAST LOGIN</th> ";
		} else {echo" ";} 
			  ?><?php echo"
						<th>PHOTO PROFIL</th>
						<th>Action</th>
                </tr>
                </thead>
                <tbody>";

if ($_SESSION['level'] === 'admin') {
    // Admin lihat semua data
    $query = "SELECT setting.*, user.usernm, user.passwd, user.level, user.nama_lengkap, user.last_login 
              FROM setting 
              JOIN user ON setting.id_user = user.id_user";
} else {
    // hanya datanya sendiri
    $query = "SELECT setting.*, user.usernm, user.passwd, user.level, user.nama_lengkap 
              FROM setting 
              JOIN user ON setting.id_user = user.id_user 
              WHERE user.id_user = '$id_user_login'";
}
$sql_kul = mysqli_query($conn, $query);
$fd_kul = mysqli_num_rows($sql_kul);

if($fd_kul > 0)
{
    $no =  1;
    while ($m = mysqli_fetch_assoc($sql_kul)) {
        // Kalau admin bisa lihat password, user biasa tidak
        $passwd_display = ($_SESSION['level'] === 'admin') ? $m['passwd'] : '***';

        echo "<tr>
                <td>$no</td>
                <td>{$m['nama_lengkap']}</td>
                <td>{$m['usernm']}</td>
                <td>$passwd_display</td>
				"?><?php 
		if ($_SESSION['level'] === 'admin') {
     	    echo"<td>{$m['level']}</td>";
			 echo"<td>{$m['last_login']}</td>";
		} else {
 		  echo" ";
			} ?><?php echo"
                <td>{$m['photo_profil']}</td>
                <td>
                    <a href='index.php?page=setting&act=form&id={$m['id_usr']}'><i class='fa fa-pencil-square w3-large w3-text-blue'></i></a> 
                    <a href='$aksi?page=setting&act=hapus&id={$m['id_usr']}' onclick=\"return confirm('Are You sure want to delete?');\"><i class='fa fa-trash w3-large w3-text-red'></i></a>
                </td>
              </tr>";
        $no++;
    }
}
else
{
    echo "<tr>
            <td colspan='8'><div class='w3-center'><i>Data setting Not Found.</i></div></td>
          </tr>";
}
				
				
                echo "</tbody>
                <tfoot>
                </tfoot>
              </table>
			  </div>
            </div>
			
          </div>
        </div>";

		break;
	}

	
?>