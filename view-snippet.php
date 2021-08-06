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
    if( isset( $_POST['view_id']) ) 
    { ?>
        <section class="viewsnippet">
        <?php 
        $id = (int)clean_data($_POST['view_id']);
        
        require_once ( SNIPP_BASE . 'db/dbh.php');
        // Create the prepared statement object
        $stmt = $dbh->prepare('SELECT * FROM tsw_snippets WHERE `id` = :id');
        // Bind values to parameters 
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        // Run the SQL 
        $result = $stmt->execute();
        
        if($result){
             
        while ($row = $result->fetchArray()) {
        echo '<h4>Viewing Snippet <span style="font-size:smaller;color:#777">&#34;' . $row['title'] . '&#34;</span></h4>';
            echo '<p>id: ' . $row['id'] . '</p>'; 
            echo '<textarea class="darkeditor" id="viewSnippet">'. $row['contents'] . '</textarea>';
            echo '<h5>' . $row['date_in'] . ' | stat: ' . $row['privi'] . '</h5>';
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
        * process only Edit for selected snippet
        * @param string $id (int)
        */
          
    if( isset( $_POST['edit_id'] ) )
    { ?>
        <h3>Editing Snippet</h3>
        <section class="editsnippet"><?php
        if (!isset($_SESSION['user_session']))
        {
        echo '<a href="http://snippwiki.com/login.php" title="please login" class="btn btn-lg">Please Login If you are going to save a snippet</a>';
        return false;
        } ?>

        <form name="snippet_edit" method="POST" id="snippetEdit" 
            action="<?php echo tsw_clean_url('edit-snippet.php'); ?>"> 
        
        <?php 
        $ided = (int)clean_data($_POST['edit_id']);
        require_once ( SNIPP_BASE . 'db/dbh.php');
        
        // Create the prepared statement object
        $stmt = $dbh->prepare('SELECT * FROM tsw_snippets WHERE `id` = :id');
        // Bind values to parameters 
        $stmt->bindValue(':id', $ided, SQLITE3_INTEGER);
        // Run the SQL 
        $result = $stmt->execute();
        if($result){ 
             
            while ($row = $result->fetchArray()) { 
        echo '<p>id: ' . (int)$row['id'] . ' &lt;pre>&lt;code> & &lt;/pre>&lt;/code> Should be avoided as it <em>may</em> break lines or code.
        <input type="hidden" name="validate_nonce" 
                value="editing_nonce-' . (int)$row['id'] . '"></p>'; 
        echo '<p>Editing Snippet <label for="title" class="control-label">title: </label>
                <input type="text" name="title" value="' . clean_data($row['title']) . '" class="form-control" 
                style="width:82%;float:right;margin: -7px 8px 4px;"></p>';    
        
        echo '<textarea class="darkeditor" id="viewSnippet" name="contents">'. $row['contents'] .'</textarea>';
        echo '<div class="col-md-3 brd-btm">
        <label for="date_in" class="control-label">footnote/date in: </label></div>
        <div class="col-md-9"><input type="text" name="date_in" value="' . clean_data($row['date_in']) . '" class="form-control" 
                style="width: 180px;display:inline;margin-left:1em;"></div>
        <div class="col-md-3 brd-btm"><label for="stats" class="control-label">status: </label></div>
        <div class="col-md-9"><input type="text" name="stats" value="' . (int)$row['stats'] . '" class="form-control" 
                style="width: 120px;display:inline;margin-left:1em;"></div>
        <div class="col-md-3 brd-btm"><label for="privi" class="control-label">owner: </label></div>
        <div class="col-md-9"><input type="text" name="privi" value="' . (int)$row['privi'] . '" class="form-control" 
                style="width: 120px;display:inline;margin-left:1em;" readonly></div>
        <div class="col-md-3 brd-btm"><label for="anchor" class="control-label">reserved: </label></div>
        <div class="col-md-9"><input type="text" name="anchor" value="' . clean_data($row['anchor']) . '" class="form-control" 
                style="width: 120px;display:inline;margin-left:1em;"></div>
        <div class="col-md-12">';
        echo '<input type="hidden" name="editing_nonce" value="editing_nonce-' . (int)$row['id'] . '">
        <input type="submit" name="editing_done" value="update now" 
                class="btn btn-md btn-primary"> </div>
        </form>';

        echo '<aside class="col-md-12 danger-zone">
            
            <h4>Danger Zone!</h4>
            <form name="snippet_delete" method="POST" id="snippet_delete" 
                    action="' . tsw_clean_url('save-snippet.php') . '"> 
            <div class="col-md-6">
                <p><label for="delete_confirm">Check this to confirm DELETING of the above Snippet 
                <input id="delConfirm" type="checkbox" name="delete_confirm" value="1" 
                class="form-inline"></label></p>
            </div>
            <div class="col-md-6 pb-sm">
                <label for="deleting_snippet">Delete Snippet</label> 
                <span id="MsgConfirm" style="visibility: hidden;">
                <input type="submit" id="deleting_snippet" class="btn btn-sm btn-danger" 
                        name="deleting_snippet" value="delete now"></span>
                <input type="hidden" name="delete_snippet" value="'. (int)$row['id'] .'">
            </div>
            </form>  
        </aside>';
            } 
        } else { 
            echo '<h4>no snippet found Or snippet is private Or database is acting up.</h4>'; 
            }
            // Reset the prepared statement 
            // Destroy the object
            $dbh = ''; $ided = ''; 
    } ?>

        </section>
    
        </article><div class="clearfix"></div>
       
        </main>
    </div>
</div>

    <?php include ( SNIPP_BASE . 'footer.php' ); ?>
    <script src="<?php echo SNIPP_BASE; ?>dependant/const-form.js"></script>
</body>
</html>