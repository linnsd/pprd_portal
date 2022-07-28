<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\CarExport;
use App\Imports\CarImport;

use App\Exports\ShopsExport;
use App\Imports\ShopsImport;

use App\Exports\TerminalExport;
use App\Imports\TerminalImport;

use App\Exports\AirportOilExport;
use App\Imports\AirportOilImport;

use App\Exports\StateDivisionExport;
use App\Exports\TownshipExport;

use Maatwebsite\Excel\Facades\Excel;
use File;

class ExcelController extends Controller
{

     /**
    * @return \Illuminate\Support\Collection
    */
    public function exportStateDivisions() 
    {
        return Excel::download(new StateDivisionExport, 'state_divisions.xlsx');
    }


     /**
    * @return \Illuminate\Support\Collection
    */
    public function exportTownship() 
    {
        return Excel::download(new TownshipExport, 'townships.xlsx');
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function exportCar() 
    {
        return Excel::download(new CarExport, 'bowsers.xlsx');
    }
   

    public function importCar(Request $request) 
    {
        $request->validate([
            'file'=>'required',
        ]);

        $res = Excel::import(new CarImport,request()->file('file'));

        dd($res);
           
        return back();
    }

    public function downloadCarCSV()
    {

        $strpath = public_path().'/uploads/files/car.csv';

        $isExists = File::exists($strpath);

        if(!$isExists){
            return redirect()->back()->with('error','File does not exists!');
        }

        $csvFile = str_replace("\\", '/', $strpath);
        $headers = ['Content-Type: application/*'];
        $fileName = 'Car Demo.csv';

        return response()->download($csvFile, $fileName, $headers);

        
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function importShop(Request $request) 
    {

        $request->validate([
            'file'=>'required',
        ]);

        Excel::import(new ShopsImport,request()->file('file'));
           
        return back();
    }

    public function importVillageShop(Request $request)
    {
        $request->validate([
            'file'=>'required',
        ]);

        Excel::import(new VillageShopImport,request()->file('file'));
           
        return back();
    }
   

    public function exportShops() 
    { 
       return Excel::download(new ShopsExport, 'shops.xlsx');
    }

    public function exportTerminal()
    {
        return Excel::download(new TerminalExport, 'shops.xlsx');
    }

    public function importTerminal(Request $request) 
    {

        $request->validate([
            'file'=>'required',
        ]);

        Excel::import(new TerminalImport,request()->file('file'));
           
        return back();
    }

    public function exportAirport()
    {
        return Excel::download(new AirportOilExport, 'shops.xlsx');
    }

    public function importAirport(Request $request) 
    {

        $request->validate([
            'file'=>'required',
        ]);

        Excel::import(new AirportOilImport,request()->file('file'));
           
        return back();
    }

    // exportAirport

    public function downloadShopsCSV()
    {

        $strpath = public_path().'/uploads/files/shops.xlsx';

        $isExists = File::exists($strpath);

        if(!$isExists){
            return redirect()->back()->with('error','File does not exists!');
        }

        $csvFile = str_replace("\\", '/', $strpath);
        $headers = ['Content-Type: application/*'];
        $fileName = 'Shops Template.csv';

        return response()->download($csvFile, $fileName, $headers);

        
    }

    public function downloadVillageShop($value='')
    {
        $strpath = public_path().'/uploads/files/shops.csv';

        $isExists = File::exists($strpath);

        if(!$isExists){
            return redirect()->back()->with('error','File does not exists!');
        }

        $csvFile = str_replace("\\", '/', $strpath);
        $headers = ['Content-Type: application/*'];
        $fileName = 'Shops Template.csv';

        return response()->download($csvFile, $fileName, $headers);
    }

    
}
