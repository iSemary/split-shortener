@extends('layouts.app')
@section('content')
    <section class="main">
        <div class="url-shorten mb-2">
            <div class="url-shorten-form">
                <form action="{{route('url-shorten.store')}}" method="POST" id="ShortenForm">
                    @csrf
                    <div class="form-group mb-1 form-items">
                        <input type="text" class="form-control url-area" name="full_url" id="FullUrl"
                               placeholder="Shorten your url ..." required>
                        <button type="submit" class="btn btn-primary btn-shorten"><i class="fas fa-cut"></i> Shorten</button>
                        <button type="button" id="ExtraBtn" class="btn btn-extra"><i class="fa fa-arrow-down"></i></button>
                    </div>
                    <div style="display: none" id="CustomNameArea">
                        <input type="text" class="form-control mb-1" name="custom_name" id="CustomName"
                               placeholder="Write custom path..." maxlength="50" minlength="3">
                    </div>
                </form>
            </div>
            <div class="url-shorten-result" id="ShortenResult">
                <div class="alert alert-success">
                    <span>Your shorten link is ready to use : </span>
                    <a href="" target="_blank" id="ShortenLink"></a>
                </div>
            </div>
        </div>
        <div class="most-shorten">
            <div class="card">
                <div class="card-header">
                    Most Shorten Url Visits
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Full Url</th>
                            <th scope="col">Shorten Url</th>
                            <th scope="col">Visits</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($visits as $index => $visit)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$visit->full_url}}</td>
                                <td>{{url('/').'/'}}{{$visit->shorten_url ? $visit->shorten_url : $visit->custom_name}}</td>
                                <td>{{$visit->visits}}</td>
                            </tr>
                        @empty
                            <tr>
                                There's no url visitors yet.
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $("#ShortenForm").on('submit', function (e) {
                e.preventDefault();
                let Form = $(this);
                let CSRF_TOKEN = `{{csrf_token()}}`;
                let full_url = $("#FullUrl").val();
                let custom_name = $("#CustomName").val();
                let btn = $(".btn-shorten");
                let FormUrl = Form.attr('action');
                let ShortenResult = $("#ShortenResult");
                $.ajax({
                    url: FormUrl,
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, full_url: full_url, custom_name: custom_name},
                    dataType: 'JSON',
                    beforeSend: function () {
                        btn.html(`<i class="fas fa-spinner fa-pulse"></i> ` + 'Processing...');
                    },
                    success: function (response) {
                        btn.html(`<i class="fas fa-cut"></i> ` + 'Shorten');
                        Form[0].reset();
                        $("#ShortenLink").attr('href',response).text(response);
                        ShortenResult.show();
                    }
                });
            });
        });
    </script>
    <script>
        $("#ExtraBtn").click(function () {
            $("#CustomNameArea").toggle();
            $(this).children('i').toggleClass("fa-arrow-down fa-arrow-up");
        });
    </script>
@endsection
