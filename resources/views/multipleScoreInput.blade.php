@extends('layouts.app')




@section('content')
    <h1>Input Multiple Skor</h1>
    {{-- Success Notification --}}
    @if (\Session::has('success'))
        <div class="alert alert-success">
            {!! \Session::get('success') !!}</li>
        </div>
    @endif

    @if (\Session::has('error'))
        <div class="alert alert-danger">
            {!! \Session::get('error') !!}</li>
        </div>
    @endif
    

    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif

    <form method="POST" action="{{ route('multiscore.add') }}">
        @csrf

        <div class="form-group">

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tim 1</th>
                        <th>Tim 2</th>
                        <th>Skor Tim 1</th>
                        <th>Skor Tim 2</th>
                    </tr>
                </thead>

                <tbody id="form-score">
                    <tr>
                        <td>1</td>
                        <td><select id="scores[0][tim1]" name="scores[0][tim1]" class="form-select">@foreach ($clubs as $club) <option>{{ $club['name'] }}</option>@endforeach</select></td>
                        <td><select id="scores[0][tim2]" name="scores[0][tim2]" class="form-select">@foreach ($clubs as $club)<option>{{ $club['name'] }}</option>@endforeach</select></td>
                        <td><input type="number" name="scores[0][skor_tim1]"></td>
                        <td><input type="number" name="scores[0][skor_tim2]"></td>
                    </tr>


                    <!-- Add more rows here -->
                </tbody>
            </table>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button class="btn btn-success mt-1" id="tambah" type="button">Tambah</button>
    </form>

    
@endsection

@section('script')
    <script>
        let baris = 0;
        $(document).on('click', '#tambah', function() {
            baris = baris + 1
            var html = "<tr id='baris'" + baris + ">"

            html += "<td>" + (baris + 1) + "</td>"
            html += "<td><select id='tim1' name='scores[" + baris + "][tim1]' class='form-select'>@foreach ($clubs as $club)<option>{{ $club['name'] }}</option>@endforeach</select></td>"
            html += "<td><select id='tim1' name='scores[" + baris + "][tim2]' class='form-select'>@foreach ($clubs as $club)<option>{{ $club['name'] }}</option>@endforeach</select></td>"
            html += "<td><input type='number' name='scores[" + baris + "][skor_tim1]'></td>"
            html += "<td><input type='number' name='scores[" + baris + "][skor_tim2]'></td>"
            html += "</tr>"

            $('#form-score').append(html)
        })
    </script>

    <script>

        function deleteElement(button) {
            var elementToDelete = button.parentNode;
            elementToDelete.parentNode.removeChild(elementToDelete);
        }

        // $(document).on('click', '#simpan', function() {

        //     alert('Hello')
        //     let tim1 = []
        //     let tim2 = []
        //     let skor_tim1 = []
        //     let skor_tim2 = []

        //     $('.tim1').each(function() {
        //         tim1.push($(this).text())
        //     })
        //     $('.tim2').each(function() {
        //         tim1.push($(this).text())
        //     })
        //     $('.skor_tim1').each(function() {
        //         tim1.push($(this).text())
        //     })
        //     $('.skor_tim2').each(function() {
        //         tim1.push($(this).text())
        //     })

        //     $.ajax({
        //         type: 'POST',
        //         url: "{{ route('multiscore.add') }}",
        //         data: {
        //             tim1: tim1,
        //             tim2: tim2,
        //             skor_tim1: skor_tim1,
        //             skor_tim2: skor_tim2,
        //             "_token": "{{ csrf_token() }}"
        //         },
        //         success: function(res) {
        //             console.log(res);
        //             // if (data.error) {
        //             //     toastr.error(data.error);
        //             // } else {
        //             //     window.location.href = data.route
        //             // }
        //         },
        //         error: function(err) {
        //             // toastr(data.err);
        //         }
        //     });
        // })
    </script>
@endsection
