<?php
//Auctioneer adds an item that can be auctioned. An item has a unique name and reserved price
// To check uniqueness we have to search in the database.
/**
 * Class Item
 * Created by PhpStorm.
 * User: nickl
 * Date: 3/4/14
 * Time: 8:37 PM
 * @package Items
 */
Class Item {
    private $_name;
    private $_reserve_price;

    /**
     * @param $name
     * @param $reserve_price
     */
    function __construct($name, $reserve_price) {
        if($this->_checkUniqueness($name) && $reserve_price > 0) {
            $this->_name = $name;
            $this->_reserve_price = $reserve_price;
        }
    }

    function getName() {
        return $this->_name;
    }

    function getReserve() {
        return $this->_reserve_price;
    }

    /**
     * @return bool
     */
    private function _checkUniqueness () {
        //if unique return true, we assume it's true;
        return true;
    }

}