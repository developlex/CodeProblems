<?php
ini_set("auto_detect_line_endings", "1");

/**
 * Class SPLFilterHandler
 * Read the data from CSV file. Format it and send it to ClipsFilter class.
 */
class SPLFilterHandler {

    private $spl_handler;
    private $iterator;
    private $user_filters;
    private $invalid_file_handler;
    private $valid_file_handler;

    /**
     * @param $user_filters
     */
    function __construct( $user_filters ) {
        $this->user_filters = $user_filters;
    }

    /**
     * Read csv file to a new SplFileObject
     */
    public function FileOpen ($source) {
        //check if the file exists
        try {
            $this->spl_handler  = new SplFileObject($source, 'r');
        } catch (RuntimeException $e ) {
            printf("Error openning csv: %s\n", $e->getMessage());
        }
        $this->_prepareData();
    }


    /**
     * Prepare data to work wil filter iterator. Open CSV file where we will write the result and send the handler to the Filter class.
     * Creating an array of arrays. Ex:
     * array(
     *  array(
     *      "id"             => "200019",
     *      "title"          => "Drift Day",
     *      "privacy"        => "users",
     *      "total_plays"    => "205",
     *      "total_comments" => "10",
     *      "total_likes"    => "6"
     *  ),
     * );
     */
    private function _prepareData() {
        try {
            $this->invalid_file_handler = fopen('invalid.csv', 'w');
            $this->valid_file_handler = fopen('valid.csv', 'w');
        } catch (RuntimeException $e ) {
            printf("Error openning csv: %s\n", $e->getMessage());
        }
        //used this example as an aproach http://www.php.net/manual/en/class.filteriterator.php
        $names = explode(",", rtrim($this->spl_handler->getCurrentLine()));
        $this->spl_handler->next();
        $data = array();

        while (!$this->spl_handler->eof()){
            $element = $this->spl_handler->fgetcsv();
            //avoiding an empty line.
            if (count($element) != 1) {
                array_push($data, array_combine($names, $element));
            }
        }
        array_shift($data);
        $object = new ArrayObject($data);
        $this->iterator = new ClipsFilter($object->getIterator(), $this->user_filters, $this->invalid_file_handler, $this->valid_file_handler);
    }

    /**
     * Start execution here and writing a valid result to the file.
     */
    public function Execute() {
        foreach($this->iterator as $value) {
            //first I was writing a valid file here, but later I decided to move it to the same location where I write an invalid one. So this body does nothing
        }
    }
}