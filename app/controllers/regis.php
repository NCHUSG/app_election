<?php
class regis extends BaseController {

    public function form($type)
    {
        //$form = Form::model($user, array('route' => array('user.update', $user->id)));
        $candidate=new candidate();
        return View::make('form',array(
            'candidate' => $candidate,
            'type' => $type
        ));
    }

    public function form_sent($type)
    {
        //$form = Form::model($user, array('route' => array('user.update', $user->id)));
        $candidate=new candidate();
        return View::make('form',array(
            'candidate' => $candidate,
            'type' => $type
        ));
    }

}
