<?php
// get the number of rows from the query string
$rows = $_GET['rows'];

/**
 * function to generate an HTML table row containing two columns. 
 * @param int $rows The number of rows in the table
 * @return string The html table row that contains two columns
 */
function generateTableRow($rows) {
    // initialize variables to store the values for the two columns
    $column1Value = '';
    $column2Value = 0;

    // generate the first column value (pyramid)
    for ($i = 1; $i <= $rows; $i++) {
        $column1Value .= $rows;
        $column2Value += $rows;
    }

    // build the table row HTML
    $tableRow = "<tr style = 'border: 2px solid black'>
                <td style = 'border: 2px solid black'>$column1Value</td><td style = 'border: 2px solid black'>$column2Value</td>
                </tr>";

    return $tableRow;
}

// start the HTML table
echo '<table>';

// generate and output each row of the table
for ($row = 1; $row <= $rows; $row++) {
    echo generateTableRow($row);
}

// close the HTML table
echo '</table>';
?>