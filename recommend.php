<?php 
  include "config.php";
  include "conn.php";
?>
<!DOCTYPE html>
<html lang="ko">

<head>
  <?php include_once "head.html"; ?>
  <style>
  .card-text {
    min-height: 100px;
    max-height: 100px;
  }
  </style>


  <script type="text/javascript"
    src="//dapi.kakao.com/v2/maps/sdk.js?appkey=2d7933c2b6f45f737d9cea3d826f1c06&libraries=services"></script>

</head>

<body>
  <header>
    <?php include_once "header.php"; ?>
  </header>
  <main id="">
    <div class="section" style="background-color:#aca193">

      <div class="album py-5">

        <div class="container">
          <h2 class="mt-5"><?=$usernick?>님을 위한 추천</h2>

          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mt-4">
            <?php 
        $sql="select * from company where c_address like '%광주%' order by rand() limit 6";
        $result = mysqli_query($conn,$sql);
        while($com=mysqli_fetch_array($result)){

        $bar = round((mt_rand(6000,10000)/100),2);
        $bar1 = rand();
        $bar2 = rand();
        $bar3 = rand();
        $bar4 = rand();

        $sum = $bar1+$bar2+$bar3+$bar4;

        $ba1 = round((($bar1*100)/$sum),2);
        $ba2 = round((($bar2*100)/$sum),2);
        $ba3 = round((($bar3*100)/$sum),2);
        $ba4 = round((($bar4*100)/$sum),2);
        ?>
            <div class="col">
              <div class="card shadow-sm">
                <div class="card-body" style="background-color: #f2e5d5">
                  <div id="map<?=$com['c_num']?>" style="width:100%; height:225px"></div>
                  <br>
                  <h5 class="card-title"><?=$com['c_name']?><?=$ss?></h5>
                  <p class="card-text"><?=$com['c_intro']?> </p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group mt-auto">
                      <button type="button" data-bs-toggle="modal" data-bs-target="#comdetailmodal<?=$com['c_num']?>"
                        class="btn btn-sm btn-outline-secondary">View</button>
                    </div>
                    <small class="text-muted"></small>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade" id="comdetailmodal<?=$com['c_num']?>" tabindex="-1"
              aria-labelledby="comdetailmodallabel<?=$com['c_num']?>" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="comdetailmodallabel<?=$com['c_num']?>"><?=$com['c_name']?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">

                    <img src="imgs/메인.jpg" alt="" style="width :100%; height: 250px">

                    <h5>업체위치 : <?=$com['c_address'];?></h5>
                    <h5>업체번호 : <?=$com['c_tel'];?></h5>
                    <br>
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-label="Segment one" style="width: <?=$bar?>%" aria-valuenow="<?=$bar?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="progress-info d-block">
                      <span class="text-primary">ai추천<?=$bar?>% </span>
                    </div>

                    <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-label="Segment one" style="width: <?=$ba1?>%"
                        aria-valuenow="<?=$ba1?>" aria-valuemin="0" aria-valuemax="100"></div>
                      <div class="progress-bar bg-success" role="progressbar" aria-label="Segment two"
                        style="width: <?=$ba2?>%" aria-valuenow="<?=$ba2?>" aria-valuemin="0" aria-valuemax="100"></div>
                      <div class="progress-bar bg-info" role="progressbar" aria-label="Segment three"
                        style="width: <?=$ba3?>%" aria-valuenow="<?=$ba3?>" aria-valuemin="0" aria-valuemax="100"></div>
                      <div class="progress-bar bg-warning" role="progressbar" aria-label="Segment three"
                        style="width: <?=$ba4?>%" aria-valuenow="<?=$ba4?>" aria-valuemin="0" aria-valuemax="100"></div>

                    </div>
                    <div class="progress-info d-block">
                      <span class="text-primary">관심사<?=$ba1?>% </span>
                      <span class="text-success">히스토리<?=$ba2?>% </span>
                      <span class="text-info">연령대<?=$ba3?>% </span>
                      <span class="text-warning">거리<?=$ba4?>% </span>
                    </div>
                  </div>
                  <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                </div>
              </div>
            </div>


            <script>
            var mapContainer<?=$com['c_num']?> = document.getElementById('map<?=$com['c_num']?>'), // 지도를 표시할 div 
              mapOption<?=$com['c_num']?> = {
                center: new kakao.maps.LatLng(33.450701, 126.570667), // 지도의 중심좌표
                level: 3 // 지도의 확대 레벨
              };

            // 지도를 표시할 div와  지도 옵션으로  지도를 생성합니다
            var map<?=$com['c_num']?> = new kakao.maps.Map(mapContainer<?=$com['c_num']?>, mapOption<?=$com['c_num']?>);

            // 주소-좌표 변환 객체를 생성합니다
            var geocoder<?=$com['c_num']?> = new kakao.maps.services.Geocoder();

            // 주소로 좌표를 검색합니다
            geocoder<?=$com['c_num']?>.addressSearch('<?=$com['c_address']?>', function(result, status) {

              // 정상적으로 검색이 완료됐으면 
              if (status === kakao.maps.services.Status.OK) {

                var coords<?=$com['c_num']?> = new kakao.maps.LatLng(result[0].y, result[0].x);

                // 결과값으로 받은 위치를 마커로 표시합니다
                var marker<?=$com['c_num']?> = new kakao.maps.Marker({
                  map: map<?=$com['c_num']?>,
                  position: coords<?=$com['c_num']?>
                });

                // 인포윈도우로 장소에 대한 설명을 표시합니다
                var infowindow<?=$com['c_num']?> = new kakao.maps.InfoWindow({
                  content: '<div style="width:150px;text-align:center;padding:6px 0;"><?=$com['c_name']?></div>'
                });
                infowindow<?=$com['c_num']?>.open(map<?=$com['c_num']?>, marker<?=$com['c_num']?>);

                // 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
                map<?=$com['c_num']?>.setCenter(coords<?=$com['c_num']?>);
              }
            });
            </script>

            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <div class="section fp-auto-height">
      <?php include_once "footer.html" ?>
    </div>

  </main>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>


</body>

</html>