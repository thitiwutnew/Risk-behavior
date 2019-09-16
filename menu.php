<ul class="sidebar navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="main.php">
            <i class="fas fa-fw fa-home"></i>
            <span>หน้าแรก</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-users"></i>
            <span>พนักงาน</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="viewpersonal.php">ดูข้อมูล</a>
            <a class="dropdown-item" href="editpersonal.php">แก้ไขข้อมูล</a>
            <a class="dropdown-item" href="addpersonal.php">เพิ่มข้อมูล</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-fw fa-folder"></i>
              <span>ผู้มีพฤติกรรมเสี่ยง </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
              <a class="dropdown-item" href="view-risk-behavior.php">ดูข้อมูล</a>
              <a class="dropdown-item" href="edit-risk-behavior.php">แก้ไขข้อมูล</a>
          </li>
        <?php 
          session_start();
         if( $_SESSION['user_status']=="Administrator"){
        ?>
        <li class="nav-item">
          <a class="nav-link" href="report.php">
            <i class="fas fa-fw fa-calendar-minus"></i>
            <span>ออกรายงาน</span></a>
        </li>
          <?php }?>
      </ul>