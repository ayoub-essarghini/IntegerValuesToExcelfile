<?php

namespace App\Http\Controllers;

use App\Exports\DataExport;
use App\Models\Combindata;
use App\Models\Exceluploaded;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class FindCombinController extends Controller
{
    public function index(Exceluploaded $data)
    {
        $files = $data->latest()->get();
        return view('welcome',['files'=>$files]);
    }

    public function findCombin(Request $request, Combindata $data)
    {
        $min = $request->min;
        $max = $request->max;
        $b = $request->b;
        $x = $request->x;

        $count = 0;

        while ($min <= $max) {
            $res = $min * $b;
            $fres = $res / $x;
            if (intval($fres) == $fres) {
                $data->create([
                    'a' => $min,
                    'b' => $b,
                    'res' => $res,
                    'x' => $x,
                    'fres' => $fres
                ]);
                $count++;
            }
            $min++;
        }

        if ($count > 0) {
           $this->export();
            return redirect()->back()->with('success', "$count valueurs trouvé.");
        } else {
            return redirect()->back()->with('error', "Non valeur trouvé");
        }
    }

    public function export()
    {
        $fileName = Carbon::now()->timestamp . '.xlsx';
        $filePath = 'public/uploads/'.$fileName;
        Excel::store(new DataExport, $filePath);
        $fileSize = Storage::size($filePath);
        $createdAt = now();
        $number = $fileSize / 1024;
        Exceluploaded::create([
            'filename'=>$fileName,
            'size'=>number_format($number, 2, '.', ''),
            'path'=>$filePath,
            'date_create'=>$createdAt
        ]);
        Combindata::truncate();
    
    }

    public function delete($id,Exceluploaded $uploaded)
    {
        $data = $uploaded->find($id);

        if ($data)
        {
            Storage::delete('public/uploads/'.$data->filename);
            $data->delete();
            return redirect()->back()->with('success',"supprimé avec success !");
        } else {
            return redirect()->back()->with('error', "Ne suppress pas !");
        }
    }
}
