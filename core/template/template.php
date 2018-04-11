<?php

namespace core\template;

use Twig_Loader_Filesystem;
use Twig_Environment;
use Twig_TemplateWrapper;

class template{

    private $loader;
    private $twig;
    /**
     * @var Twig_TemplateWrapper template
     */
    private $template;

    public function __construct( string $path_to_templates = '' )
    {
        if( empty($path_to_templates) ){
            $path_to_templates = __DIR__.'/../../game/views/templates';
        }

        $this->loader = new Twig_Loader_Filesystem($path_to_templates);

        $cache = false;
        if ( getConfigItem('templateCache') === true ) {
            $cache = __DIR__.'/../../game/views/cache';
        }
        $this->twig = new Twig_Environment($this->loader, array(
            'cache' => $cache
        ));
    }

    public function loadLayout( string $location ): void{
        $this->template = $this->twig->load($location);
    }

    public function render( array $data = [] ){
        return $this->template->render($data);
    }

    public function renderBlock( string $block, array $data = [] ){
        return $this->template->renderBlock($block,$data);
    }

}
