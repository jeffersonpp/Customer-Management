mapboxgl.accessToken = mapbox_token;

  let map = new mapboxgl.Map({
    style: 'mapbox://styles/mapbox/light-v10',
    center: [-74.0066, 40.7135],
    zoom: 9,
    pitch: 45,
    bearing: -17.6,
    container: 'map_show',
    antialias: true
    });


  let geocoder = new MapboxGeocoder({ // Initialize the geocoder
        accessToken: mapboxgl.accessToken, // Set the access token
        mapboxgl: mapboxgl, // Set the mapbox-gl instance
        marker: false, // Do not use the default marker style
        placeholder: 'Insert Address Here', // Placeholder text for the search bar
          });
      
      // Add the geocoder to the map
      map.addControl(geocoder);
      
  let canvas = map.getCanvasContainer();

    map.on('load', function() {
    let layers = map.getStyle().layers;     
    let labelLayerId;
    for (let i = 0; i < layers.length; i++) {
    if (layers[i].type === 'symbol' && layers[i].layout['text-field']) {
    labelLayerId = layers[i].id;
    break;
    }
    }
     
    map.addLayer(
    {
    'id': '3d-buildings',
    'source': 'composite',
    'source-layer': 'building',
    'filter': ['==', 'extrude', 'true'],
    'type': 'fill-extrusion',
    'minzoom': 12,
    'paint': {
    'fill-extrusion-color': '#CCF',
    'fill-extrusion-height': [
        'interpolate',
        ['linear'],
        ['zoom'],
        12,
        0,
        13,
        ['get', 'height']
    ],
    'fill-extrusion-base': [
        'interpolate',
        ['linear'],
        ['zoom'],
        12,
        0,
        13,
        ['get', 'min_height']
    ],
    'fill-extrusion-opacity': 0.75
    }
    },
    labelLayerId
    );
    });

    map.on('load', function() {
        map.addSource('single-point', {
          type: 'geojson',
          data: {
            type: 'FeatureCollection',
            features: []
          }
        });
      
        map.addLayer({
          id: 'point',
          source: 'single-point',
          type: 'circle',
          paint: {
            'circle-radius': 10,
            'circle-color': '#448ee4'
          }
        });

        geocoder.on('result', function(e) {
          map.getSource('single-point').setData(e.result.geometry);
            setAddress(e.result["place_name_en-US"]);
            setLatLong(e.result["center"]);
            setCity(e.result.context);
        });
      });

let coordinates = document.getElementById("latlong");

      function setAddress(value)
      {
    let address = document.getElementById("address");
        address.value = value;
      }
      function setLatLong(value)
      {
        coordinates.value = JSON.stringify(value);
      }
      function setCity(context)
      {
        let city = "unknown";
        let region = "unknown";
        let country = "unknown";
        for(let i=0;i<context.length;i++)
        {
            if(context[i].id.split(".")[0]==="place")        city = context[i].text;
            else if(context[i].id.split(".")[0]==="region") region = context[i].text;
            else if(context[i].id.split(".")[0]==="country")country = context[i].short_code;
        }

        document.getElementById("city").value = city+";"+region+";"+country;
      }

      function setEditMap()
      {
          let lastPlace = JSON.parse(document.getElementById("latlong").value);

          new mapboxgl.Marker()
          .setLngLat(lastPlace)
          .setPopup(new mapboxgl.Popup({ offset: 17 }) // add popups
            .setHTML('<h6>Current Address </h6><p>'+document.getElementById("address").value+'</p>'))
          .addTo(map);
          map.setCenter(lastPlace);
          map.setZoom(16);
                let address = document.getElementById("address").value;
                let tg = document.getElementsByClassName("mapboxgl-ctrl-geocoder--input");
                    tg[0].value = address;
      }
//////////////////////////// TO DRAG
  var geojson = {
    'type': 'FeatureCollection',
    'features': [
      {
      'type': 'Feature',
      'geometry': {
        'type': 'Point',
        'coordinates': [0, 0]
        }
      }
    ]
    };
  
  function onMove(e) {
  var coords = e.lngLat;
    
  canvas.style.cursor = 'grabbing';
  geojson.features[0].geometry.coordinates = [coords.lng, coords.lat];
  map.getSource('single-point').setData(geojson);
  }
    
  const onUp =(e)=>{
  var coords = e.lngLat;
    coordinates.value = JSON.stringify([coords.lng, coords.lat]);
  vinculateAddress();
  canvas.style.cursor = 'default';
  map.off('mousemove', onMove);
  map.off('touchmove', onMove);
  }

  map.on('mouseenter', 'point', function() 
  {
    map.setPaintProperty('point', 'circle-color', '#3bb2d0');
    canvas.style.cursor = 'move';
  });

  map.on('mouseleave', 'point', function() 
  {
    map.setPaintProperty('point', 'circle-color', '#6699CC');
    canvas.style.cursor = 'default';
  });
   
  map.on('mousedown', 'point', function(e) {
  e.preventDefault();
  canvas.style.cursor = 'grab';
    map.on('mousemove', onMove);
    map.once('mouseup', onUp);
  });
   
  map.on('touchstart', 'point', function(e) {
  if (e.points.length !== 1) return;
  e.preventDefault();
  map.on('touchmove', onMove);
  map.once('touchend', onUp);
  });

  function vinculateAddress()
  {
    let address = document.getElementById("address");
    address.type="text";
    address.className = "display_address";
    address.placeholder = "Please Write Correct Address Here!";
    address.title = "Please Write Correct Address Here!";
  }