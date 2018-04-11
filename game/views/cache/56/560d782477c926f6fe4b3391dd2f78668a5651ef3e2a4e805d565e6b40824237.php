<?php

/* layout.html.twig */
class __TwigTemplate_95328d1f83c17b5c73e6da8d7252bd77db9ce028c697470d6d7c42ba5bba9eaa extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
    <meta charset=\"UTF-8\" />
    <title>Emag Hero</title>
    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\" integrity=\"sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u\" crossorigin=\"anonymous\">
    <link rel=\"stylesheet\" href=\"game/views/css/style.css\" >
</head>
<body>

    <div class=\"container\">
        ";
        // line 12
        $this->displayBlock('body', $context, $blocks);
        // line 13
        echo "    </div>
</body>
</html>
";
    }

    // line 12
    public function block_body($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "layout.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  46 => 12,  39 => 13,  37 => 12,  24 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "layout.html.twig", "/var/www/html/emagia3/game/views/templates/layout.html.twig");
    }
}
