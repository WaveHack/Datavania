<?php

use Illuminate\Database\Seeder;

abstract class AbstractSlugSeeder extends Seeder
{
    abstract protected function getModelClass(): string;

    abstract protected function getJsonDataPath(): string;

    public function run()
    {
        $modelClass = $this->getModelClass();
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

            $instance = $modelClass::where('slug', $record->slug)->first();

            if (!$instance) {
                $instance = new $modelClass;
            }

            $instance->fill((array)$record);

            foreach ($relations as $relation) {
                if ($relation->slug === '##########') {
                    throw new RuntimeException("Entity with slug '{$record->slug}' needs {$relation->type} relation fixed");
                }

                $class = studly_case($relation->type);
                $fqcn = ('App\Models\\' . $class);
                $method = camel_case($relation->type);

                $instance->$method()->associate(
                    $fqcn::where('slug', $relation->slug)->firstOrFail()
                );
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
            $className = last(explode('\\', strtolower($modelClass)));

            if ($added > 0) {
                $this->command->info($added . ' ' . str_plural($className, $added) . ' added');
            }

            if ($changed > 0) {
                $this->command->info($changed . ' ' . str_plural($className, $changed) . ' updated');
            }
        }
    }
}
