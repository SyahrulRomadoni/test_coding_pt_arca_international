<?php

namespace App\Http\Controllers;

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
            $model->buruh_a = $request->buruh_a;
            $model->rp_a = $request->rp_a;
            $model->buruh_b = $request->buruh_b;
            $model->rp_b = $request->rp_b;
            $model->buruh_c = $request->buruh_c;
            $model->rp_c = $request->rp_c;
            $model->save();

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
        $model = DataBuruh::where('id', $request->id)->first();
        return Response()->json($model);
    }

    public function edit(Request $request)
    {
        $model = DataBuruh::where('id', $request->id)->first();
        return Response()->json($model);
    }

    public function update(Request $request)
    {
        $model = DataBuruh::where('id', $request->id)->first();
        $model->pembayaran = $request->edit_pembayaran;
        $model->buruh_a = $request->edit_buruh_a;
        $model->rp_a = $request->edit_rp_a;
        $model->buruh_b = $request->edit_buruh_b;
        $model->rp_b = $request->edit_rp_b;
        $model->buruh_c = $request->edit_buruh_c;
        $model->rp_c = $request->edit_rp_c;
        $model->save();

        if ($model) {
            return Response()->json(['status' => 'success', 'message' => 'Data berhasil diupdate']);
        } else {
            return Response()->json(['status' => 'error', 'message' => 'Data gagal diupdate']);
        }
    }

    public function delete(Request $request)
    {
        if (Auth::user()->id_role == 1) {
            $model = DataBuruh::where('id', $request->id)->first();
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
