<?require_once('../include/kernel.php');?>
<html>
    <head>
    <body>


<?	

$sql = "SELECT * FROM " . AUTHOR_TABLE . " ORDER BY name ASC";
$authors = array();
$rsp = new Response($sql);

if ($rsp->error != 1) {
    foreach ($rsp->get_response() as $resp) {
        $authors[] = array('name'=>ucwords($resp['name']), 'id'=>$resp['id']);

        echo ucwords($resp['name'])." ".$resp['id']."<br>";
    }
}
?>
        
    </body>
    </head>
</html>

