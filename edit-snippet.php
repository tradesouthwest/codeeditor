<?php 
/**
 * SnippWiki app
 * LICENSE: Apache
 * @author  Larry Judd & Tradesouthwest
 * @link    https://tradesouthwest.com
 */
include 'header.php';
if ( !isset( $_SESSION['user_session'] ) )
{
redirect('index.php'); 
} ?>
<div class="container-fluid">
    <div class="row">
    
        <nav class="col-md-2 sidebar">
            <?php include( SNIPP_BASE . 'sidenav.php'); ?>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <article class="editsnippet border-bottom">
        <?php 
        if( isset( $_POST['editing_done'] ) )
        {  
        $ided     = substr($_POST['editing_nonce'], 14); 
        $title    = clean_input($_POST['title']); 
        $anchor   = (!isset($_POST['anchor'])) ? clean_input($_POST['anchor']) : ''; 
        $contents = clean_data($_POST['contents']);
        $excerpt  = clean_data(trim(substr($_POST["contents"], 0, 80)," "));
        $date_in  = ('' == $_POST['date_in'] ) ? date('Y-m-d H:m:i') 
                    : clean_input($_POST['date_in']);
        $privi    = ('' == $_POST['privi'] ) ? '' : clean_input($_POST['privi']);
        $stats    = (!isset($_POST['stats']) || '' == $_POST['stats']) ? (int)1 
                    : (int)($_POST['stats']);

        require_once ( SNIPP_BASE . 'db/dbh.php');
        
        // Create the prepared statement object
        $stmt = $dbh->prepare('UPDATE tsw_snippets 
                SET `title` = :title, `anchor` = :anchor, `contents` = :contents, 
                `date_in` = :date_in, `privi`= :privi, `stats`= :stats, `excerpt`= :excerpt
                WHERE `id` = :ided');
        // Bind values to parameters 
        $stmt->bindValue(':ided', $ided, SQLITE3_INTEGER);
        $stmt->bindValue(':title',    $title);
        $stmt->bindValue(':anchor',   $anchor);
        $stmt->bindValue(':contents', $contents);
        $stmt->bindValue(':date_in',  $date_in);
        $stmt->bindValue(':privi',    $privi);
        $stmt->bindValue(':stats',    $stats);
        $stmt->bindValue(':excerpt',  $excerpt);

        // Run the SQL 
        $result = $stmt->execute();

            if($result){
            ob_start(); 
            echo '<aside style="min-height: 280px">
            <p><a href="index.php" title="back home" class="btn">Back Home</a></p>
            <p>edited snippet ' . clean_input($title) . '</p>
            <p>id: ' . (int)$ided . '</p>
            <p>' . clean_input($date_in) . '</p>
            </aside>'; 
            $html = ob_get_clean(); 
              
            echo $html; 
            } 
            $dbh = ''; $dbh = null; 
            $ided= $anchor= $title= $stats= $privi= $date_in= $excerpt= $contents='';     
        } ?>     
        </article>
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a href="account-page.php" title="account page" class="btn btn-sm btn-secondary">Account Page</a>
                    <a href="index.php" title="home" class="btn btn-sm btn-secondary">Home Page</a>
                </div>   
            </div>  

        </main>
    </div>
</div>
    <?php include ( SNIPP_BASE . 'footer.php' ); ?>
</body>
</html>