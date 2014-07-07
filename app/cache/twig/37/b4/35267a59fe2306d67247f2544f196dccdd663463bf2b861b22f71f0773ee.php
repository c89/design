<?php

/* site/profile.html */
class __TwigTemplate_37b435267a59fe2306d67247f2544f196dccdd663463bf2b861b22f71f0773ee extends Twig_Template
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
    <div class=\"ti_top\">
         <h2>您好，评委";
        // line 6
        if (isset($context["data"])) { $_data_ = $context["data"]; } else { $_data_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_data_, "nickName"), "html", null, true);
        echo "</h2>
         <div class=\"clear\"></div>
     </div>
     <div class=\"fs16\">
         您还有作品未评审<br />现在去 <a href=\"/review/opus/start/\">评审作品</a> 或者 <a href=\"/review/opus/finish/\">查看已评分作品</a>
     </div>
     <div class=\"fs14\" style=\"margin-top:20px;\">
           <p>用户名：";
        // line 13
        if (isset($context["data"])) { $_data_ = $context["data"]; } else { $_data_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_data_, "userName"), "html", null, true);
        echo "</p>          
           <p>昵称：";
        // line 14
        if (isset($context["data"])) { $_data_ = $context["data"]; } else { $_data_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_data_, "nickName"), "html", null, true);
        echo "</p>
           <p>邮箱：";
        // line 15
        if (isset($context["data"])) { $_data_ = $context["data"]; } else { $_data_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_data_, "emailAddress"), "html", null, true);
        echo "</p>
           <p>手机：";
        // line 16
        if (isset($context["data"])) { $_data_ = $context["data"]; } else { $_data_ = null; }
        echo twig_escape_filter($this->env, (($this->getAttribute($_data_, "phone", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($_data_, "phone"), $this->getAttribute($_data_, "mobile"))) : ($this->getAttribute($_data_, "mobile"))), "html", null, true);
        echo "</p>
           <p>公司：";
        // line 17
        if (isset($context["data"])) { $_data_ = $context["data"]; } else { $_data_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_data_, "company"), "html", null, true);
        echo "</p>
           <p>职位：";
        // line 18
        if (isset($context["data"])) { $_data_ = $context["data"]; } else { $_data_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_data_, "post"), "html", null, true);
        echo "</p>
           <p>地址：";
        // line 19
        if (isset($context["data"])) { $_data_ = $context["data"]; } else { $_data_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_data_, "address"), "html", null, true);
        echo "</p>
           <!--用户信息，缺少请补全-->
     </div>
</div>
<input type=\"hidden\" name=\"_\" value=\"/review/profile/\">
";
    }

    public function getTemplateName()
    {
        return "site/profile.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  76 => 19,  71 => 18,  66 => 17,  61 => 16,  56 => 15,  51 => 14,  46 => 13,  35 => 6,  31 => 4,  28 => 3,);
    }
}
