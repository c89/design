<?php

/* site/site.html */
class __TwigTemplate_e733d649dbf4acb706b034786abc92f1d212d64253bcece7d3e7069ad67455e2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'menu' => array($this, 'block_menu'),
            'data' => array($this, 'block_data'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no\" />
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
    <title>";
        // line 7
        if (isset($context["common"])) { $_common_ = $context["common"]; } else { $_common_ = null; }
        echo twig_escape_filter($this->env, (($this->getAttribute($_common_, "title", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($_common_, "title"), "设计成就中国")) : ("设计成就中国")), "html", null, true);
        echo "</title>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"/assets/css/style.css\">
    <link rel=\"stylesheet\" href=\"/assets/css/jquery-ui-1.7.1.custom.css\" type=\"text/css\" />
    <link rel=\"Stylesheet\" href=\"/assets/css/ui.slider.extras.css\" type=\"text/css\" />
    <script type=\"text/javascript\" src=\"/assets/js/jquery-1.4.2.min.js\"></script>
    <script type=\"text/javascript\" src=\"/assets/js/jquery-ui-1.7.1.custom.min.js\"></script>
    <script type=\"text/javascript\" src=\"/assets/js/selectToUISlider.jQuery.js\"></script>
    <script type=\"text/javascript\" src=\"/assets/js/md5.min.js\"></script>
    <script type=\"text/javascript\" src=\"/assets/js/app.js\"></script>
</head>
<body>
  <div class=\"header\">
     <div class=\"head_box\">
        <div class=\"logo fl\"></div>
        ";
        // line 21
        $this->displayBlock('menu', $context, $blocks);
        // line 32
        echo "     </div>
  </div>
  <div class=\"w1000 home_text\">
    ";
        // line 35
        $this->displayBlock('data', $context, $blocks);
        // line 37
        echo "  </div>
</body>
</html>
";
    }

    // line 21
    public function block_menu($context, array $blocks = array())
    {
        // line 22
        echo "        <div class=\"nav fr\">
           <a href=\"/review/\" class=\"onclick\">首页</a>
           <a href=\"/review/opus/\">作品预览</a>
           <a href=\"/review/opus/start/\">评审</a>
           <a href=\"/review/opus/finish/\">已评分作品</a>
           <a href=\"/review/profile/\">我的信息</a>
           <a href=\"/review/help/\">帮助</a>
           <a class=\"last\" href=\"/login/out/\">退出</a>
        </div>
        ";
    }

    // line 35
    public function block_data($context, array $blocks = array())
    {
        // line 36
        echo "    ";
    }

    public function getTemplateName()
    {
        return "site/site.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  82 => 36,  79 => 35,  66 => 22,  63 => 21,  56 => 37,  54 => 35,  49 => 32,  47 => 21,  29 => 7,  21 => 1,);
    }
}
