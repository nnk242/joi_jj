<?php

namespace App\View;

use App\Views;

class topView
{
    public function topView7($id, $view_old, $view_new)
    {
        $view = Views::wheregroup_id($id)->first();
        if (isset($view)) {

            $time_db_now = strtotime(date('Y-m-d', strtotime($view->updated_at)));
            $time_now = strtotime(date('Y-m-d', time()));
            if ($time_db_now == $time_now) {
                $add_view = $view->today;
                $view->today = $add_view + 1;
                $view->save();
            } else {
                $timeday = 3600 * 24;
                $time_old = $time_now - $time_db_now;
                $day = $time_old / $timeday;
                switch ($day) {
                    case 1:
                        $day_2 = $view->today;
                        $day_3 = $view->day_2;
                        $day_4 = $view->day_3;
                        $day_5 = $view->day_4;
                        $day_6 = $view->day_5;
                        $day_7 = $view->day_6;
                        $day_8 = $view->day_7;
                        $view->today = 1;
                        $view->day_2 = $day_2;
                        $view->day_3 = $day_3;
                        $view->day_4 = $day_4;
                        $view->day_5 = $day_5;
                        $view->day_6 = $day_6;
                        $view->day_7 = $day_7;
                        $view->day_8 = $day_8;
                        $view->total = (int)$day_2 + (int)$day_3 + (int)$day_4 + (int)$day_5 + (int)$day_6 + (int)$day_7 + (int)$day_8;
                        $view->save();
                        break;
                    case 2:
                        $day_3 = $view->today;
                        $day_4 = $view->day_2;
                        $day_5 = $view->day_3;
                        $day_6 = $view->day_4;
                        $day_7 = $view->day_5;
                        $day_8 = $view->day_6;
                        $view->today = 1;
                        $view->day_2 = 0;
                        $view->day_3 = $day_3;
                        $view->day_4 = $day_4;
                        $view->day_5 = $day_5;
                        $view->day_6 = $day_6;
                        $view->day_7 = $day_7;
                        $view->day_8 = $day_8;
                        $view->total = (int)$day_3 + (int)$day_4 + (int)$day_5 + (int)$day_6 + (int)$day_7 + (int)$day_8;
                        $view->save();
                        break;
                    case 3:
                        $day_4 = $view->today;
                        $day_5 = $view->day_2;
                        $day_6 = $view->day_3;
                        $day_7 = $view->day_4;
                        $day_8 = $view->day_5;
                        $view->today = 1;
                        $view->day_2 = 0;
                        $view->day_3 = 0;
                        $view->day_4 = $day_4;
                        $view->day_5 = $day_5;
                        $view->day_6 = $day_6;
                        $view->day_7 = $day_7;
                        $view->day_8 = $day_8;
                        $view->save();
                        break;
                    case 4:
                        $day_5 = $view->today;
                        $day_6 = $view->day_2;
                        $day_7 = $view->day_3;
                        $day_8 = $view->day_4;
                        $view->today = 1;
                        $view->day_2 = 0;
                        $view->day_3 = 0;
                        $view->day_4 = 0;
                        $view->day_5 = $day_5;
                        $view->day_6 = $day_6;
                        $view->day_7 = $day_7;
                        $view->day_8 = $day_8;
                        $view->total = (int)$day_5 + (int)$day_6 + (int)$day_7 + (int)$day_8;
                        $view->save();
                        break;
                    case 5:
                        $day_6 = $view->today;
                        $day_7 = $view->day_2;
                        $day_8 = $view->day_3;
                        $view->today = 1;
                        $view->day_2 = 0;
                        $view->day_3 = 0;
                        $view->day_4 = 0;
                        $view->day_5 = 0;
                        $view->day_6 = $day_6;
                        $view->day_7 = $day_7;
                        $view->day_8 = $day_8;
                        $view->total = (int)$day_6 + (int)$day_7 + (int)$day_8;
                        $view->save();
                        break;
                    case 6:
                        $day_7 = $view->today;
                        $day_8 = $view->day_2;
                        $view->today = 1;
                        $view->day_2 = 0;
                        $view->day_3 = 0;
                        $view->day_4 = 0;
                        $view->day_5 = 0;
                        $view->day_6 = 0;
                        $view->day_7 = $day_7;
                        $view->day_8 = $day_8;
                        $view->total = (int)$day_7 + (int)$day_8;
                        $view->save();
                        break;
                    case 7:
                        $day_8 = $view->today;
                        $view->today = 1;
                        $view->day_2 = 0;
                        $view->day_3 = 0;
                        $view->day_4 = 0;
                        $view->day_5 = 0;
                        $view->day_6 = 0;
                        $view->day_7 = 0;
                        $view->day_8 = $day_8;
                        $view->total = (int)$day_8;
                        $view->save();
                        break;
                    default:
                        $view->today = 1;
                        $view->day_2 = 0;
                        $view->day_3 = 0;
                        $view->day_4 = 0;
                        $view->day_5 = 0;
                        $view->day_6 = 0;
                        $view->day_7 = 0;
                        $view->day_8 = 0;
                        $view->total = 0;
                        $view->save();
                }
            }
        } else {
            $view = new Views();
            $view->today = $view_new - $view_old;
            $view->total = $view->today;
            $view->group_id = $id;
            $view->save();
        }

    }
}