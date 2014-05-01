<?php
/**
 * Class ClipsFilter
 * Extends FilterIterator. Data is being filtered through this class.
 */
class ClipsFilter extends FilterIterator
{
    private $clips_filter;
    private $invalid_file_handler;
    private $valid_file_handler;


    /**
     * @param Iterator $iterator
     * @param $filter
     * @param $invalid_file_handler
     * @param $valid_file_handler
     */
    public function __construct(Iterator $iterator , $filter, $invalid_file_handler, $valid_file_handler ) {
        parent::__construct($iterator);
        $this->clips_filter = $filter;
        $this->invalid_file_handler = $invalid_file_handler;
        $this->valid_file_handler   = $valid_file_handler;
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Check whether the current element of the iterator is acceptable
     *
     * Extended to write the data to the file from this function.
     *
     * @link http://php.net/manual/en/filteriterator.accept.php
     * @return bool true if the current element is acceptable, otherwise false.
     */
    public function accept() {
        $line = $this->getInnerIterator()->current();
        foreach ($this->clips_filter as $key => $value) {
           if (!call_user_func( "ClipsFilter::".$this->clips_filter[$key]["condition"], $line, $key, $this->clips_filter[$key]["value"])) {

               $this->writeFile($this->invalid_file_handler, $line);
               return false;
           }
        }
        $this->writeFile($this->valid_file_handler, $line);
        return true;
    }

    /**
     * @param $line
     * @param $key
     * @param $value
     * @return bool
     */
    private function grater($line, $key, $value) {
        if( $line[$key] > $value) {
            return true;
        }
        return false;
    }

    /**
     * @param $line
     * @param $key
     * @param $value
     * @return bool
     */
    private function equal($line, $key, $value) {
       if( $line[$key] == $value) {
           return true;
       }
       return false;
    }

    /**
     * @param $line
     * @param $key
     * @param $value
     * @return bool
     */
    private function strless($line, $key, $value) {
        if( strlen($line[$key]) < $value) {
            return true;
        }
        return false;
    }

    /**
     * @param $fp
     * @param $line
     */
    private function writeFile($fp, $line) {
        try {
            fputcsv($fp, $line);
        } catch (RuntimeException $e ) {
            printf("Error openning csv: %s\n", $e->getMessage());
        }
    }
}







