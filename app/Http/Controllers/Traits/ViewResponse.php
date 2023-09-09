<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\RedirectResponse;

trait ViewResponse
{
    /**
     * @param mixed $data
     * @param         $route
     * @param         $action
     * @param string $message
     * @param int|null $id
     * @return RedirectResponse
     */
    public function handleViewResponse(mixed $data, $route, $action, string $message = '', int $id = null): RedirectResponse
    {
        if ($id) {
            $redirect = redirect()->route($route, $id);
        } else {
            $redirect = redirect()->route($route);
        }

        if ($data){
            session()->flash('message', $action.' successful! '.$message);
        } else {
            session()->flash('message-error', 'Fail '.$action);
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
