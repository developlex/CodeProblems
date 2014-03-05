<?php
require "Auction.php";
require "Item.php";
require "Bid.php";
/**
 * Created by PhpStorm.
 * User: nickl
 * Date: 3/4/14
 * Time: 8:55 PM
 */

class AuctionTest extends PHPUnit_Framework_TestCase {


    public function testCreateAuction()
    {
        $auction = new Auction(new Item("item1", 25));
        return $auction;
    }

    /**
     * @depends testCreateAuction
     */
    function testStartAuction($auction) {
        $this->assertTrue($auction->startAuction());
        return $auction;
    }

    /**
     * @depends testStartAuction
     */
    function testBid($auction) {
        $this->assertTrue($auction->setBid("Nick", 15));
        return $auction;
    }

    /**
     * @depends testBid
     */
    function testLowerBid($auction) {
        $this->assertFalse($auction->setBid("Jim", 14));
    }

    /**
     * @depends testBid
     */
    function testEndAuction($auction){
        $this->assertTrue($auction->endAuction());
        return $auction;
    }

    /**
     * @depends testEndAuction
     */
    function testStartNonSoldAuction($auction) {
        $this->assertTrue($auction->startAuction());
        return $auction;
    }

    /**
     * @depends testStartNonSoldAuction
     */
    function testStartSoldAuction($auction) {
        $this->assertTrue($auction->setBid("Brian", 27));
        $this->assertTrue($auction->endAuction());
        $this->assertFalse($auction->startAuction());
    }

}