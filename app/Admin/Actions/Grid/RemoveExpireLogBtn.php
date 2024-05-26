<?php

namespace App\Admin\Actions\Grid;

use App\Logic\MemberLogic;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RemoveExpireLogBtn extends RowAction
{
    /**
     * @return string
     */
	protected $title = '刪除記錄';

    /**
     * Handle the action request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        $member_id = $this->getKey();

 
        //删除 
        (new MemberLogic())->remove_expire_log($member_id);

        return $this->response()
            ->success('刪除成功！ ')
            ->refresh();
    }

    /**
	 * @return string|array|void
	 */
	public function confirm()
	{
		return ['確認刪除？', ''];
	}

    /**
     * @param Model|Authenticatable|HasPermissions|null $user
     *
     * @return bool
     */
    protected function authorize($user): bool
    {
        return true;
    }

    /**
     * @return array
     */
    protected function parameters()
    {
        return [];
    }

    public function title(){
        return "<i class='feather icon-trash'></i> {$this->title}";
    }
 

}
