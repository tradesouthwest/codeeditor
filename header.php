<?php session_start();
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
/**
 * SnippWiki app
 * LICENSE: Apache
 * @author  Larry Judd & Tradesouthwest
 * @link    https://tradesouthwest.com
 */
include "snippwiki-config.php";
?>
<?php $username = (!isset ($_SESSION['user_session'])) ? 'Guest' : $_SESSION['login_name']; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.png">

    <title>Snippets and Code</title>

    <link rel="canonical" href="http://snippwiki.com/">

    <!-- Bootstrap core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dependant/theme.css" rel="stylesheet">
  </head>

<body>
<div class="container-fluid">
    <div class="row">
    <header class="navbar navbar-dark fixed shadow-bottom" id="topOPage">
        <div class="brand col-md-3">
            <h1><a href="http://snippwiki.com">SnippWiki</a></h1>
        </div>
        <div class="col-md-9">
          <nav class="account-nav">
            <em>add a snippet/save/view/edit :-) </em>    
          <?php if(!isset( $_SESSION['user_session']) ) { ?>
<a class="btn btn-sm btn-default" href="login.php" title="login">Please Login</a>
          <?php } else { echo "You are now logged in."; } ?>
          </nav>
        </div>
    </header> 
    </div>
</div><div class="clearfix"></div>
