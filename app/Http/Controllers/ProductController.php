<?php

namespace App\Http\Controllers;

use App\Notifications\DataChange;
use App\Product;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class ProductController extends Controller
{
    private $user;
    private $product;

    public function __construct(User $user, Product $product)
    {
        $this->middleware('auth');
        $this->user = $user;
        $this->product = $product;
    }

    public function index()
    {
        $id = Auth::User()->id;
        $products = $this->product->with('user')->get();
        return response()->json([
            "products" => $products
        ]);
    }

    public function create(Request $request,Product $product)
    {
        $rules = [
            "title" => "required",
            "description" => "required"
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            $verror = [];
            $message = $validator->messages();
            foreach($rules as $key => $value){
                $verror[$key] = $message->first($key);
            }
            return response()->json([
                "verrors" => $verror
            ]);
        }
        $input = [
            "user_id" => Auth::User()->id,
            "title" => $request->title,
            "description" => $request->description
        ];
        $product = $this->product->create($input);

//        auth()->user()->notify(new DataChange($product));

        return response()->json([
            "status" => "Product Created Successfully",
            "product" => $product
        ]);
    }

    public function update($id,Request $request,Product $product)
    {
        $user_id = $request->user_id;
        $this->product->find($id)->update($request->all());
        $this->user->find($user_id)->notify(new DataChange($id));

//      $this->product->notifications()->where('notifiable_id',$id)->update(["read_at" => ""]);


        return response()->json([
            "status" => "Successfully Updated!!",
            "not" => $this->user->notifications()
        ]);
    }

    public function delete($id)
    {
        $this->product->find($id)->delete();
        return response()->json([
            "message" => "Product Successfully Deleted"
        ]);
    }

    public function disNot()
    {
        $id = Auth::User()->id;
        $user = $this->user->find($id);
        return view('Notifications',compact(['user']));
    }

    public function dataDis($id)
    {
        $data = $this->product->where('id',$id)->with('user')->get();
        $user = Auth::User();
        $user->unreadNotifications()->update(['read_at' => Carbon::now()]);
        return view('indiData',compact('data'));
    }


}
