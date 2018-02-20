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

        $changed = 0;

        foreach ($data as $record) {
            $instance = $modelClass::updateOrCreate(['slug' => $record->slug], (array)$record);

            if ($instance->wasChanged()) {
                $changed++;
            }
        }

        if ($changed > 0) {
            $className = last(explode('\\', strtolower($modelClass)));
            $this->command->info($changed . ' ' . str_plural($className, $changed) . ' updated');
        }
    }
}
