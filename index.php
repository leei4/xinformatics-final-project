<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">


  <title>X-informatics Group 6 Final</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">

</head>


<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Start Bootstrap </div>
      <div class="list-group list-group-flush">
        <a href="#" class="list-group-item list-group-item-action bg-light">Dashboard</a>
        <a href="SampleDatabase.php" class="list-group-item list-group-item-action bg-light">Query Test</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Events</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Profile</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Status</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">></button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid">

        <!-- Titles and date -->
        <center>
          <h1 class="mt-4">Please enter a date</h1>

          <!-- First date option -->
          <form action="/action_page.php">
            <label for="birthday">Birthday:</label>
            <input type="date" id="birthday" name="birthday">
            <input type="submit" value="Submit">
          </form>

          <!-- Second date option, will not save data upon refresh but looks pretty -->
          <!-- choose what is easiest -->
          <select name="DOBDay">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>

          </select>

    
          <select name="DOBMonth">
            <option value="January">January</option>
            <option value="February">February</option>
            <option value="March">March</option>
            <option value="April">April</option>
            <option value="May">May</option>

          </select>

          <select name="DOBYear">
            <option value="1947">1947</option>
            <option value="1948">1948</option>
            <option value="1949">1949</option>
            <option value="1950">1950</option>
            <option value="1951">1951</option>
          </select>

          <h1 class="mt-4">Flight Map of Albany International Airport</h1>
        </center>

        <div id="googleMap" style="width:100%;height:600px;"></div>
      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=geometry"></script>

  <!-- Menu Toggle Script -->
   <!--<script>
    function myMap() {
        var country = "United States"

        var myOptions = {
            zoom: 4,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
      
        var map = new google.maps.Map(document.getElementById("googleMap"),myOptions);

      var geocoder = new google.maps.Geocoder();
      geocoder.geocode( { 'address': country }, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          map.setCenter(results[0].geometry.location);
        } else {
          alert("Could not find location: " + location);
        }
      });
    }
  </script>-->

  <script>
    
    // This example requires the Geometry library. Include the libraries=geometry
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=geometry">

    var marker1, marker2;
    var poly, geodesicPoly;

    function initMap() {
      var map = new google.maps.Map(document.getElementById('googleMap'), {
        zoom: 4,
        center: {lat: 34, lng: -40.605}
      });

      map.controls[google.maps.ControlPosition.TOP_CENTER].push(
          document.getElementById('info'));

      marker1 = new google.maps.Marker({
        map: map,
        draggable: true,
        position: {lat: 40.714, lng: -74.006}
      });

      marker2 = new google.maps.Marker({
        map: map,
        draggable: true,
        position: {lat: 48.857, lng: 2.352}
      });

      var bounds = new google.maps.LatLngBounds(
          marker1.getPosition(), marker2.getPosition());
      map.fitBounds(bounds);

      google.maps.event.addListener(marker1, 'position_changed', update);
      google.maps.event.addListener(marker2, 'position_changed', update);

      poly = new google.maps.Polyline({
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 3,
        map: map,
      });

      geodesicPoly = new google.maps.Polyline({
        strokeColor: '#CC0099',
        strokeOpacity: 1.0,
        strokeWeight: 3,
        geodesic: true,
        map: map
      });

      update();
    }

    function update() {
      var path = [marker1.getPosition(), marker2.getPosition()];
      poly.setPath(path);
      geodesicPoly.setPath(path);
      var heading = google.maps.geometry.spherical.computeHeading(path[0], path[1]);
      document.getElementById('heading').value = heading;
      document.getElementById('origin').value = path[0].toString();
      document.getElementById('destination').value = path[1].toString();
    }
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=geometry&callback=initMap"
        async defer></script>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDoq-uDRTXb3LMBOOrEBXFSjw-n7XEoT2c&callback=myMap"></script>
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>
