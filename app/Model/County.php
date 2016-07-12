<?php

namespace App\Model;

class County {
    /**
     * The id of the country.
     * @var int
     */
    public $id;

    /**
     * The name of the country.
     * @var string
     */
    public $name;

    /**
     * The uri of the country.
     * @var string
     */
    public $uri;

    public function __construct(array $countiesData)
    {
        $this->id   = $countiesData['woeid'];

        $this->name = $countiesData['name'];

        $this->uri  = $countiesData['uri'];
    }
}