@extends('layouts.app')




@section('content')
    <h1>Input Skor</h1>
    {{-- Success Notification --}}
    @if (\Session::has('success'))
        <div class="alert alert-success">
            {!! \Session::get('success') !!}</li>
        </div>
    @endif

    {{-- Form input --}}
    <form class="row g-3 " action="/tambah-skor" method="POST">
        @csrf
        {{-- <div class="col-md-6">
            <label for="tim1" class="form-label">Tim 1</label>
            <select id="tim1" name="tim1" class="form-select">
                @foreach ($clubs as $club)
                    <option>{{ $club['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label for="tim2" class="form-label">Tim 2</label>
            <select id="tim2" name="tim2" class="form-select">
                @foreach ($clubs as $club)
                    <option>{{ $club['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label for="skor_tim1" class="form-label">Skor Tim 1</label>
            <input type="number" class="form-control" id="skor_tim1" name="skor_tim1">
        </div>
        <div class="col-md-6">
            <label for="skor_tim2" class="form-label">Skor Tim 2</label>
            <input type="number" class="form-control" id="skor_tim2" name="skor_tim2">
        </div> --}}
        <div id="element-to-duplicate">
            <div class="col-md-6">
                <label for="tim1" class="form-label">Tim 1</label>
                <select id="tim1" name="tim1" class="form-select">
                    @foreach ($clubs as $club)
                        <option>{{ $club['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="tim2" class="form-label">Tim 2</label>
                <select id="tim2" name="tim2" class="form-select">
                    @foreach ($clubs as $club)
                        <option>{{ $club['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="skor_tim1" class="form-label">Skor Tim 1</label>
                <input type="number" class="form-control" id="skor_tim1" name="skor_tim1">
            </div>
            <div class="col-md-6">
                <label for="skor_tim2" class="form-label">Skor Tim 2</label>
                <input type="number" class="form-control" id="skor_tim2" name="skor_tim2">
            </div>
            <button class="delete-button btn btn-danger mt-1" onclick="deleteElement(this)">Delete</button>
        </div>
        @if (\Session::has('error'))
            <div class="alert alert-danger">
                {!! \Session::get('error') !!}
            </div>
        @endif
        @if ($errors->has('id_tim1'))
            <div class="alert alert-danger">
                {{ 'This match is already recorded.' }}
            </div>
        @endif
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
    <button onclick="duplicateElement()" class="btn btn-success mt-1">Add element</button>
    <button class="btn btn-success mt-1" id="simpan">Simpan</button>
@endsection

@section('script')
    <script>
        function duplicateElement() {
            var originalElement = document.getElementById("element-to-duplicate");

            if (originalElement) {
                var clonedElement = originalElement.cloneNode(true);
                originalElement.parentNode.insertBefore(clonedElement, originalElement.nextSibling);
            } else {
                console.error("Element not found!");
            }
        }

        function deleteElement(button) {
            var elementToDelete = button.parentNode;
            elementToDelete.parentNode.removeChild(elementToDelete);
        }

        $(document).on('click', '#simpan', function() {

            alert('Hello')
            let tim1 = []
            let tim2 = []
            let skor_tim1 = []
            let skor_tim2 = []

            $('.tim1').each(function() {
                tim1.push($(this).text())
            })
            $('.tim2').each(function() {
                tim1.push($(this).text())
            })
            $('.skor_tim1').each(function() {
                tim1.push($(this).text())
            })
            $('.skor_tim2').each(function() {
                tim1.push($(this).text())
            })

            $.ajax({
                type: 'POST',
                url: "{{ route('multiscore.add') }}",
                data: {
                    tim1 : tim1,
                    tim2 : tim2,
                    skor_tim1 : skor_tim1,
                    skor_tim2 : skor_tim2,
                    "_token" : "{{ csrf_token() }}"
                },
                success: function(res) {
                    console.log(res);
                    // if (data.error) {
                    //     toastr.error(data.error);
                    // } else {
                    //     window.location.href = data.route
                    // }
                },
                error: function(err){
                    // toastr(data.err);
                }
            });
        })
    </script>
@endsection
