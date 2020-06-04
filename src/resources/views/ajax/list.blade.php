@extends('layouts.master')

@section('content')
    @if ($teams === [])
        <button class="btn btn-success" id="launchGame">Launch Game</button>
    @else
        @if ($nextMatch === null)
            <button class="btn btn-info" id="launchGame">New Game</button>
        @endif
        <div class="row">
            <div class="col-md-6">
                <h2>League Table</h2>
                <table style="width:100%" border="1px">
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
                            <td>{{ $team['name'] }}</td>
                            <td>{{ $team['status']['points'] }}</td>
                            <td>{{ $team['status']['played'] }}</td>
                            <td>{{ $team['status']['won'] }}</td>
                            <td>{{ $team['status']['drawn'] }}</td>
                            <td>{{ $team['status']['lost'] }}</td>
                            <td>{{ $team['status']['goal_difference'] }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            @if ($nextMatch !== null)
                <div class="col-md-6">
                    <h2>Next Match</h2>
                    <h3>{{ $nextMatch->week }}th week</h3>
                    <table border="1px">
                        <tr>
                            <th>Home</th>
                            <th>Away</th>
                        </tr>
                        <tr>
                            <td class="home-team">
                                <span id="homeScore"
                                      style="display: none; padding: 2px;border: 1px #4a4a4a solid;border-radius: 5px;">0</span>
                                {{ $teams[$nextMatch->home_team]['name'] }}
                            </td>

                            <td class="away-team">
                                <span id="awayScore"
                                      style="display: none; padding: 2px;border: 1px #4a4a4a solid;border-radius: 5px;">0</span>
                                {{ $teams[$nextMatch->away_team]['name'] }}
                            </td>
                        </tr>
                    </table>
                    <button class="btn btn-success" id="playMatchBtn">Play Match</button>
                </div>
            @endif
        </div>
    @endif
@endsection

<script>
    $("#playMatchBtn").click(function (e) {
        $(this).hide();
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "/ajax/play-next-match",
            data: {},
            success: function (data) {
                console.log(data['result']);
                if (data['result'] == 0) {
                    $(".home-team").addClass('bg-secondary');
                    $(".away-team").addClass('bg-secondary');
                } else if (data['result'] == 1) {
                    $(".home-team").addClass('bg-success');
                } else {
                    $(".away-team").addClass('bg-success');
                }

                $("#awayScore").show();
                $("#homeScore").show();
                $("#homeScore").html(data['homeTeamGoal']);
                $("#awayScore").html(data['awayTeamGoal']);

                setTimeout(() => {
                    stageEvent();
                }, 600);
            },
            error: function (result) {
                alert('error');
            }
        });
    });

    $("#launchGame").click(function (e) {
        $.ajax({
            type: "GET",
            url: "/ajax/launch-game",
            data: {},
            success: function (result) {
                stageEvent();
            },
            error: function (result) {
                alert('error');
            }
        });
    })
</script>
