<?php

namespace APY\BreadcrumbTrailBundle\Twig;


use APY\BreadcrumbTrailBundle\BreadcrumbTrail\Trail;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class TitleExtension
 */
class TitleExtension extends \Twig_Extension
{
    /** @var Trail $_trail */
    private $_trail;

    /** @var TranslatorInterface $_translator */
    private $_translator;

    public function __construct(Trail $trail, TranslatorInterface $translator)
    {
        $this->_trail = $trail;
        $this->_translator = $translator;
    }

    public function getGlobals()
    {
        return array(
            'pageTitle' => $this->returnCurrentBreadcrumb()
        );
    }

    public function returnCurrentBreadcrumb()
    {
        $title = '';
        $domain = '';

        foreach($this->_trail as $breadcrumb) {
            $title = $breadcrumb->title;
            $domain = $breadcrumb->domain;
        }

        return $this->_translator->trans($title, [], $domain);
    }

    public function getName()
    {
        return 'pageTitleRender';
    }
}