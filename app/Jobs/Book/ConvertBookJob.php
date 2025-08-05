<?php

namespace App\Jobs\Book;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use MiniLeanpub\Infrastructure\Service\BookConverter\BookConverterService;

class ConvertBookJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private string $bookCode)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $chapters = Storage::disk('books')->allFiles($this->bookCode . '/chapters');
        //['book_code/1.md', 2.md, 3.md]

        $chapters = array_map(fn($line) => storage_path('app/books/' . $line), $chapters);

        $converter = new BookConverterService($chapters, storage_path('app/books/' . $this->bookCode));

        $converter->makeConversion();
    }
}
