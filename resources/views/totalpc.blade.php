@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <span class="btn">Компьютеры</span>
                <div class="float-right">

                </div>
            </div>

            <div class="card-body">
               
            <table id="tablePreview" class="table table-hover table-sm table-bordered tablesorter">
            <!--Table head-->
            <thead>
                <tr>
                    <th class="filter-select filter-exact" data-placeholder="Фильтр">Филиал</th>
                    <th>Инв. номер</th>
                    <th style="white-space:nowrap;">Тех. характеристики <br>(CPU/HDD/RAM)</th>
                    <th>Монитор</th>
                    <th class="filter-select filter-exact" data-placeholder="Фильтр">Год Выпуска</th>
                    <th class="filter-select filter-exact" data-placeholder="Фильтр">Состояние</th>
                    <th>Стоимость начальная</th>
                    <th>Стоимость для заявителя</th>
                    <th>Заявитель</th>
                    <th>Филиал заявителя</th>
                    <th>Подтверждение ставки</th>
                </tr>
            </thead>
            <!--Table head-->
            <!--Table body-->
            <tbody>
                @foreach ($comps as $item)
                <tr>
                    <td>{{ $item->filial }}</td>
                    <td align="center">{{ $item->inventar }}</td>
                    <td>{{ $item->pcconfig }}</td>
                    <td>{{ $item->monitor }}</td>
                    <td align="center">{{ $item->year }}</td>
                    <td align="center">{{ $item->status }}</td>
                    <td align="center">{{ $item->start_price }}₽</td>
                    <td align="center">{{ $item->total_price }}₽ <br><small>кол-во заявок: {{ $item->booked_count }}</small></td>
                    <td align="center">{{ $item->booked_user }}</td>
                    <td align="center">{{ $item->booked_filial }}</td>
                    <td align="center">{{ $item->booked_confirm_date }}</td>
                </tr>
                @endforeach
                
            </tbody>
            <!--Table body-->
            </table>
            <!--Table-->
            </div>
        </div>
    </div>
</div>

@endsection