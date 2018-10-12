<?php

namespace App\Repositories;

use App\Models\Player;
use App\Models\Status;

/**
 *
 */

class CommandRepository
{
    public function statsYear()
    {
        // teams
        $json = file_get_contents('http://www.nhl.com/stats/rest/team?isAggregate=false&reportType=basic&isGame=false&reportName=teamsummary&cayenneExp=gameTypeId=2%20and%20seasonId%3E=20182019%20and%20seasonId%3C=20182019');

        $array = json_decode($json, true);
        $data = $array["data"];

        foreach($data as $val) {

            Player::where('nhl', $val['teamAbbrev'])
                ->where('position', 'T')
                ->update([
                    'games_played' => $val['gamesPlayed'],
                    'wins' => $val['wins'],
                    'losses' => $val['losses'],
                    'overtime_losses' => $val['otLosses'],
                    'goals_for' => $val['goalsFor'],
                    'goals_against' => $val['goalsAgainst']
                ]);
        };

        // skaters
        $json = file_get_contents('http://www.nhl.com/stats/rest/skaters?isAggregate=false&reportType=basic&isGame=false&reportName=skatersummary&cayenneExp=gameTypeId=2%20and%20seasonId%3E=20182019%20and%20seasonId%3C=20182019');
        $array = json_decode($json, true);
        $data = $array["data"];

        foreach($data as $val) {

            Player::where('last_name', $val['playerLastName'])
                ->where('birth_date', $val['playerBirthDate'])
                ->whereIn('position', ['C', 'L', 'R', 'D'])
                ->update([
                    'games_played' => $val['gamesPlayed'],
                    'goals' => $val['goals'],
                    'assists' => $val['assists'],
                    'shots' => $val['shots']
                ]);
        };

        $json = file_get_contents('http://www.nhl.com/stats/rest/skaters?isAggregate=false&reportType=basic&isGame=false&reportName=realtime&cayenneExp=gameTypeId=2%20and%20seasonId%3E=20182019%20and%20seasonId%3C=20182019');
        $array = json_decode($json, true);
        $data = $array["data"];

        foreach($data as $val) {

            Player::where('last_name', $val['playerLastName'])
                ->where('birth_date', $val['playerBirthDate'])
                ->whereIn('position', ['C', 'L', 'R', 'D'])
                ->update([
                    'faceoff_wins' => $val['faceoffsWon'],
                    'hits' => $val['hits']
                ]);
        };

        // goalies
        $json = file_get_contents('http://www.nhl.com/stats/rest/goalies?isAggregate=false&reportType=goalie_basic&isGame=false&reportName=goaliesummary&cayenneExp=gameTypeId=2%20and%20seasonId%3E=20182019%20and%20seasonId%3C=20182019');
        $array = json_decode($json, true);
        $data = $array["data"];

        foreach($data as $val) {

            Player::where('last_name', $val['playerLastName'])
                ->where('birth_date', $val['playerBirthDate'])
                ->where('position', 'G')
                ->update([
                    'games_played' => $val['gamesPlayed'],
                    'wins' => $val['wins'],
                    'losses' => $val['losses'],
                    'overtime_losses' => $val['otLosses'],
                    'goals_against_average' => $val['goalsAgainstAverage'],
                    'save_percentage' => $val['savePctg'],
                    'saves' => $val['saves']
                ]);
        };
    }

    public function statsMatchup($matchup, $start, $end)
    {
        // teams
        $json = file_get_contents('http://www.nhl.com/stats/rest/team?isAggregate=true&reportType=basic&isGame=true&reportName=teamsummary&cayenneExp=gameDate%3E=%22'. $start .'%22%20and%20gameDate%3C=%22'. $end .'%22%20and%20gameTypeId=2');

        $array = json_decode($json, true);
        $data = $array["data"];

        foreach($data as $val) {

            Player::join('stats_weeks', 'players.id', '=', 'stats_weeks.player_id')
                ->where('players.nhl', $val['teamAbbrev'])
                ->where('players.position', 'T')
                ->where('stats_weeks.week_id', $matchup)
                ->update([
                    'stats_weeks.games_played' => $val['gamesPlayed'],
                    'stats_weeks.wins' => $val['wins'],
                    'stats_weeks.losses' => $val['losses'],
                    'stats_weeks.overtime_losses' => $val['otLosses'],
                    'stats_weeks.goals_for' => $val['goalsFor'],
                    'stats_weeks.goals_against' => $val['goalsAgainst']
                ]);
        };

        // skaters
        $json = file_get_contents('http://www.nhl.com/stats/rest/skaters?isAggregate=true&reportType=basic&isGame=true&reportName=skatersummary&cayenneExp=gameDate%3E=%22'. $start .'%22%20and%20gameDate%3C=%22'. $end .'%22%20and%20gameTypeId=2');

        $array = json_decode($json, true);
        $data = $array["data"];

        foreach($data as $val) {

            Player::join('stats_weeks', 'players.id', '=', 'stats_weeks.player_id')
                ->where('players.last_name', $val['playerLastName'])
                ->where('players.birth_date', $val['playerBirthDate'])
                ->whereIn('players.position', ['C', 'L', 'R', 'D'])
                ->where('stats_weeks.week_id', $matchup)
                ->update([
                    'stats_weeks.games_played' => $val['gamesPlayed'],
                    'stats_weeks.goals' => $val['goals'],
                    'stats_weeks.assists' => $val['assists'],
                    'stats_weeks.shots' => $val['shots']
                ]);
        };

        $json = file_get_contents('http://www.nhl.com/stats/rest/skaters?isAggregate=true&reportType=basic&isGame=true&reportName=realtime&cayenneExp=gameDate%3E=%22'. $start .'%22%20and%20gameDate%3C=%22'. $end .'%22%20and%20gameTypeId=2');

        $array = json_decode($json, true);
        $data = $array["data"];

        foreach($data as $val) {

            Player::join('stats_weeks', 'players.id', '=', 'stats_weeks.player_id')
                ->where('players.last_name', $val['playerLastName'])
                ->where('players.birth_date', $val['playerBirthDate'])
                ->whereIn('players.position', ['C', 'L', 'R', 'D'])
                ->where('stats_weeks.week_id', $matchup)
                ->update([
                    'stats_weeks.faceoff_wins' => $val['faceoffsWon'],
                    'stats_weeks.hits' => $val['hits']
                ]);
        };

        // goalies
        $json = file_get_contents('http://www.nhl.com/stats/rest/goalies?isAggregate=true&reportType=goalie_basic&isGame=true&reportName=goaliesummary&cayenneExp=gameDate%3E=%22'. $start .'%22%20and%20gameDate%3C=%22'. $end .'%22%20and%20gameTypeId=2');

        $array = json_decode($json, true);
        $data = $array["data"];

        foreach($data as $val) {

            Player::join('stats_weeks', 'players.id', '=', 'stats_weeks.player_id')
                ->where('players.last_name', $val['playerLastName'])
                ->where('players.birth_date', $val['playerBirthDate'])
                ->where('players.position', 'G')
                ->where('stats_weeks.week_id', $matchup)
                ->update([
                    'stats_weeks.games_played' => $val['gamesPlayed'],
                    'stats_weeks.wins' => $val['wins'],
                    'stats_weeks.losses' => $val['losses'],
                    'stats_weeks.overtime_losses' => $val['otLosses'],
                    'stats_weeks.saves' => $val['saves'],
                    'stats_weeks.goals_against' => $val['goalsAgainst'],
                    'stats_weeks.time_on_ice' => $val['timeOnIce']
                ]);
        };
    }

    public function injury()
    {
        Player::where('injury_status', '!=', 'n')
            ->update([
                'injury_status' => 'n'
            ]);

        $json = file_get_contents('https://www.rotowire.com/hockey/tables/injury-report.php?team=ALL&pos=ALL');

        $data = json_decode($json, true);

        foreach($data as $val) {

            if ($val['status'] != 'Day-To-Day' && $val['injury'] != 'Suspension' && $val['injury'] != 'Contract Dispute') {
                Player::where('first_name', $val['firstname'])
                    ->where('last_name', $val['lastname'])
                    ->update([
                        'injury_status' => 'inj',
                    ]);
            }

            if ($val['status'] === 'Day-To-Day') {
                Player::where('first_name', $val['firstname'])
                    ->where('last_name', $val['lastname'])
                    ->update([
                        'injury_status' => 'dtd',
                    ]);
            }
        };
    }

    public function day()
    {
        $day = Status::where('name', 'day')->pluck('value')->first();

        if ($day === 7) {
            return Status::where('name', 'day')
                ->update([
                    'value' => 1
                ]);
        }

        Status::where('name', 'day')
            ->update([
                'value' => $day + 1
            ]);
    }
}
