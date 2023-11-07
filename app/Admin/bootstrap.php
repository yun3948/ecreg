<?php

use Dcat\Admin\Admin;
use Dcat\Admin\Grid;
use Dcat\Admin\Form;
use Dcat\Admin\Grid\Filter;
use Dcat\Admin\Show;

/**
 * Dcat-admin - admin builder based on Laravel.
 * @author jqh <https://github.com/jqhph>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 *
 * extend custom field:
 * Dcat\Admin\Form::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Column::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Filter::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */
\Dcat\Admin\Admin::style(
    <<<CSS
.nav-tabs {
/* background-color: #fff; */
margin-top: 20px;
box-shadow: 0 2px 4px 0 rgba(0,0,0,.2);
border-radius: .25rem;
}

/* .nav-tabs .nav-item {
margin: 0px 10px;
background-color:#3085d6;
color:#fff;  
}
.nav-tabs .nav-item a.nav-link{
color:#fff !important;
} */
CSS
);