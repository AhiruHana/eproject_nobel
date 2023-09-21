var isLocationUpdated = false;

function updateTicker() {
  var dateElement = document.getElementById('date');
  var timeElement = document.getElementById('time');
  var locationElement = document.getElementById('location');

  var currentDate = new Date();
  var date = currentDate.toLocaleDateString();
  var time = currentDate.toLocaleTimeString();

  dateElement.innerText = ' '+ date;
  timeElement.innerText = ' ' + time;
  

  if (navigator.geolocation && !isLocationUpdated) {
    // console.log(navigator.geolocation,isLocationUpdated)
    navigator.geolocation.getCurrentPosition(function (position) {
      var latitude = position.coords.latitude;
      var longitude = position.coords.longitude;

      var nominatimUrl = `https://nominatim.openstreetmap.org/reverse?lat=${latitude}&lon=${longitude}&format=json`;

      fetch(nominatimUrl)
        .then(response => response.json())
        .then(data => {
          var locationName = data.display_name;
          // console.log(locationName);
          locationElement.innerText = ' ' + locationName;
          
          isLocationUpdated = true; // Đánh dấu đã cập nhật địa điểm
        })
        .catch(error => {
          console.error('Error:', error);
        });
    });
  }
}


setInterval(updateTicker, 1000);