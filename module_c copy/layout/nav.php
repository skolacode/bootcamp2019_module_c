<?php include('function/loginSession.php') ?>

<div>
  <h1 id="title">Employee Listing</h1>
  <nav>
    <ul class="left-nav">
      <li><a href="/index.php">Index</a></li>
      <li><a href="/list.php">List</a></li>

      <?php if($isLogin): ?>
          <li><a href="/insert.php">Insert</a></li>
      <?php endif; ?>
      <li><a href="/logout.php">Logout</a></li>
    </ul>

    <?php if($isLogin): ?>
      <ul class="right-nav">
        <span>Username: xxx</span>
      </ul>
    <?php endif; ?>
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
