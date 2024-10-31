var table = document.getElementById("invoice-table");
var rows = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");
var thead = table.getElementsByTagName("thead")[0].getElementsByTagName("tr");

for (i = 0; i < rows.length; i++) {
    rows[i].getElementsByTagName('td')[0].style.display = 'none';
}

for (i = 0; i < thead.length; i++) {
    thead[i].getElementsByTagName('th')[0].style.display = 'none';
}

deselectAll();

function deselectAll() {
    for (i = 0; i < rows.length; i++) {
        rows[i].className = "";
    }
}

function selectRow(tr) {
    //selectedID = tr.getAttribute('attribute name here'); We will need this later on if we want to do something with the selected row's data.

    var string = tr.getElementsByTagName('td')[0].innerHTML;
    var rowNumber = string.replace(/\D/g, '');

    updateSelectedRow(rowNumber);
}

function updateSelectedRow(_rowNumber) {
    deselectAll();

    rows[_rowNumber].className = "active";
}