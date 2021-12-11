@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Product List</h3>
                     <a href="{{ route('products.index') }}" class="btn btn-alt-primary" title="View">Show List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
