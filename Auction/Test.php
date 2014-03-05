<?php

// simple test file

require "Item.php";
require "Bid.php";
require "Auction.php";

$auction = new Auction(new Item("item1", 25));
$auction->startAuction();
$auction->setBid("Nick", 15);
$auction->setBid("Tom", 20);
$auction->setBid("Brian", 23);
$auction->setBid("Nick", 27);
$auction->endAuction();
$auction->startAuction();
var_dump($auction->getInfo());
$auction->getAuction("item1");