/**
 * CSV file check
**/
var airport_file_check = document.getElementById('airport_file_upload');
if(airport_file_check) {
  airport_file_check.onchange = function(e) {
    var ext = this.value.match(/\.([^\.]+)$/)[1];
    switch (ext) {
      case 'csv':
        document.getElementById('airport_file_submit').click();
        break;
      default:
        alert('Sorry! That type of file is not allowed. Please upload a CSV file only.');
        this.value = '';
    }
  };
}


/**
 * Google Maps JS
 * Creates Landing Page background map and single post map with markers
 */

function initMap() {
  //define styles array
  const gmapStyles = [
    {
      "featureType": "all",
      "elementType": "labels.text.fill",
      "stylers": [
        {
          "color": "#ffffff"
        },
        {
          "weight": "0.20"
        },
        {
          "lightness": "28"
        },
        {
          "saturation": "23"
        },
        {
          "visibility": "off"
        }
      ]
    },
    {
      "featureType": "all",
      "elementType": "labels.text.stroke",
      "stylers": [
        {
          "color": "#494949"
        },
        {
          "lightness": 13
        },
        {
          "visibility": "off"
        }
      ]
    },
    {
      "featureType": "all",
      "elementType": "labels.icon",
      "stylers": [
        {
          "visibility": "off"
        }
      ]
    },
    {
      "featureType": "administrative",
      "elementType": "geometry.fill",
      "stylers": [
        {
          "color": "#000000"
        }
      ]
    },
    {
      "featureType": "administrative",
      "elementType": "geometry.stroke",
      "stylers": [
        {
          "color": "#144b53"
        },
        {
          "lightness": "-11"
        },
        {
          "weight": 1.4
        },
        {
          "visibility": "on"
        }
      ]
    },
    {
      "featureType": "landscape",
      "elementType": "all",
      "stylers": [
        {
          "color": "#08304b"
        },
        {
          "lightness": "-13"
        }
      ]
    },
    {
      "featureType": "poi",
      "elementType": "geometry",
      "stylers": [
        {
          "color": "#000203"
        },
        {
          "lightness": "14"
        }
      ]
    },
    {
      "featureType": "road.highway",
      "elementType": "geometry.fill",
      "stylers": [
        {
          "color": "#000000"
        }
      ]
    },
    {
      "featureType": "road.highway",
      "elementType": "geometry.stroke",
      "stylers": [
        {
          "color": "#010304"
        },
        {
          "lightness": 25
        },
        {
          "visibility": "off"
        }
      ]
    },
    {
      "featureType": "road.arterial",
      "elementType": "geometry.fill",
      "stylers": [
        {
          "color": "#000000"
        }
      ]
    },
    {
      "featureType": "road.arterial",
      "elementType": "geometry.stroke",
      "stylers": [
        {
          "color": "#0b3d51"
        },
        {
          "lightness": 16
        }
      ]
    },
    {
      "featureType": "road.local",
      "elementType": "geometry",
      "stylers": [
        {
          "color": "#000000"
        }
      ]
    },
    {
      "featureType": "transit",
      "elementType": "all",
      "stylers": [
        {
          "color": "#146474"
        }
      ]
    },
    {
      "featureType": "water",
      "elementType": "all",
      "stylers": [
        {
          "color": "#021019"
        }
      ]
    }
  ];

  // define map center
  const center_usa = { lat: 39.809995, lng: -98.557046 };

  // Create a new StyledMapType object, passing it an array of styles,
  // and the name to be displayed on the map type control.
  const styledMapType = new google.maps.StyledMapType(
    gmapStyles,
    { name: 'Styled Map' }
  );

  // Create a map object
  const map = new google.maps.Map(document.getElementById('map'), {
    center: center_usa,
    zoom: 5,
    disableDefaultUI: true,
    gestureHandling: 'none',
    zoomControl: false,
  });

  // Create markers.
  if(typeof go_airports !== 'undefined' && go_airports.length > 0) {
    var bounds = new google.maps.LatLngBounds();
    for (let i = 0; i < go_airports.length; i++) {
      const marker = new google.maps.Marker({
        position: new google.maps.LatLng(go_airports[i].lat, go_airports[i].lng),
        icon: directory_uri.stylesheet_directory_uri + '/inc/img/marker.png',
        map: map,
      });
      const infoWindow = new google.maps.InfoWindow({
          content: '<div id="airport_window" class="py-1 ps-1 pe-4"><h6 id="airport_window-title" class="mb-1">'+go_airports[i].name+'</h6><p id="airport_window-body" class="mb-0 h6 fw-normal">'+go_airports[i].lat+', '+go_airports[i].lng+'</p></div>',
      });
      marker.addListener('click', function() {
        infoWindow.open(map, marker);
      });
      bounds.extend(marker.position);
    }
    map.fitBounds(bounds);
  }

  //Associate the styled map with the MapTypeId and set it to display.
  map.mapTypes.set('styled_map', styledMapType);
  map.setMapTypeId('styled_map');

}

window.initMap = initMap;

/**
 * CSV file check
**/
var airport_file_check = document.getElementById('airport_file_upload');
if(airport_file_check) {
  airport_file_check.onchange = function(e) {
    var ext = this.value.match(/\.([^\.]+)$/)[1];
    switch (ext) {
      case 'csv':
        document.getElementById('airport_file_submit').click();
        break;
      default:
        alert('Sorry! That type of file is not allowed. Please upload a CSV file only.');
        this.value = '';
    }
  };
}