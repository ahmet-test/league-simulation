@extends('layouts.master')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="fixture-list"></div>
            </div>
        </div>

        <script>
            function stageEvent() {
                $.ajax({
                    url: "ajax/list",
                    context: document.body
                }).done(function (data) {
                    $(".fixture-list").html(data);
                });
            }
            stageEvent();
        </script>

@endsection
