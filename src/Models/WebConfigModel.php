<?php
namespace Tutu\WebConfig\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class WebConfigModel extends Model
{
    /**
     * Settings constructor.
     *
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        parent::__construct($attributes);

        $this->setConnection(config('admin.database.connection') ?: config('database.default'));

        $this->setTable(config('admin.extensions.web_config.table', 'admin_web_config'));
    }


    /**
     * get all config
     * @return array
     */
    public static function getAllConfig()
    {
        return self::select('name', 'value')->pluck('value', 'name')->toArray();
    }

    /**
     * get config value buy key
     * @param $key
     * @return mixed|string
     */
    public static function get_config_by_key($key)
    {
        $data = self::getAllConfig();
        if (array_key_exists($key, $data)) {
            return $data[$key];
        } else {
            return '';
        }
    }

    /**
     * edit value and desc buy key
     * @param $key
     * @param $value
     * @param $desc
     * @return mixed
     */
    public function set_value_by_key($key, $value, $desc)
    {
        $configData = self::getAllConfig();
        $data['value'] = $value;
        $data['description'] = $desc;
        if (array_key_exists($key, $configData)) {
            return self::where('name', $key)->update($data);
        } else {
            $data['name'] = $key;
            $data['updated_at'] = $data['created_at'] = Carbon::now();
            return self::insert($data);
        }
    }

    public static function getAllConfigHandleAfter()
    {
        $data = self::getAllConfig();
        $config_data = config('admin.web_config') ?? [];
        foreach ($config_data as $key => $item) {
            if (isset($data[$key]) && $item['type'] == 'image') {
                $data[$key]=Storage::disk('admin')->url($data[$key]);
            }
        }
        return $data;
    }
}
