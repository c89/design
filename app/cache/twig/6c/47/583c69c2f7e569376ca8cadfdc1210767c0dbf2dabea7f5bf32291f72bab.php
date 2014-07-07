<?php

/* admin/profile.html */
class __TwigTemplate_6c47583c69c2f7e569376ca8cadfdc1210767c0dbf2dabea7f5bf32291f72bab extends Twig_Template
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
         <h2>您好，管理员";
        // line 6
        if (isset($context["data"])) { $_data_ = $context["data"]; } else { $_data_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_data_, "nickName"), "html", null, true);
        echo "</h2>
         <div class=\"clear\"></div>
     </div>
     <div class=\"fs16\">
         欢迎回来，<br />
         现在去 <a href=\"/admin/appraise/\">分配作品</a> 给评审
     </div>
     <div class=\"fs14\" style=\"margin-top:20px;\">
           <p>用户名：";
        // line 14
        if (isset($context["data"])) { $_data_ = $context["data"]; } else { $_data_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_data_, "userName"), "html", null, true);
        echo "</p>          
           <p>昵称：";
        // line 15
        if (isset($context["data"])) { $_data_ = $context["data"]; } else { $_data_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_data_, "nickName"), "html", null, true);
        echo "</p>
           <p>邮箱：";
        // line 16
        if (isset($context["data"])) { $_data_ = $context["data"]; } else { $_data_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_data_, "emailAddress"), "html", null, true);
        echo "</p>
           <p>手机：";
        // line 17
        if (isset($context["data"])) { $_data_ = $context["data"]; } else { $_data_ = null; }
        echo twig_escape_filter($this->env, (($this->getAttribute($_data_, "phone", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($_data_, "phone"), $this->getAttribute($_data_, "mobile"))) : ($this->getAttribute($_data_, "mobile"))), "html", null, true);
        echo "</p>
           <p>公司：";
        // line 18
        if (isset($context["data"])) { $_data_ = $context["data"]; } else { $_data_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_data_, "company"), "html", null, true);
        echo "</p>
           <p>职位：";
        // line 19
        if (isset($context["data"])) { $_data_ = $context["data"]; } else { $_data_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_data_, "post"), "html", null, true);
        echo "</p>
           <p>地址：";
        // line 20
        if (isset($context["data"])) { $_data_ = $context["data"]; } else { $_data_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_data_, "address"), "html", null, true);
        echo "</p>
           <!--用户信息，缺少请补全-->
     </div>
</div>
<input type=\"hidden\" name=\"_\" value=\"/admin/profile/\">
";
    }

    public function getTemplateName()
    {
        return "admin/profile.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  77 => 20,  72 => 19,  67 => 18,  62 => 17,  57 => 16,  52 => 15,  47 => 14,  35 => 6,  31 => 4,  28 => 3,);
    }
}
