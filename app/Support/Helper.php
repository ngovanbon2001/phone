<?php

use App\Constants\Common;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;

if (!function_exists('handleImage')) {
    function handleImage($fileImage): string
    {
        $imageName = "";

        if ($_FILES['image_url']['name']) {
            $image = $fileImage;
            $imageName = time() . '.' . $image->getClientOriginalName();

            $destinationPath = public_path('images/');

            $image->move($destinationPath, $imageName);

            $resizedImage = Image::make($destinationPath . $imageName)->fit(400, 400);

            $resizedImage->save($destinationPath . $imageName);
        }

        return $imageName;
    }
}

if (!function_exists('condition')) {
    function condition(array $conditions): array
    {
        foreach ($conditions as $key => $value) {
            if ($key == Common::UNSET_CONDITION || in_array($value[2], Common::UNSET)) {
                unset($conditions[$key]);
            }
        }
        return $conditions;
    }
}

if (!function_exists('convertJson')) {
    function convertJson(array $attribute)
    {
        return json_encode($attribute, true);
    }
}

if (!function_exists('decodeJson')) {
    function decodeJson(mixed $attribute)
    {
        return json_decode($attribute);
    }
}

if (!function_exists('loginCart')) {
    function loginCart()
    {
        $cart      = Session::get('cart-0') ?? [];
        $cartLogin = Session::get('cart-' . auth()->user()->id ?? 0) ?? [];
        $products  = array_merge($cart, $cartLogin);

        $aggregatedProducts = [];

        foreach ($products as $product) {
            $productId = $product["product_id"];
            $color = $product["color"];
            $quantity = intval($product["quantity"]);

            if (!isset($aggregatedProducts[$productId.'-'.$color])) {
                $aggregatedProducts[$productId.'-'.$color] = $product;
            } else {
                $aggregatedProducts[$productId.'-'.$color]["quantity"] += $quantity;
            }
        }

        if (!empty($cart)) {
            Session::forget('cart-0');
        }

        Session::put('cart-' . auth()->user()->id ?? 0, $aggregatedProducts);
    }
}

if (!function_exists('colorProduct')) {
    function colorProduct(int $id)
    {
        $color = DB::table('product_color')->select('color')->find($id);
        return isset($color->color) ? __(config('project.color')[$color->color]) : '';
    }
}