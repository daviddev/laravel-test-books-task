<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class HttpErrorResponse extends Exception
{
    /**
     * @param $message
     * @param $errors
     * @param $code
     */
    public function __construct(protected $message = 'Something went wrong.', protected $errors = [], protected $code = 400)
    {
        parent::__construct();
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @return Response
     */
    public function render(): Response
    {
        $data = [
            'success' => false,
            'message' => $this->message,
        ];
        if (!empty($this->errors)) {
            $data['errors'] = $this->errors;
        }

        return response($data, $this->code);
    }
}
