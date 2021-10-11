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

/* marketplace/modification.twig */
class __TwigTemplate_6a6cfa50f50f0dfc6fc13df719e0a70d7c1c1718a112ac41e4ed719af98aa8dc extends \Twig\Template
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
      <div class=\"pull-right\"><a href=\"";
        // line 5
        echo ($context["refresh"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_refresh"] ?? null);
        echo "\" class=\"btn btn-info\"><i class=\"fa fa-refresh\"></i></a> <a href=\"";
        echo ($context["clear"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_clear"] ?? null);
        echo "\" class=\"btn btn-warning\"><i class=\"fa fa-eraser\"></i></a>
        <button type=\"button\" data-toggle=\"tooltip\" title=\"";
        // line 6
        echo ($context["button_delete"] ?? null);
        echo "\" class=\"btn btn-danger\" onclick=\"confirm('";
        echo ($context["text_confirm"] ?? null);
        echo "') ? \$('#form-modification').submit() : false;\"><i class=\"fa fa-trash-o\"></i></button>
      </div>
      <h1>";
        // line 8
        echo ($context["heading_title"] ?? null);
        echo "</h1>
      <ul class=\"breadcrumb\">
        ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 11
            echo "        <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 11);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 11);
            echo "</a></li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "      </ul>
    </div>
  </div>
  <div class=\"container-fluid\">
    ";
        // line 17
        if (($context["error_warning"] ?? null)) {
            // line 18
            echo "    <div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 22
        echo "    ";
        if (($context["success"] ?? null)) {
            // line 23
            echo "    <div class=\"alert alert-success alert-dismissible\"><i class=\"fa fa-check-circle\"></i> ";
            echo ($context["success"] ?? null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 27
        echo "    <div class=\"alert alert-info\"><i class=\"fa fa-info-circle\"></i> ";
        echo ($context["text_refresh"] ?? null);
        echo "</div>
    <div class=\"panel panel-default\">
      <div class=\"panel-heading\">
        <h3 class=\"panel-title\"><i class=\"fa fa-list\"></i> ";
        // line 30
        echo ($context["text_list"] ?? null);
        echo "</h3>
      </div>
      <div class=\"panel-body\">
        ";
        // line 33
        if (($context["modifications"] ?? null)) {
            // line 34
            echo "        <div class=\"form-group\">
          <label class=\"col-sm-2 control-label\">";
            // line 35
            echo ($context["entry_progress"] ?? null);
            echo "</label>
          <div class=\"col-sm-10\">
            <div class=\"progress\">
              <div id=\"progress-bar\" class=\"progress-bar\" style=\"width: 0%;\"></div>
            </div>
            <div id=\"progress-text\"></div>
          </div>
        </div>
        ";
        }
        // line 44
        echo "        <ul class=\"nav nav-tabs\">
          <li class=\"active\"><a href=\"#tab-general\" data-toggle=\"tab\">";
        // line 45
        echo ($context["tab_general"] ?? null);
        echo "</a></li>
          <li><a href=\"#tab-log\" data-toggle=\"tab\">";
        // line 46
        echo ($context["tab_log"] ?? null);
        echo "</a></li>
        </ul>
        <div class=\"tab-content\">
          <div class=\"tab-pane active\" id=\"tab-general\">
            <form action=\"";
        // line 50
        echo ($context["delete"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-modification\">
              <div class=\"table-responsive\">
                <table class=\"table table-bordered table-hover\">
                  <thead>
                    <tr>
                      <td style=\"width: 1px;\" class=\"text-center\"><input type=\"checkbox\" onclick=\"\$('input[name*=\\'selected\\']').prop('checked', this.checked);\" /></td>
                      <td class=\"text-left\">";
        // line 56
        if ((($context["sort"] ?? null) == "name")) {
            // line 57
            echo "                        <a href=\"";
            echo ($context["sort_name"] ?? null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, ($context["order"] ?? null));
            echo "\">";
            echo ($context["column_name"] ?? null);
            echo "</a>
                        ";
        } else {
            // line 59
            echo "                        <a href=\"";
            echo ($context["sort_name"] ?? null);
            echo "\">";
            echo ($context["column_name"] ?? null);
            echo "</a>
                        ";
        }
        // line 60
        echo "</td>
                      <td class=\"text-left\">";
        // line 61
        if ((($context["sort"] ?? null) == "author")) {
            // line 62
            echo "                        <a href=\"";
            echo ($context["sort_author"] ?? null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, ($context["order"] ?? null));
            echo "\">";
            echo ($context["column_author"] ?? null);
            echo "</a>
                        ";
        } else {
            // line 64
            echo "                        <a href=\"";
            echo ($context["sort_author"] ?? null);
            echo "\">";
            echo ($context["column_author"] ?? null);
            echo "</a>
                        ";
        }
        // line 65
        echo "</td>
                      <td class=\"text-left\">";
        // line 66
        if ((($context["sort"] ?? null) == "version")) {
            // line 67
            echo "                        <a href=\"";
            echo ($context["sort_version"] ?? null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, ($context["order"] ?? null));
            echo "\">";
            echo ($context["column_version"] ?? null);
            echo "</a>
                        ";
        } else {
            // line 69
            echo "                        <a href=\"";
            echo ($context["sort_version"] ?? null);
            echo "\">";
            echo ($context["column_version"] ?? null);
            echo "</a>
                        ";
        }
        // line 70
        echo "</td>
                      <td class=\"text-left\">";
        // line 71
        if ((($context["sort"] ?? null) == "status")) {
            // line 72
            echo "                        <a href=\"";
            echo ($context["sort_status"] ?? null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, ($context["order"] ?? null));
            echo "\">";
            echo ($context["column_status"] ?? null);
            echo "</a>
                        ";
        } else {
            // line 74
            echo "                        <a href=\"";
            echo ($context["sort_status"] ?? null);
            echo "\">";
            echo ($context["column_status"] ?? null);
            echo "</a>
                        ";
        }
        // line 75
        echo "</td>
                      <td class=\"text-left\">";
        // line 76
        if ((($context["sort"] ?? null) == "date_added")) {
            // line 77
            echo "                        <a href=\"";
            echo ($context["sort_date_added"] ?? null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, ($context["order"] ?? null));
            echo "\">";
            echo ($context["column_date_added"] ?? null);
            echo "</a>
                        ";
        } else {
            // line 79
            echo "                        <a href=\"";
            echo ($context["sort_date_added"] ?? null);
            echo "\">";
            echo ($context["column_date_added"] ?? null);
            echo "</a>
                        ";
        }
        // line 80
        echo "</td>
                      <td class=\"text-right\">";
        // line 81
        echo ($context["column_action"] ?? null);
        echo "</td>
                    </tr>
                  </thead>
                  <tbody>
                    ";
        // line 85
        if (($context["modifications"] ?? null)) {
            // line 86
            echo "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["modifications"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["modification"]) {
                // line 87
                echo "                    <tr>
                      <td class=\"text-center\">";
                // line 88
                if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["modification"], "modification_id", [], "any", false, false, false, 88), ($context["selected"] ?? null))) {
                    // line 89
                    echo "                        <input type=\"checkbox\" name=\"selected[]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["modification"], "modification_id", [], "any", false, false, false, 89);
                    echo "\" checked=\"checked\" />
                        ";
                } else {
                    // line 91
                    echo "                        <input type=\"checkbox\" name=\"selected[]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["modification"], "modification_id", [], "any", false, false, false, 91);
                    echo "\" />
                        ";
                }
                // line 92
                echo "</td>
                      <td class=\"text-left\">";
                // line 93
                echo twig_get_attribute($this->env, $this->source, $context["modification"], "name", [], "any", false, false, false, 93);
                echo "</td>
                      <td class=\"text-left\">";
                // line 94
                echo twig_get_attribute($this->env, $this->source, $context["modification"], "author", [], "any", false, false, false, 94);
                echo "</td>
                      <td class=\"text-left\">";
                // line 95
                echo twig_get_attribute($this->env, $this->source, $context["modification"], "version", [], "any", false, false, false, 95);
                echo "</td>
                      <td class=\"text-left\">";
                // line 96
                echo twig_get_attribute($this->env, $this->source, $context["modification"], "status", [], "any", false, false, false, 96);
                echo "</td>
                      <td class=\"text-left\">";
                // line 97
                echo twig_get_attribute($this->env, $this->source, $context["modification"], "date_added", [], "any", false, false, false, 97);
                echo "</td>
                      <td class=\"text-right\">
                        <a href=\"";
                // line 99
                echo twig_get_attribute($this->env, $this->source, $context["modification"], "edit", [], "any", false, false, false, 99);
                echo "\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_edit"] ?? null);
                echo "\" class=\"btn btn-success\"><i class=\"fa fa-pencil\"></i></a>
                        <a href=\"";
                // line 100
                echo twig_get_attribute($this->env, $this->source, $context["modification"], "download", [], "any", false, false, false, 100);
                echo "\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_download"] ?? null);
                echo "\" class=\"btn btn-primary\" download=\"";
                echo twig_get_attribute($this->env, $this->source, $context["modification"], "filename", [], "any", false, false, false, 100);
                echo "\"><i class=\"fa fa-download\"></i></a>
                        <button type=\"button\" data-loading-text=\"";
                // line 101
                echo ($context["text_loading"] ?? null);
                echo "\" data-modification-id=\"";
                echo twig_get_attribute($this->env, $this->source, $context["modification"], "modification_id", [], "any", false, false, false, 101);
                echo "\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_upload"] ?? null);
                echo "\"  class=\"btn btn-primary button-upload\"><i class=\"fa fa-upload\"></i></button>
                        ";
                // line 102
                if (twig_get_attribute($this->env, $this->source, $context["modification"], "link", [], "any", false, false, false, 102)) {
                    // line 103
                    echo "                        <a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["modification"], "link", [], "any", false, false, false, 103);
                    echo "\" data-toggle=\"tooltip\" title=\"";
                    echo ($context["button_link"] ?? null);
                    echo "\" class=\"btn btn-info\" target=\"_blank\"><i class=\"fa fa-link\"></i></a>
                        ";
                } else {
                    // line 105
                    echo "                        <button type=\"button\" class=\"btn btn-info\" disabled=\"disabled\"><i class=\"fa fa-link\"></i></button>
                        ";
                }
                // line 107
                echo "                        ";
                if ( !twig_get_attribute($this->env, $this->source, $context["modification"], "enabled", [], "any", false, false, false, 107)) {
                    // line 108
                    echo "                        <a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["modification"], "enable", [], "any", false, false, false, 108);
                    echo "\" data-toggle=\"tooltip\" title=\"";
                    echo ($context["button_enable"] ?? null);
                    echo "\" class=\"btn btn-success\"><i class=\"fa fa-plus-circle\"></i></a>
                        ";
                } else {
                    // line 110
                    echo "                        <a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["modification"], "disable", [], "any", false, false, false, 110);
                    echo "\" data-toggle=\"tooltip\" title=\"";
                    echo ($context["button_disable"] ?? null);
                    echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></a>
                        ";
                }
                // line 111
                echo "</td>
                    </tr>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['modification'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 114
            echo "                    ";
        } else {
            // line 115
            echo "                    <tr>
                      <td class=\"text-center\" colspan=\"7\">";
            // line 116
            echo ($context["text_no_results"] ?? null);
            echo "</td>
                    </tr>
                    ";
        }
        // line 119
        echo "                  </tbody>
                </table>
              </div>
            </form>
            <div class=\"row\">
              <div class=\"col-sm-6 text-left\">";
        // line 124
        echo ($context["pagination"] ?? null);
        echo "</div>
              <div class=\"col-sm-6 text-right\">";
        // line 125
        echo ($context["results"] ?? null);
        echo "</div>
            </div>
          </div>
          <div class=\"tab-pane\" id=\"tab-log\">
            <p>
              <textarea wrap=\"off\" rows=\"15\" class=\"form-control\">";
        // line 130
        echo ($context["log"] ?? null);
        echo "</textarea>
            </p>
            <div class=\"text-center\"><a href=\"";
        // line 132
        echo ($context["clear_log"] ?? null);
        echo "\" class=\"btn btn-danger\"><i class=\"fa fa-eraser\"></i> ";
        echo ($context["button_clear"] ?? null);
        echo "</a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type=\"text/javascript\"><!--
  var step = new Array();
  var total = 0;

  \$('.button-upload').on('click', function() {
    \$('#form-upload').remove();
    var modification_id =  \$(this).attr('data-modification-id');

    \$('body').prepend('<form enctype=\"multipart/form-data\" id=\"form-upload\" style=\"display: none;\"><input type=\"file\" name=\"file\" /></form>');

    \$('#form-upload input[name=\\'file\\']').trigger('click');

    if (typeof timer != 'undefined') {
      clearInterval(timer);
    }

    timer = setInterval(function() {
      if (\$('#form-upload input[name=\\'file\\']').val() != '') {
        clearInterval(timer);

        // Reset everything
        \$('.alert').remove();
        \$('#progress-bar').css('width', '0%');
        \$('#progress-bar').removeClass('progress-bar-danger progress-bar-success');
        \$('#progress-text').html('');

        \$.ajax({
          url: 'index.php?route=marketplace/modification/upload&user_token=";
        // line 167
        echo ($context["user_token"] ?? null);
        echo "&modification_id='+modification_id,
          type: 'post',
          dataType: 'json',
          data: new FormData(\$('#form-upload')[0]),
          cache: false,
          contentType: false,
          processData: false,
          beforeSend: function() {
            \$('#button-upload').button('loading');
          },
          complete: function() {
            \$('#button-upload').button('reset');
          },
          success: function(json) {
            if (json['error']) {
              \$('#progress-bar').addClass('progress-bar-danger');
              \$('#progress-text').html('<div class=\"text-danger\">' + json['error'] + '</div>');
            }

            if (json['step']) {
              step = json['step'];
              total = step.length;

              if (json['overwrite'].length) {
                html = '';

                for (i = 0; i < json['overwrite'].length; i++) {
                  html += json['overwrite'][i] + \"\\n\";
                }

                \$('#overwrite').html(html);

                \$('#button-continue').prop('disabled', false);
              } else {
                next();
              }
            }
          },
          error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
          }
        });
      }
    }, 500);
  });

  function next() {
    data = step.shift();

    if (data) {
      \$('#progress-bar').css('width', (100 - (step.length / total) * 100) + '%');
      \$('#progress-text').html('<span class=\"text-info\">' + data['text'] + '</span>');

      \$.ajax({
        url: data.url,
        type: 'post',
        dataType: 'json',
        data: 'path=' + data.path,
        success: function(json) {
          if (json['error']) {
            \$('#progress-bar').addClass('progress-bar-danger');
            \$('#progress-text').html('<div class=\"text-danger\">' + json['error'] + '</div>');
            \$('#button-clear').prop('disabled', false);
          }

          if (json['success']) {
            \$('#progress-bar').addClass('progress-bar-success');
            \$('#progress-text').html('<span class=\"text-success\">' + json['success'] + '</span>');
          }

          if (!json['error'] && !json['success']) {
            next();
          }
        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
        }
      });
    }
  }
  //--></script>
";
        // line 248
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "marketplace/modification.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  555 => 248,  471 => 167,  431 => 132,  426 => 130,  418 => 125,  414 => 124,  407 => 119,  401 => 116,  398 => 115,  395 => 114,  387 => 111,  379 => 110,  371 => 108,  368 => 107,  364 => 105,  356 => 103,  354 => 102,  346 => 101,  338 => 100,  332 => 99,  327 => 97,  323 => 96,  319 => 95,  315 => 94,  311 => 93,  308 => 92,  302 => 91,  296 => 89,  294 => 88,  291 => 87,  286 => 86,  284 => 85,  277 => 81,  274 => 80,  266 => 79,  256 => 77,  254 => 76,  251 => 75,  243 => 74,  233 => 72,  231 => 71,  228 => 70,  220 => 69,  210 => 67,  208 => 66,  205 => 65,  197 => 64,  187 => 62,  185 => 61,  182 => 60,  174 => 59,  164 => 57,  162 => 56,  153 => 50,  146 => 46,  142 => 45,  139 => 44,  127 => 35,  124 => 34,  122 => 33,  116 => 30,  109 => 27,  101 => 23,  98 => 22,  90 => 18,  88 => 17,  82 => 13,  71 => 11,  67 => 10,  62 => 8,  55 => 6,  45 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "marketplace/modification.twig", "");
    }
}
