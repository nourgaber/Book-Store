<?php

namespace App\Services;

use App\Repositories\BookRepository;
use App\Services\Interfaces\BookServiceInterface;
use App\Services\ResponseService;
use App\Constants\SuccessConstants;
use App\Exceptions\CustomException;
/**
 * Class BookService
 * @package App\Services
 */
class BookService implements BookServiceInterface
{
    protected $bookRepository;
    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }
    public function show($book_id)
    {
        $book = $this->bookRepository->show($book_id);
        if (!$book) {
            throw new CustomException('Book_NOT_FOUND');
        }
        $message = 'BookFound';
        $responseMessage=SuccessConstants::Success_MESSAGES[$message];
        $httpcode=SuccessConstants::Success_CODES[$message];
        return ResponseService::generateResponseWithSuccessData($responseMessage,$httpcode,$book);
    }
    public function index()
    {
        return $this->bookRepository->index();
    }
    public function delete($book_id)
    {
        $book = $this->bookRepository->delete($book_id);
        if (!$book) {
            throw new CustomException('Book_NOT_FOUND');
        }
        $message = 'BookDeleted';
        $responseMessage=SuccessConstants::Success_MESSAGES[$message];
        $httpcode=SuccessConstants::Success_CODES[$message];
        return ResponseService::generateResponseWithSuccess($responseMessage,$httpcode);
        }
    public function update($book_id,$book_name,$book_renting_price,$book_price,$author_id)
    {
        $book = $this->bookRepository->update($book_id,$book_name,$book_renting_price,$book_price,$author_id);
        if (!$book) {
            throw new CustomException('Book_NOT_FOUND');
        }

        $message = 'BookUpdated';
        $responseMessage=SuccessConstants::Success_MESSAGES[$message];
        $httpcode=SuccessConstants::Success_CODES[$message];
        return ResponseService::generateResponseWithSuccessData($responseMessage,$httpcode,$book);
        }

    public function store($book_name,$book_renting_price,$book_price,$author_id)
    {
        $this->bookRepository->store($book_name,$book_renting_price,$book_price,$author_id);
        $message = 'BookCreated';
        $responseMessage=SuccessConstants::Success_MESSAGES[$message];
        $httpcode=SuccessConstants::Success_CODES[$message];
        return ResponseService::generateResponseWithSuccess($responseMessage,$httpcode);
    }

}
