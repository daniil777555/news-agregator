@extends('layouts.adminDefaultLayout')

@section("title")
    Logs panel 
@endsection

@section("content")
    <div class="logs-block">
        @if(count($logs) === 0)

            <h4 class="log-block-field-name">There are no logs</h4>

        @endif
        @foreach($logs as  $log)

            <div class="log-block">
                @foreach($log as $key => $field)

                    @if($key !== "_id" && $key !== "created_at" && $key !== "updated_at")
                        <div class="log-block-field-block">
                            <span class="log-block-field-name">{{ $key }}:</span>
                            <span class="log-block-field-value"> {{ $field }}</span>
                        </div>
                    @endif

                @endforeach
            </div>

        @endforeach
    </div>
@endsection