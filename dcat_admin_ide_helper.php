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
     * @property Grid\Column|Collection id
     * @property Grid\Column|Collection name
     * @property Grid\Column|Collection type
     * @property Grid\Column|Collection version
     * @property Grid\Column|Collection detail
     * @property Grid\Column|Collection created_at
     * @property Grid\Column|Collection updated_at
     * @property Grid\Column|Collection is_enabled
     * @property Grid\Column|Collection parent_id
     * @property Grid\Column|Collection order
     * @property Grid\Column|Collection icon
     * @property Grid\Column|Collection uri
     * @property Grid\Column|Collection extension
     * @property Grid\Column|Collection permission_id
     * @property Grid\Column|Collection menu_id
     * @property Grid\Column|Collection slug
     * @property Grid\Column|Collection http_method
     * @property Grid\Column|Collection http_path
     * @property Grid\Column|Collection role_id
     * @property Grid\Column|Collection user_id
     * @property Grid\Column|Collection value
     * @property Grid\Column|Collection username
     * @property Grid\Column|Collection password
     * @property Grid\Column|Collection avatar
     * @property Grid\Column|Collection remember_token
     * @property Grid\Column|Collection member_id
     * @property Grid\Column|Collection deleted_at
     * @property Grid\Column|Collection uuid
     * @property Grid\Column|Collection connection
     * @property Grid\Column|Collection queue
     * @property Grid\Column|Collection payload
     * @property Grid\Column|Collection exception
     * @property Grid\Column|Collection failed_at
     * @property Grid\Column|Collection mail
     * @property Grid\Column|Collection subject
     * @property Grid\Column|Collection content
     * @property Grid\Column|Collection email
     * @property Grid\Column|Collection action_type
     * @property Grid\Column|Collection remark
     * @property Grid\Column|Collection member_level
     * @property Grid\Column|Collection message
     * @property Grid\Column|Collection chiname
     * @property Grid\Column|Collection engname
     * @property Grid\Column|Collection phone
     * @property Grid\Column|Collection company
     * @property Grid\Column|Collection job_name
     * @property Grid\Column|Collection recommender
     * @property Grid\Column|Collection card_img
     * @property Grid\Column|Collection vertify_code
     * @property Grid\Column|Collection vertify_code_time
     * @property Grid\Column|Collection card_start_time
     * @property Grid\Column|Collection card_end_time
     * @property Grid\Column|Collection card_no_txt
     * @property Grid\Column|Collection email_verified_at
     * @property Grid\Column|Collection member_fee_status
     * @property Grid\Column|Collection member_expired_at
     * @property Grid\Column|Collection pay_year
     * @property Grid\Column|Collection yongjiu_status
     * @property Grid\Column|Collection link
     * @property Grid\Column|Collection token
     * @property Grid\Column|Collection tokenable_type
     * @property Grid\Column|Collection tokenable_id
     * @property Grid\Column|Collection abilities
     * @property Grid\Column|Collection last_used_at
     * @property Grid\Column|Collection ip_address
     * @property Grid\Column|Collection user_agent
     * @property Grid\Column|Collection last_activity
     * @property Grid\Column|Collection two_factor_secret
     * @property Grid\Column|Collection two_factor_recovery_codes
     * @property Grid\Column|Collection two_factor_confirmed_at
     *
     * @method Grid\Column|Collection width(string $label = null)
     * @method Grid\Column|Collection member_type(string $label = null)
     * @method Grid\Column|Collection job_type(string $label = null)
     * @method Grid\Column|Collection company_type(string $label = null)
     * @method Grid\Column|Collection status(string $label = null)
     * @method Grid\Column|Collection id(string $label = null)
     * @method Grid\Column|Collection name(string $label = null)
     * @method Grid\Column|Collection type(string $label = null)
     * @method Grid\Column|Collection version(string $label = null)
     * @method Grid\Column|Collection detail(string $label = null)
     * @method Grid\Column|Collection created_at(string $label = null)
     * @method Grid\Column|Collection updated_at(string $label = null)
     * @method Grid\Column|Collection is_enabled(string $label = null)
     * @method Grid\Column|Collection parent_id(string $label = null)
     * @method Grid\Column|Collection order(string $label = null)
     * @method Grid\Column|Collection icon(string $label = null)
     * @method Grid\Column|Collection uri(string $label = null)
     * @method Grid\Column|Collection extension(string $label = null)
     * @method Grid\Column|Collection permission_id(string $label = null)
     * @method Grid\Column|Collection menu_id(string $label = null)
     * @method Grid\Column|Collection slug(string $label = null)
     * @method Grid\Column|Collection http_method(string $label = null)
     * @method Grid\Column|Collection http_path(string $label = null)
     * @method Grid\Column|Collection role_id(string $label = null)
     * @method Grid\Column|Collection user_id(string $label = null)
     * @method Grid\Column|Collection value(string $label = null)
     * @method Grid\Column|Collection username(string $label = null)
     * @method Grid\Column|Collection password(string $label = null)
     * @method Grid\Column|Collection avatar(string $label = null)
     * @method Grid\Column|Collection remember_token(string $label = null)
     * @method Grid\Column|Collection member_id(string $label = null)
     * @method Grid\Column|Collection deleted_at(string $label = null)
     * @method Grid\Column|Collection uuid(string $label = null)
     * @method Grid\Column|Collection connection(string $label = null)
     * @method Grid\Column|Collection queue(string $label = null)
     * @method Grid\Column|Collection payload(string $label = null)
     * @method Grid\Column|Collection exception(string $label = null)
     * @method Grid\Column|Collection failed_at(string $label = null)
     * @method Grid\Column|Collection mail(string $label = null)
     * @method Grid\Column|Collection subject(string $label = null)
     * @method Grid\Column|Collection content(string $label = null)
     * @method Grid\Column|Collection email(string $label = null)
     * @method Grid\Column|Collection action_type(string $label = null)
     * @method Grid\Column|Collection remark(string $label = null)
     * @method Grid\Column|Collection member_level(string $label = null)
     * @method Grid\Column|Collection message(string $label = null)
     * @method Grid\Column|Collection chiname(string $label = null)
     * @method Grid\Column|Collection engname(string $label = null)
     * @method Grid\Column|Collection phone(string $label = null)
     * @method Grid\Column|Collection company(string $label = null)
     * @method Grid\Column|Collection job_name(string $label = null)
     * @method Grid\Column|Collection recommender(string $label = null)
     * @method Grid\Column|Collection card_img(string $label = null)
     * @method Grid\Column|Collection vertify_code(string $label = null)
     * @method Grid\Column|Collection vertify_code_time(string $label = null)
     * @method Grid\Column|Collection card_start_time(string $label = null)
     * @method Grid\Column|Collection card_end_time(string $label = null)
     * @method Grid\Column|Collection card_no_txt(string $label = null)
     * @method Grid\Column|Collection email_verified_at(string $label = null)
     * @method Grid\Column|Collection member_fee_status(string $label = null)
     * @method Grid\Column|Collection member_expired_at(string $label = null)
     * @method Grid\Column|Collection pay_year(string $label = null)
     * @method Grid\Column|Collection yongjiu_status(string $label = null)
     * @method Grid\Column|Collection link(string $label = null)
     * @method Grid\Column|Collection token(string $label = null)
     * @method Grid\Column|Collection tokenable_type(string $label = null)
     * @method Grid\Column|Collection tokenable_id(string $label = null)
     * @method Grid\Column|Collection abilities(string $label = null)
     * @method Grid\Column|Collection last_used_at(string $label = null)
     * @method Grid\Column|Collection ip_address(string $label = null)
     * @method Grid\Column|Collection user_agent(string $label = null)
     * @method Grid\Column|Collection last_activity(string $label = null)
     * @method Grid\Column|Collection two_factor_secret(string $label = null)
     * @method Grid\Column|Collection two_factor_recovery_codes(string $label = null)
     * @method Grid\Column|Collection two_factor_confirmed_at(string $label = null)
     */
    class Grid {}

    class MiniGrid extends Grid {}

    /**
     * @property Show\Field|Collection width
     * @property Show\Field|Collection member_type
     * @property Show\Field|Collection job_type
     * @property Show\Field|Collection company_type
     * @property Show\Field|Collection status
     * @property Show\Field|Collection id
     * @property Show\Field|Collection name
     * @property Show\Field|Collection type
     * @property Show\Field|Collection version
     * @property Show\Field|Collection detail
     * @property Show\Field|Collection created_at
     * @property Show\Field|Collection updated_at
     * @property Show\Field|Collection is_enabled
     * @property Show\Field|Collection parent_id
     * @property Show\Field|Collection order
     * @property Show\Field|Collection icon
     * @property Show\Field|Collection uri
     * @property Show\Field|Collection extension
     * @property Show\Field|Collection permission_id
     * @property Show\Field|Collection menu_id
     * @property Show\Field|Collection slug
     * @property Show\Field|Collection http_method
     * @property Show\Field|Collection http_path
     * @property Show\Field|Collection role_id
     * @property Show\Field|Collection user_id
     * @property Show\Field|Collection value
     * @property Show\Field|Collection username
     * @property Show\Field|Collection password
     * @property Show\Field|Collection avatar
     * @property Show\Field|Collection remember_token
     * @property Show\Field|Collection member_id
     * @property Show\Field|Collection deleted_at
     * @property Show\Field|Collection uuid
     * @property Show\Field|Collection connection
     * @property Show\Field|Collection queue
     * @property Show\Field|Collection payload
     * @property Show\Field|Collection exception
     * @property Show\Field|Collection failed_at
     * @property Show\Field|Collection mail
     * @property Show\Field|Collection subject
     * @property Show\Field|Collection content
     * @property Show\Field|Collection email
     * @property Show\Field|Collection action_type
     * @property Show\Field|Collection remark
     * @property Show\Field|Collection member_level
     * @property Show\Field|Collection message
     * @property Show\Field|Collection chiname
     * @property Show\Field|Collection engname
     * @property Show\Field|Collection phone
     * @property Show\Field|Collection company
     * @property Show\Field|Collection job_name
     * @property Show\Field|Collection recommender
     * @property Show\Field|Collection card_img
     * @property Show\Field|Collection vertify_code
     * @property Show\Field|Collection vertify_code_time
     * @property Show\Field|Collection card_start_time
     * @property Show\Field|Collection card_end_time
     * @property Show\Field|Collection card_no_txt
     * @property Show\Field|Collection email_verified_at
     * @property Show\Field|Collection member_fee_status
     * @property Show\Field|Collection member_expired_at
     * @property Show\Field|Collection pay_year
     * @property Show\Field|Collection yongjiu_status
     * @property Show\Field|Collection link
     * @property Show\Field|Collection token
     * @property Show\Field|Collection tokenable_type
     * @property Show\Field|Collection tokenable_id
     * @property Show\Field|Collection abilities
     * @property Show\Field|Collection last_used_at
     * @property Show\Field|Collection ip_address
     * @property Show\Field|Collection user_agent
     * @property Show\Field|Collection last_activity
     * @property Show\Field|Collection two_factor_secret
     * @property Show\Field|Collection two_factor_recovery_codes
     * @property Show\Field|Collection two_factor_confirmed_at
     *
     * @method Show\Field|Collection width(string $label = null)
     * @method Show\Field|Collection member_type(string $label = null)
     * @method Show\Field|Collection job_type(string $label = null)
     * @method Show\Field|Collection company_type(string $label = null)
     * @method Show\Field|Collection status(string $label = null)
     * @method Show\Field|Collection id(string $label = null)
     * @method Show\Field|Collection name(string $label = null)
     * @method Show\Field|Collection type(string $label = null)
     * @method Show\Field|Collection version(string $label = null)
     * @method Show\Field|Collection detail(string $label = null)
     * @method Show\Field|Collection created_at(string $label = null)
     * @method Show\Field|Collection updated_at(string $label = null)
     * @method Show\Field|Collection is_enabled(string $label = null)
     * @method Show\Field|Collection parent_id(string $label = null)
     * @method Show\Field|Collection order(string $label = null)
     * @method Show\Field|Collection icon(string $label = null)
     * @method Show\Field|Collection uri(string $label = null)
     * @method Show\Field|Collection extension(string $label = null)
     * @method Show\Field|Collection permission_id(string $label = null)
     * @method Show\Field|Collection menu_id(string $label = null)
     * @method Show\Field|Collection slug(string $label = null)
     * @method Show\Field|Collection http_method(string $label = null)
     * @method Show\Field|Collection http_path(string $label = null)
     * @method Show\Field|Collection role_id(string $label = null)
     * @method Show\Field|Collection user_id(string $label = null)
     * @method Show\Field|Collection value(string $label = null)
     * @method Show\Field|Collection username(string $label = null)
     * @method Show\Field|Collection password(string $label = null)
     * @method Show\Field|Collection avatar(string $label = null)
     * @method Show\Field|Collection remember_token(string $label = null)
     * @method Show\Field|Collection member_id(string $label = null)
     * @method Show\Field|Collection deleted_at(string $label = null)
     * @method Show\Field|Collection uuid(string $label = null)
     * @method Show\Field|Collection connection(string $label = null)
     * @method Show\Field|Collection queue(string $label = null)
     * @method Show\Field|Collection payload(string $label = null)
     * @method Show\Field|Collection exception(string $label = null)
     * @method Show\Field|Collection failed_at(string $label = null)
     * @method Show\Field|Collection mail(string $label = null)
     * @method Show\Field|Collection subject(string $label = null)
     * @method Show\Field|Collection content(string $label = null)
     * @method Show\Field|Collection email(string $label = null)
     * @method Show\Field|Collection action_type(string $label = null)
     * @method Show\Field|Collection remark(string $label = null)
     * @method Show\Field|Collection member_level(string $label = null)
     * @method Show\Field|Collection message(string $label = null)
     * @method Show\Field|Collection chiname(string $label = null)
     * @method Show\Field|Collection engname(string $label = null)
     * @method Show\Field|Collection phone(string $label = null)
     * @method Show\Field|Collection company(string $label = null)
     * @method Show\Field|Collection job_name(string $label = null)
     * @method Show\Field|Collection recommender(string $label = null)
     * @method Show\Field|Collection card_img(string $label = null)
     * @method Show\Field|Collection vertify_code(string $label = null)
     * @method Show\Field|Collection vertify_code_time(string $label = null)
     * @method Show\Field|Collection card_start_time(string $label = null)
     * @method Show\Field|Collection card_end_time(string $label = null)
     * @method Show\Field|Collection card_no_txt(string $label = null)
     * @method Show\Field|Collection email_verified_at(string $label = null)
     * @method Show\Field|Collection member_fee_status(string $label = null)
     * @method Show\Field|Collection member_expired_at(string $label = null)
     * @method Show\Field|Collection pay_year(string $label = null)
     * @method Show\Field|Collection yongjiu_status(string $label = null)
     * @method Show\Field|Collection link(string $label = null)
     * @method Show\Field|Collection token(string $label = null)
     * @method Show\Field|Collection tokenable_type(string $label = null)
     * @method Show\Field|Collection tokenable_id(string $label = null)
     * @method Show\Field|Collection abilities(string $label = null)
     * @method Show\Field|Collection last_used_at(string $label = null)
     * @method Show\Field|Collection ip_address(string $label = null)
     * @method Show\Field|Collection user_agent(string $label = null)
     * @method Show\Field|Collection last_activity(string $label = null)
     * @method Show\Field|Collection two_factor_secret(string $label = null)
     * @method Show\Field|Collection two_factor_recovery_codes(string $label = null)
     * @method Show\Field|Collection two_factor_confirmed_at(string $label = null)
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
