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
            <h3>Snippets HQ</h3>
            <article class="viewsnippet">
            <?php 
            if (!isset($_SESSION['user_session']))
            {
            echo '<aside style="min-height: 280px"><p><a href="http://snippwiki.com/login.php" title="please login" class="btn btn-lg">Please Login If you are going to work on snippets</a></p>';
            echo '<p><a href="index.php" title="back home" class="btn">Back Home</a></p></aside>';
            } ?>
            
            <section class="snipp-hq-list">
            <form id="viewsnippet" method="POST" action="<?php echo tsw_clean_url('view-snippet.php'); ?>">
            <tcaption><span class="h5">Hello, <?php print($username); ?> - Note: You must use edit button to delete</span></tcaption>
            <table class="table-responsive table table-striped table-sm" style="background: #e6e6e6">
                <thead>
                <tr>
                <th>#</th>
                <th>title</th>
                <th>exceprt</th>
                <th>footnote</th>
                <th>actions</th>
                </tr>
                </thead>
                <tbody class="snippet-table-view">
            <?php 
            $idm = (!isset($_SESSION['login_id'])) ? '' : $_SESSION['login_id'];          
            if ( !empty ( $idm ) ) : 
                require_once ( SNIPP_BASE . 'db/dbh.php');
                // Create the prepared statement object
                $stmt = $dbh->prepare('SELECT * FROM tsw_snippets WHERE `privi` = :idm');
                // Bind values to parameters 
                $stmt->bindValue(':idm', $idm, SQLITE3_INTEGER);
                // Run the SQL 
                $result = $stmt->execute();
                
                if($result)
                {
                while ($row = $result->fetchArray()) 
                {
                echo '<tr>
                <td>' . $row['id'] . '</td>
                <td>' . $row['title'] . '</td>
                <td class="shortened">' . $row['contents'] . '</td>
                <td>' . $row['date_in'] . '</td>
                <td><ul class="list-inline m-sx">
                <li><button name="edit_id" title="edit ' . $row['title'] . '" 
                    class="editids btn btn-sm btn-default" value="'.$row['id'].'" 
                    onClick="document.getElementById(this.form).submit(.form);">
                    edit </button></li> 
                <li><button name="view_id" title="view ' . $row['title'] . '" 
                    class="sendids btn btn-sm btn-default" value="' . $row['id'] . '" 
                    onClick="document.getElementById(this.form).submit(.form);">
                    view </button></li><li>' . $row['id'] . '</li>
                    </ul></td>
                </tr>';
                } 
                } ?> 
                <?php else: 
                echo '<tr><td colspan=5>no snippet found.</td></tr>'; ?>
            <?php 
            endif; ?> 
            
                </tbody>
            </table>
            </form>
            </section>

            </article>

        </main>
    </div>
</div>
    <?php include ( SNIPP_BASE . 'footer.php' ); ?>
</body>
</html>