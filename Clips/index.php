<?php

require 'SPLFilterHandler.class.php';
require 'ClipsFilter.class.php';


/**
 * Define user's filters
 * I've created a filtering system, so the module can be reused for different purposed and the filtering conditions can be changed or extended in ClipsFilter class.
 *
 * filters:
 *   equal   -  checks if 2 values are equal
 *   grater  -  checks if one number is grater than provided value
 *   strless -  checks if a string length is less than provided value
 */
$user_filter = array(
"privacy"     => array( 'condition' => 'equal'   , 'value' => 'anybody'),
"total_likes" => array( 'condition' => 'grater'  , 'value' => 10),
"total_plays" => array( 'condition' => 'grater'  , 'value' => 200),
"title"       => array( 'condition' => 'strless' , 'value' => 30),
);

$filterIterator = new SPLFilterHandler($user_filter);
$filterIterator->FileOpen("clips.csv");
$filterIterator->Execute();