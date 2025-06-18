<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

//I was repeating too much this code, so I just make this and made the Controller parent class use it so i can access it in all controllers
trait HandlesResourceActions
{
    /**
     * Wrap a callback with standardized error handling and flash messaging.
     *
     * @param  callable  $callback  The logic to execute (create/update/delete).
     * @param  string  $successMessage  Message shown on success.
     * @param  string  $errorMessage  Message shown on failure.
     * @param  string|null  $redirectRoute  Route name to redirect to on success.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function tryAction(callable $callback, string $successMessage, string $errorMessage, string $redirectUrl = null)
    {
        try {
            $callback();
        } catch (\Exception $e) {
            Log::error('Action failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', __($errorMessage));
        }

        return $redirectUrl
            ? redirect($redirectUrl)->with('success', __($successMessage))
            : redirect()->back()->with('success', __($successMessage));
    }

    public function tryApiAction(callable $callback, string $successMessage, string $errorMessage, int $successCode = 200)
    {
        try {
            $result = $callback();

            return response()->json([
                'message' => $successMessage,
                'data' => $result ?? null,
            ], $successCode);
        } catch (\Exception $e) {
            Log::error('API action failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'message' => $errorMessage,
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
