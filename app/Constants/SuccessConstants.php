<?php
namespace App\Constants;

use Symfony\Component\HttpFoundation\Response;

class SuccessConstants
{
    public const Success_MESSAGES = [
        'OK'            => 'Successful operation',
        'UserCreated'   => 'Successfully created user',
        'UserDeleted'   => 'Successfully deleted user',
        'UserLoggedout' => 'Successfully logged out',
        'UserFound'     => 'Successfully found user',
        'UserUpdated'   => 'Successfully updated user',
        'BookCreated'   => 'Successfully created Book',
        'BookDeleted'   => 'Successfully deleted Book',
        'BookUpdated'   => 'Successfully updated Book',
        'BookFound'     => 'Successfully found Book',

    ];

    public const Success_CODES = [
        'OK'            => Response::HTTP_OK,
        'UserCreated'   => Response::HTTP_CREATED,
        'UserLoggedout' => Response::HTTP_OK,
        'UserFound'     => Response::HTTP_OK,
        'UserDeleted'   => Response::HTTP_OK,
        'UserUpdated'   => Response::HTTP_OK,
        'BookCreated'   => Response::HTTP_CREATED,
        'BookDeleted'   => Response::HTTP_OK,
        'BookUpdated'   => Response::HTTP_OK,
        'BookFound'     => Response::HTTP_OK,
    ];
}
