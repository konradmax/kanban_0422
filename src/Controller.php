<?php
require_once('ProductDataStore.php');
require_once('View.php');
require_once('SwimlaneModel.php');

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
    }

    public function products()
    {
        $content['page_title'] = "Our Products.";
        $content['content'] = "List of products:";

        $content['products'] = $this->data_store->findAll();

        return $this->view->setContent($content)->render("products");
    }

    public function home()
    {
        $content['page_title'] = "Welcome!";

        return $this->view->setContent($content)->render("home");
    }

    public function swimlane()
    {

        $swimlaneModel = new SwimlaneModel();

        $swimlanes = $swimlaneModel->getTasksByUserAndStatus(1,1);


        $content['page_title'] = "updateSwimlane!";
        $content['swimlanes'] = $swimlanes;
        $content['swimlaneModel'] = $swimlaneModel;

        return $this->view->setContent($content)->render("swimlane");
    }

}