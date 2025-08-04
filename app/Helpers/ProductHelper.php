<?php

namespace App\Helpers;

use App\Models\Favorite;
use App\Models\Product;
use Carbon\Carbon;

class ProductHelper
{
    public static function getFirstProductImage($productId): string
    {
        $extensions = ['jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF'];
        $imagePath = null;

        foreach ($extensions as $extension) {
            $potentialImagePath = public_path("img/product/product-{$productId}/0.{$extension}");

            if (file_exists($potentialImagePath)) {
                $imagePath = 'img/product/product-'. $productId. '/0.' . $extension;
                break;
            }
        }

        if (!is_null($imagePath)) {
            return asset($imagePath);
        }

        return asset('path-to-default-image.jpg');
    }

    public static function getSecondProductImage($productId): string
    {
        $extensions = ['jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF'];
        $imagePath = null;

        foreach ($extensions as $extension) {
            $potentialImagePath = public_path("img/product/product-{$productId}/1.{$extension}");

            if (file_exists($potentialImagePath)) {
                $imagePath = 'img/product/product-'. $productId. '/1.' . $extension;
                break;
            }
        }

        if (!is_null($imagePath)) {
            return asset($imagePath);
        }

        return '';
    }

    public static function getProductLabel($productId): string
    {
        $product = Product::find($productId);

        if (!$product) {
            return '';
        }

        $isNew = Carbon::now()->subWeek()->lessThanOrEqualTo($product->created_at);
        $hasDiscount = !is_null($product->discount);

        if ($isNew && $hasDiscount) {
            return '<div class="label new sale">Sale</div>';
        } elseif ($isNew) {
            return '<div class="label new">New</div>';
        } elseif ($hasDiscount) {
            return '<div class="label sale">Sale</div>';
        }

        return '';
    }

    public static function getPriceHtml($productId): string
    {
        $product = Product::find($productId);

        if (!$product) {
            return '';
        }

        $euroRate = 1.9558;

        if (!is_null($product->discount)) {
            $discountEuro = number_format($product->discount / $euroRate, 2);
            $priceEuro = number_format($product->price / $euroRate, 2);

            return '<div class="product__price">'
                . $product->discount . ' лв (' . $discountEuro . ' €)'
                . ' <span>' . $product->price . ' лв (' . $priceEuro . ' €)</span>'
                . '</div>';
        } else {
            $priceEuro = number_format($product->price / $euroRate, 2);

            return '<div class="product__price">'
                . $product->price . ' лв (' . $priceEuro . ' €)'
                . '</div>';
        }
    }

    public static function getAllProductImage($productId): array
    {
        $directory = public_path("img/product/product-{$productId}/");
        $imageNames = [];

        if (is_dir($directory)) {
            if ($dh = opendir($directory)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file != '.' && $file != '..') {
                        $imageNames[] = "img/product/product-{$productId}/{$file}";
                    }
                }
                closedir($dh);
            }
        }


        return $imageNames;
    }

    public static function getPriceProductDetails($productId): string
    {
        $product = Product::find($productId);

        if (!$product) {
            return '';
        }

        $euroRate = 1.9558;

        if (!is_null($product->discount)) {
            $discountEuro = number_format($product->discount / $euroRate, 2);
            $priceEuro = number_format($product->price / $euroRate, 2);

            return '<div class="product__details__price">'
                . $product->discount . ' лв (' . $discountEuro . ' €)'
                . ' <span>' . $product->price . ' лв (' . $priceEuro . ' €)</span>'
                . '</div>';
        } else {
            $priceEuro = number_format($product->price / $euroRate, 2);

            return '<div class="product__details__price">'
                . $product->price . ' лв (' . $priceEuro . ' €)'
                . '</div>';
        }

    }

    public static function countFavorites($user): string
    {
        return Favorite::where('user', $user)->count();
    }
}
