<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Shielde-de</title>
    <?php
    include "head.html";
    ?>
      <link rel="stylesheet" href="css/map.css">
      <style>
        p{font-size: 10px;}
      </style>
</head>
<body>
<header>
    <?php
    include "header.php";
    ?>
  </header>
  <p class="mt-4 pt-5 float-end" style="float:left; position:fixed; z-index:999;">
    <button type="button" class="btn btn-primary" id="getMyPositionBtn" onclick="getCurrentPosBtn()">내 위치 가져오기<br><p>호스팅 사이트 문제로 위치정보 공유가 안됨.</p></button>
</p>
<div id="map" style="width:100%;height:100%;"></div>

<script type="text/javascript" src="https://dapi.kakao.com/v2/maps/sdk.js?appkey=2d7933c2b6f45f737d9cea3d826f1c06&libraries=services"></script>
<script>
var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
    mapOption = {
        center: new kakao.maps.LatLng(33.450701, 126.570667), // 지도의 중심좌표
        level: 12 // 지도의 확대 레벨
    };  

// 지도를 생성합니다    
var map = new kakao.maps.Map(mapContainer, mapOption); 


<?php $sql="select * from company";
        $result = mysqli_query($conn,$sql);
        while($com=mysqli_fetch_array($result)){ ?>
// 주소-좌표 변환 객체를 생성합니다.
var geocoder<?=$com['c_num']?> = new kakao.maps.services.Geocoder();
// 주소로 좌표를 검색합니다
geocoder<?=$com['c_num']?>.addressSearch('<?=$com['c_address']?>', function(result, status) {

    // 정상적으로 검색이 완료됐으면 
     if (status === kakao.maps.services.Status.OK) {

        var coords<?=$com['c_num']?> = new kakao.maps.LatLng(result[0].y, result[0].x);

        // 결과값으로 받은 위치를 마커로 표시합니다
        var marker<?=$com['c_num']?> = new kakao.maps.Marker({
            map: map,
            position: coords<?=$com['c_num']?>
        });

        // 인포윈도우로 장소에 대한 설명을 표시합니다
        var infowindow<?=$com['c_num']?> = new kakao.maps.InfoWindow({
            content: '<div class="form-control rounded-pill" style="width:150px;text-align:center;"><?=$com["c_name"]?></div>'
        });
        infowindow<?=$com['c_num']?>.open(map, marker<?=$com['c_num']?>);

        // 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
        map.setCenter(coords300002);
    } 
});    

<?php } ?>



</script>

<script>
    if (navigator.geolocation) {
    
    // GeoLocation을 이용해서 접속 위치를 얻어옵니다
    function getCurrentPosBtn(){
    navigator.geolocation.getCurrentPosition(function(position) {
        
        var lat = position.coords.latitude, // 위도
            lon = position.coords.longitude; // 경도
        
        var locPosition = new kakao.maps.LatLng(lat, lon), // 마커가 표시될 위치를 geolocation으로 얻어온 좌표로 생성합니다
            message = '<div style="padding:5px;">현재위치!</div>'; // 인포윈도우에 표시될 내용입니다
        
        // 마커와 인포윈도우를 표시합니다
        displayMarker(locPosition, message);
            
      });
    };
    
} else { // HTML5의 GeoLocation을 사용할 수 없을때 마커 표시 위치와 인포윈도우 내용을 설정합니다
    function getCurrentPosBtn(){
    var locPosition = new kakao.maps.LatLng(33.450701, 126.570667),    
        message = 'geolocation을 사용할수 없어요..'
        
    displayMarker(locPosition, message);
}
};
// 지도에 마커와 인포윈도우를 표시하는 함수입니다
function displayMarker(locPosition, message) {

    // 마커를 생성합니다
    var marker = new kakao.maps.Marker({  
        map: map, 
        position: locPosition
    }); 
    
    var iwContent = message, // 인포윈도우에 표시할 내용
        iwRemoveable = true;

    // 인포윈도우를 생성합니다
    var infowindow = new kakao.maps.InfoWindow({
        content : iwContent,
        removable : iwRemoveable
    });
    
    // 인포윈도우를 마커위에 표시합니다 
    infowindow.open(map, marker);
    
    // 지도 중심좌표를 접속위치로 변경합니다
    map.setCenter(locPosition);      
}    
</script>

</body>
</html>