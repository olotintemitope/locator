<?php

namespace App\Model;

class Location
{
    /**
     * The id of the location.
     * @var int
     */
    public $id;

    /**
     * The name of the location.
     * @var string
     */
    public $name;

    /**
     * The uri of the location.
     * @var string
     */
    public $uri;

    public function __construct(array $data)
    {
        $this->id = $data['woeid'];

        $this->name = $data['name'];

        $this->uri = $data['uri'];
    }
}
