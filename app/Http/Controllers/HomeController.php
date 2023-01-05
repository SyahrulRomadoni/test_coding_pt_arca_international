<?php

namespace App\Http\Controllers;

use App\Models\Buruh;
use App\Models\DataBuruh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DataBuruh::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        return view('home');
    }

    public function create(Request $request)
    {
        if (Auth::user()->id_role == 1) {
            $model = new DataBuruh;
            $model->pembayaran = $request->pembayaran;
            $model->save();

            if ($request->buruh[0]['persen'] == '') {
                // Kalo Link Kosong
            } else {
                $i = 0 ;
                foreach ($request->buruh as $key => $value) {
                    $dataA = ($value['persen'] / 100) * $request->pembayaran;
                    
                    $model_buruh = new Buruh();
                    $model_buruh->id_data_buruh = $model->id;
                    $model_buruh->buruh = "Buruh " . $i;
                    $model_buruh->persentase = $value['persen'];
                    $model_buruh->hasil = $dataA;
                    $model_buruh->save();
                    $i++;
                }
            }

            if ($model) {
                return Response()->json(['status' => 'success', 'message' => 'Data berhasil disimpan']);
            } else {
                return Response()->json(['status' => 'error', 'message' => 'Data gagal disimpan']);
            }
        } else {
            abort(403);
        }
    }

    public function view(Request $request)
    {
        $model = DataBuruh::join('buruh', 'buruh.id_data_buruh', 'data_buruh.id')->where('data_buruh.id', $request->id)->get();
        return Response()->json($model);
    }

    public function edit(Request $request)
    {
        $model = DataBuruh::join('buruh', 'buruh.id_data_buruh', 'data_buruh.id')->where('data_buruh.id', $request->id)->get();
        return Response()->json($model);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $model = DataBuruh::where('id', $id)->first();
        $model->pembayaran = $request->edit_pembayaran;
        $model->save();

        $model_buruh = Buruh::where('id_data_buruh', $model->id)->get();
        foreach ($model_buruh as $mlb) {
            $dataA = ($mlb->persentase / 100) * $request->edit_pembayaran;
            $mlb->hasil = $dataA;
            $mlb->save();
        }

        if ($model) {
            return Response()->json(['status' => 'success', 'message' => 'Data berhasil diupdate']);
        } else {
            return Response()->json(['status' => 'error', 'message' => 'Data gagal diupdate']);
        }
    }

    public function delete(Request $request)
    {
        if (Auth::user()->id_role == 1) {
            
            $id = $request->id;
            $model = DataBuruh::where('id', $id)->firstOrFail();
            $model_buruh = Buruh::where('id_data_buruh', $id)->get();
            foreach ($model_buruh as $mlb) {
                $a = Buruh::where('id_data_buruh', $id)->first();
                $a->delete();
            }
            $model->delete();

            if ($model) {
                return Response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus']);
            } else {
                return Response()->json(['status' => 'error', 'message' => 'Data gagal dihapus']);
            }
        } else {
            abort(403);
        }
    }
}
