<?php

namespace Club\ExtraBundle\Helper;

class Breadcrumb
{
    protected $items = array();

    public function addItem($name, $route)
    {
        $this->items[] = array(
            'name' => $name,
            'route' => $route
        );

        return $this;
    }

    public function getItems()
    {
        return $this->items;
    }
}
