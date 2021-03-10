<?php

namespace Core;

use App\Models\DbModel;

abstract class UserModel extends DbModel
{
    abstract public function getDisplayName(): string;
}