<?
$numSections = 10;
$sql = "SELECT * FROM " . AUTHOR_TABLE . " ORDER BY name ASC";
$authors = array();
$rsp = new Response($sql);

//parse out different authors
if ($rsp->error != 1) {
    foreach ($rsp->get_response() as $resp) {
        $authors[] = array('name'=>ucwords($resp['name']), 'id'=>$resp['id']);
    }
} else {
    echo "DB Access Error.";
}
?>
<script type="text/javascript">
    var authors = <? echo json_encode($authors); ?>;
</script>


<div id="topSearch" class="">
    <form method="" action="" autocomplete="off">
        <input type="text" name="q" id="q"/>
        <input type="submit" id="search_button" value="Search" />
    </form>
</div>
<div id ="search_results">

</div>
<div id="author_browsing">
    <div class="navigation_2">
        <ul>
<? //print_r($sectionRanges);  ?>
        </ul>
    </div>
</div>


<script type="text/javascript">
    var runningRequest = false;
    var request;

    //Identify the typing action
    $('input#q').keyup(function(e){
        e.preventDefault();
        var $q = $(this);
        
        if($q.val() == ''){
            $('div#results').html('');
            return false;
        }else if(runningRequest){
            //Abort opened requests to speed it up
            runningRequest=false;
        }

        runningRequest=true;
        showResults(authors, $q.val());

        //Create HTML structure for the results and insert it on the result div
        function showResults(data, val){
            var resultHtml = '';
            var reg = new RegExp('(\s)*'+val+'\w*','ig');
            $.each(data, function(i,item){
                if (item.name.match(reg)){
                    resultHtml+='<div class="result">';
                   /* resultHtml+='<h2><a href="#">'+item.name+'</a></h2>';
                    resultHtml+='<p>'+item.post.replace(highlight, '<span class="highlight">'+highlight+'</span>')+'</p>';
                    resultHtml+='<a href="#" class="readMore">Read more..</a>'*/
                        resultHtml+=item.name;
                    resultHtml+='</div>';
                }
            });

            $('div#search_results').html(resultHtml);
        }

        $('form').submit(function(e){
            e.preventDefault();
        });
    });
</script>



