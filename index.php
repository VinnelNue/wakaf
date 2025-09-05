  <?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    session_start();

    include "session.php";
    require_once "lib/conn.php";
    require_once "lib/config.php";
    include 'script.php';

  ?>
<!DOCTYPE html>
<html>
<head>
  <style>
  .content-wrapper{
    background: rgba(157, 218, 237, 0.8);
    
  }

  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
   <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>E</b>AS</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>YAYASAN </b>EAS</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
            <?php
$id_user = $_SESSION['login_id'];
$query = "
    SELECT u.*, s.photo_profil 
    FROM user u
    LEFT JOIN setting s ON u.id_user = s.id_user
    WHERE u.id_user = ?
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();
$data_user = $result->fetch_assoc();

$photo = !empty($data_user['photo_profil']) ? $data_user['photo_profil'] : 'image-not-found.png';
?>

<img src="pages/setting/uploads_profil/<?php echo htmlspecialchars($photo); ?>"
     class="user-image"
     alt="User Image"
     style="max-width: 100px; max-height: 100px;"
     onerror="this.onerror=null;this.src='image-not-found.png';">

              <span class="hidden-xs"><?php echo $_SESSION['nama'];?></span>
            </a> 
            <ul class="dropdown-menu">
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
<?php
// main menu dashboard
$sql_dashboard = mysqli_query($conn, "SELECT * FROM menu WHERE Design = 'dashboard' ORDER BY id_menu ASC");
while ($mn = mysqli_fetch_assoc($sql_dashboard)) {
    // Header 
    echo "<li class='header'>{$mn['nama_menu']}</li>";
    
    // Submenu 
    $sql_sub = mysqli_query($conn, "SELECT * FROM modul 
            WHERE id_menu = '{$mn['id_menu']}' ORDER BY posisi ASC");
    while ($sm = mysqli_fetch_assoc($sql_sub)) {
        echo "
        <li>
            <a href='{$sm['link_menu']}'>
                <i class='{$sm['icon_menu']}'></i> <span>{$sm['nama_modul']}</span>
            </a>
        </li>";
    }
}
 echo "<li class='header'>Treeview</li>";

// Pertama tampilkan semua menu Treeview
$sql_treeview = mysqli_query($conn, "SELECT * FROM menu WHERE Design = 'Treeview' ORDER BY posisi ASC");
while ($mn = mysqli_fetch_assoc($sql_treeview)) {
    echo "
    <li class='treeview'>
        <a href='#'>
            <i class='fa fa-certificate'></i> <span>{$mn['nama_menu']}</span>
            <span class='pull-right-container'>
                <i class='fa fa-angle-left pull-right'></i>
            </span>
        </a>
        <ul class='treeview-menu'>";
    
    $sql_sub = mysqli_query($conn, "SELECT * FROM modul 
            WHERE id_menu = '{$mn['id_menu']}' ORDER BY posisi ASC");
    while ($sm = mysqli_fetch_assoc($sql_sub)) {
        echo "<li><a href='{$sm['link_menu']}'><i class='{$sm['icon_menu']}'> {$sm['nama_modul']}</i></a></li>";
    }
    
    echo "</ul></li>";
}


// Kemudian tampilkan semua menu Sidebar
$sql_sidebar = mysqli_query($conn, "SELECT * FROM menu WHERE Design = 'Sidebar' ORDER BY id_menu ASC");
while ($mn = mysqli_fetch_assoc($sql_sidebar)) {
    // Header sidebar
    echo "<li class='header'>{$mn['nama_menu']}</li>";
    
    // Submenu sidebar (jika ada)
    $sql_sub = mysqli_query($conn, "SELECT * FROM modul 
            WHERE id_menu = '{$mn['id_menu']}' ORDER BY posisi ASC");
    while ($sm = mysqli_fetch_assoc($sql_sub)) {
        echo "
        <li>
            <a href='{$sm['link_menu']}'>
                <i class='{$sm['icon_menu']}'></i> <span>{$sm['nama_modul']}</span>
            </a>
        </li>";
    }
}
 echo "<li class='header'>.....</li>";

?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES, 'UTF-8');
    $comment = htmlspecialchars($_POST['comment'] ?? '', ENT_QUOTES, 'UTF-8');
} else {
    $name = '';
    $comment = '';
}
?>

      </ul>
    </section>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
            
      <!-- Small boxes (Stat box) -->
      <div class="row">
        
          <?php
            include "content.php";
          ?>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer " >
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong></a>.</strong> All rights
    reserved.
  </footer>
<?php
    include "script_under.php";
?>

</body>
</html>