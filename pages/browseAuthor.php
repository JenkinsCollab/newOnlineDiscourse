<?

function cleanArray($var)
{
    return array_filter($var);
}

$numSections=10;

$sql = "SELECT name FROM ".AUTHOR_TABLE." ORDER BY name ASC";
$authors = array();
$rsp = new Response($sql);

//parse out different authors
if($rsp->error!=1){
    foreach ($rsp->get_response() as $resp) {
        $authors[] = ucwords($resp['name']);
    }
}else{
    echo "DB Access Error.";
}

$numPerSection = ceil($rsp->size/$numSections);
$sections =  array();
$sectionRanges=array();

//Put Together the sections
    for($i=0;$i<$numSections;$i++){
        for($j=0;$j<$numPerSection;$j++){
            $sections[$i][$j]=$authors[$j+$i*$numPerSection];
        }
    }
    $sections=array_filter($sections,"cleanArray");

 //Put together the section ranges
$sectionRanges[0][0]=65;
$sectionRanges[sizeof($sections)-1][1]=90;
for($i=0;$i<sizeof($sections)-1;$i++){
    $sectionRanges[$i][1]=ord($sections[$i][sizeof($sections[$i])-1]);
  //  echo $i." ".ord($sections[$i][sizeof($sections[$i])-1])."<br>";
    $sectionRanges[$i+1][0]=$sectionRanges[$i][1]+1;
}
?>

<div id="author_browsing">
    <div class="navigation_2">
        <ul>
            <?//print_r($sectionRanges);
                for($i=0;$i<sizeof($sectionRanges);$i++){
                    $beg =chr($sectionRanges[$i][0]);
                    $end =chr($sectionRanges[$i][1]);
                    echo"<li><a href='#' onclick=\"return browse('".$beg."_".$end."')\">".$beg."-".$end."</a></li>";
                }
            ?>
        </ul>
    </div>
</div>
