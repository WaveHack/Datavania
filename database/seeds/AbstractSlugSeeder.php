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
            $instance = $modelClass::updateOrCreate(['slug' => $record->slug], (array)$record);

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
