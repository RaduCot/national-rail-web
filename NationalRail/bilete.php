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
$query = "SELECT * FROM BILETE";
$stmt = $pdo->prepare($query);
$stmt->execute();

// Fetch all rows from the result set
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Populate id_calatorie dropdown with values from CALATORII table, where id_transport is the same as id_transport from TRANSPORTURI table, where tip='persoane'
$query = "SELECT CALATORII.id_calatorie, TRANSPORTURI.id_transport, TRANSPORTURI.tip FROM CALATORII INNER JOIN TRANSPORTURI ON CALATORII.id_transport=TRANSPORTURI.id_transport WHERE TRANSPORTURI.tip='persoane'";
$stmt = $pdo->prepare($query);
$stmt->execute();
$transports = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Populate id_angajar dropdown with values from ANGAJATI table where functie='casier'
$query = "SELECT id_angajat, functie FROM ANGAJATI WHERE functie='casier'";
$stmt = $pdo->prepare($query);
$stmt->execute();
$angajati = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bilete</title>
    <meta property="og:title" content="Bilete" />
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
    <script type="text/javascript" src="script/scriptbilete.js"></script>
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
                                <th onclick="sortTable(0)">id_bilet</th>
                                <th onclick="sortTable(1)">data_emitenta</th>
                                <th onclick="sortTable(2)">clasa</th>
                                <th onclick="sortTable(3)">vagon</th>
                                <th onclick="sortTable(4)">loc</th>
                                <th onclick="sortTable(5)">pret</th>
                                <th onclick="sortTable(6)">tip_discount</th>
                                <th onclick="sortTable(7)">id_calatorie</th>
                                <th onclick="sortTable(8)">id_angajat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($rows as $row) {
                                echo '<tr class="data-row" onclick="selectRow(this)">';
                                echo '<td>' . htmlspecialchars($row['id_bilet']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['data_emitenta']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['clasa']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['vagon']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['loc']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['pret']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['tip_discount']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['id_calatorie']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['id_angajat']) . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="angajati-sidebar">
                    <nav class="angajati-nav">
                        <div class="angajati-container7">
                            <input id="id" name="id" type="text" placeholder="ID (auto)" readonly
                                class="angajati-textinput1 input" />
                            <input id="data_emitenta" name="data_emitenta" type="date" placeholder="Data emitenta"
                                class="angajati-textinput2 input" />
                            <select id="id_angajat" name="id_angajat" class="angajati-select">
                                <!-- populate the dropdown with values from ANGAJATI -->
                                <?php
                                foreach ($angajati as $angajat) {
                                    echo '<option value="' . htmlspecialchars($angajat['id_angajat']) . '">' . htmlspecialchars($angajat['id_angajat']) . '</option>';
                                }
                                ?>
                            </select>
                            <select id="id_calatorie" name="id_calatorie" class="angajati-select">
                                <!-- populate the dropdown with values from CALATORII -->
                                <?php
                                foreach ($transports as $transport) {
                                    echo '<option value="' . htmlspecialchars($transport['id_calatorie']) . '">' . htmlspecialchars($transport['id_calatorie']) . '</option>';
                                }
                                ?>
                            </select>
                            <select id="clasa" name="clasa" class="angajati-select">
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                            <input type="text" id="vagon" name="vagon" class="angajati-textinput2 input">
                            <input type="text" id="loc" name="loc" class="angajati-textinput2 input">
                            <select id="tip_discount" name="tip_discount" class="angajati-select">
                                <option value="copil">copil</option>
                                <option value="elev">elev</option>
                                <option value="student">student</option>
                                <option value="pensionar">pensionar</option>
                                <option value="veteran">veteran</option>
                                <option value="niciunul">niciunul</option>
                            </select>
                            <input type="number" id="pret" name="pret" readonly class="angajati-textinput2 input">
                        </div>
                        <div class="angajati-container8">
                            <button id="calculate" onclick="calculatePrice()" type="button"
                                class="angajati-button6 button">
                                <span>
                                    <span>Calculeza pretul</span>
                                    <br />
                                </span>
                                <button id="adaugare" onclick="addRow()" type="button" class="angajati-button6 button">
                                    <span>
                                        <span>Adaugare</span>
                                        <br />
                                    </span>
                                </button>
                                <button id="modificare" onclick="modifyRow()" type="button"
                                    class="angajati-button7 button">
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