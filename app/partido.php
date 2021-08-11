<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class partido extends Model
{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'partidos';



	public function candidatos() {
		return $this->hasOne('App\candidatos');
	}

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'numero', 'logo','estado'
    ];

    public static function activas(){
        return self::where('estado',1);
    }

}
