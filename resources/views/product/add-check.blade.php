@extends('layouts.book-menu')

@section('login')
    <p>{{ $login_name }}さん、ログイン中</p>
@endsection

@section('heading', '商品追加')

@section('content')
    <form action="" method="post">
        @csrf
        <div class="product-content-wrapper clearfix">
            <div class="left">
                <table class="product-content">
                    <tr>
                        <td>タイトル</td>
                        <td>
                            <span class="border-bottom">
                                {{ $product_title }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>価格</td>
                        <td>
                            <span class="border-bottom">
                              {{ $product_price }}円
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="right">
                <img src="{{ Storage::disk('s3')->url($read_path) }}" alt="{{ Storage::disk('s3')->url($read_path) }}">
            </div>
        </div>
        <input class="button black" type="button" onclick="history.back()" value="戻る"> |
        <input class="button black" type="submit" value="追加">
    </form>
@endsection
