<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class dummyAPI extends Controller
{
    //
    function list()
    {
        $blog = Status::all();
        return [
            "status"=> "success",
            "data" => $blog,
            "message"=> "Successfully! All records has been fetched."
        ];
    }
    public function destroy(Status $id)
    {
        $id->delete();
        return [
            "status" => 1,
            "data" => $id,
            "msg" => "Blog deleted successfully"
        ];
    }
    function delete(){
    
    }
}
