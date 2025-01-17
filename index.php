<html>

<head>
    <meta charset="utf-8" />
    <title>Map</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="style.css">
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDbgdxmr8CUufPnCPzwCWSl0YDhRnTq3Io&callback=init&libraries=&v=weekly"></script>
    <script type="text/javascript" src="./database.js"></script>
</head>

<body onload="init();">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <h3 class="location-header text-center mt-2">Locations</h3>
                <div class="side-content" id="side-content"></div>
            </div>
            <div class="col-lg-9">
                <div class="form-group d-flex mt-3 justify-content-around">
                    <input class="form-control w-75" type="text" name="searchKey" id="pac-input">
                    <button class="search-btn btn-primary pl-5 pr-5" onclick="init()">Search</button>
                </div>
                <div id="map_canvas"></div>
            </div>
        </div>
    </div>
    </div>


    <!-- Getting data from Database ------------------------------------------------- -->

    <script type='text/javascript'>
        var info;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'db.php'); // Change to your PHP file here
        xhr.onload = function () {
            if (xhr.status === 200) {
                info = xhr.responseText;
                // alert(info);
                window.dbresult = JSON.parse(info);
                init();
            } else {
                alert('Request failed: ' + xhr.status);
            }
        };
        xhr.send();
       
    </script>

<!-- MAP INITIAIZATION--------------------------------------------------------------- -->
    <script type="text/javascript">

        var center = new google.maps.LatLng(13.0827, 80.2707);
    
        // GET DISPLAY LOCATIONS FUNCTION DECLARATION-------------------------------------->
        function getDisplayLocations(records, searchKey) {
            let filteredRecords = records;
            if (searchKey.trim()) {
                filteredRecords = records.filter(location => {
                    return location.city === searchKey
                });
            }

            return filteredRecords.map(record => ({
                content: record.name,
                cords: {
                    lat: parseFloat(record.lat),
                    lng: parseFloat(record.lng)
                },
                address: record.address,
                contact: record.contact,
                sunday: record.sunday,
                monday: record.monday,
                tuesday: record.tuesday,
                wednesday: record.wednesday,
                thrusday: record.thrusday,
                friday: record.friday,
                saturday: record.saturday
            }));
        }

        async function init() {
            var mapOptions = {
                zoom: 3,
                center: new google.maps.LatLng(0, 0),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
            const searchKey = document.getElementById('pac-input').value;
         
            var set = new Set([
                "name",
                "address",
                "contact",
                "lat",
                "lng",
                "monday",
                "tuesday",
                "wednesday",
                "thrusday",
                "friday",
                "saturday",
                "sunday",
                "city"
            ]);
            var dataArray = [];

            var arrayLength = window.dbresult.length;
            for (var i = 0; i < arrayLength; i++) {
                var objectName = window.dbresult[i];
                var arrayObject = {};
                Object.keys(objectName).forEach(key => {
                    if (set.has(key)) {
                        arrayObject[key] = objectName[key];
                    }
                });
                dataArray[i] = arrayObject;
            }
            
            var locations = dataArray;
            var displayLocations = getDisplayLocations(locations, searchKey)// GET DISPLAY LOCATIONS FUNCTION CALL------------------------------------->

            // DISPLAYING DATE ALONG THE MARKER--------------------------------------
            var date = new Date();
            var weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            var currentDay = weekday[date.getDay()];
            // BOUNDING IN THE MAP---------------------------------------------------
            const bounds = new google.maps.LatLngBounds();

            const sideContent = document.getElementById('side-content');
            sideContent.innerHTML = '';

            function infoOpen(content, day, marker) {
                var infoWindow = new google.maps.InfoWindow({
                    content: content + '<hr>' + day
                });
                infoWindow.open(map, marker);
            }




            for (var i = 0; i < displayLocations.length; i++) {
                const displayLocation = displayLocations[i];
                const marker = addMarker(displayLocation.cords, displayLocation.content, day);
                const anchor = document.createElement('a');
                const locationButton = document.createElement("a");
                locationButton.textContent = "Directions";
                locationButton.classList.add("custom-map-control-button");
                locationButton.style.cursor = 'pointer';
                locationButton.style.textDecorationLine = 'underline';
                locationButton.style.color = 'black';
                locationButton.style.fontSize = '16';
                locationButton.style.fontWeight = '900';
                locationButton.addEventListener("mouseover", function () {
                    this.style.color = "blue";
                });
                locationButton.addEventListener("mouseout", function () {
                    this.style.color = "black";
                });
                let infoWindow = new google.maps.InfoWindow();
                var markerA, markerB;
                locationButton.addEventListener("click", () => {

                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(
                            (position) => {
                                let pos = {
                                    lat: position.coords.latitude,
                                    lng: position.coords.longitude,
                                };
                                infoWindow.setPosition(pos);
                                infoWindow.setContent("Your current Location.");
                                infoWindow.open(map);
                                map.setCenter(pos);
                                var directionsService = new google.maps.DirectionsService(),
                                    directionsDisplay = new google.maps.DirectionsRenderer();
                                directionsDisplay.setMap(map)

                                markerA = new google.maps.Marker({
                                    position: pos,
                                    title: "point A",
                                    label: "A",
                                    map: map
                                }),
                                    markerB = new google.maps.Marker({

                                        position: displayLocation.cords,
                                        title: "point B",
                                        label: "B",
                                        map: map
                                    });
                                calculateAndDisplayRoute(directionsService, directionsDisplay, displayLocation.cords, pos);
                            },

                            () => {
                                handleLocationError(true, infoWindow, map.getCenter());
                            }

                        );

                    }

                    else {
                        // Browser doesn't support Geolocation
                        handleLocationError(false, infoWindow, map.getCenter());
                    }
                   


                   
                    function calculateAndDisplayRoute(directionsService, directionsDisplay, cords, pos) {
                        directionsService.route({
                            origin:pos,
                            destination:cords,
                            avoidTolls: true,
                            avoidHighways: false,
                            travelMode: google.maps.TravelMode.DRIVING
                        }, function (response, status) {
                            if (status == google.maps.DirectionsStatus.OK) {
                                directionsDisplay.setDirections(response);
                            } else {
                                window.alert('Directions request failed due to ' + status);
                            }
                        });
                    }
                });


                function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                    infoWindow.setPosition(pos);
                    infoWindow.setContent(
                        browserHasGeolocation
                            ? "Error: The Geolocation service failed."
                            : "Error: Your browser doesn't support geolocation."
                    );
                    infoWindow.open(map);
                }

                anchor.innerHTML = "<hr style=transform:translateX(-10px)>" + "<h5 class=location-name onmouseover=this.style.color='blue'; onmouseout=this.style.color='black'; style=cursor:pointer;>" + displayLocation.content + "</h5>" + "<br>" + displayLocation.address + "<br>" + displayLocation.contact + "<br>" + "Sunday - " + displayLocation.sunday + " Monday - "
                    + displayLocation.monday + " Tuesday - " + displayLocation.tuesday + " Wednesday - " + displayLocation.wednesday + " Thrusday - " + displayLocation.thrusday + " Friday - " + displayLocation.friday + " Saturday - " + displayLocation.saturday + "<br>";
                anchor.onclick = () => {
                    infoOpen(displayLocation.content, day, marker);
                }



                sideContent.appendChild(anchor);
                sideContent.appendChild(locationButton);
             
                var day = currentDay;
                if (day === "Sunday") {
                    day = weekday[0] + ' ' + displayLocations[i].sunday;
                } else if (day === "Monday") {
                    day = weekday[1] + ' ' + displayLocations[i].monday;
                } else if (day === "Tuesday") {
                    day = weekday[2] + ' ' + displayLocations[i].tuesday;
                } else if (day === "Wednesday") {
                    day = weekday[3] + ' ' + displayLocations[i].wednesday;
                } else if (day === "Thrusday") {
                    day = weekday[4] + ' ' + displayLocations[i].thrusday;
                } else if (day === "Friday") {
                    day = weekday[5] + ' ' + displayLocations[i].friday;
                } else {
                    day = weekday[6] + ' ' + displayLocations[i].saturday;
                }

            }
            map.fitBounds(bounds);


            function addMarker(cords, content, day) {
                var marker = new google.maps.Marker({
                    map: map,
                    position: cords,
                    draggable: true,
                    animation: google.maps.Animation.DROP,
                });
                marker.addListener("click", toggleBounce);
                var infoWindow = new google.maps.InfoWindow({
                    content: content + '<hr>' + day
                });
                marker.addListener('click', function () {
                    infoWindow.open(map, marker);
                });
                map.addListener('click', function () {
                    infowindow.close(map, marker);
                });

                function toggleBounce() {
                    if (marker.getAnimation() !== null) {
                        marker.setAnimation(null);
                    }
                    else {
                        marker.setAnimation(google.maps.Animation.BOUNCE);
                    }
                }
                bounds.extend(cords);
                return marker;

            }

        }

    </script>
</body>

</html>