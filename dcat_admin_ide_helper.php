<?php

/**
 * A helper file for Dcat Admin, to provide autocomplete information to your IDE
 *
 * This file should not be included in your code, only analyzed by your IDE!
 *
 * @author jqh <841324345@qq.com>
 */
namespace Dcat\Admin {
    use Illuminate\Support\Collection;

    /**
     * @property Grid\Column|Collection width
     * @property Grid\Column|Collection member_type
     * @property Grid\Column|Collection job_type
     * @property Grid\Column|Collection company_type
     * @property Grid\Column|Collection status
     *
     * @method Grid\Column|Collection width(string $label = null)
     * @method Grid\Column|Collection member_type(string $label = null)
     * @method Grid\Column|Collection job_type(string $label = null)
     * @method Grid\Column|Collection company_type(string $label = null)
     * @method Grid\Column|Collection status(string $label = null)
     */
    class Grid {}

    class MiniGrid extends Grid {}

    /**
     * @property Show\Field|Collection width
     * @property Show\Field|Collection member_type
     * @property Show\Field|Collection job_type
     * @property Show\Field|Collection company_type
     * @property Show\Field|Collection status
     *
     * @method Show\Field|Collection width(string $label = null)
     * @method Show\Field|Collection member_type(string $label = null)
     * @method Show\Field|Collection job_type(string $label = null)
     * @method Show\Field|Collection company_type(string $label = null)
     * @method Show\Field|Collection status(string $label = null)
     */
    class Show {}

    /**
     
     */
    class Form {}

}

namespace Dcat\Admin\Grid {
    /**
     
     */
    class Column {}

    /**
     
     */
    class Filter {}
}

namespace Dcat\Admin\Show {
    /**
     
     */
    class Field {}
}
