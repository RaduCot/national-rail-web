document.addEventListener("DOMContentLoaded", function () {
  document.querySelector("form").addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent the form from submitting normally

    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    var hexUsername = "61646d696e"; // Hex code for "admin"
    var hexPassword = "6e6174696f6e616c7261696c"; // Hex code for "nationalrail"

    // Convert the entered values to hex using a helper function
    function stringToHex(str) {
      var hexString = "";
      for (var i = 0; i < str.length; i++) {
        hexString += str.charCodeAt(i).toString(16);
      }
      return hexString;
    }

    // Compare the hex values with the entered values
    if (stringToHex(username) === hexUsername && stringToHex(password) === hexPassword) {
      document.getElementById("status").innerText = "- Autentificare reusita -";
      this.submit(); // Submit the form
    } else {
      document.getElementById("status").innerText = "- Autentificare esuata -";
    }
  });
});