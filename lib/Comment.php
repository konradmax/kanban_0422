<?php

class Comment
{
    public int $id;

    public int $user_id;

    public int $task_id;

    public string $text;

    public int $status;

    public string $date_created;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->user_id = $data['user_id'];
        $this->task_id = $data['task_id'];
        $this->text = $data['text'];
        $this->date_created = $data['date_created'];
        $this->status = $data['status'];
    }

    public function getText()
    {

        return $this->text;
    }

    public function getDate(){

        return $this->date_created;




    }

}
