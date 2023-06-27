<?php
session_start();

$errorMessage = ""; // Initialize the error message variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $hexUsername = "61646d696e"; // Hex code for "admin"
  $hexPassword = "6e6174696f6e616c7261696c"; // Hex code for "nationalrail"

  // Compare the hex values with the entered values
  function stringToHex($str)
  {
    $hexString = "";
    for ($i = 0; $i < strlen($str); $i++) {
      $hexString .= dechex(ord($str[$i]));
    }
    return $hexString;
  }

  // Check if the entered credentials are correct
  if (stringToHex($username) === $hexUsername && stringToHex($password) === $hexPassword) {
    $_SESSION['authenticated'] = true; // Set authentication status
    header('Location: menu.php');
    exit;
  } else {
    $errorMessage = "Date incorecte!";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Login</title>
  <meta property="og:title" content="Login" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="utf-8" />
  <meta property="twitter:card" content="summary_large_image" />

  <style data-tag="reset-style-sheet">
    html {
      line-height: 1.15;
    }

    body {
      margin: 0;
    }

    * {
      box-sizing: border-box;
      border-width: 0;
      border-style: solid;
    }

    p,
    li,
    ul,
    pre,
    div,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    figure,
    blockquote,
    figcaption {
      margin: 0;
      padding: 0;
    }

    button {
      background-color: transparent;
    }

    button,
    input,
    optgroup,
    select,
    textarea {
      font-family: inherit;
      font-size: 100%;
      line-height: 1.15;
      margin: 0;
    }

    button,
    select {
      text-transform: none;
    }

    button,
    [type="button"],
    [type="reset"],
    [type="submit"] {
      -webkit-appearance: button;
    }

    button::-moz-focus-inner,
    [type="button"]::-moz-focus-inner,
    [type="reset"]::-moz-focus-inner,
    [type="submit"]::-moz-focus-inner {
      border-style: none;
      padding: 0;
    }

    button:-moz-focus,
    [type="button"]:-moz-focus,
    [type="reset"]:-moz-focus,
    [type="submit"]:-moz-focus {
      outline: 1px dotted ButtonText;
    }

    a {
      color: inherit;
      text-decoration: inherit;
    }

    input {
      padding: 2px 4px;
    }

    img {
      display: block;
    }

    html {
      scroll-behavior: smooth
    }
  </style>
  <style data-tag="default-style-sheet">
    html {
      font-family: Inter;
      font-size: 16px;
    }

    body {
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      text-transform: none;
      letter-spacing: normal;
      line-height: 1.15;
      color: var(--dl-color-gray-black);
      background-color: var(--dl-color-gray-white);

    }
  </style>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
    data-tag="font" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
    data-tag="font" />
  <link rel="stylesheet" href="./style/style.css" />
</head>

<body>
  <div>
    <link href="./style/home.css" rel="stylesheet" />

    <div class="home-container">
      <div class="home-container1">
        <img src="./assets/logo.png" alt="image" class="home-image" />
        <span class="home-text">
          <span class="home-text1">National</span>
          <span class="home-text2">Rail</span>
          <br />
        </span>
        <form method="post" action="" class="home-form">
          <input id="username" name="username" type="text" placeholder="Nume de utilizator" required=""
            class="home-textinput input" />
          <input id="password" name="password" type="password" placeholder="Parola" required=""
            class="home-textinput1 input" />
          <span class="home-text4">
            <?php
            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
              echo $errorMessage;
            } else {
              echo "Bun venit!";
            }
            ?>
          </span>
          <button type="submit" class="home-button button">
            <span>
              <span>Conectare</span>
              <br />
            </span>
          </button>
        </form>
      </div>
    </div>
  </div>
</body>

</html>