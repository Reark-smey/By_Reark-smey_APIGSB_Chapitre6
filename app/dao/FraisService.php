<?php

namespace App\dao;

use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\Frai;
use App\Models\Fraisforfait;
use App\Models\Fraishorsforfait;
class FraisService
{
    public function getFrais($idfrais) {
        try {
            $frais = DB::table('frais')
                ->Select('id_frais','anneemois','id_visiteur',
                    'nbjustificatifs','datemodification',
                    'montantvalide','frais.id_etat','etat.lib_etat')
                ->join ('etat','etat.id_etat','=','frais.id_etat')
                ->where('id_frais', '=',$idfrais )
                ->first();
            return $frais;
        } catch(QueryException $e ) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function saveFrais(Frai $frais) {
        try {
            $frais->save();
        }catch(QueryException $e) {
            throw new MonException($e->getMessage(), 5);

        }
    }

    public function getUnFrais($id){
        try{
            $frais = Frai::query()
                ->select('id_frais','anneemois','id_visiteur',
                    'nbjustificatifs','datemodification',
                    'montantvalide','id_etat')
            ->where('id_frais','=',$id)
                ->first();
            return $frais;
        } catch(QueryException $e ) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function delFrais($id) {
        try {
            Frai::destroy($id);
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }


    public function getFraisByVisiteur($id_visiteur) {
        try {
            $visiteur = DB::table('visiteur')
                ->Select('frais.id_frais','anneemois','frais.id_visiteur',
                    'nbjustificatifs','datemodification',
                    'montantvalide','frais.id_etat','etat.lib_etat')
                ->join('frais','visiteur.id_visiteur', '=','frais.id_visiteur')
                ->join ('etat','etat.id_etat','=','frais.id_etat')
                ->where('frais.id_visiteur', '=',$id_visiteur )
                ->get();
            return $visiteur;
        } catch(QueryException $e ) {
        throw new MonException($e->getMessage(), 5);
        }
    }
}
