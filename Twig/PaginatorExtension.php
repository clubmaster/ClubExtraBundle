<?php

namespace Club\ExtraBundle\Twig;

class PaginatorExtension extends \Twig_Extension
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        return array(
            'club_paginator' => new \Twig_Function_Method($this, 'render', array('is_safe' => array('html')))
        );
    }

    public function render()
    {
        $nav = $this->container->get('club_extra.paginator');

        return $this->container->get('templating')->render('ClubExtraBundle:Paginator:paginator.html.twig', array(
            'nav' => $nav
        ));
    }

    public function getName()
    {
        return 'club_paginator';
    }
}
