<?php
	
	header('Access-Control-Allow-Origin: *');
	
	date_default_timezone_set('America/New_York');

    // Include the library to use it.
    include_once('lib/simple_html_dom.php');

    $html = file_get_html('https://www.multipool.us/index.php');

    var_dump($html);

    // Put all of the <a> tags into an array named $result
    $result = $html -> find('.med');

    var_dump($result);

    // Run through the array using a foreach loop and print each link out using echo
    //foreach($result as $link) {
    //    echo $link."<br/>";
    //}
?>