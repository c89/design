<?php

/* site/opus_show.html */
class __TwigTemplate_5df56cab53abfaea68dc36df4892985cefc96383dc0f9ac0ca24ed40c57993d6 extends Twig_Template
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
        echo "<div id=\"opus-show\">
    <div class=\"ti_top\">
        <div class=\"search\">
            ";
        // line 7
        if (isset($context["search"])) { $_search_ = $context["search"]; } else { $_search_ = null; }
        if ((null === $this->getAttribute($_search_, "status"))) {
            // line 8
            echo "            <form action=\"/review/opus/\">
            ";
        } elseif (($this->getAttribute($_search_, "status") == "0")) {
            // line 10
            echo "            <form action=\"/review/opus/start/\">
            ";
        } else {
            // line 12
            echo "            <form action=\"/review/opus/finish/\">
            ";
        }
        // line 14
        echo "                <span class=\"alm\">编号 / 公司名 / 作品名</span> <input type=\"text\" name=\"name\" value=\"";
        if (isset($context["search"])) { $_search_ = $context["search"]; } else { $_search_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_search_, "name"), "html", null, true);
        echo "\" /> <button class=\"btn\">搜索</button>
            </form>
        </div>
        <div class=\"clear\"></div>
    </div>
    <div class=\"accreditation_list\">
        ";
        // line 20
        if (isset($context["neighbour"])) { $_neighbour_ = $context["neighbour"]; } else { $_neighbour_ = null; }
        if ($this->getAttribute($_neighbour_, "prev")) {
            // line 21
            echo "        ";
            if (isset($context["search"])) { $_search_ = $context["search"]; } else { $_search_ = null; }
            if ((null === $this->getAttribute($_search_, "status"))) {
                // line 22
                echo "        <a href=\"/review/opus/show/?id=";
                if (isset($context["neighbour"])) { $_neighbour_ = $context["neighbour"]; } else { $_neighbour_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_neighbour_, "prev"), "productionId"), "html", null, true);
                echo "\"><div class=\"prev\">上一作品</div></a>
        ";
            } elseif (($this->getAttribute($_search_, "status") == "0")) {
                // line 24
                echo "        <a href=\"/review/opus/show/start/?id=";
                if (isset($context["neighbour"])) { $_neighbour_ = $context["neighbour"]; } else { $_neighbour_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_neighbour_, "prev"), "productionId"), "html", null, true);
                echo "\"><div class=\"prev\">上一作品</div></a>
        ";
            } else {
                // line 26
                echo "        <a href=\"/review/opus/show/finish/?id=";
                if (isset($context["neighbour"])) { $_neighbour_ = $context["neighbour"]; } else { $_neighbour_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_neighbour_, "prev"), "productionId"), "html", null, true);
                echo "\"><div class=\"prev\">上一作品</div></a>
        ";
            }
            // line 28
            echo "
        ";
        }
        // line 30
        echo "        ";
        if (isset($context["neighbour"])) { $_neighbour_ = $context["neighbour"]; } else { $_neighbour_ = null; }
        if ($this->getAttribute($_neighbour_, "next")) {
            // line 31
            echo "        ";
            if (isset($context["search"])) { $_search_ = $context["search"]; } else { $_search_ = null; }
            if ((null === $this->getAttribute($_search_, "status"))) {
                // line 32
                echo "        <a href=\"/review/opus/show/?id=";
                if (isset($context["neighbour"])) { $_neighbour_ = $context["neighbour"]; } else { $_neighbour_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_neighbour_, "next"), "productionId"), "html", null, true);
                echo "\"><div class=\"next\">下一作品</div></a>
        ";
            } elseif (($this->getAttribute($_search_, "status") == "0")) {
                // line 34
                echo "        <a href=\"/review/opus/show/start/?id=";
                if (isset($context["neighbour"])) { $_neighbour_ = $context["neighbour"]; } else { $_neighbour_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_neighbour_, "next"), "productionId"), "html", null, true);
                echo "\"><div class=\"next\">下一作品</div></a>
        ";
            } else {
                // line 36
                echo "        <a href=\"/review/opus/show/finish/?id=";
                if (isset($context["neighbour"])) { $_neighbour_ = $context["neighbour"]; } else { $_neighbour_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_neighbour_, "next"), "productionId"), "html", null, true);
                echo "\"><div class=\"next\">下一作品</div></a>
        ";
            }
            // line 38
            echo "        ";
        }
        // line 39
        echo "
        <div class=\"fs14\">
            <p>编号：";
        // line 41
        if (isset($context["data"])) { $_data_ = $context["data"]; } else { $_data_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_data_, "number"), "html", null, true);
        echo "</p>          
            <p>作品：";
        // line 42
        if (isset($context["data"])) { $_data_ = $context["data"]; } else { $_data_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_data_, "name"), "html", null, true);
        echo "</p>
            <p>公司：";
        // line 43
        if (isset($context["data"])) { $_data_ = $context["data"]; } else { $_data_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_data_, "company"), "html", null, true);
        echo "</p>
        </div>
        <div class=\"accreditation\">
            <div class=\"preview\">
                <div class=\"smallImg\">
                    <div class=\"scrollbutton smallImgUp disabled\"></div>
                    <div id=\"imageMenu\">
                        <ul>
                            ";
        // line 51
        if (isset($context["data"])) { $_data_ = $context["data"]; } else { $_data_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_data_, "resource"));
        foreach ($context['_seq'] as $context["_key"] => $context["val"]) {
            // line 52
            echo "                            <li id=\"onlickImg\"><img src=\"/assets/pic/001.png\" /><span class=\"on\"></span></li>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['val'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 54
        echo "                        </ul>
                    </div>
                    <div class=\"scrollbutton smallImgDown\"></div>
                </div><!--smallImg end-->

                <div id=\"vertical\" class=\"bigImg\">
                    <img src=\"pic/001.png\" id=\"midimg\" />
                    <div style=\"display:none;\" id=\"winSelector\"></div>
                </div><!--bigImg end-->

                <div id=\"bigView\" style=\"display:none;\"><img src=\"\" /></div>

                <!--评分-->
                <div class=\"clear\"></div>
                ";
        // line 68
        if (isset($context["rule"])) { $_rule_ = $context["rule"]; } else { $_rule_ = null; }
        if ($_rule_) {
            // line 69
            echo "                ";
            if (isset($context["rule"])) { $_rule_ = $context["rule"]; } else { $_rule_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_rule_);
            foreach ($context['_seq'] as $context["_key"] => $context["val"]) {
                // line 70
                echo "                <div style=\"margin-top:10px;\">
                    ";
                // line 71
                if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
                if (($this->getAttribute($_val_, "type") == "1")) {
                    // line 72
                    echo "                    <label for=\"valueB\">";
                    if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_val_, "name"), "html", null, true);
                    echo ":</label>
                    <select name=\"rule\" id=\"valueB\" class=\"slider\" data-id=\"";
                    // line 73
                    if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_val_, "id"), "html", null, true);
                    echo "\" data-name=\"";
                    if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_val_, "name"), "html", null, true);
                    echo "\" style=\"display:none\">
                        ";
                    // line 74
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable(range(0, 100));
                    foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                        // line 75
                        echo "                        <option value=\"";
                        if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
                        echo twig_escape_filter($this->env, $_i_, "html", null, true);
                        echo "\">";
                        if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
                        echo twig_escape_filter($this->env, $_i_, "html", null, true);
                        echo "</option>
                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 77
                    echo "                    </select>
                    ";
                } elseif (($this->getAttribute($_val_, "type") == "2")) {
                    // line 79
                    echo "                    <input type=\"checkbox\" name=\"rule\" data-id=\"";
                    if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_val_, "id"), "html", null, true);
                    echo "\" data-name=\"";
                    if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_val_, "name"), "html", null, true);
                    echo "\" />";
                    if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_val_, "name"), "html", null, true);
                    echo "
                    ";
                } else {
                    // line 81
                    echo "                    ";
                    if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_val_, "name"), "html", null, true);
                    echo "
                    <select name=\"rule\" data-id=\"";
                    // line 82
                    if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_val_, "id"), "html", null, true);
                    echo "\" data-name=\"";
                    if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_val_, "name"), "html", null, true);
                    echo "\">
                        <option></option>
                        ";
                    // line 84
                    if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
                    $context["option"] = explode(",", $this->getAttribute($_val_, "value"));
                    // line 85
                    echo "                        ";
                    if (isset($context["option"])) { $_option_ = $context["option"]; } else { $_option_ = null; }
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable($_option_);
                    foreach ($context['_seq'] as $context["_key"] => $context["v"]) {
                        // line 86
                        echo "                        <option value=\"";
                        if (isset($context["v"])) { $_v_ = $context["v"]; } else { $_v_ = null; }
                        echo twig_escape_filter($this->env, $_v_, "html", null, true);
                        echo "\">";
                        if (isset($context["v"])) { $_v_ = $context["v"]; } else { $_v_ = null; }
                        echo twig_escape_filter($this->env, $_v_, "html", null, true);
                        echo "</option>
                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['v'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 88
                    echo "                    </select>
                    ";
                }
                // line 90
                echo "                </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['val'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 92
            echo "                <div style=\"margin-top:20px; padding-bottom:20px; text-align:right;\"><a href=\"#1\" class=\"btn action\">评分</a></div>
                ";
        }
        // line 94
        echo "
                ";
        // line 95
        if (isset($context["content"])) { $_content_ = $context["content"]; } else { $_content_ = null; }
        if ($_content_) {
            // line 96
            echo "                    ";
            if (isset($context["content"])) { $_content_ = $context["content"]; } else { $_content_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_content_);
            foreach ($context['_seq'] as $context["_key"] => $context["val"]) {
                // line 97
                echo "                        ";
                if (isset($context["val"])) { $_val_ = $context["val"]; } else { $_val_ = null; }
                $context["v"] = json_decode($this->getAttribute($_val_, "content"));
                // line 98
                echo "                        <div>
                        ";
                // line 99
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['val'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 102
            echo "                ";
        }
        // line 103
        echo "                </div>
            </div><!--preview end-->
            
            <div class=\"info\">
               ";
        // line 107
        if (isset($context["data"])) { $_data_ = $context["data"]; } else { $_data_ = null; }
        echo $this->getAttribute($_data_, "content");
        echo "
            </div>
            <input type=\"hidden\" name=\"pid\" value=\"";
        // line 109
        if (isset($context["data"])) { $_data_ = $context["data"]; } else { $_data_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_data_, "productionId"), "html", null, true);
        echo "\" />
            <input type=\"hidden\" name=\"aid\" value=\"";
        // line 110
        if (isset($context["data"])) { $_data_ = $context["data"]; } else { $_data_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_data_, "appraiseId"), "html", null, true);
        echo "\" />
        </div>
    </div>
</div>
";
        // line 114
        if (isset($context["search"])) { $_search_ = $context["search"]; } else { $_search_ = null; }
        if ((null === $this->getAttribute($_search_, "status"))) {
            // line 115
            echo "<input type=\"hidden\" name=\"_\" value=\"/review/opus/\">
";
        } elseif (($this->getAttribute($_search_, "status") == "0")) {
            // line 117
            echo "<input type=\"hidden\" name=\"_\" value=\"/review/opus/start/\">
";
        } else {
            // line 119
            echo "<input type=\"hidden\" name=\"_\" value=\"/review/opus/finish/\">
";
        }
    }

    public function getTemplateName()
    {
        return "site/opus_show.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  366 => 119,  362 => 117,  358 => 115,  355 => 114,  347 => 110,  342 => 109,  336 => 107,  330 => 103,  327 => 102,  314 => 99,  311 => 98,  307 => 97,  301 => 96,  298 => 95,  295 => 94,  291 => 92,  284 => 90,  280 => 88,  267 => 86,  261 => 85,  258 => 84,  249 => 82,  243 => 81,  230 => 79,  226 => 77,  213 => 75,  209 => 74,  201 => 73,  195 => 72,  192 => 71,  189 => 70,  183 => 69,  180 => 68,  164 => 54,  157 => 52,  152 => 51,  140 => 43,  135 => 42,  130 => 41,  126 => 39,  123 => 38,  116 => 36,  109 => 34,  102 => 32,  98 => 31,  94 => 30,  90 => 28,  83 => 26,  76 => 24,  69 => 22,  65 => 21,  62 => 20,  51 => 14,  47 => 12,  43 => 10,  39 => 8,  36 => 7,  31 => 4,  28 => 3,);
    }
}
