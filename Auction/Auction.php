<?php
/**
 * Class Auction
 * Created by PhpStorm.
 * User: nickl
 * Date: 3/4/14
 * Time: 8:34 PM
 */
Class Auction {
    private $_item;
    private $_active;
    private $_sold;
    private $_end;
    private $_bid;
    static $auctions;

    /**
     * @param Item $item
     */
    function __construct($item) {
        $this->_active = 0;
        $this->_sold = 0;
        $this->_end = 0;
        $this->_item = $item;
        $this->_bid = new Bid();
        self::$auctions[] = $this;
    }

    /**
     * @param $user
     * @param $bid
     * @return bool
     */
    function setBid($user, $bid) {
        if($this->_bid->setBid($bid) && $this->_active) {
            $this->_bid->setUser($user);
            return true;
        }
        return false;
    }

    function getItem() {
        return $this->_item->getName();
    }

    /**
     * @return array
     */
    function getInfo() {
        if($this->_active) {
            $status = "auction is still active";
        } elseif ($this->_end){
            $status = ($this->_sold) ? "auction is successful" : "auction is failed";
        } else {
            $status = "auction hasn't started yet";
        }
        return array(
            "last_bid" => $this->_bid->getBid(),
            "user"     => $this->_bid->getUser(),
            "status"   => $status
        );
    }

    //Auctioneer calls the auction (when s/he makes the judgement on her own that there will be no more higher bids coming in).
    //If the current highest bid is higher than the reserved price of the item, the auction is deemed as a success otherwise it's marked
    //as failure.

    /**
     * @return bool
     */
    function endAuction() {
        if ($this->_active) {
            $this->_active = 0;
            $this->_end = 1;
            if($this->_bid->getBid() > $this->_item->getReserve()) {
                $this->_sold = 1;
            }
            return true;

        }
        return false;
    }

    // Auctioneer starts an auction on an item. The item sold should be no longer available for future auctions.

    /**
     * @return bool
     */
    function startAuction() {
        if(!$this->_sold && !$this->_active) {
            $this->_active = 1;
            return true;
        } else {
            return false;
        }
    }

    //Participant/Auctioneer queries the latest action of an item by item name.
    /**
     * @param $name
     * @return null
     */
    function getAuction($name) {
        foreach(self::$auctions as $auction) {
            if($auction->getItem() === $name) {
                return $auction->getInfo();
            }
        }
        return null;
    }
}