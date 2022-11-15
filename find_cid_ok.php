<?php
  include "conn.php";

  $uname = $_POST['uname'];
  $phone = $_POST['phone'];

  $sql = "select * from company where (c_name='$uname' && c_tel='$phone');";

  $result = mysqli_query($conn,$sql);
  // $id_find = mysqli_fetch_array($result);
  $find = mysqli_num_rows($result);

  if(empty($find)){

    echo "<script> alert('다시 확인하세요'); 
                  history.back();
      </script> ";
  }
  else{

  ?>
  
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/modal.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Document</title>
</head>
<body class="bg-secondary">
 <div class="container">
 <div id="modal" class="modal-overlay">
        <div class="modal-window">
            <div class="title">
                <h2><?=$uname?>님의 아이디</h2>
            </div>
            <hr>
            <div class="close-area"></div>
            <div class="content">
                
                
                
     

<?php
  while($id_find = mysqli_fetch_array($result)){;

?>
<p><?=$id_find['c_id']?></p>
<?php
  }
?>
       </div>
       <button class="btn btn-secondary float-end" onclick="location.href='login.php'">돌아가기</button>
        </div>
    </div>
   
</div>


</body>
</html>
<?php } ?>