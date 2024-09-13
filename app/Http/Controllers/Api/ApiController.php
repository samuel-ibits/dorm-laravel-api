<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

/**
 * class ApiController
 *
 * The base Api class to be inherited by controller classes.
 */
class ApiController extends Controller
{
    /**
     * Check if the specified relationship is included in the request.
     *
     * This method inspects the 'include' parameter in the request query string
     * and determines if the specified relationship should be included in the
     * response. The 'include' parameter is expected to be a comma-separated
     * list of relationships.
     *
     * @param string $relationship The relationship to check for inclusion.
     *
     * @return boolean True if the relationship is included in the request, false otherwise.
     */
    public function include(string $relationship) : bool
    {
        $param = request()->get('include');

        if (!isset($param)) {
            return false;
        }

        $includeValues = explode(',', strtolower($param));

        return in_array(strtolower($relationship), $includeValues);
    }
}
