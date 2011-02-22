    <div id="search_window" class="">
        <form method="post" action="index.php">
            <h3 id="search_tag"> Enter search terms </h3>
            <input type="text" name="search" id="search_input" />
            <input type="submit" id="search_button" />
        </form>

<?
if ($_SESSION['user']->hasAddPerm()) {
    echo '<a href="index.php?cmd=add" style="display:block;">New Entry</a>';
}
echo '</div>';
?>
