<?php

namespace App\Repositories;


use App\Repositories\GuzzleHttpRequest;
use Carbon\Carbon;

class Posts extends GuzzleHttpRequest{




    public function all(){

        //return $this->get('posts');
    }

    public function find($id){

        $params = array(
            'json_format' => 'true'
        );

        return $this->get('/v1/events_versions/'.$id, $params);
    }

    public function facilitator($id){

        $params = array(
            'json_format' => 'true'
        );
        return $this->get('/v1/facilitators/'.$id, $params);

    }

    public function allEvents($limit){


        // dd( Carbon::now()->format('Y-m-d'));
        $from = Carbon::now()->format('Y-m-d');
        $to = Carbon::now()->addYear()->format('Y-m-d'); // one year more

        $params = array(
            'sort' => 'events_start_date|desc',
            'limit' => $limit,
            // agencies_id:1 = Intras
            // events_types_id:1 = abiertos 2 = inhouse
            // is_deleted:0 = activo 1 borrados
            // (is_deleted:0,agencies_id:1,events_types_id:1,events_categories_id:2,events_versions_statuses_id:8)
            // events_versions_statuses_id:8 = eventos en progreso
            'q' => '(is_deleted:0,agencies_id:1,events_types_id:1,events_versions_statuses_id:8)',
            'rs' => 'eventsVersionsDates,eventsCategories,eventsClasses,files',
            // "rq[events_versions_dates]" => "(event_date>".$from.",event_date<".$to.")",
            'is_international' => 0
        );
        
        return $this->get('/v1/events_versions', $params);

    }

    public function lastEvents($limit, $from, $to, $sta = null, $sort = 'asc'){


        $params = array(
            'sort' => 'events_start_date|'.$sort,
            'limit' => $limit,
            // agencies_id:1 = Intras
            // events_types_id:1 = abiertos 2 = inhouse
            // is_deleted:0 = activo 1 borrados
            // events_versions_statuses_id:8 = eventos en progreso
            // events_classes_id:1 = seminarios
            'q' => '(is_deleted:0,agencies_id:1,events_types_id:1,events_versions_statuses_id:'.$sta.',events_classes_id:1)',
            'rs' => 'eventsVersionsDates,eventsCategories,eventsClasses,files',
            "rq[events_versions_dates]" => "(event_date>".$from.",event_date<".$to.")",
            // 'is_international' => 0,
            'json_format' => 'true'
        );
        
        return $this->get('/v1/events_versions', $params);

    }

    public function themes(){

        $params = array(
            'q' => '(is_deleted:0)',
            'json_format' => 'true'
        );
        
        return $this->get('/v1/themes', $params);
    }

    public function eventsByTheme($id){

        $from = Carbon::now()->format('Y-m-d');
        $to = Carbon::now()->addYear()->format('Y-m-d'); // one year more


            $params = array(
                'sort' => 'events_start_date|asc',
                'limit' => 100,
                // agencies_id:1 = Intras
                // events_types_id:1 = abiertos 2 = inhouse
                // is_deleted:0 = activo 1 borrados
                // events_versions_statuses_id:8 = eventos en progreso
                'q' => '(is_deleted:0,agencies_id:1,events_types_id:1,events_versions_statuses_id:8,themes_id:'.$id.')',
                'rs' => 'eventsVersionsDates,eventsCategories,eventsClasses,files',
                "rq[events_versions_dates]" => "(event_date>".$from.",event_date<".$to.")",
                'is_international' => 0,
                'json_format' => 'true'
            );
            
            return $this->get('/v1/events_versions', $params);
        }
        

    



    

}
