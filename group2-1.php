<?php
// Get the number of rows from the query string
$rows = $_GET['rows'];

function generateTableRow($rows) {
    // Initialize variables to store the values for the two columns
    $column1Value = '';
    $column2Value = 0;

    // Generate the first column value (pyramid)
    for ($i = 1; $i <= $rows; $i++) {
        $column1Value .= $rows;
        $column2Value += $rows;
    }

    // Build the table row HTML
    $tableRow = "<tr style = 'border: 2px solid black'>
                <td style = 'border: 2px solid black'>$column1Value</td><td style = 'border: 2px solid black'>$column2Value</td>
                </tr>";

    return $tableRow;
}

// Start the HTML table
echo '<table>';

// Generate and output each row of the table
for ($row = 1; $row <= $rows; $row++) {
    echo generateTableRow($row);
}

// Close the HTML table
echo '</table>';
?>