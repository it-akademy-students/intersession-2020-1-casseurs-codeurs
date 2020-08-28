@component('mail::message')
# De la part de {{ $data['firstname'] }} {{ $data['lastname'] }} ({{ $data['email'] }}):

{{ $data['message'] }}

Au boulot! ;),<br>
{{ config('app.name') }}
@endcomponent
