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
      var point = new google.maps.LatLng(
          parseFloat(markers[i].getAttribute("latitude")),
          parseFloat(markers[i].getAttribute("longitude")));
      var html = "<center><b> Point " + id + " - " + name + "</b> <br/>" + description + "<br /> <img src=" + url + "></center>";
      var icon = customIcons[id] || {};
      var marker = new google.maps.Marker({
        map: map,
        position: point,
        icon: icon.icon
      });
      bindInfoWindow(marker, map, infoWindow, html);
    }
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

//]]>

