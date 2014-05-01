Author: Nicholas Levkovich

1. Coding Problem Sequences
   --------------------
   Given an array of unsorted positive ints, write a function that finds runs of 3 consecutive numbers (ascending or descending) and returns the indices where such runs begin.  If no such runs are found, return null.

   function findConsecutiveRuns(input:Array):Array
   Example:  [1, 2, 3, 5, 10, 9, 8, 9, 10, 11, 7] would return [0, 4, 6, 7]


2. Coding Problem Auction
   --------------------
    Write a backend library for auction house for their online auction system so it supports the following operations (assume that we have a in memory key-value store lib and a unique id generator available)

   Auctioneer adds an item that can be auctioned. An item has a unique name and reserved price


   Auctioneer starts an auction on an item

   Participants submit bids to an auction, a new bid has to have a price higher than the current highest bid otherwise it's not allowed.


   Auctioneer calls the auction (when s/he makes the judgement on her own that there will be no more higher bids coming in). If the current highest bid is higher than the reserved price of the item, the auction is deemed as a success otherwise it's marked as failure. The item sold should be no longer available for future auctions.


   Participant/Auctioneer queries the latest action of an item by item name. The library should return the status of the auction if there is any, if the item is sold, it should return the information regarding the price sold and to whom it was sold to.
   
3. Coding Problem Clip list
   --------------------
    attached is a csv file: clips.csv. your job is to write code that will load in clips.csv and analyze the data against the rules listed below. your code should output the results into two files; valid.csv will contain a list of clip_ids's that passed the tests and invalid.csv will contain a list of clip_id's that failed the tests. requirements are to use php, utilize the SPL FilterIterator, and handle exceptions if a file cannot be read in or written to.

rules:
1.      The clip must be public (privacy == anybody)
2.      The clip must have over 10 likes and over 200 plays
3.      The clip title must be under 30 characters

   
