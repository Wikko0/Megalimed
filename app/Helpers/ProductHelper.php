<?php

namespace App\Helpers;

use App\Models\Product;
use Carbon\Carbon;

class ProductHelper
{
    public static function getFirstProductImage($productId): string
    {
        $extensions = ['jpg', 'jpeg', 'png', 'gif'];
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

        if (!is_null($product->discount)) {
            return '<div class="product__price">$ ' . $product->discount . ' <span>$ ' . $product->price . '</span></div>';
        } else {
            return '<div class="product__price">$ ' . $product->price . '</div>';
        }
    }
}
