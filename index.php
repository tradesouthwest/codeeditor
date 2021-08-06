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
        <h3>Add New Snippet <span class="h5">(You must be logged in to add a Snippet)</span></h3>
    <div class="new-snipp-form">
        <form class="form" role="form" method="post" id="editForm" 
              action="<?php echo tsw_clean_url('save-snippet.php'); ?>">
        <label for="title" class="control-label">title</label><br>
        <input type="text" class="form-control" id="title" name="title" 
              placeholder="required" value="" required>
        </div><div>
        <label for="contents" class="control-label">snippet</label><br>
        <textarea class="darkeditor" id="textareaDark" name="contents"></textarea>
        </div>

<?php $idm = (!isset($_SESSION['login_id'])) ? '' : $_SESSION['login_id']; ?>

        <table><tbody class="snipp-foot">
        <tr><td>
        <label for="anchor" class="control-label">footnote: leave empty to insert date</label></td><td>
        <input type="text" class="form-control" id="anchor" name="anchor" 
                placeholder="optional" value="">
        </td></tr><td>
        <label for="privi" class="control-label">owner</label></td><td>
        <input type="number" class="form-control" id="privi" name="privi" 
              placeholder="" value="<?php echo $idm; ?>" readonly>
        </td></tr><td>
        <label for="stats" class="control-label">status: 1=publish; 0=private</label></td><td>
        <input type="number" class="form-control" id="stats" name="stats" 
              placeholder="optional" value="">
        </td></tr><td>
        <label for="submit_new">save gist </label></td><td>
        <input id="submit_new" name="submit_new" type="submit" value="Add New Gist" 
              class="btn btn-primary">
        </td></tr></tbody></table>
        </form>
    </div>
        <div class="table-responsive">
        <form id="viewsnippet" method="POST" action="<?php echo tsw_clean_url( SNIPP_BASE . 'view-snippet.php'); ?>">
            <tcaption><span class="h4">viewing last 12 snippets</span></tcaption>
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                  <th>#</th>
                  <th>title</th>
                  <th>exceprt</th>
                  <th>footnote</th>
                  <th>anchor</th>
                  </tr>
                  </thead>
            <tbody class="snippet-table-view">
            <?php 
                  
            require_once ( SNIPP_BASE . 'db/dbh.php');
            $stats = (int)1;
            $stmt = $dbh->prepare('SELECT * FROM tsw_snippets WHERE `stats` = :stats
                                   ORDER BY `id` DESC');
            // Bind values to parameters 
            $stmt->bindValue(':stats', $stats, SQLITE3_INTEGER);
            // Run the SQL 
            $result = $stmt->execute();
            if($result){
             
            while ($row = $result->fetchArray()) {
            echo '<tr>
            <td>' . $row['id'] . '</td>
            <td>' . $row['title'] . '</td>
            <td class="shortened">' . trim( strip_tags( $row["excerpt"] ), '<pre><code> </code></pre>') . '</td>
            <td>' . $row['date_in'] . '</td>
            <td><button type="input" name="view_id" title="' . $row['title'] . '" 
              class="sendids btn btn-sm btn-default" value="' . $row['id'] . '" 
              onClick="document.getElementById(this.form).submit(.form);">
              view ' . $row['id'] . '</button></td>
            </tr>';
            } ?>
            <?php 
            $dbh = '';
            $id = ''; 
        } else { 
            echo '<tr><td colspan=5>no snippet found Or snippet is private Or database is acting up.</td></tr>'; 
        }
        ?> 
                
                </tbody>
            </table>
        </form>
          </div>
        </main>
      </div>
    </div>
    
<?php include( SNIPP_BASE . 'footer.php'); ?>
    
  </body>
</html>