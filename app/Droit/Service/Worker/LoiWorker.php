<?php namespace App\Droit\Service\Worker;

use App\Droit\Loi\Repo\LoiInterface;
use App\Droit\Disposition\Repo\DispositionInterface;
use App\Droit\Matiere\Repo\MatiereInterface;
use App\Droit\Matiere\Repo\MatiereNoteInterface;

class LoiWorker{

    protected $matiere;
    protected $disposition;
    protected $note;
    protected $loi;
    protected $helper;

    /* Inject dependencies */
    public function __construct( LoiInterface $loi, DispositionInterface $disposition, MatiereInterface $matiere, MatiereNoteInterface $note)
    {
        $this->matiere      = $matiere;
        $this->note         = $note;
        $this->loi          = $loi;
        $this->disposition  = $disposition;

        $this->helper    = new \App\Droit\Helper\Helper;
    }

    /**
     * Return collection arrets prepared for filtered
     *
     * @return collection
     */
    public function convertDispositions($disposition)
    {
        $data = $this->helper->dispatchInArrayDisposition($disposition->subdivision);
        return $data;
    }

    public function getLoiToConvert($dispositions)
    {
        $new = $dispositions->map(function($disposition)
        {
            $converted = $this->convertDispositions($disposition);

            foreach($converted as $convert)
            {
                $pages[] = new \App\Droit\Disposition\Entities\Disposition_page([
                    'alinea'        => (isset($convert['alinea'])  ? $convert['alinea']  : null),
                    'chiffre'       => (isset($convert['chiffre']) ? $convert['chiffre'] : null),
                    'lettre'        => (isset($convert['lettre'])  ? $convert['lettre']  : null),
                    'disposition_id'=> $disposition->id,
                    'volume_id'     => $disposition->volume_id,
                    'page'          => $disposition->page
                ]);
            }

            $disposition->disposition_pages()->saveMany($pages);

            $disposition->setAttribute('converted',$pages);

            return $disposition;
        });

        return $new;
    }

    public function getNoteToConvert()
    {
        $notes = $this->note->getAll();
        $new   = $notes->map(function($note)
        {
            $pages[] = new \App\Droit\Matiere\Entities\Matiere_note_page([
                'note_id'    => $note->id,
                'volume_id'  => $note->volume_id,
                'page'       => $note->page
            ]);

            //$note->note_pages()->saveMany($pages);
            $note->setAttribute('converted',$pages);

            return $note;
        });

        return $new;
    }

}