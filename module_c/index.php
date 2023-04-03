<?php
  include 'functions/loginSession.php';
  include 'functions/dbConnection.php';

  $sql = "select employee.*, department.name as department_name from employee join department on department.id = employee.department_id order by employee.id";

  $result = mysqli_query($mysqli, $sql);

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $lists[] = $row;
    }
  } else {
    // Nothing todo for now
  }
?>

<!DOCTYPE html>
<html lang="en">
  <?php include 'layout/header.php' ?>

  <style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
      }

      td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
      }

      tr:nth-child(even) {
        background-color: #dddddd;
      }

      .highlight {
        background-color: yellow;
      }
  </style>
  
  <body>
    <?php include 'layout/navigation.php' ?>

    <br><br>
    <input type="text" id="search" placeholder="Search employee name...">
    <br>
    <table>
      <thead>
        <tr>
          <td>Id</td>
          <td>Name</td>
          <td>Gender</td>
          <td>Department</td>
          <td>Salary</td>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($lists as $list) : ?>
          <tr>
            <td><?= $list['id'] ?></td>
            <td class="searchable-name"><?= $list['name'] ?></td>
            <td><?= $list['gender'] == 'M' ? "MALE" : "FEMALE" ?></td>
            <td><?= $list['department_name'] ?></td>
            <td><?= $list['salary'] ?></td>

            <?php if($isLogin): ?>
              <td>
                <form method="POST" action="delete.php">
                  <input type="hidden" name="userID" id="userID" value="<?= $list['id'] ?>" >
                  <input type="submit" value="Delete">
                </form>
              </td>
            <?php endif ?>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </body>

  <script>
    $(document).ready(function() {
      $('#search').on('keyup', function() {
        var query = $(this).val();
        $('.searchable-name').each(function() {
          var text = $(this).text();
          var match = text.match(new RegExp(query, 'i'));
          if (match) {
            var highlighted = text.replace(new RegExp(match[0], 'gi'), '<span class="highlight">' + match[0] + '</span>');
            $(this).html(highlighted);
          } else {
            $(this).html(text);
          }
        });
      });
    });
  </script>
</html>