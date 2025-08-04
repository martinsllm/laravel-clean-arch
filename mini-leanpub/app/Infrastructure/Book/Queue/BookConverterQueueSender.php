<?php

namespace MiniLeanpub\Infrastructure\Book\Queue;

use App\Jobs\Book\ConvertBookJob;
use MiniLeanpub\Domain\Shared\Queue\QueueInterface;

class BookConverterQueueSender implements QueueInterface
{
    public function sendToQueue(string $bookPath): bool
    {
        ConvertBookJob::dispatch($bookPath);

        return true;
    }
}