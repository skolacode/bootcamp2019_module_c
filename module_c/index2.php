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

$join_query = " JOIN department ON employee.department_id = department.id";

// Define the search query
$search_query = $join_query;
if (isset($_GET['search'])) {
    $search_query = $search_query." WHERE name LIKE '%" . $_GET['search'] . "%' OR email LIKE '%" . $_GET['search'] . "%'";
}

// Define the SQL query to retrieve the records
$sql = "SELECT employee.*, department.name as department_name FROM employee" . $search_query . " ORDER BY employee.id LIMIT " . $records_per_page . " OFFSET " . $offset;

// Execute the SQL query
$result = mysqli_query($mysqli, $sql);


// Default set empty
$items[] = [];

// Check if there are any records
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $items[] = $row;
  }
} else {

  $sql = "SELECT * FROM employee".$join_query;

  // Execute the SQL query
  $result = mysqli_query($mysqli, $sql);
  
  while ($row = mysqli_fetch_assoc($result)) {
    $items[] = $row;
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link rel="stylesheet" href="style/table.css">
  <script src="lib/jquery-3.3.1.slim.min.js"></script>
</head>
<body>
  <div class="table-container">
    <input type="text" id="search" placeholder="Search products">
    <table>
      <thead>
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Gender</th>
          <th>Department</th>
          <th>Salary</th>
          <th>
            <!-- For delete button -->
          </th>
        </tr>
      </thead>
      <tbody id="table-body">
        <!-- Table rows will be generated dynamically with JavaScript -->

        <?php foreach ($items as $item) : ?>
          <tr>
              <td><?= $item['id'] ?></td>
              <td><?= $item['name'] ?></td>
              <td><?= $item['gender'] ?></td>
              <td><?= $item['department_name'] ?></td>
              <td><?= $item['salary'] ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <div class="pagination">
      <button id="prev-page-btn" disabled>&laquo;</button>
      <button class="page-btn active">1</button>
      <button class="page-btn">2</button>
      <button class="page-btn">3</button>
      <button id="next-page-btn">&raquo;</button>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      // Handle search input
      $('#search').keyup(function() {

        // Get search term and convert to lowercase
        var searchTerm = $(this).val().toLowerCase();

        if(searchTerm !== '') {
          // Loop through each row in the table
          $('table tbody tr').each(function() {
              // Get the text content of the row and convert to lowercase
            var rowText = $(this).text().toLowerCase();
            
            // If the row text contains the search term, add a highlight class
            if (rowText.indexOf(searchTerm) > -1) {
              $(this).addClass('highlight');
            } else {
              $(this).removeClass('highlight');
            }
          });
        }
        else {
          $('table tbody tr').each(function() {
            $(this).removeClass('highlight');
          })
        }
      });
    });
  </script>

  
  <!-- CSS to highlight the matched rows -->
  <style>
  .highlight {
    background-color: yellow;
  }
  </style>
  
</body>
</html>

