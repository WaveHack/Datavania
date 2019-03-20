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
            $this->syncData('dlcs');
            $this->syncData('item-types');
            $this->syncData('achievements');

//            $this->syncChapters();
//            $this->syncCharacters();
//            $this->syncItems();
//            $this->syncMusic();
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
