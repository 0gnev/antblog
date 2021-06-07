<?php

namespace Core;

use Core\db\DbModel;

abstract class CommentModel extends DbModel
{
    abstract public function getDisplayName(): string;
}