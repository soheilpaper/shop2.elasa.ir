{if $page_name=='contact'}
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key={$googlemapkey}&sensor=true">
    </script>
    
    
<script type="text/javascript">
    //-->
    
    var googlemaprun = true; 
    
      function initialize() {
        var myOptions = {

          center: new google.maps.LatLng({$center}),
          zoom: {$zoom},
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"),
            myOptions);


        var marker = new google.maps.Marker({
        	  position: new google.maps.LatLng({$center}),
        	  map: map
        	});

    	

	        var infowindow = new google.maps.InfoWindow({
	            content: '<div id="mydiv">{$cloud}</div>',
	            maxWidth: 320
	            });
	

   	   google.maps.event.addListener(marker, 'click', function() {
          infowindow.open(map,marker);
          });

      infowindow.open(map,marker);

      }
    </script>
{/if}