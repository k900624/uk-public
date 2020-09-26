<?php

namespace App\Repositories\Front\Users;

use App\Repositories\CoreRepository;
use App\Models\Users\User as Model;

class UserRepository extends CoreRepository
{
    function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getUserMainData($id)
    {
        $result = $this
            ->startConditions()
            ->select(
                'users.id as user_id',
                'users.name',
                'users.email',
                'areas.address',
                'user_profile.phone',
                'user_profile.phone2',
                'user_profile.avatar',
                'areas.contract_number',
                'areas.contract_date',
                'areas.land_area',
                'areas.house_area',
                'areas.quantity_residents',
                'areas.сounters',
                'user_profile.vkontakte',
                'user_profile.facebook',
                'user_profile.twitter',
                'user_profile.odnoklassniki',
                'user_profile.telegram',
                'user_area.main as main_user'
            )
            ->join('user_profile', 'user_profile.user_id', '=', 'users.id', 'left')
            ->join('user_area', 'user_area.user_id', '=', 'users.id', 'left')
            ->join('areas', 'user_area.area_id', '=', 'areas.id', 'left')
            ->find($id);

        return $result;
    }

    public function getUser($id)
    {
        $result = $this
            ->startConditions()
            ->select(
                'users.id as user_id',
                'users.name',
                'users.email',
                'users.password',
                'users.status',
                'users.created_at',
                'users.updated_at',
                'users.deleted_at',
                'users.last_login_at',
                'users.ip_address',
                'user_profile.address',
                'user_profile.phone',
                'user_profile.avatar',
                'roles.id as role_id',
                'roles.name as role_name',
                'roles.display_name as role_display_name'
            )
            ->join('user_profile', 'user_profile.user_id', '=', 'users.id', 'left')
            ->join('user_role', 'user_role.user_id', '=', 'users.id', 'left')
            ->join('roles', 'roles.id', '=', 'user_role.role_id', 'left')
            ->find($id);

        return $result;
    }
    public function getApiToken($id)
    {
        $result = $this
            ->startConditions()
            ->select(
                'api_token'
            )
            ->find($id);
		
		if ($result) {
			return $result->api_token;
		}
		
		return null;
    }

}