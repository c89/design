<?php

/* admin/appraise_finish.html */
class __TwigTemplate_133bf0a743e1f95b14a8ac957752bb2832319aa998a20c88b21c790d5c26a4ec extends Twig_Template
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
        echo "<div id=\"appraise-finish\">
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
        echo "\">未评审作品</a>
               <a href=\"/admin/appraise/finish/?uid=";
        // line 14
        if (isset($context["search"])) { $_search_ = $context["search"]; } else { $_search_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_search_, "uid"), "html", null, true);
        echo "\" class=\"onclick\">已评审作品</a>
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
            ";
            // line 25
            if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
            if ($this->getAttribute($_val_, "content")) {
                // line 26
                echo "                ";
                if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($_val_, "content"));
                foreach ($context['_seq'] as $context["_key"] => $context["va"]) {
                    // line 27
                    echo "                    ";
                    if (isset($context["va"])) { $_va_ = $context["va"]; } else { $_va_ = null; }
                    $context["v"] = json_decode($_va_);
                    // line 28
                    echo "                    <div>
                    ";
                    // line 29
                    if (isset($context["v"])) { $_v_ = $context["v"]; } else { $_v_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_v_, "name"), "html", null, true);
                    echo ": <span style=\"font-family:Georgia, 'Times New Roman', Times, serif; font-size:32px;\">";
                    if (isset($context["v"])) { $_v_ = $context["v"]; } else { $_v_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_v_, "val"), "html", null, true);
                    echo "</span>
                    </div>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['va'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 32
                echo "            ";
            }
            // line 33
            echo "         </div>
         ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['val'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 35
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
        return "admin/appraise_finish.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  127 => 35,  120 => 33,  117 => 32,  104 => 29,  101 => 28,  97 => 27,  91 => 26,  88 => 25,  83 => 24,  78 => 23,  73 => 22,  69 => 20,  64 => 19,  55 => 14,  50 => 13,  45 => 12,  39 => 10,  31 => 4,  28 => 3,);
    }
}
