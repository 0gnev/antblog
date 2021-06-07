<?php

namespace Core;

use Core\db\DbModel;

abstract class ArticleModel extends DbModel
{
    abstract public function getDisplayName(): string;
}