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
            $this->syncDLCs();
//            $this->syncItemTypes();
//
//            $this->syncAchievements();
//            $this->syncChapters();
//            $this->syncCharacters();
//            $this->syncItems();
//            $this->syncMusic();
        });

        $this->info('Done');
    }

    protected function syncDLCs(): void
    {
        $this->syncData('dlcs');
    }

    protected function syncData(string $type, array $relations = []): void
    {
        $csvFilePath = resource_path("data/{$type}.csv");

        if (!file_exists($csvFilePath)) {
            throw new LogicException("{$csvFilePath} not found");
        }

        $this->info("Syncing {$type}", OutputInterface::VERBOSITY_VERBOSE);

        $typeSingular = Str::singular($type);
        $modelClass = ucfirst($typeSingular);
        $modelFqcn = "App\\Models\\{$modelClass}";

        $fp = fopen($csvFilePath, 'rb');

        $headers = fgetcsv($fp);

        $entitiesCreated = 0;
        $entitiesUpdated = 0;

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

            if ($modelInstance->wasRecentlyCreated) {
                $this->line("Creating {$typeSingular}: {$modelData['name']}", null, OutputInterface::VERBOSITY_VERY_VERBOSE);

                $entitiesCreated++;
            }
        }

        fclose($fp);

        $infoStringParts = [];

        if ($entitiesCreated !== 0) {
            $infoStringParts[] = sprintf('created %d %s', $entitiesCreated, Str::plural($typeSingular, $entitiesCreated));
        }

        if ($entitiesUpdated !== 0) {
            $infoStringParts[] = sprintf('updated %d %s', $entitiesUpdated, Str::plural($typeSingular, $entitiesUpdated));
        }

        if (!empty($infoStringParts)) {
            $this->info(ucfirst(implode(' and ', $infoStringParts)), OutputInterface::VERBOSITY_VERBOSE);
        }
    }
}
