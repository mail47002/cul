<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* blog/article_list.twig */
class __TwigTemplate_b115fbf8a7d502a9e351956dbf9a9699cda12c743e3024400a3df57cf0fc06ca extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo ($context["header"] ?? null);
        echo ($context["column_left"] ?? null);
        echo "
<div id=\"content\">
  <div class=\"page-header\">
    <div class=\"container-fluid\">
      <div class=\"pull-right\">
        <button type=\"button\" data-toggle=\"tooltip\" title=\"";
        // line 6
        echo ($context["button_filter"] ?? null);
        echo "\" onclick=\"\$('#filter-article').toggleClass('hidden-sm hidden-xs');\" class=\"btn btn-default hidden-md hidden-lg\"><i class=\"fa fa-filter\"></i></button>
        <a href=\"";
        // line 7
        echo ($context["add"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_add"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-plus\"></i></a>
        <button type=\"submit\" form=\"form-article\" formaction=\"";
        // line 8
        echo ($context["copy"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_copy"] ?? null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-copy\"></i></button>
        <button type=\"submit\" form=\"form-article\" formaction=\"";
        // line 9
        echo ($context["enabled"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_enable"] ?? null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-play\"></i></button>
\t\t<button type=\"submit\" form=\"form-article\" formaction=\"";
        // line 10
        echo ($context["disabled"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_disable"] ?? null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-pause\"></i></button>
\t\t<button type=\"button\" form=\"form-article\" formaction=\"";
        // line 11
        echo ($context["delete"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_delete"] ?? null);
        echo "\" class=\"btn btn-danger\" onclick=\"confirm('";
        echo ($context["text_confirm"] ?? null);
        echo "') ? \$('#form-article').submit() : false;\"><i class=\"fa fa-trash-o\"></i></button>
      </div>
      <h1>";
        // line 13
        echo ($context["heading_title"] ?? null);
        echo "</h1>
      <ul class=\"breadcrumb\">
        ";
        // line 15
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 16
            echo "        <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 16);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 16);
            echo "</a></li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 18
        echo "      </ul>
    </div>
  </div>
  <div class=\"container-fluid\">";
        // line 21
        if (($context["error_warning"] ?? null)) {
            // line 22
            echo "    <div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 26
        echo "    ";
        if (($context["success"] ?? null)) {
            // line 27
            echo "    <div class=\"alert alert-success alert-dismissible\"><i class=\"fa fa-check-circle\"></i> ";
            echo ($context["success"] ?? null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 31
        echo "    <div class=\"row\">
      <div id=\"filter-article\" class=\"col-md-3 col-md-push-9 col-sm-12 hidden-sm hidden-xs\">
        <div class=\"panel panel-default\">
          <div class=\"panel-heading\">
            <h3 class=\"panel-title\"><i class=\"fa fa-filter\"></i> ";
        // line 35
        echo ($context["text_filter"] ?? null);
        echo "</h3>
          </div>
          <div class=\"panel-body\">
            <div class=\"form-group\">
              <label class=\"control-label\" for=\"input-name\">";
        // line 39
        echo ($context["entry_name"] ?? null);
        echo "</label>
\t\t\t  <div class=\"input-group\">
              <input type=\"text\" name=\"filter_name\" value=\"";
        // line 41
        echo ($context["filter_name"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_name"] ?? null);
        echo "\" id=\"input-name\" class=\"form-control\" />
\t\t\t  <div class=\"input-group-btn\">
                    <button type=\"button\" id=\"button-clear-input-name\" class=\"btn btn-default\"><i class=\"fa fa-times\"></i></button>
\t\t\t</div>
\t\t\t</div>
\t\t\t</div>  
            <div class=\"form-group\">
              <label class=\"control-label\" for=\"input-status\">";
        // line 48
        echo ($context["entry_status"] ?? null);
        echo "</label>
              <select name=\"filter_status\" id=\"input-status\" class=\"form-control\">
                <option value=\"\"></option>
                  ";
        // line 51
        if ((($context["filter_status"] ?? null) == "1")) {
            // line 52
            echo "                <option value=\"1\" selected=\"selected\">";
            echo ($context["text_enabled"] ?? null);
            echo "</option>
                  ";
        } else {
            // line 54
            echo "                <option value=\"1\">";
            echo ($context["text_enabled"] ?? null);
            echo "</option>
                  ";
        }
        // line 56
        echo "                  ";
        if ((($context["filter_status"] ?? null) == "0")) {
            // line 57
            echo "\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_disabled"] ?? null);
            echo "</option>
\t\t\t\t  ";
        } else {
            // line 59
            echo "\t\t\t\t<option value=\"0\">";
            echo ($context["text_disabled"] ?? null);
            echo "</option>
                  ";
        }
        // line 61
        echo "              </select>
            </div>
\t\t\t<div class=\"form-group\">
              <label class=\"control-label\" for=\"input-noindex\">";
        // line 64
        echo ($context["entry_noindex"] ?? null);
        echo "</label>
              <select name=\"filter_noindex\" id=\"input-noindex\" class=\"form-control\">
                <option value=\"\"></option>
                  ";
        // line 67
        if ((($context["filter_noindex"] ?? null) == "1")) {
            // line 68
            echo "                <option value=\"1\" selected=\"selected\">";
            echo ($context["text_enabled"] ?? null);
            echo "</option>
                  ";
        } else {
            // line 70
            echo "                <option value=\"1\">";
            echo ($context["text_enabled"] ?? null);
            echo "</option>
                  ";
        }
        // line 72
        echo "                  ";
        if ((($context["filter_noindex"] ?? null) == "0")) {
            // line 73
            echo "                <option value=\"0\" selected=\"selected\">";
            echo ($context["text_disabled"] ?? null);
            echo "</option>
                  ";
        } else {
            // line 75
            echo "                <option value=\"0\">";
            echo ($context["text_disabled"] ?? null);
            echo "</option>
                  ";
        }
        // line 77
        echo "              </select>
\t\t\t</div>
            <div class=\"form-group text-right\">
              <button type=\"button\" id=\"button-filter\" class=\"btn btn-default\"><i class=\"fa fa-filter\"></i> ";
        // line 80
        echo ($context["button_filter"] ?? null);
        echo "</button>
\t\t\t  <button type=\"button\" id=\"button-clear-filter\" class=\"btn btn-default\"><i class=\"fa fa-times\"></i><span class=\"hidden-sm\"> ";
        // line 81
        echo ($context["button_clear"] ?? null);
        echo "</span></button>
            </div>
          </div>
        </div>
      </div>
      <div class=\"col-md-9 col-md-pull-3 col-sm-12\">
        <div class=\"panel panel-default\">
          <div class=\"panel-heading\">
            <h3 class=\"panel-title\"><i class=\"fa fa-list\"></i> ";
        // line 89
        echo ($context["text_list"] ?? null);
        echo "</h3>
          </div>
          <div class=\"panel-body\">
            <form action=\"";
        // line 92
        echo ($context["delete"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-article\">
              <div class=\"table-responsive\">
                <table class=\"table table-bordered table-hover\">
                  <thead>
                    <tr>
                      <td style=\"width: 1px;\" class=\"text-center\"><input type=\"checkbox\" onclick=\"\$('input[name*=\\'selected\\']').prop('checked', this.checked);\" /></td>
                      <td class=\"text-center\">";
        // line 98
        echo ($context["column_image"] ?? null);
        echo "</td>
                      <td class=\"text-left\">";
        // line 99
        if ((($context["sort"] ?? null) == "pd.name")) {
            echo " <a href=\"";
            echo ($context["sort_name"] ?? null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, ($context["order"] ?? null));
            echo "\">";
            echo ($context["column_name"] ?? null);
            echo "</a> ";
        } else {
            echo " <a href=\"";
            echo ($context["sort_name"] ?? null);
            echo "\">";
            echo ($context["column_name"] ?? null);
            echo "</a> ";
        }
        echo "</td>
                      <td class=\"text-left\">";
        // line 100
        if ((($context["sort"] ?? null) == "p.status")) {
            echo " <a href=\"";
            echo ($context["sort_status"] ?? null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, ($context["order"] ?? null));
            echo "\">";
            echo ($context["column_status"] ?? null);
            echo "</a> ";
        } else {
            echo " <a href=\"";
            echo ($context["sort_status"] ?? null);
            echo "\">";
            echo ($context["column_status"] ?? null);
            echo "</a> ";
        }
        echo "</td>
                      <td class=\"text-left\">";
        // line 101
        if ((($context["sort"] ?? null) == "p.noindex")) {
            echo " <a href=\"";
            echo ($context["sort_noindex"] ?? null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, ($context["order"] ?? null));
            echo "\">";
            echo ($context["column_noindex"] ?? null);
            echo "</a> ";
        } else {
            echo " <a href=\"";
            echo ($context["sort_noindex"] ?? null);
            echo "\">";
            echo ($context["column_noindex"] ?? null);
            echo "</a> ";
        }
        echo "</td>
\t\t\t\t\t  <td class=\"text-right\">";
        // line 102
        echo ($context["column_action"] ?? null);
        echo "</td>
                    </tr>
                  </thead>
                  <tbody>
                  
                  ";
        // line 107
        if (($context["articles"] ?? null)) {
            // line 108
            echo "                  ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["articles"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["article"]) {
                // line 109
                echo "                  <tr>
                    <td class=\"text-center\">";
                // line 110
                if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["article"], "article_id", [], "any", false, false, false, 110), ($context["selected"] ?? null))) {
                    // line 111
                    echo "                      <input type=\"checkbox\" name=\"selected[]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["article"], "article_id", [], "any", false, false, false, 111);
                    echo "\" checked=\"checked\" />
                      ";
                } else {
                    // line 113
                    echo "                      <input type=\"checkbox\" name=\"selected[]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["article"], "article_id", [], "any", false, false, false, 113);
                    echo "\" />
                      ";
                }
                // line 114
                echo "</td>
                    <td class=\"text-center\">";
                // line 115
                if (twig_get_attribute($this->env, $this->source, $context["article"], "image", [], "any", false, false, false, 115)) {
                    echo " <img src=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["article"], "image", [], "any", false, false, false, 115);
                    echo "\" alt=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["article"], "name", [], "any", false, false, false, 115);
                    echo "\" class=\"img-thumbnail\" /> ";
                } else {
                    echo " <span class=\"img-thumbnail list\"><i class=\"fa fa-camera fa-2x\"></i></span> ";
                }
                echo "</td>
                    <td class=\"text-left\">";
                // line 116
                echo twig_get_attribute($this->env, $this->source, $context["article"], "name", [], "any", false, false, false, 116);
                echo "</td>
                    <td class=\"text-left\">";
                // line 117
                echo twig_get_attribute($this->env, $this->source, $context["article"], "status", [], "any", false, false, false, 117);
                echo "</td>
\t\t\t\t\t<td class=\"text-left\">";
                // line 118
                echo twig_get_attribute($this->env, $this->source, $context["article"], "noindex", [], "any", false, false, false, 118);
                echo "</td>
                    <td class=\"text-right\">
\t\t\t\t\t\t<a target=\"_blank\" href=\"";
                // line 120
                echo twig_get_attribute($this->env, $this->source, $context["article"], "href_shop", [], "any", false, false, false, 120);
                echo "\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_shop"] ?? null);
                echo "\" class=\"btn btn-success\"><i class=\"fa fa-eye\"></i></a>
\t\t\t\t\t\t<a href=\"";
                // line 121
                echo twig_get_attribute($this->env, $this->source, $context["article"], "edit", [], "any", false, false, false, 121);
                echo "\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_edit"] ?? null);
                echo "\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i></a>
\t\t\t\t\t</td>
                  </tr>
                  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['article'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 125
            echo "                  ";
        } else {
            // line 126
            echo "                  <tr>
                    <td class=\"text-center\" colspan=\"9\">";
            // line 127
            echo ($context["text_no_results"] ?? null);
            echo "</td>
                  </tr>
                  ";
        }
        // line 130
        echo "                    </tbody>
                  
                </table>
              </div>
            </form>
            <div class=\"row\">
              <div class=\"col-sm-6 text-left\">";
        // line 136
        echo ($context["pagination"] ?? null);
        echo "</div>
              <div class=\"col-sm-6 text-right\">";
        // line 137
        echo ($context["results"] ?? null);
        echo "</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type=\"text/javascript\"><!--
\$('#button-filter').on('click', function() {
\tvar url = '';

\tvar filter_name = \$('input[name=\\'filter_name\\']').val();

\tif (filter_name) {
\t\turl += '&filter_name=' + encodeURIComponent(filter_name);
\t}

\tvar filter_status = \$('select[name=\\'filter_status\\']').val();

\tif (filter_status !== '') {
\t\turl += '&filter_status=' + encodeURIComponent(filter_status);
\t}
\t
\tvar filter_noindex = \$('select[name=\\'filter_noindex\\']').val();
\t
\tif (filter_noindex !== '') {
\t\turl += '&filter_noindex=' + encodeURIComponent(filter_noindex);
\t}

\tlocation = 'index.php?route=blog/article&user_token=";
        // line 166
        echo ($context["user_token"] ?? null);
        echo "' + url;
});
\$('#button-clear-filter').on('click', function() {
\tlocation = 'index.php?route=blog/article&user_token=";
        // line 169
        echo ($context["user_token"] ?? null);
        echo "';
});
//--></script> 
  <script type=\"text/javascript\"><!--
// IE and Edge fix!
\$('button[form=\\'form-article\\']').on('click', function(e) {
\t\$('#form-article').attr('action', \$(this).attr('formaction'));
});
  
\$('input[name=\\'filter_name\\']').autocomplete({
\t'source': function(request, response) {
\t\t\$.ajax({
\t\t\turl: 'index.php?route=blog/article/autocomplete&user_token=";
        // line 181
        echo ($context["user_token"] ?? null);
        echo "&filter_name=' +  encodeURIComponent(request),
\t\t\tdataType: 'json',
\t\t\tsuccess: function(json) {
\t\t\t\tresponse(\$.map(json, function(item) {
\t\t\t\t\treturn {
\t\t\t\t\t\tlabel: item['name'],
\t\t\t\t\t\tvalue: item['article_id']
\t\t\t\t\t}
\t\t\t\t}));
\t\t\t}
\t\t});
\t},
\t'select': function(item) {
\t\t\$('input[name=\\'filter_name\\']').val(item['label']);
\t}
});
\$('#button-clear-input-name').on('click',function(){
\t\$('input[name=\\'filter_name\\']').val('');
\t\$('#button-filter').trigger('click');
});
\$('#filter-article').on('keydown', function(e) {
  if (e.keyCode == 13) {
    \$('#button-filter').trigger('click')
  }
});
//--></script></div>
";
        // line 207
        echo ($context["footer"] ?? null);
        echo " ";
    }

    public function getTemplateName()
    {
        return "blog/article_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  511 => 207,  482 => 181,  467 => 169,  461 => 166,  429 => 137,  425 => 136,  417 => 130,  411 => 127,  408 => 126,  405 => 125,  393 => 121,  387 => 120,  382 => 118,  378 => 117,  374 => 116,  362 => 115,  359 => 114,  353 => 113,  347 => 111,  345 => 110,  342 => 109,  337 => 108,  335 => 107,  327 => 102,  309 => 101,  291 => 100,  273 => 99,  269 => 98,  260 => 92,  254 => 89,  243 => 81,  239 => 80,  234 => 77,  228 => 75,  222 => 73,  219 => 72,  213 => 70,  207 => 68,  205 => 67,  199 => 64,  194 => 61,  188 => 59,  182 => 57,  179 => 56,  173 => 54,  167 => 52,  165 => 51,  159 => 48,  147 => 41,  142 => 39,  135 => 35,  129 => 31,  121 => 27,  118 => 26,  110 => 22,  108 => 21,  103 => 18,  92 => 16,  88 => 15,  83 => 13,  74 => 11,  68 => 10,  62 => 9,  56 => 8,  50 => 7,  46 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "blog/article_list.twig", "");
    }
}
