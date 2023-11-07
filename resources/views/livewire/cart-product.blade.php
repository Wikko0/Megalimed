<form wire:submit.prevent="addToCart">
<div class="product__details__button">
    <div class="quantity">
        <span>Количество:</span>
        <div class="pro-qty">
            <input wire:model="quantity" type="text" value="1">
        </div>
    </div>
    <button type="submit" class="cart-btn"><span class="icon_bag_alt"></span> Добави в количката</button>
    <ul>
        @if(Auth::user())
            <li><a href="{{route('make.favorites', [$product->id])}}"><span class="icon_heart_alt"></span></a></li>
        @else
            <li><a href="#"><span class="icon_heart_alt account-switch"></span></a></li>
        @endif

        <li><a href="#"><span class="icon_adjust-horiz calculator-switch"></span></a></li>
    </ul>
</div>
    @error('quantity')
    <span class="text-danger">{{ $message }}</span>
    @enderror
<div class="product__details__widget">
    <ul>
        <li>
            <span>Налични цветове:</span>
            <div class="color__checkbox">
                @foreach(json_decode($product->color) as $color)
                    <label for="{{$color}}">
                        <input wire:click="setSelectedColor('{{$color}}')" type="radio" name="color__radio" id="{{$color}}">
                        <span class="checkmark {{strtolower($color)}}-bg"></span>
                    </label>
                @endforeach
            </div>
            @error('selectedColor')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </li>
        <li>
            <span>Налични размери:</span>
            <div class="size__btn">
                @foreach(json_decode($product->size) as $size)
                    <label for="{{$size}}-btn">
                        <input wire:click="setSelectedSize('{{$size}}')" type="radio" id="{{$size}}-btn">
                        {{$size}}
                    </label>
                @endforeach
            </div>
            @error('selectedSize')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </li>
    </ul>
    <!-- Calculator Message -->
    @if(session('calculator_message'))
        <div class="alert alert-success alert-dismissible">
            <h5>Вашият размер е - {{ session('calculator_message') }}</h5>
        </div>
        @endif

<!-- Calculator Message End -->
</div>
</form>

<!-- Calculator Begin -->
@include('extends.calculatorExtend')
<!-- Calculator End -->
