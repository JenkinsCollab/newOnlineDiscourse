<?php
    //guarantee search input
    if (!isset($_REQUEST['search'])){
        header('location:index.php');
    }

    //build page
    $search = clean_input($_REQUEST['search']);

    //store search terms
    $_SESSION['search_term'] = $search;

    $gui = new GUI();
    echo $gui->buildHeader();
    echo $search == '' ? $gui->buildSearchUI() : $gui->buildSearchResults($search);
    echo $gui->buildFooter();

?>
