<?php

/* admin/appraise.html */
class __TwigTemplate_f0caf0105e53b3abc31e87f31e056961022ff8a8a8a6321d4f92105060409a7b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("admin/admin.html");

        $this->blocks = array(
            'data' => array($this, 'block_data'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "admin/admin.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_data($context, array $blocks = array())
    {
        // line 4
        echo "<div id=\"appraise\">
    <div class=\"ti_top\">
         <h2>评审</h2>
     </div>
     <div class=\"ps_list\">
        ";
        // line 9
        if (isset($context["data"])) { $_data_ = $context["data"]; } else { $_data_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_data_);
        foreach ($context['_seq'] as $context["_key"] => $context["val"]) {
            // line 10
            echo "        <div class=\"li\">
           <div class=\"name fl\">";
            // line 11
            if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_val_, "nickName"), "html", null, true);
            echo "</div>
           <div class=\"op fr\">
            <a href=\"/admin/appraise/assign/?uid=";
            // line 13
            if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_val_, "userId"), "html", null, true);
            echo "\">分配作品</a>
            <a href=\"/admin/appraise/start/?uid=";
            // line 14
            if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_val_, "userId"), "html", null, true);
            echo "\">未评审作品</a>
            <a href=\"/admin/appraise/finish/?uid=";
            // line 15
            if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_val_, "userId"), "html", null, true);
            echo "\">已评审作品</a>
           </div>
        </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['val'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 19
        echo "
        ";
        // line 20
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "
     </div>
</div>

<input type=\"hidden\" name=\"_\" value=\"/admin/appraise/\">

";
    }

    public function getTemplateName()
    {
        return "admin/appraise.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  76 => 20,  73 => 19,  62 => 15,  57 => 14,  52 => 13,  46 => 11,  43 => 10,  38 => 9,  31 => 4,  28 => 3,);
    }
}
