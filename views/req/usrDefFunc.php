<?php
use app\models\User;

function limit_text($text, $limit) {
    // $text = strip_tags($text);
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '...';
    } else {
    	$text = $text. "...";
    }
    return $text;
}

function custTimeFormat($date) {
    $date = date_create($date);
    return date_format($date, "h : i : s a"). '&emsp;' .date_format($date, "d - M - Y");
}


?>