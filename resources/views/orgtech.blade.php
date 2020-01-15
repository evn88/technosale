@extends('layouts.app')

@section('content')

<div class="container">
        <div class="col-md-12">
            <p class="alert alert-info">{{ $conf }}</p>
        </div>
    </div>

<orgtechs-component>
    <div class="container">
            <div class="col-md-12">
                загрузка...
            </div>
    </div>
</orgtechs-component>

    @include('modal.info', [
        'title_booking'=>'Бронирование оргтехники',
        'title_rebooking'=>'Перекупить оргтехнику',
        'route'=>'orgtech.store',
        'id'=>'orgtech_id'
    ])

@endsection
