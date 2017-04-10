<?php

namespace App\Droit\Code\Worker;

use App\Droit\Code\Worker\CodeWorkerInterface;
use App\Droit\Code\Repo\CodeInterface;

class CodeWorker implements CodeWorkerInterface
{
    protected $code;

    public function __construct(CodeInterface $code)
    {
        $this->code = $code;
    }

    public function valid($code)
    {
        return $this->code->valid($code);
    }

    public function markUsed($code_id,$user_id)
    {
        return $this->code->update(['id' => $code_id, 'used' => 1,'user_id' => $user_id]);
    }

    public function active($user_id)
    {
        return $this->code->active($user_id);
    }
}