<?php
  include 'functions/loginSession.php';
?>

<div>
  <h1 id="title">Employee Listing</h1>
  <nav>
    <ul class="left-nav">
      <li><a href="/index.php">Index</a></li>
      <li><a href="/list.php">List</a></li>

      <?php if($isLogin === false): ?>
        <li><a href="/login.php">Login</a></li>
      <?php else: ?>
        <li><a href="/insert.php">Insert</a></li>
        <li><a href="/logout.php">Logout</a></li>
      <?php endif ?>
    </ul>

    <?php if($isLogin === true): ?>
      <ul class="right-nav">
        <span>Username: <?= $username ?></span>
      </ul>
    <?php endif ?>
  </nav>
</div>
<style>
  /* Basic CSS styling for the navigation bar */

  #title {
    background-color: #333;
    color: #fff;
    display: flex;
    justify-content: space-between;
    padding: 10px;
    margin: 0;
  }

  nav {
    background-color: #333;
    color: #fff;
    display: flex;
    justify-content: space-between;
    padding: 10px;
  }

  nav ul {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
  }

  .left-nav {
    margin-right: auto;
  }

  .right-nav {
    margin-left: auto;
  }

  nav li {
    margin-right: 10px;
  }

  nav a {
    color: #fff;
    text-decoration: none;
  }

  nav a:hover {
    text-decoration: underline;
  }
</style>
