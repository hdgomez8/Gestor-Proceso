<?php

namespace App\Http\Controllers;

use App\Models\Capbas;
use Illuminate\Http\Request;
use App\Models\Despachos;
use Illuminate\Support\Facades\DB; // Assuming your model namespace is App\Models


class FarmaciaController extends Controller
{
    //index, create, store, show, edit, update y destroy
    public function index()
    {
        $sql = "select  distinct top 20 D.HISTipDoc,D.HISCKEY,MPNOMC Nombre,
        DsNumDoc Despacho 
        from DSPFRMC D
        INNER JOIN DSPFRMC1 D1 ON D1.HISCKEY =D.HISCKEY AND D.HISTipDoc=D1.HISTipDoc AND D.HISCSEC=D1.HISCSEC AND D.MSRESO =D1.MSRESO
        INNER JOIN CAPBAS C ON C.MPCedu=D.HISCKEY AND MPTDoc=D.HISTipDoc
        INNER JOIN HCCOM1 HC ON HC.HISCKEY=D.HISCKEY  and  hc.HISTipDoc=D.HISTipDoc and hc.HISCSEC=D.HISCSEC
        INNER JOIN MAEPAB M ON M.MPCODP =HCCODPAB
        INNER JOIN MAEEMP E ON E.MENNIT=FHCCodCto
        INNER JOIN MAESUM1 MA ON MA.MSRESO=D1.MSRESO
         where DSmFHrMov between dateadd (hour,-5,getdate())  and getdate() and  DsNumDoc<>'0' and DSCodEmp='01'  order by DsNumDoc desc        
        ";
        $despachos = DB::connection('sqlsrv2')->select($sql);

        //dd($despachos);
        $despachosNombre = [];

        foreach ($despachos as $despacho) {
            $busqueda = Capbas::where('MPTDoc', '=', $despacho->HISTipDoc)
                ->where('MPCedu', '=', $despacho->HISCKEY)
                ->first();

            //dd($busqueda->MPNOMC);
            $despachosNombre[] = [
                'HISTipDoc' => $despacho->HISTipDoc,
                'HISCKEY' => $despacho->HISCKEY,
                'MPNOMC' => $busqueda->MPNOMC ?? "",
                'DsCnsDsp' => $despacho->Despacho
            ];
        }
        //dd($despachosNombre);
        return view('farmacia.despachos.index', ['despachos' => $despachosNombre]);
    }

    public function verDespacho(Request $request){
         //dd($request);
         //$numeroDespacho = trim($despacho['DsCnsDsp']);
         dd($request);
        $despacho = Despachos::where('DsCnsDsp', '=', $numeroDespacho)
        ->whereYear('DSmFHrMov', '2022')  
        ->orderBy('DsCnsDsp', 'desc')
        ->paginate(20);

        //$despachos = $despachos->unique('HISCKEY');

        //dd($despachos);
        return view('farmacia.despachos.show', compact('despacho'));
    }
}
