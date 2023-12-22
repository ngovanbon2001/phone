<!DOCTYPE html>
<html lang="en">
@include ('admin.common.head', ['pageTitle' => __('languages.comment').' - Phone Admin'])

<body>
    @include ('admin.common.index')

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" /> -->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>@lang('languages.dashboard')</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">@lang('languages.home')</a></li>
                    <li class="breadcrumb-item"><a href="{{route('showCate')}}">@lang('languages.comment')</a></li>
                    <li class="breadcrumb-item active">@lang('languages.list')</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <div id="message">
                            @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif

                            @if (session()->has('message-error'))
                                <div class="alert alert-danger">
                                    {{ session('message-error') }}
                                </div>
                            @endif
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="widget-content">
                                    <table style="width:100%" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width:5%; text-align: center;">@lang('languages.num')</th>
                                                <th style="width:10%; text-align: left;">@lang('languages.customer_name')</th>
                                                <th style="width:8%; text-align: center;">@lang('languages.product_name')</th>
                                                <th style="width:57%; text-align: center;">@lang('languages.comment')</th>
                                                <th style="width:20%; text-align: center;">@lang('languages.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($comment as $key => $value)
                                            <tr>
                                                <td style="text-align: center;">{{ $key + 1 }}</td>
                                                <td style="text-align: left;">{{ $value->user_name ?? '' }}</td>
                                                <td style="text-align: center;">{{ $value->product_name ?? '' }} </td>
                                                <td style="text-align: center;">{{ $value->comments ?? '' }} </td>
                                                <td style="text-align: center;">
                                                    <?php $message =  __('languages.delete_confirm') ?>
                                                    <a class="btn btn-danger" onclick="return confirm('{{ $message }}') ? document.getElementById('comment-delete-{{ $value->id }}').submit() : false"><i class="bi bi-trash"></i></a>
                                                    <form action="{{ route('comment.destroy', $value->id) }}" id="comment-delete-{{ $value->id }}" method="post">
                                                        @method('delete')
                                                        @csrf()
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Left side columns -->

            </div>
        </section>

        <section class="section">
            <div class="row">
                <div class="col-lg-12" style="display: flex; justify-content: center;">
                    <!-- Basic Pagination -->
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="{{$comment->previousPageUrl()}}">
                                    << </a>
                            </li>
                            @foreach($comment->links()->getData()["elements"][0] as $key => $item)
                            <li class="page-item"><a class="page-link" href="{{$item}}">{{$key}}</a></li>
                            @endforeach
                            <li class="page-item"><a class="page-link" href="{{$comment->nextPageUrl()}}">>></a></li>
                        </ul>
                    </nav><!-- End Basic Pagination -->
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    @include ('admin.common.footer')
</body>

</html>
