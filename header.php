<?php include_once "config.php" ?>
<?php include_once "login_check.php" ?>
<?php include "conn.php"?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


<script src="js/header.js"></script>

<nav id="header" class="navbar navbar-expand-lg navbar-light bg-light fixed-top w-100"
  aria-label="Fifth navbar example" style="background-color:#ddffdd">
  <div class="container-fluid">
  <a class="navbar-brand " href="index.php"><img src="./imgs/logo11.png" alt="로고" aria-current="page" class="img-fluid "></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
      aria-controls="navbarText" aria-expanded="true" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse ms-0 " id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto text-center">
        <li class="nav-item">
          <a class="nav-link fw-bold text-secondary text-opacity-50" href="Recommendation_map.php">검색</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-bold text-secondary text-opacity-50" href="loading.php">추천</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-bold text-secondary text-opacity-50" href="board.php">커뮤니티</a>
        </li>
        <li class="nav-item">
          <?php 
          
          switch($role){
            case '0':
              ?>
              <a class="nav-link fw-bold text-secondary text-opacity-50" href="mypage.php">마이페이지</a>
              <?php break;
            case '1':
              ?>
              <a class="nav-link fw-bold text-secondary text-opacity-50" href="mypage.php">마이페이지</a>
              <?php break;

            default:
              ?>
              <a class="nav-link fw-bold text-secondary text-opacity-50" href="cpage.php">마이페이지</a>
              <?php
              break;

          }

          ?>
        </li>
        <?php 
          if($role == '1'){
            ?>
            <li class="nav-item">
          <a class="nav-link fw-bold text-secondary text-opacity-50" href="member.php">회원관리</a>
        </li>
            
            <?php
          }
        ?>
      </ul>
      <?php 
				if(!$userid){
			?>
      <span class="navbar-text">
        <form class="container-fluid justify-content-start">
          <a href="login.php" target="_self"><button class="btn btn-outline-success btn-lg me-2 px-4"
              style="width: 110px;" type="button">Login</button></a>
          <a href="signup_select.php"><button class="btn btn-lg btn-primary " type="button" style="width: 110px;">Sign
              up</button></a>
        </form>
      </span>

      <?php 
				}else if($userid){	
    
          if($role == '3'){
            $mp_sql="SELECT * FROM company WHERE c_id='$userid'";
            $result = mysqli_query($conn,$mp_sql);
            $mp_user = mysqli_fetch_array($result);
            $logged = $mp_user['c_nick']."(".$mp_user['c_name'].")";
  }
            else{
              $mp_sql="SELECT * FROM user WHERE id='$userid'";
              $result = mysqli_query($conn,$mp_sql);
              $mp_user = mysqli_fetch_array($result);
              $logged = $mp_user['nick']."(".$mp_user['uname'].")";

    }

			?>
      <span class="navbar-text">
        <form class="container-fluid justify-content-start">
          <b><?php echo $logged; ?></b>님
          <a href="logout.php" target="_self" ><button class="btn btn-outline-danger btn me-2 px-4"
              style="width: 110px;" type="button">Logout</button></a>
        </form>
      </span>
      <?php }?>
    </div>
  </div>
</nav>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script> -->