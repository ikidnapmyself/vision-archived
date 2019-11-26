<?php

use Illuminate\Database\Seeder;

class VisionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DEFAULTS

        $defaults = [
//            'Vision Without Due Date'  => '{"condition":"AND","rules":[{"id":"assignees.user_id_string","field":"assignees.user_id","type":"string","input":"text","operator":"equal","value":"{{user.id}}"},{"id":"assignees.due","field":"assignees.due","type":"datetime","input":"text","operator":"is_null","value":null},{"condition":"OR","rules":[{"id":"assignees.defer","field":"assignees.defer","type":"datetime","input":"text","operator":"less_or_equal","value":"{{date.now}}"},{"id":"assignees.defer","field":"assignees.defer","type":"datetime","input":"text","operator":"is_null","value":null}]},{"id":"tasks.completed_at","field":"tasks.completed_at","type":"datetime","input":"text","operator":"is_null","value":null}],"valid":true}',
//            'Vision Calendar Incoming' => '{"condition":"AND","rules":[{"id":"assignees.user_id_string","field":"assignees.user_id","type":"string","input":"text","operator":"equal","value":"{{user.id}}"},{"condition":"AND","rules":[{"id":"assignees.due","field":"assignees.due","type":"datetime","input":"text","operator":"less_or_equal","value":"{{date.+2_months}}"},{"id":"assignees.due","field":"assignees.due","type":"datetime","input":"text","operator":"greater_or_equal","value":"{{date.first_day_of_this_month}}"},{"condition":"OR","rules":[{"id":"assignees.defer","field":"assignees.defer","type":"datetime","input":"text","operator":"less_or_equal","value":"{{date.now}}"},{"id":"assignees.defer","field":"assignees.defer","type":"datetime","input":"text","operator":"is_null","value":null}]}]},{"id":"tasks.completed_at","field":"tasks.completed_at","type":"datetime","input":"text","operator":"is_null","value":null}],"valid":true}',
//            'Vision My All Tasks'      => '{"condition":"AND","rules":[{"id":"assignees.user_id_string","field":"assignees.user_id","type":"string","input":"text","operator":"equal","value":"{{user.id}}"}],"valid":true}',
//            'Vision Assigned by Me'    => '{"condition":"AND","rules":[{"id":"assignees.assigned_by","field":"assignees.assigned_by","type":"string","input":"select","operator":"equal","value":"{{user.id}}"}],"valid":true}',
//            'Vision Today for Me'      => '{"condition":"AND","rules":[{"id":"assignees.user_id_string","field":"assignees.user_id","type":"string","input":"text","operator":"equal","value":"{{user.id}}"},{"id":"assignees.due","field":"assignees.due","type":"datetime","input":"text","operator":"equal","value":"{{date.today}}"}],"valid":true}',
//            'Vision This Week for Me'  => '{"condition":"AND","rules":[{"id":"assignees.user_id_string","field":"assignees.user_id","type":"string","input":"text","operator":"equal","value":"{{user.id}}"},{"id":"assignees.due","field":"assignees.due","type":"datetime","input":"text","operator":"between","value":["{{date.today}}","{{date.next_week}}"]}],"valid":true}',
//            'Vision My Over Due Date'  => '{"condition":"AND","rules":[{"id":"assignees.user_id_string","field":"assignees.user_id","type":"string","input":"text","operator":"equal","value":"{{user.id}}"},{"id":"assignees.due","field":"assignees.due","type":"datetime","input":"text","operator":"less","value":"{{date.today}}"}],"valid":true}',
//            'Vision My Daily Summary'  => '{"condition":"AND","rules":[{"condition":"AND","rules":[{"id":"assignees.user_id_string","field":"assignees.user_id","type":"string","input":"text","operator":"equal","value":"{{user.id}}"},{"condition":"OR","rules":[{"id":"assignees.due","field":"assignees.due","type":"datetime","input":"text","operator":"less_or_equal","value":"{{date.+2_days}}"},{"id":"assignees.due","field":"assignees.due","type":"datetime","input":"text","operator":"is_null","value":null}]},{"condition":"OR","rules":[{"id":"assignees.defer","field":"assignees.defer","type":"datetime","input":"text","operator":"less_or_equal","value":"{{datetime.now}}"},{"id":"assignees.defer","field":"assignees.defer","type":"datetime","input":"text","operator":"is_null","value":null}]}]}],"valid":true}',
        ];

        foreach ($defaults as $key => $item)
        {
            $vision = \App\Models\Vision::firstOrNew([
                'id'         => str_slug($key), // IF THIS
                'created_by' => null
            ],[
                'name'       => $key,           // THEN THAT
                'body'       => $item,
            ]);
            $vision->fill([
                'name'       => $key,
                'body'       => $item,
                'created_by' => null
            ])->save();
            $vision->id = str_slug($key);
            $vision->save();
        }
    }
}
