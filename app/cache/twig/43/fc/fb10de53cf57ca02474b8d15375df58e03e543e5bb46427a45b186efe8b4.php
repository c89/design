<?php

/* site/opus.html */
class __TwigTemplate_43fcfb10de53cf57ca02474b8d15375df58e03e543e5bb46427a45b186efe8b4 extends Twig_Template
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
        echo "<div id=\"opus\">
    <div class=\"ti_top\">
        <h2>作品预览</h2>
        <div class=\"search\">
            ";
        // line 8
        if (isset($context["search"])) { $_search_ = $context["search"]; } else { $_search_ = null; }
        if ((null === $this->getAttribute($_search_, "status"))) {
            // line 9
            echo "            <form action=\"/review/opus/\">
            ";
        } elseif (($this->getAttribute($_search_, "status") == "0")) {
            // line 11
            echo "            <form action=\"/review/opus/start/\">
            ";
        } else {
            // line 13
            echo "            <form action=\"/review/opus/finish/\">
            ";
        }
        // line 15
        echo "                <span class=\"alm\">编号 / 公司名 / 作品名</span> <input type=\"text\" name=\"name\" value=\"";
        if (isset($context["search"])) { $_search_ = $context["search"]; } else { $_search_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_search_, "name"), "html", null, true);
        echo "\" /> <button class=\"btn\">搜索</button>
            </form>
        </div>
        <div class=\"clear\"></div>
    </div>
    <div class=\"classification fs14\"><span>选择类别：</span>
        ";
        // line 21
        if (isset($context["search"])) { $_search_ = $context["search"]; } else { $_search_ = null; }
        if ((null === $this->getAttribute($_search_, "status"))) {
            // line 22
            echo "        <a ";
            if (isset($context["search"])) { $_search_ = $context["search"]; } else { $_search_ = null; }
            if ((!$this->getAttribute($_search_, "category"))) {
                echo " class=\"onclick\" ";
            }
            echo " href=\"/review/opus/\">所有类别</a>
        ";
        } elseif (($this->getAttribute($_search_, "status") == "0")) {
            // line 24
            echo "        <a ";
            if (isset($context["search"])) { $_search_ = $context["search"]; } else { $_search_ = null; }
            if ((!$this->getAttribute($_search_, "category"))) {
                echo " class=\"onclick\" ";
            }
            echo " href=\"/review/opus/start/\">所有类别</a>
        ";
        } else {
            // line 26
            echo "        <a ";
            if (isset($context["search"])) { $_search_ = $context["search"]; } else { $_search_ = null; }
            if ((!$this->getAttribute($_search_, "category"))) {
                echo " class=\"onclick\" ";
            }
            echo " href=\"/review/opus/finish/\">所有类别</a>
        ";
        }
        // line 28
        echo "        ";
        if (isset($context["category"])) { $_category_ = $context["category"]; } else { $_category_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_category_);
        foreach ($context['_seq'] as $context["_key"] => $context["val"]) {
            // line 29
            echo "            ";
            if (isset($context["search"])) { $_search_ = $context["search"]; } else { $_search_ = null; }
            if ((null === $this->getAttribute($_search_, "status"))) {
                // line 30
                echo "            <a ";
                if (isset($context["search"])) { $_search_ = $context["search"]; } else { $_search_ = null; }
                if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
                if (($this->getAttribute($_search_, "category") == $this->getAttribute($_val_, "categoryId"))) {
                    echo " class=\"onclick\" ";
                }
                echo " href=\"/review/opus/?category=";
                if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_val_, "categoryId"), "html", null, true);
                echo "\">";
                if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_val_, "name"), "html", null, true);
                echo "</a>
            ";
            } elseif (($this->getAttribute($_search_, "status") == "0")) {
                // line 32
                echo "            <a ";
                if (isset($context["search"])) { $_search_ = $context["search"]; } else { $_search_ = null; }
                if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
                if (($this->getAttribute($_search_, "category") == $this->getAttribute($_val_, "categoryId"))) {
                    echo " class=\"onclick\" ";
                }
                echo " href=\"/review/opus/start/?category=";
                if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_val_, "categoryId"), "html", null, true);
                echo "\">";
                if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_val_, "name"), "html", null, true);
                echo "</a>
            ";
            } else {
                // line 34
                echo "            <a ";
                if (isset($context["search"])) { $_search_ = $context["search"]; } else { $_search_ = null; }
                if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
                if (($this->getAttribute($_search_, "category") == $this->getAttribute($_val_, "categoryId"))) {
                    echo " class=\"onclick\" ";
                }
                echo " href=\"/review/opus/finish/?category=";
                if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_val_, "categoryId"), "html", null, true);
                echo "\">";
                if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_val_, "name"), "html", null, true);
                echo "</a>
            ";
            }
            // line 36
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['val'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 37
        echo "    </div>
    <div class=\"list\">
        ";
        // line 39
        if (isset($context["data"])) { $_data_ = $context["data"]; } else { $_data_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_data_);
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["val"]) {
            // line 40
            echo "        <div class=\"li\">
            <div class=\"pic\">
            ";
            // line 42
            if (isset($context["search"])) { $_search_ = $context["search"]; } else { $_search_ = null; }
            if ((null === $this->getAttribute($_search_, "status"))) {
                // line 43
                echo "            <a href=\"/review/opus/show/";
                if (isset($context["search"])) { $_search_ = $context["search"]; } else { $_search_ = null; }
                if ((!(null === $this->getAttribute($_search_, "status")))) {
                    echo "/";
                    if (isset($context["search"])) { $_search_ = $context["search"]; } else { $_search_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_search_, "status"), "html", null, true);
                    echo "/";
                }
                echo "?id=";
                if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_val_, "productionId"), "html", null, true);
                echo "\"><img src=\"/assets/upload/";
                if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_val_, "img"), "html", null, true);
                echo "\" /></a>
            ";
            } elseif (($this->getAttribute($_search_, "status") == "0")) {
                // line 45
                echo "            <a href=\"/review/opus/show/start/?id=";
                if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_val_, "productionId"), "html", null, true);
                echo "\"><img src=\"/assets/upload/";
                if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_val_, "img"), "html", null, true);
                echo "\" /></a>
            ";
            } else {
                // line 47
                echo "            <a href=\"/review/opus/show/finish/?id=";
                if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_val_, "productionId"), "html", null, true);
                echo "\"><img src=\"/assets/upload/";
                if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_val_, "img"), "html", null, true);
                echo "\" /></a>
            ";
            }
            // line 49
            echo "            </div>
            <p>编号：";
            // line 50
            if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_val_, "number"), "html", null, true);
            echo "</p>
            <p>公司：";
            // line 51
            if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_val_, "company"), "html", null, true);
            echo "</p>
            <p>作品：";
            // line 52
            if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_val_, "name"), "html", null, true);
            echo "</p>
            <p>状态：";
            // line 53
            if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
            if (($this->getAttribute($_val_, "status") == "1")) {
                echo "已评审";
            } else {
                echo "未评审";
            }
            echo "</p>
            </div>
        ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 56
            echo "        <div>暂无作品，请稍等</div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['val'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 58
        echo "        ";
        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
        echo $_pagination_;
        echo "
    </div>
</div>
";
        // line 61
        if (isset($context["search"])) { $_search_ = $context["search"]; } else { $_search_ = null; }
        if ((null === $this->getAttribute($_search_, "status"))) {
            // line 62
            echo "<input type=\"hidden\" name=\"_\" value=\"/review/opus/\">
";
        } elseif (($this->getAttribute($_search_, "status") == "0")) {
            // line 64
            echo "<input type=\"hidden\" name=\"_\" value=\"/review/opus/start/\">
";
        } else {
            // line 66
            echo "<input type=\"hidden\" name=\"_\" value=\"/review/opus/finish/\">
";
        }
        // line 68
        echo "
";
    }

    public function getTemplateName()
    {
        return "site/opus.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  273 => 68,  269 => 66,  265 => 64,  261 => 62,  258 => 61,  250 => 58,  243 => 56,  230 => 53,  225 => 52,  220 => 51,  215 => 50,  212 => 49,  202 => 47,  192 => 45,  174 => 43,  171 => 42,  167 => 40,  161 => 39,  157 => 37,  151 => 36,  135 => 34,  119 => 32,  103 => 30,  99 => 29,  93 => 28,  84 => 26,  75 => 24,  66 => 22,  63 => 21,  52 => 15,  48 => 13,  44 => 11,  40 => 9,  37 => 8,  31 => 4,  28 => 3,);
    }
}
