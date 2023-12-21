<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function create_product(Request $request){
        
        $validator = \Validator::make($request -> all(),[
            'name' => 'required',
            'unit'  => 'required',
            'price' => 'required',
            'available_inventory' => 'required',
            'expiration_date' => 'required',
            'image' => 'required',
        ]);

        if($validator -> fails())
        {
            // if the validator fails
            return response()->json([
                'code' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        }
        else
        {
            
            $product = new Product();
            $product -> name = $request -> name;
            $product -> unit = $request -> unit;
            $product -> price = $request -> price;
            $product -> available_inventory = $request -> available_inventory;
            $product -> expiration_date = $request -> expiration_date;

            if($request -> hasfile('image'))
            {

                $file = $request->file('image');
                $extension = $file -> getClientOriginalExtension();
                $filename = time() . '.' .$extension;
                $file->storeAs('public/product/images', $filename);

                $product -> image = $filename;
            }

            
            $product -> save();
            return response()->json([
                'code' => 200,
                'msg' => 'Product Created Successfully',
            ]);

          

           
           
        }
    }

    public function fetch_all() {
		$allproduct = Product::all();
		$output = '';
		if ($allproduct->count() > 0) {
			$output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Unit</th>
                <th>Price</th>
                <th>Expiration Date</th>
                <th>Available Inventory</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
			foreach ($allproduct as $data) {
				$output .= '<tr>
                <td>' . $data->id . '</td>
                <td><img src="storage/product/images/' . $data->image . '" width="100" "></td>
                <td>' . $data->name . '</td>
                <td>' . $data->unit . '</td>
                <td>' . $data->price . '</td>
                <td>' . $data->expiration_date . '</td>
                <td>' . $data->available_inventory. '</td>
                <td>
                  <a href="#" id="' . $data->id . '" class="text-primary mx-1 view_product" data-bs-toggle="modal" data-bs-target="#ViewModal" style="text-decoration:none;"><i class="bi bi-eye h4"></i>
                  </a>

                  <a href="#" id="' . $data->id . '" class="text-success mx-1 edit_product" data-bs-toggle="modal" data-bs-target="#EditModal"><i class="bi-pencil-square h4"></i></a>

                  <a href="#" id="' . $data->id . '" class="text-danger mx-1 delete_product"><i class="bi-trash h4"></i></a>

                </td>
              </tr>';
			}
			$output .= '</tbody></table>';
			echo $output;
		} else {
			echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
		}
	}

    public function edit_product(Request $request)
    {
		
		$selected_product = Product::find($request->id);
		return response()->json($selected_product);
	}

    public function update_product(Request $request)
    {
        //To validate the employee
        $validator = \Validator::make($request -> all(),[
            'name' => 'required',
            'unit'  => 'required',
            'price' => 'required',
            'available_inventory' => 'required',
            'expiration_date' => 'required',
        ]);

        if($validator -> fails())
        {
            // if the validator fails
            return response()->json([
                'code' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        }
        else
        {
            $fileName = '';
            $update_product = Product::find($request->id);
            if($request ->hasfile('image'))
            {
                $file = $request->file('image');
                $extension = $file -> getClientOriginalExtension();
                $fileName = time() . '.' .$extension;
                $file->storeAs('public/product/images', $fileName);
                if ($update_product->image)
                {
                    Storage::delete('public/product/images/' . $emp_update->image);
                }
                $update_product -> image = $fileName;
            }
           
           
            $update_product -> name = $request -> name;
            $update_product -> unit = $request -> unit;
            $update_product -> price = $request -> price;
            $update_product -> available_inventory = $request -> available_inventory;
            $update_product -> expiration_date = $request -> expiration_date;

            $update_product -> update();

            return response()->json([

                'status' => 200,
                'msg' => 'Product Update Successfully',
		    ]);
        }
	}

     
	public function delete_product(Request $request) {
		
		$delete_product = Product::find($request -> id);
        
        
        if (Storage::delete('public/product/images/' . $delete_product->image)) {

			Product::destroy($request -> id);
		}
        else{

            Product::destroy($request -> id);

        }
    
       
        
	}

    public function view_product(Request $request)
    {
		$view_product = Product::find($request->id);
		return response()->json($view_product);
	}
}
