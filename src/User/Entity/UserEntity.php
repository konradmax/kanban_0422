<?php

namespace Max\Dashboard\User\Entity;

use Max\Dashboard\Common\Entity\BasicEntity;

class UserEntity extends BasicEntity
{

    public int $user_id;

    public string $title;

    public string $description;

    public string $image;

    public array $comments = [];

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->user_id = $data['user_id'];
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->image = $data['image'];
        $this->status = $data['status'];
    }

    public function attachComments(array $comments) {
        $this->comments = $comments;

        return $this;
    }


}
