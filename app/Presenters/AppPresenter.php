<?php namespace App\Presenters;

use App\Helpers\Functions;
use Route;

/**
 * Class RbacPresenter
 *
 * @package namespace App\Presenters;
 */
class AppPresenter
{

    /**
     * Set the menu to active by current
     * @param null $name
     * @return string
     */
    public function activeMenuByRoute($names = [])
    {
        $currentRouteName = Route::currentRouteName();
        $routeSections = explode('.', $currentRouteName);

        foreach ($names as $name) {
            if (isset($routeSections[0]) && $routeSections[0] !== $name) {
                continue;
            } else {
                return 'active';
            }
        }

        return '';
    }

    /*显示用户名*/

    public function getUserName()
    {

        $user = Functions::getLoginUser();

        return $user->name;
    }

    public function getUserId()
    {
        $user = Functions::getLoginUser();

        return $user->user_wechat_id;
    }

    public function getUser()
    {
        $user = Functions::getLoginUser();

        return $user;
    }


}
