<?php
class intro extends BaseController {

    protected $view_var=array();
    private $app_const=array();

    public function __construct()
    {

        $this->view_var['const'] = Config::get('view_const');

        $this->app_const = Config::get('app_const');

        $this->time_stamp = time();
    }

    public function main()
    {
        return View::make('info',$this->view_var);
    }

    public function get($type=0,$start_id=0)
    {
        if(!is_int((int)$start_id) || !is_int((int)$type))
            App::abort(404);

        if(!in_array((int)$type, $this->app_const['allowDirectShowCandidateId'],true))
            App::abort(404);

        $candidate_arr=array();
        if($type==0){
            $president=candidate::whereRaw('regis_type = 0 and id >= '.$start_id.' limit '.$this->app_const['number_to_show_once'])->get()->toArray();

            foreach ($president as $key => $value) {
                $id=$value['id'];
                $candidate_arr[]=$this->filter_col($value);

                $candidate_arr[]=$this->filter_col(candidate::whereRaw('regis_type = 1 and type_data = '.$id)->first()->toArray());
            }
        }
        else{
            $candidate_tmp=candidate::whereRaw('regis_type = '.$type.' and id >= '.$start_id.' limit '.$this->app_const['number_to_show_once'])->get()->toArray();

            foreach ($candidate_tmp as $key => $value) {
                $candidate_arr[]=$this->filter_col($value);
            }
        }

        return json_encode($candidate_arr);
    }

    private function filter_col($candidate)
    {
        $col=$this->app_const['allowShow'];
        $output=array();

        foreach ($col as $key => $value) {
            if($value)
                $output[$key]=$candidate[$key];
        }

        return $output;
    }

}
