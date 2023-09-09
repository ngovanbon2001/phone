<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Common;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\FilterOrderRequest;
use App\Services\Contracts\OrderServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class OrderController extends Controller
{
    protected OrderServiceInterface $orderServiceInterface;
    private string $action = 'order';

    /**
     * @param OrderServiceInterface $orderServiceInterface
     */
    public function __construct(
        OrderServiceInterface    $orderServiceInterface,
    ) {
        $this->orderServiceInterface    = $orderServiceInterface;
    }

    /**
     * Display a listing of the resource.
     * @param FilterOrderRequest $request
     * @return Factory|View|Application
     */
    public function index(FilterOrderRequest $request): Factory|View|Application
    {
        $orders = $this->orderServiceInterface->list($request->all());

        return view('admin/order/show', compact('orders'));
    }

    /**
     * Update the specified resource in storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function update(int $id): RedirectResponse
    {
        $order = $this->orderServiceInterface->update($id);

        return $this->handleViewResponse(
            $order,
            'indexOrder',
            Common::ACTION[Common::ACTION_UPDATE]. ' '.$this->action,
            'Update order successful.'
        );
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function cancel(int $id): RedirectResponse
    {
        $order = $this->orderServiceInterface->cancel($id);

        return $this->handleViewResponse(
            $order,
            'indexOrder',
            Common::ACTION[Common::ACTION_UPDATE]. ' '.$this->action,
            'Cancel order successful.'
        );
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function select_delivery(Request $request): mixed
    {
        return $this->orderServiceInterface->select_delivery($request->all());
    }

    /**
     * @param $id
     * @return Factory|View|Application
     */
    public function showbyId($id): Factory|View|Application
    {
        $order     = $this->orderServiceInterface->detail($id);

        $itemOrder = $this->orderServiceInterface->showListItem($order);

        return view('admin/order/detail', compact('order', 'itemOrder'));
    }

    /**
     * @return void
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function export(): void
    {
        $orders = $this->orderServiceInterface->list(Session::get('data'));
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $i = 3;

        $column = 0;

        $styleArrayTitle = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THICK,
                    'color' => array('rgb' => '1c1e21'),
                ],
            ],
        ];

        $styleArray = [
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THICK,
                    'color' => array('rgb' => '1c1e21'),
                ],
            ],
        ];

        $rowColor = [
            'fill' => array(
                'fillType' => Fill::FILL_SOLID,
                'color' => array('rgb' => '2ed87a')
            )
        ];

        $sheet->setCellValue("D3", "Name");
        $sheet->setCellValue("E3", "Phone");
        $sheet->setCellValue("F3", "Email");
        $sheet->setCellValue("G3", "Total");
        $sheet->setCellValue("H3", "Amount");
        $sheet->setCellValue("I3", "Date");
        $sheet->setCellValue("J3", "Address");
        foreach ($orders as $item) {
            $i++;

            $column = $i;

            $sheet->setCellValue("D" . $i, $item->customer_name);
            $sheet->setCellValue("E" . $i, $item->customer_phone);
            $sheet->setCellValue("F" . $i, $item->customer_email);
            $sheet->setCellValue("G" . $i, $item->total_money);
            $sheet->setCellValue("H" . $i, $item->total_products);
            $sheet->setCellValue("I" . $i, $item->created_date);
            $sheet->setCellValue("J" . $i, $item->address);
        }

        $sheet->getStyle('D3:J3')->applyFromArray($styleArrayTitle);
        $sheet->getStyle('D4:J' . $column)->applyFromArray($styleArray);

        for ($row = 3; $row <= $column; $row++) {
            if ($row % 2 == 1) {
                $sheet->getStyle('D' . $row . ':J' . $row)->applyFromArray($rowColor);
            }
        }

        $writer = new Xlsx($spreadsheet);
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment;filename=\"user_12-9.xlsx\"");
        header("Cache-Control: max-age=0");
        header("Expires: Fri, 11 Nov 2011 11:11:11 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: cache, must-revalidate");
        header("Pragma: public");
        $writer->save("php://output");
        Session::forget('data');
    }
}
