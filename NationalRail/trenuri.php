<?php
// Check if the user is authenticated
session_start();
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
  header('Location: login.php');
  exit;
}

// Connect Data
$host = 'aws.connect.psdb.cloud';
$dbname = 'nationalrail';
$username = 'le40l5igln90eexjtwwc';
$password = 'pscale_pw_v3pqjqy5s2J6lJzDe07J3tntweNUzyXZiX3svILBTnH';

// Connection
$dsn = "mysql:host=$host;dbname=$dbname";
$options = array(
  PDO::MYSQL_ATTR_SSL_CA => __DIR__ . "/fetch/cacert.pem",
);
$pdo = new PDO($dsn, $username, $password, $options);

// Query
$query = "SELECT * FROM TRENURI";
$stmt = $pdo->prepare($query);
$stmt->execute();

// Fetch all rows from the result set
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Trenuri</title>
  <meta property="og:title" content="Trenuri" />
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
  <!--This is the head section-->
  <!-- <style> ... </style> -->
  <link rel="stylesheet" href="./style/style.css" />
  <script type="text/javascript" src="script/scripttrenuri.js"></script>
  <script type="text/javascript" src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
  <script type="text/javascript" src="https://unpkg.com/file-saver"></script>
</head>

<body>
  <div>
    <link href="./style/angajati.css" rel="stylesheet" />

    <div class="angajati-container">
      <header data-role="Header" class="angajati-header">
        <div class="angajati-container1">
          <img src="assets/logo.png" alt="image" class="angajati-image" />
          <span class="angajati-text">
            <span class="angajati-text01">National</span>
            <span class="angajati-text02">Rail</span>
            <br />
          </span>
        </div>
        <div class="angajati-container2">
          <button onclick="window.location.href = 'menu.php';" type="button" class="angajati-button button">
            <svg viewBox="0 0 914.2857142857142 1024" class="angajati-icon">
              <path
                d="M877.714 512v73.143c0 38.857-25.714 73.143-66.857 73.143h-402.286l167.429 168c13.714 13.143 21.714 32 21.714 51.429s-8 38.286-21.714 51.429l-42.857 43.429c-13.143 13.143-32 21.143-51.429 21.143s-38.286-8-52-21.143l-372-372.571c-13.143-13.143-21.143-32-21.143-51.429s8-38.286 21.143-52l372-371.429c13.714-13.714 32.571-21.714 52-21.714s37.714 8 51.429 21.714l42.857 42.286c13.714 13.714 21.714 32.571 21.714 52s-8 38.286-21.714 52l-167.429 167.429h402.286c41.143 0 66.857 34.286 66.857 73.143z">
              </path>
            </svg>
          </button>
          <button id="save" onclick="saveRows()" type="button" class="angajati-button1 button">
            <span>
              <span>Salvare</span>
              <br />
            </span>
          </button>
          <button id="excel" onclick="exportRows()" type="button" class="angajati-button2 button">
            <span>
              <span>Export</span>
              <br />
            </span>
          </button>
          <button id="import" onclick="importRows()" type="button" class="angajati-button3 button">
            <span>
              <span>Import</span>
              <br />
            </span>
          </button>
        </div>
      </header>
      <div class="angajati-container3">
        <div class="angajati-container4">
          <div class="angajati-container5">
            <button id="stergere" onclick="removeRow()" type="button" class="angajati-button4 button">
              <span>
                <span>Stergere</span>
                <br />
              </span>
            </button>
            <button id="deselectare" onclick="deselectRow()" type="button" class="angajati-button5 button">
              <span>
                <span>Deselectare</span>
                <br />
              </span>
            </button>
            <input id="search-input" onkeyup="searchTable()" type="text" placeholder="Cautare"
              class="angajati-textinput input" />
          </div>
          <div class="angajati-container6"></div>

          <table id="table" data-sort-order="asc">
            <thead>
              <tr>
                <th onclick="sortTable(0)">id_tren</th>
                <th onclick="sortTable(1)">vagoane</th>
                <th onclick="sortTable(2)">masa</th>
                <th onclick="sortTable(3)">v_max</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($rows as $row) {
                echo '<tr class="data-row" onclick="selectRow(this)">';
                echo '<td>' . htmlspecialchars($row['id_tren']) . '</td>';
                echo '<td>' . htmlspecialchars($row['vagoane']) . '</td>';
                echo '<td>' . htmlspecialchars($row['masa']) . '</td>';
                echo '<td>' . htmlspecialchars($row['v_max']) . '</td>';
                echo '</tr>';
              }
              ?>
            </tbody>
          </table>

        </div>
        <div class="angajati-sidebar">
          <nav class="angajati-nav">
            <div class="angajati-container7">
              <input id="id" name="id" type="text" placeholder="ID (auto)" readonly class="angajati-textinput1 input" />
              <input id="vagoane" name="vagoane" type="text" placeholder="Nr. vagoane"
                class="angajati-textinput3 input" />
              <input id="masa" name="masa" type="text" placeholder="Masa (t)" class="angajati-textinput4 input" />
              <input id="vmax" name="vmax" type="text" placeholder="Viteza maxima (km/h)"
                class="angajati-textinput5 input" />
            </div>
            <div class="angajati-container8">
              <button id="adaugare" onclick="addRow()" type="button" class="angajati-button6 button">
                <span>
                  <span>Adaugare</span>
                  <br />
                </span>
              </button>
              <button id="modificare" onclick="modifyRow()" type="button" class="angajati-button7 button">
                <span>
                  <span>Modificare</span>
                  <br />
                </span>
              </button>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <script data-section-id="header" src="https://unpkg.com/@teleporthq/teleport-custom-scripts"></script>
</body>

</html>