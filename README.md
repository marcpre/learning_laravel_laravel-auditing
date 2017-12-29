# learning_laravel_revisionable

Using Laravel_auditing package from: [Website](http://laravel-auditing.com/docs/5.0/installation)


## Errors

### OwenIt \ Auditing \ Exceptions \ AuditingException Invalid UserResolver implementation

Add resolver class:(if also generated Auth with `php artisan make:auth`) 

```
<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Contracts\UserResolver;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements Auditable, UserResolver
{
    use \OwenIt\Auditing\Auditable;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    
    protected $auditInclude = [
        'name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public static function resolveId()
    {
        return Auth::check() ? Auth::user()->getAuthIdentifier() : null;
    }
}

```

### SQL Error: user_id

Change in audit migration to `users_id`.
