<?php 
/**
 * SnippWiki app
 * LICENSE: Apache
 * @author  Larry Judd & Tradesouthwest
 * @link    https://tradesouthwest.com
 */
include 'header.php';
?>

<div class="container-fluid">
    <div class="row">
    
    <nav class="col-md-2 sidebar">
        <?php include( SNIPP_BASE . 'sidenav.php'); ?>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <article class="viewsnippet">
    <?php 
        /**
         * process only views for selected snippet
         * @param string $id (int)
         */
    if( isset( $_REQUEST['pub_id']) ) 
    { ?>
        <section class="viewsnippet">
        <?php 
        $id = (int)clean_data($_GET['pub_id']);
        
        require_once ( SNIPP_BASE . 'db/dbh.php');
        // Create the prepared statement object
        $stmt = $dbh->prepare('SELECT * FROM tsw_snippets WHERE `id` = :id');
        // Bind values to parameters 
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        // Run the SQL 
        $result = $stmt->execute();
        
        if($result){
        // TODO clean whitespace, excess only             
        while ($row = $result->fetchArray()) {
        echo '<h4>Viewing Snippet <span style="font-size:smaller;color:#777">&#34;' . clean_data($row['title']) . '&#34;</span></h4>';
            echo '<p>id: ' . $row['id'] . '</p>'; 
            echo '<textarea class="darkeditor" id="viewSnippet">'. $row['contents'] . '</textarea>';
            echo '<h5>' . clean_data($row['date_in']) . ' | stat: ' . clean_data($row['privi']) . ' | filed as: ' . clean_data($row['anchor']) . '</h5>';
            echo '<p><form name="share_snippet" method="POST" id="share_snippet" 
            action="' . $_SERVER['PHP_SELF'] . '"> 
            <label for="share_snipp">Click to get sharing URL: </label>
            <button type="input" name="share_snipp" title="' . clean_data($row['title']) . '" 
            class="sendids btn btn-sm btn-default" value="' . (int)$row['id'] . '" 
            onClick="document.getElementById(this.form).submit(.form);">
            <input type="hidden" name="share_title" value="' . clean_data($row['title']) . '">
            share snippet ' . (int)$row['id'] . '</button></form></p>';
        }
             
    } else { 
        echo '<h4>no snippet found Or snippet is private Or database is acting up.</h4>'; 
        }
    // Reset the prepared statement 
    // Destroy the object
    $dbh = ''; $id = ''; 
    } ?>

        <?php 
        /**
         * process only views for selected snippet
         * @param string $id (int)
         */
        if( isset( $_POST['share_snipp']) ) 
        { 
            $idsh        = (int)clean_data($_POST['share_snipp']);
            $share_title = clean_input($_POST['share_title']);
        ?>
        <section id="share-content" class="share-snippet">
            
        <div id="basic-modal-content">
        <h3 class="whitish">Copy this link to send to a friend:</h3>
        <p><button onclick="copyText()">Click Me to Copy</button></p>
        <?php 
        echo '<textarea id="copiedText"><a href="http://snippwiki.com/public-snippet.php?pub_id='. (int)$idsh .'" title="share link to this snippet">View: ' . $share_title . '</a></textarea>
            
            <p><form id="viewsnippet" method="POST" action="' . tsw_clean_url('view-snippet.php') . '">
            <button type="input" name="view_id" title="' . $share_title . '" 
              class="sendids btn btn-sm btn-default" value="' . (int)$idsh . '" 
              onClick="document.getElementById(this.form).submit(.form);">
              view ' . (int)$idsh . '</button></p>
            </form>';  
        ?> 
        </div>
         <script type="text/javascript">
        function copyText(){
        var text = document.getElementById("copiedText");
        text.select();
        document.execCommand("copy");
        //console.log("Copy text to Clipboard: " + text.value);
        }
        </script>
        </section>
        <?php 
        }
        ?>

        </article><div class="clearfix"></div>
       
        </main>
    </div>
</div>

    <?php include ( SNIPP_BASE . 'footer.php' ); ?>

</body>
</html>