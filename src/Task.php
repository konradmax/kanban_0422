<?php

class Task
{
    public int $id;

    public int $user_id;

    public string $title;

    public string $description;

    public int $status;

    public array $comments = [];

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->user_id = $data['user_id'];
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->status = $data['status'];
    }

    public function attachComments(array $comments) {
        $this->comments = $comments;

        return $this;
    }


}
