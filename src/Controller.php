<?php
require_once('ProductDataStore.php');
require_once('View.php');

class Controller {

    /**
     * @var View
     */
    protected $view;

    /**
     * @var ProductDataStore
     */
    protected $data_store;

    /**
     * @var string
     */
    protected $source_file;

    public function __construct()
    {
        $this->view = new View();
        $this->data_store = new ProductDataStore();
        $this->source_file = "./products.csv";
    }

    public function products()
    {
        $content['page_title'] = "Our Products.";
        $content['content'] = "List of products:";

        $content['products'] = $this->data_store->findAll();

        return $this->view->setContent($content)->render("products");
    }

    /**
     * Imports the products from the CSV file into the data storage.
     *
     * Read the CSV file into array.
     *
     * [!] Assumed that the first-line is ALWAYS the column names.
     *
     * @return string
     */
    public function adminImportProducts()
    {
        // read the file from the disk
        if(file_exists($this->source_file)) {
            // init variables
            $header = null;
            $dataParsed = array();
            // shortcut to read lines into an array. Supports the files created on the Macs
            $data = array_map('str_getcsv', file($this->source_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));

            foreach($data as $line) {
                // the first line should be set as header
                if( null === $header ) {
                    $header = $line;
                } else {
                    // read columns into an associative array
                    $dataParsed[] = array_combine($header, $line);
                }
            }

            if( ! empty($dataParsed)) {
                // set each line of data with the data storage
                foreach($dataParsed as $item) {
                    $this->data_store->insert($item);
                }
                // get the [potential] error messages
                $errors = $this->data_store->getValidationErrors();
                if( ! empty($errors)) {
                    // there is some error messages
                    $content['page_title'] = "Errors!";
                    $content['content'] = implode("&#59;&nbsp;",$errors);
                } else {
                    // all good. Import should happen.
                    if( false !== $this->data_store->commit() ) {
                        // commit HAS happened.
                        $content['page_title'] = "Success.";
                        $content['content'] = sprintf("In total <strong>%d</strong> products has been imported.",count($dataParsed));
                    } else {
                        // Commit to the data_store will NOT happen. Check the file permissions.
                        $content['page_title'] = "Errors!";
                        $content['content'] = "problem with commit(). Is the file accessible?";
                    }
                }
            } else {
                // there is no data parsed. is the import-file empty?
                $content['page_title'] = "An error has occured.";
                $content['content'] = "Seems like the import file is empty.";
            }
        } else {
            // the file does not exists
            $content['page_title'] = "An error has occurred.";
            $content['content'] = "Seems like the import file is not present.";
        }

        return $this->view->setContent($content)->render("template");
    }

    public function home()
    {
        $content['page_title'] = "Welcome!";

        return $this->view->setContent($content)->render("home");
    }
}