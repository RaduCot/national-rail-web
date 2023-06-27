<?php
session_start();
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
  header('Location: login.php');
  exit;
}

// Logout functionality

if (isset($_POST['discon'])) {
  // Unset all session variables
  $_SESSION = array();

  // Destroy the session
  session_destroy();

  // Redirect to login page
  header('Location: login.php');
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Menu - Generous Fruitful Badger</title>
    <meta property="og:title" content="Menu - Generous Fruitful Badger" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <meta property="twitter:card" content="summary_large_image" />

    <style data-tag="reset-style-sheet">
      html {  line-height: 1.15;}body {  margin: 0;}* {  box-sizing: border-box;  border-width: 0;  border-style: solid;}p,li,ul,pre,div,h1,h2,h3,h4,h5,h6,figure,blockquote,figcaption {  margin: 0;  padding: 0;}button {  background-color: transparent;}button,input,optgroup,select,textarea {  font-family: inherit;  font-size: 100%;  line-height: 1.15;  margin: 0;}button,select {  text-transform: none;}button,[type="button"],[type="reset"],[type="submit"] {  -webkit-appearance: button;}button::-moz-focus-inner,[type="button"]::-moz-focus-inner,[type="reset"]::-moz-focus-inner,[type="submit"]::-moz-focus-inner {  border-style: none;  padding: 0;}button:-moz-focus,[type="button"]:-moz-focus,[type="reset"]:-moz-focus,[type="submit"]:-moz-focus {  outline: 1px dotted ButtonText;}a {  color: inherit;  text-decoration: inherit;}input {  padding: 2px 4px;}img {  display: block;}html { scroll-behavior: smooth  }
    </style>
    <style data-tag="default-style-sheet">
      html {
        font-family: Inter;
        font-size: 16px;
      }

      body {
        font-weight: 400;
        font-style:normal;
        text-decoration: none;
        text-transform: none;
        letter-spacing: normal;
        line-height: 1.15;
        color: var(--dl-color-gray-black);
        background-color: var(--dl-color-gray-white);

      }
    </style>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
      data-tag="font"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
      data-tag="font"
    />
    <link rel="stylesheet" href="./style/style.css" />
    <script src="script/scriptmenu.js"></script>
  </head>
  <body>
    <div>
      <link href="./style/menu.css" rel="stylesheet" />

      <div class="menu-container">
        <div class="menu-container1">
          <img src="assets/logo.png" alt="image" class="menu-image" />
          <span class="menu-text">
            <span class="menu-text01">National</span>
            <span class="menu-text02">Rail</span>
            <br />
          </span>
          <span class="menu-text04">Alegeți o tabelă:</span>
          <button id="angajati" type="button" class="menu-button button">
            <span>
              <span>Angajați</span>
              <br />
            </span>
          </button>
          <button id="trenuri" type="button" class="menu-button1 button">
            <span>
              <span>Trenuri</span>
              <br />
            </span>
          </button>
          <button id="transporturi" type="button" class="menu-button2 button">
            <span>
              <span>Transporturi</span>
              <br />
            </span>
          </button>
          <button id="calatorii" type="button" class="menu-button3 button">
            <span>
              <span>Călătorii</span>
              <br />
            </span>
          </button>
          <button id="bilete" type="button" class="menu-button4 button">
            <span>
              <span>Bilete</span>
              <br />
            </span>
          </button>
          <form method="post">
          <button name="discon" id="deconectare" type="submit" class="menu-button5 button">
            <span>
              <span>Deconectare</span>
              <br />
            </span>
          </button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
