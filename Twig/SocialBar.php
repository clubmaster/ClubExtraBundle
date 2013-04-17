<?php

namespace Club\ExtraBundle\Twig;

class SocialBar extends \Twig_Extension{

    protected $container;

    /**
     * Constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    public function getName()
    {
        return 'club_social_bar';
    }

    public function getFunctions()
    {
        return array(
            'socialButtons' => new \Twig_Function_Method($this, 'getSocialButtons' ,array('is_safe' => array('html'))),
            'facebookButton' => new \Twig_Function_Method($this, 'getFacebookLikeButton' ,array('is_safe' => array('html'))),
            'twitterButton' => new \Twig_Function_Method($this, 'getTwitterButton' ,array('is_safe' => array('html'))),
            'googlePlusButton' => new \Twig_Function_Method($this, 'getGooglePlusButton' ,array('is_safe' => array('html'))),
        );
    }

    public function getSocialButtons($parameters = array())
    {
        if (!array_key_exists('facebook', $parameters)) {
            if ($this->container->getParameter('club_extra.facebook')) {
                $render_parameters['facebook'] = array();
            } else {
                $render_parameters['facebook'] = false;
            }
        } elseif (is_array($parameters['facebook'])) {
            $render_parameters['facebook'] = $parameters['facebook'];
        } else {
            $render_parameters['facebook'] = false;
        }

        if (!array_key_exists('twitter', $parameters)) {
            if ($this->container->getParameter('club_extra.twitter')) {
                $render_parameters['twitter'] = array();
            } else {
                $render_parameters['twitter'] = false;
            }
        } elseif (is_array($parameters['twitter'])) {
            $render_parameters['twitter'] = $parameters['twitter'];
        } else {
            $render_parameters['twitter'] = false;
        }

        if (!array_key_exists('googleplus', $parameters)) {
            if ($this->container->getParameter('club_extra.googleplus')) {
                $render_parameters['googleplus'] = array();
            } else {
                $render_parameters['googleplus'] = false;
            }
        } elseif (is_array($parameters['googleplus'])) {
            $render_parameters['googleplus'] = $parameters['googleplus'];
        } else {
            $render_parameters['googleplus'] = false;
        }

        // get the helper service and display the template
        return $this->container->get('club.socialBarHelper')->socialButtons($render_parameters);
    }

    //https://developers.facebook.com/docs/reference/plugins/like/
    public function getFacebookLikeButton($parameters = array())
    {
        // default values, you can override the values by setting them
        $parameters = $parameters + array(
            'url' => null,
            'locale' => 'en_US',
            'send' => false,
            'width' => 300,
            'showFaces' => false,
            'layout' => 'button_count',
        );

        return $this->container->get('club.socialBarHelper')->facebookButton($parameters);
    }

    public function getTwitterButton($parameters = array())
    {
        $parameters = $parameters + array(
            'url' => null,
            'locale' => 'en',
            'message' => 'I want to share that page with you',
            'text' => 'Tweet',
            'via' => 'ClubMaster',
            'tag' => 'clubmaster',
        );


        return $this->container->get('club.socialBarHelper')->twitterButton($parameters);
    }

    public function getGooglePlusButton($parameters = array())
    {
        $parameters = $parameters + array(
            'url' => null,
            'locale' => 'en',
            'size' => 'medium',
            'annotation' => 'bubble',
            'width' => '300',
        );

        return $this->container->get('club.socialBarHelper')->googlePlusButton($parameters);
    }
}
