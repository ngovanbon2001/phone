<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Trường :attribute phải được chấp nhận.',
    'active_url' => 'Trường :attribute không phải là URL hợp lệ.',
    'after' => 'Trường :attribute phải là ngày sau ngày :date.',
    'after_or_equal' => 'Trường :attribute phải là ngày sau hoặc bằng ngày :date.',
    'alpha' => 'Trường :attribute chỉ được chứa chữ cái.',
    'alpha_dash' => 'Trường :attribute chỉ được chứa chữ cái, số, dấu gạch ngang và dấu gạch dưới.',
    'alpha_num' => 'Trường :attribute chỉ được chứa chữ cái và số.',
    'array' => 'Trường :attribute phải là mảng.',
    'before' => 'Trường :attribute phải là ngày trước ngày :date.',
    'before_or_equal' => 'Trường :attribute phải là ngày trước hoặc bằng ngày :date.',
    'between' => [
        'numeric' => 'Trường :attribute phải nằm trong khoảng từ :min đến :max.',
        'file' => 'Trường :attribute phải có kích thước từ :min đến :max kilobytes.',
        'string' => 'Trường :attribute phải có độ dài từ :min đến :max ký tự.',
        'array' => 'Trường :attribute phải có từ :min đến :max phần tử.',
    ],
    'boolean' => 'Trường :attribute phải có giá trị đúng (true) hoặc sai (false).',
    'confirmed' => 'Xác nhận trường :attribute không khớp.',
    'date' => 'Trường :attribute không phải là ngày hợp lệ.',
    'date_equals' => 'Trường :attribute phải bằng với ngày :date.',
    'date_format' => 'Trường :attribute không khớp với định dạng :format.',
    'different' => 'Trường :attribute và :other phải khác nhau.',
    'digits' => 'Trường :attribute phải có :digits chữ số.',
    'digits_between' => 'Trường :attribute phải có độ dài từ :min đến :max chữ số.',
    'dimensions' => 'Trường :attribute có kích thước hình ảnh không hợp lệ.',
    'distinct' => 'Trường :attribute có giá trị trùng lặp.',
    'email' => 'Trường :attribute phải là địa chỉ email hợp lệ.',
    'ends_with' => 'Trường :attribute phải kết thúc bằng một trong các giá trị sau: :values.',
    'exists' => 'Trường :attribute đã chọn không tồn tại.',
    'file' => 'Trường :attribute phải là tệp tin.',
    'filled' => 'Trường :attribute phải có giá trị.',
    'gt' => [
        'numeric' => 'Trường :attribute phải lớn hơn :value.',
        'file' => 'Trường :attribute phải có kích thước lớn hơn :value kilobytes.',
        'string' => 'Trường :attribute phải có độ dài lớn hơn :value ký tự.',
        'array' => 'Trường :attribute phải có nhiều hơn :value phần tử.',
    ],
    'gte' => [
        'numeric' => 'Trường :attribute phải lớn hơn hoặc bằng :value.',
        'file' => 'Trường :attribute phải có kích thước lớn hơn hoặc bằng :value kilobytes.',
        'string' => 'Trường :attribute phải có độ dài lớn hơn hoặc bằng :value ký tự.',
        'array' => 'Trường :attribute phải có ít nhất :value phần tử.',
    ],
    'image' => 'Trường :attribute phải là hình ảnh.',
    'in' => 'Giá trị được chọn trong trường :attribute không hợp lệ.',
    'in_array' => 'Trường :attribute không tồn tại trong :other.',
    'integer' => 'Trường :attribute phải là số nguyên.',
    'ip' => 'Trường :attribute phải là địa chỉ IP hợp lệ.',
    'ipv4' => 'Trường :attribute phải là địa chỉ IPv4 hợp lệ.',
    'ipv6' => 'Trường :attribute phải là địa chỉ IPv6 hợp lệ.',
    'json' => 'Trường :attribute phải là chuỗi JSON hợp lệ.',
    'lt' => [
        'numeric' => 'Trường :attribute phải nhỏ hơn :value.',
        'file' => 'Trường :attribute phải có kích thước nhỏ hơn :value kilobytes.',
        'string' => 'Trường :attribute phải có độ dài nhỏ hơn :value ký tự.',
        'array' => 'Trường :attribute phải có ít hơn :value phần tử.',
    ],
    'lte' => [
        'numeric' => 'Trường :attribute phải nhỏ hơn hoặc bằng :value.',
        'file' => 'Trường :attribute phải có kích thước nhỏ hơn hoặc bằng :value kilobytes.',
        'string' => 'Trường :attribute phải có độ dài nhỏ hơn hoặc bằng :value ký tự.',
        'array' => 'Trường :attribute phải có không quá :value phần tử.',
    ],
    'max' => [
        'numeric' => 'Trường :attribute không được lớn hơn :max.',
        'file' => 'Trường :attribute không được lớn hơn :max kilobytes.',
        'string' => 'Trường :attribute không được lớn hơn :max ký tự.',
        'array' => 'Trường :attribute không được có nhiều hơn :max phần tử.',
    ],
    'mimes' => 'Trường :attribute phải là một tệp tin thuộc loại: :values.',
    'mimetypes' => 'Trường :attribute phải là một tệp tin thuộc loại: :values.',
    'min' => [
        'numeric' => 'Trường :attribute phải có ít nhất :min.',
        'file' => 'Trường :attribute phải có ít nhất :min kilobytes.',
        'string' => 'Trường :attribute phải có ít nhất :min ký tự.',
        'array' => 'Trường :attribute phải có ít nhất :min phần tử.',
    ],
    'multiple_of' => 'Trường :attribute phải là bội số của :value.',
    'not_in' => 'Giá trị được chọn trong trường :attribute không hợp lệ.',
    'not_regex' => 'Định dạng của trường :attribute không hợp lệ.',
    'numeric' => 'Trường :attribute phải là số.',
    'password' => 'Mật khẩu không đúng.',
    'present' => 'Trường :attribute phải tồn tại.',
    'regex' => 'Định dạng của trường :attribute không hợp lệ.',
    'required' => 'Trường :attribute là bắt buộc.',
    'required_if' => 'Trường :attribute là bắt buộc khi :other là :value.',
    'required_unless' => 'Trường :attribute là bắt buộc trừ khi :other thuộc trong :values.',
    'required_with' => 'Trường :attribute là bắt buộc khi :values tồn tại.',
    'required_with_all' => 'Trường :attribute là bắt buộc khi :values tồn tại.',
    'required_without' => 'Trường :attribute là bắt buộc khi :values không tồn tại.',
    'required_without_all' => 'Trường :attribute là bắt buộc khi không có :values nào tồn tại.',
    'same' => 'Trường :attribute và :other phải giống nhau.',
    'size' => [
        'numeric' => 'Trường :attribute phải có kích thước :size.',
        'file' => 'Trường :attribute phải có kích thước :size kilobytes.',
        'string' => 'Trường :attribute phải có độ dài :size ký tự.',
        'array' => 'Trường :attribute phải chứa :size phần tử.',
    ],
    'starts_with' => 'Trường :attribute phải bắt đầu bằng một trong các giá trị sau: :values.',
    'string' => 'Trường :attribute phải là chuỗi.',
    'timezone' => 'Trường :attribute phải là múi giờ hợp lệ.',
    'unique' => 'Trường :attribute đã được sử dụng.',
    'uploaded' => 'Tải lên trường :attribute thất bại.',
    'url' => 'Định dạng của trường :attribute không hợp lệ.',
    'uuid' => 'Trường :attribute phải là UUID hợp lệ.',

    'drag_and_drop' => 'Chỉ cho phép tệp tin :attribute có định dạng: txt, xlsx, docx, csv, pptx, pdf, zip',
    'file_or_sitemap' => 'Ít nhất một trong các trường :attribute là bắt buộc.',
    'chat_bot' => 'Trường bắt đầu tin nhắn Chatbot là bắt buộc.',
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],
];
