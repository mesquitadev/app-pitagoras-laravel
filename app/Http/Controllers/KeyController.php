<?php

namespace App\Http\Controllers;

use App\Models\Keys;
use App\Models\Sectors;
use App\Models\Types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sector = Sectors::all();
        $types = Types::all();
        $keys = DB::table('keys')
            ->join('sectors', 'sector_id', '=', 'sectors.id')
            ->join('types', 'type_id', '=', 'types.id')
            ->select('keys.*', 'types.name as type', 'sectors.name as sector')
            ->get();
        return view('keys.index', compact('keys', 'types', 'sector'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sector = Sectors::all();
        $types = Types::all();
        return view('keys.create', compact('sector', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'barcode' => 'required|unique:keys,barcode',
            'sector_id' => 'required',
            'type_id' => 'required'
        ]);

        $data =  new Keys([
            'name' => $request->get('name'),
            'barcode' => $request->get('barcode'),
            'sector_id' => $request->get('sector_id'),
            'type_id' => $request->get('type_id')
        ]);

        //Contagem para saber se a a chave já existe
        $count = Keys::where('barcode', $request->get('barcode'))->count();
        if($count <= 0) {
            //Salva no banco
            $response = $data->save();
            if ($response) {
                $notification = array(
                    'message' => 'Chave cadastrada com Sucesso!',
                    'alert-type' => 'success'
                );
                $data->save();
                return redirect(route('key.index'))->with($notification);

            } else {
                $notification = array(
                    "error" => true,
                    "message" => "Erro! Chave não cadastrada!",
                    'alert-type' => 'warning'
                );

                return redirect('dashboard')->with($notification);
            }
        } else {
            $notification = array(
                "error" => true,
                "message" => "Erro! Chave já cadastrada!",
                'alert-type' => 'error'
            );
            return redirect(route('key.index'))->with($notification);
        }




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function info($barcode) {

        $data = DB::table('keys')
            ->join('types', 'type_id', '=', 'types.id')
            ->select('keys.*', 'types.name as type')
            ->where('barcode', $barcode)
            ->get();

        if(count($data) <= 0){
            return array(
                'title' => 'Erro!',
                'error' => true,
                'message' => 'Chave não encontrada  !',
                'status' => 'error',
            );
        } else {
            return response()->json(['data' => $data], 201);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = Keys::findOrFail($request->id);

        if($data != null){
            $data->delete();

            $notification = array(
                "error" => false,
                "message" => "Sucesso! Chave deletada com sucesso!",
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                "error" => false,
                "message" => "Erro! Dados não atualizados!",
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }
}
