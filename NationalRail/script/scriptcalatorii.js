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
    var data_plecare = cells[1].innerText;
    var ora_plecare = cells[2].innerText;
    var data_sosire = cells[3].innerText;
    var ora_sosire = cells[4].innerText;
    var loc_plecare = cells[5].innerText;
    var loc_sosire = cells[6].innerText;
    var id_transport = cells[7].innerText;

    // Set the values in the textboxes
    document.getElementById('id').value = id;
    document.getElementById('data_plecare').value = data_plecare;
    document.getElementById('ora_plecare').value = ora_plecare;
    document.getElementById('data_sosire').value = data_sosire;
    document.getElementById('ora_sosire').value = ora_sosire;

    var loc_plecareSelect = document.getElementById('loc_plecare');
    for (var i = 0; i < loc_plecareSelect.options.length; i++) {
        if (loc_plecareSelect.options[i].text === loc_plecare) {
            loc_plecareSelect.selectedIndex = i;
            break;
        }
    }

    var loc_sosireSelect = document.getElementById('loc_sosire');
    for (var i = 0; i < loc_sosireSelect.options.length; i++) {
        if (loc_sosireSelect.options[i].text === loc_sosire) {
            loc_sosireSelect.selectedIndex = i;
            break;
        }
    }

    var id_transportSelect = document.getElementById('id_transport');
    for (var i = 0; i < id_transportSelect.options.length; i++) {
        if (id_transportSelect.options[i].text === id_transport) {
            id_transportSelect.selectedIndex = i;
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

    var data_plecareTextbox = document.getElementById('data_plecare');
    var ora_plecareTextbox = document.getElementById('ora_plecare');
    var data_sosireTextbox = document.getElementById('data_sosire');
    var ora_sosireTextbox = document.getElementById('ora_sosire');
    var loc_plecareCombobox = document.getElementById('loc_plecare');
    var loc_sosireCombobox = document.getElementById('loc_sosire');
    var id_transportCombobox = document.getElementById('id_transport');

    var data_plecareValue = data_plecareTextbox.value;
    var ora_plecareValue = ora_plecareTextbox.value;
    var data_sosireValue = data_sosireTextbox.value;
    var ora_sosireValue = ora_sosireTextbox.value;
    var loc_plecareValue = loc_plecareCombobox.value;
    var loc_sosireValue = loc_sosireCombobox.value;
    var id_transportValue = id_transportCombobox.value;

    var row = '<tr class="data-row" onclick="selectRow(this)"><td>' + id + '</td><td>' + data_plecareValue + '</td><td>' + ora_plecareValue + '</td><td>' + data_sosireValue + '</td><td>' + ora_sosireValue + '</td><td>' + loc_plecareValue  + '</td><td>' + loc_sosireValue  + '</td><td>' + id_transportValue + '</td></tr>';

    table.getElementsByTagName('tbody')[0].insertAdjacentHTML('beforeend', row);
}

// JavaScript function to handle row selection
function modifyRow() {
    var selectedRow = document.querySelector('.data-row.selected');

    if (selectedRow) {
        var idTextbox = document.getElementById('id');
        var data_plecareTextbox = document.getElementById('data_plecare');
        var ora_plecareTextbox = document.getElementById('ora_plecare');
        var data_sosireTextbox = document.getElementById('data_sosire');
        var ora_sosireTextbox = document.getElementById('ora_sosire');
        var loc_plecareCombobox = document.getElementById('loc_plecare');
        var loc_sosireCombobox = document.getElementById('loc_sosire');
        var id_transportCombobox = document.getElementById('id_transport');

        var idValue = idTextbox.value;
        var data_plecareValue = data_plecareTextbox.value;
        var ora_plecareValue = ora_plecareTextbox.value;
        var data_sosireValue = data_sosireTextbox.value; 
        var ora_sosireValue = ora_sosireTextbox.value;
        var loc_plecareValue = loc_plecareCombobox.value;
        var loc_sosireValue = loc_sosireCombobox.value;
        var id_transportValue = id_transportCombobox.value;

        var cells = selectedRow.getElementsByTagName('td');

        cells[0].textContent = idValue;
        cells[1].textContent = data_plecareValue;
        cells[2].textContent = ora_plecareValue;
        cells[3].textContent = data_sosireValue;
        cells[4].textContent = ora_sosireValue;
        cells[5].textContent = loc_plecareValue;
        cells[6].textContent = loc_sosireValue;
        cells[7].textContent = id_transportValue;
    }
}

// JavaScript function to handle row selection
function deselectRow() {
    var selectedRow = document.querySelector('.selected');

    if (selectedRow) {
        selectedRow.classList.remove('selected');

        // Clear the values in the textboxes
        document.getElementById('id').value = '';
        document.getElementById('data_plecare').value = '';
        document.getElementById('ora_plecare').value = '';
        document.getElementById('data_sosire').value = '';
        document.getElementById('ora_sosire').value = '';
        document.getElementById('loc_plecare').selectedIndex = 0;
        document.getElementById('loc_sosire').selectedIndex = 0;
        document.getElementById('id_transport').selectedIndex = 0;
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
    saveAs(new Blob([wbout], { type: 'application/octet-stream' }), 'calatorii.xlsx');
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
            var data = XLSX.utils.sheet_to_json(worksheet, { header: 1, raw: false, dateNF: 'yyyy-mm-dd' });

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
      newRow.classList.add('data-row');
      newRow.setAttribute('onclick', 'selectRow(this)');
  
      // Add the cells to the row
      for (var j = 0; j < rowData.length; j++) {
        var cell = document.createElement('td');
        var cellData = rowData[j];
  
        // Format date columns
        if (isDateColumn(j)) {
          cellData = formatDate(cellData); // Replace formatDate with your own date formatting function
        }
  
        cell.textContent = cellData;
        newRow.appendChild(cell);
      }
  
      // Add the row to the table
      table.appendChild(newRow);
    }
  }
  
  // Check if the given column index represents a date column
  function isDateColumn(columnIndex) {
    // Adjust the index based on your table structure and column positions
    return columnIndex === 1 || columnIndex === 3;
  }
  
  // Format the date string in the desired format (yyyy-mm-dd)
  function formatDate(dateString) {
    var date = new Date(dateString);
    var year = date.getFullYear();
    var month = ('0' + (date.getMonth() + 1)).slice(-2);
    var day = ('0' + date.getDate()).slice(-2);
    return year + '-' + month + '-' + day;
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
    fetch('fetch/calatorii_fetch.php', {
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