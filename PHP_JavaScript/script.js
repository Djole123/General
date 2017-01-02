function validate() {
	//The following retrieves all the forms from the document
    var userName = document.getElementById("userName").value;
	var pass1 = document.getElementById("pass1").value;
	var pass2 = document.getElementById("pass2").value;
	var email = document.getElementById("email").value;
	var date = document.getElementById("date").value;
    
	if (userName === "" || pass1 === "" || pass2 === "" || email === "" || date === ""){
        alert("All values must be filled out.");
        return false;
	}else if(/\W/.test(userName)){ //makes sure you only have letters numbers and underscores in username
		alert("Username can only have letters, numbers and underscores.");
		return false;
	}else if(userName.length >= 15 || userName.length <= 3){ //makes sure the username is long enough
		alert("Username must be between 4 and 14 characters.");
		return false;
	}else if(!(pass1 === pass2)){ //makes sure that the passwords match
		alert("Passwords don't match.");
		return false;
	}else if(pass1.length >= 15 || pass1.length <= 3){ //makes sure the password is long enough
		alert("Password must be between 4 and 14 characters.");
		return false;
	}else if(!/\S+@\S+\.\S+/.test(email)){ //makes sure the email is in a valid form
		alert("Please enter a valid e-mail.");
		return false;
	}else if(/\W/.test(pass1)){ //makes sure that the password is valid
		alert("Password may only contain letters, numbers and underscores.");
		return false;
	}else if(!/^(0[1-9]|1[0-2])\/(0[1-9]|1\d|2\d|3[01])\/(19|20)\d{2}$/.test(date)){ //makes sure that the date is valid
		alert("Date needs to be valid and in the format MM/DD/YYYY.");
		return false;
	}else{
		return true;
	}
}

function validateMap(){
    var longi = document.getElementById("long").value;
    var lat = document.getElementById("lat").value;
    var name = document.getElementById("name").value;
    var review = document.getElementById("review").value;
    
    if (longi === "" || lat === "" || name === "" || review === ""){
        alert("All values must be filled out.");
        return false;
    }else if(review.length > 150){
        alert("Review is too long.");
        return false;
    }else if(!(/^[a-zA-Z\s]*$/.test(name))){
        alert("Please enter a name which only contains letters.");
        return false;
    }else{
        return true;
    }
}

function validateLogin(){
    var userName = document.getElementById("userName").value;
    var pass = document.getElementById("pass1").value;
    
    if (userName === "" || pass === ""){
        alert("All values must be filled out.");
        return false;
    }else if(/\W/.test(userName)){ //makes sure you only have letters numbers and underscores in username
		alert("Username can only have letters, numbers and underscores.");
		return false;
    }else if(userName.length >= 15 || userName.length <= 3){ //makes sure the username is long enough
		alert("Username must be between 4 and 14 characters.");
		return false;
    }else if(pass.length >= 15 || pass.length <= 3){ //makes sure the password is long enough
		alert("Password must be between 4 and 14 characters.");
		return false;
    }else{
        return true;
    }
}

function makeMap(arrayA){
	var mymap = L.map('actualMap');//creates the variable to hold the map
	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiZGpvbGUxMjMiLCJhIjoiY2l1dTI5ZTA0MDF0ZzMwcHN5eHE0bHE0ciJ9.BBDYdg0yEfCYWYVenyPamg',{
	attribution: 'Map data &copy; <a class = "default" href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
	'<a class = "default" href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
	'Imagery © <a class = "default" href="http://mapbox.com">Mapbox</a>',
	id: 'mapbox.streets'}).addTo(mymap); //creates the map and puts it in the container
	
	mymap.setView([arrayA[0], arrayA[1]], 11); //sets the position of the map to be in Serbia
    
    for(i=0;i<arrayA.length;i+=5){
        L.marker([arrayA[i], arrayA[i+1]]).addTo(mymap)
            .bindPopup("<b>"+arrayA[i+2]+"</b><br><b>Review:</b><br>"+arrayA[i+3]+"<br><b>Rating:</b><br>"+arrayA[i+4]);
    }
}

function makeGeoMap(arrayA){
	var mymap = L.map('actualMap');//creates the variable to hold the map
	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiZGpvbGUxMjMiLCJhIjoiY2l1dTI5ZTA0MDF0ZzMwcHN5eHE0bHE0ciJ9.BBDYdg0yEfCYWYVenyPamg',{
	attribution: 'Map data &copy; <a class = "default" href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
	'<a class = "default" href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
	'Imagery © <a class = "default" href="http://mapbox.com">Mapbox</a>',
	id: 'mapbox.streets'}).addTo(mymap); //creates the map and puts it in the container
	
	navigator.geolocation.getCurrentPosition(setPosition); //Sets the initial position to the users position via geolocation
	
	function setPosition(position){ //Function to locate the user
		mymap.setView([position.coords.latitude, position.coords.longitude], 15);
		L.marker([position.coords.latitude, position.coords.longitude]).addTo(mymap)
			.bindPopup("<b>You Are Here</b>") //Puts a marker to tell the user where they are
			.openPopup(); //opens the marker when the page is loaded
	}
	for(i=0;i<arrayA.length;i+=5){
        L.marker([arrayA[i], arrayA[i+1]]).addTo(mymap)
            .bindPopup("<b>"+arrayA[i+2]+"</b><br><b>Review:</b><br>"+arrayA[i+3]+"<br><b>Rating:</b><br>"+arrayA[i+4]);
    }
}