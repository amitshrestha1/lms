@extends('admin.layout.main')
@section('content')
<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Holiday Mode</h4>
            <form action="{{ route('selector.mode') }}" id="holidaymodeform" method="POST">
                @csrf <!-- Add CSRF token for Laravel forms -->
                <div id="dynamicCheckboxContainer">
                    @foreach ($holidaymode as $item)
                        <div class="form-check">
                            <input class="form-check-input selectedbox" type="checkbox" name="selectedbox[]" value="{{ $item->id }}" style="margin-left: 0%">
                            <label class="form-check-label" for='checkbox'>
                                {{ $item->mode }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary text-white save_btn" value="submit">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
    $(document).ready(function()
    {
        $('.save_btn').on('click',function(e){
            e.preventDefault();

            const holidaymodeid = [];

            $('.selectedbox').each(function(){
                if($(this).is(":checked")){
                    holidaymodeid.push($(this).val());
                }

            });
            $.ajax({
                url: '{{route('selector.mode')}}',
                type:'POST',
                data: {
                    "_toekn":"{{ csrf_token() }}"
                    holidaymodeid: holidaymodeid,
                },
                success:function(response){

                }
            });
        });
            
        
    });
</script>
@endsection
