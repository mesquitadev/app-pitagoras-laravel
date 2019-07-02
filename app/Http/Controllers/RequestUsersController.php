<?php

namespace App\Http\Controllers;

use App\Models\RequestUsers;
use Illuminate\Http\Request;

class RequestUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reqUsers = RequestUsers::all();
        return view('request-users.index', compact('reqUsers'));
    }

    /**
     * @param $cpf
     */
    public function info($cpf)
    {
        $data = RequestUsers::where('cpf', $cpf)->get();

        if(count($data) <= 0){
            return array(
                'title' => 'Erro!',
                'error' => true,
                'message' => 'Usuário não encontrado!',
                'status' => 'error',
            );
        } else {
            return response()->json(['data' => $data], 201);
        }
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
            'cpf' => 'required|min:11|max:14',
            'name' => 'required',
            'phone1' => 'required'
        ]);

        //Remove Máscara do CPF
        $request->cpf = $this->removeMask($request->cpf);

        $reqUser = new RequestUsers();
        $reqUser->cpf = $request->cpf;
        $reqUser->name = $request->name;
        $reqUser->phone1 = $request->phone1;
        $reqUser->phone2 = $request->phone2;
        $reqUser->save();

        if ($reqUser->save() == true) {
            echo "success";

            $notification = array(
                'message' => 'Usuário cadastrado com Sucesso!',
                'alert-type' => 'success'
            );

        } else {
            echo "error";
            $notification = array(
                "error" => true,
                "message" => "Erro! Usuário não cadastrado!",
                'alert-type' => 'warning'
            );

        }

        return redirect('dashboard')->with($notification);

    }

    /**
     * Remove a máscara do cpf
     * @param $cpf
     * @return mixed|string
     */
    public function removeMask($cpf)
    {
        $cpf = trim($cpf);
        $cpf = str_replace('.', '', $cpf);
        $cpf = str_replace('-', '', $cpf);
        return $cpf;
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
        $reqUser = RequestUsers::findOrFail($request->id);
        $data = $reqUser->update($request->all());
        //Remove Máscara do CPF
        $request->cpf = $this->removeMask($request->cpf);

        if($data){
            $notification = array(
                "error" => false,
                "message" => "Sucesso! Dados atualizados com sucesso",
                'alert-type' => 'success'
            );
            $reqUser->update($request->all());

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
    public function destroy($id)
    {
        //
    }
}
