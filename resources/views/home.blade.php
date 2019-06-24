@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Информация для участников</div>

                <div class="card-body">
                    <p>После бронирования техники – заполните <a href="<?php echo asset("storage/contract.doc")?>">договор (воспользовавшись шаблоном)</a> 
                        и направьте подписанный в двух экземплярах документ в Отдел информационных технологий вашего филиала. 
                        <br> 
                        <p class="alert alert-info"> Если в течении 5-ти дней, <b>после окончания аукциона</b>, договор не будет предоставлен – бронь АННУЛИРУЕТСЯ</p>
                    </p>
                    <p>Для бронирования выберите интересующий вас раздел <a href="{{ route('computer.index') }}">Компьютеры</a> или <a href="{{ route('orgtech.index') }}">Оргтехника</a></p>
                    <a href="<?php echo asset("storage/contract.doc")?>" class="btn btn-primary btn-block">Скачать бланк договора</a>
                </div>
            </div>
        </div>   
        {{-- <example-component>loading...</example-component>        --}}
    </div>
</div>

@endsection
