@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <table style="width:100%" border="1">
                <caption style="font-weight: bold">League Table</caption>
                <tr>
                    <th>Teams</th>
                    <th>PTS</th>
                    <th>P</th>
                    <th>W</th>
                    <th>D</th>
                    <th>L</th>
                    <th>GD</th>
                </tr>
                @foreach($teams as $team)
                    <tr>
                        <td>{{ $team->name }}</td>
                        <td>{{ $team->status->points }}</td>
                        <td>{{ $team->status->played }}</td>
                        <td>{{ $team->status->won }}</td>
                        <td>{{ $team->status->drawn }}</td>
                        <td>{{ $team->status->lost }}</td>
                        <td>{{ $team->status->goal_difference }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="col-md-6">

        </div>
    </div>

@endsection
