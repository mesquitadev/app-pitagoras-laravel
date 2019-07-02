<?php

namespace App\Http\Controllers;

use App\Models\Sectors;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectors = Sectors::all();
        return view('sectors.index', compact('sectors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required'
        ]);

        $sector = new Sectors();
        $sector->name = $request->name;
        $sector->save();

        if ($sector->save() == true) {
            echo "success";

            $notification = array(
                'message' => 'Setor cadastrado com Sucesso!',
                'alert-type' => 'success'
            );

        } else {
            echo "error";
            $notification = array(
                'message' => 'Erro! Chave não cadastrada!',
                'alert-type' => 'warning'
            );

        }

        return redirect()->back()->with($notification);

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $sector = Sectors::findOrFail($request->sector_id);
        $data = $sector->update($request->all());

        if($data){
            $notification = array(
                "error" => false,
                "message" => "Sucesso! Dados atualizados com sucesso",
                'alert-type' => 'success'
            );
            $sector->update($request->all());

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = Sectors::find($request->id);

        if($data != null){
            $data->delete();

            $notification = array(
                "error" => false,
                "message" => "Sucesso! Setor deletado com sucesso!",
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
