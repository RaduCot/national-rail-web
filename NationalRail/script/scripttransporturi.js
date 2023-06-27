// JavaScript function to handle row selection
function selectRow(row) {
    // Deselect all rows
    var rows = document.getElementsByClassName('data-row');
    for (var i = 0; i < rows.length; i++) {
        rows[i].classList.remove('selected');
    }

    // Select the clicked row
    row.classList.add('selected');

    // Get the data cells of the selected row
    var cells = row.getElementsByTagName('td');

    // Extract the values from the cells
    var id = cells[0].innerText;
    var tip = cells[1].innerText;
    var locuri = cells[2].innerText;
    var specificatii = cells[3].innerText;
    var id_tren = cells[4].innerText;
    var id_angajat = cells[5].innerText;

    // Set the values in the textboxes
    document.getElementById('id').value = id;

    var id_tipSelect = document.getElementById('tip');
    for (var i = 0; i < id_tipSelect.options.length; i++) {
        if (id_tipSelect.options[i].text === tip) {
            id_tipSelect.selectedIndex = i;
            break;
        }
    }

    document.getElementById('locuri').value = locuri;
    document.getElementById('specificatii').value = specificatii;

    var id_trenSelect = document.getElementById('id_tren');
    for (var i = 0; i < id_trenSelect.options.length; i++) {
        if (id_trenSelect.options[i].text === id_tren) {
            id_trenSelect.selectedIndex = i;
            break;
        }
    }

    var id_angajatSelect = document.getElementById('id_angajat');
    for (var i = 0; i < id_angajatSelect.options.length; i++) {
        if (id_angajatSelect.options[i].text === id_angajat) {
            id_angajatSelect.selectedIndex = i;
            break;
        }
    }
}

// JavaScript function to handle regex search
function searchTable() {
    var input = document.getElementById('search-input').value;
    var regex = new RegExp(input, 'i');
    var rows = document.getElementsByClassName('data-row');

    for (var i = 0; i < rows.length; i++) {
        var rowData = rows[i].textContent.toLowerCase();
        if (rowData.match(regex)) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
}

// JavaScript function to handle table sorting
function sortTable(columnIndex) {
    var table = document.getElementById('table');
    var rows = Array.from(table.getElementsByTagName('tr')).slice(1); // Exclude header row
    var sortOrder = table.getAttribute('data-sort-order');

    // Sort rows based on column values
    rows.sort(function (row1, row2) {
        var value1 = row1.cells[columnIndex].textContent.trim();
        var value2 = row2.cells[columnIndex].textContent.trim();

        if (value1 < value2) {
            return sortOrder === 'asc' ? -1 : 1;
        } else if (value1 > value2) {
            return sortOrder === 'asc' ? 1 : -1;
        }

        return 0;
    });

    // Update the table rows
    var tbody = table.getElementsByTagName('tbody')[0];
    while (tbody.firstChild) {
        tbody.removeChild(tbody.firstChild);
    }

    rows.forEach(function (row) {
        tbody.appendChild(row);
    });

    // Toggle sort order for the next click
    table.setAttribute('data-sort-order', sortOrder === 'asc' ? 'desc' : 'asc');
}
function removeRow() {
    var selectedRow = document.querySelector('.data-row.selected');

    if (selectedRow) {
        // Remove the selected row
        selectedRow.parentNode.removeChild(selectedRow);
    }
}

// function to add new row using a random unique id of 4 digits
function addRow() {
    var table = document.getElementById('table');
    var id = Math.floor(Math.random() * 9000) + 1000;

    var tipCombobox = document.getElementById('tip');
    var locuriTextbox = document.getElementById('locuri');
    var specificatiiTextbox = document.getElementById('specificatii');
    var id_trenCombobox = document.getElementById('id_tren');
    var id_angajatCombobox = document.getElementById('id_angajat');

    var tipValue = tipCombobox.value;
    var locuriValue = locuriTextbox.value;
    var specificatiiValue = specificatiiTextbox.value;
    var id_trenValue = id_trenCombobox.value;
    var id_angajatValue = id_angajatCombobox.value;

    var row = '<tr class="data-row" onclick="selectRow(this)"><td>' + id + '</td><td>' + tipValue + '</td><td>' + locuriValue + '</td><td>' + specificatiiValue + '</td><td>' + id_trenValue + '</td><td>' + id_angajatValue + '</td></tr>';

    table.getElementsByTagName('tbody')[0].insertAdjacentHTML('beforeend', row);
}

// JavaScript function to handle row selection
function modifyRow() {
    var selectedRow = document.querySelector('.data-row.selected');

    if (selectedRow) {
        var idTextbox = document.getElementById('id');
        var tipCombobox = document.getElementById('tip');
        var locuriTextbox = document.getElementById('locuri');
        var specificatiiTextbox = document.getElementById('specificatii');
        var id_trenCombobox = document.getElementById('id_tren');
        var id_angajatCombobox = document.getElementById('id_angajat');

        var idValue = idTextbox.value;
        var tipValue = tipCombobox.value;
        var locuriValue = locuriTextbox.value;
        var specificatiiValue = specificatiiTextbox.value;
        var id_trenValue = id_trenCombobox.value;
        var id_angajatValue = id_angajatCombobox.value;

        var cells = selectedRow.getElementsByTagName('td');

        cells[0].textContent = idValue;
        cells[1].textContent = tipValue;
        cells[2].textContent = locuriValue;
        cells[3].textContent = specificatiiValue;
        cells[4].textContent = id_trenValue;
        cells[5].textContent = id_angajatValue;
    }
}

// JavaScript function to handle row selection
function deselectRow() {
    var selectedRow = document.querySelector('.selected');

    if (selectedRow) {
        selectedRow.classList.remove('selected');

        // Clear the values in the textboxes
        document.getElementById('id').value = '';
        document.getElementById('tip').selectedIndex = 0;
        document.getElementById('locuri').value = '';
        document.getElementById('specificatii').value = '';
        document.getElementById('id_tren').selectedIndex = 0;
        document.getElementById('id_angajat').selectedIndex = 0;
    }
}

//function for exporting rows to an XLS file
function exportRows() {
    var table = document.getElementById('table');

    // Create an empty workbook
    var wb = XLSX.utils.book_new();

    // Convert the table to a worksheet
    var ws = XLSX.utils.table_to_sheet(table);

    // Add the worksheet to the workbook
    XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

    // Generate the XLS file
    var wbout = XLSX.write(wb, { bookType: 'xlsx', type: 'array' });

    // Save the XLS file using the file-saver library
    saveAs(new Blob([wbout], { type: 'application/octet-stream' }), 'transporturi.xlsx');
}

//function for importing rows from an XLS file and replacing the data from the table
function importRows() {
    // Create a file input element
    var fileInput = document.createElement('input');
    fileInput.type = 'file';

    // Listen for the onchange event
    fileInput.addEventListener('change', function (e) {
        // Get the selected file
        var file = e.target.files[0];

        // Use the FileReader API to read the file
        var reader = new FileReader();
        reader.readAsBinaryString(file);

        reader.onload = function (e) {
            // Create a workbook object
            var workbook = XLSX.read(e.target.result, { type: 'binary' });

            // Get the first worksheet
            var worksheet = workbook.Sheets[workbook.SheetNames[0]];

            // Convert the worksheet to an array of objects
            var data = XLSX.utils.sheet_to_json(worksheet, { header: 1 });

            // Update the table with the new data
            updateTable(data);
        };

        reader.onerror = function (e) {
            console.error('File reading error');
        };
    });

    // Dispatch a click event to open the file dialog
    fileInput.dispatchEvent(new MouseEvent('click'));
}

//function for updating the table with the new data from the XLS file
function updateTable(data) {
    // Get the table element
    var table = document.getElementById('table');

    // Clear the table contents
    table.innerHTML = '';

    // Get the table header
    var header = data[0];

    // Create a new row for the table header
    var headerRow = document.createElement('tr');

    // Add the cells to the header row
    for (var i = 0; i < header.length; i++) {
        var cell = document.createElement('th');
        cell.textContent = header[i];
        headerRow.appendChild(cell);
    }

    // Add the header row to the table
    table.appendChild(headerRow);

    // Create a new row for each data row
    for (var i = 1; i < data.length; i++) {
        // Get the current row
        var rowData = data[i];

        // Create a new row
        var newRow = document.createElement('tr');
        newRow.classList.add("data-row");
        newRow.setAttribute("onclick", "selectRow(this)");

        // Add the cells to the row
        for (var j = 0; j < rowData.length; j++) {
            var cell = document.createElement('td');
            cell.textContent = rowData[j];
            newRow.appendChild(cell);
        }

        // Add the row to the table
        table.appendChild(newRow);
    }
}

//function for saving all the table rows to a json file
function saveRows() {
    // Get the table element
    var table = document.getElementById('table');

    // Create an array to hold the table data
    var tableData = [];

    // Iterate over the table rows, starting from index 1 to skip the first row
    var rows = table.getElementsByTagName('tr');
    for (var i = 1; i < rows.length; i++) {
        var row = rows[i];
        var rowData = {};

        // Iterate over the row cells
        var cells = row.getElementsByTagName('td');
        for (var j = 0; j < cells.length; j++) {
            var cell = cells[j];
            var columnHeader = table.rows[0].cells[j].textContent;
            rowData[columnHeader] = cell.textContent;
        }

        // Add the row data to the table data array
        tableData.push(rowData);
    }

    // Convert the table data to JSON
    var jsonData = JSON.stringify(tableData);

    // Log the JSON data being sent to the server
    console.log('JSON data being sent to PHP:', jsonData);

    // Send the JSON data to the server using a fetch POST request
    fetch('fetch/transporturi_fetch.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: jsonData
    })
        .then(response => {
            if (response.ok) {
                // Data saved successfully
                console.log('Table data saved to MySQL.');
            } else {
                // Error occurred while saving data
                console.error('Failed to save table data to MySQL.');
            }
        })
        .catch(error => {
            // Error occurred during the request
            console.error('An error occurred during the request:', error);
        });
}