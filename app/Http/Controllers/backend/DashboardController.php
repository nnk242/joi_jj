<?php

namespace App\Http\Controllers\backend;

use App\Images;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Views;
use DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function sumArray($arr){
        $result = 0;
        for ($i =0; $i <count($arr); $i++) {
            foreach ($arr[$i] as $id => $val) {
                $result += $arr[$i][$id];
            }
        }
        return $result;
    }

    public function index()
    {
//        $today = Views::all()
//            ->groupBy(function($item){ return $item->updated_at->format('d-M-y'); });
        $views = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) + (3600 * 24))],
                ['updated_at', '>=', date('Y-m-d', strtotime(date("Y-m-d")) - (7 * 3600 * 24))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('total');
        });

        //today
//        for($i = 1; $i<=8; $i++) {
//            $day1[] = Views::where(function ($q) {
//                $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) + (3600 * 24))],
//                    ['updated_at', '>=', date('Y-m-d', strtotime(date("Y-m-d")))]
//                ])
//                    ->orWhereNull('updated_at');
//            })->get()->groupBy(function ($item) {
//                return $item->updated_at->format('d-m-y');
//            })->map(function ($row) {
//                return $row->sum('today');
//            });
//        }
//day1
        $day1[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) + (3600 * 24))],
                ['updated_at', '>=', date('Y-m-d', strtotime(date("Y-m-d")))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('today');
        });
        //end day 1
        //day2
        $day2[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")))],
                ['updated_at', '>=', date("Y-m-d", strtotime(date("Y-m-d")) - (3600 * 24))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('today');
        });
        $day2[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) + (3600 * 24))],
                ['updated_at', '>=', date('Y-m-d', strtotime(date("Y-m-d")))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('day_2');
        });
        //end day 2
        //day 3
        $day3[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")))],
                ['updated_at', '>=', date("Y-m-d", strtotime(date("Y-m-d")) - (3600 * 24))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('day_2');
        });
        $day3[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) + (3600 * 24))],
                ['updated_at', '>=', date('Y-m-d', strtotime(date("Y-m-d")))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('day_3');
        });

        $day3[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) - (3600 * 24))],
                ['updated_at', '>=', date("Y-m-d", strtotime(date("Y-m-d")) - (2 * 3600 * 24))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('today');
        });
        //end day 3
        //day 4
        $day4[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) + (3600 * 24))],
                ['updated_at', '>=', date('Y-m-d', strtotime(date("Y-m-d")))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('day_4');
        });

        $day4[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")))],
                ['updated_at', '>=', date("Y-m-d", strtotime(date("Y-m-d")) - (3600 * 24))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('day_3');
        });

        $day4[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) - (3600 * 24))],
                ['updated_at', '>=', date("Y-m-d", strtotime(date("Y-m-d")) - (2 * 3600 * 24))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('day_2');
        });

        $day4[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) - (2 * 3600 * 24))],
                ['updated_at', '>=', date("Y-m-d", strtotime(date("Y-m-d")) - (3 * 3600 * 24))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('today');
        });
        //end day 4
        //day 5
        $day5[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) + (3600 * 24))],
                ['updated_at', '>=', date('Y-m-d', strtotime(date("Y-m-d")))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('day_5');
        });

        $day5[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")))],
                ['updated_at', '>=', date("Y-m-d", strtotime(date("Y-m-d")) - (3600 * 24))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('day_4');
        });

        $day5[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) - (3600 * 24))],
                ['updated_at', '>=', date("Y-m-d", strtotime(date("Y-m-d")) - (2 * 3600 * 24))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('day_3');
        });

        $day5[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) - (2 * 3600 * 24))],
                ['updated_at', '>=', date("Y-m-d", strtotime(date("Y-m-d")) - (3 * 3600 * 24))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('day_2');
        });

        $day5[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) - (3 * 3600 * 24))],
                ['updated_at', '>=', date("Y-m-d", strtotime(date("Y-m-d")) - (4 * 3600 * 24))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('today');
        });
        //end day 5
        //day 6
        $day6[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) + (3600 * 24))],
                ['updated_at', '>=', date('Y-m-d', strtotime(date("Y-m-d")))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('day_6');
        });

        $day6[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")))],
                ['updated_at', '>=', date("Y-m-d", strtotime(date("Y-m-d")) - (3600 * 24))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('day_5');
        });

        $day6[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) - (3600 * 24))],
                ['updated_at', '>=', date("Y-m-d", strtotime(date("Y-m-d")) - (2 * 3600 * 24))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('day_4');
        });

        $day6[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) - (2 * 3600 * 24))],
                ['updated_at', '>=', date("Y-m-d", strtotime(date("Y-m-d")) - (3 * 3600 * 24))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('day_3');
        });

        $day6[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) - (3 * 3600 * 24))],
                ['updated_at', '>=', date("Y-m-d", strtotime(date("Y-m-d")) - (4 * 3600 * 24))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('day_2');
        });

        $day6[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) - (4 * 3600 * 24))],
                ['updated_at', '>=', date("Y-m-d", strtotime(date("Y-m-d")) - (5 * 3600 * 24))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('today');
        });
        //end day 6
        //day 7
        $day7[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) + (3600 * 24))],
                ['updated_at', '>=', date('Y-m-d', strtotime(date("Y-m-d")))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('day_7');
        });

        $day7[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")))],
                ['updated_at', '>=', date("Y-m-d", strtotime(date("Y-m-d")) - (3600 * 24))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('day_6');
        });

        $day7[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) - (3600 * 24))],
                ['updated_at', '>=', date("Y-m-d", strtotime(date("Y-m-d")) - (2 * 3600 * 24))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('day_5');
        });

        $day7[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) - (2 * 3600 * 24))],
                ['updated_at', '>=', date("Y-m-d", strtotime(date("Y-m-d")) - (3 * 3600 * 24))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('day_4');
        });

        $day7[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) - (3 * 3600 * 24))],
                ['updated_at', '>=', date("Y-m-d", strtotime(date("Y-m-d")) - (4 * 3600 * 24))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('day_3');
        });

        $day7[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) - (4 * 3600 * 24))],
                ['updated_at', '>=', date("Y-m-d", strtotime(date("Y-m-d")) - (5 * 3600 * 24))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('day_2');
        });

        $day7[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) - (5 * 3600 * 24))],
                ['updated_at', '>=', date("Y-m-d", strtotime(date("Y-m-d")) - (6 * 3600 * 24))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('today');
        });
        //end day 7
        //day 8
        $day8[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) + (3600 * 24))],
                ['updated_at', '>=', date('Y-m-d', strtotime(date("Y-m-d")))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('day_8');
        });

        $day8[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")))],
                ['updated_at', '>=', date("Y-m-d", strtotime(date("Y-m-d")) - (3600 * 24))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('day_7');
        });

        $day8[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) - (3600 * 24))],
                ['updated_at', '>=', date("Y-m-d", strtotime(date("Y-m-d")) - (2 * 3600 * 24))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('day_6');
        });

        $day8[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) - (2 * 3600 * 24))],
                ['updated_at', '>=', date("Y-m-d", strtotime(date("Y-m-d")) - (3 * 3600 * 24))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('day_5');
        });

        $day8[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) - (3 * 3600 * 24))],
                ['updated_at', '>=', date("Y-m-d", strtotime(date("Y-m-d")) - (4 * 3600 * 24))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('day_4');
        });

        $day8[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) - (4 * 3600 * 24))],
                ['updated_at', '>=', date("Y-m-d", strtotime(date("Y-m-d")) - (5 * 3600 * 24))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('day_3');
        });

        $day8[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) - (5 * 3600 * 24))],
                ['updated_at', '>=', date("Y-m-d", strtotime(date("Y-m-d")) - (6 * 3600 * 24))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('day_2');
        });

        $day8[] = Views::where(function ($q) {
            $q->where([['updated_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) - (6 * 3600 * 24))],
                ['updated_at', '>=', date("Y-m-d", strtotime(date("Y-m-d")) - (7 * 3600 * 24))]
            ])
                ->orWhereNull('updated_at');
        })->get()->groupBy(function ($item) {
            return $item->updated_at->format('d-m-y');
        })->map(function ($row) {
            return $row->sum('today');
        });

//end day 8

        $views = array();
        $days = array();

        $views = array($this->sumArray($day1), $this->sumArray($day2), $this->sumArray($day3),
            $this->sumArray($day4), $this->sumArray($day5), $this->sumArray($day6), $this->sumArray($day7),
            $this->sumArray($day8));

        $pictures = Images::where(function ($q) {
            $q->where([['created_at', '<=', date("Y-m-d", strtotime(date("Y-m-d")) + (3600 * 24))],
                ['created_at', '>=', date("Y-m-d", strtotime(date("Y-m-d")) - (7 * 3600 * 24))]
            ])
                ->orWhereNull('created_at');
        })->get()->groupBy(function ($item) {
            return $item->created_at->format('d-m-y');
        })->map(function ($row) {
            return $row->count('created_at');
        });

        for ($i =0; $i <8;$i++) {
            if(!isset($pictures[date("d-m-y", strtotime(date("Y-m-d")) - ($i * 3600 * 24))])) {
                $pictures[date("d-m-y", strtotime(date("Y-m-d")) - ($i * 3600 * 24))] = 0;
            }
        }


        $days = array(date("d-m-y", strtotime(date("Y-m-d")) - (0 * 3600 * 24)),
            date("d-m-y", strtotime(date("Y-m-d")) - (1 * 3600 * 24)),
            date("d-m-y", strtotime(date("Y-m-d")) - (2 * 3600 * 24)),
            date("d-m-y", strtotime(date("Y-m-d")) - (3 * 3600 * 24)),
            date("d-m-y", strtotime(date("Y-m-d")) - (4 * 3600 * 24)),
            date("d-m-y", strtotime(date("Y-m-d")) - (5 * 3600 * 24)),
            date("d-m-y", strtotime(date("Y-m-d")) - (6 * 3600 * 24)),
            date("d-m-y", strtotime(date("Y-m-d")) - (7 * 3600 * 24)));

        return view('backends.dashboard.index', compact('days', 'views', 'pictures'));
    }
}
