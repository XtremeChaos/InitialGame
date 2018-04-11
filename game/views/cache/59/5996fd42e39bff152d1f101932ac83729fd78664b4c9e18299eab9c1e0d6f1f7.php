<?php

/* index.html.twig */
class __TwigTemplate_4be905435b990fe546ef1478bcc361f8cc566dfa26d8f277eb08fbf93b54a30b extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("layout.html.twig", "index.html.twig", 1);
        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        echo "
    <h3>Jocul Emagia</h3>
    <h4>Statusul echipelor la inceputul jocului</h4>
    ";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["start_stats"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["start_stat"]) {
            // line 8
            echo "    <div class=\"row\">
        <div class=\"col-xs-12\">
            <h3>Echipa ";
            // line 10
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["start_stat"], "team", array()), "html", null, true);
            echo "</h3>
        </div>
    </div>
    <div class=\"row\">
    ";
            // line 14
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["start_stat"], "fighters", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["fighter"]) {
                // line 15
                echo "        <div class=\"col-sm-4\">
            <p><b>Nume: ";
                // line 16
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["fighter"], "name", array()), "html", null, true);
                echo "</b></p>
            <p>Viata: ";
                // line 17
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["fighter"], "health", array()), "html", null, true);
                echo "</p>
            <p>Viata Ramasa: ";
                // line 18
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["fighter"], "health_remained", array()), "html", null, true);
                echo "</p>
            <p>Putere: ";
                // line 19
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["fighter"], "strength", array()), "html", null, true);
                echo "</p>
            <p>Aparare: ";
                // line 20
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["fighter"], "defence", array()), "html", null, true);
                echo "</p>
            <p>Viteza: ";
                // line 21
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["fighter"], "speed", array()), "html", null, true);
                echo "</p>
            <p>Noroc: ";
                // line 22
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["fighter"], "luck", array()), "html", null, true);
                echo "</p>
            ";
                // line 23
                if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["fighter"], "skills", array())) > 0)) {
                    // line 24
                    echo "            <p>Abilitati:
                <ul>
                    ";
                    // line 26
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["fighter"], "skills", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["skill"]) {
                        // line 27
                        echo "                    <li>
                        <span>Nume: ";
                        // line 28
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["skill"], "name", array()), "html", null, true);
                        echo "</span><br/>
                        <span>Tip: ";
                        // line 29
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["skill"], "type", array()), "html", null, true);
                        echo "</span><br/>
                        <span>Sansa: ";
                        // line 30
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["skill"], "chance", array()), "html", null, true);
                        echo "</span><br/>
                    </li>
                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['skill'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 33
                    echo "                </ul>
            </p>
            ";
                }
                // line 36
                echo "        </div>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['fighter'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 38
            echo "    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['start_stat'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 40
        echo "
    <h4>Desfasurare Lupta:</h4>
    <ul>
        ";
        // line 43
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["logs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["log"]) {
            // line 44
            echo "            <li>";
            echo twig_escape_filter($this->env, $context["log"], "html", null, true);
            echo "</li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['log'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 46
        echo "    </ul>

    <h4>Statusul echipelor la finalul jocului</h4>
    ";
        // line 49
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["end_stats"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["end_stat"]) {
            // line 50
            echo "        <div class=\"row\">
            <div class=\"col-xs-12\">
                ";
            // line 52
            if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["end_stat"], "fighters", array())) > 0)) {
                // line 53
                echo "                    <h3>Echipa ";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["end_stat"], "team", array()), "html", null, true);
                echo "</h3>
                ";
            }
            // line 55
            echo "            </div>
        </div>
        <div class=\"row\">
            ";
            // line 58
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["end_stat"], "fighters", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["fighter"]) {
                // line 59
                echo "                <div class=\"col-sm-4\">
                    <p><b>Nume: ";
                // line 60
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["fighter"], "name", array()), "html", null, true);
                echo "</b></p>
                    <p>Viata: ";
                // line 61
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["fighter"], "health", array()), "html", null, true);
                echo "</p>
                    <p>Viata Ramasa: ";
                // line 62
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["fighter"], "health_remained", array()), "html", null, true);
                echo "</p>
                    <p>Putere: ";
                // line 63
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["fighter"], "strength", array()), "html", null, true);
                echo "</p>
                    <p>Aparare: ";
                // line 64
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["fighter"], "defence", array()), "html", null, true);
                echo "</p>
                    <p>Viteza: ";
                // line 65
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["fighter"], "speed", array()), "html", null, true);
                echo "</p>
                    <p>Noroc: ";
                // line 66
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["fighter"], "luck", array()), "html", null, true);
                echo "</p>
                    ";
                // line 67
                if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["fighter"], "skills", array())) > 0)) {
                    // line 68
                    echo "                        <p>Abilitati:
                        <ul>
                            ";
                    // line 70
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["fighter"], "skills", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["skill"]) {
                        // line 71
                        echo "                                <li>
                                    <span>Nume: ";
                        // line 72
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["skill"], "name", array()), "html", null, true);
                        echo "</span><br/>
                                    <span>Tip: ";
                        // line 73
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["skill"], "type", array()), "html", null, true);
                        echo "</span><br/>
                                    <span>Sansa: ";
                        // line 74
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["skill"], "chance", array()), "html", null, true);
                        echo "</span><br/>
                                </li>
                            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['skill'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 77
                    echo "                        </ul>
                        </p>
                    ";
                }
                // line 80
                echo "                </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['fighter'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 82
            echo "        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['end_stat'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 84
        echo "
";
    }

    public function getTemplateName()
    {
        return "index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  267 => 84,  260 => 82,  253 => 80,  248 => 77,  239 => 74,  235 => 73,  231 => 72,  228 => 71,  224 => 70,  220 => 68,  218 => 67,  214 => 66,  210 => 65,  206 => 64,  202 => 63,  198 => 62,  194 => 61,  190 => 60,  187 => 59,  183 => 58,  178 => 55,  172 => 53,  170 => 52,  166 => 50,  162 => 49,  157 => 46,  148 => 44,  144 => 43,  139 => 40,  132 => 38,  125 => 36,  120 => 33,  111 => 30,  107 => 29,  103 => 28,  100 => 27,  96 => 26,  92 => 24,  90 => 23,  86 => 22,  82 => 21,  78 => 20,  74 => 19,  70 => 18,  66 => 17,  62 => 16,  59 => 15,  55 => 14,  48 => 10,  44 => 8,  40 => 7,  35 => 4,  32 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "index.html.twig", "/var/www/html/emagia3/game/views/templates/index.html.twig");
    }
}
