<?php

namespace App\Http\Controllers;

use App\dao\FraisService;
use App\Models\Frai;
use Illuminate\Http\Request;
class FraisController
{
    public function listerFrais($idfrais) {
        $servicefrais = new FraisService();
        $unfrais = $servicefrais->getFrais($idfrais);
        return response()->json([$unfrais]);

    }
    function details($idfrais){
        return response()->json(Frai::query()->find($idfrais));
    }

    public function ajoutFraisJSON(Request $request) {
        $frais = new Frai();
        $servicefrais = new FraisService();
        $frais->id_etat = 2;
        $frais->anneemois= $request->json('anneemois');
        $frais->id_visiteur = $request->json('id_visiteur');
        $frais->nbjustificatifs = $request->json('nbjustificatifs');
        $frais->datemodification = now();
        $servicefrais->saveFrais($frais);
        return response()->json(['status'=>'Insertion réalisée','data'=> $frais->id_frais]);
    }

    public function modifierFraisJSON(Request $request){

        $servicefrais = new FraisService();
        $idfrais = $request->json('id_frais');
        $frais = $servicefrais->getUnFrais($idfrais);
        $frais->anneemois= $request->json('anneemois');
        $frais->id_visiteur = $request->json('id_visiteur');
        $frais->nbjustificatifs = $request->json('nbjustificatifs');
        $frais->montantvalide = $request->json('montantvalide');
        $frais->id_etat = $request->json('id_etat');
        $frais->datemodification = now();
        $servicefrais->saveFrais($frais);
        return response()->json(['status'=>'Modification réalisée','data'=>$frais->id_frais]);
    }

    public function supprimerFraisJSON(Request $request){
        try{
            $id_frais = $request->json('id_frais');
            $servicefrais = new FraisService();
            $servicefrais->delFrais($id_frais);
            $success = "La suppression a été réussi du frais numéro : ".$id_frais." a réussi";
            return $success;
        }catch(\Exception $e){
            $erreur = "Request must be JSON";
            return $e;
        }
    }

    public function listevisiteur($id_visiteur) {
        try {
                $servicefrais = new FraisService();
                $listefrais = $servicefrais->getFraisByVisiteur($id_visiteur);
                return response()->json([$listefrais]);
        }catch(\Exception $e){
$erreur = "Request must be JSON";
return $e;
}
    }

}
