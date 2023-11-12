<div class="col-lg-3 col-md-3">
    <div class="list-group">
        <a href="{{ route('account') }}" class="list-group-item list-group-item-action{{ request()->routeIs('account') ? ' active' : '' }}">Профил и сигурност</a>
        <a href="{{ route('favorites') }}" class="list-group-item list-group-item-action{{ request()->routeIs('favorites') ? ' active' : '' }}">Любими</a>
        <a href="{{ route('orders') }}" class="list-group-item list-group-item-action{{ request()->routeIs('orders') ? ' active' : '' }}">Твоите поръчки</a>
        <a href="{{ route('logout') }}" class="list-group-item list-group-item-action">Изход</a>
    </div>
</div>
