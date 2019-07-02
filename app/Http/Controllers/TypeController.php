<?php

namespace App\Http\Controllers;

use App\Models\Types;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Types::all();
        return view('type-key.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('type-key.create');
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

        $type = new Types();
        $type->name = $request->name;
        $type->save();

        if ($type->save() == true) {
            echo "success";

            $notification = array(
                'message' => 'Tipo cadastrado com Sucesso!',
                'alert-type' => 'success'
            );

        } else {
            echo "error";
            $notification = array(
                "error" => true,
                "message" => "Erro! Tipo não cadastrada!",
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
        $data = Types::find($request->id);

        if($data != null){
            return $data->delete();
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
