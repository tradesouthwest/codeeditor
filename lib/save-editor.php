<?php
              
if(isset($_POST['submit']))
{
$title   = $_POST['snippet'];    
$content = $_POST['textarea'];
$dataset = '<h2>' . $title . '</h2><br>' . $content;
$fp = fopen('data.txt', 'a');
fwrite($fp, $dataset);
fclose($fp);
}
header("Location: https://leadspilot.com/test/codeeditor.html");
exit();
?>
