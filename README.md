# learning_laravel_revisionable

Using Laravel_auditing package from: [Website](http://laravel-auditing.com/docs/5.0/installation)


## Errors

### OwenIt \ Auditing \ Exceptions \ AuditingException Invalid UserResolver implementation

Add resolver class: 

```
<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Contracts\UserResolver;

class User extends Model implements Auditable, UserResolver
{
    use \OwenIt\Auditing\Auditable;

    /**
     * {@inheritdoc}
     */
    public static function resolveId()
    {
        return Auth::check() ? Auth::user()->getAuthIdentifier() : null;
    }

    // ...
}
```
