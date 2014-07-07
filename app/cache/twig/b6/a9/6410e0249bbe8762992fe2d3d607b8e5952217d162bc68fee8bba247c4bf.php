<?php

/* admin/appraise_start.html */
class __TwigTemplate_b6a96410e0249bbe8762992fe2d3d607b8e5952217d162bc68fee8bba247c4bf extends Twig_Template
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
        echo "<div id=\"appraise-start\">
    <div class=\"ti_top\">
         <h2><a href=\"/admin/appraise/\">返回列表</a></h2>
     </div>
     <div class=\"ps_list\">
        <div class=\"li\">
           <div class=\"name fl\">";
        // line 10
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_user_, "nickName"), "html", null, true);
        echo "</div>
           <div class=\"op fr\">
               <a href=\"/admin/appraise/assign/?uid=";
        // line 12
        if (isset($context["search"])) { $_search_ = $context["search"]; } else { $_search_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_search_, "uid"), "html", null, true);
        echo "\">分配作品</a>
               <a href=\"/admin/appraise/start/?uid=";
        // line 13
        if (isset($context["search"])) { $_search_ = $context["search"]; } else { $_search_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_search_, "uid"), "html", null, true);
        echo "\" class=\"onclick\">未评审作品</a>
               <a href=\"/admin/appraise/finish/?uid=";
        // line 14
        if (isset($context["search"])) { $_search_ = $context["search"]; } else { $_search_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_search_, "uid"), "html", null, true);
        echo "\">已评审作品</a>
           </div>
        </div>
     </div>
     <div class=\"list\">
        ";
        // line 19
        if (isset($context["data"])) { $_data_ = $context["data"]; } else { $_data_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_data_);
        foreach ($context['_seq'] as $context["_key"] => $context["val"]) {
            // line 20
            echo "         <div class=\"li\">
            <div class=\"pic\"><img src=\"\"></div>
            <p>编号：";
            // line 22
            if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_val_, "number"), "html", null, true);
            echo "</p>
            <p>公司：";
            // line 23
            if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_val_, "company"), "html", null, true);
            echo "</p>
            <p>作品：";
            // line 24
            if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_val_, "name"), "html", null, true);
            echo "</p>
            <p><a class=\"btn\" href=\"#1\" data-pid=\"";
            // line 25
            if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_val_, "productionId"), "html", null, true);
            echo "\" data-uid=\"";
            if (isset($context["search"])) { $_search_ = $context["search"]; } else { $_search_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_search_, "uid"), "html", null, true);
            echo "\" style=\"width:134px; text-align:center; background:#DCDCDC;\">取消分配</a></p>
         </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['val'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 28
        echo "        ";
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
        return "admin/appraise_start.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  101 => 28,  88 => 25,  83 => 24,  78 => 23,  73 => 22,  69 => 20,  64 => 19,  55 => 14,  50 => 13,  45 => 12,  39 => 10,  31 => 4,  28 => 3,);
    }
}
