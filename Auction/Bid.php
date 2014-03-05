<?php
//Participants submit bids to an auction, a new bid has to have a price higher than the current highest bid otherwise it's not allowed.
/**
 * Class Bid
 * Created by PhpStorm.
 * User: nickl
 * Date: 3/4/14
 * Time: 8:39 PM
 * @package Auctions
 */
Class Bid {
    private $_current_bid;
    private $_user;

    /**
     *
     */
    function __construct() {
        $this->_current_bid = 0;
    }

    /**
     * @param $bid
     * @return bool
     */
    function setBid($bid) {
        if($bid > $this->_current_bid) {
            $this->_current_bid = $bid;
            return true;
        }
        echo "not allowed, the price is lower than current";
        return false;
    }

    /**
     * @return int
     */
    function getBid() {
        return $this->_current_bid;
    }

    /**
     * @param $user
     */
    function setUser($user) {
        $this->_user = $user;
    }

    function getUser() {
        return $this->_user;
    }

}