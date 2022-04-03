<?php

class Task
{
    public $id;

    public $user_id;

    public $title;

    public $description;

    public $status;

    public $comments;

    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->user_id = $data['user_id'];
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->status = $data['status'];
    }

    public function attachComments($comments) {
        $this->comments = $comments;

        return $this;
    }


}
