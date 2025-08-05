<?php

namespace Tests\MiniLeanpub\Unit\Application\UseCases\Book\CreateBook;

use PHPUnit\Framework\TestCase;
use stdClass;
use App\Models\Book;
use MiniLeanpub\Application\UseCases\Book\CreateBook\DTO\{BookCreateInputDTO, BookCreateOutputDTO};
use MiniLeanpub\Application\UseCases\Book\CreateBook\CreateBookUseCase;
use MiniLeanpub\Infrastructure\Repository\Book\BookEloquentRepository;

class CreateBookUseCaseTest extends TestCase
{
    public function testShouldCreateANewBookViaUseCase()
    {
        $repository = $this->getRepositoryMock();
        $input = new BookCreateInputDTO(
            'd59e0678-d8e2-45f0-8147-add6f098af28',
            'My Awesome Book',
            'My Awesome Book desc',
            25.9,
            'book_path',
            'text/markdown'
        );

        $useCase = new CreateBookUseCase($input, $repository);
        $result = $useCase->handle();

        $this->assertInstanceOf(BookCreateOutputDTO::class, $result);

        $data = $result->getData();

        $this->assertEquals('d59e0678-d8e2-45f0-8147-add6f098af28', $data['bookCode']);
        $this->assertEquals('My Awesome Book', $data['title']);
    }

    private function getRepositoryMock()
    {
        $return = new stdClass();
        $return->bookCode = 'd59e0678-d8e2-45f0-8147-add6f098af28';
        $return->title = 'My Awesome Book';
        $return->description = 'My Awesome Book Desc';
        $return->price = 25.9;
        $return->book_path = 'book_path';

        $model = $this->createMock(Book::class); //Eloquent Book Model

        $mock = $this->getMockBuilder(BookEloquentRepository::class)
            ->onlyMethods(['create'])
            ->setConstructorArgs([$model])
            ->getMock();

        $mock->expects($this->once())
            ->method('create')
            ->willReturn($return);

        return $mock;
    }
}