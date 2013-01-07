<?php

namespace Club\ExtraBundle\Twig;

class BreadcrumbExtension extends \Twig_Extension
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        return array(
            'club_breadcrumb' => new \Twig_Function_Method($this, 'render')
        );
    }

    public function render()
    {
        $items = $this->container->get('club_extra.breadcrumb')->getItems();

        return $this->container->get('templating')->render('ClubExtraBundle:Breadcrumb:breadcrumb.html.twig', array(
            'items' => $items
        ));
    }

    public function getName()
    {
        return 'club_breadcrumb';
    }
}

