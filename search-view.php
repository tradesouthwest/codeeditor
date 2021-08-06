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
            <h3>Snippets Search Results</h3>
<article class="viewsnippet">
<section class="snipp-hq-less">
    <form id="lesssnippet" method="POST" action="<?php echo tsw_clean_url('view-snippet.php'); ?>">
    <tcaption><span class="h5">Results, <?php print($username); ?>: </span></tcaption>
    <table class="table-responsive table table-striped table-sm" style="background: #e6e6e6">
        <thead>
        <tr>
        <th>#</th>
        <th>title</th>
        <th>action</th>
        </tr>
        </thead>
        <tbody class="snippet-table-view">
        <?php 
        
        if( isset( $_POST['snippet_search'] ) ) 
        {
            $keyword = $_POST['search_keys'];
            require_once ( SNIPP_BASE . 'db/dbh.php');
            $sql = "SELECT * FROM tsw_snippets WHERE `title` LIKE :keyword";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':keyword', '%' . $keyword . '%');
            $result = $stmt->execute();
                
                if('' != $result)
                {
                    while ($row = $result->fetchArray()) 
                    {

                    echo '<tr>
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['title'] . '</td>
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
                } else 
                    { echo '<tr><td colspan="3">nothing baby</td></tr>'; }
                    $dbh = null; $dbh = '';  
        } else 
                { echo '<tr><td colspan="3">please go back and enter search parameters</td></tr>'; }
        ?>
    </tbody>
    </table>
</section>
</article>

        </main>
    </div>
</div>
    <?php include ( SNIPP_BASE . 'footer.php' ); ?>
</body>
</html>