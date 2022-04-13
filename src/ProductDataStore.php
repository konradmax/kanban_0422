<?php

/**
 * Class ProductDataStore
 * A database interface for storing your products!
 */
class ProductDataStore {

    /**
     * Items in the store
     * @var array
     */
    private $data = [];

    /**
     * Validation errors reported by validate()
     * @var array
     */
    private $errors = [];

    /**
     * @var array
     */
    private $columns;

    private $data_source;

    public function __construct($data_source=null)
    {
        $this->columns = array(
            'name', 'price', 'colours', 'image'
        );
        if( null === $data_source ) {
            $this->data_source = "./db/products.txt";
        }
    }

    /**
     * Insert a new item into the data store.
     * @param array $item
     * @return bool
     */
    public function insert($item)
    {
        if ($this->validate($item)) {
            $this->data[] = $item;
            return true;
        }

        return false;
    }

    /**
     * Save changes to the DB
     */
    public function commit()
    {
        $serialized = serialize($this->data);
        return file_put_contents($this->data_source, $serialized);
    }

    /**
     * Validate an item (according to some very simple built-in rules)
     * @param array $item
     * @return bool
     */
    public function validate($item)
    {
        $this->errors = [];

        foreach($this->columns as $columnName) {
            if (empty($item[$columnName])) {
                $this->errors[$columnName] = sprintf("Column <strong>%s</strong> is missing",$columnName);
            }
        }

        return count($this->errors) === 0;
    }

    /**
     * Get the validation errors from the last call to validate()
     * @return array
     */
    public function getValidationErrors()
    {
        return $this->errors;
    }

    /**
     * Get all the items in the store
     * @return array
     */
    public function findAll()
    {
        $serialized = file_get_contents($this->data_source);
        return unserialize($serialized);
    }
}