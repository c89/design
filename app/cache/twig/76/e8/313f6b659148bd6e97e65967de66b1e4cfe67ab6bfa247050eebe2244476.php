<?php

/* site/home.html */
class __TwigTemplate_76e8313f6b659148bd6e97e65967de66b1e4cfe67ab6bfa247050eebe2244476 extends Twig_Template
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
        echo "<div id=\"home\">
     <div class=\"text\">
         <h1>欢迎您担任评审！</h1>
     </div>
     <div class=\"text\">
         <p class=\"fs16\">尊敬的评委，感谢您担任本届大赛的评审，您的参与将使本次大赛更具权威性和影响力。</p>
     </div>
     ";
        // line 11
        if (isset($context["rule"])) { $_rule_ = $context["rule"]; } else { $_rule_ = null; }
        if ($_rule_) {
            // line 12
            echo "     <div class=\"text fs14\">
         <p>本届大赛的评审时间为：</p>
         <p>";
            // line 14
            if (isset($context["rule"])) { $_rule_ = $context["rule"]; } else { $_rule_ = null; }
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($_rule_, "start"), "Y年m月d日"), "html", null, true);
            echo "-";
            if (isset($context["rule"])) { $_rule_ = $context["rule"]; } else { $_rule_ = null; }
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($_rule_, "end"), "Y年m月d日"), "html", null, true);
            echo "。</p>
     </div>
     <div class=\"text\">
         <p class=\"fs14\">评审标准：</p>
     </div>
     <div class=\"text\">
     ";
            // line 20
            if (isset($context["rule"])) { $_rule_ = $context["rule"]; } else { $_rule_ = null; }
            echo $this->getAttribute($_rule_, "desc");
            echo "
     </div>
     ";
        } else {
            // line 23
            echo "        评审活动即将开始，敬请等待...
     ";
        }
        // line 25
        echo "</div>
<input type=\"hidden\" name=\"_\" value=\"/review/\">
";
    }

    public function getTemplateName()
    {
        return "site/home.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  71 => 25,  67 => 23,  60 => 20,  47 => 14,  43 => 12,  40 => 11,  31 => 4,  28 => 3,);
    }
}
