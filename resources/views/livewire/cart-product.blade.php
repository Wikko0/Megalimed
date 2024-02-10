<form wire:submit.prevent="addToCart">
<div class="product__details__button">
    <div class="quantity">
        <span>Количество:</span>
        <div class="pro-qty">
            <input wire:model="quantity" type="number" value="1">
        </div>
    </div>

        @if (empty($selectedColor && $selectedSize))
            <button type="submit" class="cart-btn"><span class="icon_bag_alt"></span> Избери цвят и размер </button>
        @elseif ($stockQuantity === 'Няма в наличност')
            <div class="cart-btn"><span class="icon_bag_alt"></span> Няма в наличност</div>
        @else
            <button type="submit" class="cart-btn"><span class="icon_bag_alt"></span> Добави в количката</button>
        @endif
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
                        <span class="checkmark {{str_replace(' ', '', strtolower($color))}}-bg"></span>
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
                @foreach($sizes as $size)
                    <label for="{{$size}}-btn" class="{{ $selectedSize == $size ? 'active' : '' }}">
                        <input wire:click="setSelectedSize('{{$size}}')" type="radio" id="{{$size}}-btn">
                        {{$size}}
                    </label>
                @endforeach
            </div>
            @error('selectedSize')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </li>
        <li>
            <span>В наличност:</span>
            <div class="size__btn">
                @if (empty($selectedColor && $selectedSize))
                    Изберете цвят и размер
                @elseif ($stockQuantity === 'Няма в наличност')
                    Няма в наличност
                @elseif ($stockQuantity == 99)
                    В наличност
                @else
                    Налично количество: {{ $stockQuantity }}
                @endif
            </div>
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
<script>
    // Получаване на елементите, които се използват за избор на цвят и размер
    const colorRadios = document.querySelectorAll('input[name="color__radio"]');
    const sizeRadios = document.querySelectorAll('input[type="radio"][id$="-btn"]');

    // Прикрепяне на слушатели за промяна в избора на цвят и размер
    colorRadios.forEach(colorRadio => {
        colorRadio.addEventListener('change', updateStockInfo);
    });

    sizeRadios.forEach(sizeRadio => {
        sizeRadio.addEventListener('change', updateStockInfo);
    });

    // Функция за обновяване на информацията за наличност
    function updateStockInfo() {
        const selectedColor = document.querySelector('input[name="color__radio"]:checked').id;
        const selectedSize = document.querySelector('input[type="radio"][id$="-btn"]:checked').id.replace('-btn', '');

        // Тук трябва да вземете информацията за наличност от $product->stock
        // и да я покажете в елемента с клас 'stock-info'
        const stockData = JSON.parse('{!! addslashes(json_encode($product->stock)) !!}');
        const stockKey = selectedColor + '-' + selectedSize;
        const stockQuantity = stockData[stockKey] || 0;

        const stockInfoElement = document.querySelector('.stock-info');
        stockInfoElement.textContent = `Налично количество: ${stockQuantity}`;
    }
</script>
<!-- Calculator Begin -->
@include('extends.calculatorExtend')
<!-- Calculator End -->
