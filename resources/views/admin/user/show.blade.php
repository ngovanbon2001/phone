<!DOCTYPE html>
<html lang="en">
@include ('admin.common.head', ['pageTitle' => 'User - Phone Admin'])

<body>
    @include ('admin.common.index')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('indexUser')}}">Account</a></li>
                    <li class="breadcrumb-item active">List</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <div id="message">
                            @if (session()->has('messageAdd'))
                            <div class="alert alert-success">
                                {{ session('messageAdd') }}
                            </div>
                            @endif

                            @if (session()->has('messageUpdate'))
                            <div class="alert alert-success">
                                {{ session('messageUpdate') }}
                            </div>
                            @endif

                            @if (session()->has('messageDelete'))
                            <div class="alert alert-success">
                                {{ session('messageDelete') }}
                            </div>
                            @endif

                            @if (session()->has('messageError'))
                            <div class="alert alert-danger">
                                {{ session('messageError') }}
                            </div>
                            @endif
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="widget-content">
                                    <a href="{{route('createUser')}}" class="btn btn-primary"> <i class="ri-add-fill"></i> </a>
                                    <table style="width:100%" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width:45%">User's Name</th>
                                                <th style="width:30%;">Email</th>
                                                <th style="width:15%; text-align: center;">Phone</th>
                                                <th style="width:10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $userData)
                                            @if ($userData->id != Auth::guard("admin")->user()->id)
                                            <tr>
                                                <td>{{ $userData->username }}</td>
                                                <td>{{ $userData->email }}</td>
                                                <td style="text-align: center;">{{ $userData->phone }}</td>
                                                <td style="text-align: center;">
                                                    <a class="btn btn-success" href="{{ route('editUser', $userData->id)  }}"><i class="bi bi-pencil-square"></i></a>
                                                    @if (Auth::guard("admin")->user()->permission == 0)
                                                    <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this staff ?');" href="{{ route('destroyUser', $userData->id) }}"><i class="bi bi-trash"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endif
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
                            <li class="page-item"><a class="page-link" href="{{$users->previousPageUrl()}}">
                                    << </a>
                            </li>
                            @foreach($users->links()->getData()["elements"][0] as $key => $item)
                            <li class="page-item"><a class="page-link" href="{{$item}}">{{$key}}</a></li>
                            @endforeach
                            <li class="page-item"><a class="page-link" href="{{$users->nextPageUrl()}}">>></a></li>
                        </ul>
                    </nav><!-- End Basic Pagination -->
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    @include ('admin.common.footer')
</body>

</html>