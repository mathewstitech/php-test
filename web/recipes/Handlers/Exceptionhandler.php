<?php
namespace \Handlers;

use Pecee\Handlers\IExceptionHandler;
use Pecee\Http\Request;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;

class ExceptionHandler implements IExceptionHandler
{
	public function handleError(Request $request, \Exception $error)
	{

		/* Set the rewrite callback if the page is not found */
		if($error instanceof NotFoundHttpException) {

			// Render custom 404-page from your custom controller + method
			$request->setRewriteCallback('Demo\Controllers\PageController@notFound');
			return $request;

		}

                // Otherwise throw the error
		throw $error;

	}

}