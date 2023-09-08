@extends('layouts.app-simple')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header  text-white bg-dark">Вхід у журнал</div>

                <div class="card-body">
                    <div class="card-body row">
                        <div class="col-4">
                            
                        </div>
                        <div class="col-8">
                            <h1>Ви виконали вхід в методичну базу ХПФК</h1>
                            <p>Вітаємо, {{Auth::user()->userable->fullname}}!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection