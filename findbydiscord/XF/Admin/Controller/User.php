<?php

namespace LEGIT\FindByDiscord\XF\Admin\Controller;

class User extends XFCP_User
{
    public function actionDiscordUsers()
    {
        $id = $this->filter('id', 'int');
        if (!$id || $id == '') {
            return $this->error(\XF::phrase('please_enter_valid_field_id'));
        }
        $log = \XF::finder('XF:UserConnectedAccount')
            ->where('provider_key', strval($id))
            ->where('provider', 'nfDiscord')
            ->fetchOne();

        if (!$log) {  
            return $this->error(\XF::phrase('requested_user_not_found'));
        } 
        return $this->redirect($this->buildLink('users/edit', $log->User));
    }
}