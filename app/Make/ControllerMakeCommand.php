<?php

namespace App\Make;

use Illuminate\Routing\Console\ControllerMakeCommand as BaseMakeCommand;

class ControllerMakeCommand extends BaseMakeCommand
{
    protected function buildModelReplacements(array $replace)
    {
        $modelClass = $this->parseModel($this->option('model'));

        if (! class_exists($modelClass)) {
            if ($this->confirm("A {$modelClass} model does not exist. Do you want to generate it?", true)) {
                $this->call('make:model', ['name' => $modelClass]);
            }
        }

        return array_merge($replace, [
            'DummyFullModelClass' => $modelClass,
            '{{ namespacedModel }}' => $modelClass,
            '{{namespacedModel}}' => $modelClass,
            'DummyModelClass' => class_basename($modelClass),
            '{{ model }}' => class_basename($modelClass),
            '{{model}}' => class_basename($modelClass),
            'dummyModelVariable' => lcfirst(class_basename($modelClass)),
            '{{ modelVariable }}' => lcfirst(class_basename($modelClass)),
            '{{modelVariable}}' => lcfirst(class_basename($modelClass)),
            '{{pluralVariable}}' => lcfirst(str_plural(class_basename($modelClass))),
            '{{ pluralVariable }}' => lcfirst(str_plural(class_basename($modelClass))),
            'dummyPluralVariable' => lcfirst(str_plural(class_basename($modelClass))),
            'DummyModelTitle' => ucfirst(str_replace('_', ' ', snake_case(class_basename($modelClass)))),
            '{{modelTitle}}' => ucfirst(str_replace('_', ' ', snake_case(class_basename($modelClass)))),
            '{{ modelTitle }}' => ucfirst(str_replace('_', ' ', snake_case(class_basename($modelClass)))),

        ]);
    }

}
