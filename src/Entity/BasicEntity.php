<?php

namespace Max\Dashboard\Entity;

class BasicEntity
{
    public int $id;

    public int $status;

    public function getStatus() : ?int
    {
        return $this->status;
    }
}
