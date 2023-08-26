<!DOCTYPE html>
<html lang="en">
@include ('admin.common.head', ['pageTitle' => 'Brand - Phone Admin'])

<body>
  @include ('admin.common.index')

  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" /> -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('showBrand')}}">Brand</a></li>
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
              <a href="{{ route('createBrand') }}" class="btn btn-primary"> <i class="ri-add-fill"></i> </a>

              <div class="table-responsive">
                <div class="widget-content">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th style="width:5%; text-align: center;">No</th>
                        <th style="width:18%; text-align: center;">Image</th>
                        <th style="width:20%; text-align: left;">Brand's Name</th>
                        <th style="width:30%; text-align: center;">Link</th>
                        <th style="width:7%; text-align: center;">Active</th>
                        <th style="width:20%; text-align: center;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($brandList as $brandKey => $brandData)
                      <tr>
                        <td style="text-align: center;">{{ $brandKey + 1 }}</td>
                        <td style="text-align: center;"><img src="{{ asset('images/' . $brandData->image_url) }}" width="150px" alt="No image"></td>
                        <td style="text-align: left;">{{ $brandData->name }}</td>
                        <td style="text-align: center;"><a href="{{ $brandData->link }}" target="_blank">{{ $brandData->link }}</a></td>
                        <td style="text-align: center;"><input type="checkbox" class="toggle-position" value="{{ $brandData->id }}" data-name="{{ $brandData->name }}" data-url="{{route('activeBrand')}}" data-id="{{ $brandData->id }}" data-on="Yes" data-off="No" {{ $brandData->active == 1 ? 'checked' : '' }} data-toggle="toggle" data-width="20" data-height="10"></td>
                        <td style="text-align: center;">
                          <input value="{{ $brandData->id }}" type="hidden" name="id" id="">
                          <a class="btn btn-success" href="{{ route('editBrand', $brandData->id) }}"><i class="bi bi-pencil-square"></i></a> &emsp;
                          <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item ?');" href="{{ route('destroyBrand', $brandData->id) }}"><i class="bi bi-trash"></i></a>
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
              <li class="page-item"><a class="page-link" href="{{$brandList->previousPageUrl()}}">
                  << </a>
              </li>
              @foreach($brandList->links()->getData()["elements"][0] as $key => $item)
              <li class="page-item"><a class="page-link" href="{{$item}}">{{$key}}</a></li>
              @endforeach
              <li class="page-item"><a class="page-link" href="{{$brandList->nextPageUrl()}}">>></a></li>
            </ul>
          </nav><!-- End Basic Pagination -->
        </div>
      </div>
    </section>
  </main><!-- End #main -->

  @include ('admin.common.footer')
</body>

</html>