<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductAddController extends Controller
{
    //商品追加
    public function add(Request $request)
    {
        //ログインチェック
        $login_check = $request->session()->get('login_check');
        if (isset($login_check) == false) {
            return redirect('/staff/login');
        }
        $login_name = $request->session()->get('login_name');

        return view('product.add', ['login_name' => $login_name]);
    }

    public function addOk(ProductRequest $request)
    {
        $product_title = $request->title;
        $product_price = $request->price;
        $product_image = $request->image;

        //画像をアップロード
        $storage = Storage::disk('s3');
        $read_path = $storage->putFile('/book-menu8', $product_image, 'public');

        $image = new Image;
        $image->image = $storage->url($read_path);
        $image->timestamps = false;
        $image->save();

        $request->session()->put([
            'product_title' => $product_title,
            'product_price' => $product_price,
            'read_path' => $read_path,
            'image' => $image->image,
        ]);

        return redirect('/product/add-check');
    }

    //商品追加チェック
    public function addCheck(Request $request)
    {
        //ログインチェック
        $login_check = $request->session()->get('login_check');
        if (isset($login_check) == false) {
            return redirect('/staff/login');
        }
        $login_name = $request->session()->get('login_name');

        $product_title = $request->session()->get('product_title');
        $product_price = $request->session()->get('product_price');
        $read_path = $request->session()->get('read_path');

        return view('product.add-check', [
            'login_name' => $login_name,
            'product_title' => $product_title,
            'product_price' => $product_price,
            'read_path' => $read_path,
        ]);
    }

    public function addCheckOk(Request $request)
    {
        $product_title = $request->session()->get('product_title');
        $product_price = $request->session()->get('product_price');
        $image = $request->session()->get('image');

        $product_info = [
            'title' => $product_title,
            'price' => $product_price,
            'image' => $image,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $product = new Product;
        unset($product_info['_token']);
        $product->fill($product_info)->save();

        return redirect('/product/add-done');
    }

    //商品追加完了
    public function addDone(Request $request)
    {
        //ログインチェック
        $login_check = $request->session()->get('login_check');
        if (isset($login_check) == false) {
            return redirect('/staff/login');
        }
        $login_name = $request->session()->get('login_name');

        $product_title = $request->session()->get('product_title');

        return view('product.add-done', [
            'login_name' => $login_name,
            'product_title' => $product_title,
        ]);
    }
}
