$(function(){

  $('#fullpage').fullpage({
		//options here
		autoScrolling:true,
		scrollHorizontally: true,
	});
})


function initAutocomplete() {
  var map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 37.5400456, lng: 126.9921017 },
    zoom: 14,
    mapTypeId: "roadmap",
  });

  // search box를 만들고 UI element에 연결
  var input = document.getElementById("pac-input");
  var searchBox = new google.maps.places.SearchBox(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  // SearchBox 결과가 현재 맵의 viewport에 보여짐 (해당 위치로 viewport 이동)
  map.addListener("bounds_changed", function () {
    searchBox.setBounds(map.getBounds());
  });

  var markers = [];
  // 사용자가 장소에 대한 더 많은 정보를 얻으려 아이콘 선택시, 이벤트 발생
  searchBox.addListener("places_changed", function () {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

    // 예전의 marker들을 지움
    markers.forEach(function (marker) {
      marker.setMap(null);
    });
    markers = [];

    // 각각의 장소에 대해 icon, name, location 정보를 가져옴.
    var bounds = new google.maps.LatLngBounds();
    places.forEach(function (place) {
      if (!place.geometry) {
        console.log("Returned place contains no geometry");
        return;
      }
      var icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25),
      };

      // 각각의 장소에 marker를 생성
      markers.push(
        new google.maps.Marker({
          map: map,
          icon: icon,
          title: place.name,
          position: place.geometry.location,
        })
      );

      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    map.fitBounds(bounds);
    
  });
  const malls = [
    { label: "A", name: "충장로 광주극장", lat: 35.15, lng: 126.9125 },
    { label: "B", name: "소마드로잉카페", lat: 35.1476, lng: 126.9145 },
    { label: "C", name: "레드버튼", lat: 35.1469, lng: 126.9165 },
    { label: "D", name: "레드vr", lat: 35.1474, lng: 126.918 },
    { label: "E", name: "무등산 카페얼씨", lat: 35.1647, lng: 126.8711 },
    { label: "F", name: "롯데월드", lat: 37.5112, lng: 127.0983,}
  ];
  const bounds = new google.maps.LatLngBounds();
  const infowindow = new google.maps.InfoWindow();

  malls.forEach(({ label, name, lat, lng }) => {
    const marker = new google.maps.Marker({
      position: { lat, lng },
      label,
      map: map
    });
    bounds.extend(marker.position);

    marker.addListener("click", () => {
      map.panTo(marker.position);
      infowindow.setContent(name);
      infowindow.open({
        anchor: marker,
        map
      });
    });
    //클릭시 마커부분으로 줌인 sibal 찾기 개힘드네
    if(marker)
{
  marker.addListener('click', function() {
    map.setZoom(15);
    map.setCenter(this.getPosition());
  });

  }
  });

  map.fitBounds(bounds);
};