//code borrowed from Google https://developers.google.com/maps/articles/phpsqlajax_v3

window.onload = load;

var customIcons = {
    icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png'
};

function load() {
  var map = new google.maps.Map(document.getElementById("map"), {
    center: new google.maps.LatLng(52.4140, -4.0810),
    zoom: 13,
    mapTypeId: 'roadmap'
  });
  var infoWindow = new google.maps.InfoWindow;

  var line = [];
  // Change this depending on the name of your PHP file
  downloadUrl(document.URL + "&xml", function(data) {
    var xml = data.responseXML;
    var markers = xml.documentElement.getElementsByTagName("marker");
    for (var i = 0; i < markers.length; i++) {
      var id = markers[i].getAttribute("id");
      var walkId = markers[i].getAttribute("walkId");
      var name = markers[i].getAttribute("name");
      var description = markers[i].getAttribute("description");
      var url = markers[i].getAttribute("image");
      var poiNo = markers[i].getAttribute("poiNo");
      var point = new google.maps.LatLng(
          parseFloat(markers[i].getAttribute("latitude")),
          parseFloat(markers[i].getAttribute("longitude")));
      line.push(point);
      var html = "<center><b> Point " + poiNo + " - " + name + "</b> <br/>" + description + "<br /> <img width='100px' height='100px' src='http://users.aber.ac.uk/che16/php/server/uploads/" + url + "'></center>";
      var icon = customIcons[id] || {};
      var marker = new google.maps.Marker({
        map: map,
        position: point,
        icon: icon.icon
      });
      bindInfoWindow(marker, map, infoWindow, html);
    }
  //});

  //borrowed from http://forums.asp.net/t/1952508.aspx?Draw+lines+between+markers+on+Google+Map+
  var line2 = [
    new google.maps.LatLng(52.4140, -4.0810),
    new google.maps.LatLng(21.291982, -157.821856),
    new google.maps.LatLng(-18.142599, 178.431),
    new google.maps.LatLng(-27.46758, 153.027892)
  ];
  var linePath = new google.maps.Polyline({
    path: line,
    geodesic: true,
    strokeColor: '#78AB46',
    strokeOpacity: 1.0,
    strokeWeight: 2
  });
  
 linePath.setMap(map);
  });

}


 

function bindInfoWindow(marker, map, infoWindow, html) {
  google.maps.event.addListener(marker, 'click', function() {
    infoWindow.setContent(html);
    infoWindow.open(map, marker);
  });
}

function downloadUrl(url, callback) {
  var request = window.ActiveXObject ?
      new ActiveXObject('Microsoft.XMLHTTP') :
      new XMLHttpRequest;

  request.onreadystatechange = function() {
    if (request.readyState == 4) {
      request.onreadystatechange = doNothing;
      callback(request, request.status);
    }
  };

  request.open('GET', url, true);
  request.send(null);
}

function doNothing() {}
