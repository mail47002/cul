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

/* blog/setting.twig */
class __TwigTemplate_0fb40213a7cad182807b41307ebd18f0ec34721f5bf66797ccc4b4fabba5b595 extends \Twig\Template
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
        <button type=\"submit\" form=\"form-setting\" data-toggle=\"tooltip\" title=\"";
        // line 6
        echo ($context["button_save"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-save\"></i></button>
        <a href=\"";
        // line 7
        echo ($context["cancel"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_cancel"] ?? null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-reply\"></i></a></div>
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
            echo "    <div class=\"alert alert-danger\"><i class=\"fa fa-exclamation-circle\"></i> ";
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
            echo "    <div class=\"alert alert-success\"><i class=\"fa fa-check-circle\"></i> ";
            echo ($context["success"] ?? null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 27
        echo "    <div class=\"panel panel-default\">
      <div class=\"panel-heading\">
        <h3 class=\"panel-title\"><i class=\"fa fa-pencil\"></i> ";
        // line 29
        echo ($context["text_edit"] ?? null);
        echo "</h3>
      </div>
      <div class=\"panel-body\">
        <form action=\"";
        // line 32
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-setting\" class=\"form-horizontal\">
          <ul class=\"nav nav-tabs\">
\t\t\t<li class=\"active\"><a href=\"#tab-general\" data-toggle=\"tab\">";
        // line 34
        echo ($context["tab_general"] ?? null);
        echo "</a></li>
            <li><a href=\"#tab-option\" data-toggle=\"tab\">";
        // line 35
        echo ($context["tab_option"] ?? null);
        echo "</a></li>
            <li><a href=\"#tab-image\" data-toggle=\"tab\">";
        // line 36
        echo ($context["tab_image"] ?? null);
        echo "</a></li>
          </ul>
          <div class=\"tab-content\">
\t\t  <div class=\"tab-pane active\" id=\"tab-general\">
\t\t\t\t<div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-name\">";
        // line 41
        echo ($context["entry_name"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"configblog_name\" value=\"";
        // line 43
        echo ($context["configblog_name"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_name"] ?? null);
        echo "\" id=\"input-name\" class=\"form-control\" />
                  </div>
                </div>
\t\t\t\t<div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-h1\">";
        // line 47
        echo ($context["entry_html_h1"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"configblog_html_h1\" value=\"";
        // line 49
        echo ($context["configblog_html_h1"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_html_h1"] ?? null);
        echo "\" id=\"input-h1\" class=\"form-control\" />
                  </div>
                </div>
\t\t\t\t<div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-meta-title\">";
        // line 53
        echo ($context["entry_meta_title"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"configblog_meta_title\" value=\"";
        // line 55
        echo ($context["configblog_meta_title"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_meta_title"] ?? null);
        echo "\" id=\"input-meta-title\" class=\"form-control\" />
                  </div>
                </div>
\t\t\t\t<div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-meta-description\">";
        // line 59
        echo ($context["entry_meta_description"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <textarea name=\"configblog_meta_description\" rows=\"5\" placeholder=\"";
        // line 61
        echo ($context["entry_meta_description"] ?? null);
        echo "\" id=\"input-meta-description\" class=\"form-control\">";
        echo ($context["configblog_meta_description"] ?? null);
        echo "</textarea>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-meta-keyword\">";
        // line 65
        echo ($context["entry_meta_keyword"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <textarea name=\"configblog_meta_keyword\" rows=\"5\" placeholder=\"";
        // line 67
        echo ($context["entry_meta_keyword"] ?? null);
        echo "\" id=\"input-meta-keyword\" class=\"form-control\">";
        echo ($context["configblog_meta_keyword"] ?? null);
        echo "</textarea>
                  </div>
                </div>
\t\t  </div>
            <div class=\"tab-pane\" id=\"tab-option\">
              <fieldset>
                <legend>";
        // line 73
        echo ($context["text_article"] ?? null);
        echo "</legend>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 75
        echo ($context["help_article_count"] ?? null);
        echo "\">";
        echo ($context["entry_article_count"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <label class=\"radio-inline\">
                      ";
        // line 78
        if (($context["configblog_article_count"] ?? null)) {
            // line 79
            echo "                      <input type=\"radio\" name=\"configblog_article_count\" value=\"1\" checked=\"checked\" />
                      ";
            // line 80
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        } else {
            // line 82
            echo "                      <input type=\"radio\" name=\"configblog_article_count\" value=\"1\" />
                      ";
            // line 83
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        }
        // line 85
        echo "                    </label>
                    <label class=\"radio-inline\">
                      ";
        // line 87
        if ( !($context["configblog_article_count"] ?? null)) {
            // line 88
            echo "                      <input type=\"radio\" name=\"configblog_article_count\" value=\"0\" checked=\"checked\" />
                      ";
            // line 89
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        } else {
            // line 91
            echo "                      <input type=\"radio\" name=\"configblog_article_count\" value=\"0\" />
                      ";
            // line 92
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        }
        // line 94
        echo "                    </label>
                  </div>
                </div>
                <div class=\"form-group required\">
                  <label class=\"col-sm-2 control-label\" for=\"input-catalog-limit\"><span data-toggle=\"tooltip\" title=\"";
        // line 98
        echo ($context["help_article_limit"] ?? null);
        echo "\">";
        echo ($context["entry_article_limit"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"configblog_article_limit\" value=\"";
        // line 100
        echo ($context["configblog_article_limit"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_article_limit"] ?? null);
        echo "\" id=\"input-catalog-limit\" class=\"form-control\" />
                    ";
        // line 101
        if (($context["error_article_limit"] ?? null)) {
            // line 102
            echo "                    <div class=\"text-danger\">";
            echo ($context["error_article_limit"] ?? null);
            echo "</div>
                    ";
        }
        // line 104
        echo "                  </div>
                </div>
                <div class=\"form-group required\">
                  <label class=\"col-sm-2 control-label\" for=\"input-list-description-limit\"><span data-toggle=\"tooltip\" title=\"";
        // line 107
        echo ($context["help_article_description_length"] ?? null);
        echo "\">";
        echo ($context["entry_article_description_length"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"configblog_article_description_length\" value=\"";
        // line 109
        echo ($context["configblog_article_description_length"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_article_description_length"] ?? null);
        echo "\" id=\"input-list-description-limit\" class=\"form-control\" />
                    ";
        // line 110
        if (($context["error_article_description_length"] ?? null)) {
            // line 111
            echo "                    <div class=\"text-danger\">";
            echo ($context["error_article_description_length"] ?? null);
            echo "</div>
                    ";
        }
        // line 113
        echo "                  </div>
                </div>
                <div class=\"form-group required\">
                  <label class=\"col-sm-2 control-label\" for=\"input-admin-limit\"><span data-toggle=\"tooltip\" title=\"";
        // line 116
        echo ($context["help_limit_admin"] ?? null);
        echo "\">";
        echo ($context["entry_limit_admin"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"configblog_limit_admin\" value=\"";
        // line 118
        echo ($context["configblog_limit_admin"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_limit_admin"] ?? null);
        echo "\" id=\"input-admin-limit\" class=\"form-control\" />
                    ";
        // line 119
        if (($context["error_limit_admin"] ?? null)) {
            // line 120
            echo "                    <div class=\"text-danger\">";
            echo ($context["error_limit_admin"] ?? null);
            echo "</div>
                    ";
        }
        // line 122
        echo "                  </div>
                </div>
\t\t\t\t<div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 125
        echo ($context["help_blog_menu"] ?? null);
        echo "\">";
        echo ($context["entry_blog_menu"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <label class=\"radio-inline\">
                      ";
        // line 128
        if (($context["configblog_blog_menu"] ?? null)) {
            // line 129
            echo "                      <input type=\"radio\" name=\"configblog_blog_menu\" value=\"1\" checked=\"checked\" />
                      ";
            // line 130
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        } else {
            // line 132
            echo "                      <input type=\"radio\" name=\"configblog_blog_menu\" value=\"1\" />
                      ";
            // line 133
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        }
        // line 135
        echo "                    </label>
                    <label class=\"radio-inline\">
                      ";
        // line 137
        if ( !($context["configblog_blog_menu"] ?? null)) {
            // line 138
            echo "                      <input type=\"radio\" name=\"configblog_blog_menu\" value=\"0\" checked=\"checked\" />
                      ";
            // line 139
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        } else {
            // line 141
            echo "                      <input type=\"radio\" name=\"configblog_blog_menu\" value=\"0\" />
                      ";
            // line 142
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        }
        // line 144
        echo "                    </label>
                  </div>
                </div>
\t\t\t\t<div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\">";
        // line 148
        echo ($context["entry_article_download"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <label class=\"radio-inline\">
                      ";
        // line 151
        if (($context["configblog_article_download"] ?? null)) {
            // line 152
            echo "                      <input type=\"radio\" name=\"configblog_article_download\" value=\"1\" checked=\"checked\" />
                      ";
            // line 153
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        } else {
            // line 155
            echo "                      <input type=\"radio\" name=\"configblog_article_download\" value=\"1\" />
                      ";
            // line 156
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        }
        // line 158
        echo "                    </label>
                    <label class=\"radio-inline\">
                      ";
        // line 160
        if ( !($context["configblog_article_download"] ?? null)) {
            // line 161
            echo "                      <input type=\"radio\" name=\"configblog_article_download\" value=\"0\" checked=\"checked\" />
                      ";
            // line 162
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        } else {
            // line 164
            echo "                      <input type=\"radio\" name=\"configblog_article_download\" value=\"0\" />
                      ";
            // line 165
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        }
        // line 167
        echo "                    </label>
                  </div>
                </div>
              </fieldset>
              <fieldset>
                <legend>";
        // line 172
        echo ($context["text_review"] ?? null);
        echo "</legend>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 174
        echo ($context["help_review"] ?? null);
        echo "\">";
        echo ($context["entry_review"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <label class=\"radio-inline\">
                      ";
        // line 177
        if (($context["configblog_review_status"] ?? null)) {
            // line 178
            echo "                      <input type=\"radio\" name=\"configblog_review_status\" value=\"1\" checked=\"checked\" />
                      ";
            // line 179
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        } else {
            // line 181
            echo "                      <input type=\"radio\" name=\"configblog_review_status\" value=\"1\" />
                      ";
            // line 182
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        }
        // line 184
        echo "                    </label>
                    <label class=\"radio-inline\">
                      ";
        // line 186
        if ( !($context["configblog_review_status"] ?? null)) {
            // line 187
            echo "                      <input type=\"radio\" name=\"configblog_review_status\" value=\"0\" checked=\"checked\" />
                      ";
            // line 188
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        } else {
            // line 190
            echo "                      <input type=\"radio\" name=\"configblog_review_status\" value=\"0\" />
                      ";
            // line 191
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        }
        // line 193
        echo "                    </label>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 197
        echo ($context["help_review_guest"] ?? null);
        echo "\">";
        echo ($context["entry_review_guest"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <label class=\"radio-inline\">
                      ";
        // line 200
        if (($context["configblog_review_guest"] ?? null)) {
            // line 201
            echo "                      <input type=\"radio\" name=\"configblog_review_guest\" value=\"1\" checked=\"checked\" />
                      ";
            // line 202
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        } else {
            // line 204
            echo "                      <input type=\"radio\" name=\"configblog_review_guest\" value=\"1\" />
                      ";
            // line 205
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        }
        // line 207
        echo "                    </label>
                    <label class=\"radio-inline\">
                      ";
        // line 209
        if ( !($context["configblog_review_guest"] ?? null)) {
            // line 210
            echo "                      <input type=\"radio\" name=\"configblog_review_guest\" value=\"0\" checked=\"checked\" />
                      ";
            // line 211
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        } else {
            // line 213
            echo "                      <input type=\"radio\" name=\"configblog_review_guest\" value=\"0\" />
                      ";
            // line 214
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        }
        // line 216
        echo "                    </label>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 220
        echo ($context["help_review_mail"] ?? null);
        echo "\">";
        echo ($context["entry_review_mail"] ?? null);
        echo "</span></label>
                  <div class=\"col-sm-10\">
                    <label class=\"radio-inline\">
                      ";
        // line 223
        if (($context["configblog_review_mail"] ?? null)) {
            // line 224
            echo "                      <input type=\"radio\" name=\"configblog_review_mail\" value=\"1\" checked=\"checked\" />
                      ";
            // line 225
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        } else {
            // line 227
            echo "                      <input type=\"radio\" name=\"configblog_review_mail\" value=\"1\" />
                      ";
            // line 228
            echo ($context["text_yes"] ?? null);
            echo "
                      ";
        }
        // line 230
        echo "                    </label>
                    <label class=\"radio-inline\">
                      ";
        // line 232
        if ( !($context["configblog_review_mail"] ?? null)) {
            // line 233
            echo "                      <input type=\"radio\" name=\"configblog_review_mail\" value=\"0\" checked=\"checked\" />
                      ";
            // line 234
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        } else {
            // line 236
            echo "                      <input type=\"radio\" name=\"configblog_review_mail\" value=\"0\" />
                      ";
            // line 237
            echo ($context["text_no"] ?? null);
            echo "
                      ";
        }
        // line 239
        echo "                    </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class=\"tab-pane\" id=\"tab-image\">
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-image-category-width\">";
        // line 246
        echo ($context["entry_image_category"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <div class=\"row\">
                    <div class=\"col-sm-6\">
                      <input type=\"text\" name=\"configblog_image_category_width\" value=\"";
        // line 250
        echo ($context["configblog_image_category_width"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_width"] ?? null);
        echo "\" id=\"input-image-category-width\" class=\"form-control\" />
                    </div>
                    <div class=\"col-sm-6\">
                      <input type=\"text\" name=\"configblog_image_category_height\" value=\"";
        // line 253
        echo ($context["configblog_image_category_height"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_height"] ?? null);
        echo "\" class=\"form-control\" />
                    </div>
                  </div>
                  ";
        // line 256
        if (($context["error_image_category"] ?? null)) {
            // line 257
            echo "                  <div class=\"text-danger\">";
            echo ($context["error_image_category"] ?? null);
            echo "</div>
                  ";
        }
        // line 259
        echo "                </div>
              </div>
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-image-article-width\">";
        // line 262
        echo ($context["entry_image_article"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <div class=\"row\">
                    <div class=\"col-sm-6\">
                      <input type=\"text\" name=\"configblog_image_article_width\" value=\"";
        // line 266
        echo ($context["configblog_image_article_width"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_width"] ?? null);
        echo "\" id=\"input-image-article-width\" class=\"form-control\" />
                    </div>
                    <div class=\"col-sm-6\">
                      <input type=\"text\" name=\"configblog_image_article_height\" value=\"";
        // line 269
        echo ($context["configblog_image_article_height"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_height"] ?? null);
        echo "\" class=\"form-control\" />
                    </div>
                  </div>
                  ";
        // line 272
        if (($context["error_image_article"] ?? null)) {
            // line 273
            echo "                  <div class=\"text-danger\">";
            echo ($context["error_image_article"] ?? null);
            echo "</div>
                  ";
        }
        // line 275
        echo "                </div>
              </div>
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-image-related\">";
        // line 278
        echo ($context["entry_image_related"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <div class=\"row\">
                    <div class=\"col-sm-6\">
                      <input type=\"text\" name=\"configblog_image_related_width\" value=\"";
        // line 282
        echo ($context["configblog_image_related_width"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_width"] ?? null);
        echo "\" id=\"input-image-related\" class=\"form-control\" />
                    </div>
                    <div class=\"col-sm-6\">
                      <input type=\"text\" name=\"configblog_image_related_height\" value=\"";
        // line 285
        echo ($context["configblog_image_related_height"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_height"] ?? null);
        echo "\" class=\"form-control\" />
                    </div>
                  </div>
                  ";
        // line 288
        if (($context["error_image_related"] ?? null)) {
            // line 289
            echo "                  <div class=\"text-danger\">";
            echo ($context["error_image_related"] ?? null);
            echo "</div>
                  ";
        }
        // line 291
        echo "                </div>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
  </div>
";
        // line 299
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "blog/setting.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  733 => 299,  723 => 291,  717 => 289,  715 => 288,  707 => 285,  699 => 282,  692 => 278,  687 => 275,  681 => 273,  679 => 272,  671 => 269,  663 => 266,  656 => 262,  651 => 259,  645 => 257,  643 => 256,  635 => 253,  627 => 250,  620 => 246,  611 => 239,  606 => 237,  603 => 236,  598 => 234,  595 => 233,  593 => 232,  589 => 230,  584 => 228,  581 => 227,  576 => 225,  573 => 224,  571 => 223,  563 => 220,  557 => 216,  552 => 214,  549 => 213,  544 => 211,  541 => 210,  539 => 209,  535 => 207,  530 => 205,  527 => 204,  522 => 202,  519 => 201,  517 => 200,  509 => 197,  503 => 193,  498 => 191,  495 => 190,  490 => 188,  487 => 187,  485 => 186,  481 => 184,  476 => 182,  473 => 181,  468 => 179,  465 => 178,  463 => 177,  455 => 174,  450 => 172,  443 => 167,  438 => 165,  435 => 164,  430 => 162,  427 => 161,  425 => 160,  421 => 158,  416 => 156,  413 => 155,  408 => 153,  405 => 152,  403 => 151,  397 => 148,  391 => 144,  386 => 142,  383 => 141,  378 => 139,  375 => 138,  373 => 137,  369 => 135,  364 => 133,  361 => 132,  356 => 130,  353 => 129,  351 => 128,  343 => 125,  338 => 122,  332 => 120,  330 => 119,  324 => 118,  317 => 116,  312 => 113,  306 => 111,  304 => 110,  298 => 109,  291 => 107,  286 => 104,  280 => 102,  278 => 101,  272 => 100,  265 => 98,  259 => 94,  254 => 92,  251 => 91,  246 => 89,  243 => 88,  241 => 87,  237 => 85,  232 => 83,  229 => 82,  224 => 80,  221 => 79,  219 => 78,  211 => 75,  206 => 73,  195 => 67,  190 => 65,  181 => 61,  176 => 59,  167 => 55,  162 => 53,  153 => 49,  148 => 47,  139 => 43,  134 => 41,  126 => 36,  122 => 35,  118 => 34,  113 => 32,  107 => 29,  103 => 27,  95 => 23,  92 => 22,  84 => 18,  82 => 17,  76 => 13,  65 => 11,  61 => 10,  56 => 8,  50 => 7,  46 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "blog/setting.twig", "");
    }
}
