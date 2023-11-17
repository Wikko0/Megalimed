@extends('layouts.admin')
@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="row g-0">
                <div class="col d-flex flex-column">
                    <div class="card-body">
                        <h2 class="mb-4">Size Calculator</h2>
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <h5><i class="icon fas fa-check"></i> Успешно!</h5>
                                <ul>{{session('success')}}</ul>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-warning alert-dismissible">

                                <h5><i class="icon fas fa-exclamation-triangle"></i> Грешка!</h5>
                                @foreach ($errors->all() as $error)
                                    <ul>{{ $error }}</ul>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ route('admin.calculator.form') }}" method="post">
                            @csrf
                            <input type="hidden" name="size" value="XXS">
                            <div class="card-header">
                                <h3 class="card-title">XXS Size</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label required">Minimum Height</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter minimum height" name="minHeight" value="{{$XXS->minHeight??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Maximum Height</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter maximum height" name="maxHeight" value="{{$XXS->maxHeight??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Minimum KG</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter minimum kilograms" name="minKg" value="{{$XXS->minKg??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Maximum KG</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter maximum kilograms" name="maxKg" value="{{$XXS->maxKg??null}}">
                                    </div>
                                </div>



                            <div class="mb-3">
                                <label class="form-label required">Length Top</label>
                                <div>
                                    <input type="number" class="form-control" placeholder="Enter length top" name="lengthTop" value="{{$XXS->lengthTop??null}}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Width Top</label>
                                <div>
                                    <input type="number" class="form-control" placeholder="Enter width top" name="widthTop" value="{{$XXS->widthTop??null}}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Length Bot</label>
                                <div>
                                    <input type="number" class="form-control" placeholder="Enter length bot" name="lengthBot" value="{{$XXS->lengthBot??null}}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Width Bot</label>
                                <div>
                                    <input type="number" class="form-control" placeholder="Enter width bot" name="widthBot" value="{{$XXS->widthBot??null}}">
                                </div>
                            </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                        <form action="{{ route('admin.calculator.form') }}" method="post">
                            @csrf
                            <input type="hidden" name="size" value="XS">
                            <div class="card-header">
                                <h3 class="card-title">XS Size</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label required">Minimum Height</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter minimum height" name="minHeight" value="{{$XS->minHeight??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Maximum Height</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter maximum height" name="maxHeight" value="{{$XS->maxHeight??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Minimum KG</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter minimum kilograms" name="minKg" value="{{$XS->minKg??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Maximum KG</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter maximum kilograms" name="maxKg" value="{{$XS->maxKg??null}}">
                                    </div>
                                </div>



                            <div class="mb-3">
                                <label class="form-label required">Length Top</label>
                                <div>
                                    <input type="number" class="form-control" placeholder="Enter length top" name="lengthTop" value="{{$XS->lengthTop??null}}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Width Top</label>
                                <div>
                                    <input type="number" class="form-control" placeholder="Enter width top" name="widthTop" value="{{$XS->widthTop??null}}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Length Bot</label>
                                <div>
                                    <input type="number" class="form-control" placeholder="Enter length bot" name="lengthBot" value="{{$XS->lengthBot??null}}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Width Bot</label>
                                <div>
                                    <input type="number" class="form-control" placeholder="Enter width bot" name="widthBot" value="{{$XS->widthBot??null}}">
                                </div>
                            </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                        <form action="{{ route('admin.calculator.form') }}" method="post">
                            @csrf
                            <input type="hidden" name="size" value="S">
                            <div class="card-header">
                                <h3 class="card-title">S Size</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label required">Minimum Height</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter minimum height" name="minHeight" value="{{$S->minHeight??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Maximum Height</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter maximum height" name="maxHeight" value="{{$S->maxHeight??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Minimum KG</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter minimum kilograms" name="minKg" value="{{$S->minKg??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Maximum KG</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter maximum kilograms" name="maxKg" value="{{$S->maxKg??null}}">
                                    </div>
                                </div>



                            <div class="mb-3">
                                <label class="form-label required">Length Top</label>
                                <div>
                                    <input type="number" class="form-control" placeholder="Enter length top" name="lengthTop" value="{{$S->lengthTop??null}}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Width Top</label>
                                <div>
                                    <input type="number" class="form-control" placeholder="Enter width top" name="widthTop" value="{{$S->widthTop??null}}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Length Bot</label>
                                <div>
                                    <input type="number" class="form-control" placeholder="Enter length bot" name="lengthBot" value="{{$S->lengthBot??null}}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Width Bot</label>
                                <div>
                                    <input type="number" class="form-control" placeholder="Enter width bot" name="widthBot" value="{{$S->widthBot??null}}">
                                </div>
                            </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                        <form action="{{ route('admin.calculator.form') }}" method="post">
                            @csrf
                            <input type="hidden" name="size" value="M">
                            <div class="card-header">
                                <h3 class="card-title">M Size</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label required">Minimum Height</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter minimum height" name="minHeight" value="{{$M->minHeight??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Maximum Height</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter maximum height" name="maxHeight" value="{{$M->maxHeight??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Minimum KG</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter minimum kilograms" name="minKg" value="{{$M->minKg??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Maximum KG</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter maximum kilograms" name="maxKg" value="{{$M->maxKg??null}}">
                                    </div>
                                </div>



                            <div class="mb-3">
                                <label class="form-label required">Length Top</label>
                                <div>
                                    <input type="number" class="form-control" placeholder="Enter length top" name="lengthTop" value="{{$M->lengthTop??null}}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Width Top</label>
                                <div>
                                    <input type="number" class="form-control" placeholder="Enter width top" name="widthTop" value="{{$M->widthTop??null}}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Length Bot</label>
                                <div>
                                    <input type="number" class="form-control" placeholder="Enter length bot" name="lengthBot" value="{{$M->lengthBot??null}}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Width Bot</label>
                                <div>
                                    <input type="number" class="form-control" placeholder="Enter width bot" name="widthBot" value="{{$M->widthBot??null}}">
                                </div>
                            </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                        <form action="{{ route('admin.calculator.form') }}" method="post">
                            @csrf
                            <input type="hidden" name="size" value="L">
                            <div class="card-header">
                                <h3 class="card-title">L Size</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label required">Minimum Height</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter minimum height" name="minHeight" value="{{$L->minHeight??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Maximum Height</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter maximum height" name="maxHeight" value="{{$L->maxHeight??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Minimum KG</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter minimum kilograms" name="minKg" value="{{$L->minKg??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Maximum KG</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter maximum kilograms" name="maxKg" value="{{$L->maxKg??null}}">
                                    </div>
                                </div>



                            <div class="mb-3">
                                <label class="form-label required">Length Top</label>
                                <div>
                                    <input type="number" class="form-control" placeholder="Enter length top" name="lengthTop" value="{{$L->lengthTop??null}}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Width Top</label>
                                <div>
                                    <input type="number" class="form-control" placeholder="Enter width top" name="widthTop" value="{{$L->widthTop??null}}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Length Bot</label>
                                <div>
                                    <input type="number" class="form-control" placeholder="Enter length bot" name="lengthBot" value="{{$L->lengthBot??null}}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Width Bot</label>
                                <div>
                                    <input type="number" class="form-control" placeholder="Enter width bot" name="widthBot" value="{{$L->widthBot??null}}">
                                </div>
                            </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                        <form action="{{ route('admin.calculator.form') }}" method="post">
                            @csrf
                            <input type="hidden" name="size" value="XL">
                            <div class="card-header">
                                <h3 class="card-title">XL Size</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label required">Minimum Height</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter minimum height" name="minHeight" value="{{$XL->minHeight??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Maximum Height</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter maximum height" name="maxHeight" value="{{$XL->maxHeight??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Minimum KG</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter minimum kilograms" name="minKg" value="{{$XL->minKg??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Maximum KG</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter maximum kilograms" name="maxKg" value="{{$XL->maxKg??null}}">
                                    </div>
                                </div>



                            <div class="mb-3">
                                <label class="form-label required">Length Top</label>
                                <div>
                                    <input type="number" class="form-control" placeholder="Enter length top" name="lengthTop" value="{{$XL->lengthTop??null}}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Width Top</label>
                                <div>
                                    <input type="number" class="form-control" placeholder="Enter width top" name="widthTop" value="{{$XL->widthTop??null}}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Length Bot</label>
                                <div>
                                    <input type="number" class="form-control" placeholder="Enter length bot" name="lengthBot" value="{{$XL->lengthBot??null}}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Width Bot</label>
                                <div>
                                    <input type="number" class="form-control" placeholder="Enter width bot" name="widthBot" value="{{$XL->widthBot??null}}">
                                </div>
                            </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                        <form action="{{ route('admin.calculator.form') }}" method="post">
                            @csrf
                            <input type="hidden" name="size" value="XXL">
                            <div class="card-header">
                                <h3 class="card-title">XXL Size</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label required">Minimum Height</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter minimum height" name="minHeight" value="{{$XXL->minHeight??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Maximum Height</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter maximum height" name="maxHeight" value="{{$XXL->maxHeight??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Minimum KG</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter minimum kilograms" name="minKg" value="{{$XXL->minKg??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Maximum KG</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter maximum kilograms" name="maxKg" value="{{$XXL->maxKg??null}}">
                                    </div>
                                </div>




                            <div class="mb-3">
                                <label class="form-label required">Length Top</label>
                                <div>
                                    <input type="number" class="form-control" placeholder="Enter length top" name="lengthTop" value="{{$XXL->lengthTop??null}}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Width Top</label>
                                <div>
                                    <input type="number" class="form-control" placeholder="Enter width top" name="widthTop" value="{{$XXL->widthTop??null}}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Length Bot</label>
                                <div>
                                    <input type="number" class="form-control" placeholder="Enter length bot" name="lengthBot" value="{{$XXL->lengthBot??null}}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Width Bot</label>
                                <div>
                                    <input type="number" class="form-control" placeholder="Enter width bot" name="widthBot" value="{{$XXL->widthBot??null}}">
                                </div>
                            </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                        <form action="{{ route('admin.calculator.form') }}" method="post">
                            @csrf
                            <input type="hidden" name="size" value="XXXL">
                            <div class="card-header">
                                <h3 class="card-title">XXXL Size</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label required">Minimum Height</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter minimum height" name="minHeight" value="{{$XXXL->minHeight??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Maximum Height</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter maximum height" name="maxHeight" value="{{$XXXL->maxHeight??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Minimum KG</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter minimum kilograms" name="minKg" value="{{$XXXL->minKg??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Maximum KG</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter maximum kilograms" name="maxKg" value="{{$XXXL->maxKg??null}}">
                                    </div>
                                </div>


                                <div class="mb-3">
                                    <label class="form-label required">Length Top</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter length top" name="lengthTop" value="{{$XXXL->lengthTop??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Width Top</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter width top" name="widthTop" value="{{$XXXL->widthTop??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Length Bot</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter length bot" name="lengthBot" value="{{$XXXL->lengthBot??null}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Width Bot</label>
                                    <div>
                                        <input type="number" class="form-control" placeholder="Enter width bot" name="widthBot" value="{{$XXXL->widthBot??null}}">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
