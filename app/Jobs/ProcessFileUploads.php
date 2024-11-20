<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use App\Models\Attachment;

class ProcessFileUploads implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePaths;
    protected $userId;

    /**
     * Create a new job instance.
     *
     * @param array $filePaths
     * @param int $userId
     */
    public function __construct(array $filePaths, $userId)
    {
        $this->filePaths = $filePaths;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->filePaths as $fileData) {
            // Rehydrate the file
            $tempPath = $fileData['path'];
            $originalName = $fileData['original_name'];

            // Move the file to its final destination
            $finalPath = Storage::putFileAs(
                'files',
                Storage::path($tempPath),
                time() . '_' . $originalName
            );

            // Create the database record
            Attachment::create([
                'file_path' => $finalPath,
                'user_id' => $this->userId,
                'file_name' => $originalName,
            ]);

            // Delete the temporary file
            Storage::delete($tempPath);
        }
    }
}
