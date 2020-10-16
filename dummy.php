<?php 
$items = array(
    [
        'title' => 'Page one',
        'body' => 'Hello page one'
    ],
    [
        'title' => 'Page two',
        'body' => 'Hello page two....We are in page two'
    ],
    [
        'title' => 'Page three',
        'body' => 'This is page number 3 yeahhhhhh!'
    ],
    [
        'title' => 'Page Four',
        'body' => 'Yes page four!'
    ],
    [
        'title' => 'Page five',
        'body' => 'Omg we\'re on page five'
    ],
    [
        'title' => 'Page Six',
        'body' => 'Feels like yeasterday but we are on six'
    ],
    [
        'title' => 'Page seven',
        'body' => 'Another new post page seven'
    ],
    [
        'title' => 'Page eight',
        'body' => 'Its page eight!'
    ],
    [
        'title' => 'Page nine',
        'body' => 'We made it to page 9'
    ],
    [
        'title' => 'Page ten',
        'body' => 'This is page ten the final one'
    ],
);

$i = 0;
foreach($items as $item) :
    echo "This is upto page 3 <br>";
    if($i<3) {
        echo $item['title'];
        echo '<br>';
    }


    $i++;
endforeach;
?>