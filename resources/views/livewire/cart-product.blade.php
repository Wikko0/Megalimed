<form wire:submit.prevent="addToCart">
<div class="product__details__button">
    <div class="quantity">
        <span>Quantity:</span>
        <div class="pro-qty">
            <input wire:model="quantity" type="text" value="1">
        </div>
    </div>
    <button type="submit" class="cart-btn"><span class="icon_bag_alt"></span> Add to cart</button>
    <ul>
        <li><a href="#"><span class="icon_heart_alt"></span></a></li>
        <li><a href="#"><span class="icon_adjust-horiz"></span></a></li>
    </ul>
</div>
    @error('quantity')
    <span class="text-danger">{{ $message }}</span>
    @enderror
<div class="product__details__widget">
    <ul>
        <li>
            <span>Available color:</span>
            <div class="color__checkbox">
                @foreach(json_decode($product->color) as $color)
                    <label for="{{$color}}">
                        <input wire:model="selectedColor" type="radio" name="color__radio" id="{{$color}}">
                        <span class="checkmark {{strtolower($color)}}-bg"></span>
                    </label>
                @endforeach
            </div>
            @error('selectedColor')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </li>
        <li>
            <span>Available size:</span>
            <div class="size__btn">
                @foreach(json_decode($product->size) as $size)
                    <label for="{{$size}}-btn">
                        <input wire:model="selectedSize" type="radio" id="{{$size}}-btn">
                        {{$size}}
                    </label>
                @endforeach
            </div>
            @error('selectedSize')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </li>
    </ul>
</div>
</form>
