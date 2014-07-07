<?php

/* site/help.html */
class __TwigTemplate_c4ddc5647a1d138524584d5c4cb87d6ee31cf18c37207654e0c11bea4e303a96 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("site/site.html");

        $this->blocks = array(
            'data' => array($this, 'block_data'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "site/site.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_data($context, array $blocks = array())
    {
        // line 4
        echo "<div id=\"profile\">
    Help page
</div>
<input type=\"hidden\" name=\"_\" value=\"/review/help/\">
";
    }

    public function getTemplateName()
    {
        return "site/help.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 4,  28 => 3,);
    }
}
