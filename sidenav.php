    <div class="sidebar-sticky">
    
    <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            New Snipp
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="account-page.php">
            Snippets HQ
          </a>
        </li>
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="login.php">Sign in</a>
        </li>
        <li class="nav-item" style="background: rgba(255, 100, 80, .26);">
          <a class="nav-link" href="inc/logout.php">
            Logout !
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            Register
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span data-feather="bar-chart-2"></span>
            Docs/Instructions
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span data-feather="layers"></span>
            Integrations
          </a>
        </li>
    </ul>
<hr>
    <ul class="nav flex-column mb-2">
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span data-feather="file-text"></span>
            Current month
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span data-feather="file-text"></span>
            Last quarter
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span data-feather="file-text"></span>
            Social engagement
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span data-feather="file-text"></span>
            Year-to-date Stats
          </a>
        </li>
    </ul>
</div> 
<form action="<?php echo tsw_clean_url('search-view.php'); ?>" id="searchText" method="POST">
<fieldset>
<input class="form-control" id="search_keys" name="search_keys" type="text" 
       placeholder="keywords" aria-label="Search">
<input type="submit" name="snippet_search" value="Search by Keyword" class="btn"></fieldset>
</form> 