<?php
class intro extends BaseController {

    protected $view_var=array();

    public function test()
    {
        return route('test');
    }

    public function main()
    {
        return View::make('info',$this->view_var);
    }

}
