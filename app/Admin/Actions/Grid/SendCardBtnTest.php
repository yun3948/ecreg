<?php

namespace App\Admin\Actions\Grid;

use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SendCardBtnTest extends RowAction
{
    /**
     * @return string
     */
	protected $title = '發送會員卡';

    /**
     * Handle the action request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        // dump($this->getKey());

        return $this->response()
            ->success('Processed successfully: '.$this->getKey())
            ->redirect('/');
    }

    /**
	 * @return string|array|void
	 */
	public function confirm()
	{
		return ['Confirm?', 'contents'];
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
}
