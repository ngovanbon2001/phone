<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SvgController extends Controller
{
    private function createSVG($data)
    {
        $name = $data['name'] ?? 'John Doe';
        $phone = $data['phone'] ?? '';
        $address = $data['address'] ?? '';
        $imagePath = "https://kenh14cdn.com/thumb_w/660/203336854389633024/2023/2/18/1676661716-image-16767137505851262911723.png";

        $svgContent = '<svg width="400" height="200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="background-color: blue;">';
        $svgContent .= '<text x="20" y="40" font-family="Arial" font-size="16">' . $name . '</text>';
        $svgContent .= '<text x="20" y="70" font-family="Arial" font-size="14">Phone: ' . $phone . '</text>';
        $svgContent .= '<text x="20" y="100" font-family="Arial" font-size="14">Address: ' . $address . '</text>';
        $svgContent .= '<image x="20" y="120" width="100" height="50" xlink:href="' . $imagePath . '" />';
        $svgContent .= '</svg>';

        return $svgContent;
    }

    public function generateSVG(Request $request)
    {
        $data = $request->all();
        $svgContent = $this->createSVG($data);

        return Response::make($svgContent, 200, [
            'Content-Type' => 'image/svg+xml',
        ]);
    }

    public function generateImage(Request $request)
    {
        // Lấy dữ liệu từ request
        $data = $request->all();

        // Tạo hình ảnh dựa trên dữ liệu từ request
        $image = Image::canvas(400, 200, '#ffffff'); // Tạo ảnh trắng 400x200

        $image->text('Text to display', 100, 100, function ($font) {
            $font->size(24); // Kích thước font
            $font->color('#000000'); // Màu chữ
            $font->align('center'); // Căn giữa
            $font->valign('top'); // Canh từ trên xuống
            $font->angle(45); // Góc quay của văn bản
        });

        // Chuyển đổi hình ảnh thành định dạng PNG và trả về nó dưới dạng phản hồi HTTP
        return $image->response('png');
    }
}
