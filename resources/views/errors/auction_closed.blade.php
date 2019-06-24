@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                {{-- <div class="card-header">Аукцион закрыт!</div> --}}

                <div class="card-body">
                    <div class="alert alert-danger">
                        <h4>Аукцион закрыт с 21.06.2019 16:00</h4>
                    </div>
                </div>
            </div>
        </div>          
    </div>
</div>

@endsection
