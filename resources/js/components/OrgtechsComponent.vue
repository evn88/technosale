<template>
    <div class="container">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span class="btn">Оргтехника</span> 
                        <div class="float-right">
                            <span class="btn">Данные обновятся через {{ timeToUpdate }} сек.</span>
                            <button class="btn btn-light float-right" @click="update" >Обновить</button>
                        </div>
                    </div> 

                    <div class="card-body">
                        <!-- {{ items }} -->
                    <table id="tablePreview" class="table table-hover table-sm table-bordered tablesorter">
                    <!--Table head-->
                    <thead>
                        <tr>
                            <th class="filter-select filter-exact" data-placeholder="Фильтр">Филиал</th>
                            <th>Инв. номер</th>
                            <th style="white-space:nowrap;">Модель</th>
                            <th>Тип техники</th>
                            <th class="filter-select filter-exact" data-placeholder="Фильтр">Год Выпуска</th>
                            <th class="filter-select filter-exact" data-placeholder="Фильтр">Состояние</th>
                            <th>Стоимость</th>
                            <th class="sorter-false filter-false">Десйтвия</th>
                        </tr>
                    </thead>
                    <!--Table head-->
                    <!--Table body-->
                    <tbody>
                        <!-- @foreach($comps as $pc) -->

                        <tr v-for="item in items.data">
                            <td>{{ item.filial }}</td>
                            <td align="center">{{ item.inventar }}</td>
                            <td>{{ item.model }}</td>
                            <td>{{ item.type }}</td>
                            <td align="center">{{ item.year }}</td>
                            <td align="center">{{ item.status }}</td>
                            <td align="center"> {{ item.start_price }}₽ <br> <small class="text-muted">{{ item.booked_user }}</small></td>
                            <td align="center">
                            <!-- @if($pc->booked_closed) -->
                                <p v-if="item.booked_closed"><b>Аукцион закрыт</b></p>
                                <div v-if="!item.booked_closed">
                            <!-- @else -->
                                <!-- @if(!$pc->is_booked) -->
                                    <div v-if="!item.is_booked">
                                        <!-- @if($pc->reserved) -->
                                        <span class="small booked_date" v-if="item.reserved">Лот ожидает подтверждения</span> 
                                        <!-- @else -->
                                        <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#booking" :data-whatever="item.id" v-if="!item.reserved">Забронировать</a>
                                        <!-- @endif -->
                                    </div>
                                <!-- @else -->
                                    <div v-if="item.is_booked">
                                        <a href="#" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#rebooking" :data-whatever="item.id">Перекупить</a>
                                    </div>   
                                <!-- @endif -->
                            <!-- @endif -->
                                </div>
                            </td>
                        </tr>
                        <!-- @endforeach -->
                    </tbody>
                    <!--Table body-->
                    </table>
                    <!--Table-->
                    </div>
                </div>
            </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                items: {
                    data: null
                },
                whatever: null,
                timeToUpdate: 30,
            }
        },
        created() {
                axios.get('./api/orgtechs')
                     .then(response => (this.items = response));     
        },
        mounted() {
            console.log('orgtechsComponent loaded')
            setInterval(() => {
                if(this.timeToUpdate <= 0){
                    this.update();
                }
                this.timeToUpdate--;
            }, 1000);
        },
        updated() {

             $("#tablePreview").tablesorter({
                theme : "bootstrap",
                widthFixed: false,
                sortReset : true,
                headerTemplate : '{content} {icon}', // new in v2.7. Needed to add the bootstrap icon!
                widgets : [ "uitheme", "filter", "columns", "zebra" ],
                widgetOptions : {
                    zebra : ["even", "odd"],
                    columns: [ "primary", "secondary", "tertiary" ],
                    filter_reset : ".reset",
                    filter_cssFilter: "form-control",
                }
            });

        },
        methods: {
            update() {
                axios.get('./api/orgtechs')
                 .then(response => (this.items = response));
                this.timeToUpdate = 30;
            }
        }
    }
</script>
