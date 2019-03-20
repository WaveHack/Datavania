<?php

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;
use LogicException;
use Str;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

class SyncDataCommand extends Command
{
    protected $signature = 'app:sync-data';

    protected $description = 'Synchronizes the CSV data to the database';

    /**
     * @throws Throwable
     */
    public function handle(): void
    {
        DB::transaction(function () {
            $this->syncData('achievements');
            $this->syncData('dlcs');
            $this->syncData('item-types');

            $this->syncData('characters', ['dlc']);
            $this->syncData('music', ['dlc']);

//            $this->syncData('chapters', [
//                'stage_music' => 'music',
//                'boss_music' => 'music',
//                'boss2_music' => 'music',
//                'dlc',
//            ]);

//            $this->syncData('items', ['dlc']);
//            $this->syncData('monsters', [
//                'item1' => 'item',
//                'item2' => 'item',
//                'soul' => 'item',
//                'dlc',
//            ]);
        });

        $this->info('Done');
    }

    protected function syncData(string $type, array $relations = []): void
    {
        $csvFilePath = resource_path("data/{$type}.csv");

        if (!file_exists($csvFilePath)) {
            throw new LogicException("{$csvFilePath} not found");
        }

        $this->info("Syncing {$type}", OutputInterface::VERBOSITY_VERBOSE);

        $typeSingular = Str::singular($type);
        $modelClass = implode('', array_map('ucfirst', explode('-', $typeSingular)));
        $modelFqcn = "App\\Models\\{$modelClass}";

        $relationFields = [];
        $relationFqcns = [];

        foreach ($relations as $relationField => $relationType) {
            if (is_int($relationField)) {
                $relationField = $relationType;
            }

            $column = "{$relationField}_id";
            $relationFields[$relationField] = $column;

            $relationClass = ucfirst($relationType);
            $relationFqcn = "App\\Models\\{$relationClass}";

            $relationFqcns[$relationField] = $relationFqcn;
        }

        $fp = fopen($csvFilePath, 'rb');

        $headers = fgetcsv($fp);

        $entitiesCreated = 0;
        $entitiesUpdated = 0;
        $idsToKeep = [];

        while (($row = fgetcsv($fp)) !== false) {
            $modelData = array_combine($headers, $row);
            $slug = Str::slug($modelData['name']);

            $modelInstance = $modelFqcn::firstOrNew([
                'slug' => $slug,
            ]);

            foreach ($relationFields as $field => $column) {
                $relationData = $modelData[$field] ?: null;

                if ($relationData !== null) {
                    // find related object

                    $relationModel = $relationFqcns[$field]::where('name', $relationData)
                        ->firstOrFail();

                    $relationData = (int)$relationModel->id;
                }

                unset($modelData[$field]);
                $modelData[$column] = $relationData;
            }

            $modelInstance->fill($modelData);

            if ($modelInstance->exists && $modelInstance->isDirty()) {
                $this->line("Updating {$typeSingular}: {$modelData['name']}", null, OutputInterface::VERBOSITY_VERY_VERBOSE);

                $entitiesUpdated++;
            }

            $modelInstance->save();
            $idsToKeep[] = $modelInstance->id;

            if ($modelInstance->wasRecentlyCreated) {
                $this->line("Creating {$typeSingular}: {$modelData['name']}", null, OutputInterface::VERBOSITY_VERY_VERBOSE);

                $entitiesCreated++;
            }
        }

        fclose($fp);

        $entitiesDeleted = $modelFqcn::whereNotIn('id', $idsToKeep)
            ->delete();

        if (($entitiesCreated !== 0) || ($entitiesUpdated !== 0) || ($entitiesDeleted !== 0)) {
            $this->info(
                ucfirst($type) . ': ' .
                rtrim(
                    (($entitiesCreated !== 0) ? "{$entitiesCreated} created, " : null) .
                    (($entitiesUpdated !== 0) ? "{$entitiesUpdated} updated, " : null) .
                    (($entitiesDeleted !== 0) ? "{$entitiesDeleted} deleted, " : null)
                    , ', ')
                , OutputInterface::VERBOSITY_VERBOSE
            );
        }
    }
}
