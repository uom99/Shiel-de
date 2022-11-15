<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>geolocation으로 마커 표시하기</title>
    
</head>
<body>
<p style="margin-top:-12px">
    <b>Chrome 브라우저는 https 환경에서만 geolocation을 지원합니다.</b> 참고해주세요.
</p>
<div id="map" style="width:100%;height:350px;"></div>

<script type="text/javascript" src="https://dapi.kakao.com/v2/maps/sdk.js?appkey=2d7933c2b6f45f737d9cea3d826f1c06&libraries=services"></script>
<script>
var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
    mapOption = { 
        center: new kakao.maps.LatLng(33.450701, 126.570667), // 지도의 중심좌표
        level: 10 // 지도의 확대 레벨 
    }; 

var map = new kakao.maps.Map(mapContainer, mapOption); // 지도를 생성합니다

// HTML5의 geolocation으로 사용할 수 있는지 확인합니다 
function getLocation(position) {

var latitud = position.coords.latitude;
var longitude = position.coords.longitude;

var mapContainer = document.getElementById("map")    // 지도를 표시할 DIV
var mapOption = {
      center : new kakao.maps.LatLng(latitud, longitude)    // 지도의 중심좌표
    , level : 3    // 지도의 확대레벨
};

// 지도를 생성
var map = new kakao.maps.Map(mapContainer, mapOption);

// 마커가 표시될 위치
var markerPosition = new kakao.maps.LatLng(latitud, longitude);

// 마커를 생성
var marker = new kakao.maps.Marker({ position:markerPosition });

marker.setMap(map);
}

if(navigator.geolocation) {
navigator.geolocation.getCurrentPosition(getLocation, function(error) {
    consol.log(error.message);    
});
} else {
consol.log("Geolocation을 지원하지 않는 브라우저 입니다.");
}

</script>
</body>
</html>