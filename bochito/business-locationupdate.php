<!DOCTYPE html>
<!-- This site was created in Webflow. http://www.webflow.com-->
<!-- Last Published: Thu Jul 24 2014 04:37:54 GMT+0000 (UTC) -->
<html data-wf-site="53c4105d9f34a90d41826f44">
<head>
  <meta charset="utf-8">
  <title>playaurbana - Business profile</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
  <script>
    WebFont.load({
      google: {
        families: ["Exo:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic","Great Vibes:400","Open Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic"]
      }
    });
  </script>
  <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=true"></script>
  <script type="text/javascript" src="rideScript.js"></script>
  <script type="text/javascript" src="mapControl.js"></script>
  <script src="https://cdn.firebase.com/js/client/2.2.1/firebase.js"></script>
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js'></script>
  <link rel="shortcut icon" type="image/x-icon" href="https://daks2k3a4ib2z.cloudfront.net/placeholder/favicon.ico">
</head>
<body>
  <div class="w-nav main-nav towns" data-collapse="medium" data-animation="default" data-duration="400" data-contain="1">
    <div class="w-container">
      <a class="w-nav-brand main-logo-link" href="index.html">
        <img class="logo-image-in-town-listings" src="images/playa-urbana-watermark1-300x67.png" alt="53c417c53c85fcd863f39e3a_playa-urbana-watermark1-300x67.png">
      </a>
      <nav class="w-nav-menu menu-drop-down" role="navigation"><a class="w-nav-link main-nav-link town-name" href="index.html">Barra de Navidad</a><a class="w-nav-link main-nav-link towns" href="town-hotels.html">Hotels</a><a class="w-nav-link main-nav-link towns" href="town-restaurants.html">Restaurants</a><a class="w-nav-link main-nav-link towns"
        href="town-things-to-do.html">Things to do</a><a class="w-nav-link main-nav-link towns" href="login.php">Login</a>
      </nav>
      <div class="w-nav-button menu-button-mobile">
        <div class="w-icon-nav-menu"></div>
      </div>
    </div>
  </div>
  
  <div class="business-main-info-section">
  	   <div class="w-row business-info-row">
<script>
function activatefield(){
	document.getElementById('geolocation').removeAttribute('disabled');
}
</script>
      		<div class="w-col w-col-4">
        <label class="add-user-field-label" for="field-2">Location for:</label>
        	<div class="default-text">
            Help people find you easily! Provide an approximate location of your business in this map.
            </div>
      </div>
      <div class="w-col w-col-3">
      	<form class="w-clearfix buffer-inserted" id="newrestaurantform" name="email-form" data-name="Email Form" method="post" action="business-locationupdate.php?bi=<?php echo $_GET['id'] ?>" enctype="multipart/form-data">
        <label class="add-user-field-label" for="address">Geolocation</label>
        <input class="w-input" id="geolocation" type="text" placeholder="Your coordinates will appear here..." name="geolocation" data-name="geolocation" disabled="disabled" required>
      
      </div>
      <div class="w-col w-col-3" style="padding-top: 3.1%">
       <input id="submitbusiness" class="w-button create-user-button" style="float:left; max-height: 38px; padding-top:8px;" onClick="activatefield()" type="submit" value="Confirm location" data-wait="Please wait...">
      </div>
      </form>
      <div class="w-col w-col-2">
      
	  </div> 
     </div>
  </div>
  <!-- CHAT MARKUP -->
<div class="example-chat l-demo-container">
  <header>Bochito</header>
  <header id="welcome"></header>


  <ul id='example-messages' class="example-chat-messages"></ul>

  <footer>
    <input type='text' id='messageInput'  placeholder='Type a message...'>
  </footer>
</div>

<!-- CHAT JAVACRIPT -->
<script>
  // CREATE A REFERENCE TO FIREBASE
  var messagesRef = new Firebase('https://dazzling-torch-3597.firebaseio.com/messages/'),
	  loginRef = new Firebase('https://dazzling-torch-3597.firebaseio.com/users'),
	  routesRef = new Firebase('https://dazzling-torch-3597.firebaseio.com/routes/rides');
	  
  var rideroutes = [];
  var userid,
	  username,
	  addressee;
	loginRef.authWithOAuthPopup("facebook", function(error, authData) {
	  if (error) {
		console.log("Login Failed!", error);
	  } else {
		//console.log("Authenticated successfully with payload:", authData);
		userid = authData.facebook.id;
		username = authData.facebook.displayName;
		document.getElementById('welcome').innerHTML = '¡Bienvenido, '+username+'!';
		startConversation();
	  }
	});
  // REGISTER DOM ELEMENTS
  var messageField = $('#messageInput');
  var nameField = $('#nameInput');
  var messageList = $('#example-messages');

  function startConversation(){
	  // LISTEN FOR KEYPRESS EVENT
	  messageField.keypress(function (e) {
		if (e.keyCode == 13) {
		  //FIELD VALUES
		  var message = messageField.val();
		  
		  //SAVE DATA TO FIREBASE AND EMPTY FIELD
		  messagesRef.child(userid+'&'+addressee).push({name:username, text:message});
		  messageField.val('');
		}
	  });
		  // Add a callback that is triggered for each chat message.
		  messagesRef.child(userid+'&'+addressee).limitToLast(10).on('child_added', function (snapshot) {
			//GET DATA
			var data = snapshot.val();
			var username = data.name || "anonymous";
			var message = data.text;

			//CREATE ELEMENTS MESSAGE & SANITIZE TEXT
			var messageElement = $("<li>");
			var nameElement = $("<strong class='example-chat-username'></strong>")
			nameElement.text(username);
			messageElement.text(message).prepend(nameElement);

			//ADD MESSAGE
			messageList.append(messageElement)

			//SCROLL TO BOTTOM OF MESSAGE LIST
			messageList[0].scrollTop = messageList[0].scrollHeight;
		  });
	}

	// Add a callback that is triggered for each chat message.
routesRef.limitToLast(10).on('child_added', function (snapshot) {
	//GET DATA
	var data = snapshot.val();
	console.log(data);
	console.log(data.srclat);
	var sourcelat = data.srclat,
		sourcelon = data.srclon,
		destinationlat = data.destlat,
		destinationlon = data.destlon;

	//CREATE ELEMENTS MESSAGE & SANITIZE TEXT
	var messageElement = $("<li>");
	var nameElement = $("<strong class='example-chat-username'></strong>")
	nameElement.text("de " + sourcelat + ", " + sourcelon + " a ");
	messageElement.text(destinationlat+", "+destinationlon).prepend(nameElement);
	rideroutes.push(data)
	//ADD MESSAGE
	messageList.append(messageElement);

	//SCROLL TO BOTTOM OF MESSAGE LIST
	messageList[0].scrollTop = messageList[0].scrollHeight;
	console.log(rideroutes);
});

</script>
      <div style="height:1000px; width:1000px">
      <!--MAP-->
        
        <input id="pac-input" class="add-user-field-label" type="text" placeholder="Search" style="margin-left: 10px; height:20px; width: 200px">
        <div id="map-canvas" style="height:300px; width:600px"></div>
		<button onclick="setRide(false)">Dar Ride</button>
		<button onclick="setRide(true)">Pedir Ride</button>
		<script></script>
      <!--END OF MAP -->
      </div>


  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script>
  	google.maps.event.addDomListener(window, 'load', initialize);
  </script>
  <!--[if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
</body>
</html>