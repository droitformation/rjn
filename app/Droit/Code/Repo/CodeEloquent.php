<?php namespace App\Droit\Code\Repo;

use App\Droit\Code\Repo\CodeInterface;
use App\Droit\Code\Entities\Code as M;

class CodeEloquent implements CodeInterface{

	protected $code;

	public function __construct(M $code)
	{
		$this->code = $code;
	}

    public function getAll(){

        return $this->code->with(['user'])->get();
    }

	public function find($id)
    {
		return $this->code->find($id);
	}

    public function valid($code)
    {
        $code = $this->code->where('code','=',$code)->where('valid_at', '>=', date('Y-m-d'))->whereNull('used')->get();

        if(!$code->isEmpty())
        {
            return $code->first();
        }

        return null;
    }

    public function active($user_id)
    {
        $code = $this->code->where('user_id','=',$user_id)->where('valid_at', '>=', date('Y-m-d'))->get();

        if(!$code->isEmpty())
        {
            return $code->first();
        }

        return null;
    }

	public function create(array $data){

		$code = $this->code->create(array(
			'code'        => $data['code'],
            'valid_at'    => $data['valid_at'],
			'used'        => null,
            'user_id'     => null,
            'created_at'  => date('Y-m-d G:i:s'),
            'updated_at'  => date('Y-m-d G:i:s')
		));

		if( ! $code )
		{
			return false;
		}
		
		return $code;
	}
	
	public function update(array $data)
    {
        $code = $this->code->find($data['id']);
		
		if( ! $code )
		{
			return false;
		}

        $code->fill($data);
        $code->updated_at = date('Y-m-d G:i:s');
		$code->save();
		
		return $code;
	}

	public function delete($id)
    {
        $code = $this->code->find($id);

		return $code->delete($id);
	}

}
