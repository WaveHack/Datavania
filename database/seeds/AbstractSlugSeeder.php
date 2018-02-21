<?php

use Illuminate\Database\Seeder;

abstract class AbstractSlugSeeder extends Seeder
{
    abstract protected function getModelClass(): string;

    abstract protected function getJsonDataPath(): string;

    public function run()
    {
        $modelFqcn = $this->getModelClass();
        $jsonDataPath = $this->getJSONDataPath();

        $data = json_decode(file_get_contents($jsonDataPath));

        $added = 0;
        $changed = 0;

        foreach ($data as $record) {
            $relations = [];

            if (isset($record->__relations)) {
                $relations = (array)$record->__relations;
                unset($record->__relations);
            }

            $instance = $modelFqcn::where('slug', $record->slug)->first();

            if (!$instance) {
                $instance = new $modelFqcn;
            }

            $instance->fill((array)$record);

            foreach ($relations as $relation) {
                if ($relation->slug === '##########') {
                    throw new RuntimeException("Entity with slug '{$record->slug}' needs {$relation->type} relation fixed");
                }

                $class = studly_case($relation->type);
                $fqcn = ('App\Models\\' . $class);
                $method = camel_case($relation->type);

                $relatedModel = $fqcn::where('slug', $relation->slug)->first();

                if (!$relatedModel) {
                    $modelClass = str_replace('App\Models\\', '', $modelFqcn);
                    $this->command->warn("{$class} '{$relation->slug}' not found for {$modelClass} '{$record->slug}'. Skipping");

                    continue;
                }

                $instance->$method()->associate($relatedModel);
            }

            $instance->save();

            if ($instance->wasRecentlyCreated) {
                $added++;
            }

            if ($instance->wasChanged()) {
                $changed++;
            }
        }

        if (($added > 0) || ($changed > 0)) {
            $className = last(explode('\\', strtolower($modelFqcn)));

            if ($added > 0) {
                $this->command->info($added . ' ' . str_plural($className, $added) . ' added');
            }

            if ($changed > 0) {
                $this->command->info($changed . ' ' . str_plural($className, $changed) . ' updated');
            }
        }
    }
}
