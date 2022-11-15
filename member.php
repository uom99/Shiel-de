<?php 
  include "config.php";
  include "conn.php";
 
  // 현재 페이지 번호를 확인
  if (isset($_GET["page"]))
		$page = $_GET["page"]; //1,2,3,4,5
	else
		$page = 1;
?>

<head>
<?php include_once "head.html"; ?>

</head>

<body>
  <header>
    <?php include_once "header.php"; ?>
  </header>
  <div class="container-fluid mt-5 pt-5">
    <h2>회원관리 페이지</h2>       
    <div class="float-end">
      <label for="p_login">개인<input type="radio" name="login_ck" id="p_login" value="person" class="form-check-input login_ck" checked> </label>
      &ensp;&ensp;&ensp;&ensp;&ensp;
      <label for="c_login">기업<input type="radio" name="login_ck" id="c_login" value="company" class="form-check-input login_ck"> </label>
      </div>

    <form action="" method="get">

    </form>
    <table class="table table-bordered person_table">
      <thead>
        <tr>
          <th width="120">회원번호</th>
          <th>이름</th>
          <th>닉네임</th>
          <th>아이디</th>
          <th>휴대폰번호</th>
          <th>주소</th>
          <th>생년월일</th>
          <th width="120">역할</th>
          <th width="80">수정</th>
          <th width="80">삭제</th>
      </thead>
      <tbody>
        <?php 
          $sql1 = "select * from user;";
          $result = mysqli_query($conn,$sql1);
          while($m_user = $result->fetch_array()){

            if($m_user['role']=='1'){
              $m_user['role'] = '관리자';
            }
            else{
              $m_user['role'] = '일반';
            }
        ?>
        <form action="member_modify.php" method="get">
        <tr>
          <td><input type="text" name="num" class="form-control" value="<?=$m_user['number'];?>"></td>
          <td><input type="text" name="name" class="form-control" value="<?=$m_user['uname'];?>"></td>
          <td><input type="text" name="nick" class="form-control" value="<?=$m_user['nick'];?>"></td>
          <td><input type="text" name="id" class="form-control" value="<?=$m_user['id'];?>"></td>
          <td><input type="text" name="tel" class="form-control" value="<?=$m_user['phone'];?>"></td>
          <td><input type="text" name="add" class="form-control" value="<?=$m_user['address'];?>, <?=$m_user['add_detail'];?>"></td>
          <td><input type="text" name="birthday" class="form-control" value="<?=$m_user['birthday'];?>"></td>
          <td><input type="text" name="role" class="form-control" value="<?=$m_user['role'];?>"></td>
          <td><button class="form-control text-primary">수정</button></td>
          <td><button type="button" onclick="location.href='member_delete.php?num=<?=$m_user['number'];?>&role=<?=$m_user['role'];?>'" class="form-control text-danger">삭제</button></td>
        </tr>
      </form>
        <?php
          }
        ?>
      </tbody>
    </table>

    <table class="table table-bordered company_table " style="display:none">
      <thead>
        <tr>
          <th width="120">회원번호</th>
          <th>회사명</th>
          <th>사업자번호</th>
          <th>닉네임</th>
          <th>아이디</th>
          <th>휴대폰번호</th>
          <th>주소</th>
          <th width="120">역할</th>
          <th width="80">수정</th>
          <th width="80">삭제</th>
      </thead>
      <tbody>
        <?php 
          $sql1 = "select * from company;";
          $result1 = mysqli_query($conn,$sql1);
          while($m_user = $result1->fetch_array()){

            if($m_user['c_role']=='3'){
              $m_user['c_role'] = '기업';
            }
            
        ?>
        <form action="member_modify.php" method="get">
        <tr>
          <td><input type="text" name="num" class="form-control" value="<?=$m_user['c_num'];?>"></td>
          <td><input type="text" name="name" class="form-control" value="<?=$m_user['c_name'];?>"></td>
          <td><input type="text" name="bnum" class="form-control" value="<?=$m_user['c_bnum'];?>"></td>
          <td><input type="text" name="nick" class="form-control" value="<?=$m_user['c_nick'];?>"></td>
          <td><input type="text" name="id" class="form-control" value="<?=$m_user['c_id'];?>"></td>
          <td><input type="text" name="tel" class="form-control" value="<?=$m_user['c_tel'];?>"></td>
          <td><input type="text" name="add" class="form-control" value="<?=$m_user['c_address'];?>, <?=$m_user['c_add_detail'];?>"></td>
          <td><input type="text" name="role" class="form-control" value="<?=$m_user['c_role'];?>"></td>
          <td><button type="submit" class="form-control text-primary">수정</button></td>
          <td><button type="button" onclick="location.href='member_delete.php?num=<?=$m_user['c_num'];?>&role=<?=$m_user['c_role'];?>'" class="form-control text-danger">삭제</button></td>
        </tr>
        </form>
        <?php
          }
        ?>
      </tbody>
    </table>
  </div>
  <script>
    $(document).ready(function() {
    $('.login_ck').change(function() {
      var result = $('input[name="login_ck"]:checked').val()

      if (result == 'person') {
        $('.person_table').show();
        $('.company_table').hide();
        
        
      } 
      else{
        $('.company_table').show();
        $('.person_table').hide();
      }
  
    }); 
  }); 
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
crossorigin="anonymous"></script>
<script src="js/jquery-3.6.1.min.js"></script>
</body>