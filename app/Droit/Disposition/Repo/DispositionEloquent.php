<?php namespace App\Droit\Disposition\Repo;

use App\Droit\Disposition\Repo\DispositionInterface;
use App\Droit\Disposition\Entities\Disposition as M;

class DispositionEloquent implements DispositionInterface{

    protected $disposition;

    public function __construct(M $disposition)
    {
        $this->disposition = $disposition;
    }

    public function getAll(){

        return $this->disposition->with(['disposition_pages'])->get();
    }

    public function getVolumePage($volume,$page){

        return $this->disposition->with(['disposition_pages'])->whereHas('disposition_pages', function($query) use ($volume,$page) {

            $query->where('volume_id','=',$volume)->where('page','=',$page);

        })->groupBy('id')->get();
    }

    public function search($id,$article = null){

        $loi = $this->disposition->where('loi_id','=',$id);

        if($article)
        {
            $loi->where('cote', '=', 'Art. '.$article);
        }

        return $loi->with(['disposition_pages'])->orderBy('volume_id', 'DESC')->get();
    }

    public function newsearch($terms)
    {
        $loi = $this->disposition->with(['disposition_pages']);

        if(isset($terms['loi'])){
            $loi->where('loi_id','=',$terms['loi']);
        }

        if(isset($terms['article'])){
            $loi->where('cote','=',$terms['article']);
        }

        if(isset($terms['aliena'])){
            $loi->whereHas('disposition_pages', function ($query) use ($terms) {
                $query->where('aliena', '=', $terms['aliena']);
            });
        }

        if(isset($terms['chiffre'])){
            $loi->whereHas('disposition_pages', function ($query) use ($terms) {
                $query->where('chiffre', '=', $terms['chiffre']);
            });
        }

        if(isset($terms['lettre'])){
            $loi->whereHas('disposition_pages', function ($query) use ($terms) {
                $query->where('lettre', '=', $terms['lettre']);
            });
        }

        return $loi->orderBy('volume_id', 'DESC')->get();
    }

    public function searchByArticle($article){

        return $this->disposition->with(['loi','disposition_pages'])->where('cote', '=', 'Art. '.$article)->get();
    }

    public function findByLoi($id)
    {
        return $this->disposition->where('loi_id','=',$id)
            ->with(['loi','disposition_pages'])
            ->orderBy('content', 'ASC')
            ->get();
    }

    /*
     * For conversion
     * */
    public function getForConversion(){

        return $this->disposition->where('subdivision', '!=', '')->get();
    }

    public function find($id){

        return $this->disposition->with(['disposition_pages'])->where('id','=',$id)->find($id);
    }

    public function create(array $data){

        $disposition = $this->disposition->create(array(
            'loi_id'      => $data['loi_id'],
            'cote'        => (!empty($data['cote']) ? $data['cote'] : ''),
            'page'        => (!empty($data['page']) ? $data['page'] : ''),
            'content'     => (!empty($data['content']) ? $data['content'] : ''),
            'subdivision' => (!empty($data['subdivision']) ? $data['subdivision'] : ''),
            'volume_id'   =>  $data['volume_id']
        ));

        if( ! $disposition )
        {
            return false;
        }

        return $disposition;

    }

    public function update(array $data){

        $disposition = $this->disposition->findOrFail($data['id']);

        if( ! $disposition )
        {
            return false;
        }

        $disposition->fill($data);
        $disposition->save();

        return $disposition;
    }

    public function delete($id){

        $disposition = $this->disposition->find($id);

        return $disposition->delete($id);
    }

}
