<?php

namespace App\Constants;

class Common
{
    const MAX_REQUEST_PER_MINUTE = 120;

    # Http methods
    const GET_METHOD = 'get';
    const POST_METHOD = 'post';
    const PATCH_METHOD = 'patch';
    const DELETE_METHOD = 'delete';

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;

    const NULL = null;

    const FALSE = false;

    const SPACE = "";

    const ACTIVE = 1;

    const DELETE = 2;

    const PAGINATE_BE = 10;

    const PAGINATE_FE = 12;

    const UNSET_CONDITION = "page";

    const UNSET = [
        null,
        false,
        ""
    ];

    const PAGINATE_HOME = 5;

    const GUARD_ADMIN = "admin";

    const PAGINATE_BANNER = 10;

    const PRICE = 100;
}
