<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\RedirectResponse;

trait ViewResponse
{
    /**
     * @param  mixed  $data
     * @param         $route
     * @param         $action
     *
     * @return RedirectResponse
     */
    public function handleViewResponse(mixed $data, $route, $action, string $message = ''): RedirectResponse
    {
        $redirect = redirect()->route($route);

        if ($data){
            session()->flash('message', 'Success '.$action.'! '.$message);
        } else {
            session()->flash('message-error', 'Fail '.$action.' '.$message);
        }

        return $redirect;
    }

    /**
     * @param mixed $data
     * @param $path
     * @param $action
     * @return RedirectResponse
     */
    public function handleViewResponseToPath(mixed $data, $path, $action): RedirectResponse
    {
        $redirect = redirect()->to($path);

        if ($data){
            $messResponse = __('global-message.status_success_message', ['form' => $action]);
            $redirect->withSuccess($messResponse);
        } else {
            $messResponse = __('global-message.status_fail_message', ['form' => $action]);
            $redirect->withErrors($messResponse);
        }

        return $redirect;
    }
}
