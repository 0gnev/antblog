<?php

namespace App\Views\form;

use Core\Model;

abstract class BaseField
{

    public Model $model;
    public string $attribute;
    public string $type;

    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString()
    {
        return sprintf('<div class="mb-3 py-1">
                <label class="form-label">%s</label>
                %s
                <div class="invalid-feedback">
                    %s
                </div>
            </div>',
            $this->model->getLabel($this->attribute),
            $this->renderInput(),
            $this->model->getFirstError($this->attribute)
        );
    }

    abstract public function renderInput();
}