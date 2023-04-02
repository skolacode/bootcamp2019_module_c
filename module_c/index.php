<?php
// Define database connection
include 'function/dbConnection.php';

// Define the number of records to display per page
$records_per_page = 10;

// Get the current page number
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = $_GET['page'];
} else {
    $current_page = 1;
}

// Calculate the offset for the query
$offset = ($current_page - 1) * $records_per_page;

// Define the search query
$search_query = "";
if (isset($_GET['search'])) {
    $search_query = " WHERE name LIKE '%" . $_GET['search'] . "%' OR email LIKE '%" . $_GET['search'] . "%'";
}

// Define the SQL query to retrieve the records
$sql = "SELECT * FROM employee" . $search_query . " LIMIT " . $records_per_page . " OFFSET " . $offset;

// Execute the SQL query
$result = mysqli_query($mysqli, $sql);

// Check if there are any records
if (mysqli_num_rows($result) > 0) {
    // Output the table header
    echo "<table>";
    echo "<thead><tr><th>Name</th><th>Email</th></tr></thead>";

    // Output the table body
    echo "<tbody>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row['name'] . "</td><td>" . $row['email'] . "</td></tr>";
    }
    echo "</tbody>";

    // Output the table footer
    echo "</table>";

    // Calculate the total number of records
    $sql_count = "SELECT COUNT(*) AS count FROM employee" . $search_query;
    $result_count = mysqli_query($mysqli, $sql_count);
    $row_count = mysqli_fetch_assoc($result_count);
    $total_records = $row_count['count'];

    // Calculate the total number of pages
    $total_pages = ceil($total_records / $records_per_page);

    // Output the pagination links
    echo "<div class='pagination'>";
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $current_page) {
            echo "<a class='active'>" . $i . "</a>";
        } else {
            echo "<a href='?page=" . $i . "&search=" . $_GET['search'] . "'>" . $i . "</a>";
        }
    }
    echo "</div>";
} else {
    echo "No records found.";
}

?>
