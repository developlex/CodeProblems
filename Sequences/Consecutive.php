<?php
/**
 * Created by PhpStorm.
 * User: nickl
 * Date: 3/4/14
 * Time: 7:37 PM
 *
 * Worst case scenario is O(R(n+1-R)), where R is a run length. There are possible some optimizations
 * to make it O(n) for cases when run length less or equal 3
 *
 * @param $numbers
 * @return array|null
 */
function findConsecutiveRuns($numbers) {
    $run = 3; // set a run length
    $indices = array();
    //loop through the numbers and work with subsequences of a defined run length
    for($i = 0, $length = count($numbers); $i <= $length - $run ; $i++) {
        $consecutiveness = ($numbers[$i] - $numbers[$i+1]);
        //ignore non consecutive numbers, difference between 2 consecutive numbers should be abs(1)
        if (abs($consecutiveness) > 1) {
            continue;
        }
        $subsequence = array_slice($numbers, $i, $run);
        $sign = $consecutiveness/abs($consecutiveness); // define a direction
        $result = checkConsecutiveness($subsequence, $sign); // pass a subsequence with a direction sign
        if (!empty($result["status"])) {
            $indices[] = $i; //condition matches, add current iterator to a final array
        } else {
            $i += $result["index"] - 1; // increase current iterator, skipping elements up to non consecutive number.
        }
    }
    return !empty($indices) ? $indices : null;
}

/**
 * @param $subsequence
 * @param $sign
 * @return array
 */
function checkConsecutiveness($subsequence, $sign){
    for($i = 0, $length = count($subsequence); $i < $length-1; $i++) {
        if($subsequence[$i] != ($subsequence[$i+1] + $sign)) {
            return array(
                "status" => 0,   // condition doesn't match
                "index"  => $i   // current subsequence's iterator where condition doesn't match.
            );
        }
    }
    return array(
        "status" => 1,
    );
}

var_dump(findConsecutiveRuns(array(1, 2, 3, 5, 10, 9, 8, 9, 10, 11, 7))); // [0,4,6,7] for run = 3
var_dump(findConsecutiveRuns(array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11)));  // [0,1,2,3,4,5,6,7,8] for run = 3
var_dump(findConsecutiveRuns(array(10, 9, 7, 5, 4, 3, 2, 1, 2, 3, 4, 7)));// [3,4,5,7,8] for run = 3
var_dump(findConsecutiveRuns(array(10, 9, 7, 5, 3, 2, 0, 2, 3, 5, 7)));  // null for run = 3
