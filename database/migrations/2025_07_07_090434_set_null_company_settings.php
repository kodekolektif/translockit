<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $row = DB::table('settings')->where('group', 'company')->first();

        if (!$row || !isset($row->settings)) {
            return;
        }

        $data = json_decode($row->settings, true);

        $keysToCheck = [
            'phone',
            'email',
            'address',
            'google_map_url',
            'embed_google_url',
        ];

        $changed = false;

        foreach ($keysToCheck as $key) {
            if (array_key_exists($key, $data) && $data[$key] === '') {
                $data[$key] = null;
                $changed = true;
            }
        }

        if ($changed) {
            DB::table('settings')
                ->where('group', 'company')
                ->update(['settings' => json_encode($data)]);
        }
    }
     public function down(): void
    {
        //
    }


};
