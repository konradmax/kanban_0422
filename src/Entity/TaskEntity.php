<?php

namespace Max\Dashboard\Entity;

use Max\Dashboard\Entity\BasicEntity;

class TaskEntity extends BasicEntity
{

    public int $user_id;

    public string $title;

    public string $description;

    public $comments = [];

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->user_id = $data['user_id'];
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->image = $data['image'];
        $this->status = $data['status'];
    }

    public function attachComments( $comments = []) {
        $this->comments = $comments;

        return $this;
    }


}
