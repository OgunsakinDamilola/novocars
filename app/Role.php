<?php
namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole{

    const
        ADMIN = 1,
        CUSTOMER = 2;
}